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
    }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#inp_small").change(function(){
    readURL(this,"#smallimg");

});
$("#inp_large").change(function(){
    readURL(this, "#largeimg");

});


$( "#BusyDate" ).change(function() {
    $.getJSON( "Busy.json", function( data ) {
            $( "#Event").val(data[$( "#BusyDate").val()]);
    });
});