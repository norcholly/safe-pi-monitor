#!/bin/bash
# -------------------------------
# chmod +x ip-blocker.sh
# sudo nano /etc/crontab
# @reboot  root /usr/bin/bash   /root/safe-pi-monitor/scripts/bash/ip-blocker.sh
# sudo ./ip-blocker.sh
# -------------------------------
# First Released: 2025-01-13
# Version: 1.0
# Author: Ali İrfan Doğan
# -------------------------------

LOG_FILE="/var/log/suricata/fast.log"
HOME_IP="X.X.X.X" # change this
BLOCKED_IPS=()

tail -fn0 "$LOG_FILE" | while read -r LINE; do
    if echo "$LINE" | grep -q "Possible"; then
        ATTACKER_IP=$(echo "$LINE" | grep -oP '(\d{1,3}\.){3}\d{1,3}' | head -1)
        if [[ "$ATTACKER_IP" != "$MY_IP" && ! " ${BLOCKED_IPS[@]} " =~ " ${ATTACKER_IP} " ]]; then
            echo "Blocked Attacker IP: $ATTACKER_IP"
            iptables -A INPUT -s "$ATTACKER_IP" -j DROP
            BLOCKED_IPS+=("$ATTACKER_IP")
        fi
    fi
done