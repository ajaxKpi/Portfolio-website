<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Volyanska Photography|Blog</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/social.css">
    <link rel="icon" type="image/png" href="img/dummylogo.png" />
    <meta charset="utf-8">
    <!-- pinterest hover -->
    <link href="css/imgPin.default.css" rel="stylesheet">
    <!-- share buttons -->
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- VK.com reference -->
    <!--  <script src="http://vk.com/js/api/openapi.js"; type="text/javascript" charset="windows-1251"></script>-->


  </head>
  <body>
  <div id="fb-root"></div>
  <!-- VK.com init
    <script type="text/javascript">
    VK.init({
        apiId: 5077240,
        onlyWidgets: true
    });
    </script>
    -->

    <section class = "Full_site_holder">

    <div class = "Main_Side">
    <!-- header -->
<nav class ="main_header">

    <?php include 'header.php' ?>
</nav>
<hr class ="Fixed_line">
<div class="logo_big">
    <a href ="index.php">
        <img src="img/dummylogo.png" alt ="Logo_big">
    </a>
</div>

<?php
$mysqli = new mysqli("localhost", "root", "", "mydb");
$mysqli->set_charset("utf8");
/* check connection */
if ($mysqli->connect_errno) {
    echo( "Connect failed: %s\n");
    exit();
}
else{


$res = $mysqli->query("SELECT * FROM mydb.Base Where id='".$_GET["id"]."'");

for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
$res->data_seek($row_no);
$row = $res->fetch_assoc();
$Print_date =new dateTime($row['date']) ;
    $Print_date=   $Print_date-> format('j F Y');
}
}?>


<section class="Main_content">
    <div class = "header_of_motion">
        <h1 class="Blog_name"><?= $row['name']?></h1>
        <span><?=  $Print_date?>  | <a href = <?="FullBlog.php?tag=". $row['tag']?> ><?= $row['tag']?>
                              </a></span>
    </div>
    <hr>
    <br>
    <br>
    <p class ="text_overview">
        <?= $row['descr']?>
    </p>
<?php
    $files = glob($row["folder"].'/*.{*}', GLOB_BRACE);


    foreach($files as $file) { ?>

         <div class = "Blog_photo">
            <img src="<?=$file?>" alt ="Blog_photo">
         </div>

    <?php
    }
