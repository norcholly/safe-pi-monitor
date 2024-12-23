#!/bin/bash

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