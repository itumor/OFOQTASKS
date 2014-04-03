#!/bin/bash


FUNCTION=$1
USERNAME=$2
PASSFILE=$3
JDBCNAME=$4
DBS_JDBC=$5


Addpool() {
liferay/bin/asadmin --user $USERNAME --passwordfile $PASSFILE create-jdbc-connection-pool --datasourceclassname com.mysql.jdbc.jdbc2.optional.MysqlConnectionPoolDataSource --restype javax.sql.ConnectionPoolDataSource --property User=root:EnableQueryTimeouts=true:UseInformationSchema=false:AutoReconnectForPools=true:NoAccessToProcedureBodies=false:LoggerClassName=com.mysql.jdbc.log.StandardLogger:UltraDevHack=false:ServerName=1.1.1.189:AllowMultiQueries=false:FunctionsNeverReturnBlobs=false:SlowQueryThresholdNanos=0:StrictUpdates=true:IgnoreNonTxTables=false:Url="jdbc\:\/\/1.1.1.141\:3306\$DBS_JDBC":AutoClosePStmtStreams=false:TinyInt1isBit=true:HoldResultsOpenOverStatementClose=false:LoadBalanceStrategy=random:UseUsageAdvisor=false:StrictFloatingPoint=false:TraceProtocol=false:YearIsDateType=true:CachePrepStmts=false:TransformedBitIsBoolean=false:ProfileSQL=false:UseOldUTF8Behavior=false:PadCharsWithSpace=false:TreatUtilDateAsTimestamp=true:UseNanosForElapsedTime=false:UseDynamicCharsetInfo=true:TcpSndBuf=0:CallableStatementCacheSize=100:SocketFactory=com.mysql.jdbc.StandardSocketFactory:Port=3306:UseSqlStateCodes=true:InitialTimeout=2:DumpMetadataOnColumnNotFound=false:DontTrackOpenResources=false:AllowUrlInLocalInfile=false:DatabaseName=mikedb:UseReadAheadInput=true:NullNamePatternMatchesAll=true:Password=root:AllowLoadLocalInfile=true:PreparedStatementCacheSqlLimit=256:PacketDebugBufferSize=20:BlobsAreStrings=false:Logger=com.mysql.jdbc.log.StandardLogger:PrepStmtCacheSize=25:ProcessEscapeCodesForPrepStmts=true:AutoGenerateTestcaseScript=false:AlwaysSendSetIsolation=true:UseOldAliasMetadataBehavior=true:UseServerPrepStmts=false:CallableStmtCacheSize=100:CapitalizeTypeNames=true:UseServerPreparedStmts=false:LocatorFetchBufferSize=1048576:PrepStmtCacheSqlLimit=256:URL="jdbc\:\/\/1.1.1.141\:3306\/$DBS_JDBC":PortNumber=3306:UseJDBCCompliantTimezoneShift=false:CachePreparedStatements=false:UseSSL=false:Paranoid=false:JdbcCompliantTruncationForReads=true:UseJvmCharsetConverters=false:TcpRcvBuf=0:UseSSPSCompatibleTimezoneShift=false:DefaultFetchSize=0:CacheCallableStatements=false:NoTimezoneConversionForTimeType=false:UseCompression=false:GenerateSimpleParameterMetadata=false:UseUltraDevWorkAround=false:UseTimezone=false:CacheServerConfiguration=false:InteractiveClient=false:QueriesBeforeRetryMaster=50:UseFastIntParsing=true:AutoDeserialize=false:MaxRows=-1:SecondsBeforeRetryMaster=30:MaxReconnects=3:EmulateLocators=false:Pedantic=false:UseUnicode=true:SlowQueryThresholdMillis=2000:RelaxAutoCommit=false:TcpTrafficClass=0:ZeroDateTimeBehavior=exception:ClobberStreamingResults=false:IncludeInnodbStatusInDeadlockExceptions=false:ReconnectAtTxEnd=false:DynamicCalendars=false:TcpKeepAlive=true:NoDatetimeStringSync=false:MetadataCacheSize=50:LoginTimeout=0:UseCursorFetch=false:EmulateUnsupportedPstmts=true:NullCatalogMeansCurrent=true:ExplainSlowQueries=false:UseStreamLengthsInPrepStmts=true:ConnectTimeout=0:RetainStatementAfterResultSetClose=false:LogSlowQueries=false:EmptyStringsConvertToZero=true:AllowNanAndInf=false:FailOverReadOnly=true:MaxQuerySizeToLog=2048:RunningCTS13=false:JdbcCompliantTruncation=true:DumpQueriesOnException=false:IsInteractiveClient=false:ResultSetSizeThreshold=100:RollbackOnPooledClose=true:UseLocalSessionState=false:RoundRobinLoadBalance=false:CacheCallableStmts=false:UseFastDateParsing=true:ContinueBatchOnError=true:BlobSendChunkSize=1048576:OverrideSupportsIntegrityEnhancementFacility=false:ElideSetAutoCommits=false:GatherPerformanceMetrics=false:PreparedStatementCacheSize=25:GatherPerfMetrics=false:UseOnlyServerErrorMessages=true:TcpNoDelay=true:LogXaCommands=false:RewriteBatchedStatements=false:CreateDatabaseIfNotExist=false:ReportMetricsIntervalMillis=30000:PopulateInsertRowWithDefaultValues=false:SocketFactoryClassName=com.mysql.jdbc.StandardSocketFactory:MaintainTimeStats=true:UseHostsInPrivileges=true:UseUnbufferedInput=true:UseGmtMillisForDatetimes=false:RequireSSL=false:PinGlobalTxToPhysicalConnection=false:SocketTimeout=0:EnablePacketDebug=false:CacheResultSetMetadata=false:ProfileSql=false:‎characterEncoding=UTF-8 $JDBCNAME
}

deletepool() {
liferay/bin/asadmin --user $USERNAME --passwordfile $PASSFILE delete-jdbc-connection-pool $JDBCNAME
}

addresource() {
liferay/bin/asadmin --user $USERNAME --passwordfile $PASSFILE create-jdbc-resource --connectionpoolid $DBS_JDBC jdbc/$JDBCNAME
}

deleteresource() {
liferay/bin/asadmin --user $USERNAME --passwordfile $PASSFILE delete-jdbc-resource jdbc/$JDBCNAME
} 


case "$FUNCTION" in

addpool ) addpool;;
deletepool ) deletepool;;
addresource ) addresource;;
deleteresource ) deleteresource;;
* ) echo "** INVALID FUNCTION NAME ** PLEASE ENTER A VALID FUNCTION NAME";;

esac


exit 0