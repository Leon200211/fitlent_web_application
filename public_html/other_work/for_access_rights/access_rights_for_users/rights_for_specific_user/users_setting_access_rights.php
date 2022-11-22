<?php


#=============================================================
# Выбор настроек для пользователя на определенный элемент
# Переход в users_setting_access_rights_main.php
#=============================================================



$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');


// тип элемента с которым мы будем работать
$type = $_GET['type'];


if($type == 'database'){
    $id_user = $_GET['id_user'];  // id пользователя

    $db = $_GET['db'];   // название базы данных

    $title = " в Базе данных - $db";

    $mas_title_1 = ['Просматривать', 'Удалить', 'Зона видимости', 'SQl запрос к БД', 'Поиск по БД', 'Экспорт', 'Импорт',
        'Создавать таблицы'];
    $mas_title_2 = ['Просматривать Триггеры', 'Просматривать События', 'Просматривать Процедуры', 'Создавать Триггеры',
        'Создавать События', 'Создавать Процедуры', 'Просматривать Дизайн', 'Создавать Дизайн'];

    $mas_body_1 = ['v', 'd', 'vis_z', 'SQL_r', 'd_s', 'ex', 'im', 'c_t'];
    $mas_body_2 = ['v_t', 'v_e', 'v_p', 'c_t', 'c_e', 'c_p', 'v_d', 'c_d'];



}else if($type == 'table'){
    $id_user = $_GET['id_user'];

    $db = $_GET['db'];   // название базы данных
    $table = $_GET['table'];  // название таблицы

    $title = " в Базе данных - $db Таблицы - $table";

    $mas_title_1 = ['Удалять', 'Смотреть структуру', 'Изменять структуру', 'Экспорт', 'Импорт', 'Добавлять в таблицу'];
    $mas_title_2 = ['Изменять в таблице', 'Удалять из таблицы', 'Поиск по таблице', 'SQL запрос к таблице',
        'Просмотр содержимого таблицы', 'Зона видимости'];

    $mas_body_1 = ['d', 'v_s', 'u_s', 'ex', 'im', 'ad_t'];
    $mas_body_2 = ['up_t', 'd_t', 's_t', 'SQL_r', 'v_t', 'vis_z'];

}


$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');
$sql = "SELECT `name` FROM users WHERE id = '$id_user';";
$user_name = mysqli_query($connect, $sql);
$user_name = mysqli_fetch_assoc($user_name);

?>




<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">


    <link rel="stylesheet" href="../../../../assets/css/style_main.css">
    <link rel="stylesheet" href="../../../../assets/css/style_header.css">
    <link rel="stylesheet" href="../../../../assets/css/style_for_trigger.css">



    <title>Главная страница</title>

    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
</head>

<body>

<div class="main_body">
    <div>
        <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        include($path . '/header.php');
        ?>
    </div>


    <div class="main_info" style="margin-left: 200px;">


        <div>
            <a href="setting_access_rights.php?id_user=<?=$id_user?>">Назад</a>
        </div>


        <h1>Настройка прав доступа для пользователя - <?=$user_name['name'] . " " . $title?></h1>



        <?php
        // получаем id элемента из таблицы всех элементов
        $sql_id_el = "SELECT `id` FROM `elements` WHERE `type` = '$type' AND `db` = '$db' AND `name` = '$table';";
        $id_el = mysqli_query($connect, $sql_id_el);
        $id_el = mysqli_fetch_assoc($id_el);
        $id_el = $id_el['id'];

        // находим права доступа на данный элемент для этого пользователя
        $sql = "SELECT * FROM `access` WHERE `id_element` = '$id_el' and `id_user` = '$id_user';";
        $check_values = mysqli_query($connect, $sql);
        $check_values = mysqli_fetch_assoc($check_values);
        $id_element = $check_values['id'];
        $check_values = $check_values['access_rights'];
        $check_values = explode("-", $check_values);
        ?>


        <h3>Права</h3>
        <h4>Тип прав</h4>
        <form action="users_setting_access_rights_main.php" method="post">


            <table border="1" class="sortable">
                <thead>
                <tr>
                    <?php
                    foreach ($mas_title_1 as $item){
                        ?>
                        <th class="th_title_info"><?=$item?></th>
                    <?php
                    }
                    ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    foreach ($mas_body_1 as $item){
                        if(in_array($item, $check_values))
                        {
                            ?>
                            <td><input type="checkbox" checked name="<?=$item?>"></td>
                            <?php
                        }else {
                            ?>
                            <td><input type="checkbox" name="<?=$item?>"></td>
                            <?php
                        }
                    }
                    ?>
                </tr>
                </tbody>
            </table>

            <table border="1" class="sortable">
                <thead>
                <tr>
                    <?php
                    foreach ($mas_title_2 as $item){
                        ?>
                        <th class="th_title_info"><?=$item?></th>
                        <?php
                    }
                    ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    foreach ($mas_body_2 as $item){
                        if(in_array($item, $check_values))
                        {
                            ?>
                            <td><input type="checkbox" checked name="<?=$item?>"></td>
                            <?php
                        }else {
                            ?>
                            <td><input type="checkbox" name="<?=$item?>"></td>
                            <?php
                        }
                    }
                    ?>
                </tr>
                </tbody>
            </table>


            <input name="type" value="<?= $type ?>" hidden>
            <input name="db" value="<?= $db ?>" hidden>
            <input name="id_element" value="<?= $id_element ?>" hidden>
            <input name="id_user" value="<?= $id_user ?>" hidden>
            <?php
            if($type == 'table'){
                ?>
                <input name="table" value="<?= $table ?>" hidden>
            <?php
            }
            ?>

            <input type="submit" name="submit" value="Изменить">

        </form>

    </div>





</div>
</body>
</html>
