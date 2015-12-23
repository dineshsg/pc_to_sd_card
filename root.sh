#!/bin/sh
# script that runs as root
whoami
if [ "$1" = "d" ]; then
    cp -avr $2 $3
elif [ "$1" = "f" ]; then
    cp $2 $3
elif [ "$1" = "t" ]; then
    mkdir $3
    mount $2 $3
elif [ "$1" = "r" ]; then
   umount $2
   sleep 30s
   rm -rf $3 
else
    echo "Problem with the file system"
fi
