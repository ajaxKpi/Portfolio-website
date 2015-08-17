/**
 * Created by zvorskyi on 12.08.2015.
 */
$(window).load(function() {


    $(".typing-indicator").delay(400).fadeOut("slow");
    $(".loader-wrapper").delay(400).fadeOut("slow");
});

/*$( ".inst_item" ).each(function( index ) {
    $(".inst_item" ).css("display", "block");
    $(".inst_item" ).css("opacity", "1");
});
*/

var currentIndex = 0,items = $('.inst_item'),
    itemAmt = items.length, prevIndex =0;

var autoSlide = setInterval(function() {
    currentIndex += 1;
    if (currentIndex > itemAmt - 1) {
        currentIndex = 0;
        prevIndex = currentIndex;

            prevIndex=itemAmt;

    }
    $(items[prevIndex]).css("opacity", "0")
    $(items[currentIndex]).css("opacity", "1")

    console.log(prevIndex)
}, 2000);
