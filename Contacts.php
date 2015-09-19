<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Volyanska Photography|Contacts</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet" href="css/Calendar.css">
    <link rel="icon" type="image/png" href="img/dummylogo.png" />
    <meta charset="utf-8">
    <!-- share buttons -->
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet/less" type="text/css" href="css/main.less" />

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>

</head>
<body>
<section class = "Full_site_holder">
    <div class = "Main_Side">

        <!-- header -->
        <nav class ="main_header">
            <?php include 'header.php' ?>
        </nav>
        <hr class ="Fixed_line">


        <!-- calendar -->
        <div  class="calendar">
            <html ng-app="myApp" ng-controller="AppCtrl" lang="en">
            <head>

            </head>
            <body>

            <div calendar class="calendar" id="calendar"></div>
            </body>
            </html>

        </div>

        <div class ="contact_info">
            <h1>Ольга Волянская, свадебный фотограф.<br>
                Нахожусь в Киеве. Принимаю заказы по всему миру<br><br><br><br><br><br>
                По вопросам сотрудничества обращайтесь любым удобным для вас способом:</h1>

            <table id="info_table">
                <tr>
                    <td>Email : </td>
                    <td>xxx@xx.ua</td>
                </tr>
                <tr>
                    <td>Phone :</td>
                    <td> +(xxx) xxx-xx-xx</td>
                </tr>
                <tr>
                    <td>Skype :</td>
                    <td> my_login</td>
                </tr>

            </table>

        </div>


    </div>

    </div>


    <!-- footer Block -->
    <?php include 'footer.php' ?>
</section>
</body>
</html>



<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 9/19/15
 * Time: 5:12 PM
 */ 