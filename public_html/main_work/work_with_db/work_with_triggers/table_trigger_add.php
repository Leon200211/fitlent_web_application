<?php


$db = $_POST['db'];
$trigger_name = $_POST['trigger_name'];
if(empty($trigger_name)){
    header("Location: table_trigger.php?db=$db&error=Заполните поле `Название триггера`");
}
$table_name = $_POST['table_name'];
$when = $_POST['trigger_when'];
$event = $_POST['event'];
$trigger_main = $_POST['trigger_main'];
if(empty($trigger_main)){
    header("Location: table_trigger.php?db=$db&error=Заполните поле `Описание`");
}

$sql = "CREATE TRIGGER `$trigger_name` $when $event ON `$table_name` FOR EACH ROW $trigger_main";

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    if(mysqli_query($connect, $sql)){
        header("Location: table_trigger.php?db=$db");
    } else {
        header("Location: table_trigger.php?db=$db&error=$sql");
    }
}







