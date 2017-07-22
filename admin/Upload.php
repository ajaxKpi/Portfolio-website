<?php

CONST RAW_DIR = "../img/raw/";

require_once "services/ImageMinification/ImageResize.php";
require_once '../backend/protected/CONFIG.php';

class Upload
{
    function __construct($config)
    {
        $this->init();
    }

    private function init()
    {
        $this->compressedTool = new ImageResize();
        $this->connectToDB();
    }

    private function connectToDB()
    {
        $mysqli = new mysqli(SERVER, LOGIN, PASSWORD, DBNAME);
        $mysqli->set_charset("utf8");
        $this->mysqli=$mysqli;
    }

    private function deleteDirectory($dir)
    {
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

    private function saveRawImage($file, $name, $imageFileType)
    {
        $uploadOk = 0;
        $check = getimagesize($file);
        $name = $name . "." . $imageFileType;
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file, RAW_DIR . $name)) {
                return (RAW_DIR . $name);
            } else {
                echo "Sorry, there was an error uploading your file Portfolio preview.";
            }

        }
        return $uploadOk;

    }

    private function compressAndResizeImg($file, $NamePS)
    {
        global $file_path;
        $raw_img_location = saveRawImage($file, $NamePS, 'jpg');
        return $raw_img_location && $this->compressedTool->compressAndResize($raw_img_location, $file_path . $NamePS);
    }

    private function getFileType($dir, $name)
    {
        $target_file = $dir . basename($name);
        return pathinfo($target_file, PATHINFO_EXTENSION);
    }

    public function storeImages($params){
        $NamePS = $_POST['ps_name'];
        $ID = $_POST['id'];

        $this->saveRawImage();
    }

    public function saveStory($params)
    {
        // copy and resize image
        $this->storeImages($params);

        // write story to DB
        $mysqli =$this->mysqli;

        $query = "INSERT INTO base  (`id`, `name`, `date`, `preview`, `folder`, `tag`, `visits`,  `descr`, `descr_ru`,`subcon`,`subcon_ru` )
                  VALUES ('$ID', '$NamePS',STR_TO_DATE('$Data','%d/%m/%Y'), '$target_dir.$clearNamePS','$folder_loc.$ID.$NamePS', '$Tag',  '0','$Desc','$Desc_ru', '$subc','$subc_ru')";

        $res = $mysqli->query($query);

        return 1;
    }

    public function loadStory()
    {

    }
    public function editStory()
    {

    }

    public function bookDay(){
        
    }

}


if (isset($_GET['action'])) {
    $uploadApi = new Upload($_GET['date']);
    switch ($_GET['action']) {
        case 'loadStory':
            return $uploadApi->loadStory($_GET['date']);
        default:
    }
} else {
        $postData=$_POST;
        $uploadApi = new Upload($postData);
        switch ($postData['action']) {
            case 'editStory':
            return $uploadApi->editStory($postData);

            case 'saveStory':
                return $uploadApi->saveStory($postData);
        }
}