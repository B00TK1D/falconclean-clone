#!/bin/bash

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"

export $(egrep -v '^#' $SCRIPT_DIR/../.env | xargs)

build () {
    sudo docker-compose -f $1docker-compose.yaml down
    sudo docker container prune -f
    sudo docker-compose -f $1docker-compose.yaml build
    sudo docker-compose -f $1docker-compose.yaml up &
    if [ -f "$1build.sh" ]; then
        sudo bash $1build.sh &
    fi
}

if [ "$EUID" -ne 0 ]
  then echo "Build script must be run as root, please try again with sudo"
  exit
fi

if [ -z "$1" ]; then
    printf "No build target specified. Enter a service name, or 'all' to build all services\n"
    printf "Available services:\n\n"
    for target in $SCRIPT_DIR/docker/*/ ; do
        name=$(realpath --relative-to $SCRIPT_DIR/docker/ $target)
        printf "$name\n"
    done
    printf "\n"
else
    sudo docker network create ${DEPLOYMENT_BRANCH}.default
    if [ "$1" == "all" ]; then
        printf "Building all services\n\n"
        for target in $SCRIPT_DIR/docker/*/ ; do
            name=$(realpath --relative-to $SCRIPT_DIR/docker/ $target)
            printf "Building $name\n"
            build $target
        done
    else
        for target in "$@" ; do
            if [ -d "$SCRIPT_DIR/docker/$target/" ]; then
                printf "Building $target\n"
                build $SCRIPT_DIR/docker/$target/
            else
                printf "Invalid build target $target, skipping\n"
            fi
        done
    fi
fi

printf "\nExiting...\n"
exit