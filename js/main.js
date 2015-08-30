/**
 * Created by zvorskyi on 12.08.2015.
 */

//preloader block
$(window).load(function() {


    $(".typing-indicator").delay(400).fadeOut("slow");
    $(".loader-wrapper").delay(400).fadeOut("slow");
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
if ($(document).find("title").text() ==='Volyanka Photography|Blog'){

$('.Blog_photo img').imgPin(

        {
            pinImg : 'img/social/pinterestOnImg.png', position: 2

        }

    );
}

var logo_width = $(".logo_small").width();
console.log( $(".Main_content").css("margin-left"))

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

//delete facebook vidget addition
$("#f197705904").remove();

// get move of block in calculation of logo size



//use specific layout on single blog




if ($(document).find("title").text()==='Volyanska Photography|Blog'){

    $('.Main_content').css({
        "padding-left": "10px",
        "padding-right": "100px"


    });
    //$('.main_sidebar').css("padding-top","60px")
}

//get active page

        switch($(document).find("title").text())
        {

            case 'Volyanska Photography|Blog':
               $('#Blog').css("color", "brown");
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
            case 'Volyanska Photography|Contacts':
                $('#Contacts').css("color", "brown");
                break;
            default:
                $('#Portfolio').css("color", "brown");
        }
//set text in like_share bar
if($('div').hasClass('comment_wrap') && $('div').hasClass('read_more')) {
    $('.read_more>a').text("Return to blog...");
    $(".read_more>a").attr('href', 'FullBlog.html')

}
else if($('div').hasClass('read_more'))
{
    $('.read_more>a').text("Read more...");
    $('.read_more>a').attr('href', 'SingleBlog.html');
}
//convert color on click
$( "#vk-logo" ).click(function() {
    $( "#vk-logo  path").css("fill","white")
    $( "#vk-logo").css("background-color","silver")
    $( "#count_VK").css("background-color","silver")
    $( "#count_VK ").css("color","white")


        $( "#count_VK").text( Number($( "#count_VK").text()) +1)



jQuery(document).ready(function($) {
    $('.like').socialButton();
    $.scrollToButton('hash', 3000);
});

});
$( "#fb-logo" ).click(function() {
    $( "#fb-logo  path").css("fill","white")
    $( "#fb-logo").css("background-color","silver")
    $( "#count_FB").css("background-color","silver")
    $( "#count_FB ").css("color","white")

    $( "#count_FB").text( Number($( "#count_FB").text()) +1)
    console.log(Number($( Number($( "#count_FB").text()) +1)))
});
