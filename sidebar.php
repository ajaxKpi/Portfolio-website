<aside class ="main_sidebar">
    <div class ="about_me">
        <div class = "Avatar">
            <a href = "About.php">
                <img src="img/Ava.jpg">
            </a>
        </div>
        <hr>
        <h2> About me</h2>
        <hr>

        <p>Привет!<br><br>
            Я занимаюсь фото с раннего возраста это мое вдохновение...<a href="About.php"><span>(read more)>></span></a></p>

    </div>

    <div class ="Tags">
        <hr class ="TagSeparator">
        <h2><i>Categories</i></h2>
        <hr class ="TagSeparator">
        <ul>
            <li>
                <a href =FullBlog.php?tag=Wedding>Wedding</a>
            </li>
            <li>
                <a href =FullBlog.php?tag=Love>Love story</a>
            </li>
            <li>
                <a href =FullBlog.php?tag=Family>Family</a>
            </li>
            <li><a href =FullBlog.php?tag=Inspiration>Inspiration</a></li>
            <li><a href = FullBlog.php?tag=Portrait>Portrait</a></li>
        </ul>
    </div>
    <hr class ="InstSeparator">

    <div class ="sidebar_inst">
        <h2> Olga's Instagram</h2>
        <hr class ="Popular_StorySeparator">
        <ul class = "carusel">
        <?php
            require_once 'libraries/inwidget/IstaGet.php';

            $inWidget = new inWidget();
            $inWidget->apiQuery();
            $LinkImage = $inWidget->data['images'];
            for ($key=0;  $key<sizeof($LinkImage); $key++)
            {?>


                <li class ="inst_item">
                    <a target="_blank" href ="<?=$LinkImage[$key]['link' ]?>">
                        <img  src="<?=$LinkImage[$key]['large' ]?>">
                    </a>
                </li>

            <?php
            }
            ?>





        </ul>

    </div>

    <div class ="Popular_Story">
        <hr class ="Popular_StorySeparator">
        <h2>Popular Stories</h2>
        <hr class ="Popular_StorySeparator">


        <?php
        $mysqli = new mysqli("localhost", "root", "edifier", "mydb");

        /* check connection */
        if ($mysqli->connect_errno) {
            echo( "Connect failed: %s\n");
            exit();
        }
        else{


        $res = $mysqli->query("SELECT * FROM mydb.Base order by visits asc LIMIT 4");


        for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
        $res->data_seek($row_no);
        $row = $res->fetch_assoc(); ?>

        <div class="sidebar_photo">
            <img class="Preview_2" src=" <?=$row['preview']; ?> " alt="logo_img">
            <div class="Popular_info">
                <a href=<?= "SingleBlog.php?id=" . $row['id']; ?>>

                    <br>
                    <?=$row['name']; ?>
                    <br>

                </a>

            </div>
        </div>

        <?php
                }
            }
        ?>


</aside>
