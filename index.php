
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

<div class = "loader-wrapper">
    <div class="typing-indicator">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<section class = "Full_site_holder">




    <div class = "Main_Side">
        <nav class ="main_header">

            <?php include 'header.php' ?>

        </nav>
        <hr class ="Fixed_line">
        <div class="logo_big">
            <img src="img/dummylogo.png" alt ="Logo_big">
        </div>


        <section class="Main_content">

               <?php
            $mysqli = new mysqli("localhost", "root", "edifier", "mydb");

            /* check connection */
            if ($mysqli->connect_errno) {
                echo( "Connect failed: %s\n");
                exit();
            }
            else{


                $res = $mysqli->query("SELECT * FROM mydb.Base");

             
                for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                    $res->data_seek($row_no);
                    $row = $res->fetch_assoc(); ?>

                    <div class="Preview_poligon">
                        <div class="Preview_photo">
                            <img class="Preview_3" src= " <?php echo $row['preview']; ?> "alt="logo_img">
                        </div>
                        <div class="Preview_info">
                            <a href=<?php echo "SingleBlog.php?id=" . $row['id']; ?>>
                                <?php echo $row['name']; ?>
                                <br>
                                <?php echo $row['date']; ?>
                                <br>
                                <?php echo $row['tag']; ?>
                            </a>

                        </div>
                    </div>

                    <?php
	
                }


            }
            ?>



        </section>


    <?php include 'sidebar.php' ?>
    <?php include 'footer.php' ?>


</section>

</body>
</html>
