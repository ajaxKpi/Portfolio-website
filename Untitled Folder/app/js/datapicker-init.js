/**
 * Created by ivan on 30.04.16.
 */
<<<<<<< HEAD
$(document).ready(function() {

        $( "#datepicker" ).datepicker();
=======

//TODO: remove harcoded busy by real + regional
var busyDays = ["12-05-2016"];
$(document).ready(function() {

        $( "#datepicker" ).datepicker({
            dateFormat: "dd-MM-yy",
            firstDay: 1,
            beforeShowDay: function(date){
                var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
                return [ busyDays.indexOf(string) == -1 ]
            }

        },
    $.datepicker.regional['ru']);

>>>>>>> 9180d4912c1e75c7e83534f6f907b8fdadcda704
});