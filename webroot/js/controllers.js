// Main Ctrl
as.controller('MainCtrl', function($scope, $http, $location) {
    console.log('call MainCtrl');
    // to get the current user
    $http.get('users/current.json')
        .success(function(data) {
            if (undefined != data.user) {
                $scope.currentUserId = data.user.id;
                $scope.currentUserEmail = data.user.email;
                $scope.currentUserFirstname = data.user.first_name;
                $scope.currentUserLastname = data.user.last_name;
            }
        }).error(function(data) {
        $scope.currentUserId = 'user undefined';
    });

    // to logout
    $scope.logout = function(){
        $http.get('Users/logout');
        console.log("call logout");
    };

    // for navigation (to get the current page)
    $scope.isCurrentPath = function (path) {
        return $location.path() == path;
    };

    // Add user (Registration)
    $scope.newUserToAdd = {};
    $scope.addNewUser = function() {
        $http
            .post('Users/add', $scope.newUserToAdd)
            .success(function() {
                console.log($scope.newUserToAdd);
                //$scope.loadTrips();
                $scope.newUserToAdd = {};
            }).error(function() {
                console.log($scope.newUserToAdd);
            console.log("Something went wrong during user registration");
        });
    };

});

// Ctrl that lists the trips (partials/trips.html)
as.controller('TripsCtrl', function($scope, $rootScope, $http) {
    // Load the list of trips for the logged user
    console.log('call TripsCtrl');
    $scope.loadTrips = function() {
        console.log('call loadTrips for user ' + $scope.currentUserId);
        $http.get('users/view/' + $scope.currentUserId + '.json')
            .success(function(data) {
                $scope.currentUser = data.user;
            }).error(function(data, status, headers, config) {
        });
    };
    $scope.loadTrips();

    // adds a trip (and the logged user as a participant with cakephp3)
    $scope.tripToAdd = {};
    $scope.addTrip = function() {
        $http
            .post('Trips/add', $scope.tripToAdd)
            .success(function() {
                console.log($scope.tripToAdd);
                $scope.loadTrips();
                $scope.tripToAdd = {};
            }).error(function() {
            console.log("Something went wrong during save Trip");
        });
    };

});

// Ctrl that deals the trip participants (partials/trips.html)
as.controller('tripParticipantsCtrl', function($scope, $rootScope, $http) {
    console.log('call getTripUsers');
    // get the users of the trip
    $scope.init = function(tripId){
        $scope.getTripUsers(tripId);
    };

    $scope.getTripUsers = function(id) {
        $http
            .get('trips/'+id+'.json')
            .success(function(data) {
                console.log(data);
                $scope.currentTrip=data;
            }).error(function() {
            console.log("Something went wrong during load Trip");
        });
    };

    // delete a user to a trip
    $scope.tripDeleteUser = function(id) {
        console.log('call tripDeleteUser for user');
        $http
            .delete('TripsUsers/delete/'+id+'.json')
            .success(function() {
                $('#tripDeleteUser').addClass("btn-default").removeClass("btn-danger");
                $('#tripDeleteUser-'+id).parent().css( "opacity", "0.2" );
                $('#tripDeleteUser-'+id).text('Deleted');
            }).error(function() {
            console.log("Something went wrong during delete tripCurrentUser");
        });
    };

    // check if a user exist
    $scope.userToGet = {};
    $scope.tripAddUser = function() {
        console.log('call tripAddUser');
        $http
            .post('Users/getUserFromEmail.json', $scope.userToGet)
            .success(function(data) {
                console.log("data sent: " + $scope.userToGet.email);
                console.log("--------");
                console.log(data.user);
                console.log("--------");

                var $tripId = $('.modal.fade.in #tripId').first().text();

                if (data.user) {
                    $scope.tripAddUserId($tripId, data.user.id);
                } else {
                    $('.modal.fade.in .form-message').text('User does not exist. Please try another email address.');
                }

                $scope.userToGet = {};
            }).error(function() {
            console.log("Something went wrong during save tripUserToAdd");
        });
    };

    // Add a user to a trip
    // TODO: do not allow to add a user twice
    $scope.tripAddUserId = function($tripId, $userId) {
        $scope.tripUserToAdd = {
            trip_id : $tripId,
            user_id : $userId
        };
        console.log('call tripAddUser for user ' + $userId + " and trip " + $tripId);
        $http
            .post('TripsUsers/add.json', $scope.tripUserToAdd)
            .success(function() {
                $('.modal.fade.in .form-message').text("This user has been added to the current trip");
                $scope.tripUserToAdd = {};
            }).error(function() {
            console.log("Something went wrong during add trip for User " + id);
        });
    };

});

// Ctrl for the trip details (partials/trip.html)
as.controller('TripCtrl', function($scope, $rootScope, $http, $routeParams) {
    console.log("call tripCtrl");

    // Load the type corresponding to a specific type_id
    // TODO: LOADACTIONTYPE IS NOT WORKING YET
    $scope.loadActionType = function($id) {
        console.log('call loadDetails for action '  + $id);
        $http.get('type/view/' + $id +'.json')
            .success(function(data) {
                console.log("-------------");
                console.log(data);
                console.log('Types for action ' + $id +' loaded!');
                $scope.type = data;
                return $scope.type;

            }).error(function(data) {
            console.log("Could not load the types corresponding to action " + $id);
        });
    };

    // Load the list of actions corresponding to a specific trip
    $scope.loadActions = function() {
        console.log('call loadActions for trip '  + $routeParams['id']);
        $http.get('trips/' + $routeParams['id'] +'.json')
            .success(function(data) {
                $scope.trip = data.trip;
                console.log('Trip ' + $routeParams['id'] +' and corresponding actions loaded!');
            }).error(function(data) {
            console.log("Could not load the actions corresponding to trip " + $routeParams['id']);
        });
    };
    $scope.loadActions();


});

as.controller('ActionCtrl', function($scope, $rootScope, $http, $routeParams) {
    console.log("call ActionCtrl");
});

