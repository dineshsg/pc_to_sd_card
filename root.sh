#!/bin/sh
# script that runs as root
whoami
if [ "$1" = "d" ]; then
    cp -avr $2 $3
elif [ "$1" = "f" ]; then
    cp $2 $3
else
    echo "Problem with the file system"
fi
