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
        $scope.currentUserId = 'undefined';
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
    // Load the list of trips
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

    $scope.tripToAdd = {};
    $scope.tripCurrentUserToAdd = {};
    $scope.addTrip = function() {
        $http
            .post('Trips/add', $scope.tripToAdd)
            .success(function() {
                $scope.loadTrips();
                $scope.tripToAdd = {};

            }).error(function() {
            console.log("Something went wrong during save Trip");
        });
    };

    $scope.tripAddUser = function() {
        console.log('call tripAddUser');
        $http
            .post('TripsUsers/add', $scope.tripCurrentUserToAdd)
            .success(function() {
                $scope.tripCurrentUserToAdd = {};
            }).error(function() {
            console.log("Something went wrong during save tripCurrentUser");
        });

    };

});


