import html
import json
import pandas as pd

from datetime import datetime
from pathlib import Path
from sqlalchemy import create_engine
from sqlalchemy.types import VARCHAR


def get_games(file):
    games = file.get('data').get('games')
    dataframe = pd.DataFrame(games)

    # SNES: 6, NES:  7

    mask = (
        (dataframe.platform == 6) |
        (dataframe.platform == 7)
    )

    drop = [
        'alternates',
        'coop',
        'hashes',
        'players',
        'uids',
        'youtube'
    ]

    dataframe = dataframe[mask]
    dataframe = dataframe.drop(drop, axis=1)

    return dataframe


def get_boxart(file):
    boxart = file.get('include').get('boxart')
    _ = boxart.get('base_url').get('original')
    images = boxart.get('data')

    boxart = []

    for key, value in images.items():
        for v in value:
            condition = (
                v.get('type') == 'boxart' and
                v.get('side') == 'front'
            )

            if condition:
                v['id'] = int(key)
                boxart.append(v)

    drop = [
        'side',
        'type'
    ]

    dataframe = pd.DataFrame(boxart)
    dataframe = dataframe.drop(drop, axis=1)

    return dataframe


def to_genre(identifier):
    if identifier is None:
        return

    with open('data/genre.json', 'r') as handle:
        genre = json.load(handle)

    genres = []

    for i in identifier:
        i = str(i)

        if i in genre:
            g = genre.get(i)
            genres.append(g)

    return ', '.join(genres)


def to_name(name):
    if not name:
        return

    name = html.unescape(name)
    name = name.strip()

    return name


def to_overview(overview):
    if not overview:
        return

    overview = html.unescape(overview)

    overview = (
        overview
        .replace('*', '')
        .replace('•', '')
        .replace('\r\n\r\n', ' ')
        .replace('\r\n', ' ')
    )

    return overview


def to_developer(identifier):
    if identifier is None:
        return

    with open('data/developers.json', 'r') as handle:
        developer = json.load(handle)

    developers = []

    for i in identifier:
        i = str(i)

        if i in developer:
            d = developer.get(i)
            developers.append(d)

    if len(developers) > 1:
        return ', '.join(developers)

    return ''.join(developers)


def to_date(date):
    date = datetime.strptime(date, '%Y-%m-%d')
    return date.year


def main():
    corrupt = [
        file.relative_to(*file.parts[:4]).as_posix()
        for file in Path.cwd().joinpath('images/boxart').glob('*')
        if file.is_file() and file.stat().st_size == 0
    ]

    path = Path('images/boxart')
    path.mkdir(parents=True, exist_ok=True)

    with open('data/database.json', 'r') as handle:
        file = json.load(handle)

        games = get_games(file)
        boxart = get_boxart(file)

    dataframe = games.merge(
        boxart,
        how='inner',
        on='id'
    )

    filelist = {
        int(file.stem): file.as_posix()
        for file in path.glob('*')
        if file.is_file()
    }

    columns = filelist.keys()

    image = pd.DataFrame(
        [filelist],
        columns=columns
    )

    image = image.transpose()

    image = image.reset_index(level=0)

    image = image.rename(
        columns={
            'index': 'id',
            0: 'image'
        }
    )

    dataframe = dataframe.merge(
        image,
        how='inner',
        on='id'
    )

    dataframe = dataframe.rename(
        columns={
            'game_title': 'name',
            'developers': 'developer',
            'genres': 'genre',
            'release_date': 'year_released'
        }
    )

    dataframe.drop(
        [
            'id',
            'filename',
            'platform',
            'region_id',
            'country_id',
            'rating',
            'publishers',
            'resolution'
        ],
        axis=1,
        inplace=True
    )

    subset = [
        'name',
        'year_released',
        'overview',
        'developer',
        'genre',
        'image'
    ]

    dataframe['name'] = dataframe['name'].apply(
        lambda x: to_name(x)
    )

    dataframe['overview'] = dataframe['overview'].apply(
        lambda x: to_overview(x)
    )

    dataframe['genre'] = dataframe['genre'].apply(
        lambda x: to_genre(x)
    )

    dataframe['developer'] = dataframe['developer'].apply(
        lambda x: to_developer(x)
    )

    dataframe['year_released'] = dataframe['year_released'].apply(
        lambda x: to_date(x)
    )

    dataframe.dropna(
        subset=subset,
        inplace=True
    )

    dataframe.drop_duplicates(
        subset='name',
        keep='first',
        inplace=True
    )

    dataframe = dataframe[~dataframe['image'].isin(corrupt)]

    # Ignore games that fail to insert:
    mask = (
        (dataframe.name == 'D\'veel\'ng') |
        (dataframe.name == 'Asterix') |
        (dataframe.name == 'Bootèe')
    )

    dataframe = dataframe[~mask]

    con = create_engine('sqlite://', echo=False)

    dtype = {
        'name': VARCHAR(length=250),
        'year_released': VARCHAR(length=25),
        'overview': VARCHAR(length=5000),
        'developer': VARCHAR(length=250),
        'genre': VARCHAR(length=250),
        'image': VARCHAR(length=250)
    }

    dataframe.to_sql(
        name='VIDEO_GAMES',
        con=con,
        dtype=dtype,
        index=False
    )

    with con.connect() as conn:
        for line in conn.connection.iterdump():
            if line.startswith('INSERT'):
                line = (
                    line
                    .replace('"VIDEO_GAMES"', "VIDEO_GAMES")
                    .replace(',', ', ')
                    .replace('.png', '.jpg')
                )

                print(line)

    dataframe.to_html('bockbuster.html')


if __name__ == '__main__':
    main()
