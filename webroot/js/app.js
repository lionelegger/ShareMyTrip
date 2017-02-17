as = angular.module('myApp', ['ngRoute']);
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

    function updateStatus() {
        // Update the status of the action: 0=not defined / 1 = nothing paid / 2 = partially paid / 3 = All paid / 4 = overpaid

        alert("Update status!");

        $scope.action.status = 0;
        console.log ("TOTAL = " + $scope.action.payments.totalAll);
        console.log ("PRICE = " + $scope.action.price);
        if($scope.action.payments.totalAll == 0) {
            $scope.action.status = 1;
        } else if ($scope.action.payments.totalAll == $scope.action.price) {
            $scope.action.status = 3;
        } else if ($scope.action.payments.totalAll > $scope.action.price) {
            $scope.action.status = 4;
        } else {
            $scope.action.status = 2;
        }
        if ($scope.action.price == null) {
            $scope.action.status = 0;
        }
    }

    document.getElementById("selectAllParticipants").onclick = function selectAllParticipants() {
        console.log("Select all users as participants...");
        $('#participants input').prop('checked', true);
    };

    document.getElementById("selectOnlyMe").onclick = function selectOnlyMe() {
        $('#participants input').prop('checked', false);
    };

    $(".map-icon").click(function() {
        $(".map-icon.status-0").removeClass('active');
        $(".map-icon.status-0").removeAttr('selected');
        $(this).addClass('active');
        $(this).attr('selected', 'selected');
        updateTypeId();
    });


}
