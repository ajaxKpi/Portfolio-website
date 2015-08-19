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
/*
Arr_img = getImagesByAlt("Blog_photo");
console.log(5 + " and " + Arr_img);
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