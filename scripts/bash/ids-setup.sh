#!/bin/bash
# -------------------------------
# chmod +x ids-setup.sh
# sudo ./ids-setup.sh
# -------------------------------

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
NC='\033[0m'

if [ "$EUID" -ne 0 ]; then
  echo -e "${RED}Please run the script as the root user!${NC}"
  exit 1
fi

echo -e "${YELLOW}IDS setup script is starting..${NC}"

apt update
add-apt-repository ppa:oisf/suricata-stable
apt update
apt install iptables -y
apt install suricata -y
apt install libnetfilter-queue-dev libnetfilter-queue1 libnfnetlink-dev -y

echo -e "${GREEN}Setup complete!${NC}"