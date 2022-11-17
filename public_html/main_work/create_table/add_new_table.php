n      <?php

if(!empty($_POST['db']) and !empty($_POST['table_name']) and !empty($_POST['count_columns'])){
    $db = $_POST['db'];
    $table_name = $_POST['table_name'];
    $count_columns = $_POST['count_columns'];
} else if(!empty($_GET['db']) and !empty($_GET['table']) and !empty($_GET['count_columns']) and !empty($_GET['error'])){
    $db = $_GET['db'];
    $table_name = $_GET['table'];
    $count_columns = $_GET['count_columns'];
    $error = $_GET['error'];
}





//$mas_test_1 = ['Имя', 'Тип', 'Длина/значения', 'По умолчанию', 'Сравнение', 'Атрибуты', 'Null', 'Индекс', 'A_I', 'Комментарии', 'Виртуальность', 'Переместить поле'];
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">


    <link rel="stylesheet" href="../../assets/css/style_main.css">
    <link rel="stylesheet" href="../../assets/css/style_header.css">
    <link rel="stylesheet" href="../../assets/css/style_for_work_with_table.css">



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



    <div style="margin-left: 200px;    overflow: auto;">

        <h1>База данных: <?= $db ?></h1>
        <h2>Создание таблицы: <?= $table_name ?></h2>

        <?php
        if(isset($error)){
            ?>
            <h3>Ошибка: <?= $error ?></h3>
        <?php
        }
        ?>


        <h5 style="color: red;">ВНИМАНИЕ! при создании таблицы, первым слобцом должно быть уникальное значение</h5>

        <a href="../show_tables.php?db=<?= $db ?>">Назад</a>




        <form action="add_new_table_main.php" method="post">
        <div>
            <table border="1">
                <tr>
                    <th> Имя </th>
                    <th> Тип </th>
                    <th> Длина/значения </th>
                    <th> По умолчанию </th>
                    <th> Сравнение </th>
                    <th> Атрибуты </th>
                    <th> Null </th>
                    <th> Индекс </th>
                    <th> A_I </th>
                    <th> Комментарии </th>
                    <th> Виртуальность </th>
                </tr>
                <?php
                for($i = 0; $i < $count_columns; $i++){
                    ?>
                    <tr>
                        <td><input type="text" id="column_name<?=$i?>" name="column_name<?=$i?>"></td>
                        <td>
                            <select name="type<?=$i?>" id="type<?=$i?>">
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
                        </td>
                        <td><input type="text" id="Length/Values<?=$i?>" name="Length/Values<?=$i?>"></td>



                        <script type="text/javascript">
                            function Default_test(i) {
                                var social = document.getElementById("default"+i);
                                var selectSocial = social.options[social.selectedIndex].value;
                                var isSocial = selectSocial == "Как определено:"
                                var show = document.getElementById("default_show"+i);
                                show.style.display = isSocial ? 'inherit': 'none';
                            }
                        </script>
                        <td>
                            <select name="default<?=$i?>" id="default<?=$i?>" onchange=Default_test(<?=$i?>)>
                                <option value="Нет">Нет</option>
                                <option value="Как определено:">Как определено:</option>
                                <option value="NULL">NULL</option>
                                <option value="CURRENT_TIMESTAMP">CURRENT_TIMESTAMP</option>
                            </select>
                            <input type="text" placeholder="Введите ссылку" id="default_show<?=$i?>" name="default_show<?=$i?>" class="Default_test">
                        </td>


                        <td>
                            <select lang="en" dir="ltr" name="comparison<?=$i?>" id="comparison<?=$i?>">
                                <option value=""></option>
                                <optgroup label="armscii8" title="ARMSCII-8 Armenian">
                                    <option value="armscii8_bin" title="Армянский, Двоичный">armscii8_bin</option>
                                    <option value="armscii8_general_ci" title="Армянский, регистронезависимый">armscii8_general_ci</option>
                                </optgroup>
                                <optgroup label="ascii" title="US ASCII">
                                    <option value="ascii_bin" title="Западно-Европейский, Двоичный">ascii_bin</option>
                                    <option value="ascii_general_ci" title="Западно-Европейский, регистронезависимый">ascii_general_ci</option>
                                </optgroup>
                                <optgroup label="big5" title="Big5 Traditional Chinese">
                                    <option value="big5_bin" title="Китайский традиционный, Двоичный">big5_bin</option>
                                    <option value="big5_chinese_ci" title="Китайский традиционный, регистронезависимый">big5_chinese_ci</option>
                                </optgroup>
                                <optgroup label="binary" title="Binary pseudo charset">
                                    <option value="binary" title="Двоичный">binary</option>
                                </optgroup>
                                <optgroup label="cp1250" title="Windows Central European">
                                    <option value="cp1250_bin" title="Центрально-Европейский, Двоичный">cp1250_bin</option>
                                    <option value="cp1250_croatian_ci" title="Хорватский, регистронезависимый">cp1250_croatian_ci</option>
                                    <option value="cp1250_czech_cs" title="Чешский, регистрозависимый">cp1250_czech_cs</option>
                                    <option value="cp1250_general_ci" title="Центрально-Европейский, регистронезависимый">cp1250_general_ci</option>
                                    <option value="cp1250_polish_ci" title="Польский, регистронезависимый">cp1250_polish_ci</option>
                                </optgroup>
                                <optgroup label="cp1251" title="Windows Cyrillic">
                                    <option value="cp1251_bin" title="Кириллический, Двоичный">cp1251_bin</option>
                                    <option value="cp1251_bulgarian_ci" title="Болгарский, регистронезависимый">cp1251_bulgarian_ci</option>
                                    <option value="cp1251_general_ci" title="Кириллический, регистронезависимый">cp1251_general_ci</option>
                                    <option value="cp1251_general_cs" title="Кириллический, регистрозависимый">cp1251_general_cs</option>
                                    <option value="cp1251_ukrainian_ci" title="Украинский, регистронезависимый">cp1251_ukrainian_ci</option>
                                </optgroup>
                                <optgroup label="cp1256" title="Windows Arabic">
                                    <option value="cp1256_bin" title="Арабский, Двоичный">cp1256_bin</option>
                                    <option value="cp1256_general_ci" title="Арабский, регистронезависимый">cp1256_general_ci</option>
                                </optgroup>
                                <optgroup label="cp1257" title="Windows Baltic">
                                    <option value="cp1257_bin" title="Балтийский, Двоичный">cp1257_bin</option>
                                    <option value="cp1257_general_ci" title="Балтийский, регистронезависимый">cp1257_general_ci</option>
                                    <option value="cp1257_lithuanian_ci" title="Литовский, регистронезависимый">cp1257_lithuanian_ci</option>
                                </optgroup>
                                <optgroup label="cp850" title="DOS West European">
                                    <option value="cp850_bin" title="Западно-Европейский, Двоичный">cp850_bin</option>
                                    <option value="cp850_general_ci" title="Западно-Европейский, регистронезависимый">cp850_general_ci</option>
                                </optgroup>
                                <optgroup label="cp852" title="DOS Central European">
                                    <option value="cp852_bin" title="Центрально-Европейский, Двоичный">cp852_bin</option>
                                    <option value="cp852_general_ci" title="Центрально-Европейский, регистронезависимый">cp852_general_ci</option>
                                </optgroup>
                                <optgroup label="cp866" title="DOS Russian">
                                    <option value="cp866_bin" title="Русский, Двоичный">cp866_bin</option>
                                    <option value="cp866_general_ci" title="Русский, регистронезависимый">cp866_general_ci</option>
                                </optgroup>
                                <optgroup label="cp932" title="SJIS for Windows Japanese">
                                    <option value="cp932_bin" title="Японский, Двоичный">cp932_bin</option>
                                    <option value="cp932_japanese_ci" title="Японский, регистронезависимый">cp932_japanese_ci</option>
                                </optgroup>
                                <optgroup label="dec8" title="DEC West European">
                                    <option value="dec8_bin" title="Западно-Европейский, Двоичный">dec8_bin</option>
                                    <option value="dec8_swedish_ci" title="Шведский, регистронезависимый">dec8_swedish_ci</option>
                                </optgroup>
                                <optgroup label="eucjpms" title="UJIS for Windows Japanese">
                                    <option value="eucjpms_bin" title="Японский, Двоичный">eucjpms_bin</option>
                                    <option value="eucjpms_japanese_ci" title="Японский, регистронезависимый">eucjpms_japanese_ci</option>
                                </optgroup>
                                <optgroup label="euckr" title="EUC-KR Korean">
                                    <option value="euckr_bin" title="Корейский, Двоичный">euckr_bin</option>
                                    <option value="euckr_korean_ci" title="Корейский, регистронезависимый">euckr_korean_ci</option>
                                </optgroup>
                                <optgroup label="gb18030" title="China National Standard GB18030">
                                    <option value="gb18030_bin" title="Китайский, Двоичный">gb18030_bin</option>
                                    <option value="gb18030_chinese_ci" title="Китайский, регистронезависимый">gb18030_chinese_ci</option>
                                    <option value="gb18030_unicode_520_ci" title="Китайский (UCA 5.2.0), регистронезависимый">gb18030_unicode_520_ci</option>
                                </optgroup>
                                <optgroup label="gb2312" title="GB2312 Simplified Chinese">
                                    <option value="gb2312_bin" title="Китайский упрощенный, Двоичный">gb2312_bin</option>
                                    <option value="gb2312_chinese_ci" title="Китайский упрощенный, регистронезависимый">gb2312_chinese_ci</option>
                                </optgroup>
                                <optgroup label="gbk" title="GBK Simplified Chinese">
                                    <option value="gbk_bin" title="Китайский упрощенный, Двоичный">gbk_bin</option>
                                    <option value="gbk_chinese_ci" title="Китайский упрощенный, регистронезависимый">gbk_chinese_ci</option>
                                </optgroup>
                                <optgroup label="geostd8" title="GEOSTD8 Georgian">
                                    <option value="geostd8_bin" title="Грузинский, Двоичный">geostd8_bin</option>
                                    <option value="geostd8_general_ci" title="Грузинский, регистронезависимый">geostd8_general_ci</option>
                                </optgroup>
                                <optgroup label="greek" title="ISO 8859-7 Greek">
                                    <option value="greek_bin" title="Греческий, Двоичный">greek_bin</option>
                                    <option value="greek_general_ci" title="Греческий, регистронезависимый">greek_general_ci</option>
                                </optgroup>
                                <optgroup label="hebrew" title="ISO 8859-8 Hebrew">
                                    <option value="hebrew_bin" title="Иврит, Двоичный">hebrew_bin</option>
                                    <option value="hebrew_general_ci" title="Иврит, регистронезависимый">hebrew_general_ci</option>
                                </optgroup>
                                <optgroup label="hp8" title="HP West European">
                                    <option value="hp8_bin" title="Западно-Европейский, Двоичный">hp8_bin</option>
                                    <option value="hp8_english_ci" title="Английский, регистронезависимый">hp8_english_ci</option>
                                </optgroup>
                                <optgroup label="keybcs2" title="DOS Kamenicky Czech-Slovak">
                                    <option value="keybcs2_bin" title="Чехословацкий, Двоичный">keybcs2_bin</option>
                                    <option value="keybcs2_general_ci" title="Чехословацкий, регистронезависимый">keybcs2_general_ci</option>
                                </optgroup>
                                <optgroup label="koi8r" title="KOI8-R Relcom Russian">
                                    <option value="koi8r_bin" title="Русский, Двоичный">koi8r_bin</option>
                                    <option value="koi8r_general_ci" title="Русский, регистронезависимый">koi8r_general_ci</option>
                                </optgroup>
                                <optgroup label="koi8u" title="KOI8-U Ukrainian">
                                    <option value="koi8u_bin" title="Украинский, Двоичный">koi8u_bin</option>
                                    <option value="koi8u_general_ci" title="Украинский, регистронезависимый">koi8u_general_ci</option>
                                </optgroup>
                                <optgroup label="latin1" title="cp1252 West European">
                                    <option value="latin1_bin" title="Западно-Европейский, Двоичный">latin1_bin</option>
                                    <option value="latin1_danish_ci" title="Датский, регистронезависимый">latin1_danish_ci</option>
                                    <option value="latin1_general_ci" title="Западно-Европейский, регистронезависимый">latin1_general_ci</option>
                                    <option value="latin1_general_cs" title="Западно-Европейский, регистрозависимый">latin1_general_cs</option>
                                    <option value="latin1_german1_ci" title="Немецкий (порядок словаря), регистронезависимый">latin1_german1_ci</option>
                                    <option value="latin1_german2_ci" title="Немецкий (порядок телефонной книги), регистронезависимый">latin1_german2_ci</option>
                                    <option value="latin1_spanish_ci" title="Испанский, регистронезависимый">latin1_spanish_ci</option>
                                    <option value="latin1_swedish_ci" title="Шведский, регистронезависимый">latin1_swedish_ci</option>
                                </optgroup>
                                <optgroup label="latin2" title="ISO 8859-2 Central European">
                                    <option value="latin2_bin" title="Центрально-Европейский, Двоичный">latin2_bin</option>
                                    <option value="latin2_croatian_ci" title="Хорватский, регистронезависимый">latin2_croatian_ci</option>
                                    <option value="latin2_czech_cs" title="Чешский, регистрозависимый">latin2_czech_cs</option>
                                    <option value="latin2_general_ci" title="Центрально-Европейский, регистронезависимый">latin2_general_ci</option>
                                    <option value="latin2_hungarian_ci" title="Венгерский, регистронезависимый">latin2_hungarian_ci</option>
                                </optgroup>
                                <optgroup label="latin5" title="ISO 8859-9 Turkish">
                                    <option value="latin5_bin" title="Турецкий, Двоичный">latin5_bin</option>
                                    <option value="latin5_turkish_ci" title="Турецкий, регистронезависимый">latin5_turkish_ci</option>
                                </optgroup>
                                <optgroup label="latin7" title="ISO 8859-13 Baltic">
                                    <option value="latin7_bin" title="Балтийский, Двоичный">latin7_bin</option>
                                    <option value="latin7_estonian_cs" title="Эстонский, регистрозависимый">latin7_estonian_cs</option>
                                    <option value="latin7_general_ci" title="Балтийский, регистронезависимый">latin7_general_ci</option>
                                    <option value="latin7_general_cs" title="Балтийский, регистрозависимый">latin7_general_cs</option>
                                </optgroup>
                                <optgroup label="macce" title="Mac Central European">
                                    <option value="macce_bin" title="Центрально-Европейский, Двоичный">macce_bin</option>
                                    <option value="macce_general_ci" title="Центрально-Европейский, регистронезависимый">macce_general_ci</option>
                                </optgroup>
                                <optgroup label="macroman" title="Mac West European">
                                    <option value="macroman_bin" title="Западно-Европейский, Двоичный">macroman_bin</option>
                                    <option value="macroman_general_ci" title="Западно-Европейский, регистронезависимый">macroman_general_ci</option>
                                </optgroup>
                                <optgroup label="sjis" title="Shift-JIS Japanese">
                                    <option value="sjis_bin" title="Японский, Двоичный">sjis_bin</option>
                                    <option value="sjis_japanese_ci" title="Японский, регистронезависимый">sjis_japanese_ci</option>
                                </optgroup>
                                <optgroup label="swe7" title="7bit Swedish">
                                    <option value="swe7_bin" title="Шведский, Двоичный">swe7_bin</option>
                                    <option value="swe7_swedish_ci" title="Шведский, регистронезависимый">swe7_swedish_ci</option>
                                </optgroup>
                                <optgroup label="tis620" title="TIS620 Thai">
                                    <option value="tis620_bin" title="Таи, Двоичный">tis620_bin</option>
                                    <option value="tis620_thai_ci" title="Таи, регистронезависимый">tis620_thai_ci</option>
                                </optgroup>
                                <optgroup label="ucs2" title="UCS-2 Unicode">
                                    <option value="ucs2_bin" title="Юникод, Двоичный">ucs2_bin</option>
                                    <option value="ucs2_croatian_ci" title="Хорватский, регистронезависимый">ucs2_croatian_ci</option>
                                    <option value="ucs2_czech_ci" title="Чешский, регистронезависимый">ucs2_czech_ci</option>
                                    <option value="ucs2_danish_ci" title="Датский, регистронезависимый">ucs2_danish_ci</option>
                                    <option value="ucs2_esperanto_ci" title="Эсперанто, регистронезависимый">ucs2_esperanto_ci</option>
                                    <option value="ucs2_estonian_ci" title="Эстонский, регистронезависимый">ucs2_estonian_ci</option>
                                    <option value="ucs2_general_ci" title="Юникод, регистронезависимый">ucs2_general_ci</option>
                                    <option value="ucs2_general_mysql500_ci" title="Юникод (MySQL 5.0.0), регистронезависимый">ucs2_general_mysql500_ci</option>
                                    <option value="ucs2_german2_ci" title="Немецкий (порядок телефонной книги), регистронезависимый">ucs2_german2_ci</option>
                                    <option value="ucs2_hungarian_ci" title="Венгерский, регистронезависимый">ucs2_hungarian_ci</option>
                                    <option value="ucs2_icelandic_ci" title="Исландский, регистронезависимый">ucs2_icelandic_ci</option>
                                    <option value="ucs2_latvian_ci" title="Латвийский, регистронезависимый">ucs2_latvian_ci</option>
                                    <option value="ucs2_lithuanian_ci" title="Литовский, регистронезависимый">ucs2_lithuanian_ci</option>
                                    <option value="ucs2_persian_ci" title="Персидский, регистронезависимый">ucs2_persian_ci</option>
                                    <option value="ucs2_polish_ci" title="Польский, регистронезависимый">ucs2_polish_ci</option>
                                    <option value="ucs2_roman_ci" title="Западно-Европейский, регистронезависимый">ucs2_roman_ci</option>
                                    <option value="ucs2_romanian_ci" title="Румынский, регистронезависимый">ucs2_romanian_ci</option>
                                    <option value="ucs2_sinhala_ci" title="Сингальский, регистронезависимый">ucs2_sinhala_ci</option>
                                    <option value="ucs2_slovak_ci" title="Словацкий, регистронезависимый">ucs2_slovak_ci</option>
                                    <option value="ucs2_slovenian_ci" title="Словенский, регистронезависимый">ucs2_slovenian_ci</option>
                                    <option value="ucs2_spanish2_ci" title="Испанский (традиционный), регистронезависимый">ucs2_spanish2_ci</option>
                                    <option value="ucs2_spanish_ci" title="Испанский, регистронезависимый">ucs2_spanish_ci</option>
                                    <option value="ucs2_swedish_ci" title="Шведский, регистронезависимый">ucs2_swedish_ci</option>
                                    <option value="ucs2_turkish_ci" title="Турецкий, регистронезависимый">ucs2_turkish_ci</option>
                                    <option value="ucs2_unicode_520_ci" title="Юникод (UCA 5.2.0), регистронезависимый">ucs2_unicode_520_ci</option>
                                    <option value="ucs2_unicode_ci" title="Юникод, регистронезависимый">ucs2_unicode_ci</option>
                                    <option value="ucs2_vietnamese_ci" title="Вьетнамский, регистронезависимый">ucs2_vietnamese_ci</option>
                                </optgroup>
                                <optgroup label="ujis" title="EUC-JP Japanese">
                                    <option value="ujis_bin" title="Японский, Двоичный">ujis_bin</option>
                                    <option value="ujis_japanese_ci" title="Японский, регистронезависимый">ujis_japanese_ci</option>
                                </optgroup>
                                <optgroup label="utf16" title="UTF-16 Unicode">
                                    <option value="utf16_bin" title="Юникод, Двоичный">utf16_bin</option>
                                    <option value="utf16_croatian_ci" title="Хорватский, регистронезависимый">utf16_croatian_ci</option>
                                    <option value="utf16_czech_ci" title="Чешский, регистронезависимый">utf16_czech_ci</option>
                                    <option value="utf16_danish_ci" title="Датский, регистронезависимый">utf16_danish_ci</option>
                                    <option value="utf16_esperanto_ci" title="Эсперанто, регистронезависимый">utf16_esperanto_ci</option>
                                    <option value="utf16_estonian_ci" title="Эстонский, регистронезависимый">utf16_estonian_ci</option>
                                    <option value="utf16_general_ci" title="Юникод, регистронезависимый">utf16_general_ci</option>
                                    <option value="utf16_german2_ci" title="Немецкий (порядок телефонной книги), регистронезависимый">utf16_german2_ci</option>
                                    <option value="utf16_hungarian_ci" title="Венгерский, регистронезависимый">utf16_hungarian_ci</option>
                                    <option value="utf16_icelandic_ci" title="Исландский, регистронезависимый">utf16_icelandic_ci</option>
                                    <option value="utf16_latvian_ci" title="Латвийский, регистронезависимый">utf16_latvian_ci</option>
                                    <option value="utf16_lithuanian_ci" title="Литовский, регистронезависимый">utf16_lithuanian_ci</option>
                                    <option value="utf16_persian_ci" title="Персидский, регистронезависимый">utf16_persian_ci</option>
                                    <option value="utf16_polish_ci" title="Польский, регистронезависимый">utf16_polish_ci</option>
                                    <option value="utf16_roman_ci" title="Западно-Европейский, регистронезависимый">utf16_roman_ci</option>
                                    <option value="utf16_romanian_ci" title="Румынский, регистронезависимый">utf16_romanian_ci</option>
                                    <option value="utf16_sinhala_ci" title="Сингальский, регистронезависимый">utf16_sinhala_ci</option>
                                    <option value="utf16_slovak_ci" title="Словацкий, регистронезависимый">utf16_slovak_ci</option>
                                    <option value="utf16_slovenian_ci" title="Словенский, регистронезависимый">utf16_slovenian_ci</option>
                                    <option value="utf16_spanish2_ci" title="Испанский (традиционный), регистронезависимый">utf16_spanish2_ci</option>
                                    <option value="utf16_spanish_ci" title="Испанский, регистронезависимый">utf16_spanish_ci</option>
                                    <option value="utf16_swedish_ci" title="Шведский, регистронезависимый">utf16_swedish_ci</option>
                                    <option value="utf16_turkish_ci" title="Турецкий, регистронезависимый">utf16_turkish_ci</option>
                                    <option value="utf16_unicode_520_ci" title="Юникод (UCA 5.2.0), регистронезависимый">utf16_unicode_520_ci</option>
                                    <option value="utf16_unicode_ci" title="Юникод, регистронезависимый">utf16_unicode_ci</option>
                                    <option value="utf16_vietnamese_ci" title="Вьетнамский, регистронезависимый">utf16_vietnamese_ci</option>
                                </optgroup>
                                <optgroup label="utf16le" title="UTF-16LE Unicode">
                                    <option value="utf16le_bin" title="Юникод, Двоичный">utf16le_bin</option>
                                    <option value="utf16le_general_ci" title="Юникод, регистронезависимый">utf16le_general_ci</option>
                                </optgroup>
                                <optgroup label="utf32" title="UTF-32 Unicode">
                                    <option value="utf32_bin" title="Юникод, Двоичный">utf32_bin</option>
                                    <option value="utf32_croatian_ci" title="Хорватский, регистронезависимый">utf32_croatian_ci</option>
                                    <option value="utf32_czech_ci" title="Чешский, регистронезависимый">utf32_czech_ci</option>
                                    <option value="utf32_danish_ci" title="Датский, регистронезависимый">utf32_danish_ci</option>
                                    <option value="utf32_esperanto_ci" title="Эсперанто, регистронезависимый">utf32_esperanto_ci</option>
                                    <option value="utf32_estonian_ci" title="Эстонский, регистронезависимый">utf32_estonian_ci</option>
                                    <option value="utf32_general_ci" title="Юникод, регистронезависимый">utf32_general_ci</option>
                                    <option value="utf32_german2_ci" title="Немецкий (порядок телефонной книги), регистронезависимый">utf32_german2_ci</option>
                                    <option value="utf32_hungarian_ci" title="Венгерский, регистронезависимый">utf32_hungarian_ci</option>
                                    <option value="utf32_icelandic_ci" title="Исландский, регистронезависимый">utf32_icelandic_ci</option>
                                    <option value="utf32_latvian_ci" title="Латвийский, регистронезависимый">utf32_latvian_ci</option>
                                    <option value="utf32_lithuanian_ci" title="Литовский, регистронезависимый">utf32_lithuanian_ci</option>
                                    <option value="utf32_persian_ci" title="Персидский, регистронезависимый">utf32_persian_ci</option>
                                    <option value="utf32_polish_ci" title="Польский, регистронезависимый">utf32_polish_ci</option>
                                    <option value="utf32_roman_ci" title="Западно-Европейский, регистронезависимый">utf32_roman_ci</option>
                                    <option value="utf32_romanian_ci" title="Румынский, регистронезависимый">utf32_romanian_ci</option>
                                    <option value="utf32_sinhala_ci" title="Сингальский, регистронезависимый">utf32_sinhala_ci</option>
                                    <option value="utf32_slovak_ci" title="Словацкий, регистронезависимый">utf32_slovak_ci</option>
                                    <option value="utf32_slovenian_ci" title="Словенский, регистронезависимый">utf32_slovenian_ci</option>
                                    <option value="utf32_spanish2_ci" title="Испанский (традиционный), регистронезависимый">utf32_spanish2_ci</option>
                                    <option value="utf32_spanish_ci" title="Испанский, регистронезависимый">utf32_spanish_ci</option>
                                    <option value="utf32_swedish_ci" title="Шведский, регистронезависимый">utf32_swedish_ci</option>
                                    <option value="utf32_turkish_ci" title="Турецкий, регистронезависимый">utf32_turkish_ci</option>
                                    <option value="utf32_unicode_520_ci" title="Юникод (UCA 5.2.0), регистронезависимый">utf32_unicode_520_ci</option>
                                    <option value="utf32_unicode_ci" title="Юникод, регистронезависимый">utf32_unicode_ci</option>
                                    <option value="utf32_vietnamese_ci" title="Вьетнамский, регистронезависимый">utf32_vietnamese_ci</option>
                                </optgroup>
                                <optgroup label="utf8" title="UTF-8 Unicode">
                                    <option value="utf8_bin" title="Юникод, Двоичный">utf8_bin</option>
                                    <option value="utf8_croatian_ci" title="Хорватский, регистронезависимый">utf8_croatian_ci</option>
                                    <option value="utf8_czech_ci" title="Чешский, регистронезависимый">utf8_czech_ci</option>
                                    <option value="utf8_danish_ci" title="Датский, регистронезависимый">utf8_danish_ci</option>
                                    <option value="utf8_esperanto_ci" title="Эсперанто, регистронезависимый">utf8_esperanto_ci</option>
                                    <option value="utf8_estonian_ci" title="Эстонский, регистронезависимый">utf8_estonian_ci</option>
                                    <option value="utf8_general_ci" title="Юникод, регистронезависимый">utf8_general_ci</option>
                                    <option value="utf8_general_mysql500_ci" title="Юникод (MySQL 5.0.0), регистронезависимый">utf8_general_mysql500_ci</option>
                                    <option value="utf8_german2_ci" title="Немецкий (порядок телефонной книги), регистронезависимый">utf8_german2_ci</option>
                                    <option value="utf8_hungarian_ci" title="Венгерский, регистронезависимый">utf8_hungarian_ci</option>
                                    <option value="utf8_icelandic_ci" title="Исландский, регистронезависимый">utf8_icelandic_ci</option>
                                    <option value="utf8_latvian_ci" title="Латвийский, регистронезависимый">utf8_latvian_ci</option>
                                    <option value="utf8_lithuanian_ci" title="Литовский, регистронезависимый">utf8_lithuanian_ci</option>
                                    <option value="utf8_persian_ci" title="Персидский, регистронезависимый">utf8_persian_ci</option>
                                    <option value="utf8_polish_ci" title="Польский, регистронезависимый">utf8_polish_ci</option>
                                    <option value="utf8_roman_ci" title="Западно-Европейский, регистронезависимый">utf8_roman_ci</option>
                                    <option value="utf8_romanian_ci" title="Румынский, регистронезависимый">utf8_romanian_ci</option>
                                    <option value="utf8_sinhala_ci" title="Сингальский, регистронезависимый">utf8_sinhala_ci</option>
                                    <option value="utf8_slovak_ci" title="Словацкий, регистронезависимый">utf8_slovak_ci</option>
                                    <option value="utf8_slovenian_ci" title="Словенский, регистронезависимый">utf8_slovenian_ci</option>
                                    <option value="utf8_spanish2_ci" title="Испанский (традиционный), регистронезависимый">utf8_spanish2_ci</option>
                                    <option value="utf8_spanish_ci" title="Испанский, регистронезависимый">utf8_spanish_ci</option>
                                    <option value="utf8_swedish_ci" title="Шведский, регистронезависимый">utf8_swedish_ci</option>
                                    <option value="utf8_tolower_ci" title="Юникод, регистронезависимый">utf8_tolower_ci</option>
                                    <option value="utf8_turkish_ci" title="Турецкий, регистронезависимый">utf8_turkish_ci</option>
                                    <option value="utf8_unicode_520_ci" title="Юникод (UCA 5.2.0), регистронезависимый">utf8_unicode_520_ci</option>
                                    <option value="utf8_unicode_ci" title="Юникод, регистронезависимый">utf8_unicode_ci</option>
                                    <option value="utf8_vietnamese_ci" title="Вьетнамский, регистронезависимый">utf8_vietnamese_ci</option>
                                </optgroup>
                                <optgroup label="utf8mb4" title="UTF-8 Unicode">
                                    <option value="utf8mb4_0900_ai_ci" title="Юникод (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_0900_ai_ci</option>
                                    <option value="utf8mb4_0900_as_ci" title="Юникод (UCA 9.0.0), акцент чувствительный, регистронезависимый">utf8mb4_0900_as_ci</option>
                                    <option value="utf8mb4_0900_as_cs" title="Юникод (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_0900_as_cs</option>
                                    <option value="utf8mb4_0900_bin" title="Юникод (UCA 9.0.0), Двоичный">utf8mb4_0900_bin</option>
                                    <option value="utf8mb4_bin" title="Юникод (UCA 4.0.0), Двоичный">utf8mb4_bin</option>
                                    <option value="utf8mb4_croatian_ci" title="Хорватский (UCA 4.0.0), регистронезависимый">utf8mb4_croatian_ci</option>
                                    <option value="utf8mb4_cs_0900_ai_ci" title="Чешский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_cs_0900_ai_ci</option>
                                    <option value="utf8mb4_cs_0900_as_cs" title="Чешский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_cs_0900_as_cs</option>
                                    <option value="utf8mb4_czech_ci" title="Чешский (UCA 4.0.0), регистронезависимый">utf8mb4_czech_ci</option>
                                    <option value="utf8mb4_da_0900_ai_ci" title="Датский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_da_0900_ai_ci</option>
                                    <option value="utf8mb4_da_0900_as_cs" title="Датский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_da_0900_as_cs</option>
                                    <option value="utf8mb4_danish_ci" title="Датский (UCA 4.0.0), регистронезависимый">utf8mb4_danish_ci</option>
                                    <option value="utf8mb4_de_pb_0900_ai_ci" title="Немецкий (порядок телефонной книги) (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_de_pb_0900_ai_ci</option>
                                    <option value="utf8mb4_de_pb_0900_as_cs" title="Немецкий (порядок телефонной книги) (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_de_pb_0900_as_cs</option>
                                    <option value="utf8mb4_eo_0900_ai_ci" title="Эсперанто (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_eo_0900_ai_ci</option>
                                    <option value="utf8mb4_eo_0900_as_cs" title="Эсперанто (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_eo_0900_as_cs</option>
                                    <option value="utf8mb4_es_0900_ai_ci" title="Испанский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_es_0900_ai_ci</option>
                                    <option value="utf8mb4_es_0900_as_cs" title="Испанский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_es_0900_as_cs</option>
                                    <option value="utf8mb4_es_trad_0900_ai_ci" title="Испанский (традиционный) (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_es_trad_0900_ai_ci</option>
                                    <option value="utf8mb4_es_trad_0900_as_cs" title="Испанский (традиционный) (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_es_trad_0900_as_cs</option>
                                    <option value="utf8mb4_esperanto_ci" title="Эсперанто (UCA 4.0.0), регистронезависимый">utf8mb4_esperanto_ci</option>
                                    <option value="utf8mb4_estonian_ci" title="Эстонский (UCA 4.0.0), регистронезависимый">utf8mb4_estonian_ci</option>
                                    <option value="utf8mb4_et_0900_ai_ci" title="Эстонский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_et_0900_ai_ci</option>
                                    <option value="utf8mb4_et_0900_as_cs" title="Эстонский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_et_0900_as_cs</option>
                                    <option value="utf8mb4_general_ci" title="Юникод (UCA 4.0.0), регистронезависимый">utf8mb4_general_ci</option>
                                    <option value="utf8mb4_german2_ci" title="Немецкий (порядок телефонной книги) (UCA 4.0.0), регистронезависимый">utf8mb4_german2_ci</option>
                                    <option value="utf8mb4_hr_0900_ai_ci" title="Хорватский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_hr_0900_ai_ci</option>
                                    <option value="utf8mb4_hr_0900_as_cs" title="Хорватский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_hr_0900_as_cs</option>
                                    <option value="utf8mb4_hu_0900_ai_ci" title="Венгерский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_hu_0900_ai_ci</option>
                                    <option value="utf8mb4_hu_0900_as_cs" title="Венгерский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_hu_0900_as_cs</option>
                                    <option value="utf8mb4_hungarian_ci" title="Венгерский (UCA 4.0.0), регистронезависимый">utf8mb4_hungarian_ci</option>
                                    <option value="utf8mb4_icelandic_ci" title="Исландский (UCA 4.0.0), регистронезависимый">utf8mb4_icelandic_ci</option>
                                    <option value="utf8mb4_is_0900_ai_ci" title="Исландский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_is_0900_ai_ci</option>
                                    <option value="utf8mb4_is_0900_as_cs" title="Исландский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_is_0900_as_cs</option>
                                    <option value="utf8mb4_ja_0900_as_cs" title="Японский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_ja_0900_as_cs</option>
                                    <option value="utf8mb4_ja_0900_as_cs_ks" title="Японский (UCA 9.0.0), акцент чувствительный, регистрозависимый, кана-зависимый">utf8mb4_ja_0900_as_cs_ks</option>
                                    <option value="utf8mb4_la_0900_ai_ci" title="Классическая латынь (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_la_0900_ai_ci</option>
                                    <option value="utf8mb4_la_0900_as_cs" title="Классическая латынь (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_la_0900_as_cs</option>
                                    <option value="utf8mb4_latvian_ci" title="Латвийский (UCA 4.0.0), регистронезависимый">utf8mb4_latvian_ci</option>
                                    <option value="utf8mb4_lithuanian_ci" title="Литовский (UCA 4.0.0), регистронезависимый">utf8mb4_lithuanian_ci</option>
                                    <option value="utf8mb4_lt_0900_ai_ci" title="Литовский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_lt_0900_ai_ci</option>
                                    <option value="utf8mb4_lt_0900_as_cs" title="Литовский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_lt_0900_as_cs</option>
                                    <option value="utf8mb4_lv_0900_ai_ci" title="Латвийский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_lv_0900_ai_ci</option>
                                    <option value="utf8mb4_lv_0900_as_cs" title="Латвийский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_lv_0900_as_cs</option>
                                    <option value="utf8mb4_persian_ci" title="Персидский (UCA 4.0.0), регистронезависимый">utf8mb4_persian_ci</option>
                                    <option value="utf8mb4_pl_0900_ai_ci" title="Польский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_pl_0900_ai_ci</option>
                                    <option value="utf8mb4_pl_0900_as_cs" title="Польский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_pl_0900_as_cs</option>
                                    <option value="utf8mb4_polish_ci" title="Польский (UCA 4.0.0), регистронезависимый">utf8mb4_polish_ci</option>
                                    <option value="utf8mb4_ro_0900_ai_ci" title="Румынский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_ro_0900_ai_ci</option>
                                    <option value="utf8mb4_ro_0900_as_cs" title="Румынский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_ro_0900_as_cs</option>
                                    <option value="utf8mb4_roman_ci" title="Западно-Европейский (UCA 4.0.0), регистронезависимый">utf8mb4_roman_ci</option>
                                    <option value="utf8mb4_romanian_ci" title="Румынский (UCA 4.0.0), регистронезависимый">utf8mb4_romanian_ci</option>
                                    <option value="utf8mb4_ru_0900_ai_ci" title="Русский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_ru_0900_ai_ci</option>
                                    <option value="utf8mb4_ru_0900_as_cs" title="Русский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_ru_0900_as_cs</option>
                                    <option value="utf8mb4_sinhala_ci" title="Сингальский (UCA 4.0.0), регистронезависимый">utf8mb4_sinhala_ci</option>
                                    <option value="utf8mb4_sk_0900_ai_ci" title="Словацкий (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_sk_0900_ai_ci</option>
                                    <option value="utf8mb4_sk_0900_as_cs" title="Словацкий (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_sk_0900_as_cs</option>
                                    <option value="utf8mb4_sl_0900_ai_ci" title="Словенский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_sl_0900_ai_ci</option>
                                    <option value="utf8mb4_sl_0900_as_cs" title="Словенский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_sl_0900_as_cs</option>
                                    <option value="utf8mb4_slovak_ci" title="Словацкий (UCA 4.0.0), регистронезависимый">utf8mb4_slovak_ci</option>
                                    <option value="utf8mb4_slovenian_ci" title="Словенский (UCA 4.0.0), регистронезависимый">utf8mb4_slovenian_ci</option>
                                    <option value="utf8mb4_spanish2_ci" title="Испанский (традиционный) (UCA 4.0.0), регистронезависимый">utf8mb4_spanish2_ci</option>
                                    <option value="utf8mb4_spanish_ci" title="Испанский (UCA 4.0.0), регистронезависимый">utf8mb4_spanish_ci</option>
                                    <option value="utf8mb4_sv_0900_ai_ci" title="Шведский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_sv_0900_ai_ci</option>
                                    <option value="utf8mb4_sv_0900_as_cs" title="Шведский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_sv_0900_as_cs</option>
                                    <option value="utf8mb4_swedish_ci" title="Шведский (UCA 4.0.0), регистронезависимый">utf8mb4_swedish_ci</option>
                                    <option value="utf8mb4_tr_0900_ai_ci" title="Турецкий (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_tr_0900_ai_ci</option>
                                    <option value="utf8mb4_tr_0900_as_cs" title="Турецкий (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_tr_0900_as_cs</option>
                                    <option value="utf8mb4_turkish_ci" title="Турецкий (UCA 4.0.0), регистронезависимый">utf8mb4_turkish_ci</option>
                                    <option value="utf8mb4_unicode_520_ci" title="Юникод (UCA 5.2.0), регистронезависимый">utf8mb4_unicode_520_ci</option>
                                    <option value="utf8mb4_unicode_ci" title="Юникод (UCA 4.0.0), регистронезависимый">utf8mb4_unicode_ci</option>
                                    <option value="utf8mb4_vi_0900_ai_ci" title="Вьетнамский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_vi_0900_ai_ci</option>
                                    <option value="utf8mb4_vi_0900_as_cs" title="Вьетнамский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_vi_0900_as_cs</option>
                                    <option value="utf8mb4_vietnamese_ci" title="Вьетнамский (UCA 4.0.0), регистронезависимый">utf8mb4_vietnamese_ci</option>
                                    <option value="utf8mb4_zh_0900_as_cs" title="Китайский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_zh_0900_as_cs</option>
                                </optgroup>
                            </select>
                        </td>
                        <td>
                            <select name="attribute<?=$i?>" id="attribute<?=$i?>">
                                <option value=""></option>
                                <option value="BINARY">BINARY</option>
                                <option value="UNSIGNED">UNSIGNED</option>
                                <option value="UNSIGNED_ZEROFILL">UNSIGNED_ZEROFILL</option>
                                <option value="on update CURRENT_TIMESTAMP">on update CURRENT_TIMESTAMP</option>
                            </select>
                        </td>
                        <td><input type="checkbox" id="Null<?=$i?>" name="Null<?=$i?>"><label></label></td>
                        <td>
                            <select name="index<?=$i?>" id="index<?=$i?>">
                                <option value="">---</option>
                                <option value="PRIMARY">PRIMARY</option>
                                <option value="UNIQUE">UNIQUE</option>
                                <option value="INDEX">INDEX</option>
                            </select>
                        </td>

                        <?php
                        if($i == 0){
                            ?>
                                <td><input type="checkbox" id="A_I<?=$i?>" name="A_I<?=$i?>" checked><label></label></td>
                            <?php
                        }else{
                            ?>
                            <td><input type="checkbox" id="A_I<?=$i?>" name="A_I<?=$i?>"><label></label></td>
                        <?php
                        }
                        ?>



                        <td><input type="text" id="comment<?=$i?>" name="comment<?=$i?>"></td>

                        <script type="text/javascript">
                            function Virtual_test(i) {
                                console.log(i)
                                var social = document.getElementById("virtual"+i);
                                var selectSocial = social.options[social.selectedIndex].value;
                                var isSocial = selectSocial == ""
                                var show = document.getElementById("virtual_show"+i);
                                show.style.display = !isSocial ? 'inherit': 'none';
                            }
                        </script>
                        <td>
                            <select name="virtual<?=$i?>" id="virtual<?=$i?>" onchange=Virtual_test(<?=$i?>)>
                                <option value=""></option>
                                <option value="VIRTUAL">VIRTUAL</option>
                                <option value="STORED">STORED</option>
                            </select>
                            <input type="text" placeholder="Выражение" id="virtual_show<?=$i?>" name="virtual_show<?=$i?>" class="Virtual_test">
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table border="1">
        </div>

            <div>
                <input name="comm_to_table" placeholder="Комментарии к таблице">
                <select lang="en" dir="ltr" name="crav" id="crav">
                    <option value=""></option>
                    <optgroup label="armscii8" title="ARMSCII-8 Armenian">
                        <option value="armscii8_bin" title="Армянский, Двоичный">armscii8_bin</option>
                        <option value="armscii8_general_ci" title="Армянский, регистронезависимый">armscii8_general_ci</option>
                    </optgroup>
                    <optgroup label="ascii" title="US ASCII">
                        <option value="ascii_bin" title="Западно-Европейский, Двоичный">ascii_bin</option>
                        <option value="ascii_general_ci" title="Западно-Европейский, регистронезависимый">ascii_general_ci</option>
                    </optgroup>
                    <optgroup label="big5" title="Big5 Traditional Chinese">
                        <option value="big5_bin" title="Китайский традиционный, Двоичный">big5_bin</option>
                        <option value="big5_chinese_ci" title="Китайский традиционный, регистронезависимый">big5_chinese_ci</option>
                    </optgroup>
                    <optgroup label="binary" title="Binary pseudo charset">
                        <option value="binary" title="Двоичный">binary</option>
                    </optgroup>
                    <optgroup label="cp1250" title="Windows Central European">
                        <option value="cp1250_bin" title="Центрально-Европейский, Двоичный">cp1250_bin</option>
                        <option value="cp1250_croatian_ci" title="Хорватский, регистронезависимый">cp1250_croatian_ci</option>
                        <option value="cp1250_czech_cs" title="Чешский, регистрозависимый">cp1250_czech_cs</option>
                        <option value="cp1250_general_ci" title="Центрально-Европейский, регистронезависимый">cp1250_general_ci</option>
                        <option value="cp1250_polish_ci" title="Польский, регистронезависимый">cp1250_polish_ci</option>
                    </optgroup>
                    <optgroup label="cp1251" title="Windows Cyrillic">
                        <option value="cp1251_bin" title="Кириллический, Двоичный">cp1251_bin</option>
                        <option value="cp1251_bulgarian_ci" title="Болгарский, регистронезависимый">cp1251_bulgarian_ci</option>
                        <option value="cp1251_general_ci" title="Кириллический, регистронезависимый">cp1251_general_ci</option>
                        <option value="cp1251_general_cs" title="Кириллический, регистрозависимый">cp1251_general_cs</option>
                        <option value="cp1251_ukrainian_ci" title="Украинский, регистронезависимый">cp1251_ukrainian_ci</option>
                    </optgroup>
                    <optgroup label="cp1256" title="Windows Arabic">
                        <option value="cp1256_bin" title="Арабский, Двоичный">cp1256_bin</option>
                        <option value="cp1256_general_ci" title="Арабский, регистронезависимый">cp1256_general_ci</option>
                    </optgroup>
                    <optgroup label="cp1257" title="Windows Baltic">
                        <option value="cp1257_bin" title="Балтийский, Двоичный">cp1257_bin</option>
                        <option value="cp1257_general_ci" title="Балтийский, регистронезависимый">cp1257_general_ci</option>
                        <option value="cp1257_lithuanian_ci" title="Литовский, регистронезависимый">cp1257_lithuanian_ci</option>
                    </optgroup>
                    <optgroup label="cp850" title="DOS West European">
                        <option value="cp850_bin" title="Западно-Европейский, Двоичный">cp850_bin</option>
                        <option value="cp850_general_ci" title="Западно-Европейский, регистронезависимый">cp850_general_ci</option>
                    </optgroup>
                    <optgroup label="cp852" title="DOS Central European">
                        <option value="cp852_bin" title="Центрально-Европейский, Двоичный">cp852_bin</option>
                        <option value="cp852_general_ci" title="Центрально-Европейский, регистронезависимый">cp852_general_ci</option>
                    </optgroup>
                    <optgroup label="cp866" title="DOS Russian">
                        <option value="cp866_bin" title="Русский, Двоичный">cp866_bin</option>
                        <option value="cp866_general_ci" title="Русский, регистронезависимый">cp866_general_ci</option>
                    </optgroup>
                    <optgroup label="cp932" title="SJIS for Windows Japanese">
                        <option value="cp932_bin" title="Японский, Двоичный">cp932_bin</option>
                        <option value="cp932_japanese_ci" title="Японский, регистронезависимый">cp932_japanese_ci</option>
                    </optgroup>
                    <optgroup label="dec8" title="DEC West European">
                        <option value="dec8_bin" title="Западно-Европейский, Двоичный">dec8_bin</option>
                        <option value="dec8_swedish_ci" title="Шведский, регистронезависимый">dec8_swedish_ci</option>
                    </optgroup>
                    <optgroup label="eucjpms" title="UJIS for Windows Japanese">
                        <option value="eucjpms_bin" title="Японский, Двоичный">eucjpms_bin</option>
                        <option value="eucjpms_japanese_ci" title="Японский, регистронезависимый">eucjpms_japanese_ci</option>
                    </optgroup>
                    <optgroup label="euckr" title="EUC-KR Korean">
                        <option value="euckr_bin" title="Корейский, Двоичный">euckr_bin</option>
                        <option value="euckr_korean_ci" title="Корейский, регистронезависимый">euckr_korean_ci</option>
                    </optgroup>
                    <optgroup label="gb18030" title="China National Standard GB18030">
                        <option value="gb18030_bin" title="Китайский, Двоичный">gb18030_bin</option>
                        <option value="gb18030_chinese_ci" title="Китайский, регистронезависимый">gb18030_chinese_ci</option>
                        <option value="gb18030_unicode_520_ci" title="Китайский (UCA 5.2.0), регистронезависимый">gb18030_unicode_520_ci</option>
                    </optgroup>
                    <optgroup label="gb2312" title="GB2312 Simplified Chinese">
                        <option value="gb2312_bin" title="Китайский упрощенный, Двоичный">gb2312_bin</option>
                        <option value="gb2312_chinese_ci" title="Китайский упрощенный, регистронезависимый">gb2312_chinese_ci</option>
                    </optgroup>
                    <optgroup label="gbk" title="GBK Simplified Chinese">
                        <option value="gbk_bin" title="Китайский упрощенный, Двоичный">gbk_bin</option>
                        <option value="gbk_chinese_ci" title="Китайский упрощенный, регистронезависимый">gbk_chinese_ci</option>
                    </optgroup>
                    <optgroup label="geostd8" title="GEOSTD8 Georgian">
                        <option value="geostd8_bin" title="Грузинский, Двоичный">geostd8_bin</option>
                        <option value="geostd8_general_ci" title="Грузинский, регистронезависимый">geostd8_general_ci</option>
                    </optgroup>
                    <optgroup label="greek" title="ISO 8859-7 Greek">
                        <option value="greek_bin" title="Греческий, Двоичный">greek_bin</option>
                        <option value="greek_general_ci" title="Греческий, регистронезависимый">greek_general_ci</option>
                    </optgroup>
                    <optgroup label="hebrew" title="ISO 8859-8 Hebrew">
                        <option value="hebrew_bin" title="Иврит, Двоичный">hebrew_bin</option>
                        <option value="hebrew_general_ci" title="Иврит, регистронезависимый">hebrew_general_ci</option>
                    </optgroup>
                    <optgroup label="hp8" title="HP West European">
                        <option value="hp8_bin" title="Западно-Европейский, Двоичный">hp8_bin</option>
                        <option value="hp8_english_ci" title="Английский, регистронезависимый">hp8_english_ci</option>
                    </optgroup>
                    <optgroup label="keybcs2" title="DOS Kamenicky Czech-Slovak">
                        <option value="keybcs2_bin" title="Чехословацкий, Двоичный">keybcs2_bin</option>
                        <option value="keybcs2_general_ci" title="Чехословацкий, регистронезависимый">keybcs2_general_ci</option>
                    </optgroup>
                    <optgroup label="koi8r" title="KOI8-R Relcom Russian">
                        <option value="koi8r_bin" title="Русский, Двоичный">koi8r_bin</option>
                        <option value="koi8r_general_ci" title="Русский, регистронезависимый">koi8r_general_ci</option>
                    </optgroup>
                    <optgroup label="koi8u" title="KOI8-U Ukrainian">
                        <option value="koi8u_bin" title="Украинский, Двоичный">koi8u_bin</option>
                        <option value="koi8u_general_ci" title="Украинский, регистронезависимый">koi8u_general_ci</option>
                    </optgroup>
                    <optgroup label="latin1" title="cp1252 West European">
                        <option value="latin1_bin" title="Западно-Европейский, Двоичный">latin1_bin</option>
                        <option value="latin1_danish_ci" title="Датский, регистронезависимый">latin1_danish_ci</option>
                        <option value="latin1_general_ci" title="Западно-Европейский, регистронезависимый">latin1_general_ci</option>
                        <option value="latin1_general_cs" title="Западно-Европейский, регистрозависимый">latin1_general_cs</option>
                        <option value="latin1_german1_ci" title="Немецкий (порядок словаря), регистронезависимый">latin1_german1_ci</option>
                        <option value="latin1_german2_ci" title="Немецкий (порядок телефонной книги), регистронезависимый">latin1_german2_ci</option>
                        <option value="latin1_spanish_ci" title="Испанский, регистронезависимый">latin1_spanish_ci</option>
                        <option value="latin1_swedish_ci" title="Шведский, регистронезависимый">latin1_swedish_ci</option>
                    </optgroup>
                    <optgroup label="latin2" title="ISO 8859-2 Central European">
                        <option value="latin2_bin" title="Центрально-Европейский, Двоичный">latin2_bin</option>
                        <option value="latin2_croatian_ci" title="Хорватский, регистронезависимый">latin2_croatian_ci</option>
                        <option value="latin2_czech_cs" title="Чешский, регистрозависимый">latin2_czech_cs</option>
                        <option value="latin2_general_ci" title="Центрально-Европейский, регистронезависимый">latin2_general_ci</option>
                        <option value="latin2_hungarian_ci" title="Венгерский, регистронезависимый">latin2_hungarian_ci</option>
                    </optgroup>
                    <optgroup label="latin5" title="ISO 8859-9 Turkish">
                        <option value="latin5_bin" title="Турецкий, Двоичный">latin5_bin</option>
                        <option value="latin5_turkish_ci" title="Турецкий, регистронезависимый">latin5_turkish_ci</option>
                    </optgroup>
                    <optgroup label="latin7" title="ISO 8859-13 Baltic">
                        <option value="latin7_bin" title="Балтийский, Двоичный">latin7_bin</option>
                        <option value="latin7_estonian_cs" title="Эстонский, регистрозависимый">latin7_estonian_cs</option>
                        <option value="latin7_general_ci" title="Балтийский, регистронезависимый">latin7_general_ci</option>
                        <option value="latin7_general_cs" title="Балтийский, регистрозависимый">latin7_general_cs</option>
                    </optgroup>
                    <optgroup label="macce" title="Mac Central European">
                        <option value="macce_bin" title="Центрально-Европейский, Двоичный">macce_bin</option>
                        <option value="macce_general_ci" title="Центрально-Европейский, регистронезависимый">macce_general_ci</option>
                    </optgroup>
                    <optgroup label="macroman" title="Mac West European">
                        <option value="macroman_bin" title="Западно-Европейский, Двоичный">macroman_bin</option>
                        <option value="macroman_general_ci" title="Западно-Европейский, регистронезависимый">macroman_general_ci</option>
                    </optgroup>
                    <optgroup label="sjis" title="Shift-JIS Japanese">
                        <option value="sjis_bin" title="Японский, Двоичный">sjis_bin</option>
                        <option value="sjis_japanese_ci" title="Японский, регистронезависимый">sjis_japanese_ci</option>
                    </optgroup>
                    <optgroup label="swe7" title="7bit Swedish">
                        <option value="swe7_bin" title="Шведский, Двоичный">swe7_bin</option>
                        <option value="swe7_swedish_ci" title="Шведский, регистронезависимый">swe7_swedish_ci</option>
                    </optgroup>
                    <optgroup label="tis620" title="TIS620 Thai">
                        <option value="tis620_bin" title="Таи, Двоичный">tis620_bin</option>
                        <option value="tis620_thai_ci" title="Таи, регистронезависимый">tis620_thai_ci</option>
                    </optgroup>
                    <optgroup label="ucs2" title="UCS-2 Unicode">
                        <option value="ucs2_bin" title="Юникод, Двоичный">ucs2_bin</option>
                        <option value="ucs2_croatian_ci" title="Хорватский, регистронезависимый">ucs2_croatian_ci</option>
                        <option value="ucs2_czech_ci" title="Чешский, регистронезависимый">ucs2_czech_ci</option>
                        <option value="ucs2_danish_ci" title="Датский, регистронезависимый">ucs2_danish_ci</option>
                        <option value="ucs2_esperanto_ci" title="Эсперанто, регистронезависимый">ucs2_esperanto_ci</option>
                        <option value="ucs2_estonian_ci" title="Эстонский, регистронезависимый">ucs2_estonian_ci</option>
                        <option value="ucs2_general_ci" title="Юникод, регистронезависимый">ucs2_general_ci</option>
                        <option value="ucs2_general_mysql500_ci" title="Юникод (MySQL 5.0.0), регистронезависимый">ucs2_general_mysql500_ci</option>
                        <option value="ucs2_german2_ci" title="Немецкий (порядок телефонной книги), регистронезависимый">ucs2_german2_ci</option>
                        <option value="ucs2_hungarian_ci" title="Венгерский, регистронезависимый">ucs2_hungarian_ci</option>
                        <option value="ucs2_icelandic_ci" title="Исландский, регистронезависимый">ucs2_icelandic_ci</option>
                        <option value="ucs2_latvian_ci" title="Латвийский, регистронезависимый">ucs2_latvian_ci</option>
                        <option value="ucs2_lithuanian_ci" title="Литовский, регистронезависимый">ucs2_lithuanian_ci</option>
                        <option value="ucs2_persian_ci" title="Персидский, регистронезависимый">ucs2_persian_ci</option>
                        <option value="ucs2_polish_ci" title="Польский, регистронезависимый">ucs2_polish_ci</option>
                        <option value="ucs2_roman_ci" title="Западно-Европейский, регистронезависимый">ucs2_roman_ci</option>
                        <option value="ucs2_romanian_ci" title="Румынский, регистронезависимый">ucs2_romanian_ci</option>
                        <option value="ucs2_sinhala_ci" title="Сингальский, регистронезависимый">ucs2_sinhala_ci</option>
                        <option value="ucs2_slovak_ci" title="Словацкий, регистронезависимый">ucs2_slovak_ci</option>
                        <option value="ucs2_slovenian_ci" title="Словенский, регистронезависимый">ucs2_slovenian_ci</option>
                        <option value="ucs2_spanish2_ci" title="Испанский (традиционный), регистронезависимый">ucs2_spanish2_ci</option>
                        <option value="ucs2_spanish_ci" title="Испанский, регистронезависимый">ucs2_spanish_ci</option>
                        <option value="ucs2_swedish_ci" title="Шведский, регистронезависимый">ucs2_swedish_ci</option>
                        <option value="ucs2_turkish_ci" title="Турецкий, регистронезависимый">ucs2_turkish_ci</option>
                        <option value="ucs2_unicode_520_ci" title="Юникод (UCA 5.2.0), регистронезависимый">ucs2_unicode_520_ci</option>
                        <option value="ucs2_unicode_ci" title="Юникод, регистронезависимый">ucs2_unicode_ci</option>
                        <option value="ucs2_vietnamese_ci" title="Вьетнамский, регистронезависимый">ucs2_vietnamese_ci</option>
                    </optgroup>
                    <optgroup label="ujis" title="EUC-JP Japanese">
                        <option value="ujis_bin" title="Японский, Двоичный">ujis_bin</option>
                        <option value="ujis_japanese_ci" title="Японский, регистронезависимый">ujis_japanese_ci</option>
                    </optgroup>
                    <optgroup label="utf16" title="UTF-16 Unicode">
                        <option value="utf16_bin" title="Юникод, Двоичный">utf16_bin</option>
                        <option value="utf16_croatian_ci" title="Хорватский, регистронезависимый">utf16_croatian_ci</option>
                        <option value="utf16_czech_ci" title="Чешский, регистронезависимый">utf16_czech_ci</option>
                        <option value="utf16_danish_ci" title="Датский, регистронезависимый">utf16_danish_ci</option>
                        <option value="utf16_esperanto_ci" title="Эсперанто, регистронезависимый">utf16_esperanto_ci</option>
                        <option value="utf16_estonian_ci" title="Эстонский, регистронезависимый">utf16_estonian_ci</option>
                        <option value="utf16_general_ci" title="Юникод, регистронезависимый">utf16_general_ci</option>
                        <option value="utf16_german2_ci" title="Немецкий (порядок телефонной книги), регистронезависимый">utf16_german2_ci</option>
                        <option value="utf16_hungarian_ci" title="Венгерский, регистронезависимый">utf16_hungarian_ci</option>
                        <option value="utf16_icelandic_ci" title="Исландский, регистронезависимый">utf16_icelandic_ci</option>
                        <option value="utf16_latvian_ci" title="Латвийский, регистронезависимый">utf16_latvian_ci</option>
                        <option value="utf16_lithuanian_ci" title="Литовский, регистронезависимый">utf16_lithuanian_ci</option>
                        <option value="utf16_persian_ci" title="Персидский, регистронезависимый">utf16_persian_ci</option>
                        <option value="utf16_polish_ci" title="Польский, регистронезависимый">utf16_polish_ci</option>
                        <option value="utf16_roman_ci" title="Западно-Европейский, регистронезависимый">utf16_roman_ci</option>
                        <option value="utf16_romanian_ci" title="Румынский, регистронезависимый">utf16_romanian_ci</option>
                        <option value="utf16_sinhala_ci" title="Сингальский, регистронезависимый">utf16_sinhala_ci</option>
                        <option value="utf16_slovak_ci" title="Словацкий, регистронезависимый">utf16_slovak_ci</option>
                        <option value="utf16_slovenian_ci" title="Словенский, регистронезависимый">utf16_slovenian_ci</option>
                        <option value="utf16_spanish2_ci" title="Испанский (традиционный), регистронезависимый">utf16_spanish2_ci</option>
                        <option value="utf16_spanish_ci" title="Испанский, регистронезависимый">utf16_spanish_ci</option>
                        <option value="utf16_swedish_ci" title="Шведский, регистронезависимый">utf16_swedish_ci</option>
                        <option value="utf16_turkish_ci" title="Турецкий, регистронезависимый">utf16_turkish_ci</option>
                        <option value="utf16_unicode_520_ci" title="Юникод (UCA 5.2.0), регистронезависимый">utf16_unicode_520_ci</option>
                        <option value="utf16_unicode_ci" title="Юникод, регистронезависимый">utf16_unicode_ci</option>
                        <option value="utf16_vietnamese_ci" title="Вьетнамский, регистронезависимый">utf16_vietnamese_ci</option>
                    </optgroup>
                    <optgroup label="utf16le" title="UTF-16LE Unicode">
                        <option value="utf16le_bin" title="Юникод, Двоичный">utf16le_bin</option>
                        <option value="utf16le_general_ci" title="Юникод, регистронезависимый">utf16le_general_ci</option>
                    </optgroup>
                    <optgroup label="utf32" title="UTF-32 Unicode">
                        <option value="utf32_bin" title="Юникод, Двоичный">utf32_bin</option>
                        <option value="utf32_croatian_ci" title="Хорватский, регистронезависимый">utf32_croatian_ci</option>
                        <option value="utf32_czech_ci" title="Чешский, регистронезависимый">utf32_czech_ci</option>
                        <option value="utf32_danish_ci" title="Датский, регистронезависимый">utf32_danish_ci</option>
                        <option value="utf32_esperanto_ci" title="Эсперанто, регистронезависимый">utf32_esperanto_ci</option>
                        <option value="utf32_estonian_ci" title="Эстонский, регистронезависимый">utf32_estonian_ci</option>
                        <option value="utf32_general_ci" title="Юникод, регистронезависимый">utf32_general_ci</option>
                        <option value="utf32_german2_ci" title="Немецкий (порядок телефонной книги), регистронезависимый">utf32_german2_ci</option>
                        <option value="utf32_hungarian_ci" title="Венгерский, регистронезависимый">utf32_hungarian_ci</option>
                        <option value="utf32_icelandic_ci" title="Исландский, регистронезависимый">utf32_icelandic_ci</option>
                        <option value="utf32_latvian_ci" title="Латвийский, регистронезависимый">utf32_latvian_ci</option>
                        <option value="utf32_lithuanian_ci" title="Литовский, регистронезависимый">utf32_lithuanian_ci</option>
                        <option value="utf32_persian_ci" title="Персидский, регистронезависимый">utf32_persian_ci</option>
                        <option value="utf32_polish_ci" title="Польский, регистронезависимый">utf32_polish_ci</option>
                        <option value="utf32_roman_ci" title="Западно-Европейский, регистронезависимый">utf32_roman_ci</option>
                        <option value="utf32_romanian_ci" title="Румынский, регистронезависимый">utf32_romanian_ci</option>
                        <option value="utf32_sinhala_ci" title="Сингальский, регистронезависимый">utf32_sinhala_ci</option>
                        <option value="utf32_slovak_ci" title="Словацкий, регистронезависимый">utf32_slovak_ci</option>
                        <option value="utf32_slovenian_ci" title="Словенский, регистронезависимый">utf32_slovenian_ci</option>
                        <option value="utf32_spanish2_ci" title="Испанский (традиционный), регистронезависимый">utf32_spanish2_ci</option>
                        <option value="utf32_spanish_ci" title="Испанский, регистронезависимый">utf32_spanish_ci</option>
                        <option value="utf32_swedish_ci" title="Шведский, регистронезависимый">utf32_swedish_ci</option>
                        <option value="utf32_turkish_ci" title="Турецкий, регистронезависимый">utf32_turkish_ci</option>
                        <option value="utf32_unicode_520_ci" title="Юникод (UCA 5.2.0), регистронезависимый">utf32_unicode_520_ci</option>
                        <option value="utf32_unicode_ci" title="Юникод, регистронезависимый">utf32_unicode_ci</option>
                        <option value="utf32_vietnamese_ci" title="Вьетнамский, регистронезависимый">utf32_vietnamese_ci</option>
                    </optgroup>
                    <optgroup label="utf8" title="UTF-8 Unicode">
                        <option value="utf8_bin" title="Юникод, Двоичный">utf8_bin</option>
                        <option value="utf8_croatian_ci" title="Хорватский, регистронезависимый">utf8_croatian_ci</option>
                        <option value="utf8_czech_ci" title="Чешский, регистронезависимый">utf8_czech_ci</option>
                        <option value="utf8_danish_ci" title="Датский, регистронезависимый">utf8_danish_ci</option>
                        <option value="utf8_esperanto_ci" title="Эсперанто, регистронезависимый">utf8_esperanto_ci</option>
                        <option value="utf8_estonian_ci" title="Эстонский, регистронезависимый">utf8_estonian_ci</option>
                        <option value="utf8_general_ci" title="Юникод, регистронезависимый">utf8_general_ci</option>
                        <option value="utf8_general_mysql500_ci" title="Юникод (MySQL 5.0.0), регистронезависимый">utf8_general_mysql500_ci</option>
                        <option value="utf8_german2_ci" title="Немецкий (порядок телефонной книги), регистронезависимый">utf8_german2_ci</option>
                        <option value="utf8_hungarian_ci" title="Венгерский, регистронезависимый">utf8_hungarian_ci</option>
                        <option value="utf8_icelandic_ci" title="Исландский, регистронезависимый">utf8_icelandic_ci</option>
                        <option value="utf8_latvian_ci" title="Латвийский, регистронезависимый">utf8_latvian_ci</option>
                        <option value="utf8_lithuanian_ci" title="Литовский, регистронезависимый">utf8_lithuanian_ci</option>
                        <option value="utf8_persian_ci" title="Персидский, регистронезависимый">utf8_persian_ci</option>
                        <option value="utf8_polish_ci" title="Польский, регистронезависимый">utf8_polish_ci</option>
                        <option value="utf8_roman_ci" title="Западно-Европейский, регистронезависимый">utf8_roman_ci</option>
                        <option value="utf8_romanian_ci" title="Румынский, регистронезависимый">utf8_romanian_ci</option>
                        <option value="utf8_sinhala_ci" title="Сингальский, регистронезависимый">utf8_sinhala_ci</option>
                        <option value="utf8_slovak_ci" title="Словацкий, регистронезависимый">utf8_slovak_ci</option>
                        <option value="utf8_slovenian_ci" title="Словенский, регистронезависимый">utf8_slovenian_ci</option>
                        <option value="utf8_spanish2_ci" title="Испанский (традиционный), регистронезависимый">utf8_spanish2_ci</option>
                        <option value="utf8_spanish_ci" title="Испанский, регистронезависимый">utf8_spanish_ci</option>
                        <option value="utf8_swedish_ci" title="Шведский, регистронезависимый">utf8_swedish_ci</option>
                        <option value="utf8_tolower_ci" title="Юникод, регистронезависимый">utf8_tolower_ci</option>
                        <option value="utf8_turkish_ci" title="Турецкий, регистронезависимый">utf8_turkish_ci</option>
                        <option value="utf8_unicode_520_ci" title="Юникод (UCA 5.2.0), регистронезависимый">utf8_unicode_520_ci</option>
                        <option value="utf8_unicode_ci" title="Юникод, регистронезависимый">utf8_unicode_ci</option>
                        <option value="utf8_vietnamese_ci" title="Вьетнамский, регистронезависимый">utf8_vietnamese_ci</option>
                    </optgroup>
                    <optgroup label="utf8mb4" title="UTF-8 Unicode">
                        <option value="utf8mb4_0900_ai_ci" title="Юникод (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_0900_ai_ci</option>
                        <option value="utf8mb4_0900_as_ci" title="Юникод (UCA 9.0.0), акцент чувствительный, регистронезависимый">utf8mb4_0900_as_ci</option>
                        <option value="utf8mb4_0900_as_cs" title="Юникод (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_0900_as_cs</option>
                        <option value="utf8mb4_0900_bin" title="Юникод (UCA 9.0.0), Двоичный">utf8mb4_0900_bin</option>
                        <option value="utf8mb4_bin" title="Юникод (UCA 4.0.0), Двоичный">utf8mb4_bin</option>
                        <option value="utf8mb4_croatian_ci" title="Хорватский (UCA 4.0.0), регистронезависимый">utf8mb4_croatian_ci</option>
                        <option value="utf8mb4_cs_0900_ai_ci" title="Чешский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_cs_0900_ai_ci</option>
                        <option value="utf8mb4_cs_0900_as_cs" title="Чешский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_cs_0900_as_cs</option>
                        <option value="utf8mb4_czech_ci" title="Чешский (UCA 4.0.0), регистронезависимый">utf8mb4_czech_ci</option>
                        <option value="utf8mb4_da_0900_ai_ci" title="Датский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_da_0900_ai_ci</option>
                        <option value="utf8mb4_da_0900_as_cs" title="Датский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_da_0900_as_cs</option>
                        <option value="utf8mb4_danish_ci" title="Датский (UCA 4.0.0), регистронезависимый">utf8mb4_danish_ci</option>
                        <option value="utf8mb4_de_pb_0900_ai_ci" title="Немецкий (порядок телефонной книги) (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_de_pb_0900_ai_ci</option>
                        <option value="utf8mb4_de_pb_0900_as_cs" title="Немецкий (порядок телефонной книги) (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_de_pb_0900_as_cs</option>
                        <option value="utf8mb4_eo_0900_ai_ci" title="Эсперанто (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_eo_0900_ai_ci</option>
                        <option value="utf8mb4_eo_0900_as_cs" title="Эсперанто (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_eo_0900_as_cs</option>
                        <option value="utf8mb4_es_0900_ai_ci" title="Испанский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_es_0900_ai_ci</option>
                        <option value="utf8mb4_es_0900_as_cs" title="Испанский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_es_0900_as_cs</option>
                        <option value="utf8mb4_es_trad_0900_ai_ci" title="Испанский (традиционный) (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_es_trad_0900_ai_ci</option>
                        <option value="utf8mb4_es_trad_0900_as_cs" title="Испанский (традиционный) (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_es_trad_0900_as_cs</option>
                        <option value="utf8mb4_esperanto_ci" title="Эсперанто (UCA 4.0.0), регистронезависимый">utf8mb4_esperanto_ci</option>
                        <option value="utf8mb4_estonian_ci" title="Эстонский (UCA 4.0.0), регистронезависимый">utf8mb4_estonian_ci</option>
                        <option value="utf8mb4_et_0900_ai_ci" title="Эстонский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_et_0900_ai_ci</option>
                        <option value="utf8mb4_et_0900_as_cs" title="Эстонский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_et_0900_as_cs</option>
                        <option value="utf8mb4_general_ci" title="Юникод (UCA 4.0.0), регистронезависимый">utf8mb4_general_ci</option>
                        <option value="utf8mb4_german2_ci" title="Немецкий (порядок телефонной книги) (UCA 4.0.0), регистронезависимый">utf8mb4_german2_ci</option>
                        <option value="utf8mb4_hr_0900_ai_ci" title="Хорватский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_hr_0900_ai_ci</option>
                        <option value="utf8mb4_hr_0900_as_cs" title="Хорватский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_hr_0900_as_cs</option>
                        <option value="utf8mb4_hu_0900_ai_ci" title="Венгерский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_hu_0900_ai_ci</option>
                        <option value="utf8mb4_hu_0900_as_cs" title="Венгерский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_hu_0900_as_cs</option>
                        <option value="utf8mb4_hungarian_ci" title="Венгерский (UCA 4.0.0), регистронезависимый">utf8mb4_hungarian_ci</option>
                        <option value="utf8mb4_icelandic_ci" title="Исландский (UCA 4.0.0), регистронезависимый">utf8mb4_icelandic_ci</option>
                        <option value="utf8mb4_is_0900_ai_ci" title="Исландский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_is_0900_ai_ci</option>
                        <option value="utf8mb4_is_0900_as_cs" title="Исландский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_is_0900_as_cs</option>
                        <option value="utf8mb4_ja_0900_as_cs" title="Японский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_ja_0900_as_cs</option>
                        <option value="utf8mb4_ja_0900_as_cs_ks" title="Японский (UCA 9.0.0), акцент чувствительный, регистрозависимый, кана-зависимый">utf8mb4_ja_0900_as_cs_ks</option>
                        <option value="utf8mb4_la_0900_ai_ci" title="Классическая латынь (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_la_0900_ai_ci</option>
                        <option value="utf8mb4_la_0900_as_cs" title="Классическая латынь (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_la_0900_as_cs</option>
                        <option value="utf8mb4_latvian_ci" title="Латвийский (UCA 4.0.0), регистронезависимый">utf8mb4_latvian_ci</option>
                        <option value="utf8mb4_lithuanian_ci" title="Литовский (UCA 4.0.0), регистронезависимый">utf8mb4_lithuanian_ci</option>
                        <option value="utf8mb4_lt_0900_ai_ci" title="Литовский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_lt_0900_ai_ci</option>
                        <option value="utf8mb4_lt_0900_as_cs" title="Литовский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_lt_0900_as_cs</option>
                        <option value="utf8mb4_lv_0900_ai_ci" title="Латвийский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_lv_0900_ai_ci</option>
                        <option value="utf8mb4_lv_0900_as_cs" title="Латвийский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_lv_0900_as_cs</option>
                        <option value="utf8mb4_persian_ci" title="Персидский (UCA 4.0.0), регистронезависимый">utf8mb4_persian_ci</option>
                        <option value="utf8mb4_pl_0900_ai_ci" title="Польский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_pl_0900_ai_ci</option>
                        <option value="utf8mb4_pl_0900_as_cs" title="Польский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_pl_0900_as_cs</option>
                        <option value="utf8mb4_polish_ci" title="Польский (UCA 4.0.0), регистронезависимый">utf8mb4_polish_ci</option>
                        <option value="utf8mb4_ro_0900_ai_ci" title="Румынский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_ro_0900_ai_ci</option>
                        <option value="utf8mb4_ro_0900_as_cs" title="Румынский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_ro_0900_as_cs</option>
                        <option value="utf8mb4_roman_ci" title="Западно-Европейский (UCA 4.0.0), регистронезависимый">utf8mb4_roman_ci</option>
                        <option value="utf8mb4_romanian_ci" title="Румынский (UCA 4.0.0), регистронезависимый">utf8mb4_romanian_ci</option>
                        <option value="utf8mb4_ru_0900_ai_ci" title="Русский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_ru_0900_ai_ci</option>
                        <option value="utf8mb4_ru_0900_as_cs" title="Русский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_ru_0900_as_cs</option>
                        <option value="utf8mb4_sinhala_ci" title="Сингальский (UCA 4.0.0), регистронезависимый">utf8mb4_sinhala_ci</option>
                        <option value="utf8mb4_sk_0900_ai_ci" title="Словацкий (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_sk_0900_ai_ci</option>
                        <option value="utf8mb4_sk_0900_as_cs" title="Словацкий (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_sk_0900_as_cs</option>
                        <option value="utf8mb4_sl_0900_ai_ci" title="Словенский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_sl_0900_ai_ci</option>
                        <option value="utf8mb4_sl_0900_as_cs" title="Словенский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_sl_0900_as_cs</option>
                        <option value="utf8mb4_slovak_ci" title="Словацкий (UCA 4.0.0), регистронезависимый">utf8mb4_slovak_ci</option>
                        <option value="utf8mb4_slovenian_ci" title="Словенский (UCA 4.0.0), регистронезависимый">utf8mb4_slovenian_ci</option>
                        <option value="utf8mb4_spanish2_ci" title="Испанский (традиционный) (UCA 4.0.0), регистронезависимый">utf8mb4_spanish2_ci</option>
                        <option value="utf8mb4_spanish_ci" title="Испанский (UCA 4.0.0), регистронезависимый">utf8mb4_spanish_ci</option>
                        <option value="utf8mb4_sv_0900_ai_ci" title="Шведский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_sv_0900_ai_ci</option>
                        <option value="utf8mb4_sv_0900_as_cs" title="Шведский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_sv_0900_as_cs</option>
                        <option value="utf8mb4_swedish_ci" title="Шведский (UCA 4.0.0), регистронезависимый">utf8mb4_swedish_ci</option>
                        <option value="utf8mb4_tr_0900_ai_ci" title="Турецкий (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_tr_0900_ai_ci</option>
                        <option value="utf8mb4_tr_0900_as_cs" title="Турецкий (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_tr_0900_as_cs</option>
                        <option value="utf8mb4_turkish_ci" title="Турецкий (UCA 4.0.0), регистронезависимый">utf8mb4_turkish_ci</option>
                        <option value="utf8mb4_unicode_520_ci" title="Юникод (UCA 5.2.0), регистронезависимый">utf8mb4_unicode_520_ci</option>
                        <option value="utf8mb4_unicode_ci" title="Юникод (UCA 4.0.0), регистронезависимый">utf8mb4_unicode_ci</option>
                        <option value="utf8mb4_vi_0900_ai_ci" title="Вьетнамский (UCA 9.0.0), акцент нечувствительный, регистронезависимый">utf8mb4_vi_0900_ai_ci</option>
                        <option value="utf8mb4_vi_0900_as_cs" title="Вьетнамский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_vi_0900_as_cs</option>
                        <option value="utf8mb4_vietnamese_ci" title="Вьетнамский (UCA 4.0.0), регистронезависимый">utf8mb4_vietnamese_ci</option>
                        <option value="utf8mb4_zh_0900_as_cs" title="Китайский (UCA 9.0.0), акцент чувствительный, регистрозависимый">utf8mb4_zh_0900_as_cs</option>
                    </optgroup>
                </select>
                <select name="type_table">
                    <option value="MEMORY">MEMORY</option>
                    <option value="MRG_MYISAM">MRG_MYISAM</option>
                    <option value="CSV">CSV</option>
                    <option value="MyISAM">MyISAM</option>
                    <option value="InnoDB" selected>InnoDB</option>
                    <option value="BLACKHOLE">BLACKHOLE</option>
                    <option value="ARCHIVE">ARCHIVE</option>
                </select>
            </div>

            <input name="db" value="<?= $db ?>" hidden>
            <input name="table_name" value="<?= $table_name ?>" hidden>
            <input name="count_columns" value="<?= $count_columns ?>" hidden>
        <input type="submit" name="submit" value="Добавить таблицу" />
        </form>


    </div>

</div>
</body>
</html>


