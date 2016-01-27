/**
 * Created by zvorskyi on 12.08.2015.
 */
/**************************
                *  CONSTANTS    *
 *                          *****************************/
            //Sidebar
aboutme_ru = "Привет! Меня зовут Оля, добро пожаловать на мой сайт! Если Вам близки мои работы, Вы можете связатся со мной любым удобным способом";
aboutme_en = "Hi and welcome! I'm Olya, wedding photographer. If you find my style close to you contact me please:)";
            //Contacts


function setLang(page_language){
    if (page_language == "ru"){
        $(".Wrap_pre_ru").css("display","block")
        $(".Wrap_pre").css("display","none")

    }
    else{
        $(".Wrap_pre").css("display","block")
        $(".Wrap_pre_ru").css("display","none")
    }

}


if($.cookie("language")=="ru"){
   $("#language").prop('checked', true);
    page_version = "ru";
    contacts_text = 'Если Вам близок мой стиль и Вы разделяете мои взгляды на свадебную фотографию - свяжитесь со мной удобным для Вас способом!<br>Буду рада знакомству и личной встрече!';
    contacts_ph_name = "ИМЯ";
    contacts_ph_city = "ГОРОД";
    contacts_ph_date = "ДАТА СВАДЬБЫ";
    contacts_ph_link = "ССЫЛКА НА СОЦИАЛЬНУЮ СЕТЬ";
    contacts_ph_descr = "КРАТКИЙ ПЛАН СВАДЕБНОГО ДНЯ               +ссылки на место проведения";
    contacts_button = "Давайте знакомится"

    errors_name = "Вы не ввели имя";
    errors_email = "Не корректно введен E-mail"
    errors_city = "Вы не ввели город";
    errors_date = "Дата уже занята";
    errors_link = "Укажите профиль в соц. сетях";
    errors_descr = "Добавте описание свадьбы";


    Not_found_text = "Страница не найдена"
    Not_found_link = "Вернуться на главную"

}
else
{
    $("#language").prop('checked', false);
    page_version = "en";
    contacts_text ="If you are close to my style and you share my views on wedding photography - contact me convenient for you! <br>I will be glad to acquaintance and a personal meeting!";
    contacts_ph_name = "NAME";
    contacts_ph_city = "CITY";
    contacts_ph_date = "BOOKING DATE";
    contacts_ph_link = "LINK TO SOCIAL ACCOUNT";
    contacts_ph_descr = "SHORT DESCRIPTION OF WEDDING DAY";
    contacts_button = "SEND";

    errors_name = "Name required";
    errors_email = "Improper  E-mail"
    errors_city = "City Required";
    errors_date = "Date reserved already";
    errors_link = "Social account link required";
    errors_descr = "Wedding description required";

    Not_found_text = "Page not found"
    Not_found_link = "Return to portfolio"

}

$('#language').change(function() {
    if ($(this).is(":checked")) {
        $.cookie("language","ru")
        page_version = "ru"

        $(".few_words").text("Привет! Меня зовут Оля, добро пожаловать на мой сайт! Если Вам близки мои работы, Вы можете связатся со мной любым удобным способом")

        contacts_text = "Если Вам близок мой стиль и Вы разделяете мои взгляды на свадебную фотографию - свяжитесь со мной удобным для Вас способом!<br>Буду рада знакомству и личной встрече!";
        contacts_ph_name = "ИМЯ";
        contacts_ph_city = "ГОРОД";
        contacts_ph_date = "ДАТА СВАДЬБЫ";
        contacts_ph_link = "ССЫЛКА НА СОЦИАЛЬНУЮ СЕТЬ";
        contacts_ph_descr = "КРАТКИЙ ПЛАН СВАДЕБНОГО ДНЯ              +ссылки на место проведения";
        contacts_button = "Давайте знакомится"

        Not_found_text = "Страница не найдена"
        Not_found_link = "Вернуться на главную"


           }
    else{
        $.cookie("language","en")
        page_version = "en"
        $(".few_words").text("Hi and welcome! I'm Olya, wedding photographer. If you find my style close to you contact me please:)")

        contacts_text ="If you are close to my style and you share my views on wedding photography - contact me convenient for you! <br>I will be glad to acquaintance and a personal meeting!";
        contacts_ph_name = "NAME";
        contacts_ph_city = "CITY";
        contacts_ph_date = "BOOKING DATE";
        contacts_ph_link = "LINK TO SOCIAL ACCOUNT";
        contacts_ph_descr = "SHORT DESCRIPTION OF WEDDING DAY";
        contacts_button = "SEND";
        Not_found_text = "Page not found"
        Not_found_link = "Return to portfolio"
           }

    switch($(document).find("title").text())
    {



        case 'Volyanska Photography|About':
            location.reload()
            break;


        case 'Volyanska Photography|Services':
            location.reload()
            break;

        case 'Volyanska Photography|Contacts':
            $('.contactP').html(contacts_text);
            $("#f_name").attr("placeholder",contacts_ph_name );
            $("#f_city").attr("placeholder",contacts_ph_city );
            $("#CheckedDate").attr("placeholder",contacts_ph_date );
            $("#f_social").attr("placeholder",contacts_ph_link );
            $("#f_textarea").attr("placeholder",contacts_ph_descr );
            $("#send_mail span").text(contacts_button );


            $("#s_name").text(errors_name);
            $("#s_city").text(errors_city);
            $("#s_CheckedDate").text(errors_date);
            $("#s_social").text(errors_city);
            $("#s_descr").text(errors_descr);
            $("#s_mail").text(errors_email);


            break;
        case 'Volyanska Photography|Feedbacks':
            setLang(page_version);
            break;
        case 'Volyanska Photography|Blog':
            setLang(page_version);

            break;
        case 'Volyanska Photography|Article':
            setLang(page_version);
            break;
        case 'Volyanska Photography|Advices':
            setLang(page_version);
            break;
        case 'Volyanska Photography|Not Found':
            $(".not_found h4").text(Not_found_text);
            $("#bold_link a").text(Not_found_link);
            break;

    }




})


