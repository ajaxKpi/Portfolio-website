<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Volyanska Photography|Article</title>
    <meta name="description" content="Добрая западная свадебная фотография Оли Волянской | Киев, Украина, Европа">
    <meta name="viewport" content="width=1200, initial-scale=1">


    <?php
    require_once 'functions.php';
    require_once 'includes/data.php';
    $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
    $mysqli->set_charset("utf8");
    /* check connection */
    if ($mysqli->connect_errno) {
        echo( "Connect failed: %s\n");
        exit();
    }
    else{


        $res = $mysqli->query("SELECT * FROM base Where id='".$_GET["id"]."'");

        for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
            $res->data_seek($row_no);
            $row = $res->fetch_assoc();
            $Print_date =new dateTime($row['date']) ;
            $Print_date=   $Print_date-> format('j F Y');

            $preview_arr = explode("/", $row['preview']);
            $preview_arr[count($preview_arr)-1]="L_".$preview_arr[count($preview_arr)-1];
            $share_img = implode("/", $preview_arr);

            $share_link  = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            $share_name =  $row['name'];
            $share_desc =  "'".substr($row['descr_ru'],1,100)."'";

        }
    }?>

    <meta property="og:url"           content="<?=$share_link?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?=$share_name?>" />
    <meta property="og:description"   content="<?=strip_tags(substr($share_desc,1,100))?>" />
    <meta property="og:image"         content="http://<?=$_SERVER[HTTP_HOST].'/'.$share_img?>" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />

    <!-- share buttons -->
    <link  id="bs-css"  href='css/bootstrapMin.css' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/social.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="icon" type="image/png" href="img/ov.png" />
    <meta charset="utf-8">
    <!-- pinterest hover -->
    <link href="css/imgPin.default.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <!-- VK.com reference -->
     <script src="http://vk.com/js/api/openapi.js"; type="text/javascript" charset="windows-1251"></script>
     <script type="text/javascript">
        VK.init({
            apiId: 5077240,
            onlyWidgets: true
        });
    </script>

  </head>
  <body>
  <!-- Preloader Block -->

  <div class = "loader-wrapper">
      <div class="typing-indicator">
          <span></span>
          <span></span>
          <span></span>
      </div>
  </div>

  <div id="fb-root"></div>
  <!-- VK.com init  -->



    <section class = "Full_site_holder">

    <div class = "Main_Side">

    <!-- header -->
<nav class ="main_header">

    <?php include 'header.php' ?>
</nav>
<hr class ="Fixed_line">
        <div class="logo_big">
            <a href="/">
                <img src="img/logo_main.svg" alt="main_logo">

            </a>

        </div>




<section class="Main_content">

    <h1 class="portfolio_me">blog</h1>
    <div class="wrapArticle">
    <div class = "header_of_motion">
        <h2 class="Blog_name"><?= $row['name']?></h2>
        <span><?=  $Print_date?>  | <a href = <?="Blog?tag=". $row['tag']?> ><?= $row['tag']?>
                              </a></span>
    </div>
    <hr class="separator">

    <p class ="text_overview">
    <div class="Wrap_pre">


            <?=$row['descr']?>


    </div>
        <div class="Wrap_pre_ru">
            <?= $row['descr_ru']?>
        </div>
    </p>
<?php
    $files = glob($row["folder"].'/*.{*}', GLOB_BRACE);


    foreach($files as $file) { ?>

         <div class = "Blog_photo">

             <img class="lazy" data-original="<?=$file?>" alt ="Blog_photo">
         </div>

    <?php
    }
