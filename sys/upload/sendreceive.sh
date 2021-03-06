#!/bin/bash


FUNCTION=$1
TARGET_FILENAME=$2
LOCAL_PATH=$3
REMOTE_IPAND1STLVL=$4
REMOTE_REMAIN_PATH=$5
REMOTE_USERNAME=$6
REMOTE_PASSWORD=$7
REMOTE_DOMAIN=$8



send() {
cd $LOCAL_PATH
smbclient "//$REMOTE_IPAND1STLVL" $REMOTE_PASSWORD -W $REMOTE_DOMAIN -U $REMOTE_USERNAME -c"cd /$REMOTE_REMAIN_PATH; put $TARGET_FILENAME; quit;"
}

receive() {
cd $LOCAL_PATH
smbclient "//$REMOTE_IPAND1STLVL" $REMOTE_PASSWORD -W $REMOTE_DOMAIN -U $REMOTE_USERNAME -c"cd /$REMOTE_REMAIN_PATH;prompt; mget $TARGET_FILENAME; quit;"
}








case "$FUNCTION" in

send ) send;;
receive ) receive;;
* ) echo "** INVALID FUNCTION NAME ** PLEASE ENTER A VALID FUNCTION NAME";;

esac


exit 0
