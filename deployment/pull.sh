#!/bin/bash

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"

export $(egrep -v '^#' $SCRIPT_DIR/../.env | xargs)

git clone -b $DEPLOYMENT_BRANCH --single-branch https://gitlab.com/B00TK1D/cadetnet.git $SCRIPT_DIR/../ > /dev/null 2>&1
git fetch origin/$DEPLOYMENT_BRANCH
git reset --hard origin/$DEPLOYMENT_BRANCH
git -C $SCRIPT_DIR/../ pull origin $DEPLOYMENT_BRANCH

chmod +x $SCRIPT_DIR/docker/maintainer/scripts/pull.sh