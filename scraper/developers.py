import codecs
import json

from bs4 import BeautifulSoup
from pathlib import Path


def main():
    path = Path().cwd().joinpath('page')
    filename = path.joinpath('developers.html')

    file = codecs.open(filename, 'r', 'utf-8')
    soup = BeautifulSoup(file.read(), 'html.parser')

    wrapper = soup.find_all(
        'a',
        attrs={'class': 'btn btn-link grid-item'},
        href=True
    )

    developers = {}

    for a in wrapper:
        developer_id = a.get('href')

        developer_id = developer_id.replace(
            './list_games.php?dev_id=',
            ''
        )

        developer_id = int(developer_id)

        developer = a.find('p').text
        developers[developer_id] = developer

    developers = dict(
        sorted(
            developers.items()
        )
    )

    content = json.dumps(developers, indent=4)
    print(content)


if __name__ == '__main__':
    main()
