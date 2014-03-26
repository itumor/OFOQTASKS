<?php
include_once "func_tasks.php";

 // only run if form post 'task_name'
if (isset($_GET['task_name'])){

$task_name = $_GET['task_name'];
$query = create_table_statement($task_name);
$task_func = task_func_statement($task_name);
?>

<!-- start html output -->
<textarea cols="50" rows="20">
<?php echo $query; ?>
</textarea>
</br>
<textarea cols="50" rows="20">
include_once "ofoq_tasks/func_tasks.php";
<?php echo $task_func; ?>
</textarea>
<!-- end html output -->

<?php 
} // end if statement
?>