?>


    <!-- Social bar -->
    <section class ="like_share">
        <hr>
        <!-- MODIFY WHEN READY check on home browser
        <div class="Share_container">
        <div class="btn-group">
        <button class="btn btn-default btn-lg disabled">Share:</button>
        <a class="btn btn-default btn-lg" target="_blank" title="On Facebook" href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Olgavolyanska.com/&amp;t=Social%20Buttons%20in%20HTML%20only%20using%20Twitter%20Bootstrap%203%20and%20Font%20Awesome%20Icons">
        <i class="fa fa-facebook fa-lg fb"></i>
        </a>
        <a class="btn btn-default btn-lg" target="_blank" title="On VK.com" href="http://vk.com/share.php?url=http%3A%2F%2Fostr.io/code/html-social-like-share-buttons-no-javascript.html&amp;title=Social%20Buttons%20in%20HTML%20only&amp;description=Social%20Buttons%20in%20HTML%20only%20using%20Twitter%20Bootstrap%203%20and%20Font%20Awesome%20Icons&amp;image=http%3A%2F%2Fostr.io/img/icon_500x500.png">
        <i class="fa fa-vk fa-lg vk"></i>
        </a>
        </div>
        </div>
        -->

        <div class="Share_container">

            <div class="read_more">
                <a href ="FullBlog.php">Read more...</a>

            </div>
            <table>
                <tr>

                    <td>Share on:</td>
                    <td id = "vk-logo" >

                        <a onclick="Share.vkontakte('volyanska.com','Share on VK','img/vk32.png','DESC')">
                            <div class="Svg_holder">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    id="svg3336"
                                    version="1.1"
                                    viewBox="0 0 31.990629 18.047907"
                                    >
                                    <path
                                        d="M 9.0085573,15.297741 C 6.2023989,12.936514 0.02397387,3.601105 1.2873377e-5,1.6861094 -0.00518713,1.2736095 1.5656293,0.93610935 3.4906293,0.93610935 c 1.925,0 3.5016821,0.33750015 3.5037381,0.75000005 0.00206,0.4125 0.9633284,2.3241306 2.1361611,4.2480686 2.0700885,3.395813 2.1568415,3.432061 2.9677235,1.240037 0.47656,-1.288264 0.418873,-3.353318 -0.134319,-4.8083236 -0.942421,-2.47875605 -0.864482,-2.54159005 2.778539,-2.24003705 3.639946,0.301298 3.763115,0.440174 4.266209,4.81025465 l 0.518051,4.5 2.22821,-3.5 c 1.225516,-1.925 2.229893,-3.8374996 2.231949,-4.2499996 0.0021,-0.4124999 1.803738,-0.75000005 4.003738,-0.75000005 2.2,0 4,0.31331215 4,0.69625005 0,0.382937 -1.176627,2.3941216 -2.614726,4.4692996 l -2.614726,3.77305 2.614726,3.107425 c 3.503631,4.163829 3.307404,4.953975 -1.230286,4.953975 -2.575021,0 -4.44284,-0.660592 -5.654988,-2 -0.995486,-1.1 -2.19023,-2 -2.654987,-2 -0.464756,0 -0.845012,0.9 -0.845012,2 0,3.093835 -6.002827,2.709945 -9.9820727,-0.638368 z"
                                        id="path3346"/>
                                </svg>
                            </div>
                        </a>
                    <td id ="count_VK">2</td>
                    </td>
                    <td id = "fb-logo">

                        <a onclick="Share.facebook('volyanska.com','Share on Facebook','img/fb32.png','DESC')">
                            <!-- Created with Inkscape (http://www.inkscape.org/) -->
                            <div class="Svg_holder">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    id="svg3336"
                                    version="1.1"
                                    width="52.71801"
                                    height="95.617783"
                                    viewBox="0 0 52.71801 95.617783">
                                    <path
                                        d="m 14.071046,74.826439 c 0,-19.277352 -0.491526,-20.861154 -6.7499998,-21.75 C -2.2234478,51.720904 -2.5322368,34.560427 6.9634942,33.205987 11.844485,32.50978 13.801592,29.507249 15.240743,20.507293 17.516171,6.2775383 27.230222,-1.2177803 41.608724,0.16187484 c 8.278305,0.7943251 10.119255,2.31388596 10.890699,8.98943126 0.791286,6.8472219 -0.316227,8.1762389 -7.5,8.9999999 -6.086232,0.697907 -8.694774,2.842224 -9.38703,7.71648 -0.780762,5.497443 0.471795,6.75 6.75,6.75 6.809889,0 7.708653,1.22421 7.708653,10.5 0,9.200001 -0.928572,10.5 -7.5,10.5 -7.285713,0 -7.5,0.6 -7.5,21 l 0,21 -10.5,0 -10.5,0 0,-20.791347 z"
                                        id="path3386"
                                        />
                                </svg>
                            </div>
                        </a>

                    </td>
                    <td id ="count_FB">2</td>
                </tr>


            </table>




        </div>
        <hr>
    </section>

    <div class  ="comment_wrap">
              <div class="fb-comments" data-href="http://volyanska.com" data-numposts="5" data-version="v2.3"></div>
       <!-- VK.com position
        <div id="vk_comments"></div>
             <script type="text/javascript">
                VK.Widgets.Comments('vk_comments');
            </script>
        </div>
    -->





</section>
<!-- sidebar -->
    <?php include 'sidebar.php' ?>

</div>

    <?php
    //increment to one more visit
    $mysqli2 = new mysqli("localhost", "root", "", "mydb");
    $res = $mysqli2->query("SELECT visits FROM mydb.Base Where id='".$_GET["id"]."'");

    ?>

    <?php


    $visits= $res->fetch_assoc();
    $visit =(int)$visits['visits'];

    $visit++;
    $mysqli->query("Update mydb.Base Set visits ='" .$visit."' where id='".$_GET["id"]."'");
    ?>




    <!-- footer -->
    <?php include 'footer.php' ?>


</section>

</body>
</html>