?>
    <!-- Subcontactors -->
    <div class="subbcontract">
        <p>
            <?= $row['subcon']?>
        </p>

    </div>

    <!-- Social bar -->
    <section class ="like_share">
        <hr>

        <div class="Share_container">
            <div class="return_blog">
                <a href =<?="Blog#Article?id=".$row['id']?>>Return to Blog</a>

            </div>
            <table>
                <tr>

                    <td><p>Share on:</p></td>
                    <td class = "vk-logo"  >

                        <a href ="http://vk.com/share.php?url=<?=$share_link?>&title=<?=$share_name?>&description=<?=$share_desc?>&image=<?=$share_img?>"  target="_blank")>
                            <div class="Svg_holder">
                                <svg version="1.1" id="Capa_1" class ="onshare" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                     width="97.75px" height="97.75px" viewBox="0 0 97.75 97.75" style="enable-background:new 0 0 97.75 97.75;" xml:space="preserve"
                                    >
                                                        <path id ="v".<?=$row['id']; ?>  d="M48.875,0C21.883,0,0,21.882,0,48.875S21.883,97.75,48.875,97.75S97.75,75.868,97.75,48.875S75.867,0,48.875,0z
                                                             M73.667,54.161c2.278,2.225,4.688,4.319,6.733,6.774c0.906,1.086,1.76,2.209,2.41,3.472c0.928,1.801,0.09,3.776-1.522,3.883
                                                            l-10.013-0.002c-2.586,0.214-4.644-0.829-6.379-2.597c-1.385-1.409-2.67-2.914-4.004-4.371c-0.545-0.598-1.119-1.161-1.803-1.604
                                                            c-1.365-0.888-2.551-0.616-3.333,0.81c-0.797,1.451-0.979,3.059-1.055,4.674c-0.109,2.361-0.821,2.978-3.19,3.089
                                                            c-5.062,0.237-9.865-0.531-14.329-3.083c-3.938-2.251-6.986-5.428-9.642-9.025c-5.172-7.012-9.133-14.708-12.692-22.625
                                                            c-0.801-1.783-0.215-2.737,1.752-2.774c3.268-0.063,6.536-0.055,9.804-0.003c1.33,0.021,2.21,0.782,2.721,2.037
                                                            c1.766,4.345,3.931,8.479,6.644,12.313c0.723,1.021,1.461,2.039,2.512,2.76c1.16,0.796,2.044,0.533,2.591-0.762
                                                            c0.35-0.823,0.501-1.703,0.577-2.585c0.26-3.021,0.291-6.041-0.159-9.05c-0.28-1.883-1.339-3.099-3.216-3.455
                                                            c-0.956-0.181-0.816-0.535-0.351-1.081c0.807-0.944,1.563-1.528,3.074-1.528l11.313-0.002c1.783,0.35,2.183,1.15,2.425,2.946
                                                            l0.01,12.572c-0.021,0.695,0.349,2.755,1.597,3.21c1,0.33,1.66-0.472,2.258-1.105c2.713-2.879,4.646-6.277,6.377-9.794
                                                            c0.764-1.551,1.423-3.156,2.063-4.764c0.476-1.189,1.216-1.774,2.558-1.754l10.894,0.013c0.321,0,0.647,0.003,0.965,0.058
                                                            c1.836,0.314,2.339,1.104,1.771,2.895c-0.894,2.814-2.631,5.158-4.329,7.508c-1.82,2.516-3.761,4.944-5.563,7.471
                                                            C71.48,50.992,71.611,52.155,73.667,54.161z"/>
                                                    </svg>
                            </div>
                        </a>

                    </td>
                    <td id = "fb-logo">

                        <a href="http://www.facebook.com/sharer.php?u=<?=$share_link?>"  target="_blank">
                            <!-- Created with Inkscape (http://www.inkscape.org/) -->
                            <div class="Svg_holder">
                                <svg version="1.1" id="Capa_1" class ="onshare" xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px"
                                     width="97.75px" height="97.75px" viewBox="0 0 97.75 97.75" style="enable-background:new 0 0 97.75 97.75;" xml:space="preserve"
                                    >
                                                        <path id="f".<?=$row['id']?> d="M48.875,0C21.882,0,0,21.882,0,48.875S21.882,97.75,48.875,97.75S97.75,75.868,97.75,48.875S75.868,0,48.875,0z
                                                             M67.521,24.89l-6.76,0.003c-5.301,0-6.326,2.519-6.326,6.215v8.15h12.641L67.07,52.023H54.436v32.758H41.251V52.023H30.229V39.258
                                                            h11.022v-9.414c0-10.925,6.675-16.875,16.42-16.875l9.851,0.015V24.89L67.521,24.89z"/>
                                                    </svg>
                            </div>
                        </a>

                    </td>
                    <td id ="count_FB"></td>
                </tr>


            </table>




        </div>
        <hr>
    </section>

    <div class  ="comment_wrap">
              <div class="fb-comments" data-href="  <?=$share_link?>"
                   data-numposts="5" data-version="v2.3">

              </div>
       <!-- VK.com position-->
        <div id="vk_comments"></div>
             <script type="text/javascript">
                VK.Widgets.Comments('vk_comments');
            </script>
        </div>



        <div class="Thanks"><svg><use xlink:href="#thankyou"></svg> </use></div>

    </div>

</section>
<!-- sidebar -->
    <?php include 'sidebar.php' ?>

</div>

    <?php
    //increment to one more visit

    $mysqli2 = new mysqli($myServer, $Login,$Passwd , $dbname);
    $res = $mysqli2->query("SELECT visits FROM base Where id='".$_GET["id"]."'");

    $visits= $res->fetch_assoc();
    $visit =(int)$visits['visits'];

    $visit++;
    $mysqli->query("Update base Set visits ='" .$visit."' where id='".$_GET["id"]."'");
    ?>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: '1492697214384249',

            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true, // parse XFBML
            oauth: true // enables OAuth 2.0
        });
        // Additional initialization code here
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected'||response.status === 'not_authorized') {
                // logged in and connected user, someone you know
                $(".fb-comments ").css("display", "block")
                $("#vk_comments ").css("display", "none");
            }

            else {
                // no user session available, someone you dont know

                (function () {
                    VK.init({
                        apiId: 5077240,
                        onlyWidgets: true
                    });
                    // Check VK status
                    VK.Auth.getLoginStatus(function (response) {
                        if (response.session||response.status === 'not_authorized') {
                            // User authorized in Open API
                            $(".fb-comments ").css("display", "none")
                            $("#vk_comments ").css("display", "block")
                        }

                        else {
                            $(".fb-comments ").css("display", "block")
                            $("#vk_comments ").css("display", "none")
                        }
                    });

                }())

            }
        });
        // END additional initialization
    };
    // Load the SDK Asynchronously
    (function(d){
        var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        d.getElementsByTagName('head')[0].appendChild(js);
    }(document));

</script>

    <!-- footer -->
    <?php include 'footer.php' ?>


        <script src="js/jquery.imgPin.min.js"></script>
        <script src="js/jquery.lazyload.js"></script>
        <script src="http://connect.facebook.net/en_US/all.js"></script>
        <script src="js/main.js"></script>
</section>

</body>
</html>