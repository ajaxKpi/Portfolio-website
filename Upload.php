<?php
/**
 * Created by PhpStorm.
 * User: zvorskyi
 * Date: 24.09.2015
 * Time: 12:21
 */
/* **************************************************************
 ****************************Create procedure *********************
***************************************************************/

if(isset($_POST['create']))
{
    $target_dir = "img/preview/";
    $NamePS =$_POST['ps_name'];
    $Data =$_POST['data'];
    $Tag = $_POST['tag'];
    $Desc = $_POST['descr'];
    $ID =  $_POST['id'];



        //--------------------------upload small preview--------------------------

        $target_file = $target_dir . basename($_FILES["small-preview"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $clearNamePS = $ID.strtolower (str_replace(' ','',substr($NamePS,0,15))).".".$imageFileType;



        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["small-preview"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["small-preview"]["tmp_name"], $target_dir.$clearNamePS)) {
                echo "The file " . $clearNamePS . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

    }
    //--------------------------upload large preview--------------------------
    $folder_loc= "img/photo/";
    $target_file = $target_dir."L_".$clearNamePS;
    $uploadOk = 1;
    //$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["large-preview"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["large-preview"]["tmp_name"], $target_file)) {
            echo "The file ".$clearNamePS. " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    //--------------------------All files from post upload--------------------------
    // set or create folder to store data

   $filepath = "img/photo/".$_POST['ps_name']."/";

    if (!file_exists($filepath)){
        mkdir( $filepath, 0777);
    }
//download and each photo to the server
    foreach ($_FILES["photo_upload"]["error"] as $key => $error){

        if ($error == UPLOAD_ERR_OK){

            $tmp_name = $_FILES["photo_upload"]["tmp_name"][$key];
            $name = $_FILES["photo_upload"]["name"][$key];
            move_uploaded_file($tmp_name, $filepath.$name);
        }


    }


    //--------------------------insert new data to DB --------------------------
    require_once 'data.php';
    $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
    $mysqli->set_charset("utf8");


    $query = "INSERT into base  (`id`, `name`, `date`, `preview`, `folder`, `tag`, `visits`,  `descr`)
      VALUES ('". $ID ."', '" . $NamePS ."',STR_TO_DATE('". $Data. "','%d/%m/%Y'), '".$target_dir.$clearNamePS."', '".$folder_loc.$NamePS."', '".$Tag."',  '0','".$Desc."')";

    $res = $mysqli->query($query);


}
/* **************************************************************
 ****************************Edit procedure *********************
***************************************************************/
if(isset($_POST['EditButton'] )) {

    $target_dir = "img/preview/";

    $NamePS ="'".$_POST['edit_ps_name']."'";
    $Date ="'".$_POST['edit_date']."'";
    $Tag = "'".$_POST['edit_tag']."'";
    $Desc = "'".$_POST['edit_descr']."'";
    $ID =  "'".$_POST['edit_id']."'";


    require_once 'data.php';
    $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
    $mysqli->set_charset("utf8");


    $query = "Update base SET   name = ".$NamePS. ", date=".$Date. ", tag=".$Tag.", descr=".$Desc."
     where id=".$ID;
    $res = $mysqli->query($query);


}



/* **************************************************************
 ****************************Load Edit procedure *********************
***************************************************************/

if(isset($_POST['date'] )){

    $Data =$_POST['date'];
    $Data =  date_create_from_format('d/m/Y',$Data) ;
    $Data=   $Data-> format('Y-m-d');

    require_once 'data.php';

    $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
    $mysqli->set_charset("utf8");
    $query ="Select * from base where base.date ='".$Data."'";
    $res = $mysqli->query($query);

    $row= $res->fetch_assoc();
    $formParams = array(
        'ajax' => 'Hello world!',
        'id' => $row['id'],
        'name' => $row['name'],
        'preview' => $row['preview'],
        'folder' => $row['folder'],
        'tag' => $row['tag'],
        'descr' => $row['descr']
    );
    echo json_encode($formParams);

}
/* **************************************************************
 ****************************Delete procedure *********************
***************************************************************/
if(isset($_POST['deleteButton'])){

    $target_dir = "img/preview/";

    $NamePS ="'".$_POST['delete_ps_name']."'";
    $Date ="'".$_POST['delete_date']."'";

    $Desc = "'".$_POST['delete_descr']."'";
    $ID =  "'".$_POST['delete_id']."'";


    require_once 'data.php';
    $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
    $mysqli->set_charset("utf8");


    $query = "Delete from  base where id=".$ID;
    $res = $mysqli->query($query);



}

/* **************************************************************
 ****************************Busy days procedure *********************
***************************************************************/

    if (isset($_POST['busyCr'])) {
        $Event_descr=  $_POST['ps_name'];
        $Event_date=  $_POST['Busydata'];
      if ($Event_descr){
          //$data[] =array($Event_date=> $Event_descr);

          $file = file_get_contents('Busy1.json');
          $data = json_decode($file,true);

          unset($file);
          $data[$Event_date] = $Event_descr;
          $jsonData = json_encode($data);
          file_put_contents('Busy1.json', $jsonData);
          unset($data);

      }
        else{
        //try to delete event
            $file = file_get_contents('Busy1.json');
            $data = json_decode($file,true);
            unset($file);
            unset( $data[$Event_date]);
            $jsonData = json_encode($data);
            file_put_contents('Busy1.json', $jsonData);
            unset($data);
        }
       // $fp = fopen('Busy.json', 'w');
        //fwrite($fp, json_encode($posts));
        //fclose($fp);
    }

//header("Location: index.php");
?>