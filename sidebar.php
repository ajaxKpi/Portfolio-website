<aside class ="main_sidebar">
    <h1 class="portfolio_me">me</h1>
    <div class ="about_me">
        <div class = "Avatar">
            <a href = "About.php">
                <img src="img/Ava.jpg">
            </a>
        </div>


        <p>Привет!
            Я занимаюсь фото с раннего возраста это мое вдохновение...<a href="About.php"><span>(read more)>></span></a></p>

    </div>

    <div class ="Tags">
        <hr class ="TagSeparator">
        <h2 class="portfolio_me">Categories</h2>
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
        <h2 class="portfolio_me"> Instagram</h2>
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
        <h2 class="portfolio_me">Popular Stories</h2>
        <hr class ="Popular_StorySeparator">

        <div class = "Popular_Story_img">

        <?php
        require_once 'data.php';
        $mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);

        /* check connection */
        if ($mysqli->connect_errno) {
            echo( "Connect failed: %s\n");
            exit();
        }
        else{


        $res = $mysqli->query("Select * from base t2 WHERE t2.id in (SELECT * from(SELECT t1.id FROM base t1 order by t1.visits desc LIMIT 4) as t3) Order by t2.visits asc");


        for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
        $res->data_seek($row_no);
        $row = $res->fetch_assoc();
            $preview_arr = explode("/", $row['preview']);
            $preview_arr[count($preview_arr)-1]="S_".$preview_arr[count($preview_arr)-1];
            $preview_small = implode("/", $preview_arr);
            ?>

            <div class="sidebar_photo">
                <img class="Preview_2" src=" <?=$preview_small; ?> " alt="logo_img">
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
        </div>

</aside>
