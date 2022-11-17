<?php

$db = $_GET['db'];
$name = $_GET['name'];


$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
}



mysqli_query($connect, "DROP TRIGGER $name;");
header("Location: table_trigger.php?db=$db");