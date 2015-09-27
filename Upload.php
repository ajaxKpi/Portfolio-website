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

if(isset($_POST['mode']) && $_POST['mode'] == 'create')
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
if(isset($_POST['edit']) && $_POST['edit'] == 'edit'){



}
/* **************************************************************
 ****************************Edit procedure *********************
***************************************************************/
if(isset($_POST['delete']) && $_POST['delete'] == 'delete'){



}
//header("Location: index.php");
?>