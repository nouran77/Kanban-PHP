<?php
require 'db.php';

$task_name = $_POST['task_name'];
$start_time = $_POST['start_time'];
$finish_time = $_POST['finish_time'];
$description = $_POST['description'];

$result = mysqli_query($connection, "INSERT INTO tasks(status, start_time, finish_time, task_name, description)
VALUES ('TODO','$start_time', '$finish_time', '$task_name' ,'$description')");



?>
