<?php
header('Content-Type: application/json');
require_once ("display_errors.php");
require_once("task.php");

$task_name = filter_var($_POST['task'], FILTER_SANITIZE_STRING);

$task = new Task(['name' => $task_name]);
$task->save();

echo json_encode($task);