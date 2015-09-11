<?php
/**
 * Created by PhpStorm.
 * User: zvorskyi
 * Date: 08.09.2015
 * Time: 18:45
 */


if (!$link = mysql_connect('localhost', 'root', 'edifier')) {
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db('mydb', $link)) {
    echo 'Could not select database';
    exit;
}

$sql    = 'SELECT preview  FROM calendar';
$result = mysql_query($sql, $link);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
    echo $result;
    echo $row;

}

mysql_free_result($result);

?>