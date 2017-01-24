<?php

/**
 * Created by PhpStorm.
 * User: ivan.zvorskyi
 * Date: 7/7/2016
 * Time: 2:24 PM
 */

require_once("lib/Tinify/Exception.php");
require_once("lib/Tinify/ResultMeta.php");
require_once("lib/Tinify/Result.php");
require_once("lib/Tinify/Source.php");
require_once("lib/Tinify/Client.php");
require_once("lib/Tinify.php");

class tinyPNG
{
    private $apiKey ="xouvfAtOXU6cv9lvLc7rfwBdZHAgBURc";
    private $SIZES=array(
        960 => array("width" => 930, "height" => 620),
        768 => array("width" => 744, "height" => 496),
        468 => array("width" => 150, "height" => 100)
        );


    private function connection(){
       \Tinify\setKey($this->apiKey);
        return(\Tinify\validate());

    }


    public function compressAndResize($source, $dist){

        if(self::connection()){
            $minifiedImg = \Tinify\fromFile($source);
            foreach($this->SIZES as $size=>$sizeName){
                $minAndResizedImg =$minifiedImg->resize(array(
                    "method"=>"cover",
                    "width" => $sizeName['width'],
                    "height" => $sizeName['height']));
                $fullFilename = $dist.$size.'.jpg';
                $minAndResizedImg->toFile($fullFilename);
            }
            return true;
        }
        else{
            return false;
        }

    }
}
