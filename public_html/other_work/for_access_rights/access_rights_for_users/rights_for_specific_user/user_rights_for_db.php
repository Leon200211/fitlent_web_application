<?php
require_once '../../connection.php';


$db = $_GET['db'];
$id_user = $_GET['id_user'];


$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');
$sql = "SELECT `name` FROM users WHERE id = '$id_user';";
$user_name = mysqli_query($connect, $sql);
$user_name = mysqli_fetch_assoc($user_name)

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


        <h1>Настройка прав доступа для пользователя - <?=$user_name['name']?> в Базе данных - <?=$db?></h1>



        <?php
        $sql_id_el = "SELECT `id` FROM `elements` WHERE `type` = 'database' and `db` = '$db' and `name` = '$db';";
        $id_el = mysqli_query($connect, $sql_id_el);
        $id_el = mysqli_fetch_assoc($id_el);
        $id_el = $id_el['id'];


        $sql = "SELECT * FROM `access` WHERE `id_element` = '$id_el' and `id_user` = '$id_user';";

        $check_values = mysqli_query($connect, $sql);
        $check_values = mysqli_fetch_assoc($check_values);
        $id_element = $check_values['id'];
        $check_values = $check_values['access_rights'];
        $check_values = explode("-", $check_values);
        ?>

        <h3>Права</h3>
        <h4>Тип прав</h4>
        <form action="user_rights_for_db_main.php" method="post">
            <table border="1" class="sortable">
                <thead>
                    <tr>
                        <th class="th_title_info"> Просматривать </th>
                        <th class="th_title_info"> Удалить </th>
                        <th class="th_title_info"> Зона видимости </th>
                        <th class="th_title_info"> SQl запрос к БД </th>
                        <th class="th_title_info"> Поиск по БД </th>
                        <th class="th_title_info"> Экспорт </th>
                        <th class="th_title_info"> Импорт </th>
                        <th class="th_title_info"> Создавать таблицы </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        if(in_array("v", $check_values))
                        {
                            ?>
                            <td><input type="checkbox" checked name="v"></td>
                        <?php
                        }else {
                            ?>
                            <td><input type="checkbox" name="v"></td>
                        <?php
                        }

                        if(in_array("d", $check_values))
                        {
                        ?>
                            <td><input type="checkbox" checked name="d"></td>
                            <?php
                        }else {
                            ?>
                            <td><input type="checkbox" name="d"></td>
                            <?php
                        }

                        if(in_array("vis_z", $check_values))
                        {
                        ?>
                            <td><input type="checkbox" checked name="vis_z"></td>
                            <?php
                        }else {
                            ?>
                            <td><input type="checkbox" name="vis_z"></td>
                            <?php
                        }

                        if(in_array("SQL_q", $check_values))
                        {
                        ?>
                            <td><input type="checkbox" checked name="SQL_q"></td>
                            <?php
                        }else {
                            ?>
                            <td><input type="checkbox" name="SQL_q"></td>
                            <?php
                        }

                        if(in_array("d_s", $check_values))
                        {
                        ?>
                            <td><input type="checkbox" checked name="d_s"></td>
                            <?php
                        }else {
                            ?>
                            <td><input type="checkbox" name="d_s"></td>
                            <?php
                        }

                        if(in_array("ex", $check_values))
                        {
                        ?>
                            <td><input type="checkbox" checked name="ex"></td>
                            <?php
                        }else {
                            ?>
                            <td><input type="checkbox" name="ex"></td>
                            <?php
                        }

                        if(in_array("im", $check_values))
                        {
                        ?>
                            <td><input type="checkbox" checked name="im"></td>
                            <?php
                        }else {
                            ?>
                            <td><input type="checkbox" name="im"></td>
                            <?php
                        }

                        if(in_array("c_t", $check_values))
                        {
                            ?>
                            <td><input type="checkbox" checked name="c_t"></td>
                            <?php
                        }else {
                            ?>
                            <td><input type="checkbox" name="c_t"></td>
                        <?php
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
            <table border="1" class="sortable">
                <thead>
                <tr>
                    <th class="th_title_info"> Просматривать Триггеры </th>
                    <th class="th_title_info"> Просматривать События </th>
                    <th class="th_title_info"> Просматривать Процедуры </th>
                    <th class="th_title_info"> Создавать Триггеры </th>
                    <th class="th_title_info"> Создавать События </th>
                    <th class="th_title_info"> Создавать Процедуры </th>
                    <th class="th_title_info"> Просматривать Дизайн </th>
                    <th class="th_title_info"> Создавать Дизайн </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    if(in_array("v_t", $check_values))
                    {
                        ?>
                        <td><input type="checkbox" checked name="v_t"></td>
                        <?php
                    }else {
                        ?>
                        <td><input type="checkbox" name="v_t"></td>
                        <?php
                    }

                    if(in_array("v_e", $check_values))
                    {
                        ?>
                        <td><input type="checkbox" checked name="v_e"></td>
                        <?php
                    }else {
                        ?>
                        <td><input type="checkbox" name="v_e"></td>
                        <?php
                    }

                    if(in_array("v_p", $check_values))
                    {
                        ?>
                        <td><input type="checkbox" checked name="v_p"></td>
                        <?php
                    }else {
                        ?>
                        <td><input type="checkbox" name="v_p"></td>
                        <?php
                    }

                    if(in_array("c_t", $check_values))
                    {
                        ?>
                        <td><input type="checkbox" checked name="c_t"></td>
                        <?php
                    }else {
                        ?>
                        <td><input type="checkbox" name="c_t"></td>
                        <?php
                    }

                    if(in_array("c_e", $check_values))
                    {
                        ?>
                        <td><input type="checkbox" checked name="c_e"></td>
                        <?php
                    }else {
                        ?>
                        <td><input type="checkbox" name="c_e"></td>
                        <?php
                    }

                    if(in_array("c_p", $check_values))
                    {
                        ?>
                        <td><input type="checkbox" checked name="c_p"></td>
                        <?php
                    }else {
                        ?>
                        <td><input type="checkbox" name="c_p"></td>
                        <?php
                    }

                    if(in_array("v_d", $check_values))
                    {
                        ?>
                        <td><input type="checkbox" checked name="im"></td>
                        <?php
                    }else {
                        ?>
                        <td><input type="checkbox" name="im"></td>
                        <?php
                    }

                    if(in_array("c_d", $check_values))
                    {
                        ?>
                        <td><input type="checkbox" checked name="c_t"></td>
                        <?php
                    }else {
                        ?>
                        <td><input type="checkbox" name="c_t"></td>
                        <?php
                    }
                    ?>
                </tr>
                </tbody>
            </table>



            <input name="db" value="<?= $db ?>" hidden>
            <input name="id_element" value="<?= $id_element ?>" hidden>
            <input name="id_user" value="<?= $id_user ?>" hidden>

            <input type="submit" name="submit" value="Изменить" />
        </form>

    </div>

</div>
</body>
</html>


