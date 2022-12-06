<?php

#==========================================================================
# СИНХРАНИЗИРУЕМ ДАННЫЕ С СЕРВЕРА С НАШЕЙ СРЕДОЙ
#==========================================================================


// достаем всех пользователей из бд

// достаем список всех БД и заносим их в список
    // проходимся по всех таблицам в этой БД
    // проходимся по всех триггерам в этой БД
    // проходимся по всех событиям в этой БД
    // проходимся по всех функциям в этой БД






session_start();

// проверка на админа


// подключение к серверу
$server_connection = new mysqli($_SESSION['connection']['hostname'], $_SESSION['connection']['user_name'], $_SESSION['connection']['password']);
if($server_connection->connect_errno){
    die('Ошибка подключения');
}
// подключение к среде
$admin_panel_connect = new mysqli($_SESSION['connection']['hostname'], $_SESSION['connection']['user_name'], $_SESSION['connection']['password'], 'admin_panel');
if($admin_panel_connect->connect_errno){
    die('Ошибка подключения');
}



// достаем всех пользователь с сервера
$user_list = $server_connection->query("SELECT User, Host FROM mysql.user;");
$user_list = $user_list->fetch_all();


// добавляем всех пользователей сервера в нашу среду
foreach ($user_list as $user){
    $sql_add_user = "INSERT INTO  users (`name`, `login`, `pass`, `state`, `connection_name`, `connection_password`)
                     SELECT '{$user[0]}', '{$user[0]}', '-', 'user', '{$user[0]}', '-' FROM users WHERE NOT exists 
                     (SELECT name FROM users WHERE name = '{$user[0]}') LIMIT 1";
    $admin_panel_connect->query($sql_add_user);
}





// достаем список всех БД и заносим их в список
$databases_list = $server_connection->query("SHOW DATABASES");
$databases_list = $databases_list->fetch_all();
foreach ($databases_list as $database){

    $sql_add_databases = "INSERT INTO elements (`db`, `type`, `name`)
                     SELECT '{$database[0]}', 'database', '{$database[0]}' FROM elements WHERE NOT exists 
                     (SELECT name FROM elements WHERE name = '{$database[0]}' and type = 'database' and db = '{$database[0]}') LIMIT 1";
    var_dump($sql_add_databases);
    $admin_panel_connect->query($sql_add_databases);

    ?>
    <br>
    <br>
    <br>
    <?php
}



