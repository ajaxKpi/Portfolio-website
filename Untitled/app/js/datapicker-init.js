/**
 * Created by ivan on 30.04.16.
 */


//TODO: remove harcoded busy by real + regional

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
});