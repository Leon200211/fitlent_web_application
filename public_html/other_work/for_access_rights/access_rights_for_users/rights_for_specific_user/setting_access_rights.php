<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path . '/connection.php';

$database_array = array();


$id_user = $_GET['id_user'];


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


        <div>
            <a href="../rights_for_users.php">Назад</a>
        </div>


        <h1>Настройка прав доступа для пользователя</h1>


        <div>
            <div class="main_info_osn">
                <div class="main_info_title">Список баз данных:</div>
                <div class="main_info_text">
                    <?php
                    $res = mysqli_query($link, "SHOW DATABASES");
                    while ($row = mysqli_fetch_assoc($res)) {
                        if($row['Database'] != 'information_schema' and $row['Database'] != 'mysql'
                            and $row['Database'] != 'sys' and $row['Database'] != 'performance_schema'){
                            $database_array[] = $row['Database'];
                            ?>
                            <div>
                                <a href="users_setting_access_rights.php?type=database&db=<?=$row['Database']?>&id_user=<?=$id_user?>">
                                    <img src="../../../../assets/img/img_9.png" width="15" height="15" style="margin-top: 10px;" title="БД">
                                    <?= $row['Database'] ?>
                                    - Настроить права доступа
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div>
            <div class="main_info_osn" style="width: 1000px;">
                <div class="main_info_title">Список таблиц:</div>
                <div class="main_info_text">
                    <?php
                    foreach ($database_array as $value){
                        ?>
                        <h3>База данных: <?=$value?></h3>
                        <h4>Таблицы</h4>

                        <table border="1" class="sortable">
                            <thead>
                            <tr>
                                <th class="th_title_info"> Таблица </th>
                                <th class="th_title_info"> Кол-во строк </th>
                                <th class="th_title_info"> Тип </th>
                                <th class="th_title_info"> Дата создания </th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php
                            $connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $value);
                            $res = mysqli_query($connect, "SHOW TABLE STATUS");
                            while ($row = mysqli_fetch_assoc($res)) {

                                ?>
                                    <tr>
                                        <td><?= $row['Name'] ?></td>
                                        <td><?= $row['Rows'] ?></td>
                                        <td><?= $row['Engine'] ?></td>
                                        <td><?= $row['Create_time'] ?></td>
                                        <td><a href="users_setting_access_rights.php?type=table&db=<?=$value?>&table=<?=$row['Name']?>&id_user=<?=$id_user?>">Настроить права доступа</a></td>
                                    </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>


        <div>
            <h3>Процедуры</h3>
            <h4>бд</h4>
            выа
            ыва
            <h4>бд</h4>
            выа
            ыва
        </div>
        <div>
            <h3>События</h3>
            <h4>бд</h4>
            выа
            ыва
            <h4>бд</h4>
            выа
            ыва
        </div>
        <div>
            <div class="main_info_osn" style="width: 1000px;">
                <div class="main_info_title">Список Триггеров:</div>
                <div class="main_info_text">
                    <?php
                    foreach ($database_array as $value){
                        ?>
                        <h3>База данных: <?=$value?></h3>
                        <h4>Триггеры</h4>

                        <table border="1" class="sortable">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Таблица</th>
                                <th>Время</th>
                                <th>Событие</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $value);
                            $res = mysqli_query($connect, "SHOW TRIGGERS");
                            while ($row = mysqli_fetch_assoc($res)) {

                                ?>
                                <tr>
                                    <td class="tb_title_info"><?=$row['Trigger']?></td>
                                    <td class="tb_title_info"><?=$row['Table']?></td>
                                    <td class="tb_title_info"><?=$row['Timing']?></td>
                                    <td class="tb_title_info"><?=$row['Event']?></td>
                                    <td><a href="#">Настроить права доступа</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>



    </div>
</div>
</body>
</html>
