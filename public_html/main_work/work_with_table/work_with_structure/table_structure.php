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
        <h1> Структура таблицы <?= $table ?> из базы данных <?= $db ?>: </h1>
        <div>
            <a href="../../show_tables.php?db=<?= $db ?>">Назад</a>
        </div>
        <br>




        <?php
        include('../header_nav.php');
        ?>


        <div>
            <link href="../../../assets/for_sorted_table/sortable.css" rel="stylesheet" />
            <table border="1" class="sortable">
                <thead>
                <tr>
                    <th class="th_title_info"> # </th>
                    <th class="th_title_info"> Имя </th>
                    <th class="th_title_info"> Тип </th>
                    <th class="th_title_info"> Сравнение </th>
                    <th class="th_title_info"> Атрибуты </th>
                    <th class="th_title_info"> Null </th>
                    <th class="th_title_info"> По умолчанию </th>
                    <th class="th_title_info"> Комментарии </th>
                    <th class="th_title_info"> Дополнительно </th>
                    <th class="th_title_info"> Действие </th>
                </tr>
                </thead>

                <tbody>

                <?php
                $name_colum = array();
                $sql = "SHOW COLUMNS FROM `$table`";
                $result = mysqli_query($connect, $sql);



                $i = 0;
                while($row = mysqli_fetch_array($result)){
                    $i += 1;
                    ?>

                    <tr>
                        <td class="th_title_info"> <?= $i ?> </td>
                        <td class="th_title_info">
                            <div>
                                <?= $row['Field'] ?>
                                <br>
                                <?= $row['Key'] ?>
                            </div>
                        </td>
                        <td class="th_title_info"> <?= $row['Type'] ?> </td>

                        <?php
                        $row_name = $row['Field'];
                        $sql_2 = "SELECT COLLATION_NAME, COLUMN_COMMENT, COLUMN_TYPE FROM information_schema.`COLUMNS` 
                                    WHERE table_schema = '$db'
                                                    AND table_name = '$table'
                                                    AND column_name = '$row_name';";
                        $result_2 = mysqli_query($connect, $sql_2);
                        $row_2 = mysqli_fetch_array($result_2);
                        ?>
                        <td class="th_title_info"> <?= $row_2[0] ?> </td>
                        <td class="th_title_info"> <?= $row_2[2] ?> </td>
                        <td class="th_title_info"> <?= $row['Null'] ?> </td>
                        <td class="th_title_info"> <?= $row['Default'] ?> </td>
                        <td class="th_title_info"> <?= $row_2[1] ?> </td>
                        <td class="th_title_info"> <?= $row['Extra'] ?> </td>
                        <td class="th_title_info">
                            <a href="table_structure_update.php?db=<?=$db?>&table=<?=$table?>&column=<?=$row['Field']?>">
                                <img src="../../../assets/img/img_7.png" width="20" height="20" title="Изменить"></a>
                            <a href="delete_from_table_structure.php?db=<?=$db?>&table=<?=$table?>&column=<?=$row['Field']?>">
                                <img src="../../../assets/img/img_6.png" width="20" height="20" title="Удалить" onClick="return window.confirm('Хотите удалить эту колонку?');">
                            </a>
                        </td>
                    </tr>


                    <?php
                    //SELECT  *
                    //FROM information_schema.columns
                    //WHERE (table_schema='yandex' and table_name = 'solution')
                    //order by ordinal_position;

                }


                ?>
                </tbody>

            </table>


        </div>



        <div style="margin-top: 20px;">
            <h3>Добавить поле(я): </h3>
            <form action="table_structure_add.php" method="post">
                <input name="db" value="<?= $db ?>" hidden>
                <input name="table" value="<?= $table ?>" hidden>
                <input type="count_pol" name="count_pol" placeholder="Кол-во полей">
                <select name="after" id="after">
                    <?php
                    $sql = "SHOW COLUMNS FROM `$table`";
                    $result = mysqli_query($connect, $sql);
                    while($row = mysqli_fetch_array($result)){
                        ?>
                        <option value="<?=$row['Field']?>">После <?=$row['Field']?></option>
                    <?php
                    }
                    ?>
                </select>

                <input type="submit" name="submit" value="Добавить поле(я)" />
            </form>
        </div>

        <div>
            <br>
            <br>
            <h4>Информация</h4>
            <?php
            $sql = "SELECT
            table_name AS `Table`,
            round(((data_length + index_length) / 1024 ), 2) `Size in KB`
            FROM information_schema.TABLES
            WHERE table_schema = '$db'
            AND table_name = '$table';";
            $result = mysqli_query($connect, $sql);
            $result = mysqli_fetch_array($result);
            ?>
            Данные = <?= $result['Size in KB'] ?> КиБ
            <form action="table_optimize.php" method="post">
                <input name="db" value="<?= $db ?>" hidden>
                <input name="table" value="<?= $table ?>" hidden>
                <input type="submit" name="submit" value="Оптимизировать таблицу" />
            </form>

        </div>

    </div>



</div>
</body>
</html>