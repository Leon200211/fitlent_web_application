<?php

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root');
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
}



?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">


    <link rel="stylesheet" href="../../assets/css/style_main.css">
    <link rel="stylesheet" href="../../assets/css/style_header.css">
    <link rel="stylesheet" href="../../assets/css/style_for_table.css">
    <link rel="stylesheet" href="../../assets/css/style_for_table_nav.css">
    <link rel="stylesheet" href="../../assets/css/style_for_sql_request.css">



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

    <div style="margin-left: 200px; overflow: auto;">

        <h1> Выполнить SQL-запрос(ы) к серверу:</h1>


        <a href="../../main.php">Назад</a>
        <br>
        <br>




        <div class="request_body">

            <div class="request_body_line1">

                <form action="sql_request_server_main.php" method="post">

                    <?php
                    if(isset($_GET['error'])){
                        ?>
                        <h3>Ошибка: <?= $_GET['error'] ?></h3>
                        <?php
                    }
                    ?>

                    <textarea name="sql_request" id="comment" class="sql_field" placeholder="Введите запрос"></textarea>


                    <input type="submit" name="submit" value="Вперед" />
                </form>




            </div>

            <input type="submit" onclick="document.getElementById('comment').value=''; return false;" value = "Отчистить" />


        </div>

    </div>




</div>
</body>
</html>