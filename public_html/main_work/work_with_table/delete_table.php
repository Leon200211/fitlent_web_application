<?php

$db = $_GET['db'];
$table = $_GET['table'];


$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
}



mysqli_query($connect, "DROP TABLE `$table`");
header("Location: ../show_tables.php?db=" . $db);