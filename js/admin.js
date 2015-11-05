/**
 * Created by zvorskyi on 24.09.2015.
 */
//usage of bootstrap data picker

$(document).ready(function() {
    $('#sandbox-container .input-group.date').datepicker(
        {
            format: "dd/mm/yyyy",
            weekStart: 1,
            todayBtn: "linked",
            language: "ru",
            autoclose: true,
            todayHighlight: true
        }
    )
});
//---------------------------
// to set preview photo
//---------------------------
function readURL(input, ImgID) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(ImgID).attr('src', e.target.result);
    };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#inp_small").change(function(){
    readURL(this,"#smallimg");

});
$("#inp_large").change(function(){
    readURL(this, "#largeimg");

});
$("#inp_exsmall").change(function(){
    readURL(this,"#exsmallimg");

});
$("#ed_small").change(function(){
    readURL(this,"#edit_smallimg");

});
$("#ed_large").change(function(){
    readURL(this, "#edit_largeimg");

});
$("#ed_exsmall").change(function(){
    readURL(this,"#edit_exsmallimg");

});

$("#Multy_butt").change(function(){
    $("#Multy_img").attr("src","img/success.jpg");

});

$("#inp_feed").change(function(){
    readURL(this,"#feed_img");

});



// Rise when we change date to fill description
$( "#BusyDate" ).change(function() {
    $.ajaxSetup({ cache: false });
    $.getJSON( "Busy1.json", function(data) {
            $( "#Event").val(data[$( "#BusyDate").val()]);
        console.log( "success" );
    });
    $.ajaxSetup({ cache: true});

});


// fill form by Ajax request for Edit tab
$(".load").on('click',function() {

    if (event.target.id=="load_edit"){
        pre_fix = "edit"
    }
    if (event.target.id=="load_delete"){
        pre_fix = "delete"
    }


    $.ajax({
        url: 'Upload.php',
        type: 'POST',
        data: ({'date': $( "#"+pre_fix+"Date").val()}),
        dataType: "json",
            success: function (result) {
            if(result['ajax']) {
                $("#" + pre_fix + "_list").val(result['tag']);
                $("#" + pre_fix + "_id").val(result['id']);
                $("#" + pre_fix + "_name").val(result['name']);
                $("#" + pre_fix + "_comments").val(result['descr']);
                $("#" + pre_fix + "_comments_ru").val(result['descr_ru']);
                if (pre_fix == "edit") {

                CKEDITOR.instances[pre_fix + '_comments'].setData(result['descr']);
                CKEDITOR.instances[pre_fix + '_comments_ru'].setData(result['descr_ru']);

                CKEDITOR.instances[pre_fix + '_subcontr'].setData(result['subcontr']);
                CKEDITOR.instances[pre_fix + '_subcontr_ru'].setData(result['subcontr_ru']);

                                }
                //link to small preview
                var small_preview = result['preview'];
                //link to large preview
                var preview = small_preview.split('/');
                large_preview = preview.slice();
                var lastindex =large_preview.length-1;
                // get file name of large img

                var filename ="L_"+large_preview[lastindex];
                large_preview[lastindex] = filename;
                var L_preview = large_preview.join('/');
                // get file name of small img
                s_preview = preview.slice();
                var lastindex =s_preview.length-1;
                var filename ="S_"+s_preview[lastindex];
                s_preview[lastindex] = filename;
                var S_preview = s_preview .join('/');

                $( "#"+pre_fix+"_smallimg").attr('src',small_preview);
                $( "#"+pre_fix+"_largeimg").attr('src',L_preview);
                $( "#"+pre_fix+"_exsmallimg").attr('src',S_preview);

            }
        },
        error: function() {
            console.log('error get article'); // "Hello world!" alerted
        }
    })
})

//drive of busy dates
$("#busyCr").on('click',function(){

    $.ajax({
        url: 'load.php',
        type: 'POST',
        data: ({'Event_date': $( "#BusyDate").val(), 'Event':$( "#Event").val()}),
        success: function (result) {

            if ($("#Event").val()) {
            $(".status_Add").text("successfully ADDED");
            $(".status_Add").css("color", "green");
            $(".status_Add").css("display", "inline-block");
            $(".status_Add").fadeOut("slow");
                                 }
            else{
            $(".status_Add").text("REMOVED");
            $(".status_Add").css("color","red");
            $(".status_Add").css("display", "inline-block");
            $(".status_Add").fadeOut("slow");
                }

                    },
        error: function() {

        }
    })
});


// fill form by Ajax request for ADD LINKS
$("#link_id").change(function() {

    $.ajax({
        url: 'load.php',
        type: 'POST',
        data: ({'IdVal': $( "#link_id").val(), 'mode':"GetDescr"}),
        dataType: "json",
        success: function (result) {
        if (result['descr']){
                $( "#link_descr").val(result['descr']);}
            else{
            $( "#link_descr").val('');
        }

        },
        error: function() {
            console.log('error get busy day'); // "Hello world!" alerted
        }
    })

});

// f write new link into links table
$("#Add_link").on('click',function() {

    $.ajax({
        url: 'load.php',
        type: 'POST',
        data: ({'IdVal': $( "#link_id").val(), 'mode':"WriteLink", 'link_descr':$( "#link_descr").val()}),
        success: function (result) {

           console.log('successfully updated')

        },
        error: function() {
            console.log('error get busy day');
        }
    })

});