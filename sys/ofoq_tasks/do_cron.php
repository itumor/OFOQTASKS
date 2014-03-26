<?php

// set time limit to run in background for every
set_time_limit(0);

// include db configuration, db connection , ssh library , db ORM
include_once "connect.inc.php";

// execute the cron function
do_cron();


/** do cron function
* get cron from database table
* connect to server id
* do the command into server ssh
* gt the output into the table
*/

function do_cron(){
  global $ofoq_tasks;
  // loop for each command in table
  foreach( $ofoq_tasks->command('command_status','pending') AS $command ){

        //get server login information
  		$hostname = $command->server_id['server_hostname'];
		$ssh = new Net_SSH2("$hostname");
        $server_password = $command->server_id['server_password'];
        $server_username = $command->server_id['server_username'];
        if($command->server_id['server_auth_type']=='file' AND $command->server_id['server_file']){
        $key = new Crypt_RSA();
        $key->loadKey(file_get_contents($command->server_id['server_file']));
        $server_password = $key;
        }
        // if login faild , log error to database command row
        if (!$ssh->login($server_username, $server_password)) {
        	$update['server_id'] = $command['server_id'];
        	$update['command_output'] = 'ssh login Failed';
        	$update['command_status'] = 'failed';
        	$command->update($update);
        } else{
            // if login success , do the command and log output to database command row
        	$command_input = $command['command_input'];
        	$update['server_id'] = $command['server_id'];
        	$update['command_output'] = $ssh->exec("./$command_input");
        	$update['command_status'] = 'executed';
        	$command->update($update);
        }
  }
}

?>