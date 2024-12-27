#!/bin/bash

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BRIGHT_WHITE='\033[1;37m'
NC='\033[0m'

if [ "$EUID" -ne 0 ]; then
  echo -e "${RED}Please run the script as the root user!${NC}"
  exit 1
fi

echo -e "${YELLOW}Database setup script is starting..${NC}"

function get_input() {
    read -e -s -p "$(echo -e Please set the ${BRIGHT_WHITE}root password${NC} for the database:${BRIGHT_WHITE}) " DB_ROOT_PASSWORD
    echo ""

    while true; do
        read -e -p "$(echo -e ${NC}Please set the ${BRIGHT_WHITE}database name:${BRIGHT_WHITE}) " DB_NAME
        if [[ -z "$DB_NAME" ]];then
            echo -e "${RED}Database name cannot be empty! Please try again.${NC}"
        else
            break
        fi
    done

    while true; do
        read -e -p "$(echo -e ${NC}Please set the ${BRIGHT_WHITE}username${NC} for the database:${BRIGHT_WHITE}) " DB_USER
        if [[ -z "$DB_NAME" ]];then
            echo -e "${RED}Username cannot be empty! Please try again.${NC}"
        else
            break
        fi
    done

    read -e -s -p "$(echo -e ${NC}Please set the ${BRIGHT_WHITE}user password${NC} for the database:${BRIGHT_WHITE}) " DB_PASSWORD
    echo ""

    while true; do
        read -e -p "$(echo -e ${NC}Please set the ${BRIGHT_WHITE}table name${NC} for the database:${BRIGHT_WHITE}) " TABLE_NAME
        if [[ -z "$DB_NAME" ]];then
            echo -e "${RED}Table cannot be empty! Please try again.${NC}"
        else
            break
        fi
    done
}

function installing-mariadb() {
    if dpkg -l | grep -qw mariadb-server; then
    echo -e "${GREEN}MariaDB is already installed! Proceeding..${NC}"
    else
        echo -e "${YELLOW}MariaDB not found. Installing MariaDB..${NC}"
        apt-get update -y
        apt-get install mariadb-server -y
    fi
}

function starting-mariadb() {
    echo -e "${YELLOW}Starting MariaDB..${NC}"
    systemctl start mariadb
    systemctl enable mariadb
}

function settings() {
    echo -e "${YELLOW}Database setup is in progress..${NC}"
    mysql -u root <<EOF
        ALTER USER 'root'@'%' IDENTIFIED BY '$DB_ROOT_PASSWORD';
        FLUSH PRIVILEGES;

        CREATE DATABASE $DB_NAME;
        CREATE USER '$DB_USER'@'%' IDENTIFIED BY '$DB_PASSWORD';
        GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'%';
        FLUSH PRIVILEGES;

        USE $DB_NAME;
        CREATE TABLE $TABLE_NAME (
            id INT AUTO_INCREMENT PRIMARY KEY,
            timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            temperature FLOAT,
            pressure FLOAT,
            humidity FLOAT
        );
EOF
}

get_input
installing-mariadb
starting-mariadb
settings

echo -e "${GREEN}Setup complete!${NC}"
echo -e "Root Password:${BRIGHT_WHITE} ******"
echo -e "${NC}Database:${BRIGHT_WHITE} $DB_NAME"
echo -e "${NC}User:${BRIGHT_WHITE} $DB_USER"
echo -e "${NC}User Password:${BRIGHT_WHITE} ******"
echo -e "${NC}Table:${BRIGHT_WHITE} $TABLE_NAME${NC}"
