/**
 * Created by ivan on 30.04.16.
 */

//TODO: remove harcoded busy by real + regional
var busyDays = [];
$(document).ready(function() {

        $( "#datepicker" ).datepicker({
            dateFormat: "dd-MM-yy",
            firstDay: 1,
            beforeShowDay: function(date){
                var string = jQuery.datepicker.formatDate('dd-MM-yy', date);
                return [ busyDays.indexOf(string) == -1 ]
            }

        },
    $.datepicker.regional['ru']);

});