<?php


$db = $_POST['db'];
$table_name = $_POST['table'];
$sql_request = $_POST['sql_request'];




$link = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$link) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    //echo $sql;
    if(mysqli_query($link, $sql_request)){
        header("Location: ../show_tables_main_info.php?db=$db&table=$table_name&ns=25");
    } else {
        header("Location: sql_request_table.php?db=$db&table=$table_name&error=Неверный запрос $sql_request");
    }
}