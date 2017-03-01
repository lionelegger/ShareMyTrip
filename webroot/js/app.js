as = angular.module('myApp', ['ngRoute', 'ngImgCrop']);
as.config(function($routeProvider) {
    $routeProvider
        .when('/trips', {templateUrl: 'partials/trips.html', controller: 'TripsCtrl'})
        .when('/trips/:id', {templateUrl: 'partials/trip.html', controller: 'TripCtrl'})
        .when('/trips/:id/action', {templateUrl: 'partials/action.html', controller: 'ActionCtrl'})
        .when('/trips/:id/action/:up', {templateUrl: 'partials/action.html', controller: 'ActionCtrl'})
        .when('/plan', {templateUrl: 'partials/plan.html', controller: 'PlanCtrl'})
        .when('/map', {templateUrl: 'partials/map.html', controller: 'MapCtrl as vm'})
        .when('/cost', {templateUrl: 'partials/cost.html'})
        .when('/me', {templateUrl: 'partials/me.html'})
        .otherwise({redirectTo: '/home'});
});


function initialize() {
    // console.log ("inside initialize");
    'use strict';

    /*
    function updateStatus() {
        // Update the status of the action: 0=not defined / 1=price not defined / 2 = nothing paid / 3 = partially paid / 4 = All paid / 5 = overpaid
        alert("Update status!");
        $scope.action.status = 0; // initialize status to 0 (grey)
        console.log ("TOTAL = " + $scope.action.payments.totalAll);
        console.log ("PRICE = " + $scope.action.price);
        if($scope.action.payments.totalAll === 0) {
            $scope.action.status = 2; // Nothing paid (danger)
        } else if ($scope.action.payments.totalAll == $scope.action.price) {
            $scope.action.status = 4; // All paid (success)
        } else if ($scope.action.payments.totalAll > $scope.action.price) {
            $scope.action.status = 5; // Overpaid (black)
        } else {
            $scope.action.status = 3; // Partially paid (warning)
        }
        if ($scope.action.price === null) {
            $scope.action.status = 1; // Price not defined (primary)
        }
    }
    */

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
    $("#datetimepickerStart").on("dp.change", function (e) {
        $('#datepickerEnd').data("DateTimePicker").minDate(e.date);
    });
    $("#datepickerEnd").on("dp.change", function (e) {
        $('#datepickerStart').data("DateTimePicker").maxDate(e.date);
    });

}
