as = angular.module('myApp', ['ngRoute', 'ngMap']);
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
    //console.log ("inside initialize");
    'use strict';


}
