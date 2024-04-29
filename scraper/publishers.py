import codecs
import json

from bs4 import BeautifulSoup
from pathlib import Path


def main():
    path = Path().cwd().joinpath('page')
    filename = path.joinpath('publishers.html')

    file = codecs.open(filename, 'r', 'utf-8')
    soup = BeautifulSoup(file.read(), 'html.parser')

    wrapper = soup.find_all(
        'a',
        attrs={'class': 'btn btn-link grid-item'},
        href=True
    )

    publishers = {}

    for a in wrapper:
        publisher_id = a.get('href')

        publisher_id = publisher_id.replace(
            './list_games.php?pub_id=',
            ''
        )

        publisher_id = int(publisher_id)

        publisher = a.find('p').text
        publishers[publisher_id] = publisher

    publishers = dict(
        sorted(
            publishers.items()
        )
    )

    content = json.dumps(publishers, indent=4)
    print(content)


if __name__ == '__main__':
    main()
