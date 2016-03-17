<?php
if (!isset ($_SERVER["HTTP_X_PJAX"])){

?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/html">
    <head lang="en">
        <meta charset="UTF-8">
        <title>Volyanska Photography|Contacts</title>
        <meta name="description" content="Добрая западная свадебная фотография Оли Волянской | Киев, Украина, Европа">
        <meta name="viewport" content="width=1200, initial-scale=1">

        <link id="bs-css" href='css/bootstrapMin.css' rel='stylesheet' type='text/css'>
        <link id="bsdp-css" href="css/datepicker3.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="img/ov.png" />
        <meta charset="utf-8">
        <!-- share buttons -->


        <link rel="stylesheet" href="css/Calendar.css">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/media.css">
    </head>
    <body>
    <section class="Full_site_holder">


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
        <!-- Main(list of portfolio photo) -->

    <?php
}

?>
        <section class="Main_content">
            <h1 class="portfolio_me">contacts</h1>




            <p class="contactP">Если Вам близок мой стиль и Вы разделяете мои взгляды на свадебную фотографию - свяжитесь со мной удобным для Вас способом!<br>Буду рада знакомству и личной встрече! </p>

             <div class="left_col">
                 <div class="ContactInfo">
                   <b>e-mail:</b> olga.volyanska@gmail.com<br>
                     <b>tel:</b> +38 (097) 893 38 00<br>
                     <b>skype:</b> pollosata<br>
                     <a href="https://instagram.com/olgavolyanska">instagram</a> |
                     <a href="https://www.facebook.com/olga.volyanska">facebook</a> |
                     <a href="http://vk.com/olgavolyanska"> vkontakte</a>
                  </div>

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

           </div>




            <div class="form_space">

                    <form action="http://formspree.io/olga.volyanska@gmail.com" class="main_form" novalidate target="_blank" method="post">
                        <label class="form_group">

                            <input type="text" name="name" id="f_name" placeholder="ИМЯ" data-validation-required-message="Вы не ввели имя" required />
                            <span id ="s_name" class = "req_message">Вы не ввели имя</span>
                        </label>
                        <label class="form_group">


                            <input type="email"  name="email" placeholder="E-MAIL" id="f_mail" data-validation-required-message="Не корректно введен E-mail" required />
                            <span id =s_mail class = "req_message">Не корректно введен E-mail</span>
                        </label>


                        <label class="form_group">
                            <input type="text" name="city" placeholder="ГОРОД" id="f_city" data-validation-required-message="Вы не указали имя" required />
                            <span id =s_city class = "req_message">Вы не ввели город</span>
                        </label>
                        <label class="form_group">
                        <div class="d_picker" id="sandbox-container">
                            <div class="input-group date">

                                <input type="text" name ="date" id = "CheckedDate" class="form-control"placeholder="ДАТА СВАДЬБЫ"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

                            </div>
                            <span id =s_CheckedDate class = "req_message">Дата уже занята</span>
                        </div>
                        </label>

                        <label class="form_group">
                            <input type="text" name="social" placeholder="ССЫЛКА НА СОЦИАЛЬНУЮ СЕТЬ VK или FB" id="f_social" data-validation-required-message="Вы не указали имя" required />
                            <span id ="s_social" class = "req_message">Укажите профиль в соц. сетях</span>
                        </label>
                        <label class="form_group">

                            <textarea id ="f_textarea" name="message" placeholder="КРАТКИЙ ПЛАН СВАДЕБНОГО ДНЯ&#10;&#09;&#09;&#09;&#09;+ ссылки на место проведения" data-validation-required-message="Вы не ввели сообщение" required></textarea>
                            <span id ="s_descr" class = "req_message">Добавте описание свадьбы</span>
                        </label>




                        <button id="send_mail"><span>Давайте знакомится</span></button>
                    </form>


            </div>
                        <div class="Thanks"><svg><use xlink:href="#thankyou"></svg> </use></div>

        </section>
    <?php
        if (!isset ($_SERVER["HTTP_X_PJAX"])) {

    ?>
            </div>
    <!-- sidebar Block -->
        <?php include 'sidebar.php' ?>


</section>


<!-- footer Block -->
<?php include 'footer.php' ?>
</body>


<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src ='js/angular.min.js'></script>
<script src="js/moment.js"></script>
<script src="js/calendar.js"></script>
<script src="js/admin.js"></script>
<script src="js/main.js"></script>
</html>



<?php } ?>
