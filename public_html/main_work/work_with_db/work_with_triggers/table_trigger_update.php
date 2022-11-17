<?php
$db = $_GET['db'];
$name = $_GET['name'];



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



<div class="main_body">


    <div>
        <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        include($path . '/header.php');
        ?>
    </div>

    <div class="main_info" style="margin-left: 200px;">

        <a href="table_trigger.php?db=<?=$db?>">Назад</a>


        <?php
        if(isset($_GET['error'])){
            ?>
            <h3>Ошибка: <?= $_GET['error'] ?></h3>
            <?php
        }
        ?>


        <?php
        $sql = "select * from information_schema.triggers where trigger_schema = '$db' and trigger_name = '$name'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        ?>


        <div id="bar_block" class="add_trigger_main">
            <form action="table_trigger_update_main.php" method="post">
                <div>
                    <input name="db" value="<?= $db ?>" hidden>
                    <div>
                        <input class="trigger_name" type="text" name="trigger_name" value="<?=$row['TRIGGER_NAME']?>">
                    </div>
                    <div>
                        <select class="trigger_table" name="table_name" id="table_name">
                            <option value="<?=$row['EVENT_OBJECT_TABLE']?>">Выбранно: <?=$row['EVENT_OBJECT_TABLE']?></option>
                            <?php
                            $sql = "SHOW TABLES";
                            $result = mysqli_query($connect, $sql);
                            while($row_2 = mysqli_fetch_array($result)){
                                ?>
                                <option value="<?=$row_2[0]?>"><?=$row_2[0]?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <select class="trigger_when" name="trigger_when" id="trigger_when">
                            <option value="<?=$row['ACTION_TIMING']?>">Выбранно: <?=$row['ACTION_TIMING']?></option>

                            <option value="BEFORE">BEFORE</option>
                            <option value="AFTER">AFTER</option>
                        </select>
                    </div>
                    <div>
                        <select class="trigger_event" name="event" id="event">
                            <option value="<?=$row['EVENT_MANIPULATION']?>">Выбранно: <?=$row['EVENT_MANIPULATION']?></option>

                            <option value="INSERT">INSERT</option>
                            <option value="UPDATE">UPDATE</option>
                            <option value="DELETE">DELETE</option>
                        </select>
                    </div>
                    <div>
                        <textarea class="trigger_main" name="trigger_main"><?=$row['ACTION_STATEMENT']?></textarea>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Изменить триггер" />
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>



</body>
</html>
