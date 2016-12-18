as = angular.module('myApp', ['ngRoute']);
as.config(function($routeProvider) {
    $routeProvider
        .when('/trips', {templateUrl: 'partials/trips.html', controller: 'TripsCtrl'})
        .when('/me', {templateUrl: 'partials/me.html'})
        .otherwise({redirectTo: ''});
});


function initialize() {
    //console.log ("inside initialize");
    'use strict';

    // Put here any JS that should be loaded at initialization

}