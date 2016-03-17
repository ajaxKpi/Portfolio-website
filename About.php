<?php
if (!isset ($_SERVER["HTTP_X_PJAX"])){
    ?>

<!DOCTYPE html>
<html>
<head lang="en">

    <title>Volyanska Photography|About</title>

    <meta http-equiv=X-UA-Compatible content="IE=edge" />
    <meta name="viewport" content="width=1200, initial-scale=1">
    <meta name="description" content="Добрая западная свадебная фотография Оли Волянской | Киев, Украина, Европа">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="icon" type="image/png" href="img/ov.png" />
    <meta charset="utf-8">

</head>

<body>



<!-- Main+Sidebar+Footer Block Full windows size-->

<!-- Preloader Block -->

<div class = "loader-wrapper">
    <div class="typing-indicator">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>



<section class = "Full_site_holder">



    <!-- Main+Sidebar+Footer Block 1000px -->
    <div class = "Main_Side">
        <!-- Header Block -->

        <nav class ="main_header">
            <?php include 'header.php' ?>
        </nav>

        <hr class ="Fixed_line">
        <!-- Space for logo -->
        <div class="logo_big">
             <a href="/">
            <img src="img/logo_main.svg" alt="main_logo">

        </a>

        </div>
 <div class="pjax-container">
       <?php }?>


        <!-- Main(list of portfolio photo) -->

        <section class="Main_content">


            <h3 class="portfolio_me">about me</h3>
            <div class="belive">
                <img src="img/belive.jpg" alt="belive"/>

                <?php
                if ($_COOKIE["language"]=="ru"){
                    include 'includes/about_ru.php';
                }
                else {
                    include 'includes/about_en.php';
                }
                ?>
            </div>

            <div class="Thanks"><svg><use xlink:href="#thankyou"></svg> </use></div>

        </section>


<?php  if (!isset ($_SERVER["HTTP_X_PJAX"])){
           ?>
</div>
                <!-- sidebar Block -->
                <?php include 'sidebar.php' ?>

            </div>


        </section>
        <!-- footer Block -->
        <?php include 'footer.php' ?>
    <script src="js/main.js"></script>
        </body>
        </html>
<?php  } ?>