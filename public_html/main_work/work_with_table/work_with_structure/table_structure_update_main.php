<?php


$db = $_POST['db'];
$table_name = $_POST['table_name'];
$column= $_POST['column'];




// переменные нужные в цикле
$columns_properties = '';  // подзапрос
$a_i_key = 0;


$new_column = $_POST['column_name'];


// тип данных в столбце
$type = $_POST['type'];



// длина значения
// для некоторых типов данных длину не устанавливаем
if(!empty($_POST['Length/Values'])){
    $Length = '(' . $_POST['Length/Values'] . ')';
} else {
    $Length = '';
}



// значение по умолчанию
$default = $_POST['default'];
if($default == 'Как определено:'){
    $default_show = $_POST['default_show'];
    $default = 'DEFAULT ' . "'" . $default_show . "'";
} else if($default == 'NULL') {
    $default = 'DEFAULT NULL';
}  else if($default == 'CURRENT_TIMESTAMP') {
    $default = 'DEFAULT CURRENT_TIMESTAMP';
} else {
    $default = '';
}




// сравнение
if(!empty($_POST['comparison'])){
    $comparison = $_POST['comparison'];
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
if(!empty($_POST['attribute'])){
    $attribute = $_POST['attribute'] . ' ';
} else {
    $attribute = '';
}


// быть Null
if(isset($_POST['Null'])){
    $null = 'NULL';
} else {
    if($default == 'DEFAULT NULL'){
        $null = 'NULL';
    }
    else {
        $null = 'NOT NULL';
    }
}








// А_I

if(isset($_POST['A_I'])){
    $a_i = ' AUTO_INCREMENT, add PRIMARY KEY (`' . $new_column . '`)';
    $a_i_key = 1;
} else {
    $a_i = '';
}




// комментарий
if(!empty($_POST['comment'])){
    $comment = ' COMMENT ' . "'" . $_POST['comment'] . "'";
} else {
    $comment = '';
}


// виртуальность
//if(!empty($_POST['virtual'])){
//    $virtual = $_POST['virtual'];
//    $virtual_show = $_POST['virtual_show'];
//    if($virtual == 'VIRTUAL'){
//        $virtual = ' AS (' . $virtual_show . ') VIRTUAL ';
//        $default = '';
//    } else {
//        $virtual = ' AS (' . $virtual_show . ') STORED ';
//        $default = '';
//    }
//} else {
//    $virtual = '';
//}



// формируем подзапрос
if(strlen($columns_properties) == 0){
    $columns_properties .= '`' . $new_column . '` ' . $type . $Length . ' ' . $attribute . $comparison . $null . ' ' . $default . $a_i . $comment;
} else {
    $columns_properties .= ', `' . $new_column . '` ' . $type . $Length . ' ' . $attribute . $comparison . $null . ' ' . $default . $a_i . $comment;
}





$sql =  "ALTER TABLE `$table_name` CHANGE `$column` $columns_properties;";


$link = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$link) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    //echo $sql;
    if(mysqli_query($link, $sql)){
        header("Location: table_structure.php?db=$db&table=$table_name");
    } else {
        header("Location: table_structure_update.php?db=$db&table=$table_name&column=$column&error=Неверный запрос $sql");
    }
}


