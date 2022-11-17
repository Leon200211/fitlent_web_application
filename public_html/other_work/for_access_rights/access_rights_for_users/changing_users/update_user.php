<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path . '/connection.php';

$id = $_GET['id'];


$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', "admin_panel");
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
}


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
        include($path . '/header.php');
        ?>
    </div>

    <div class="main_info" style="margin-left: 200px;">

        <a href="../rights_for_users.php">Назад</a>


        <?php
        if(isset($_GET['error'])){
            ?>
            <h3>Ошибка: <?= $_GET['error'] ?></h3>
            <?php
        }
        ?>


        <?php
        $sql = "SELECT * FROM `users` WHERE `id` = $id;";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        ?>


        <div id="bar_block" class="add_trigger_main">
            <form action="update_user_main.php" method="post">
                <div>
                    <input name="id" value="<?= $id ?>" hidden>
                    <div>
                        Name
                        <input class="trigger_name" type="text" name="name" value="<?=$row['name']?>">
                    </div>
                    <div>
                        Login
                        <input class="trigger_name" type="text" name="login" value="<?=$row['login']?>">
                    </div>
                    <div>
                        Password
                        <input class="trigger_name" type="text" name="pass" value="<?=$row['pass']?>">
                    </div>
                    <div>
                        State
                        <select class="trigger_when" name="user_state" id="user_state">
                            <option value="main_admin">main_admin</option>
                            <option value="user">user</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Изменить пользователя" />
                    </div>
            </form>
        </div>

    </div>

</div>



</body>
</html>
