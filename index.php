
<!DOCTYPE html>

<html>
<head lang="ru">

    <title>Volyanska Photography</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="icon" type="image/png" href="img/dummylogo.png" />
    <meta charset="utf-8">

</head>

<body>



<!-- Main+Sidebar+Footer Block Full windows size-->

<!-- Preloader Block -->
<body>
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
            <img src="img/dummylogo.png" alt ="Logo_big">
        </div>

        <!-- Main(list of portfolio photo) -->
        <section class="Main_content">

               <?php

               require_once 'data.php';
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
                            <img class="Preview_3" src= " <?= $row['preview']; ?> "alt="logo_img">
                        </div>
                        <div class="Preview_info">
                            <a href=<?= "SingleBlog.php?id=" . $row['id']; ?>>
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



        </section>

        <!-- sidebar Block -->
    <?php include 'sidebar.php' ?>
        <!-- footer Block -->
    <?php include 'footer.php' ?>


</section>

</body>
</html>
