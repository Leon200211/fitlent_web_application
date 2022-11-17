<?php



$sql_request = $_POST['sql_request'];



$link = mysqli_connect('127.0.0.1:3307', 'root', 'root');
if (!$link) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    //echo $sql;
    if(mysqli_query($link, $sql_request)){
        header("Location: ../../main.php");
    } else {
        header("Location: sql_request_server.php?error=Неверный запрос $sql_request");
    }
}