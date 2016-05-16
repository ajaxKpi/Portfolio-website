<?php
if (!isset ($_SERVER["HTTP_X_PJAX"])) {

?>
<!DOCTYPE html>
<html>
<head lang="en">

    <meta charset="UTF-8">
    <title>Volyanska Photography|Services</title>
    <meta name="description" content="Добрая западная свадебная фотография Оли Волянской | Киев, Украина, Европа">
    <meta name="viewport" content="width=1200, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="icon" type="image/png" href="img/ov.png" />
    <meta charset="utf-8">

</head>


<section class="Full_site_holder">

    <div class="Main_Side">

        <!-- header -->
        <nav class="main_header">

            <?php include 'header.php' ?>
        </nav>
        <hr class="Fixed_line">
        <div class="logo_big">
            <a href="/">
                <img src="img/logo_main.svg" alt="main_logo">

            </a>

        </div>
 <div class="pjax-container">

        <?php
        }

        ?>

        <section class="Main_content">

            <h1 class="portfolio_me">services</h1>
            <div class="All_serv">
                <?php
                if ($_COOKIE["language"]=="ru"){
                include 'includes/services_ru.php';
                }
                else {
                    include 'includes/services_en.html';
                }
                ?>
            </div>


            <div class="Thanks"><svg>
                    <use xlink:href="#thankyou"></use>
                </svg></div>
        </section>

        <?php
        if (!isset ($_SERVER["HTTP_X_PJAX"])) {

            ?>
</div>
            <?php include 'sidebar.php' ?>
            </div>
            </section>
        <?php include 'footer.php' ?>
            <script src="js/main.js"></script>
            </html>

            <?php
        }

                ?>