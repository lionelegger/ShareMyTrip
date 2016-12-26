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

});

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

    // adds a user to a trip
    $scope.tripUserToAdd = {};
    $scope.tripAddUser = function() {
        console.log('call tripAddUser');
        $http
            .post('Users/getIdFromEmail', $scope.tripUserToAdd)
            .success(function(data) {
                console.log("data sent: " + $scope.tripUserToAdd.email);
                console.log("--------");
                console.log(data);
                console.log("--------");
                $scope.tripUserToAdd = {};
            }).error(function() {
            console.log("Something went wrong during save tripUserToAdd");
        });
    };

});


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

});

