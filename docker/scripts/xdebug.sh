#!/bin/bash

### READLINK POLYFILL FOR MACOS
### Requires you to run "brew install coreutils" first.
readlink() {
    if _has_command greadlink; then
        command greadlink -f "$@"
    else
        command readlink -f "$@"
    fi
}

_has_command() {
    hash -- "$1" 2>/dev/null
}
### END OF POLYFILL

SWITCH=$1
READLINK_RESULT=$(readlink $0)
SCRIPTDIR=$(dirname "$READLINK_RESULT")

cd ${SCRIPTDIR}/..

if [ -z "$SWITCH" ]
then
  printf "missing argument whether to turn on or off xdebug (on|off|auto)"
  exit 2
fi

CONTAINER_NAME="php-rpi"
PHP_PATH="//usr/local/etc/php"

function enableXdebug {
    docker-compose exec ${CONTAINER_NAME} bash -c "ln -sf /xdebug/xdebug.on.ini /${PHP_PATH}/conf.d/docker-php-ext-xdebug.ini"
    docker-compose exec ${CONTAINER_NAME} bash -c 'kill -USR2 $(pgrep -f "php-fpm: master process")'
    echo "XDebug enabled"
}

function disableXdebug {
    docker-compose exec ${CONTAINER_NAME} bash -c "rm -f /${PHP_PATH}/conf.d/docker-php-ext-xdebug.ini"
    docker-compose exec ${CONTAINER_NAME} bash -c 'kill -USR2 $(pgrep -f "php-fpm: master process")'
    echo "XDebug disabled"
}

function autoXdebug {
    docker-compose exec ${CONTAINER_NAME} bash -c "ln -sf /xdebug/xdebug.auto.ini /${PHP_PATH}/conf.d/docker-php-ext-xdebug.ini"
    docker-compose exec ${CONTAINER_NAME} bash -c 'kill -USR2 $(pgrep -f "php-fpm: master process")'
    echo "XDebug autostart enabled"
}

function profileXdebug {
    docker-compose exec ${CONTAINER_NAME} bash -c "ln -sf /xdebug/xdebug.profile.ini /${PHP_PATH}/conf.d/docker-php-ext-xdebug.ini"
    docker-compose exec ${CONTAINER_NAME} bash -c 'kill -USR2 $(pgrep -f "php-fpm: master process")'
    echo "XDebug profile enabled"
}

if [ "$SWITCH" = "on" ]
then
    enableXdebug
elif [ "$SWITCH" = "off" ]
then
    disableXdebug
elif [ "$SWITCH" = "auto" ]
then
    autoXdebug
elif [ "$SWITCH" = "profile" ]
then
    profileXdebug
else
    echo "Unrecognized xdebug option $SWITCH"
fi


