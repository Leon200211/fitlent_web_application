<?php


$db = $_POST['db'];
$trigger_name = $_POST['trigger_name'];
if(empty($trigger_name)){
    header("Location: table_trigger_update.php?db=$db&name=$trigger_name&error=Ошибка изменения триггера $trigger_name не заполнено поле `Название триггера`");
}
$table_name = $_POST['table_name'];
$when = $_POST['trigger_when'];
$event = $_POST['event'];
$trigger_main = $_POST['trigger_main'];
if(empty($trigger_main)){
    header("Location: table_trigger_update.php?db=$db&name=$trigger_name&error=Ошибка изменения триггера $trigger_name не заполнено поле `Описание`");
}
$sql = "DROP TRIGGER IF EXISTS `$trigger_name`;";
$sql_2 = "CREATE TRIGGER `$trigger_name` $when $event ON `$table_name` FOR EACH ROW $trigger_main;";



//$mysqli = new mysqli('127.0.0.1:3307', 'root', 'root', $db);
//$mysqli->multi_query($sql);
//do {
//    if ($result = $mysqli->store_result()) {
//        var_dump($result->fetch_all(MYSQLI_ASSOC));
//        $result->free();
//    }
//} while ($mysqli->next_result());




$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    if(mysqli_query($connect, $sql)){
        if(mysqli_query($connect, $sql_2)) {
            header("Location: table_trigger.php?db=$db");
        } else {
            header("Location: table_trigger_update.php?db=$db&name=$trigger_name&error=$sql_2");
        }
    } else {
        header("Location: table_trigger_update.php?db=$db&name=$trigger_name&error=$sql");
    }
}







