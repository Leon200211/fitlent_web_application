<?php


$db = $_POST['db'];
$sql_request = $_POST['sql_request'];




$link = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$link) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    //echo $sql;
    if(mysqli_query($link, $sql_request)){
        header("Location: ../../show_tables.php?db=$db");
    } else {
        header("Location: sql_request_db.php?db=$db&error=Неверный запрос $sql_request");
    }
}