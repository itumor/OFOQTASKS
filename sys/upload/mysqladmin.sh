#!/bin/bash


FUNCTION=$1
HOSTNAME=$2
USERNAME=$3
PASSWORD=$4
DATABASE=$5
FILEPATH=$6
FILENAME=$7


stop() {
sudo service mysql stop
}

start() {
sudo service mysql start
}

restart() {
stop
start
}

list() {
mysql --host=$HOSTNAME --user=$USERNAME --password=$PASSWORD -e "SHOW DATABASES;"
}

drop() {
mysql --host=$HOSTNAME --user=$USERNAME --password=$PASSWORD -e "DROP DATABASE $DATABASE;"
}

create() {
mysql --host=$HOSTNAME --user=$USERNAME --password=$PASSWORD -e "CREATE DATABASE $DATABASE DEFAULT CHARACTER SET utf8;"
}

backup() {
mysqldump --host=$HOSTNAME --user=$USERNAME --password=$PASSWORD $DATABASE > $FILEPATH/$FILENAME
} 

update() {
mysql --host=$HOSTNAME --user=$USERNAME --password=$PASSWORD $DATABASE < $FILEPATH/$FILENAME
} 

restore() {
RESULT=`mysql --host=$HOSTNAME --user=$USERNAME --password=$PASSWORD --skip-column-names -e "SHOW DATABASES LIKE '$DATABASE'"`
if [ "$RESULT" == "$DATABASE" ]; then
    drop
	create
	update
else
    create
	update
fi
} 


case "$FUNCTION" in

stop ) stop;;
start ) start;;
restart ) restart;;
list ) list;;
drop ) drop;;
create ) create;;
backup ) backup;;
update ) update;;
restore ) restore;;
* ) echo "** INVALID FUNCTION NAME ** PLEASE ENTER A VALID FUNCTION NAME";;

esac


exit 0