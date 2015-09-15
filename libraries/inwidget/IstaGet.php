<?php
/**
 * Created by PhpStorm.
 * User: zvorskyi
 * Date: 15.09.2015
 * Time: 17:10
 */class inWidget
{
    public $config = array();
    public $data = array();
    public $width = 260;
    public $inline = 4;
    public $view = 12;
    public $toolbar = true;
    public $preview = 'small';
    public $imgWidth = 0;
    public $cacheFile = 'cache/db.txt';
    public $lang = array();
    public $langName = '';
    public $langPath = 'lang/';
    public $answer = '';


    public $errors = array(
        101=>'Can\'t get access to file <b>{$cacheFile}</b>. Check permissions.',
        102=>'Can\'t get modification time of <b>{$cacheFile}</b>. Cache always be expired.',
        103=>'Can\'t send request. You need the cURL extension OR set allow_url_fopen to "true" in php.ini and openssl extension',
        401=>'Can\'t get correct answer from Instagram API server. <br />If you want send request again, delete cache file or wait cache expiration. API server answer: <br /><br />{$answer}',
        402=>'Can\'t get data from Instagram API server. User OR CLIENT_ID not found.<br />If you want send request again, delete cache file or wait cache expiration.',
    );


    public function __construct(){

        $this->config = array('LOGIN'=> '17222860', 'CLIENT_ID' => '4f05e65fab334327bcf8299955ed992a','imgCount' => 20, 'HASHTAG'=> '');
       // $this->checkConfig();

    }

    public function getData(){
        $this->data = $this->getCache();
        if(empty($this->data)){
            $this->apiQuery();

            $this->data = json_decode(file_get_contents($this->cacheFile));
        }
    }


    public function apiQuery(){

        // -------------------------------------------------
        //  Try to get photo
        // -------------------------------------------------
        if(!empty($this->config['HASHTAG'])){
            $this->answer = $this->send('https://api.instagram.com/v1/tags/'.urlencode($this->config['HASHTAG']).'/media/recent/?client_id='.$this->config['CLIENT_ID'].'&count='.$this->config['imgCount']);
        }
        else $this->answer = $this->send('https://api.instagram.com/v1/users/'.$this->data['userid'].'/media/recent/?client_id='.$this->config['CLIENT_ID'].'&count='.$this->config['imgCount']);
        $answer = json_decode($this->answer);
        if(is_object($answer)){
            if($answer->meta->code == 200){
                if(!empty($answer->data)){
                    $images = array();
                    foreach ($answer->data as $key=>$item){
                        $images[$key]['link'] 		= $item->link;
                        $images[$key]['large'] 		= $item->images->low_resolution->url;
                     }
                    $this->data['images'] = $images;
                }
                else $this->data['images'] = array();
            }
            else die($this->getError(402));
        }
        else die($this->getError(401));
    }

    public function send($url){
        if(extension_loaded('curl')){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_URL, $url);
            $answer = curl_exec($ch);
            curl_close($ch);
            return $answer;
        }
        elseif(ini_get('allow_url_fopen') AND extension_loaded('openssl')){
            $answer = file_get_contents($url);
            return $answer;
        }
        else die($this->getError(103));
    }




}
