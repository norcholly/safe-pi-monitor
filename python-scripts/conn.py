# This script connects to the database.
# There is no need to change anything.

import mysql.connector as mysql
from colors import Colors

color = Colors()


def conn_to_db(hostname, username, password, dbname):
    conn = mysql.connect(
        host=hostname,
        user=username,
        password=password,
        database=dbname,
    )

    if conn.is_connected():
        print(color.green + "connected." + color.reset)
        return conn
    else:
        print(color.red + "not connected." + color.reset)
        return None
