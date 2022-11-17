<?php
/**
 * Import a .sql file in a MySQL database
 *
 * Usage:
 *
 * 1. edit the configuration parameters here below and save
 * 2. upload to the proper folder - usually /public_html - on your server
 * 3. open a browser and execute with with an URL similar to:
 *		http://example.com/dbexport.php
 *
 *		Changing example.com with the name of your site
 *
 * (c) 2013 http://grandolini.com
/**
 * Full path to the file you want to export
 * Note: The script must be able to write the file in the given folder
 *
 * Examples:
 *
 * to write the file in the main public folder - where usually your site files are located:
 * $filename = '~/public_html/mydata.sql';
 *
 * to write the file in your main folder - where nobody will be able to see it with a browser:
 * $filename = '~/mydata.sql';
 *
 * to write the file in the same folder where you install this script:
 * $filename = 'mydata.sql';
 */

$db = $_GET['db'];

$path = $_SERVER['DOCUMENT_ROOT'];
$filename = $path . "/assets/Dump/export/tables_" . $db . '.sql';

/**
 * MySQL connection configuration
 */


$database	= $db;
$user		= 'root';
$password	= 'root';
/**
 * usually it's ok to leave the MySQL host as 'localhost'
 * if your hosting provider instructed you differently, edit the next one as needed
 */
$host = 'localhost';

/**
 * DO NOT EDIT BELOW THIS LINE
 */
$fp = @fopen( $filename, 'w+' );
if( !$fp ) {

    echo 'Impossible to create <b>'. $filename .'</b>, please manually create one and assign it full write privileges: <b>777</b>';
    exit;
}
fclose( $fp );

$command = 'mysqldump -h'. $host .' -c -u '. $user .' -p'. $password .' '. $database .' > '. $filename;

exec( $command, $output, $worked );

switch( $worked ) {

    case 0:
        // даем файл пользователю на выгрузку
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        exit(readfile($filename));


    case 1:
        echo 'There was a warning during the export of <b>'. $database .'</b> to <b>'. $filename .'</b>';
        break;
    case 2:
        echo 'There was an error during import.'
            . 'Please make sure the import file is saved in the same folder as this script and check your values:'
            . '<br/><br/><table>'
            . '<tr><td>MySQL Database Name:</td><td><b>'. $database .'</b></td></tr>'
            . '<tr><td>MySQL User Name:</td><td><b>'. $user .'</b></td></tr>'
            . '<tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr>'
            . '<tr><td>MySQL Host Name:</td><td><b>'. $host .'</b></td></tr>'
            . '<tr><td>MySQL Import Filename:</td><td><b>'. $filename .'</b></td>'
            . '</tr></table>'
        ;
        break;
}