function initialize() {
    // console.log ("inside initialize");
    'use strict';

    // buttons action-id in actions form
    $(".map-icon.map-icon-status").click(function() {
        $(".map-icon.map-icon-status").removeClass('active');
        // $(".map-icon.status-0").removeAttr('selected');
        $(this).addClass('active');
        // $(this).attr('selected', 'selected');
        updateTypeId();
    });


    // For currency buttons at the right of an input
    $(".input-group-btn > .dropdown-menu li a").click(function(){
        var selText = $(this).html();
        $('.input-group-btn .btn:first-child').html(selText+'<i class="arrow down"></i>');
    });

    $('#datepickerStart').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#timepickerStart').datetimepicker({
        format: 'HH:mm'
    });
    $('#datepickerEnd').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false //Important! See issue #1075
    });
    $('#timepickerEnd').datetimepicker({
        format: 'HH:mm'
    });
    $("#datepickerStart").on("dp.change", function (e) {
        $('#datepickerEnd').data("DateTimePicker").minDate(e.date);
    });
    $("#datepickerEnd").on("dp.change", function (e) {
        $('#datepickerStart').data("DateTimePicker").maxDate(e.date);
    });

    // Payment date
    $(function () {
        $('#datePayment').datetimepicker({
            format: 'YYYY-MM-DD',
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom'
            }
        });
    });
    // bad trick to update the picker format when we edit a payment
    $('#payment').on('shown.bs.modal', function () {
        $("#datePayment").data("DateTimePicker").show();
        $("#datePayment").data("DateTimePicker").hide();
    });

    // opacity change of section-containers
    $(".section-container").hover(function() {
        $(".section-container").css("opacity","0.7");
        $(".section-container:hover").css("opacity","1");
    }, function(){
        $(".section-container").css("opacity","1");
    });



}
