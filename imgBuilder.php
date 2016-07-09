<?php

/**
 * Created by PhpStorm.
 * User: ivan.zvorskyi
 * Date: 7/6/2016
 * Time: 7:47 PM
 */
class imgBuilder
{

    const SAVEFOlDER='.';

    function __construct($imgUrl){
        $this->imgUrl=$imgUrl;
    }


    public $sizeSmall =[480,240];
    public $sizeMedium =[768,480];
    public $sizeLarge=[960,320];


    public function setSmall(){

        $this ->resizeImg(200,200);
    }



    private function resizeImg($width, $heigth){

        $filterType=imagick::COLOR_MAGENTA ;
        $blur=1;
        $bestFit=0;


        $imagick=new \Imagick(realpath($this->imgUrl));
        $imagick->resizeImage($width, $heigth, $filterType, $blur, $bestFit );

        $imagick->writeImage("test.jpg");
    }
}
$inst = new imgBuilder("img/1.JPG");
$inst->setSmall();
