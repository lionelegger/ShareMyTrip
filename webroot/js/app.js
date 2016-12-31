as = angular.module('myApp', ['ngRoute']);
as.config(function($routeProvider) {
    $routeProvider
        .when('/trips', {templateUrl: 'partials/trips.html', controller: 'TripsCtrl'})
        .when('/trips/:id', {templateUrl: 'partials/trip.html', controller: 'TripCtrl'})
        .when('/trips/:id/action', {templateUrl: 'partials/action.html', controller: 'ActionCtrl'})
        .when('/trips/:id/action/:up', {templateUrl: 'partials/action.html', controller: 'ActionCtrl'})
        .when('/plan', {templateUrl: 'partials/plan.html'})
        .when('/map', {templateUrl: 'partials/map.html'})
        .when('/cost', {templateUrl: 'partials/cost.html'})
        .when('/me', {templateUrl: 'partials/me.html'})
        .otherwise({redirectTo: '/home'});
});


function initialize() {
    //console.log ("inside initialize");
    'use strict';

    // Put here any JS that should be loaded at initialization




}
