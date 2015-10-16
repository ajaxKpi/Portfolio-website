<?php
/**
 * Created by PhpStorm.
 * User: zvorskyi
 * Date: 09.10.2015
 * Time: 12:59
 */
require_once 'data.php';
$mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
$mysqli->set_charset("utf8");


if($_POST['mode']=='GetDescr' ){

    $Link_id = $_POST['IdVal'];

    $query ="Select * from links where links.id ='".$Link_id."'";
    $res = $mysqli->query($query);

    $row= $res->fetch_assoc();
    $formParams = array(
            'descr' => $row['desc'],

    );
    echo json_encode($formParams);

}


if($_POST['mode']=='WriteLink') {
    $Link_id = $_POST['IdVal'];
    $Link_desc = $_POST['link_descr'];
    $query = "INSERT into `links` (`id`, `desc`) Values (".$Link_id.",'".$Link_desc."')";
    $res = $mysqli->query($query);
    echo ($query);
}
