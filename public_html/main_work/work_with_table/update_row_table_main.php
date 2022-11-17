<?php

$db = $_POST['db'];
$table = $_POST['table'];
$value = $_POST['value'];

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);



$mas_1 = array();
$mas_2 = array();

$q = mysqli_query($connect, "SHOW COLUMNS FROM `$table`");
while($row = mysqli_fetch_array($q)) {
    $mas_1[] = $row['Field'];
    if($_POST[$row['Field']] == ""){
        $mas_2[] = 'NULL';
    }else{
        $mas_2[] = "'" . $_POST[$row['Field']] . "'";
    }

}


//var_dump($mas_1);
//var_dump($mas_2);
$table_id = $mas_1[0];

$sql_str = "`" . $mas_1[0] . "` = " . $mas_2[0];

for($i = 1; $i < count($mas_1); $i++){
    $sql_str .= ", `" . $mas_1[$i] . "` = " . $mas_2[$i];
}




$sql = "UPDATE `$table` SET " . $sql_str . " WHERE `$table`.`$table_id` = $value";


if(mysqli_query($connect, $sql)){
    header("Location: show_tables_main_info.php?db=$db&table=$table&ns=25");
} else {
    header("Location: update_row_table.php?db=$db&table=$table&value=$value&error=Неверный запрос $sql");
}