//preloader block
$(window).load(function() {


    $(".typing-indicator").delay(400).fadeOut("slow");
    $(".loader-wrapper").delay(400).fadeOut("slow");
});

//scroll of fixed header

$(window).scroll(function(){
    aa = $(window).innerWidth();
    if ($(window).innerWidth() < 960){
        $('.navigation').css('left',-$(window).scrollLeft());
    }
    else{
        $('.navigation').css('left', "");
    }
});

//instagram slider block
var currentIndex = 0,items = $('.inst_item'),
    itemAmt = items.length, prevIndex =0;

var autoSlide = setInterval(function() {
    currentIndex += 1;
    if (currentIndex > itemAmt - 1) {
        currentIndex = 0;
            prevIndex=itemAmt-1;
    }

   // $(items[prevIndex]).css("opacity", "0")
   // $(items[currentIndex]).css("opacity", "1")
      $(items[currentIndex]).fadeIn("3000");
      $(items[prevIndex]).fadeOut("3000");
             prevIndex = currentIndex;
}, 4000);


//call pin button on specific location
if ($(document).find("title").text() ==='Volyanska Photography|Blog'){


}

var logo_width = $(".logo_small").width();


Share = {
    vkontakte: function(purl, ptitle, pimg, text) {
        url  = 'http://vkontakte.ru/share.php?';
        url += 'url='          + encodeURIComponent(purl);
        url += '&title='       + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&image='       + encodeURIComponent(pimg);
        url += '&noparse=true';
        Share.popup(url);
    },

    facebook: function(purl, ptitle, pimg, text) {
        url  = 'http://www.facebook.com/sharer.php?s=100';
        url += '&p[title]='     + encodeURIComponent(ptitle);
        url += '&p[summary]='   + encodeURIComponent(text);
        url += '&p[url]='       + encodeURIComponent(purl);
        url += '&p[images][0]=' + encodeURIComponent(pimg);
        Share.popup(url);
    },

    popup: function(url) {
        window.open(url,'','toolbar=0,status=0,width=626,height=436');
    }
};

// paste fb comment bar for custom language
var userLang = navigator.language || navigator.userLanguage;
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.4";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



// get move of block in calculation of logo size




var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};


//use specific layout on single blog




