/**
 * Created by zvorskyi on 12.08.2015.
 */

//preloader block
$(window).load(function() {


    $(".typing-indicator").delay(400).fadeOut("slow");
    $(".loader-wrapper").delay(400).fadeOut("slow");
});

//scroll of fixed header

$(window).scroll(function(){
    if ($(window).width() < 960){
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
                });
                break;
            case 'Volyanska Photography|Article':
                $('#Blog').css("color", "brown");
                $(".Blog_name").hover(function() {
                    $(this).css("color","black");
                });
                $(function() {
                    $("img.lazy").lazyload();
                });
                break;
            case 'Volyanska Photography|About':
                $('#About').css("color", "brown");
                break;
            case 'Volyanska Photography|Advices':
                $('#Advices').css("color", "brown");
                break;
            case 'Volyanska Photography|Follow':
                $('#Follow').css("color", "brown");
                break;
            case 'Volyanska Photography|Services':
                $('#Services').css("color", "brown");
                break;
            case 'Volyanska Photography|Contacts':
                $('#Contacts').css("color", "brown");
                break;
            case 'Volyanska Photography|Feedbacks':
                $('#Feedbacks').css("color", "brown");
                $(".Blog_name").hover(function() {
                    $(this).css("color","black");
                });
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

    //disable link

   // $(".header_of_motion>a").attr('href',"")
    // $(".header_of_motion>a").removeClass('a');
   //$('.Blog_name').unbind('mouseenter mouseleave')
    //$('.header_of_motion>h1').attr('style','')
    $(".Blog_name").hover(function() {
        $(this).css("color","black");
    });
}

//convert color on click
$(".onshare").click(function() {
    Pathid ="#"+event.target.id;
    $(Pathid).css("fill","black");

    //$( "#vk-logo").css("background-color","silver")
    //$( "#count_VK").css("background-color","silver")
    //$( "#count_VK ").css("color","white")


     //  $( "#count_VK").text( Number($( "#count_VK").text()) +1)



jQuery(document).ready(function($) {
    $('.like').socialButton();
    $.scrollToButton('hash', 3000);

});

});

/*  configure access to VK and FB to choose wich comment bar should be used */
jQuery(document).ready(function($) {
    if ($(document).find("title").text()==='Volyanska Photography|Blog'){

        var tag = getUrlParameter('tag');
        if (tag  === "Advices") {
            $('#Blog').css("color", "black");
            $('#Advices').css("color", "brown");

        }



        $(function() {
            FB.init({appId: '1492697214384249', status: true, cookie: true, xfbml: true, version: 'v2.4'});
            FB.getLoginStatus(fbLoginStatus);
            FB.Event.subscribe('auth.statusChange', fbLoginStatus);


            function fbLoginStatus(response) {
                if (response.status === 'connected') {
                    //user is logged in, display profile div
                    fb_login = true
                } else {
                    //user is not logged in, display guest div
                    fb_login = false
                }
            }
        })

     VK.init({
     apiId: 5077240,
     onlyWidgets: true
     });

        (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
        '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());


var fb_login = false;
var vk_login = false;




 VK.Auth.getLoginStatus(function(response) {
 if (response.session) {
 // User authorized in Open API
     vk_login = true
 }
  else if (response.status === 'not_authorized') {
     vk_login =false
        }
 else {
     vk_login =false
 }
 });


if (fb_login || !vk_login){
    $(".fb-comments ").css("display", "block")
    $("#vk_comments ").css("display", "none")
}
else {

    $(".fb-comments ").css("display", "none")
    $("#vk_comments ").css("display", "block")
    }

    }

});




