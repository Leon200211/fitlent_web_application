
<?php



$db = $_GET['db'];
$table = $_GET['table'];
$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
}


$chislo = 5; // ЧИСЛО СООБЩЕНИЙ НА СТРАНИЦ

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


        <h1> Таблица <?= $table ?> из базы данных <?= $db ?>: </h1>

        <div>
            <a href="../show_tables.php?db=<?= $db ?>">Назад</a>
        </div>

        <?php
        include('header_nav.php');
        ?>





        <div style="overflow: auto;">
            <?php


            $sql = "SELECT * FROM `$table`";
            $select = mysqli_query($connect, $sql);


            if(!empty($_GET['ns'])){
                $per_page = $_GET['ns'];
            }
            else{
                $per_page = 25;
            }
            echo 'Количество строк: ';
            ?>
            <script language="JavaScript" type="text/javascript">
                function linklist(){
                    var social = document.getElementById("sel");
                    var selectSocial = social.options[social.selectedIndex].value;

                    var social_2 = document.getElementById("sel_2");
                    var selectSocial_2 = social_2.options[social_2.selectedIndex].value;

                    var hrf = selectSocial_2 + '&str=' + selectSocial;
                    window.location=hrf;
                }
                function linklist_2(){
                    var social_2 = document.getElementById("sel_2");
                    var selectSocial_2 = social_2.options[social_2.selectedIndex].value;
                    var hrf = selectSocial_2 + '&str=1';
                    window.location=hrf;
                }
            </script>
            <select name="sel_2" id="sel_2" onChange="linklist_2()">
                <option value="show_tables_main_info.php?db=<?=$db?>&table=<?=$table?>&ns=<?=$per_page?>"><?= $per_page ?></option>
                <option value="show_tables_main_info.php?db=<?=$db?>&table=<?=$table?>&ns=25">25</option>
                <option value="show_tables_main_info.php?db=<?=$db?>&table=<?=$table?>&ns=50">50</option>
                <option value="show_tables_main_info.php?db=<?=$db?>&table=<?=$table?>&ns=100"">100</option>
                <option value="show_tables_main_info.php?db=<?=$db?>&table=<?=$table?>&ns=250">250</option>
                <option value="show_tables_main_info.php?db=<?=$db?>&table=<?=$table?>&ns=500">500</option>
            </select>
            <?php



            $total  = mysqli_num_rows($select);
            $count_pages = ceil($total/$per_page);


            // ЗДЕСЬ МЫ ПРОВЕРЯЕМ НА КАКОЙ СТРАНИЦЕ СЕЙЧАС ПОЛЬЗОВАТЕЛЬ
            if (isset($_GET['str'])) {
                $nav = $_GET['str'];
            }
            else {
                $nav = 0;
            }
            $nav = intval($nav); // ДЛЯ ЗАЩИТЫ ОТ НЕХОРОШИХ ДЯДЕНЕК МЫ ВЫДЕЛИМ ЦЕЛУЮ ЧАСТЬ $GET['str']
            echo 'Навигация: ';
            // А ТЕПЕРЬ ВЫВОДИМ НОМЕРА СТРАНЦ
            ?>
            <select name="sel" id="sel" onChange="linklist()">
                <option value="1"><?= $nav ?></option>
            <?php
            for ($i=1; $i<=$count_pages; $i++) {
                    ?>
                        <option value="<?=$i?>"><?=$i?></option>
                    <?php
            }
            ?>
            </select>
                <?php

            // НАЧИНАЕМ ВЫВОДИТЬ САМУ ИНФОРМАЦИЮ ПОСТРАНИЧНО :)
            if (!isset($_GET['str'])) {
                $str = 0;
            }
            else {
                $str = $_GET['str']*$per_page - $per_page;
            }


            $name_colum = array();
            $sql = "SHOW COLUMNS FROM `$table`";
            $result = mysqli_query($connect, $sql);
            while($row = mysqli_fetch_array($result)){
                $name_colum[] = $row['Field'];
            }
            ?>



            <link href="../../assets/for_sorted_table/sortable.css" rel="stylesheet" />
            <script src="../../assets/for_sorted_table/sortable.js"></script>
            <table border="1" class="sortable">
                <thead>
                    <tr>
                        <th>Действия</th>
                        <?php
                        foreach ($name_colum as $value) {
                            ?>
                            <th class="th_title_info"> <?= $value ?> </th>
                            <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `$table`";
                    $select = mysqli_query($connect, $sql);
                    $select = mysqli_query($connect, "SELECT * from $table limit $str, $per_page");
                    if(!empty($select)){
                        while ($select_while = mysqli_fetch_assoc($select)) {
                            ?>
                            <tr>
                                <td id="doing">
                                    <a href="update_row_table.php?db=<?=$db?>&table=<?=$table?>&value=<?=$select_while[$name_colum[0]]?>">
                                        <img src="../../assets/img/img_7.png" width="20" height="20" title="Изменить"></a>
                                    <a href="delete_row_from_database.php?db=<?=$db?>&table=<?=$table?>&value=<?=$select_while[$name_colum[0]]?>">
                                        <img src="../../assets/img/img_6.png" width="20" height="20" title="Удалить" onClick="return window.confirm('Хотите удалить эту строку?');">
                                    </a>
                                </td>
                                <?php
                                foreach ($name_colum as $value) {
                                    ?>
                                    <td  class="tb_title_info" id="<?=$value . '_!_' . $select_while[$name_colum[0]]?>" name="<?=$value .  $select_while[$name_colum[0]]?>"><?= $select_while[$value] ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
            <script>
                var tds = document.querySelectorAll('td');
                for (var i = 0; i < tds.length; i++) {
                    if(tds[i].id != 'doing'){
                        tds[i].addEventListener('dblclick', function func() {
                            var input = document.createElement('input');
                            input.value = this.innerHTML;
                            this.innerHTML = '';
                            this.appendChild(input);

                            var td = this;
                            input.addEventListener('blur', function() {
                                td.innerHTML = this.value;
                                td.addEventListener('dblclick', func);
                                var table = '<?=$table?>';
                                var db = '<?=$db?>';
                                var id_name = '<?=$name_colum[0]?>'
                                // здесь делать передачу в php
                                console.log(td.id);
                                console.log(td.innerText);
                                console.log(table);
                                $.ajax({
                                    url: "show_tables_main_info_cell_update.php",
                                    type: "POST",
                                    data: ({id: td.id, table: table, value: td.innerText, db: db, id_name : id_name}),
                                    dataType: "html",
                                    success: function (data){
                                        if(data == 'error'){
                                            alert("Error: Ошибка ввода");
                                            document.location.href = 'show_tables_main_info.php?db=' + db + '&table=' + table + '&ns=25'
                                        }
                                    },error: function(request, status, error){
                                        alert("Error: Could not delete");
                                    }
                                });
                            });

                            this.removeEventListener('dblclick', func);
                        });
                    }

                }

            </script>


        </div>


    </div>


</div>




</body>
</html>
