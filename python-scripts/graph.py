# This script creates a graph of hourly data from one day and saves it
# to the /var/www/html/ directory.
# You can run it in the terminal to see where the error is for error handling.
# The MySQL server must be active and properly configured for it to work.
# It is recommended to use it by adding it to cron jobs.
# You need to change the variables: Hostname, Username, Password, Database Name, and Table Name!

import matplotlib.pyplot as plt
import mysql.connector as mysql
import os
from colors import Colors
from conn import conn_to_db


def get_data(temperature, pressure, humidity, time, table_name):
    cursor = conn.cursor()
    query = f"""
        SELECT {temperature}, {pressure}, {humidity}, TIME_FORMAT({time}, '%h:%i %p')
        FROM {table_name}
        WHERE {time} >= NOW() - INTERVAL 1 DAY
        AND MINUTE({time}) = 0
        ORDER BY {time} ASC
    """
    cursor.execute(query)
    results = cursor.fetchall()
    return results


def plotting(y1, y2, y3, x):
    plt.figure(figsize=(16, 10))

    # graph 1
    plt.subplot(3, 1, 1)
    plt.plot(x, y1, label="Temperature", color="red", linestyle="--", marker="o")
    plt.title("Temperature")
    plt.grid(True)

    # graph 2
    plt.subplot(3, 1, 2)
    plt.plot(x, y2, label="Pressure", color="cyan", linestyle="-", marker="s")
    plt.title("Pressure")
    plt.grid(True)

    # graph 3
    plt.subplot(3, 1, 3)
    plt.plot(x, y3, label="Humidity", color="purple", linestyle=":", marker=".")
    plt.title("Humidity")
    plt.grid(True)

    # save
    if os.path.exists("/var/www/html/graph.png"):
        os.remove("/var/www/html/graph.png")

    plt.savefig("/var/www/html/graph.png")
    plt.tight_layout()


if __name__ == "__main__":
    color = Colors()

    hostname = '10.0.2.15'  # change host
    username = 'data_user'  # change user
    password = '123456'  # change password
    dbname = 'weather'  # change database
    table_name = 'data'  # change table

    try:
        conn = conn_to_db(hostname, username, password, dbname)
        if conn is not None:
            results = get_data('temperature', 'pressure', 'humidity', 'time', table_name)
            y1 = [row[0] for row in results]
            y2 = [row[1] for row in results]
            y3 = [row[2] for row in results]
            x = [row[3] for row in results]
            plotting(y1, y2, y3, x)
            print(color.green + "graphic saved." + color.reset)
        else:
            print(color.red + "cannot get data." + color.reset)

    except mysql.Error as e:
        print(color.red + f"connection error. {e}" + color.reset)
