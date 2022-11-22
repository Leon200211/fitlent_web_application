<?php


#=============================================================
# Изменение настроек для пользователя на определенный элемент
#=============================================================


$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');

// тип элемента с которым мы будем работать
$type = $_POST['type'];


if($type == 'database'){
    $id_user = $_POST['id_user'];  // id пользователя
    $db = $_POST['db'];   // название базы данных
    $id_element = $_POST['id_element'];

    $mas_access_rights = ['v', 'd', 'vis_z', 'SQL_r', 'd_s', 'ex', 'im', 'c_t', 'v_t', 'v_e', 'v_p', 'c_t', 'c_e',
        'c_p', 'v_d', 'c_d'];

}else if($type == 'table'){
    $id_user = $_POST['id_user'];
    $db = $_POST['db'];   // название базы данных
    $id_element = $_POST['id_element'];

    $mas_access_rights = ['d', 'v_s', 'u_s', 'ex', 'im', 'ad_t', 'up_t', 'd_t', 's_t', 'SQL_r', 'v_t', 'vis_z'];
}


// строка прав доступа
$sql_access = '';

foreach ($mas_access_rights as $right){
    if(!empty($_POST[$right])){
        $sql_access .= $right . '-';
    }
}

// удаление последнего символа "-"
$sql_access = substr($sql_access,0,-1);



$sql = "UPDATE `access` SET `access_rights` = '$sql_access' WHERE `access`.`id` = '$id_element';";
if(mysqli_query($connect, $sql)){
    header("Location: setting_access_rights.php?id_user=$id_user");
}

