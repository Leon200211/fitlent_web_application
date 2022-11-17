<?php


$db = $_POST['db'];
$table = $_POST['table'];




$sql =  "OPTIMIZE TABLE `$table`;";
$link = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$link) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    //echo $sql;
    if(mysqli_query($link, $sql)){
        header("Location: table_structure.php?db=$db&table=$table");
    } else {
        header("Location: table_structure.php?db=$db&table=$table");
    }
}
