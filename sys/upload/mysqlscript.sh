#!/bin/bash


mysqlpassword=root

key_buffer=1024M
max_allowed_packet=1024M
thread_stack=192K
thread_cache_size=64
max_connections=9999
table_cache=2048
query_cache_limit=2048M
query_cache_size=1024M 

FUNCTION=$1
rootpass=${2:-$mysqlpassword}
keybuffer=${3:-$key_buffer}
maxallowedpacket=${4:-$max_allowed_packet}
threadstack=${5:-$thread_stack}
threadcachesize=${6:-$thread_cache_size}
maxconnections=${7:-$max_connections}
tablecache=${8:-$table_cache}
querycachelimit=${9:-$query_cache_limit}
querycachesize=${10:-$query_cache_size}

installmysql() {
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password $rootpass'
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password $rootpass'
sudo apt-get -y install mysql-server-5.5
}

installworkbench() {
sudo apt-get -y install mysql-workbench
}

configmysqlremote() {
mysql --host=127.0.0.1 --user=root --password=$rootpass mysql -e "UPDATE mysql.user SET Password=PASSWORD('$rootpass') WHERE User='root';"

mysql --host=127.0.0.1 --user=root --password=$rootpass mysql -e "UPDATE mysql.user SET Host= '%' WHERE Host= '127.0.0.1';"

cd /etc
sudo chown -R $USER /etc/mysql
sed -i "s/127.0.0.1/0.0.0.0/g" /etc/mysql/my.cnf
sudo chown -R root /etc/mysql
}

configmysqlvars() {

cd /etc
sudo chown -R $USER /etc/mysql
sed -i "s/locking/locking\nlower_case_table_names = 1/g" /etc/mysql/my.cnf

sed -i "s/.*key_buffer.*/key_buffer=$keybuffer /" /etc/mysql/my.cnf
sed -i "s/.*max_allowed_packet.*/max_allowed_packet=$maxallowedpacket /" /etc/mysql/my.cnf
sed -i "s/.*thread_stack.*/thread_stack=$threadstack /" /etc/mysql/my.cnf
sed -i "s/.*thread_cache_size.*/thread_cache_size=$threadcachesize /" /etc/mysql/my.cnf
sed -i "s/.*max_connections.*/max_connections =$maxconnections /" /etc/mysql/my.cnf
sed -i "s/.*table_cache.*/table_cache =$tablecache /" /etc/mysql/my.cnf
sed -i "s/.*query_cache_limit.*/query_cache_limit=$querycachelimit /" /etc/mysql/my.cnf
sed -i "s/.*query_cache_size.*/query_cache_size =$querycachesize /" /etc/mysql/my.cnf

sudo chown -R root /etc/mysql
}

case "$FUNCTION" in

installmysql ) installmysql;;
installworkbench ) installworkbench;;
configmysqlremote ) configmysqlremote;;
configmysqlvars ) configmysqlvars;;
* ) echo "** INVALID FUNCTION NAME ** PLEASE ENTER A VALID FUNCTION NAME";;

esac

exit 0
