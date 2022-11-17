<?php

$db = $_POST['db'];
$table = $_POST['table'];

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);



?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">


        <link rel="stylesheet" href="../../../assets/css/style_main.css">
        <link rel="stylesheet" href="../../../assets/css/style_header.css">
        <link rel="stylesheet" href="../../../assets/css/style_for_table.css">



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


    <div style="margin-left: 200px; overflow: auto; margin-top: 100px;">

<?php




$str = "";
$q = mysqli_query($connect, "SHOW COLUMNS FROM `$table`");
while($row = mysqli_fetch_array($q)) {

    if(!empty($_POST[$row['Field']])){
        //$str .= $row['Field'] . " " . $_POST["operator" . $row['Field']] . " " . $_POST[$row['Field']];

        if($_POST["operator" . $row['Field']] == 'LIKE%'){
            $str .= "`" . $row['Field'] . "` LIKE '%" . $_POST[$row['Field']] . "%' AND ";
        }else if($_POST["operator" . $row['Field']] == 'REGEXP^'){
            $str .= "`" . $row['Field'] . "` REGEXP '^" . $_POST[$row['Field']] . "$' AND ";
        }else if($_POST["operator" . $row['Field']] == 'IN'){
            $str .= "`" . $row['Field'] . "` IN('" . $_POST[$row['Field']] . "') AND ";
        }else if($_POST["operator" . $row['Field']] == 'NIN'){
            $str .= "`" . $row['Field'] . "` NOT IN('" . $_POST[$row['Field']] . "') AND ";
        }else{
            $str .= "`" . $row['Field'] . "` " . $_POST["operator" . $row['Field']] . " '" . $_POST[$row['Field']] . "' AND ";
        }

    }

}

$str = substr($str,0,-4);

$sql = "SELECT * FROM `$table` WHERE $str";


if(mysqli_query($connect, $sql)){
    $select = mysqli_query($connect, $sql)
    ?>
    <a href="search_table.php?db=<?=$db?>&table=<?=$table?>">Назад</a>

    <h3>Результат по запросу: <?=$sql?></h3>

    <link href="../../../assets/for_sorted_table/sortable.css" rel="stylesheet" />
    <script src="../../../assets/for_sorted_table/sortable.js"></script>
    <table border="1" class="sortable">
        <thead>
        <tr>
            <?php
            $name_colum = array();
            $sql = "SHOW COLUMNS FROM `$table`";
            $result = mysqli_query($connect, $sql);
            while($row = mysqli_fetch_array($result)){
                $name_colum[] = $row['Field'];
                ?>
                <th class="th_title_info"> <?= $row['Field'] ?> </th>
                <?php
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($select)){
            while ($select_while = mysqli_fetch_assoc($select)) {
                ?>
                <tr>
                    <?php
                    foreach ($name_colum as $value) {
                        ?>
                        <td  class="tb_title_info"><?= $select_while[$value] ?></td>
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
    <?php
} else {
    ?>
    <a href="search_table.php?db=<?=$db?>&table=<?=$table?>">Назад</a>
    <div>
        У вас ошибка в запросе <?=$sql?>
    </div>
    <?php
}



?>

    </div>
</div>
</body>
</html>

