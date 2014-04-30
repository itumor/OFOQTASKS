#!/bin/bash


contextnamevalue=OTMS-Web
JVM_HEAP_SIZE=3072m
JVM_HEAP_SIZE_XMN=1024m
JVM_PARALLEL_GC_THREADS=24
MAX_THREAD_POOL_SIZE=192
Large_Page_Size_InBytes=2m

FUNCTION=$1
glassfishfolder=$2
adminpassword=$3

domainname=$4

contextname_value=${14:-$contextnamevalue}

JVMHEAPSIZE=${9:-$JVM_HEAP_SIZE}
JVMHEAPSIZEXMN=${10:-$JVM_HEAP_SIZE_XMN}
JVMPARALLELGCTHREADS=${11:-$JVM_PARALLEL_GC_THREADS}
MAXTHREADPOOLSIZE=${12:-$MAX_THREAD_POOL_SIZE}
LargePageSizeInBytes=${13:-$Large_Page_Size_InBytes}

liferaydbip=$5
liferaydbname=$6
liferaydbuser=$7
liferaydbpass=$8


installglassfish() {

export JAVA_HOME=/usr/lib/jvm/java-6-oracle
echo $JAVA_HOME

sed 's:PASSPASS:'$adminpassword':g' answer1.txt > answer.txt;
sed -i "s/TOBECHANGEDBYUSER/$glassfishfolder/g" answer.txt;

sudo chmod +x ./ogs-3.1-unix-ml.sh
./ogs-3.1-unix-ml.sh -a answer.txt -s

}


tmpgs() {
mkdir "$HOME/tmpGS"
sed -i "s|.*Dfelix.fileinstall.bundles.startTransient.*|\<jvm\-options\>\-Djava.io.tmpdir=$HOME\/tmpGS\<\/jvm\-options\>\n\<jvm\-options\>\-Dfelix.fileinstall.bundles.startTransient=true\<\/jvm\-options\> |" $glassfishfolder/glassfish/domains/$domainname/config/domain.xml
}

fabsprop() {
echo CONTEXT_NAME            =/$contextname_value/  > $glassfishfolder/glassfish/domains/$domainname/config/FABS.properties
}

glassfishtuning() {
sed -i "s/\-client/\-server/g" $glassfishfolder/glassfish/domains/$domainname/config/domain.xml

sed -i "s|.*JVM_HEAP_SIZE\".*|\<system\-property name=\"JVM_HEAP_SIZE\" value=\"$JVMHEAPSIZE\"\>\<\/system\-property\>|" $glassfishfolder/glassfish/domains/$domainname/config/domain.xml
sed -i "s|.*JVM_HEAP_SIZE_XMN\".*|\<system\-property name=\"JVM_HEAP_SIZE_XMN\" value=\"$JVMHEAPSIZEXMN\"\>\<\/system\-property\>|" $glassfishfolder/glassfish/domains/$domainname/config/domain.xml
sed -i "s|.*JVM_PARALLEL_GC_THREADS\".*|\<system\-property name=\"JVM_PARALLEL_GC_THREADS\" value=\"$JVMPARALLELGCTHREADS\"\>\<\/system\-property\>|" $glassfishfolder/glassfish/domains/$domainname/config/domain.xml
sed -i "s|.*MAX_THREAD_POOL_SIZE\".*|\<system\-property name=\"MAX_THREAD_POOL_SIZE\" value=\"$MAXTHREADPOOLSIZE\"\>\<\/system\-property\>|" $glassfishfolder/glassfish/domains/$domainname/config/domain.xml
sed -i "s|.*LargePageSizeInBytes.*|\<jvm\-options\>\-XX\:LargePageSizeInBytes=$LargePageSizeInBytes\<\/jvm\-options\>|" $glassfishfolder/glassfish/domains/$domainname/config/domain.xml

sed -i "s|.*Xmx.[0-9].*|\<jvm\-options\>\-Xmx$JVMHEAPSIZE\<\/jvm\-options\>|" $glassfishfolder/glassfish/domains/$domainname/config/domain.xml
sed -i "s|.*MaxPermSize.*|\<jvm\-options\>\-XX\:MaxPermSize=$JVMHEAPSIZEXMN\<\/jvm\-options\>|" $glassfishfolder/glassfish/domains/$domainname/config/domain.xml

}

editportalext() {

sed -i "s|.*jdbc.default.url.*|jdbc.default.url=jdbc\:mysql\:\/\/$liferaydbip\/$liferaydbname\?useUnicode=true\&characterEncoding=UTF\-8\&useFastDateParsing=false|" $glassfishfolder/glassfish/domains/$domainname/applications/liferay-portal/WEB-INF/classes/portal-ext.properties

sed -i "s|.*jdbc.default.username.*|jdbc.default.username=$liferaydbuser|" $glassfishfolder/glassfish/domains/$domainname/applications/liferay-portal/WEB-INF/classes/portal-ext.properties

sed -i "s|.*jdbc.default.password.*|jdbc.default.password=$liferaydbpass|" $glassfishfolder/glassfish/domains/$domainname/applications/liferay-portal/WEB-INF/classes/portal-ext.properties
}


case "$FUNCTION" in

installglassfish ) installglassfish;;
tmpgs ) tmpgs;;
fabsprop ) fabsprop;;
glassfishtuning ) glassfishtuning;;
editportalext ) editportalext;;
* ) echo "** INVALID FUNCTION NAME ** PLEASE ENTER A VALID FUNCTION NAME";;

esac

exit 0
