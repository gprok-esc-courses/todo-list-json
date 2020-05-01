<?php
header('Content-Type: application/json');
require_once ("display_errors.php");
require_once("task.php");

$tasks = Task::get_incomplete();

echo json_encode($tasks);