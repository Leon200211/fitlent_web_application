<?php

$db = $_POST['db'];
$table = $_POST['table'];

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);



//$mas_1 = array();
//$mas_2 = array();

$mas_3 = array();

$q = mysqli_query($connect, "SHOW COLUMNS FROM `$table`");
while($row = mysqli_fetch_array($q)) {
//    $mas_1[] = $row['Field'];
//    $mas_2[] = $_POST[$row['Field']];
    if($_POST[$row['Field']] == ""){
        $mas_3[$row['Field']] = 'NULL';
    }else{
        if(!empty($_POST["fun" . $row['Field']])){
            $mas_3[$row['Field']] = $_POST["fun" . $row['Field']] . "('" . $_POST[$row['Field']] . "')";
        }else{
            $mas_3[$row['Field']] = "'" . $_POST[$row['Field']] . "'";
        }
    }

}


//var_dump($mas_1);
//var_dump($mas_2);


$mas_key = array_keys($mas_3);


$str_1 = implode("`, `", $mas_key);
$str_2 = implode(", ", $mas_3);



$sql = "INSERT INTO `$table` (`" . $str_1 . "`) VALUES (" . $str_2 . ");";


if(mysqli_query($connect, $sql)){
    header("Location: ../show_tables_main_info.php?db=$db&table=$table&ns=25");
} else {
    header("Location: insert_into_table.php?db=$db&table=$table&error=Неверный запрос $sql");
}

