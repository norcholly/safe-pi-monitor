# This script sends data from the SenseHat emulator to the database
# You can run it in the terminal to see where the error is for error handling.
# The SenseHat Emulator must be open for it to work.
# The MySQL server must be active and properly configured for it to work.
# It is recommended to use it by adding it to cron jobs.
# You need to change the variables: Hostname, Username, Password, Database Name, and Table Name!
#
# raspberry-weather-visualizer v1.0
# created by @norcholly
# https://alirfandogan.com/
# v1.0

from sense_emu import SenseHat
import mysql.connector as mysql
from colors import Colors
from conn import conn_to_db


def send_to_db(temperature, pressure, humidity, conn, table_name):
    cursor = conn.cursor()
    query = f"INSERT INTO {table_name} (temperature, pressure, humidity) VALUES (%s, %s, %s)"
    values = (temperature, pressure, humidity)

    cursor.execute(query, values)
    conn.commit()

    print(color.cyan + f"data sent to {table_name} table in {dbname} database by {username}" + color.reset)
    print(color.white + f"temperature: {temperature}°C\npressure: {pressure}mbar\nhumidity: {humidity}%" + color.reset)

    cursor.close()
    conn.close()


if __name__ == "__main__":
    sense = SenseHat()
    color = Colors()

    temperature = round(sense.get_temperature(), 2)
    pressure = round(sense.get_pressure(), 4)
    humidity = sense.get_humidity()

    hostname = '10.0.2.15'  # change host
    username = 'data_user'  # change user
    password = '123456'  # change password
    dbname = 'weather'  # change database
    table_name = 'data'  # change table

    try:
        conn = conn_to_db(hostname, username, password, dbname)
        if conn is not None:
            send_to_db(temperature, pressure, humidity, conn, table_name)
            if temperature >= 60:
                print(color.red + "extreme temperature warning!" + color.reset)
            if temperature <= 0:
                print(color.red + "low temperature warning!" + color.reset)
            if pressure >= 1060:
                print(color.red + "extreme pressure warning!" + color.reset)
            if pressure <= 960:
                print(color.red + "low pressure warning!" + color.reset)
            if humidity >= 90:
                print(color.red + "extreme humidity warning!" + color.reset)
            if humidity <= 10:
                print(color.red + "low humidity warning!" + color.reset)
            else:
                print(color.green + "temperature, pressure and humidity values are normal" + color.reset)
        else:
            print(color.red + "cannot send data." + color.reset)

    except mysql.Error as e:
        print(color.red + f"connection error. {e}" + color.reset)