<?php

/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 27.04.16
 * Time: 23:34
 */
include_once "protected/CONFIG.php";
class api
{
    protected $POR_host=SERVER;
    protected $POR_user=LOGIN;
    protected $POR_pswd=PASSWORD;
    protected $POR_datab=DBNAME;

    public static function create_session(){
        //                                           language check
        session_start();
        if (!isset( $_COOKIE['language'])){
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if ($lang=='ru'||$lang=='ua'||$lang=='by'){
                $_COOKIE['language']='ru';

            }
            else{
                setcookie ('language','en');
            }
        }
    }

    /*
     * Method to connect to MySQL DB
     */
    public function connect_DB(){
        $host = $this->POR_host; // хост
        $user = $this->POR_user; // имя пользователя БД
        $pswd = $this->POR_pswd; // пароль
        $database = $this->POR_datab; // имя БД

        $mysqli = new mysqli($host, $user, $pswd, $database); // подключение к БД
        $query = 'set names utf8'; // установить кодировку utf8

        $mysqli->query($query); // Выполнить запрос
        if (mysqli_connect_errno()) {
            return ("error");
        }
        return $mysqli;
    }

    /*
 * Method to get ALL stories from the DB
 */
    public function get_ALL()
    {
        /* make connection */

        $mysqli = self::connect_DB();
        $res = $mysqli->query("SELECT * FROM  base order by date asc");
        $stories=[];

        for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
            $res->data_seek($row_no);

            $row = $res->fetch_assoc();
            array_push($stories,$row);
        }
        return  (json_encode($stories,JSON_FORCE_OBJECT));
    }



    /*
 * Method to get 4 popular stories for sidebar
 */
    public  function get_popular() {


        /* check connection */

        $mysqli = self::connect_DB();

        $res = $mysqli->query("Select t2.name, t2.preview from base t2 WHERE t2.id in (SELECT * from(SELECT t1.id FROM base t1 order by t1.visits desc LIMIT 4) as t3) Order by t2.visits asc");
        //array
        $pop_story=[];

        for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
            $res->data_seek($row_no);

            $row = $res->fetch_assoc();
            $preview_arr = explode("/", $row['preview']);
            $preview_arr[count($preview_arr)-1]="S_".$preview_arr[count($preview_arr)-1];
            $preview_small = implode("/", $preview_arr);
            $row['preview']=   $preview_small;

            array_push($pop_story,$row);
        }
        return  (json_encode($pop_story,JSON_FORCE_OBJECT));

    }

    /*
     * Method to increment visit count of page
     *
     */
    public  function visit_page($recordId){
        $mysqli = self::connect_DB();
        $mysqli->query("update base set visits =visits +1 where id =".$recordId);

    }



    public static function get_instagram()
    {



            include_once 'inwidget/IstaGet.php';

            $inWidget = new inWidget();
            $inWidget->apiQuery();
            //******** when some error occurs use cached values ********
            if (!$inWidget->HasErrors) {

                $LinkImage = $inWidget->data['images'];
                $inWidget->createCache();
                $Instr =  json_encode($LinkImage,JSON_FORCE_OBJECT);


            }
            else {

                $Instr = json_encode(file_get_contents($inWidget->cacheFile));
                     }


        return ($Instr);
    }






}
//header('Content-Type: application/json');
if (isset($_GET['action'])){
    switch ($_GET['action']){

        case 'get_instagram':

            echo api::get_instagram();
            break;
        case 'create_session':
            api::create_session();
            break;
        case 'get_popular':
            $api = new api();
            echo $api->get_popular()  ;
            break;
        case 'get_ALL':
            $api = new api();
            echo $api->get_ALL();
            break;
        case 'visit_page':
            $api = new api();
            //TODO extract ID from hash
            $id =1;
            $api->visit_page($id);
            break;

        default:
            echo 'wrong';
        }

}
else{
    echo 'wrong';
}