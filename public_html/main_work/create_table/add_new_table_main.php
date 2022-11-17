<?php


$db = $_POST['db'];
$table_name = $_POST['table_name'];
$count_columns = $_POST['count_columns'];




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
        $columns_properties .= '`' . $column_name. '` ' . $type . $Length . ' ' . $attribute . $comparison . $virtual . $null . ' ' . $default . $a_i . $comment;
    } else {
        $columns_properties .= ', `' . $column_name. '` ' . $type . $Length . ' ' . $attribute . $comparison . $virtual . $null . ' ' . $default . $a_i . $comment;
    }
}


$pk .= ')'; // закрываем ключ
if(strlen($pk) == 14){
    $pk = '';
}else {
    $pk = ", " . $pk;
}


if(!empty($_POST['comm_to_table'])){
    $comm_to_table = " COMMENT '" . $_POST['comm_to_table'] . "'";
} else {
    $comm_to_table = '';
}
if(!empty($_POST['crav'])){
    $crav = $_POST['crav'];
    if($crav == 'binary') {
        $crav = ' CHARSET=' . $crav;
    }else {
        $crav_1 = explode("_", $crav);
        $crav_1 = $crav_1[0];
        $crav = ' CHARSET=' . $crav_1 . ' COLLATE ' . $crav;
    }
} else {
    $crav = '';
}

$type_table = ') ENGINE = ' . $_POST['type_table'];



$sql =  "CREATE TABLE `$db`.`$table_name` (" . $columns_properties . $pk . $type_table . $crav . $comm_to_table . ';';


$path = $_SERVER['DOCUMENT_ROOT'];



$link = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$link) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    //echo $sql;
    if(mysqli_query($link, $sql)){
        # настраиваем права доступа
        $path = $_SERVER['DOCUMENT_ROOT'];
        require_once($path . '/for_access_rights/add_elements.php');
        if(add_element($db, "table", $table_name)){
            header("Location: ../show_tables.php?db=$db");
        }else{
            $link = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
            $sql = "DROP TABLE `$table_name`;";
            mysqli_query($link, $sql);
            header("Location: add_new_table.php?db=$db&table=$table_name&count_columns=$count_columns&error=Внутренняя ошибка сервера");
        }
    } else {
        header("Location: add_new_table.php?db=$db&table=$table_name&count_columns=$count_columns&error=Неверный запрос $sql");
    }
}


