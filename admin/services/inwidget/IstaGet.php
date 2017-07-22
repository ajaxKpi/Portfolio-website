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
    public $cacheFile = 'services/inwidget/cache/db.txt';
    public $lang = array();
    public $langName = '';
    public $langPath = 'lang/';
    public $answer = '';
    public $HasErrors = false;


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
        //$this->data = $this->getCache();
        if(empty($this->data)){
            $this->apiQuery();


            $this->data = json_decode(file_get_contents($this->cacheFile));
        }
    }


    public function apiQuery(){

        // -------------------------------------------------
        //  Try to get stories
        // -------------------------------------------------
        if(!empty($this->config['HASHTAG'])){
            $this->answer = $this->send('https://api.instagram.com/v1/tags/'.urlencode($this->config['HASHTAG']).'/media/recent/?client_id='.$this->config['CLIENT_ID'].'&count='.$this->config['imgCount']);
        }
        else $this->answer = $this->send("https://api.instagram.com/v1/users/17222860/media/recent/?client_id=4f05e65fab334327bcf8299955ed992a&count=20");



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
            else $this->HasErrors=true;
        }
        else $this->HasErrors=true;
    }

    public function createCache(){
        $data = json_encode($this->data);
        file_put_contents($this->cacheFile,$data,LOCK_EX);
    }
    public function getCache(){

        $rawData = file_get_contents($this->cacheFile);
        $cacheData = json_decode($rawData);
        if(!is_object($cacheData)) return $rawData;
        unset($rawData);

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

    public function getError($code){
        $this->errors[$code] = str_replace('{$cacheFile}',$this->cacheFile,$this->errors[$code]);
        $this->errors[$code] = str_replace('{$answer}',strip_tags($this->answer),$this->errors[$code]);
        $result = '<b>ERROR <a href="http://inwidget.ru/#error'.$code.'" target="_blank">#'.$code.'</a>:</b> '.$this->errors[$code];
        if($code == 401 OR $code == 402){
            file_put_contents($this->cacheFile,$result,LOCK_EX);
        }
        return $result;
    }



}
