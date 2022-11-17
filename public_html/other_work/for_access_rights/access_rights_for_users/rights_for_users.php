<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path . '/connection.php';
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">


    <link rel="stylesheet" href="../../../assets/css/style_main.css">
    <link rel="stylesheet" href="../../../assets/css/style_header.css">
    <link rel="stylesheet" href="../../../assets/css/style_for_trigger.css">



    <title>Главная страница</title>

    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
</head>

<body>

<div class="main_body">
    <div>
        <?php
        include($path . '/header.php');
        ?>
    </div>


    <div class="main_info" style="margin-left: 200px;">


        <div>
            <a href="../work_whit_rights.php">Назад</a>
        </div>


        <h1>Настройка прав доступа для пользователей</h1>



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
                        $("#show_bar").html('Добавить Пользователя');
                    } else {
                        $("#show_bar").html('Отмена');
                    }
                });
            });
        </script>
        <style>
            #bar_block {display: none;}
        </style>
        <button id="show_bar">Добавить Пользователя</button>
        <div id="bar_block" class="add_trigger_main">
            <form action="changing_users/add_new_user_main.php" method="post">
                <div>
                    <div>
                        <input class="trigger_name" type="text" name="user_name" placeholder="Имя пользователя">
                    </div>
                    <div>
                        <input class="trigger_name" type="text" name="user_login" placeholder="Логин">
                    </div>
                    <div>
                        <input class="trigger_name" type="text" name="user_pass" placeholder="Пароль">
                    </div>
                    <div>
                        <select class="trigger_when" name="user_state" id="user_state">
                            <option value="main_admin">main_admin</option>
                            <option value="user">user</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Добавить Пользователя" />
                    </div>
                </div>
            </form>
        </div>





        <div style="margin-top: 20px;">
            <link href="../../../assets/for_sorted_table/sortable.css" rel="stylesheet" />
            <script src="../../../assets/for_sorted_table/sortable.js"></script>
            <table border="1" class="sortable">
                <thead>
                <tr>
                    <th class="th_title_info"> Действия </th>
                    <th class="th_title_info"> Id </th>
                    <th class="th_title_info"> Name </th>
                    <th class="th_title_info"> state </th>
                    <th class="th_title_info"> </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');
                $sql = "SELECT * FROM `users`;";
                $res = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <tr>
                        <td>
                            <a href="changing_users/update_user.php?id=<?= $row['id'] ?>"><img src="../../../assets/img/img_7.png" width="20" height="20" title="Изменить"></a>
                            <a href="changing_users/delete_user.php?id=<?= $row['id'] ?>"><img src="../../../assets/img/img_6.png" width="20" height="20" title="Удалить" onClick="return window.confirm('Хотите удалить этого пользователя?');"></a>
                        </td>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['state'] ?></td>
                        <td><a href="rights_for_specific_user/setting_access_rights.php?id_user=<?= $row['id'] ?>">Настроить права доступа</a></td>
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
