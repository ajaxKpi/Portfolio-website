<?php 
/**
 * Project:     inWidget: show pictures from instagram.com on your site!
 * File:        index1.php
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of MIT license
 * http://inwidget.ru/MIT-license.txt
 * 
 * @link http://inwidget.ru
 * @copyright 2014 Alexandr Kazarmshchikov
 * @author Alexandr Kazarmshchikov
 * @version 1.0.6
 * @package inWidget
 * 
 */

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
setlocale(LC_ALL, "ru_RU.UTF-8");
header('Content-type: text/html; charset=utf-8');
		
require_once 'IstaGet.php';

$inWidget = new inWidget();
$inWidget->apiQuery();
$inWidget->createCache();
//$aa = $inWidget->data['images'];


//print_r($yo);
$CachedVal = json_decode(file_get_contents($inWidget->cacheFile));
$Ar_CachedVal = (array) $CachedVal;
$Insta_ph= $Ar_CachedVal['images'];

for ($key=0;  $key<sizeof($Insta_ph); $key++)
{
    $LinkImage= (array)$Insta_ph[$key];
    echo $LinkImage['link' ];
}


