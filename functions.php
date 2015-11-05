<?php
/**
 * Created by PhpStorm.
 * User: zvorskyi
 * Date: 16.10.2015
 * Time: 17:47
 */
function replace_userTags($subject){

    $basestr =$subject;

    $pattern = "*<#.{1,3}>*";
    $shift=0;
    while (preg_match($pattern, $subject , $matches, PREG_OFFSET_CAPTURE)==true)
    {
        preg_match($pattern, $subject , $matches, PREG_OFFSET_CAPTURE);
        $shift= $matches[0][1]+1;
        $val = $matches[0][0];
        $subject=substr($subject,$shift);

        //get link id -> description

        $linkId= substr($val,2,strlen ($val)-3);


        require_once 'includes/data.php';
        $Login ="root";
        $Passwd = "edifier1";
        $dbname ="mydb";
        $myServer = $_SERVER['SERVER_NAME'];
        $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
        $mysqli->set_charset("utf8");

        $query ="Select * from links where links.id ='".$linkId."'";
        $res = $mysqli->query($query);
        $row= $res->fetch_assoc();

        $result=$row['desc'];


        $replace_str = "<a href =".$result.">";
        $basestr = str_replace($val,$replace_str,$basestr);


    }
    $basestr = str_replace("<!#>","</a>",$basestr);

    echo $basestr;
}
?>