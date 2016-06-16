<?php
header('Location: http://www.mywed.ru/photographer/volyanska/');
if (!isset ($_SERVER["HTTP_X_PJAX"])){
?>
<!DOCTYPE html>
<html>
<head lang="en">

    <meta charset="UTF-8">
    <title>Volyanska Photography|Feedbacks</title>
    <meta name="description" content="Добрая западная свадебная фотография Оли Волянской | Киев, Украина, Европа">
    <meta name="viewport" content="width=1200, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="icon" type="image/png" href="../img/ov.png" />
    <meta charset="utf-8">

</head>


<section class="Full_site_holder">
 <div class="pjax-container">
    <div class="Main_Side">

        <!-- header -->
        <nav class="main_header">

            <?php include 'header.php' ?>
        </nav>
        <hr class="Fixed_line">
        <div class="logo_big">
            <a href="/">
                <img src="../img/logo_main.svg" alt="main_logo">

            </a>

        </div>

        <?php
        }
        ?>
        <section class="Main_content">

            <h1 class="portfolio_me">feedbacks</h1>
        <?php

        require_once 'includes/data.php';
        $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
        $mysqli->set_charset("utf8");
        /* check connection */
        if ($mysqli->connect_errno) {
            echo( "Connect failed: %s\n");
            exit();
        }
        else{


            $res = $mysqli->query("SELECT * FROM feedback order by rank DESC");

            for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                $res->data_seek($row_no);
                $row = $res->fetch_assoc();
                $Print_date =new dateTime($row['date']) ;
                $Print_date=   $Print_date-> format('j F Y');


        ?>



            <div class="wrapArticle">
                <div class = "header_of_motion">
                    <h2 class="Blog_name"><?= $row['name']?></h2>
                <span><?=  $Print_date?></span>
                </div>
                <div class="collage">

                    <hr class="separator">
                    <img src="<?= $row['preview']?>"

                <p class ="text_overview">
                        <div class="Wrap_pre">
                            <?= $row['feedback']?>
                                        </div>
                        <div class="Wrap_pre_ru">
                            <?= $row['feedback_ru']?>
                        </div>
                    </p>
                </div>
             </div>
                <?php }}?>
                <div class="Thanks"><svg>
                    <use xlink:href="#thankyou"></use>
                </svg></div>

            </section>


        <?php
        if (!isset ($_SERVER["HTTP_X_PJAX"])) {
            ?>
            <?php include 'sidebar.php' ?>
            </div>

            </div>
            <!-- footer Block -->
            <?php include 'footer.php' ?>
            <script src="../js/main.js"></script>
            </div>
            <!-- sidebar Block -->

            </section>
            </html>
            <?php
        }
                ?>