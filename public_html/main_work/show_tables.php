
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


    <link rel="stylesheet" href="../assets/css/style_main.css">
    <link rel="stylesheet" href="../assets/css/style_header.css">



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


        <div style="display: flex; justify-content: start;">
            <div>
                <h1> Таблицы базы данных <?= $db ?>: </h1>
                <div>
                    <a href="../main.php">Назад</a>
                </div>
                <br>
                <div style="margin-top: 70px;">
                    <h2>Создать таблицу: </h2>
                    <form action="create_table/add_new_table.php" method="post">
                        <input name="db" value="<?= $db ?>" hidden>
                        <input type="text" name="table_name" placeholder="Название таблицы">
                        <input type="text" name="count_columns" placeholder="Количество столбцов">
                        <input type="submit" name="submit" value="Добавить таблицу" />
                    </form>
                </div>
            </div>
            <div class="main_info" style="margin-top: -30px;">
                <div class="main_info_osn">
                    <div class="main_info_title">Действия</div>
                    <div class="main_info_text">
                        <div>
                            <a class="doing_link" href="work_with_db/sql_request/sql_request_db.php?db=<?=$db?>">
                                <div>
                                    <img src="../assets/img/img_15.png" width="30" height="30" title="SQL">
                                </div>
                                <div class="doing_link_text">
                                    SQL
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="doing_link" href="#">
                                <div>
                                    <img src="../assets/img/img_16.png" width="30" height="30" title="Поиск">
                                </div>
                                <div class="doing_link_text">
                                    Поиск (В разработке)
                                </div>
                            </a>
                        </div>
                        <div style="margin-bottom: 3px; margin-left: -3px;">
                            <a class="doing_link" href="work_with_db/export/dbexport_tables.php?db=<?=$db?>">
                                <div style="background-color: white; border-radius: 25px;">
                                    <img src="../assets/img/img_11.png" width="30" height="30" style="padding-top: 4px; padding-left: 4px;" title="Экспорт">
                                </div>
                                <div class="doing_link_text">
                                    Экспорт
                                </div>
                            </a>
                        </div>
                        <div style="margin-bottom: 3px; margin-left: -3px;">
                            <a class="doing_link" href="work_with_db/import/dbimport_tables.php?db=<?=$db?>">
                                <div style="background-color: white; border-radius: 25px;">
                                    <img src="../assets/img/img_12.png" width="30" height="30" style="padding-top: 4px; padding-left: 4px;" title="Импорт">
                                </div>
                                <div class="doing_link_text">
                                    Импорт
                                </div>
                            </a>
                        </div>
                        <div style="margin-bottom: 3px; margin-left: -3px;">
                            <a class="doing_link" href="work_with_db/work_with_procedures/table_procedures.php?db=<?=$db?>">
                                <div>
                                    <img src="../assets/img/img_20.png" width="30" height="30" title="Процедуры">
                                </div>
                                <div class="doing_link_text">
                                    Процедуры (В разработке)!!!
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="doing_link" href="work_with_db/work_with_procedures/table_procedures.php?db=<?=$db?>">
                                <div>
                                    <img src="../assets/img/img_17.png" width="30" height="30" title="События">
                                </div>
                                <div class="doing_link_text">
                                    События (В разработке)
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="doing_link" href="work_with_db/work_with_triggers/table_trigger.php?db=<?=$db?>">
                                <div>
                                    <img src="../assets/img/img_18.png" width="30" height="30" title="Триггеры">
                                </div>
                                <div class="doing_link_text">
                                    Триггеры
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="doing_link" href="work_with_db/work_with_physical_model/dbdesigner/main_page.php?db=<?=$db?>">
                                <div>
                                    <img src="../assets/img/img_19.png" width="30" height="30" title="Дизайнер">
                                </div>
                                <div class="doing_link_text">
                                    Дизайнер (В разработке)!!!
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div>

            <link href="../assets/for_sorted_table/sortable.css" rel="stylesheet" />
            <script src="../assets/for_sorted_table/sortable.js"></script>
            <table border="1" class="sortable">
                <thead>
                    <tr>
                        <th class="th_title_info"> Таблица </th>
                        <th class="th_title_info"> Действия </th>
                        <th class="th_title_info"> Кол-во строк </th>
                        <th class="th_title_info"> Тип </th>
                        <th class="th_title_info"> Сравнение </th>
                        <th class="th_title_info"> Размер </th>
                        <th class="th_title_info"> Версия </th>
                        <th class="th_title_info"> Дата создания </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SHOW TABLE STATUS;";
                $res = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                <tr>
                    <td><a href="work_with_table/show_tables_main_info.php?db=<?= $db ?>&table=<?= $row['Name'] ?>&ns=25"><?= $row['Name'] ?> </a></td>
                    <td>
                        <a href="work_with_table/show_tables_main_info.php?db=<?= $db ?>&table=<?= $row['Name'] ?>&ns=25"><img src="../assets/img/img_1.png" width="20" height="20" title="Обзор"></a>
                        <a href="work_with_table/work_with_structure/table_structure.php?db=<?=$db?>&table=<?=$row['Name']?>"><img src="../assets/img/img_2.png" width="20" height="20" title="Структура"></a>
                        <a href="work_with_table/search_table/search_table.php?db=<?=$db?>&table=<?=$row['Name']?>"><img src="../assets/img/img_3.png" width="20" height="20" title="Поиск"></a>
                        <a href="work_with_table/insert_into_table/insert_into_table.php?db=<?=$db?>&table=<?=$row['Name']?>"><img src="../assets/img/img_4.png" width="20" height="20" title="Вставить"></a>
                        <a href="work_with_table/truncate_table.php?db=<?=$db?>&table=<?=$row['Name']?>"><img src="../assets/img/img_5.png" width="20" height="20" title="Отчистить" onClick="return window.confirm('Хотите отчистить эту таблицу?');"></a>
                        <a href="work_with_table/delete_table.php?db=<?=$db?>&table=<?=$row['Name']?>"><img src="../assets/img/img_6.png" width="20" height="20" title="Удалить" onClick="return window.confirm('Хотите удалить эту таблицу?');"></a>

                    </td>
                    <td><?= $row['Rows'] ?></td>
                    <td><?= $row['Engine'] ?></td>
                    <td><?= $row['Collation'] ?></td>
                    <td><?= round((($row['Data_length'] + $row['Index_length']) / 1024 ), 2) ?> Size in KB</td>
                    <td><?= $row['Version'] ?></td>
                    <td><?= $row['Create_time'] ?></td>
                </tr>
            <?php
        }
        ?>
                </tbody>
            </table>

        </div>
    </div>






</div>




</body>
</html>
