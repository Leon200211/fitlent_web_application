<?php
$db = $_GET['db'];
$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', $db);
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
}





#====================================================
# БЛОК СОХРАНЕНИЯ ФАЙЛА В БД
#====================================================


// File upload.php
// Если в $_FILES существует "image" и она не NULL
if (isset($_FILES['tables'])) {
// Получаем нужные элементы массива "sql"
    $fileTmpName = $_FILES['tables']['tmp_name'];
    $errorCode = $_FILES['tables']['error'];

    // Проверим на ошибки
    if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName)) {
        // Массив с названиями ошибок
        $errorMessages = [
            UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
            UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
            UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
            UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
            UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
            UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
            UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
        ];
        // Зададим неизвестную ошибку
        $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
        // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
        $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
        // Выведем название ошибки
        die($outputMessage);
    } else {
        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);
        // Получим MIME-тип
        $mime = (string) finfo_file($fi, $fileTmpName);
        // Проверим ключевое слово text/plain
        if (strpos($mime, 'text/plain') === false) die('Можно загружать только .sql');
        // Результат функции запишем в переменную
        $tables = getimagesize($fileTmpName);
        $name = "tables_" . $db . ".sql";
        // Переместим файл с новым именем и расширением в папку
        $path = $_SERVER['DOCUMENT_ROOT'];
        if (!move_uploaded_file($fileTmpName, $path . '/assets/Dump/import/' . $name)) {
            die('При записи файла на диск произошла ошибка.');
        } else {   // если загрузили файл на сервер пытаемся загрузить его на сервер в бд
            $path = $_SERVER['DOCUMENT_ROOT'];
            $filename = $path . '/assets/Dump/import/' . $name;
            $database	= $db;
            $user		= 'root';
            $password	= 'root';

            $host = '127.0.0.1';

            // формируем запрос к консоли бд
            $command = 'mysql -h ' . $host . ' -u ' . $user . ' -p' . $password . ' ' . $database . ' < ' . $filename;
            // выполняем команду
            exec($command, $output, $worked);
            switch ($worked) {
                case 0:
                    header("Location: http://gui/main_work/show_tables.php?db=$db");
                    echo 'Import file <b>' . $filename . '</b> successfully imported to database <b>' . $database . '</b>';
                    break;
                case 1:
                    echo 'There was an error during import.'
                        . 'Please make sure the import file is saved in the same folder as this script and check your values:'
                        . '<br/><br/><table>'
                        . '<tr><td>MySQL Database Name:</td><td><b>' . $database . '</b></td></tr>'
                        . '<tr><td>MySQL User Name:</td><td><b>' . $user . '</b></td></tr>'
                        . '<tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr>'
                        . '<tr><td>MySQL Host Name:</td><td><b>' . $host . '</b></td></tr>'
                        . '<tr><td>MySQL Import Filename:</td><td><b>' . $filename . '</b></td>'
                        . '</tr></table>';
                    break;
            }
        }

    }
};

?>




<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">


    <link rel="stylesheet" href="../../../assets/css/style_main.css">
    <link rel="stylesheet" href="../../../assets/css/style_header.css">



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


        <h1> Импорт в базу данных <?=$db?>: </h1>

        <div>
            <a href="../../show_tables.php?db=<?= $db ?>">Назад</a>
        </div>

        <form enctype="multipart/form-data" method="post">
            <p>Загрузите ваш файл сюда</p>
            <input type="file" name="tables">
            <input type="submit" value="Отправить">
        </form>


    </div>







</div>
</body>
</html>
