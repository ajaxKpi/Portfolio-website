<?php
/**
 * Created by PhpStorm.
 * User: zvorskyi
 * Date: 24.09.2015
 * Time: 12:21
 */
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}






/* **************************************************************
 ****************************Create procedure *********************
***************************************************************/

if(isset($_POST['CreateButton']))
{
    $target_dir = "img/preview/";
    $NamePS =$_POST['ps_name'];
    $Data =$_POST['data'];
    $Tag = $_POST['tag'];
    $Desc = $_POST['descr'];
    $Desc_ru = $_POST['descr_ru'];
    $ID =  $_POST['id'];
    $subc = $_POST['subcontr'];
    $subc_ru = $_POST['subcontr_ru'];
    $feedb = $_POST['feedback'];
    $feedb_ru = $_POST['feedback_ru'];


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
                echo "Sorry, there was an error uploading your file Portfolio preview.";
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
            echo "Sorry, there was an error uploading your file Blog Preview.";
        }
    }

    //--------------------------upload large preview--------------------------
    $folder_loc= "img/photo/";
    $target_file = $target_dir."S_".$clearNamePS;
    $uploadOk = 1;
    //$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["exsmall-preview"]["tmp_name"]);
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
        if (move_uploaded_file($_FILES["exsmall-preview"]["tmp_name"], $target_file)) {
            echo "The file ".$clearNamePS. " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file popular stories";
        }
    }


    //--------------------------All files from post upload--------------------------
    // set or create folder to store data

   $filepath = "img/photo/". $ID.$_POST['ps_name']."/";

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
    require_once 'includes/data.php';
    $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
    $mysqli->set_charset("utf8");


    $query = "INSERT into base  (`id`, `name`, `date`, `preview`, `folder`, `tag`, `visits`,  `descr`, `descr_ru`,`subcon`,`subcon_ru`, `feedb`,`feedb_ru` )
      VALUES ('". $ID ."', '" . $NamePS ."',STR_TO_DATE('". $Data. "','%d/%m/%Y'), '".$target_dir.$clearNamePS."', '".$folder_loc.$ID.$NamePS."', '".$Tag."',  '0','".$Desc."',
      '".$Desc_ru."', '".$subc."', '".$subc_ru."', '".$feedb."', '".$feedb_ru."')";

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
    $Desc_ru="'".$_POST['edit_descr_ru']."'";
    $ID =  "'".$_POST['edit_id']."'";
    $subc = $_POST['edit_subcontr'];
    $subc_ru = $_POST['edit_subcontr_ru'];
    $feedb = $_POST['edit_feedback'];
    $feedb_ru = $_POST['edit_feedback_ru'];


    require_once 'includes/data.php';
    $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
    $mysqli->set_charset("utf8");

    $res = $mysqli->query("SELECT folder, preview FROM base Where id=".$ID);
    $row= $res->fetch_assoc();
    $prevFolder = $row['folder'];
    $prevPreview = $row['preview'];


    //--------------------------re - upload small preview--------------------------

    $uploadOk = 1;
    $target_file = $target_dir . basename($_FILES["small-preview"]["name"]);

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $clearNamePS = $_POST['edit_id'].strtolower (str_replace(' ','',substr($_POST['edit_ps_name'],0,15))).".".$imageFileType;


    $preview_loc = $prevPreview;
    $photo_loc = $prevFolder;

    // Check if image file is a actual image or fake image
    if (isset($_POST["EditButton"])&& $_FILES["small-preview"]["tmp_name"]!=="") {
        $check = getimagesize($_FILES["small-preview"]["tmp_name"]);
        if ($check !== false) {
            unlink($prevPreview);
            $uploadOk = 1;
            $preview_loc = $target_dir.$clearNamePS;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["small-preview"]["tmp_name"], $target_dir.$clearNamePS);

    }

