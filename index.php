<?php
session_start();
if($_GET['id'] !='dev'&&!$_SESSION['dev']){
    header('Location: http://www.mywed.ru/photographer/volyanska/');
   // echo $_SESSION['dev'];
    exit;

    }
    elseif($_GET['id'] =='dev')
    {

        $_SESSION['dev']=1;

    }

 ?>
<!DOCTYPE html>
<html>
<head lang="en">

    <title>Volyanska Photography</title>

    <meta http-equiv=X-UA-Compatible content="IE=edge" />
    <meta name="description" content="Добрая западная свадебная фотография Оли Волянской | Киев, Украина, Европа">
    <meta name="viewport" content="width=1200, initial-scale=1">
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
                <a href="#">
                    <img src="img/logo_main.svg" alt="main_logo">

                </a>



        </div>

        <!-- Main(list of portfolio photo) -->
<div class="pjax-container">
        <section class="Main_content">
                <h1 class="portfolio_me">portfolio</h1>

               <?php

               require_once 'includes/data.php';
               $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);

            /* check connection */
            if ($mysqli->connect_errno) {
                echo( "Connect failed: %s\n");
                exit();
            }
            else{


                $res = $mysqli->query("SELECT * FROM  base order by date asc");

             
                for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                    $res->data_seek($row_no);
                    $row = $res->fetch_assoc();
                    if($row['tag']!='Advices'){


                    ?>

                    <div class="Preview_poligon">
                        <div class="Preview_photo">
                            <img class="lazy" data-original=<?= $row['preview']?> alt="logo_img">

                        </div>
                        <div class="Preview_info">
                            <a href=<?= "Article?id=" . $row['id']; ?>>
                                <?php echo $row['name']; ?>
                                <br>
                                <?php
                                    $Print_date =new dateTime($row['date']) ;
                                    echo  $Print_date-> format('j F Y');
                                ?>
                                <br>
                                <?php echo $row['tag']; ?>
                            </a>

                        </div>
                    </div>

                    <?php
                    }
	
                }


            }
            ?>

            <div class="Thanks"><svg><use xlink:href="#thankyou"></svg> </use></div>

        </section>
</div>
        <!-- sidebar Block -->
    <?php //include 'sidebar.php' ?>
        <!-- footer Block -->
    <?php include 'footer.php' ?>
        <script src="js/main.js"></script>


        </section>

</body>

</html>
