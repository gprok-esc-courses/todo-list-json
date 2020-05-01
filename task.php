<?php
require_once ('database.php');

class Task {
    var $id;
    var $name;
    var $completed;


    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->completed = $args['completed'] ?? '';
    }


    public function save()
    {
        global $conn;
        $sql = "INSERT INTO tasks (name) VALUES (:task)";
        $statement = $conn->prepare($sql);
        $statement->execute(['task' => $this->name]);
        $id = $conn->lastInsertId();
        $this->id = $id;
    }

    public function complete()
    {
        global $conn;
        $sql = "UPDATE tasks SET completed=1 WHERE id=:id";
        $statement = $conn->prepare($sql);
        $result = $statement->execute(['id' => $this->id]);
        if($result) {
            $this->completed = 1;
        }
    }

    public static function find($id)
    {
        global $conn;
        $task = new Task();
        $sql = "SELECT * FROM tasks WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();
        if($row) {
            $task->id = $row['id'];
            $task->name = $row['name'];
            $task->completed = $row['completed'];
        }
        return $task;
    }

    public static function get_incomplete()
    {
        global $conn;
        $tasks = [];

        $sql = "SELECT * FROM tasks WHERE completed=0";
        $result = $conn->query($sql, PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $task = new Task(['id' => $row['id'],
                'name' => $row['name'],
                'completed' => $row['completed'] ]);
            $tasks[] = $task;
        }

        return $tasks;
    }
}