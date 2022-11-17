<?php

#=================================================
# файл для создание процедуры
#=================================================



$db = $_POST['db']; // база данных

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);

$procedure_name = $_POST['procedure_name'];  // имя процедуры

$procedure_type = $_POST['procedure_type']; // тип процедуры


if($procedure_type == 'PROCEDURE'){
    $main_sql_type = "( ";
    $main_sql_type .= $_POST['options_direction_1'] . " `" . $_POST['options_name_1'] . "` " . $_POST['options_type_1'];
    for($i = 2; $i < 12; $i++){
        if(!empty(@$_POST['options_direction_' . $i])){
            $options_direction[] = @$_POST['options_direction_' . $i]; // направление
            $options_name[] = @$_POST['options_name_' . $i]; // имя переменной
            $options_type[] = @$_POST['options_type_' . $i]; // тип переменной
            $len[] = @$_POST['len_' . $i]; // длина значения
            $options_option[] = @$_POST['options_option_' . $i]; // параметры

            $main_sql_type .= ", " . @$_POST['options_direction_' . $i] . " `" . @$_POST['options_name_' . $i] . "` " . @$_POST['options_type_' . $i];
        }
    }
    $main_sql_type .= ")";

}else if($procedure_type == '2'){
    for($i = 1; $i < 12; $i++){
        $options_name[] = @$_POST['options_name_' . $i]; // имя переменной
        $options_type[] = @$_POST['options_type_' . $i]; //  тип переменной
        $len[] = @$_POST['len_' . $i]; // длина переменной
        $options_option[] = @$_POST['options_option_' . $i]; // параметры
    }

    $return_type = $_POST['return_type'];  // Возвращаемый тип
    $return_len = $_POST['return_len'];  // Длина возвращаемого значения
    $return_option = $_POST['return_option']; // Вернуть параметры
}


$definition = $_POST['definition']; // определение
if(@!empty($_POST['definition_che'])){
    $definition_che = " DETERMINISTIC"; // определяющий
}else{
    $definition_che = " NOT DETERMINISTIC"; // определяющий
}
$determinant = $_POST['determinant']; // определитель
$options_option = $_POST['options_option']; // тип безопасности
$access_data = $_POST['access_data']; // Доступ к SQL данным

if(@!empty($_POST['comm'])){
    $comm = " COMMENT '". $_POST['comm'] . "'"; // комментарий
}else{
    $comm = ""; // комментарий
}

if($procedure_type == 'PROCEDURE'){
    $sql = "CREATE $procedure_type `$procedure_name`" . $main_sql_type . $comm . $definition_che . " " . $access_data . " SQL SECURITY " . $options_option . " " . $definition . ";";
    mysqli_query($connect, $sql);
    header("Location: table_procedures.php?db=$db");
}