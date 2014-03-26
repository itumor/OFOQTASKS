<?php

// change these lines , will make them later comes from phpmaker config file
$dbname = 'generator'; // Database name
$dbuser = 'root'; // Database username
$dbpass = 'root'; // Database password


// Do NOT change unless you know what you are doing.
set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib'); // add phpseclib to include path
include_once 'phpseclib/Net/SFTP.php'; // include ssh & sftp library
include_once 'phpseclib/Crypt/RSA.php';
include_once "NotORM.php"; // include db orm library

$connection = new PDO("mysql:dbname=$dbname", "$dbuser","$dbpass"); // connect to db
$structure = new NotORM_Structure_Discovery($connection, $cache = null, $foreign = '%s'); // get database structure
$ofoq_tasks = new NotORM($connection,$structure); // database structure to php structure
