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

    $sql_add_user_examination = $admin_panel_connect->query("SELECT * FROM users WHERE `name` = '{$user[0]}'");
    if(!$sql_add_user_examination->num_rows){
        $sql_add_user = "INSERT INTO  users (`id`, `name`, `login`, `pass`, `state`, `connection_name`, `connection_password`)
                     VALUES (NULL, '{$user[0]}', '{$user[0]}', '-', 'user', '{$user[0]}', '-')";
        $admin_panel_connect->query($sql_add_user);
    }

}





// достаем список всех БД и заносим их и их содержимое
$databases_list = $server_connection->query("SHOW DATABASES");
$databases_list = $databases_list->fetch_all();
foreach ($databases_list as $database){


    // добавление баз данных
    $sql_add_databases_examination = $admin_panel_connect->query("SELECT * FROM elements WHERE `type` = 'database' AND `name` = '{$database[0]}'");
    if(!$sql_add_databases_examination->num_rows){
        $sql_add_databases = "INSERT INTO elements (`id`, `db`, `type`, `name`)
                     VALUES (NULL, '{$database[0]}', 'database', '{$database[0]}')";
        $admin_panel_connect->query($sql_add_databases);
    }



    // подключение к новым базам данных
    $database_tables = new mysqli($_SESSION['connection']['hostname'], $_SESSION['connection']['user_name'], $_SESSION['connection']['password'], "$database[0]");


    // вывод всех таблиц из базы данных
    $tables_list = $database_tables->query("SHOW TABLES");
    $tables_list = $tables_list->fetch_all();
    foreach ($tables_list as $table){
        // добавление таблиц
        $sql_add_table_examination = $admin_panel_connect->query("SELECT * FROM elements WHERE `type` = 'table' AND `name` = '{$table[0]}'");
        if(!$sql_add_table_examination->num_rows){
            $sql_add_table = "INSERT INTO elements (`id`, `db`, `type`, `name`)
                     VALUES (NULL, '{$table[0]}', 'table', '{$table[0]}')";
            $admin_panel_connect->query($sql_add_table);
        }
    }



    // вывод всех триггер
    $trigger_list = $database_tables->query("SHOW TRIGGERS");
    $trigger_list = $trigger_list->fetch_all();
    foreach ($trigger_list as $trigger){
        // добавление триггеров
        $sql_add_trigger_examination = $admin_panel_connect->query("SELECT * FROM elements WHERE `type` = 'trigger' AND `name` = '{$trigger[0]}'");
        if(!$sql_add_trigger_examination->num_rows){
            $sql_add_trigger = "INSERT INTO elements (`id`, `db`, `type`, `name`)
                     VALUES (NULL, '{$table[0]}', 'trigger', '{$trigger[0]}')";
            $admin_panel_connect->query($sql_add_trigger);
        }
    }



}


// вывод всех процедур
$procedure_list = $database_tables->query("show PROCEDURE STATUS;");
$procedure_list = $procedure_list->fetch_all();
foreach ($procedure_list as $procedure){
    // добавление процедур
    $sql_add_procedure_examination = $admin_panel_connect->query("SELECT * FROM elements WHERE `type` = 'procedure' AND `name` = '{$procedure[0]}'");
    if(!$sql_add_procedure_examination->num_rows){
        $sql_add_procedure = "INSERT INTO elements (`id`, `db`, `type`, `name`)
                     VALUES (NULL, '{$procedure[0]}', 'procedure', '{$procedure[1]}')";
        $admin_panel_connect->query($sql_add_procedure);
    }
}

