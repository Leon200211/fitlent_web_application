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


    <link rel="stylesheet" href="../../../../assets/css/style_main.css">
    <link rel="stylesheet" href="../../../../assets/css/style_header.css">


    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="style/style_fon.css">












    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/sunny/jquery-ui.css">
    <style type="text/css">
        div.dragElement {font-size: large; border: thin solid black; padding:16px;
            width: 8em; text-align: center; background-color: lightgray; margin: 4px;}
    </style>
    <script type="text/javascript">

        $(function() {

            $('.dragElement').draggable({
                containment: "parent"
            }).filter('#dragH').draggable("option", "axis", "x");


        });
    </script>









    <title>Главная страница</title>

    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
</head>

<body>


<div class="main_body" id="text-demo">


    <div>
        <?php
        //include('../header.php');
        ?>
    </div>


    <a href="../../../show_tables.php?db=<?= $db ?>">Назад</a>

    <div>


        <!--        Карта-->
        <canvas id="map"></canvas>
        <script src="script/pagemap.min.js"></script>
        <script>
            pagemap(document.querySelector('#map'));
        </script>



<!--        холст-->
        <div class="fon">

            <?php
            $sql = "SHOW TABLE STATUS;";
            $res = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <div id="draggable" class="dragElement ui-widget ui-corner-all ui-state-error">
                    <?=$row["Name"]?>
                    <div>
                        <?php
                        $table = $row["Name"];
                        $sql = "SHOW COLUMNS FROM `$table`";
                        $result = mysqli_query($connect, $sql);
                        while($row_table = mysqli_fetch_array($result)){
                            ?>
                            <div>
                                <?=$row_table['Field']?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>







    </div>



</div>
</body>
</html>