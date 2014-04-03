#!/bin/bash


FUNCTION=$1
USERNAME=$2
PASSFILE=$3
APPFL_NM=$4


stop() {
liferay/bin/asadmin stop-domain
}

start() {
liferay/bin/asadmin start-domain
}

restart() {
liferay/bin/asadmin restart-domain
}

deploy() {
liferay/bin/asadmin --user $USERNAME --passwordfile $PASSFILE deploy $APPFL_NM
}

undeploy() {
liferay/bin/asadmin --user $USERNAME --passwordfile $PASSFILE undeploy $APPFL_NM
}


case "$FUNCTION" in

stop ) stop;;
start ) start;;
restart ) restart;;
deploy ) deploy;;
undeploy ) undeploy;;
* ) echo "** INVALID FUNCTION NAME ** PLEASE ENTER A VALID FUNCTION NAME";;

esac


exit 0