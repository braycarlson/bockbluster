import pandas as pd

from datetime import datetime
from faker import Faker
from passlib.hash import bcrypt
from random import randint, uniform
from sqlalchemy import create_engine
from sqlalchemy.types import BOOLEAN, DATE, INT, VARCHAR


def phone_number():
    locale = ['en_US']
    fake = Faker(locale)

    string = str(
        fake.pyint(1000000000, 9999999999)
    )

    string = string[:3] + '-' + string[3:]
    string = string[:7] + '-' + string[7:]

    return string


def staff():
    locale = ['en_US']
    fake = Faker(locale)

    employees = [
        {
            'ID': None,
            'SID': None,
            'name': 'Angela De Sousa Costa',
            'username': 'angela',
            'password': None,
            'address': None,
            'phone': None,
            'dob': None,
            'wage': None,
            'hours': None,
            'managerial_status': None
        },
        {
            'ID': None,
            'SID': None,
            'name': 'Brayden Carlson',
            'username': 'brayden',
            'password': None,
            'address': None,
            'phone': None,
            'dob': None,
            'wage': None,
            'hours': None,
            'managerial_status': None
        },
        {
            'ID': None,
            'SID': None,
            'name': 'Brian Park',
            'username': 'brian',
            'password': None,
            'address': None,
            'phone': None,
            'dob': None,
            'wage': None,
            'hours': None,
            'managerial_status': None
        },
        {
            'ID': None,
            'SID': None,
            'name': 'Rocky Au',
            'username': 'rocky',
            'password': None,
            'address': None,
            'phone': None,
            'dob': None,
            'wage': None,
            'hours': None,
            'managerial_status': None
        }
    ]

    for index, employee in enumerate(employees, 1):
        employee['ID'] = index
        employee['SID'] = index

        username = employee.get('username')
        password = username.encode()

        password = bcrypt.using(ident='2y', rounds=10).hash(password)

        employee['password'] = password

        employee['address'] = (
            fake
            .unique
            .address()
            .replace('\n', ' ')
        )

        employee['email'] = fake.unique.email()
        employee['phone'] = phone_number()

        employee['dob'] = fake.unique.date_of_birth(
            minimum_age=18,
            maximum_age=40
        )

        employee['wage'] = round(uniform(14.00, 25.00), 2)
        employee['hours'] = randint(2, 12)
        employee['manager'] = True

    columns = [
        'ID',
        'SID',
        'name',
        'username',
        'password',
        'address',
        'phone',
        'dob',
        'wage',
        'hours',
        'manager'
    ]

    dataframe = pd.DataFrame(
        employees,
        columns=columns
    )

    con = create_engine('sqlite://', echo=False)

    dtype = {
        'ID': INT(),
        'SID': INT(),
        'name': VARCHAR(length=100),
        'address': VARCHAR(length=100),
        'phone': VARCHAR(length=20),
        'dob': DATE(),
        'wage': INT(),
        'hours': INT(),
        'manager': BOOLEAN()
    }

    dataframe.to_sql(
        name='STAFF',
        con=con,
        dtype=dtype,
        index=False
    )

    with con.connect() as conn:
        for line in conn.connection.iterdump():
            if line.startswith('INSERT'):
                line = (
                    line
                    .replace('"STAFF"', "STAFF")
                    .replace(',', ', ')
                )

                print(line)


def store():
    locale = ['en_US']
    fake = Faker(locale)

    stores = []

    for index in range(1, 5):
        store = {}

        store['SID'] = index
        store['name'] = f"{fake.word().title()} Store"

        store['address'] = (
            fake
            .unique
            .address()
            .replace('\n', ' ')
        )

        store['phone'] = phone_number()

        stores.append(store)

    columns = [
        'SID',
        'name',
        'address',
        'phone'
    ]

    dataframe = pd.DataFrame(
        stores,
        columns=columns
    )

    con = create_engine('sqlite://', echo=False)

    dtype = {
        'SID': INT(),
        'name': VARCHAR(length=100),
        'address': VARCHAR(length=100),
        'phone': VARCHAR(length=20)
    }

    dataframe.to_sql(
        name='STORE',
        con=con,
        dtype=dtype,
        index=False
    )

    with con.connect() as conn:
        for line in conn.connection.iterdump():
            if line.startswith('INSERT'):
                line = (
                    line
                    .replace('"STORE"', "STORE")
                    .replace(',', ', ')
                )

                print(line)


def customer():
    locale = ['en_US']
    fake = Faker(locale)

    customers = []

    for i in range(1, 51):
        customer = {}

        customer['CID'] = i
        customer['name'] = fake.unique.name()

        customer['address'] = (
            fake
            .unique
            .address()
            .replace('\n', ' ')
        )

        customer['email'] = fake.unique.email()
        customer['phone'] = phone_number()
        customer['dob'] = fake.unique.date_of_birth(
            minimum_age=16,
            maximum_age=60
        )
        customer['membership'] = randint(0, 1)

        customers.append(customer)

    columns = [
        'CID',
        'name',
        'email',
        'address',
        'phone',
        'dob',
        'membership'
    ]

    dataframe = pd.DataFrame(
        customers,
        columns=columns
    )

    con = create_engine('sqlite://', echo=False)

    dtype = {
        'name': VARCHAR(length=100),
        'email': VARCHAR(length=100),
        'address': VARCHAR(length=100),
        'phone': VARCHAR(length=20),
        'dob': DATE(),
        'membership': BOOLEAN()
    }

    dataframe.to_sql(
        name='CUSTOMER',
        con=con,
        dtype=dtype,
        index=False
    )

    with con.connect() as conn:
        for line in conn.connection.iterdump():
            if line.startswith('INSERT'):
                line = (
                    line
                    .replace('"CUSTOMER"', "CUSTOMER")
                    .replace(',', ', ')
                )

                print(line)


def main():
    store()
    staff()
    # customer()


if __name__ == '__main__':
    main()
