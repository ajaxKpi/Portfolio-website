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
    aa = event.target.id
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
            if(result['ajax']){
                $( "#"+pre_fix+"_list").val(result['tag']);
                $( "#"+pre_fix+"_id").val(result['id']);
                $( "#"+pre_fix+"_name").val(result['name']);
                $( "#"+pre_fix+"_comments").val(result['descr']);
                //link to small preview
                var small_preview = result['preview'];
                //link to large preview
                var large_preview = small_preview.split('/');
                var lastindex =large_preview.length-1;
                var filename ="L_"+large_preview[lastindex];
                large_preview[lastindex] = filename;
                var L_preview = large_preview.join('/')
                $( "#"+pre_fix+"_smallimg").attr('src',small_preview);
                $( "#"+pre_fix+"_largeimg").attr('src',L_preview);

            }
                else{


            }
        },
        error: function() {
            alert('eror'); // "Hello world!" alerted
        }
    })
})