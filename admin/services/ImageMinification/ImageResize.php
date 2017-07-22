<?php



class ImageResize
{
    private $apiKey = "xouvfAtOXU6cv9lvLc7rfwBdZHAgBURc";
    private $SIZES = array(
        960 => array("width" => 930, "height" => 620),
        768 => array("width" => 744, "height" => 496),
        468 => array("width" => 150, "height" => 100)
    );

    // todo: make method for preview image

    public function compressAndResize($source, $dist)
    {

        $imagick = new \Imagick(realpath($source));
        foreach ($this->SIZES as $size => $sizeName) {
            $saveFolder = $dist."/$size";
            if (!file_exists($saveFolder)) {
                mkdir($saveFolder, 0777,true);
            }
            $imagick->resizeImage(
                $sizeName['width'],
                $sizeName['height'],imagick::FILTER_UNDEFINED,1, TRUE);
            $fullFilename = $saveFolder  . '.jpg';
            $imagick->writeImage($fullFilename);
        }
        $imagick->destroy();

    }
}
