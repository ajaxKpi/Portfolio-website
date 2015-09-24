/**
 * Created by zvorskyi on 24.09.2015.
 */
//usage of bootstrap data picker

$(document).ready(function() {
    $('#sandbox-container .input-group.date').datepicker(
        {
            format: "mm/dd/yyyy",
            weekStart: 1,
            todayBtn: "linked",
            language: "ru",
            autoclose: true,
            todayHighlight: true
        }
    )
});