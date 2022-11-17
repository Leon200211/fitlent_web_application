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
    <link rel="stylesheet" href="../../../assets/css/style_for_procedures.css">



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

        <h2>Создать процедуру: </h2>

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
                        $("#show_bar").html('Добавить процедуру');
                    } else {
                        $("#show_bar").html('Отмена');
                    }
                });
            });
        </script>
        <style>
            #bar_block {display: none;}
        </style>
        <button id="show_bar">Добавить процедуру</button>
        <div id="bar_block" class="add_trigger_main">
            <form action="table_procedure_add.php" method="post">
                <div>
                    <input name="db" value="<?= $db ?>" hidden>
                    <div>
                        Имя процедуры
                        <input class="trigger_name" type="text" name="procedure_name">
                    </div>
                    <script type="text/javascript">
                        function Default_test() {
                            var social = document.getElementById("procedure_type");
                            var selectSocial = social.options[social.selectedIndex].value;
                            if(selectSocial == "PROCEDURE"){
                                console.log(1);
                                var isSocial = 1;
                                var show = document.getElementById("default_show");
                                show.style.display = isSocial ? 'inherit' : 'none';

                                var show_2 = document.getElementById("default_show_2");
                                show_2.style.display = 'none';
                            }else if(selectSocial == "FUNCTION"){
                                var isSocial = 1;
                                var show = document.getElementById("default_show_2");
                                show.style.display = isSocial ? 'inherit' : 'none';

                                var show_2 = document.getElementById("default_show");
                                show_2.style.display = 'none';
                            }
                        }
                    </script>
                    <div>
                        Тип
                        <select class="trigger_when" name="procedure_type" id="procedure_type" onchange=Default_test()>
                            <option value="PROCEDURE">PROCEDURE</option>
                            <option value="FUNCTION">FUNCTION</option>
                        </select>
                    </div>
                    <style>
                        .Default_test {
                            display: inherit;
                        }
                        .Default_test_2 {
                            display: none;
                        }
                    </style>









                    <div id="default_show" name="default_show_1" class="Default_test">
                        <div>
                            <select name="options_direction_1" id="options_direction_1">
                                <option value="IN">IN</option>
                                <option value="OUT">OUT</option>
                                <option value="INOUT">INOUT</option>
                            </select>
                            <input type="text" name="options_name_1" placeholder="Имя">
                            <select name="options_type_1" id="options_type_1">
                                <option value="INT">INT</option>
                                <option value="VARCHAR">VARCHAR</option>
                                <option value="TEXT">TEXT</option>
                                <option value="DATE">DATE</option>
                                <optgroup label="Числовые">
                                    <option value="TINYINT">TINYINT</option>
                                    <option value="SMALLINT">SMALLINT</option>
                                    <option value="MEDIUMINT">MEDIUMINT</option>
                                    <option value="INT">INT</option>
                                    <option value="BIGINT">BIGINT</option>
                                    <option value="DECIMAL">DECIMAL</option>
                                    <option value="FLOAT">FLOAT</option>
                                    <option value="DOUBLE">DOUBLE</option>
                                    <option value="REAL">REAL</option>
                                    <option value="BIT">BIT</option>
                                    <option value="BOOLEAN">BOOLEAN</option>
                                    <option value="SERIAL">SERIAL</option>
                                </optgroup>
                                <optgroup label="Дата и время">
                                    <option value="DATE">DATE</option>
                                    <option value="DATETIME">DATETIME</option>
                                    <option value="TIMESTAMP">TIMESTAMP</option>
                                    <option value="TIME">TIME</option>
                                    <option value="YEAR">YEAR</option>
                                </optgroup>
                                <optgroup label="Символьный">
                                    <option value="CHAR">CHAR</option>
                                    <option value="VARCHAR">VARCHAR</option>
                                    <option value="TINYTEXT">TINYTEXT</option>
                                    <option value="TEXT">TEXT</option>
                                    <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                                    <option value="LONGTEXT">LONGTEXT</option>
                                    <option value="BINARY">BINARY</option>
                                    <option value="VARBINARY">VARBINARY</option>
                                    <option value="TINYBLOB">TINYBLOB</option>
                                    <option value="BLOB">BLOB</option>
                                    <option value="MEDIUMBLOB">MEDIUMBLOB</option>
                                    <option value="LONGBLOB">LONGBLOB</option>
                                    <option value="ENUM">ENUM</option>
                                    <option value="SET">SET</option>
                                </optgroup>
                                <optgroup label="Пространственные">
                                    <option value="GEOMETRY">GEOMETRY</option>
                                    <option value="LINESTRING">LINESTRING</option>
                                    <option value="POLYGON">POLYGON</option>
                                    <option value="MULTIPOINT">MULTIPOINT</option>
                                    <option value="MULTILINESTRING">MULTILINESTRING</option>
                                    <option value="MULTIPOLYGON">MULTIPOLYGON</option>
                                    <option value="GEOMETRYCOLLECTION">GEOMETRYCOLLECTION</option>
                                </optgroup>
                                <optgroup label="Json">
                                    <option value="JSON">JSON</option>
                                </optgroup>
                            </select>
                            <input type="text" name="len_1" placeholder="Длина/Значения">
                            <select name="options_option_1" id="options_option_1">
                                <option value=""></option>
                                <option value="UNSIGNED">UNSIGNED</option>
                                <option value="ZEROFILL">ZEROFILL</option>
                                <option value="UNSIGNED ZEROFILL">UNSIGNED ZEROFILL</option>
                            </select>
                        </div>


                        <script type="text/javascript">
                            var x = 1;

                            function addInput() {
                                if (x < 11) {
                                    var str = '\
                                <div> \
                                    <select name="options_direction_' + (x + 1) + '" id="options_direction_' + (x + 1) + '"> \
                                        <option value="IN">IN</option> \
                                        <option value="OUT">OUT</option> \
                                        <option value="INOUT">INOUT</option> \
                                    </select> \
                                    <input type="text" name="options_name_' + (x + 1) + '" placeholder="Имя"> \
                                    <select name="options_type_' + (x + 1) + '" id="options_type_' + (x + 1) + '"> \
                                        <option value="INT">INT</option> \
                                        <option value="VARCHAR">VARCHAR</option> \
                                        <option value="TEXT">TEXT</option> \
                                        <option value="DATE">DATE</option> \
                                        <optgroup label="Числовые"> \
                                        <option value="TINYINT">TINYINT</option> \
                                        <option value="SMALLINT">SMALLINT</option> \
                                        <option value="MEDIUMINT">MEDIUMINT</option> \
                                        <option value="INT">INT</option> \
                                        <option value="BIGINT">BIGINT</option> \
                                        <option value="DECIMAL">DECIMAL</option> \
                                        <option value="FLOAT">FLOAT</option> \
                                        <option value="DOUBLE">DOUBLE</option> \
                                        <option value="REAL">REAL</option> \
                                        <option value="BIT">BIT</option> \
                                        <option value="BOOLEAN">BOOLEAN</option> \
                                        <option value="SERIAL">SERIAL</option> \
                                    </optgroup> \
                                    <optgroup label="Дата и время"> \
                                        <option value="DATE">DATE</option> \
                                        <option value="DATETIME">DATETIME</option> \
                                        <option value="TIMESTAMP">TIMESTAMP</option> \
                                        <option value="TIME">TIME</option> \
                                        <option value="YEAR">YEAR</option> \
                                    </optgroup> \
                                    <optgroup label="Символьный"> \
                                        <option value="CHAR">CHAR</option> \
                                        <option value="VARCHAR">VARCHAR</option> \
                                        <option value="TINYTEXT">TINYTEXT</option> \
                                        <option value="TEXT">TEXT</option> \
                                        <option value="MEDIUMTEXT">MEDIUMTEXT</option> \
                                        <option value="LONGTEXT">LONGTEXT</option> \
                                        <option value="BINARY">BINARY</option> \
                                        <option value="VARBINARY">VARBINARY</option> \
                                        <option value="TINYBLOB">TINYBLOB</option> \
                                        <option value="BLOB">BLOB</option> \
                                        <option value="MEDIUMBLOB">MEDIUMBLOB</option> \
                                        <option value="LONGBLOB">LONGBLOB</option> \
                                        <option value="ENUM">ENUM</option> \
                                        <option value="SET">SET</option> \
                                    </optgroup> \
                                    <optgroup label="Пространственные"> \
                                        <option value="GEOMETRY">GEOMETRY</option> \
                                        <option value="LINESTRING">LINESTRING</option> \
                                        <option value="POLYGON">POLYGON</option> \
                                        <option value="MULTIPOINT">MULTIPOINT</option> \
                                        <option value="MULTILINESTRING">MULTILINESTRING</option> \
                                        <option value="MULTIPOLYGON">MULTIPOLYGON</option> \
                                        <option value="GEOMETRYCOLLECTION">GEOMETRYCOLLECTION</option> \
                                    </optgroup> \
                                    <optgroup label="Json"> \
                                    <option value="JSON">JSON</option> \
                                    </optgroup> \
                                    </select> \
                                    <input type="text" name="len_' + (x + 1) + '" placeholder="Длина/Значения"> \
                                    <select name="options_option_' + (x + 1) + '" id="options_option_' + (x + 1) + '"> \
                                        <option value=""></option> \
                                        <option value="UNSIGNED">UNSIGNED</option> \
                                        <option value="ZEROFILL">ZEROFILL</option> \
                                        <option value="UNSIGNED ZEROFILL">UNSIGNED ZEROFILL</option> \
                                    </select> \
                                </div> \
                                <div id="input' + (x + 1) + '"></div>';
                                    document.getElementById('input' + x).innerHTML = str;


                                    x++;
                                } else
                                {
                                    alert('STOP it!');
                                }
                            }
                        </script>

                        <div id="input1"></div>

                        <style>
                            .add
                            {
                                width: 75px;
                                height: 35px;
                                border: 1px dashed grey;
                                margin: 10px 0;
                            }
                            .add:hover
                            {
                                cursor: pointer;
                                background-color: grey;
                            }
                        </style>
                        <div class="add" onclick="addInput()">Добавить параметры</div>
                    </div>













                    <div id="default_show_2" name="default_show_2" class="Default_test_2">
                        <input type="text" name="options_name_2_1" placeholder="Имя">
                        <select name="options_type_2_1" id="options_type_2_1">
                            <option value="INT">INT</option>
                            <option value="VARCHAR">VARCHAR</option>
                            <option value="TEXT">TEXT</option>
                            <option value="DATE">DATE</option>
                            <optgroup label="Числовые">
                                <option value="TINYINT">TINYINT</option>
                                <option value="SMALLINT">SMALLINT</option>
                                <option value="MEDIUMINT">MEDIUMINT</option>
                                <option value="INT">INT</option>
                                <option value="BIGINT">BIGINT</option>
                                <option value="DECIMAL">DECIMAL</option>
                                <option value="FLOAT">FLOAT</option>
                                <option value="DOUBLE">DOUBLE</option>
                                <option value="REAL">REAL</option>
                                <option value="BIT">BIT</option>
                                <option value="BOOLEAN">BOOLEAN</option>
                                <option value="SERIAL">SERIAL</option>
                            </optgroup>
                            <optgroup label="Дата и время">
                                <option value="DATE">DATE</option>
                                <option value="DATETIME">DATETIME</option>
                                <option value="TIMESTAMP">TIMESTAMP</option>
                                <option value="TIME">TIME</option>
                                <option value="YEAR">YEAR</option>
                            </optgroup>
                            <optgroup label="Символьный">
                                <option value="CHAR">CHAR</option>
                                <option value="VARCHAR">VARCHAR</option>
                                <option value="TINYTEXT">TINYTEXT</option>
                                <option value="TEXT">TEXT</option>
                                <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                                <option value="LONGTEXT">LONGTEXT</option>
                                <option value="BINARY">BINARY</option>
                                <option value="VARBINARY">VARBINARY</option>
                                <option value="TINYBLOB">TINYBLOB</option>
                                <option value="BLOB">BLOB</option>
                                <option value="MEDIUMBLOB">MEDIUMBLOB</option>
                                <option value="LONGBLOB">LONGBLOB</option>
                                <option value="ENUM">ENUM</option>
                                <option value="SET">SET</option>
                            </optgroup>
                            <optgroup label="Пространственные">
                                <option value="GEOMETRY">GEOMETRY</option>
                                <option value="LINESTRING">LINESTRING</option>
                                <option value="POLYGON">POLYGON</option>
                                <option value="MULTIPOINT">MULTIPOINT</option>
                                <option value="MULTILINESTRING">MULTILINESTRING</option>
                                <option value="MULTIPOLYGON">MULTIPOLYGON</option>
                                <option value="GEOMETRYCOLLECTION">GEOMETRYCOLLECTION</option>
                            </optgroup>
                            <optgroup label="Json">
                                <option value="JSON">JSON</option>
                            </optgroup>
                        </select>
                        <input type="text" name="len_2_1" placeholder="Длина/Значения">
                        <select name="options_option_2_1" id="options_option_2_1">
                            <option value=""></option>
                            <option value="UNSIGNED">UNSIGNED</option>
                            <option value="ZEROFILL">ZEROFILL</option>
                            <option value="UNSIGNED ZEROFILL">UNSIGNED ZEROFILL</option>
                        </select>



                        <script type="text/javascript">
                            var x_2 = 1;

                            function addInput_2() {
                                if (x_2 < 8) {
                                    var str_2 = '\
                                        <input type="text" name="options_name_2' + (x_2 + 1) + '" placeholder="Имя">\
                                        <select name="options_type_2' + (x_2 + 1) + '" id="options_type_2' + (x_2 + 1) + '">\
                                            <option value="INT">INT</option>\
                                            <option value="VARCHAR">VARCHAR</option>\
                                            <option value="TEXT">TEXT</option>\
                                            <option value="DATE">DATE</option>\
                                            <optgroup label="Числовые">\
                                            <option value="TINYINT">TINYINT</option>\
                                            <option value="SMALLINT">SMALLINT</option>\
                                            <option value="MEDIUMINT">MEDIUMINT</option>\
                                            <option value="INT">INT</option>\
                                            <option value="BIGINT">BIGINT</option>\
                                            <option value="DECIMAL">DECIMAL</option>\
                                            <option value="FLOAT">FLOAT</option>\
                                            <option value="DOUBLE">DOUBLE</option>\
                                            <option value="REAL">REAL</option>\
                                            <option value="BIT">BIT</option>\
                                            <option value="BOOLEAN">BOOLEAN</option>\
                                            <option value="SERIAL">SERIAL</option>\
                                            </optgroup>\
                                            <optgroup label="Дата и время">\
                                            <option value="DATE">DATE</option>\
                                            <option value="DATETIME">DATETIME</option>\
                                            <option value="TIMESTAMP">TIMESTAMP</option>\
                                            <option value="TIME">TIME</option>\
                                            <option value="YEAR">YEAR</option>\
                                            </optgroup>\
                                            <optgroup label="Символьный">\
                                            <option value="CHAR">CHAR</option>\
                                            <option value="VARCHAR">VARCHAR</option>\
                                            <option value="TINYTEXT">TINYTEXT</option>\
                                            <option value="TEXT">TEXT</option>\
                                            <option value="MEDIUMTEXT">MEDIUMTEXT</option>\
                                            <option value="LONGTEXT">LONGTEXT</option>\
                                            <option value="BINARY">BINARY</option>\
                                            <option value="VARBINARY">VARBINARY</option>\
                                            <option value="TINYBLOB">TINYBLOB</option>\
                                            <option value="BLOB">BLOB</option>\
                                            <option value="MEDIUMBLOB">MEDIUMBLOB</option>\
                                            <option value="LONGBLOB">LONGBLOB</option>\
                                            <option value="ENUM">ENUM</option>\
                                            <option value="SET">SET</option>\
                                            </optgroup>\
                                            <optgroup label="Пространственные">\
                                            <option value="GEOMETRY">GEOMETRY</option>\
                                            <option value="LINESTRING">LINESTRING</option>\
                                            <option value="POLYGON">POLYGON</option>\
                                            <option value="MULTIPOINT">MULTIPOINT</option>\
                                            <option value="MULTILINESTRING">MULTILINESTRING</option>\
                                            <option value="MULTIPOLYGON">MULTIPOLYGON</option>\
                                            <option value="GEOMETRYCOLLECTION">GEOMETRYCOLLECTION</option>\
                                            </optgroup>\
                                            <optgroup label="Json">\
                                            <option value="JSON">JSON</option>\
                                            </optgroup>\
                                        </select>\
                                        <input type="text" name="len_2' + (x_2 + 1) + '" placeholder="Длина/Значения">\
                                        <select name="options_option_2' + (x_2 + 1) + '" id="options_option_2' + (x_2 + 1) + '">\
                                            <option value=""></option>\
                                            <option value="UNSIGNED">UNSIGNED</option>\
                                            <option value="ZEROFILL">ZEROFILL</option>\
                                            <option value="UNSIGNED ZEROFILL">UNSIGNED ZEROFILL</option>\
                                        </select>\
                                        <div id="input_2_' + (x_2 + 1) + '"></div>';
                                    document.getElementById('input_2_' + x_2).innerHTML = str_2;
                                    x_2++;
                                } else
                                {
                                    alert('STOP it!');
                                }
                            }
                        </script>

                        <div id="input_2_1"></div>
                        <style>
                            .add
                            {
                                width: 75px;
                                height: 35px;
                                border: 1px dashed grey;
                                margin: 10px 0;
                            }
                            .add:hover
                            {
                                cursor: pointer;
                                background-color: grey;
                            }
                        </style>
                        <div class="add" onclick="addInput_2()">Добавить параметры</div>




                        <div>
                            Возвращаемый тип
                            <select name="return_type" id="return_type">
                                <option value="INT">INT</option>
                                <option value="VARCHAR">VARCHAR</option>
                                <option value="TEXT">TEXT</option>
                                <option value="DATE">DATE</option>
                                <optgroup label="Числовые">
                                    <option value="TINYINT">TINYINT</option>
                                    <option value="SMALLINT">SMALLINT</option>
                                    <option value="MEDIUMINT">MEDIUMINT</option>
                                    <option value="INT">INT</option>
                                    <option value="BIGINT">BIGINT</option>
                                    <option value="DECIMAL">DECIMAL</option>
                                    <option value="FLOAT">FLOAT</option>
                                    <option value="DOUBLE">DOUBLE</option>
                                    <option value="REAL">REAL</option>
                                    <option value="BIT">BIT</option>
                                    <option value="BOOLEAN">BOOLEAN</option>
                                    <option value="SERIAL">SERIAL</option>
                                </optgroup>
                                <optgroup label="Дата и время">
                                    <option value="DATE">DATE</option>
                                    <option value="DATETIME">DATETIME</option>
                                    <option value="TIMESTAMP">TIMESTAMP</option>
                                    <option value="TIME">TIME</option>
                                    <option value="YEAR">YEAR</option>
                                </optgroup>
                                <optgroup label="Символьный">
                                    <option value="CHAR">CHAR</option>
                                    <option value="VARCHAR">VARCHAR</option>
                                    <option value="TINYTEXT">TINYTEXT</option>
                                    <option value="TEXT">TEXT</option>
                                    <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                                    <option value="LONGTEXT">LONGTEXT</option>
                                    <option value="BINARY">BINARY</option>
                                    <option value="VARBINARY">VARBINARY</option>
                                    <option value="TINYBLOB">TINYBLOB</option>
                                    <option value="BLOB">BLOB</option>
                                    <option value="MEDIUMBLOB">MEDIUMBLOB</option>
                                    <option value="LONGBLOB">LONGBLOB</option>
                                    <option value="ENUM">ENUM</option>
                                    <option value="SET">SET</option>
                                </optgroup>
                                <optgroup label="Пространственные">
                                    <option value="GEOMETRY">GEOMETRY</option>
                                    <option value="LINESTRING">LINESTRING</option>
                                    <option value="POLYGON">POLYGON</option>
                                    <option value="MULTIPOINT">MULTIPOINT</option>
                                    <option value="MULTILINESTRING">MULTILINESTRING</option>
                                    <option value="MULTIPOLYGON">MULTIPOLYGON</option>
                                    <option value="GEOMETRYCOLLECTION">GEOMETRYCOLLECTION</option>
                                </optgroup>
                                <optgroup label="Json">
                                    <option value="JSON">JSON</option>
                                </optgroup>
                            </select>
                        </div>

                        <div>
                            Вернуть Длину/Значения
                            <input name="return_len" type="text">
                        </div>

                        <div>
                            Вернуть параметры
                            <select name="return_option" id="return_option">
                                <option value=""></option>
                                <option value="UNSIGNED">UNSIGNED</option>
                                <option value="ZEROFILL">ZEROFILL</option>
                                <option value="UNSIGNED ZEROFILL">UNSIGNED ZEROFILL</option>
                            </select>
                        </div>
                    </div>



                    </div>


                    <br>
                    <div>
                        Описание
                        <textarea class="trigger_main" name="definition" placeholder="Описание"></textarea>
                    </div>
                    <div>
                        Определение
                        <input type="checkbox" id="definition_che" name="definition_che">
                    </div>
                    <div>
                        Определитель
                        <input type="text" name="determinant">
                    </div>
                    <div>
                        Тип безопастности
                        <select name="options_option" id="options_option">
                            <option value=""></option>
                            <option value="DEFINER">DEFINER</option>
                            <option value="ZEROFILL">INVOKER</option>
                        </select>
                    </div>
                    <div>
                        Доступ к SQL данным
                        <select name="access_data" id="access_data">
                            <option value="NO SQL">NO SQL</option>
                            <option value="CONTAINS SQL">CONTAINS SQL</option>
                            <option value="READS SQL DATA">READS SQL DATA</option>
                            <option value="MODIFIES SQL DATA">MODIFIES SQL DATA</option>
                        </select>
                    </div>
                    <div>
                        Комментарий
                        <input type="text" name="comm">
                    </div>

                    <div>
                        <input type="submit" name="submit" value="Добавить Процедуру" />
                    </div>
                </div>
            </form>
        </div>





    <div style="margin-top: 50px;">

        <link href="../../../assets/for_sorted_table/sortable.css" rel="stylesheet" />
        <script src="../../../assets/for_sorted_table/sortable.js"></script>
        <table border="1" class="sortable">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Create Procedure</th>
                <th>Действия</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "show PROCEDURE STATUS;";
            $select = mysqli_query($connect, $sql);
            while($select_while = mysqli_fetch_assoc($select)) {
                if($select_while['Db'] == $db){
                    $pro_name = $select_while['Name'];
                    $sql_2 = "SHOW CREATE PROCEDURE $pro_name;";
                    $select_2 = mysqli_query($connect, $sql_2);
                    $select_2 = mysqli_fetch_assoc($select_2);
                    ?>
                    <tr>
                        <td class="tb_title_info"><?=$select_2['Procedure']?></td>
                        <td class="tb_title_info"><?=$select_2['Create Procedure']?></td>
                        <td id="doing">
                            <a href="#">
                                <img src="../../../assets/img/img_7.png" width="20" height="20" title="Изменить"></a>
                            <a href="#">
                                <img src="../../../assets/img/img_21.png" width="22" height="22" title="Экспорт"></a>
                            <a href="#">
                                <img src="../../../assets/img/img_6.png" width="20" height="20" title="Удалить" onClick="return window.confirm('Хотите удалить этот триггер?');">
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }
                ?>
            </tbody>
        </table>


    </div>



</div>



</body>
</html>
