function initialize(){"use strict";function t(){alert("Update status!"),$scope.action.status=0,console.log("TOTAL = "+$scope.action.payments.totalAll),console.log("PRICE = "+$scope.action.price),0==$scope.action.payments.totalAll?$scope.action.status=1:$scope.action.payments.totalAll==$scope.action.price?$scope.action.status=3:$scope.action.payments.totalAll>$scope.action.price?$scope.action.status=4:$scope.action.status=2,null==$scope.action.price&&($scope.action.status=0)}$(".map-icon").click(function(){$(".map-icon.status-0").removeClass("active"),$(".map-icon.status-0").removeAttr("selected"),$(this).addClass("active"),$(this).attr("selected","selected"),updateTypeId()})}as=angular.module("myApp",["ngRoute"]),as.config(function(t){t.when("/trips",{templateUrl:"partials/trips.html",controller:"TripsCtrl"}).when("/trips/:id",{templateUrl:"partials/trip.html",controller:"TripCtrl"}).when("/trips/:id/action",{templateUrl:"partials/action.html",controller:"ActionCtrl"}).when("/trips/:id/action/:up",{templateUrl:"partials/action.html",controller:"ActionCtrl"}).when("/plan",{templateUrl:"partials/plan.html",controller:"PlanCtrl"}).when("/map",{templateUrl:"partials/map.html",controller:"MapCtrl as vm"}).when("/cost",{templateUrl:"partials/cost.html"}).when("/me",{templateUrl:"partials/me.html"}).otherwise({redirectTo:"/home"})});