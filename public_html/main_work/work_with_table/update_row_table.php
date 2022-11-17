<?php
$db = $_GET['db'];
$table = $_GET['table'];
$value = $_GET['value'];


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


    <link rel="stylesheet" href="../../assets/css/style_main.css">
    <link rel="stylesheet" href="../../assets/css/style_header.css">



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

        <a href="show_tables_main_info.php?db=<?=$db?>&table=<?=$table?>&ns=25">Назад</a>


        <?php
        if(isset($_GET['error'])){
            ?>
            <h3>Ошибка: <?= $_GET['error'] ?></h3>
            <?php
        }
        ?>



        <form action="update_row_table_main.php" method="post">
            <link href="../../assets/for_sorted_table/sortable.css" rel="stylesheet" />
            <table border="1" class="sortable">
                <thead>
                <tr>
                    <th class="th_title_info"> Столбец </th>
                    <th class="th_title_info"> Тип </th>
                    <th class="th_title_info"> Функция </th>
                    <th class="th_title_info"> Null </th>
                    <th class="th_title_info"> Значение </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SHOW COLUMNS FROM `$table`";
                $result = mysqli_query($connect, $sql);
                $row = mysqli_fetch_array($result)['Field'];
                $select_old = mysqli_query($connect, "SELECT * from $table WHERE `$row` = $value;");
                $select_old_while = mysqli_fetch_assoc($select_old);
                $q = mysqli_query($connect, "DESCRIBE $table;");
                while($row = mysqli_fetch_array($q)) {
                    ?>
                    <tr>
                        <td><?=$row['Field']?></td>
                        <td><?=$row['Type']?></td>
                        <td>---</td>
                        <td><?=$row['Null']?></td>
                        <td><input type="text" name="<?=$row['Field']?>" value="<?=$select_old_while[$row['Field']]?>"></td>
                    </tr>
                    <?php
                }

                ?>
                </tbody>
            </table>


            <input name="db" value="<?= $db ?>" hidden>
            <input name="table" value="<?= $table ?>" hidden>
            <input name="value" value="<?= $value ?>" hidden>

            <input type="submit" name="submit" value="Изменить" />
        </form>

    </div>

</div>



</body>
</html>
