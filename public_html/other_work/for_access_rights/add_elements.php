<?php


session_start();
if(empty($_SESSION['user'])){
    echo "Доступ запрещен";
    die;
}



function add_element($db, $type, $name){

    $connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');

    $sql = "INSERT INTO `elements` (`id`, `db`, `type`, `name`) VALUES (NULL, '$db', '$type', '$name')";
    if(mysqli_query($connect, $sql)){
        $link = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');

        $id_element = mysqli_query($connect, "SELECT * FROM `elements` ORDER BY `elements`.`id` DESC");
        $id_element = mysqli_fetch_assoc($id_element);
        $id_element = $id_element['id'];






        $user_sql = "SELECT * FROM `users` WHERE state != 'main_admin'";
        $user_sql_while = mysqli_query($link, $user_sql);
        while ($row_user = mysqli_fetch_assoc($user_sql_while)) {
            $user_id = $row_user['id'];
            $user_name = $row_user['name'];
            $user_state = $row_user['state'];
            $sql_access = "INSERT INTO `access` (`id`, `id_user`, `user_name`, `user_state`, `id_element`, `db_element`, `type_element`, `name_element`, `access_rights`) VALUES (NULL, '$user_id', '$user_name', '$user_state', '$id_element', '$db', '$type', '$name', '+')";
            mysqli_query($link, $sql_access);
        }
        return 1;
    }else{
        return 0;
    }

}