//get active page

        switch($(document).find("title").text())
        {

            case 'Volyanska Photography|Blog':
               $('#Blog').css("color", "brown");
                $(function() {
                    $("img.lazy").lazyload();
                    setLang(page_version);
                });
                // color Advice if tag is
                var tag = getUrlParameter('tag');
                if (tag  === "Advices") {
                    $('#Blog').css("color", "black");
                    $('#Advices').css("color", "brown");

                }
                break;
            case 'Volyanska Photography|Article':
                $('#Blog').css("color", "brown");
                $(".Blog_name").hover(function() {
                    $(this).css("color","black");
                });
                setLang(page_version);
                $(function() {
                    $("img.lazy").lazyload();
                });
                break;
            case 'Volyanska Photography|About':
                $('#About').css("color", "brown");
                break;
            case 'Volyanska Photography|Advices':
                $('#Advices').css("color", "brown");
                setLang(page_version);
                break;
            case 'Volyanska Photography|Services':
                $('#Services').css("color", "brown");
                break;
            case 'Volyanska Photography|Contacts':
                $('#Contacts').css("color", "brown");
                $('.contactP').html(contacts_text);
                $("#f_name").attr("placeholder",contacts_ph_name );
                $("#f_city").attr("placeholder",contacts_ph_city );
                $("#CheckedDate").attr("placeholder",contacts_ph_date );
                $("#f_social").attr("placeholder",contacts_ph_link );
                $("#f_textarea").attr("placeholder",contacts_ph_descr );
                $("#send_mail span").text(contacts_button );


                $("#s_name").text(errors_name);
                $("#s_city").text(errors_city);
                $("#s_CheckedDate").text(errors_date);
                $("#s_social").text(errors_city);
                $("#s_descr").text(errors_descr);
                $("#s_mail").text(errors_email);

                break;
            case 'Volyanska Photography|Feedbacks':
                $('#Feedbacks').css("color", "brown");
                $(".Blog_name").hover(function() {
                    $(this).css("color","black");
                });
                setLang(page_version);
                break;
            case 'Volyanska Photography|Not Found':
                $(".not_found h4").text(Not_found_text);
                $("#bold_link a").text(Not_found_link);
                break;
            default:
                $('#Portfolio').css("color", "brown");
        }



//set text in like_share bar
if($('div').hasClass('comment_wrap') && $('div').hasClass('read_more')) {

    $(".read_more>a").attr('href', 'Blog');
    $('.Blog_photo img').imgPin(
        {
            pinImg : 'img/social/pinterestOnImg.png', position: 2
        }
    );


    $(".Blog_name").hover(function() {
        $(this).css("color","black");
    });
}

//convert color on click
$(".onshare").click(function() {
    Pathid = "#" + event.target.id;
    $(Pathid).css("fill", "black");
})
    //$( "#vk-logo").css("background-color","silver")
    //$( "#count_VK").css("background-color","silver")
    //$( "#count_VK ").css("color","white")


     //  $( "#count_VK").text( Number($( "#count_VK").text()) +1)



jQuery(document).ready(function($) {


    if ($(document).find("title").text() === 'Volyanska Photography|Article') {

        var fb_login = false;
        var vk_login = false;

// show command bar of fb or VK



           /* window.fbAsyncInit = function () {
                FB.init({
                    appId: '1492697214384249',
                    channelURL: 'http://ajaxkpi.site40.net/', // Channel File
                    status: true, // check login status
                    cookie: true, // enable cookies to allow the server to access the session
                    xfbml: true, // parse XFBML
                    oauth: true // enables OAuth 2.0
                });
                // Additional initialization code here
                FB.getLoginStatus(function (response) {
                    if (response.status === 'connected') {
                        // logged in and connected user, someone you know
                        fb_login = true;
                        $(".fb-comments ").css("display", "block")
                        $("#vk_comments ").css("display", "none")
                    }
                    else if (response.status === 'not_authorized') {
                        fb_login = true;
                        $(".fb-comments ").css("display", "block")
                        $("#vk_comments ").css("display", "none")

                    }
                    else {
                        // no user session available, someone you dont know

                        //initialization of VK

                        fb_login = false;
                        (function () {
                            VK.init({
                                apiId: 5077240,
                                onlyWidgets: true
                            });
                                // Check VK status
                            VK.Auth.getLoginStatus(function (response) {
                                if (response.session) {
                                    // User authorized in Open API
                                    $(".fb-comments ").css("display", "none")
                                    $("#vk_comments ").css("display", "block")
                                }
                                else if (response.status === 'not_authorized') {
                                    $(".fb-comments ").css("display", "none")
                                    $("#vk_comments ").css("display", "block")
                                }
                                else {
                                    $(".fb-comments ").css("display", "block")
                                    $("#vk_comments ").css("display", "none")
                                }
                            });

                        }())
                    }
                });

            };

            (function (d) {
            var js, id = 'facebook-jssdk';
            if (d.getElementById(id)) {
            return;
            }
            js = d.createElement('script');
            js.id = id;
            js.async = true;
            js.src = "//connect.facebook.net/en_US/all.js";
            d.getElementsByTagName('head')[0].appendChild(js);
            }(document));

*/

    }

})