//--------------------------re upload large preview--------------------------
    $folder_loc= "img/photo/";
    $target_file = $target_dir . basename($_FILES["large-preview"]["name"]);

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $clearNamePS = $_POST['edit_id'].strtolower (str_replace(' ','',substr($_POST['edit_ps_name'],0,15))).".".$imageFileType;

    $target_file = $target_dir."L_".$clearNamePS;

    $uploadOk = 1;
    $arrayPath= explode("/",$prevPreview);
    $LPfile =$target_dir. "L_".$arrayPath[sizeof($arrayPath)-1];



    // Check if image file is a actual image or fake image
    if(isset($_POST["EditButton"])&& $_FILES["large-preview"]["tmp_name"]!=="") {

        $check = getimagesize($_FILES["large-preview"]["tmp_name"]);
        if($check !== false) {
            unlink($LPfile);
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["large-preview"]["tmp_name"], $target_file);

    }



    //--------------------------re upload small preview--------------------------
    $folder_loc= "img/photo/";

    $target_file = $target_dir . basename($_FILES["exsmall-preview"]["name"]);

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $clearNamePS = $_POST['edit_id'].strtolower (str_replace(' ','',substr($_POST['edit_ps_name'],0,15))).".".$imageFileType;

    $target_file = $target_dir."S_".$clearNamePS;

    $uploadOk = 1;
    $arrayPath= explode("/",$prevPreview);
    $LPfile =$target_dir. "S_".$arrayPath[sizeof($arrayPath)-1];



    // Check if image file is a actual image or fake image
    if(isset($_POST["EditButton"])&& $_FILES["exsmall-preview"]["tmp_name"]!=="") {

        $check = getimagesize($_FILES["exsmall-preview"]["tmp_name"]);
        if($check !== false) {
            unlink($LPfile);
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["exsmall-preview"]["tmp_name"], $target_file);

    }



    //--------------------------re All files from post upload--------------------------
    // set or create folder to store data

    $filepath = "img/photo/". $ID.$_POST['edit_ps_name']."/";
    if (!empty($_FILES["photo_upload"])){


//download and each photo to the server
        $firstTime =true;
        foreach ($_FILES["photo_upload"]["error"] as $key => $error){

            if ($error == UPLOAD_ERR_OK){
                if ($firstTime){
                    $firstTime=false;
                    $photo_loc = $filepath;
                    deleteDirectory($prevFolder);
                    if (!file_exists($filepath)) {
                        mkdir($filepath, 0777);
                    }

                }

                $tmp_name = $_FILES["photo_upload"]["tmp_name"][$key];
                $name = $_FILES["photo_upload"]["name"][$key];
                move_uploaded_file($tmp_name, $filepath.$name);
            }
        }



        $query = "Update base SET   name = ".$NamePS. ", date=STR_TO_DATE(". $Date. ",'%d/%m/%Y'), tag=".$Tag.", descr=".$Desc.", descr_ru=".$Desc_ru.", preview ='"
            .$preview_loc."', folder = '".$photo_loc."', subcon = '".$subc."', subcon_ru = '".$subc_ru."', feedb = '".$feedb."', feedb_ru = '".$feedb_ru."' where id=".$ID;
        $res = $mysqli->query($query);





    }
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


    require_once 'includes/data.php';
    $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
    $mysqli->set_charset("utf8");

    $res = $mysqli->query("SELECT folder, preview FROM base Where id=".$ID);
    $row= $res->fetch_assoc();
    $prevFolder = $row['folder'];
    $prevPreview = $row['preview'];
    $arrayPath= explode("/",$prevPreview);
    $LPfile =$target_dir. "L_".$arrayPath[sizeof($arrayPath)-1];




    unlink($prevPreview);
    unlink($LPfile);
    deleteDirectory($prevFolder);


    $query = "Delete from  base where id=".$ID;
    $res = $mysqli->query($query);



}



/* **************************************************************
 ****************************Load Edit procedure *********************
***************************************************************/

if(isset($_POST['date'] )){

    $Data =$_POST['date'];
    $Data =  date_create_from_format('d/m/Y',$Data) ;
    $Data=   $Data-> format('Y-m-d');

    require_once 'includes/data.php';

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
        'descr' => $row['descr'],
        'descr_ru' => $row['descr_ru'],
        'subcontr' => $row['subcon'],
        'subcontr_ru' => $row['subcon_ru'],
        'feedback' => $row['feedb'],
        'feedback_ru' => $row['feedb_ru']

    );
    echo json_encode($formParams);

}


/* **************************************************************
 ****************************Add feedback procedure *********************
***************************************************************/

if(isset($_POST['feedButton'] )){
    //get last ID

    require_once 'includes/data.php';
    $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
    $mysqli->set_charset("utf8");
    $res = $mysqli->query("SELECT MAX(id) as maxID FROM feedback");

    $Last_id= $res->fetch_assoc();
    $newId =(int)$Last_id['maxID'];
    echo "val=".$newId;

    $newId++;
    echo "val1=".$newId;
    $fbDate=$_POST['feed_data'];
    $fbName = $_POST['feed_name'];
    $feedback_en =$_POST['feedback'];
    $feedback_ru =$_POST['feedback_ru'];


    $target_dir = "img/feedback/";
    $target_file = $target_dir . basename($_FILES["fb-preview"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $clearNamePS = "fb_".$newId.strtolower (str_replace(' ','',substr($fbName,0,15))).".".$imageFileType;


    $uploadOk =0;
        if (move_uploaded_file($_FILES["fb-preview"]["tmp_name"], $target_dir.$clearNamePS)) {
            echo "The file " . $clearNamePS . " has been uploaded.";
            $uploadOk =1;
        }

                else{
        echo "Sorry, your file was not uploaded.";
             }



    if (  $uploadOk =1){

    $sql_query = "INSERT INTO `feedback`(`id`, `name`, `date`,`feedback`,`feedback_ru`, `preview`, `rank`) VALUES ('".$newId."','".$fbName."', STR_TO_DATE('". $fbDate. "','%d/%m/%Y'), '".$feedback_en."','"
    .$feedback_ru."', '".$target_dir.$clearNamePS."','')";
        $res = $mysqli->query($sql_query);
    }



}
/* **************************************************************
 ****************************Remove feedback procedure *********************
***************************************************************/

if(isset($_POST['delfeedButton'] )){
    //get last ID


    $fbDate ="'".$_POST['feed_data']."'";

    require_once 'includes/data.php';
    $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
    $mysqli->set_charset("utf8");


    $res = $mysqli->query("SELECT id, preview FROM feedback Where `date`=STR_TO_DATE(". $fbDate. ",'%d/%m/%Y')");
    $row= $res->fetch_assoc();


    $target_dir = "img/feedback/";
    $ID =  "'".$row['id']."'";

    $prevPreview = $row['preview'];

    unlink($prevPreview);

    $query = "Delete from  feedback where id=".$ID;
    $res = $mysqli->query($query);


}

//header("Location: index.php");
?>