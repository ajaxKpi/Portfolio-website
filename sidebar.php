<aside class ="main_sidebar">
    <h3 class="portfolio_me">me</h3>
    <div class ="about_me">
        <div class = "Avatar">
            <a href = "About">
                <img src="img/Ava.jpg" alt="ava">
            </a>
        </div>
        <?php if($_COOKIE['language']=="ru"){$about_lang="Привет! Меня зовут Оля, добро пожаловать на мой сайт! Если Вам близки мои работы, Вы можете связатся со мной любым удобным способом";

        }
        else{
            $about_lang="Hi and welcome! I'm Olya, wedding photographer. If you find my style close to you contact me please:)";
        }
        ;?>
        <p class="few_words"><?=$about_lang?><a href="About"><span>(read more)>></span></a></p>

    </div>

    <div class ="Tags">
        <hr class ="TagSeparator">
        <h2 class="portfolio_me">Categories</h2>
        <hr class ="TagSeparator">
        <ul>
            <li>
                <a href =Blog?tag=Wedding>Wedding</a>
            </li>
            <li>
                <a href =Blog?tag=Love>Love story</a>
            </li>
            <li>
                <a href =Blog?tag=Family>Family</a>
            </li>
            <li><a href =Blog?tag=Inspiration>Inspiration</a></li>
            <li><a href = Blog?tag=Portrait>Portrait</a></li>
        </ul>
    </div>
    <hr class ="InstSeparator">

    <div class ="sidebar_inst">
        <h2 class="portfolio_me"> Instagram</h2>
        <hr class ="Popular_StorySeparator">
        <ul class = "carusel">
        <?php
            include_once 'libraries/inwidget/IstaGet.php';
            $inWidget = new inWidget();
            $inWidget->apiQuery();
            //******** when some error occurs use cached values ********
            if (!$inWidget->HasErrors) {


            $LinkImage = $inWidget->data['images'];

            $inWidget->createCache();


            for ($key=0;  $key<sizeof($LinkImage); $key++)
            {?>


                <li class ="inst_item">
                    <a target="_blank" href ="<?=$LinkImage[$key]['link' ]?>">
                        <img  src="<?=$LinkImage[$key]['large' ]?>" alt = "instIm">
                    </a>
                </li>

            <?php
            }
            }
                else {

                $CachedVal = json_decode(file_get_contents($inWidget->cacheFile));
                $Ar_CachedVal = (array) $CachedVal;
                $Insta_ph= $Ar_CachedVal['images'];

                for ($key=0;  $key<sizeof($Insta_ph); $key++)
                {
                    $LinkImage= (array)$Insta_ph[$key]

                    ?>


                    <li class ="inst_item">
                        <a target="_blank" href ="<?=$LinkImage['link' ]?>">
                            <img  src="<?=$LinkImage['large' ]?>" alt = "instIm">
                        </a>
                    </li>

                <?php
                }




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
        require_once 'includes/data.php';
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
                    <a href=<?= "Article?id=" . $row['id']; ?>>

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
    </div>
</aside>



