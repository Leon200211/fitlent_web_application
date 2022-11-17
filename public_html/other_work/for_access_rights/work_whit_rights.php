<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path . '/connection.php'
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">


    <link rel="stylesheet" href="../../assets/css/style_main.css">
    <link rel="stylesheet" href="../../assets/css/style_header.css">



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


        <div>
            <a href="../../main.php">Назад</a>
        </div>



        <h1>Настройка прав доступа</h1>

        <div>
            <a href="access_rights_for_users/rights_for_users.php">Права доступа для users</a>
            <br>
            <a href="#">Права доступа для элементов - В разработке</a>
        </div>



    </div>

</div>
</body>
</html>
