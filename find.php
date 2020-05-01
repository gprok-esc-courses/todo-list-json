<?php
header('Content-Type: application/json');
require_once ("display_errors.php");
require_once("task.php");

$tid = filter_var($_GET['id'], FILTER_SANITIZE_STRING);

$task = Task::find($tid);

echo json_encode($task);