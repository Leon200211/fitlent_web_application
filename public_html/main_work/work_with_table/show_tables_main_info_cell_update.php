<?php


if(isset($_POST['id']) and isset($_POST['value']) and isset($_POST['table']) and isset($_POST['db'])){
    $id = $_POST['id'];
    $id = explode("_!_", $id);
    $col_name = $id[0];
    $id = $id[1];
    $value = $_POST['value'];
    $db = $_POST['db'];
    $table = $_POST['table'];
    $id_name = $_POST['id_name'];

    $connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
    $sql = "UPDATE `$table` SET $col_name = '$value' WHERE $id_name = '$id';";
    if(mysqli_query ($connect, $sql)){
        echo 'ok';
    }
    else {
        echo $sql;
    }
}
else {
    echo 'error';
}