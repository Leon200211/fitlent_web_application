<?php

$db = $_GET['db'];
$table = $_GET['table'];
$value = $_GET['value'];

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);



$sql = "SHOW COLUMNS FROM `$table`";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result)['Field'];



$sql = "DELETE FROM `$table` WHERE `$table`.`$row` = $value;";
mysqli_query($connect, $sql);
header("Location: show_tables_main_info.php?db=$db&table=$table&ns=25");