<?php



$db = $_GET['db'];
$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">


    <link rel="stylesheet" href="../../../assets/css/style_main.css">
    <link rel="stylesheet" href="../../../assets/css/style_header.css">
    <link rel="stylesheet" href="../../../assets/css/style_for_trigger.css">



    <title>Главная страница</title>

    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
</head>

<body>


<div>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    include($path . '/header.php');
    ?>
</div>

<div class="main_info" style="margin-left: 200px;">


    <div style="display: flex; justify-content: start;">
        <div>
            <h1> Триггеры для базы данных <?= $db ?>: </h1>
            <div>
                <a href="../../show_tables.php?db=<?=$db?>">Назад</a>
            </div>
        </div>
    </div>
    <br>
    <div style="margin-top: 30px;">

        <h2>Создать триггер: </h2>

        <?php
        if(isset($_GET['error'])){
            ?>
            <h3>Ошибка: <?= $_GET['error'] ?></h3>
            <?php
        }
        ?>


        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#show_bar").click(function() {
                    $("#bar_block").slideToggle();
                    if ($("#show_bar").html() == 'Отмена') {
                        $("#show_bar").html('Добавить триггер');
                    } else {
                        $("#show_bar").html('Отмена');
                    }
                });
            });
        </script>
        <style>
            #bar_block {display: none;}
        </style>
        <button id="show_bar">Добавить триггер</button>
        <div id="bar_block" class="add_trigger_main">
            <form action="table_trigger_add.php" method="post">
                <div>
                    <input name="db" value="<?= $db ?>" hidden>
                    <div>
                        <input class="trigger_name" type="text" name="trigger_name" placeholder="Название триггера">
                    </div>
                    <div>
                        <select class="trigger_table" name="table_name" id="table_name">
                            <?php
                            $sql = "SHOW TABLES";
                            $result = mysqli_query($connect, $sql);
                            while($row = mysqli_fetch_array($result)){
                                ?>
                                <option value="<?=$row[0]?>"><?=$row[0]?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <select class="trigger_when" name="trigger_when" id="trigger_when">
                            <option value="BEFORE">BEFORE</option>
                            <option value="AFTER">AFTER</option>
                        </select>
                    </div>
                    <div>
                        <select class="trigger_event" name="event" id="event">
                            <option value="INSERT">INSERT</option>
                            <option value="UPDATE">UPDATE</option>
                            <option value="DELETE">DELETE</option>
                        </select>
                    </div>
                    <div>
                        <textarea class="trigger_main" name="trigger_main" placeholder="Описание"></textarea>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Добавить Триггер" />
                    </div>
                </div>
            </form>
        </div>


    </div>



    <div style="margin-top: 50px;">

        <link href="../../../assets/for_sorted_table/sortable.css" rel="stylesheet" />
        <script src="../../../assets/for_sorted_table/sortable.js"></script>
        <table border="1" class="sortable">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Таблица</th>
                <th>Действия</th>
                <th>Время</th>
                <th>Событие</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SHOW TRIGGERS";
            $select = mysqli_query($connect, $sql);
            while($select_while = mysqli_fetch_assoc($select)) {
                ?>
                <tr>
                    <td class="tb_title_info"><?=$select_while['Trigger']?></td>
                    <td class="tb_title_info"><?=$select_while['Table']?></td>
                    <td id="doing">
                        <a href="table_trigger_update.php?db=<?=$db?>&name=<?=$select_while['Trigger']?>">
                            <img src="../../../assets/img/img_7.png" width="20" height="20" title="Изменить"></a>
                        <a href="#">
                            <img src="../../../assets/img/img_21.png" width="22" height="22" title="Экспорт"></a>
                        <a href="table_trigger_delete.php?db=<?=$db?>&name=<?=$select_while['Trigger']?>">
                            <img src="../../../assets/img/img_6.png" width="20" height="20" title="Удалить" onClick="return window.confirm('Хотите удалить этот триггер?');">
                        </a>
                    </td>
                    <td class="tb_title_info"><?=$select_while['Timing']?></td>
                    <td class="tb_title_info"><?=$select_while['Event']?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>


    </div>



</div>



</body>
</html>
