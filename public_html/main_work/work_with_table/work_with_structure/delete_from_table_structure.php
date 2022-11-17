<?php

$db = $_GET['db'];
$table = $_GET['table'];
$column = $_GET['column'];

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);



$sql = "ALTER TABLE `$table` DROP `$column`;";
mysqli_query($connect, $sql);
header("Location: table_structure.php?db=$db&table=$table");
