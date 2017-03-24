<?php
$host = "localhost";
$user = "root";
$password = "root";
$db_name = "todo";
$connection = mysqli_connect($host , $user , $password , $db_name);
 if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
 }
 //echo "Connected successfully";


 ?>
