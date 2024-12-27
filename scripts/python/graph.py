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


def get_data(temperature, pressure, humidity, timestamp, table_name):
    cursor = conn.cursor()
    query = f"""
        SELECT {temperature}, {pressure}, {humidity}, HOUR({timestamp})
        FROM {table_name}
        WHERE {timestamp} >= NOW() - INTERVAL 1 DAY
        AND MINUTE({timestamp}) = 0
        ORDER BY {timestamp} ASC
    """
    cursor.execute(query)
    results = cursor.fetchall()
    return results



def plotting(y1, y2, y3, x):
    plt.figure(figsize=(16, 10))
    plt.rcParams['axes.facecolor'] = '#0D0D0D'
    plt.rcParams['axes.edgecolor'] = '#6E6E6E'  

    # graph 1
    plt.subplot(3, 1, 1)
    plt.plot(x, y1, label="Temperature", color="red", linestyle="--", marker="o")
    plt.title("Temperature", color="#6E6E6E")  
    plt.grid(True, color="#6E6E6E")
    plt.xticks(range(24), [f"{i:02}" for i in range(24)], color="#6E6E6E")
    plt.yticks(color="red")

    # graph 2
    plt.subplot(3, 1, 2)
    plt.plot(x, y2, label="Pressure", color="cyan", linestyle="-", marker="s")
    plt.title("Pressure", color="#6E6E6E")
    plt.grid(True, color="#6E6E6E")
    plt.xticks(range(24), [f"{i:02}" for i in range(24)], color="#6E6E6E") 
    plt.yticks(color="cyan")

    # graph 3
    plt.subplot(3, 1, 3)
    plt.plot(x, y3, label="Humidity", color="purple", linestyle=":", marker=".")
    plt.title("Humidity", color="#6E6E6E")
    plt.grid(True, color="#6E6E6E")
    plt.xticks(range(24), [f"{i:02}" for i in range(24)], color="#6E6E6E")
    plt.yticks(color="purple")

    # save
    if os.path.exists("/var/www/html/graph.png"):
        os.remove("/var/www/html/graph.png")

    plt.subplots_adjust(hspace=0.4)
    plt.savefig("/var/www/html/graph.png", facecolor='#0D0D0D')
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
            results = get_data('temperature', 'pressure', 'humidity', 'timestamp', table_name)
            y1 = [row[0] for row in results]
            y2 = [row[1] for row in results]
            y3 = [row[2] for row in results]
            x = [int(row[3]) for row in results]
            plotting(y1, y2, y3, x)
            print(color.green + "graphic saved." + color.reset)
        else:
            print(color.red + "cannot get data." + color.reset)

    except mysql.Error as e:
        print(color.red + f"connection error. {e}" + color.reset)
