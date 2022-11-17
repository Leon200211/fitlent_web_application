<?php
require_once 'connection.php';
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">


    <link rel="stylesheet" href="assets/css/style_main.css">
    <link rel="stylesheet" href="assets/css/style_header.css">



    <title>Главная страница</title>

<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
</head>

<body>

<div class="main_body">
    <div>
        <?php
        include('header.php');
        ?>
    </div>
    <div class="main_info" style="margin-left: 200px;">
        <div class="main_info_osn">
            <div class="main_info_title">Список баз данных:</div>
            <div class="main_info_text">

                <?php
                if(isset($_GET['error'])){
                    ?>
                    <h3>Ошибка: <?= $_GET['error'] ?></h3>
                    <?php
                }
                ?>


                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <h2>Создать Базу данных: </h2>
                    <form action="main_work/work_with_db/add_new_db.php" method="post">
                        <input type="text" name="db_name" placeholder="Название базы данных">
                        <input type="submit" name="submit" value="Добавить БД" />
                    </form>
                </div>

            <?php
            $res = mysqli_query($link, "SHOW DATABASES");
            while ($row = mysqli_fetch_assoc($res)) {
                if($row['Database'] != 'information_schema' and $row['Database'] != 'mysql'
                    and $row['Database'] != 'sys' and $row['Database'] != 'performance_schema'){
                    ?>
                    <div>
                        <a href="main_work/show_tables.php?db=<?= $row['Database'] ?>">
                            <img src="assets/img/img_9.png" width="15" height="15" style="margin-top: 10px;" title="БД">
                            <?= $row['Database'] ?>
                        </a>
                    </div>
                <?php
                }
            }
            ?>
            </div>
        </div>
    </div>


    <div class="main_info">


        <div class="main_info_osn">
            <div class="main_info_title">Действия</div>
            <div class="main_info_text">
                <div>
                    <a class="doing_link" href="other_work/sql_request/sql_request_server.php">
                        <div>
                            <img src="assets/img/img_15.png" width="30" height="30" title="SQL">
                        </div>
                        <div class="doing_link_text">
                            SQL
                        </div>
                    </a>
                </div>
                <div>
                    <a class="doing_link" href="other_work/for_access_rights/work_whit_rights.php">
                        <div>
                            <img src="assets/img/img_22.png" width="30" height="30" title="Учетные записи пользователей">
                        </div>
                        <div class="doing_link_text">
                            Учетные записи пользователей
                        </div>
                    </a>
                </div>
                <div>
                    <a class="doing_link" href="#">
                        <div>
                            <img src="assets/img/img_10.png" width="30" height="30" title="Учетная запись пользователя">
                        </div>
                        <div class="doing_link_text">
                            Учетная запись пользователя (В разработке)
                        </div>
                    </a>
                </div>
                <div style="margin-bottom: 3px; margin-left: -3px;">
                    <a class="doing_link" href="#">
                        <div style="background-color: white; border-radius: 25px;">
                            <img src="assets/img/img_11.png" width="30" height="30" style="padding-top: 4px; padding-left: 4px;" title="Экспорт">
                        </div>
                        <div class="doing_link_text">
                            Экспорт (В разработке)
                        </div>
                    </a>
                </div>
                <div style="margin-bottom: 3px; margin-left: -3px;">
                    <a class="doing_link" href="#">
                        <div style="background-color: white; border-radius: 25px;">
                            <img src="assets/img/img_12.png" width="30" height="30" style="padding-top: 4px; padding-left: 4px;" title="Импорт">
                        </div>
                        <div class="doing_link_text">
                            Импорт (В разработке)
                        </div>
                    </a>
                </div>
                <div>
                    <a class="doing_link" href="#">
                        <div>
                            <img src="assets/img/img_13.png" width="30" height="30" title="Кодировки">
                        </div>
                        <div class="doing_link_text">
                            Кодировки (В разработке)
                        </div>
                    </a>
                </div>
                <div>
                    <a class="doing_link" href="#">
                        <div>
                            <img src="assets/img/img_14.png" width="30" height="30" title="Типы таблиц">
                        </div>
                        <div class="doing_link_text">
                            Типы таблиц (В разработке)
                        </div>
                    </a>
                </div>
            </div>
        </div>



        <div class="main_info_osn">
            <div class="main_info_title">Информация</div>
            <div class="main_info_text">
                <ul>
                    <li>Пользователь: root@localhost</li>
                    <li>Тип сервера: MySQL</li>
                    <li>Кодировка сервера: UTF-8 Unicode (utf8mb4)</li>
                    <li>Версия сервера: 8.0.19 - MySQL Community Server - GPL</li>
                </ul>
            </div>
        </div>


    </div>
    
</div>




</body>
</html>
