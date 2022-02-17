#!/bin/bash

if [ "$EUID" -ne 0 ]
  then echo "Build script must be run as root, please try again with sudo"
  exit
fi

read -r -p "Killing all running docker instances, do you want to continue? (Y/n): " cont

if [[ "$cont" == "Y" ]]; then
    echo "Killing and deleting all docker instances..."
    sudo docker kill $(sudo docker ps -q)
    sudo docker rm $(sudo docker ps -a -q)
    sudo docker network rm $(sudo docker network ls -q)
fi

echo "Exiting..."
exit