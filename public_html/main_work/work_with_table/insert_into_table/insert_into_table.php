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



        <form action="insert_into_table_main.php" method="post">
            <link href="../../../assets/for_sorted_table/sortable.css" rel="stylesheet" />
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

            $q = mysqli_query($connect, "DESCRIBE $table;");
            while($row = mysqli_fetch_array($q)) {
                ?>
                <tr>
                    <td><?=$row['Field']?></td>
                    <td><?=$row['Type']?></td>
                    <td>
                        <select name="fun<?=$row['Field']?>" id="fun<?=$row['Field']?>">
                            <option value="">---</option>
                            <option value="ABS">ABS</option>
                            <option value="ACOS">ACOS</option>
                            <option value="ASCII">ASCII</option>
                            <option value="ASIN">ASIN</option>
                            <option value="ATAN">ATAN</option>
                            <option value="BIT_LENGTH">BIT_LENGTH</option>
                            <option value="BIT_COUNT">BIT_COUNT</option>
                            <option value="CEILING">CEILING</option>
                            <option value="CHAR_LENGTH">CHAR_LENGTH</option>
                            <option value="CONNECTION_ID">CONNECTION_ID</option>
                            <option value="COS">COS</option>
                            <option value="COT">COT</option>
                            <option value="CRC32">CRC32</option>
                            <option value="DAYOFMONTH">DAYOFMONTH</option>
                            <option value="DAYOFWEEK">DAYOFWEEK</option>
                            <option value="DAYOFYEAR">DAYOFYEAR</option>
                            <option value="DEGREES">DEGREES</option>
                            <option value="EXP">EXP</option>
                            <option value="FLOOR">FLOOR</option>
                            <option value="HOUR">HOUR</option>
                            <option value="INET6_ATON">INET6_ATON</option>
                            <option value="INET_ATON">INET_ATON</option>
                            <option value="LENGTH">LENGTH</option>
                            <option value="LN">LN</option>
                            <option value="LOG">LOG</option>
                            <option value="LOG2">LOG2</option>
                            <option value="LOG10">LOG10</option>
                            <option value="MICROSECOND">MICROSECOND</option>
                            <option value="MONTH">MONTH</option>
                            <option value="OCT">OCT</option>
                            <option value="ORD">ORD</option>
                            <option value="PI">PI</option>
                            <option value="QUARTER">QUARTER</option>
                            <option value="RADIANS">RADIANS</option>
                            <option value="RAND">RAND</option>
                            <option value="ROUND">ROUND</option>
                            <option value="SECOND">SECOND</option>
                            <option value="SIGN">SIGN</option>
                            <option value="SIN">SIN</option>
                            <option value="SQRT">SQRT</option>
                            <option value="TAN">TAN</option>
                            <option value="TO_DAYS">TO_DAYS</option>
                            <option value="TO_SECONDS">TO_SECONDS</option>
                            <option value="TIME_TO_SEC">TIME_TO_SEC</option>
                            <option value="UNCOMPRESSED_LENGTH">UNCOMPRESSED_LENGTH</option>
                            <option value="UNIX_TIMESTAMP">UNIX_TIMESTAMP</option>
                            <option value="UUID_SHORT">UUID_SHORT</option>
                            <option value="WEEK">WEEK</option>
                            <option value="WEEKDAY">WEEKDAY</option>
                            <option value="WEEKOFYEAR">WEEKOFYEAR</option>
                            <option value="YEARWEEK">YEARWEEK</option>
                            <option value="" disabled="disabled">--------</option>
                            <option value="AES_DECRYPT">AES_DECRYPT</option>
                            <option value="AES_ENCRYPT">AES_ENCRYPT</option>
                            <option value="BIN">BIN</option>
                            <option value="CHAR">CHAR</option>
                            <option value="COMPRESS">COMPRESS</option>
                            <option value="CURRENT_DATE">CURRENT_DATE</option>
                            <option value="CURRENT_TIME">CURRENT_TIME</option>
                            <option value="CURRENT_USER">CURRENT_USER</option>
                            <option value="DATABASE">DATABASE</option>
                            <option value="DATE">DATE</option>
                            <option value="DAYNAME">DAYNAME</option>
                            <option value="DES_DECRYPT">DES_DECRYPT</option>
                            <option value="DES_ENCRYPT">DES_ENCRYPT</option>
                            <option value="ENCRYPT">ENCRYPT</option>
                            <option value="FROM_DAYS">FROM_DAYS</option>
                            <option value="FROM_UNIXTIME">FROM_UNIXTIME</option>
                            <option value="HEX">HEX</option>
                            <option value="INET6_NTOA">INET6_NTOA</option>
                            <option value="INET_NTOA">INET_NTOA</option>
                            <option value="LAST_DAY">LAST_DAY</option>
                            <option value="LOAD_FILE">LOAD_FILE</option>
                            <option value="LOWER">LOWER</option>
                            <option value="LTRIM">LTRIM</option>
                            <option value="MD5">MD5</option>
                            <option value="MONTHNAME">MONTHNAME</option>
                            <option value="NOW">NOW</option>
                            <option value="OLD_PASSWORD">OLD_PASSWORD</option>
                            <option value="PASSWORD">PASSWORD</option>
                            <option value="QUOTE">QUOTE</option>
                            <option value="REVERSE">REVERSE</option>
                            <option value="RTRIM">RTRIM</option>
                            <option value="SEC_TO_TIME">SEC_TO_TIME</option>
                            <option value="SHA1">SHA1</option>
                            <option value="SOUNDEX">SOUNDEX</option>
                            <option value="SPACE">SPACE</option>
                            <option value="SYSDATE">SYSDATE</option>
                            <option value="TIME">TIME</option>
                            <option value="TIMESTAMP">TIMESTAMP</option>
                            <option value="TRIM">TRIM</option>
                            <option value="UNCOMPRESS">UNCOMPRESS</option>
                            <option value="UNHEX">UNHEX</option>
                            <option value="UPPER">UPPER</option>
                            <option value="USER">USER</option>
                            <option value="UTC_DATE">UTC_DATE</option>
                            <option value="UTC_TIME">UTC_TIME</option>
                            <option value="UTC_TIMESTAMP">UTC_TIMESTAMP</option>
                            <option value="UUID">UUID</option>
                            <option value="VERSION">VERSION</option>
                            <option value="YEAR">YEAR</option>

                        </select>
                    </td>
                    <td><?=$row['Null']?></td>
                    <?php
                    if($row['Default']){
                        ?>
                        <td><input type="text" name="<?=$row['Field']?>" value="<?=$row['Default']?>"></td>
                            <?php
                    } else {
                        ?>
                        <td><input type="text" name="<?=$row['Field']?>"></td>
                    <?php
                    }
                    ?>
                </tr>
                <?php
            }



            ?>
                </tbody>
            </table>


            <input name="db" value="<?= $db ?>" hidden>
            <input name="table" value="<?= $table ?>" hidden>

            <input type="submit" name="submit" value="Вставить" />
        </form>

    </div>




</div>



</body>
</html>
