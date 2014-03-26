<?php

include_once "func_tasks.php";
$parameters = array(
'server_id_mysql'=>$rsnew["server_id_mysql"],
'mysql_username'=>$rsnew["mysql_username"],
'mysql_password'=>$rsnew["mysql_password"],
'mysql_db_name'=>$rsnew["mysql_db_name"],
'mysql_file_path'=>$rsnew["mysql_file_path"],
);
add_cron_task("drop mysql","$parameters");


?>
