<?php
require 'db.php';

$status = $_POST['status'];

$queryUpdate = mysqli_connect($connection, "UPDATE tasks SET status = '$status'");
?>
