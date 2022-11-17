<?php

$id = $_GET['id'];

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');


$sql = "DELETE FROM `users` WHERE `users`.`id` = $id;";
mysqli_query($connect, $sql);
header("Location: ../rights_for_users.php");