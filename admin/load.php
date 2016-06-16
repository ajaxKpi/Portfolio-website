<?php
/**
 * Created by PhpStorm.
 * User: zvorskyi
 * Date: 09.10.2015
 * Time: 12:59
 */

/* **************************************************************
 ****************************Work with links table *********************
***************************************************************/
require_once '../backend/protected/CONFIG.php';
$mysqli = new mysqli(SERVER, LOGIN,PASSWORD , DBNAME);
$mysqli->set_charset("utf8");

if (isset($_POST['mode'])){
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
}
/* **************************************************************
 ****************************Busy days procedure *********************
***************************************************************/

if (isset($_POST['Event_date'])) {

    $Event_descr=  $_POST['Event'];
    $Event_date=  $_POST['Event_date'];
    if ($Event_descr){
        //$data[] =array($Event_date=> $Event_descr);

        $file = file_get_contents('Busy.Json');
        $data = json_decode($file,true);

        unset($file);
        $data[$Event_date] = $Event_descr;
        $jsonData = json_encode($data);
        file_put_contents('Busy.Json', $jsonData);
        unset($data);

    }
    else{
        //try to delete event
        $file = file_get_contents('Busy.Json');
        $data = json_decode($file,true);
        unset($file);
        unset( $data[$Event_date]);
        $jsonData = json_encode($data);
        file_put_contents('Busy.Json', $jsonData);
        unset($data);
    }


}
