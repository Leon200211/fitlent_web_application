<?php

$db = $_GET['db'];
$table = $_GET['table'];

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
}

$columns = array();
$columns_insert = "";
$q = mysqli_query($connect, "DESCRIBE $table;");
while($row = mysqli_fetch_array($q)) {
    $columns[] = $row['Field'];
    $columns_insert .= "\'...\', ";
}
$str_columns = '`';
$str_columns .= implode("`, `", $columns);
$str_columns .= '`';
$columns_insert = substr($columns_insert,0,-2);
$str_insert = "INSERT INTO `$table` ($str_columns) VALUES ($columns_insert);";
$str_columns = '`';
$str_columns .= implode("` = \'...\', `", $columns);
$str_columns .= "` = \'...\'";
$str_update = "UPDATE `$table` SET $str_columns WHERE `$table`.`...` = " . "\'...\'";
$str_delete = "DELETE FROM `$table` WHERE `$table`.`...` = " . "\'...\'";

?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">


    <link rel="stylesheet" href="../../../assets/css/style_main.css">
    <link rel="stylesheet" href="../../../assets/css/style_header.css">
    <link rel="stylesheet" href="../../../assets/css/style_for_table.css">
    <link rel="stylesheet" href="../../../assets/css/style_for_table_nav.css">
    <link rel="stylesheet" href="../../../assets/css/style_for_sql_request.css">



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

        <h1> Выполнить SQL-запрос(ы) к таблице <?= $db ?>.<?= $table ?>: </h1>


        <?php
        include('../header_nav.php');
        ?>


        <div class="request_body">

            <div class="request_body_line1">

                <form action="sql_request_table_main.php" method="post">

                    <?php
                    if(isset($_GET['error'])){
                        ?>
                        <h3>Ошибка: <?= $_GET['error'] ?></h3>
                        <?php
                    }
                    ?>

                    <textarea name="sql_request" id="comment" class="sql_field">SELECT * FROM `<?=$table?>` WHERE 1;</textarea>

                    <input name="db" value="<?= $db ?>" hidden>
                    <input name="table" value="<?= $table ?>" hidden>

                    <input type="submit" name="submit" value="Вперед" />
                </form>

                <select name="select" class="list_columns" multiple>
                    <?php
                    foreach ($columns as $value){
                        ?>
                        <option value="s3" onclick="document.getElementById('comment').value+='`<?=$value?>`'; return false;"><?=$value?></option>
                    <?php
                    }
                    ?>
                   </select>


            </div>



            <input type="submit" onclick="document.getElementById('comment').value='SELECT * FROM `<?=$table?>` WHERE 1;'; return false;" value = "SELECT *" />
            <input type="submit" onclick="document.getElementById('comment').value='SELECT <?=$str_columns?> FROM `<?=$table?>` WHERE 1;'; return false;" value = "SELECT " />
            <input type="submit" onclick="document.getElementById('comment').value='<?=$str_insert?>'; return false;" value = "INSERT" />
            <input type="submit" onclick="document.getElementById('comment').value='<?=$str_update?>'; return false;" value = "UPDATE" />
            <input type="submit" onclick="document.getElementById('comment').value='<?=$str_delete?>'; return false;" value = "DELETE" />
            <input type="submit" onclick="document.getElementById('comment').value=''; return false;" value = "Отчистить" />


        </div>

    </div>




</div>
</body>
</html>