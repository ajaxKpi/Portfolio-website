<?php
if (!isset ($_SERVER["HTTP_X_PJAX"])){

?>
<!DOCTYPE html>
<html>
<head lang="en">

    <meta charset="UTF-8">
    <title>Volyanska Photography|Blog</title>
    <meta name="description" content="Добрая западная свадебная фотография Оли Волянской | Киев, Украина, Европа">
    <meta name="viewport" content="width=1200, initial-scale=1">
    <link id="bs-css" href='css/bootstrapMin.css' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/media.css">
   <link rel="icon" type="image/png" href="img/ov.png" />

    <meta charset="utf-8">
 <!-- pinterest hover -->
    <link href="css/imgPin.default.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>





<body>
<div class="loader-wrapper">
    <div class="typing-indicator">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>


<section class="Full_site_holder">


    <!-- Main+Sidebar+Footer Block 1000px -->
    <div class="Main_Side">
        <!-- Header Block -->
        <nav class="main_header">

            <?php include 'header.php' ?>

        </nav>

        <hr class="Fixed_line">
        <!-- Space for logo -->
        <div class="logo_big">
          <a href="/">
            <img src="img/logo_main.svg" alt="main_logo">

        </a>

        </div>

    <div class="pjax-container">
        <?php
        }
        ?>
        <section class= "Main_content">
            <h1 class="portfolio_me">blog</h1>
            <div class = "costil1"></div>
            <!-- extract all records in blog -->


            <?php

            //debug moment
            if (!isset($_GET['tag']))
                {$filter ="all";}
            else{
                $filter =$_GET['tag'];
            }

            if ($filter=="Love")
                     {$filter ="Love story";}
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

                $res = $mysqli->query("SELECT * FROM base order by date asc");

                for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                    $res->data_seek($row_no);
                    $row = $res->fetch_assoc();
                    $Print_date =new dateTime($row['date']) ;
                    $Print_date=   $Print_date-> format('j F Y');
                    if ($row['tag']== $filter or $filter=='all') {
                        $preview_arr = explode("/", $row['preview']);
                        $preview_arr[count($preview_arr)-1]="L_".$preview_arr[count($preview_arr)-1];
                        $preview_large = implode("/", $preview_arr);

                        $share_link  = "http://".$_SERVER['SERVER_NAME']."/Article?id=" . $row['id'];
                        $share_name =  "'".$row['name']. "'";
                        $share_img = "'".$row['preview']. "'";

                    ?>

                        <article class="Blog_post">
                        <div class = "header_of_motion">
                            <a name=<?="Article?id=" . $row['id']; ?>  href=<?php echo "Article?id=" . $row['id']; ?>>
                                <h2 class="Blog_name"> <?=$row['name'] ?> </h2></a>
                            <span> <?=$Print_date ?> | <a href = <?php echo "Blog?tag=" . $row['tag']; ?>><?=$row['tag'] ?></a></span>
                        </div>
                        <hr class="separator">

                        <p class ="text_overview">
                            <div class="Wrap_pre">
                             <?= $row['descr']?>
                            </div>
                            <div class="Wrap_pre_ru">
                                <?= $row['descr_ru']?>
                            </div>
                        </p>
                        <div class = "Blog_photo">
                            <a href =<?php echo "Article?id=" . $row['id']; ?>>
                                <img class="lazy" data-original=<?=$preview_large?> alt ="Blog_photo">

                            </a>
                        </div>

                        <!-- Social bar -->
                            <section class ="like_share">
                                <hr>

                                <div class="Share_container">
                                    <div class="read_more">
                                        <a  href =<?="Article?id=" . $row['id']; ?>  >
                                        <svg>
                                          <use xlink:href="#readmore"></use>
                                         </svg>
                                            </a>

                                    </div>
                                    <table>
                                        <tr>

                                            <td><p>Share on:</p></td>
                                            <td class = "vk-logo"  >

                                                <a href ="http://vk.com/share.php?url=<?=$share_link?>&title=<?=$share_name?>&description=<?=$share_desc?>&image=<?=$share_img?>"  target="_blank")>
                                                    <div class="Svg_holder">
                                                        <svg version="1.1"  class ="onshare"  xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px"
                                                             width="97.75px" height="97.75px" viewBox="0 0 97.75 97.75" style="enable-background:new 0 0 97.75 97.75;" xml:space="preserve"
                                                            >
                                                        <path id =<?=$row['id']; ?>  d="M48.875,0C21.883,0,0,21.882,0,48.875S21.883,97.75,48.875,97.75S97.75,75.868,97.75,48.875S75.867,0,48.875,0z
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

                                            <td class= "fb-logo">

                                                <a href="http://www.facebook.com/sharer.php?u=<?=$share_link?>"  target="_blank">
                                                    <!-- Created with Inkscape (http://www.inkscape.org/) -->
                                                    <div class="Svg_holder">
                                                        <svg version="1.1"   class ="onshare" xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px"
                                                             width="97.75px" height="97.75px" viewBox="0 0 97.75 97.75" style="enable-background:new 0 0 97.75 97.75;" xml:space="preserve"
                                                            >
                                                        <path id =<?="f".$row['id']; ?> d="M48.875,0C21.882,0,0,21.882,0,48.875S21.882,97.75,48.875,97.75S97.75,75.868,97.75,48.875S75.868,0,48.875,0z
                                                             M67.521,24.89l-6.76,0.003c-5.301,0-6.326,2.519-6.326,6.215v8.15h12.641L67.07,52.023H54.436v32.758H41.251V52.023H30.229V39.258
                                                            h11.022v-9.414c0-10.925,6.675-16.875,16.42-16.875l9.851,0.015V24.89L67.521,24.89z"/>
                                                    </svg>
                                                    </div>
                                                </a>

                                            </td>

                                        </tr>


                                    </table>




                                </div>
                                <hr>
                            </section>

                    </article>
                        <?php
                        }
                        //close if
                }     //close for
            }         // close else
            ?>
            <div class="Thanks"><svg><use xlink:href="#thankyou"></svg> </use></div>
        </section>


        <?php

        if (!isset ($_SERVER["HTTP_X_PJAX"])){
        ?>
     </div>
        <!-- sidebar Block -->
        <?php include 'sidebar.php' ?>
        <!-- footer Block -->
        <?php include 'footer.php' ?>
        <script src="js/jquery.imgPin.min.js"></script>
        <script src="js/jquery.lazyload.js"></script>
        <script src="js/social.js"></script>
        <script src="js/main.js"></script>
</section>

</body>
</html>

<?php
}
?>