<?php
$db = $_GET['db'];
$table = $_GET['table'];


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
    <link rel="stylesheet" href="../../../assets/css/style_for_table_nav.css">




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

        <a href="../../show_tables.php?db=<?= $db ?>">Назад</a>



        <?php
        include('../header_nav.php');
        ?>



        <?php
        if(isset($_GET['error'])){
            ?>
            <h3>Ошибка: <?= $_GET['error'] ?></h3>
            <?php
        }
        ?>



        <form action="search_table_main.php" method="post">
            <link href="../../../assets/for_sorted_table/sortable.css" rel="stylesheet" />
            <table border="1" class="sortable">
                <thead>
                <tr>
                    <th class="th_title_info"> Столбец </th>
                    <th class="th_title_info"> Тип </th>
                    <th class="th_title_info"> Оператор </th>
                    <th class="th_title_info"> Значение </th>
                </tr>
                </thead>
                <tbody>
                <?php

                $q = mysqli_query($connect, "DESCRIBE $table;");
                while($row = mysqli_fetch_array($q)) {
                    ?>
                    <tr>
                        <td><?=$row['Field']?></td>
                        <td><?=$row['Type']?></td>
                        <td>
                            <select name="operator<?=$row['Field']?>" id="operator<?=$row['Field']?>">
                                <option value="LIKE">LIKE</option>
                                <option value="LIKE%">LIKE %...%</option>
                                <option value="NOT LIKE">NOT LIKE</option>
                                <option value="=">=</option>
                                <option value="!=">!=</option>
                                <option value="REGEXP">REGEXP</option>
                                <option value="REGEXP^">REGEXP^...$</option>
                                <option value="NOT REGEXP">NOT REGEXP</option>
                                <option value="IN">IN (...)</option>
                                <option value="NOT IN">NOT IN (...)</option>
                                <option value="BETWEEN">BETWEEN</option>
                                <option value="NOT BETWEEN">NOT BETWEEN</option>
                                <option value="IS NULL">IS NULL</option>
                                <option value="IS NOT NULL">IS NOT NULL</option>
                            </select>
                        </td>
                        <td><input type="text" name="<?=$row['Field']?>"></td>
                    </tr>
                    <?php
                }

                ?>
                </tbody>
            </table>


            <input name="db" value="<?= $db ?>" hidden>
            <input name="table" value="<?= $table ?>" hidden>

            <input type="submit" name="submit" value="Поиск" />
        </form>

    </div>

</div>



</body>
</html>
