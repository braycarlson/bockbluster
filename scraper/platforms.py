import codecs
import json

from bs4 import BeautifulSoup
from pathlib import Path


def main():
    path = Path().cwd().joinpath('page')
    filename = path.joinpath('platforms.html')

    file = codecs.open(filename, 'r', 'utf-8')
    soup = BeautifulSoup(file.read(), 'html.parser')

    wrapper = soup.find_all(
        'a',
        attrs={'class': 'btn btn-link grid-item'},
        href=True
    )

    platforms = {}

    for a in wrapper:
        platform_id = a.get('href')

        platform_id = platform_id.replace(
            './platform.php?id=',
            ''
        )

        platform_id = int(platform_id)

        platform = a.find('p').text
        platforms[platform_id] = platform

    platforms = dict(
        sorted(
            platforms.items()
        )
    )

    content = json.dumps(platforms, indent=4)
    print(content)


if __name__ == '__main__':
    main()
