<?php
// include db configuration, db connection , ssh library , db ORM
include_once "connect.inc.php";


function add_new_task($task_name) {
    global $ofoq_tasks; // database container from ORM library at connect.inc.php
    $task = $ofoq_tasks->task("task_name", "$task_name")->fetch(); // get task information

    $update_task['sqlscript'] = create_table_statement($task_name);
    $update_task['phpscript'] = task_func_statement($task_name);
    $task->update($update_task);
  }

/** convert task to scripts , add to cron table for later run
*@param string $task_name
*@param array $parameters
*/

function add_cron_task($task_name,$parameters) {
    global $ofoq_tasks; // database container from ORM library at connect.inc.php
    $task = $ofoq_tasks->task("task_name", "$task_name")->fetch(); // get task information

    $update_task['sqlscript'] = create_table_statement($task_name);
    $update_task['phpscript'] = task_func_statement($task_name);
    $task->update($update_task);
    foreach ($task->task_function_group() AS $task_function_group) { // loop groups inside task

        foreach ($task_function_group->function_group_id->function_group_relation()->order('priority ASC') AS $function_group_relation) {
            $script_path =  $function_group_relation->script_function_id->script_id['script_path'] . ' ';
            $script_function_name  = $function_group_relation->script_function_id['script_function_name'] . "";
            $server_id = 'server_id_' . $function_group_relation->script_function_id->script_id['script_name'];
            $parameter_str = "";
            foreach( $function_group_relation->script_function_id->script_id->parameter() AS $parameter ){
               if ($parameter['parameter_name'] != $server_id ){
                $parameter_str .= $parameters[$parameter['parameter_name']] . ' ';
               }else{
                $server_id = $parameters[$server_id];
               }
           }
           $command_data['command_input'] = $script_path . ' ' . $script_function_name . ' ' . $parameter_str;
           $command_data['command_status'] = 'pending';
           $command_data['command_time'] = date('Y-m-d h:i:s');
           $command_data['task_id'] = $task['task_id'];
           $command_data['user_id'] = null;
           $command_data['command_id'] = null;
           $command_data['server_id'] = $server_id;
		   //print_r($command_data);die;
         $ofoq_tasks->command()->insert($command_data);

        }
    }
    
}

/** array of task parameters
*@param string $task_name
*@return array $parameter_array
*/
function task_parameters($task_name){
    global $ofoq_tasks;
    $task = $ofoq_tasks->task("task_name", "$task_name")->fetch();
    foreach ($task->task_function_group() AS $task_function_group) {
        foreach ($task_function_group->function_group_id->function_group_relation()->order('priority ASC') AS $function_group_relation) {
           foreach( $function_group_relation->script_function_id->script_id->parameter() AS $parameter ){
               $parameter_array[$parameter['parameter_name']] = $parameter['parameter_name'];
           }
        }
    }
    return $parameter_array;
}

/** mysql table query
*@param string $task_name
*@return string of mysql query
*/
function create_table_statement($task_name){
  $task_table_name = preg_replace("^\W^", "_", $task_name); 
  //echo $task_table_name;die;
   $sql = "CREATE TABLE IF NOT EXISTS `{$task_table_name}_task` (
`id` int(11) unsigned NOT NULL auto_increment, \n";
   $parameters = task_parameters($task_name);
   foreach ($parameters as $parameter) {
    $sql .="`$parameter` varchar(255) NOT NULL default '',\n";
   }
   $sql .="
PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

   return $sql;
}

/** generate add_cron_task parameters ready for phpmaker
*@param string $task_name
*@return string of function add_cron_task
*/
function task_func_statement($task_name){
  $parameters = task_parameters($task_name);
  $out = '$parameters = array('. "\n";
  foreach ($parameters as $parameter) {
    $out .= "'$parameter'" . '=>$rsnew["' . $parameter . '"],' . "\n";
  }
  $out .= ');'. "\n";
  $out .= 'add_cron_task("'.$task_name.'",$parameters);';
  return $out;
}

?>
