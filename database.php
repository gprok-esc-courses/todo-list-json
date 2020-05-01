<?php

$conn = new PDO("mysql:host=localhost;dbname=todo_php1", "test", "test");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
