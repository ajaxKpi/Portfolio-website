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

$('.Blog_photo img').imgPin(
    {pinImg : 'img/social/pinterestOnImg.png', position: 2
    }

);



/*
Arr_img = getImagesByAlt("Blog_photo");

for (one_img in Arr_img){
    ImgHeigt =Arr_img[one_img].height;
    ImgWith =Arr_img[one_img].width;


    if (ImgHeigt>ImgWith){

        $(".Main_content").find(Arr_img[one_img]).parent().css("width","49%")
    }
    else {
        $(".Main_content").find(Arr_img[one_img]).parent().css("width","100%")

    }
}

function getImagesByAlt(alt) {
    var allImages = document.getElementsByTagName("img");
    var images = [];
    for (var i = 0, len = allImages.length; i < len; ++i) {

        if (allImages[i].alt == alt) {
            images.push(allImages[i]);

        }
    }
    return images;
}
*/


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

$("#f197705904").remove();
