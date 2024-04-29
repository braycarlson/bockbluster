import json
import numpy as np
import pandas as pd
import requests

from pathlib import Path


def resolve(filename):
    return 'https://cdn.thegamesdb.net/images/original/' + filename


def save(game, url):
    print(f"Fetching: {url}")

    filename = f"{game}.png"
    path = Path('images/boxart')
    location = path.joinpath(filename)

    if location.is_file():
        return

    image = requests.get(url)

    with open(location, 'wb') as handle:
        if image.status_code == 200:
            handle.write(image.content)
        else:
            print('Error')


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


def main():
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

    filename = dataframe.filename.to_numpy()

    url = np.frompyfunc(
        lambda x: resolve(x),
        1,
        1
    )(filename)

    dataframe['url'] = url

    column = ['id', 'url']
    collection = dataframe[column].to_numpy().transpose()
    game, url = collection

    url = np.frompyfunc(
        lambda x, y: save(x, y),
        2,
        0
    )(game, url)


if __name__ == '__main__':
    main()
