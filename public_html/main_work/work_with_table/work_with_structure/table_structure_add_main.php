<?php


$db = $_POST['db'];
$table_name = $_POST['table'];
$count_columns = $_POST['count_pol'];
$after = $_POST['after'];
$after_1 = $_POST['after'];




// переменные нужные в цикле
$columns_properties = '';  // подзапрос
$pk = 'PRIMARY KEY ('; // primary key
$a_i_key = 0;

for($i = 0; $i < $count_columns; $i++){


    // имя столбца
    $column_name = $_POST['column_name' . $i];



    // тип данных в столбце
    $type = $_POST['type' . $i];



    // длина значения
    // для некоторых типов данных длину не устанавливаем
    if(!empty($_POST['Length/Values' . $i])){
        $Length = '(' . $_POST['Length/Values' . $i] . ')';
    } else {
        $Length = '';
    }



    // значение по умолчанию
    $default = $_POST['default'.$i];
    if($default == 'Как определено:'){
        $default_show = $_POST['default_show'.$i];
        $default = 'DEFAULT ' . "'" . $default_show . "'";
    } else if($default == 'NULL') {
        $default = 'DEFAULT NULL';
    }  else if($default == 'CURRENT_TIMESTAMP') {
        $default = 'DEFAULT CURRENT_TIMESTAMP';
    } else {
        $default = '';
    }




    // сравнение
    if(!empty($_POST['comparison'.$i])){
        $comparison = $_POST['comparison'.$i];
        $comparison_1 = explode("_", $comparison);
        $comparison_1 = $comparison_1[0];
        $array_of_suitable_types = ['VARCHAR', 'TEXT', 'CHAR', 'TINYTEXT', 'MEDIUMTEXT', 'LONGTEXT', 'ENUM', 'SET'];
        if (in_array($type, $array_of_suitable_types) and $comparison_1 == 'binary') {
            $comparison = 'CHARACTER SET ' . $comparison_1 . ' ';
        }
        else if(in_array($type, $array_of_suitable_types)){
            $comparison = 'CHARACTER SET ' . $comparison_1 . ' COLLATE ' . $comparison . ' ';
        }else {
            $comparison = '';
        }
    } else {
        $comparison = '';
    }



    // Атрибуты
    if(!empty($_POST['attribute'.$i])){
        $attribute = $_POST['attribute'.$i] . ' ';
    } else {
        $attribute = '';
    }


    // быть Null
    if(isset($_POST['Null' . $i])){
        $null = 'NULL';
    } else {
        if($default == 'DEFAULT NULL'){
            $null = 'NULL';
        }
        else {
            $null = 'NOT NULL';
        }
    }






    // индексы
    // сложно
    // primary
    if(!empty($_POST['index'.$i])){
        $index = $_POST['index'.$i];
        if($index == 'PRIMARY'){
            if(strlen($pk) == 13){
                $pk .= '`' . $column_name . '`';
            } else {
                $pk .= ', `' . $column_name . '`';
            };
        }

    } else {
        $index = '';
    }


    // А_I
    // связано с primary
    if(isset($_POST['A_I' . $i])){
        if(!empty($_POST['index'.$i]) and $_POST['index'.$i] == 'PRIMARY'){
            if($a_i_key == 0){
                $a_i = ' AUTO_INCREMENT';
                $a_i_key = 1;
            } else {
                $a_i = '';
            }
        } else{
            $a_i = '';
        }
    } else {
        $a_i = '';
    }




    // комментарий
    if(!empty($_POST['comment' . $i])){
        $comment = ' COMMENT ' . "'" . $_POST['comment' . $i] . "'";
    } else {
        $comment = '';
    }


    // виртуальность
    if(!empty($_POST['virtual' . $i])){
        $virtual = $_POST['virtual' . $i];
        $virtual_show = $_POST['virtual_show' . $i];
        if($virtual == 'VIRTUAL'){
            $virtual = ' AS (' . $virtual_show . ') VIRTUAL ';
            $default = '';
        } else {
            $virtual = ' AS (' . $virtual_show . ') STORED ';
            $default = '';
        }
    } else {
        $virtual = '';
    }



    // формируем подзапрос
    if(strlen($columns_properties) == 0){
        $columns_properties .= 'ADD `' . $column_name . '` ' . $type . $Length . ' ' . $attribute . $comparison . $virtual . $null . ' ' . $default . $a_i . $comment . " AFTER `" . $after . "`";
        $after = $column_name;
    } else {
        $columns_properties .= ', ADD `' . $column_name . '` ' . $type . $Length . ' ' . $attribute . $comparison . $virtual . $null . ' ' . $default . $a_i . $comment . " AFTER `" . $after . "`";
        $after = $column_name;
    }
}


$pk .= ')'; // закрываем ключ
if(strlen($pk) == 14){
    $pk = '';
}else {
    $pk = ", " . $pk;
}



$sql =  "ALTER TABLE `$table_name`  $columns_properties;";




$link = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$link) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    if(mysqli_query($link, $sql)){
        header("Location: table_structure.php?db=$db&table=$table_name");
    } else {
        header("Location: table_structure_add.php?db=$db&table=$table_name&count_pol=$count_columns&after=$after_1&error=Неверный запрос $sql");
    }
}


