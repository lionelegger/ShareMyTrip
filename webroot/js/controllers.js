// ---------------
// Main Ctrl
// ---------------
as.controller('MainCtrl', function($scope, $http, $location, $window) {
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

    // Add user (Registration)
    $scope.newUserToAdd = {};
    $scope.addNewUser = function() {
        $http
            .post('Users/add', $scope.newUserToAdd)
            .success(function() {
                console.log($scope.newUserToAdd);
                //$scope.loadTrips();
                $scope.newUserToAdd = {};
                $window.location.reload();
            }).error(function() {
                console.log($scope.newUserToAdd);
            console.log("Something went wrong during user registration");
        });
    };
});

// ---------------
// TripsCtrl lists the trips (Page trips)
// ---------------
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

    // Deletes a trip (and the logged user as a participant with cakephp3)
    $scope.deleteTrip = function(id) {
        $http
            .delete('Trips/delete/' + id + '.json')
            .success(function() {
                console.log("Delete trip " + id);
                $scope.loadTrips();
            }).error(function() {
            console.log("Something went wrong during save Trip");
        });
    };

});

// ---------------
// ParticipantsCtrl deals participants to a trip or an action (Page trips -> Settings)
// ---------------
as.controller('ParticipantsCtrl', function($scope, $rootScope, $http) {
    console.log('call ParticipantsCtrl');

    // get the users of the trip
    $scope.getTripUsers = function(tripId) {
        console.log('call getTripUsers');
        $http
            .get('trips/'+tripId+'.json')
            .success(function(data) {
                console.log(data);
                $scope.currentTrip=data;
                console.log('trip users refreshed');
            }).error(function() {
            console.log("Something went wrong during load Trip");
        });
    };

    // delete a user to a trip
    $scope.tripDeleteUser = function(userId) {
        console.log('call tripDeleteUser for user ' + userId);
        $http
            .delete('TripsUsers/delete/'+userId+'.json')
            .success(function() {
                // TODO: We should also remove the delete this user as participant of any action of the current trip
                $('#tripDeleteUser').addClass("btn-default").removeClass("btn-danger");
                $('#tripDeleteUser-'+userId).parent().css( "opacity", "0.2" );
                $('#tripDeleteUser-'+userId).text('Deleted');
            }).error(function() {
            console.log("Something went wrong during delete tripCurrentUser");
        });
    };

    // check if a user exist
    $scope.userToGet = {};
    $scope.tripCheckUser = function() {
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
                    $scope.tripAddUser($tripId, data.user.id);
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
    $scope.tripAddUser = function($tripId, $userId) {
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

    // Add a user to an action
    // TODO: do not allow to add a user twice
    $scope.actionAddUser = function($tripId, $actionId, $userId) {
        $scope.actionUserToAdd = {
            action_id : $actionId,
            user_id : $userId
        };
        console.log('call actionAddUser for user ' + $userId + " and action " + $actionId);

        if ($("#user-"+$userId).hasClass('btn-success')) {
            $deleteId = $("#user-"+$userId).attr('deleteId');
            $http
                .delete('Participations/delete/'+$deleteId+'.json')
                .success(function() {
                    $scope.getParticipantsAction($tripId, $actionId);
                    $("#user-"+$userId).removeClass("btn-success");
                    console.log("Participant has been removed!");
                }).error(function() {
                console.log("Something went wrong during add action for User " + id);
            });
        } else {
            $http
                .post('Participations/add.json', $scope.actionUserToAdd)
                .success(function() {
                    $scope.actionUserToAdd = {};
                    $scope.getParticipantsAction($tripId, $actionId);
                }).error(function() {
                console.log("Something went wrong during add action for User " + id);
            });
        }

    };

    // Check if a user is participating to an action
    $scope.getParticipantsAction = function($tripId, $actionId) {
        console.log('call getParticipantsAction for action ' + $actionId + ' and trip ' + $tripId);
        $http
            .get('trips/'+$tripId+'.json')
            .success(function(data) {
                console.log(data);
                $scope.currentTrip=data;
                $http
                    .get('actions/view/'+$actionId+'.json')
                    .success(function(data) {
                        console.log(data);
                        $scope.actions=data;
                        $scope.actions.action.participations.forEach(function(element) {
                            $userId = element.user_id;
                            $deleteId = element.id;
                            console.log ('Participant id = ' + $userId);
                            $("#user-"+$userId).addClass("btn-success").attr("deleteId", $deleteId);
                            $("#user-"+$userId).prepend("<span class='glyphicon glyphicon-ok'></span>&nbsp;&nbsp;");
                        });
                    }).error(function() {
                    console.log("Something went wrong during load Action");
                });
            }).error(function() {
            console.log("Something went wrong during load Trip");
        });
    };

});




















// ----------------------------------------------------------------------------------------------------
// ----------------------------------------- NOT USED BELOW -------------------------------------------
// ----------------------------------------------------------------------------------------------------

// Ctrl for the trip details (partials/trip.html)
as.controller('TripCtrl', function($scope, $rootScope, $http, $routeParams) {
    console.log("call tripCtrl");

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

as.controller('ActionCtrl', function($scope, $rootScope, $http, $routeParams, $window, NgMap) {
    console.log("call ActionCtrl");

    // load date picker start
    // TODO: not working with angularJS: ng-model does not get the date ....
    $(function () {
        $('#start_datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD hh:mm'
        });
        $('#end_datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD hh:mm'
        });

        //$('#start_datetimepicker').datetimepicker();
        $('#end_datetimepicker').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#start_datetimepicker").on("dp.change", function (e) {
            $('#end_datetimepicker').data("DateTimePicker").minDate(e.date);
        });
        $("#end_datetimepicker").on("dp.change", function (e) {
            $('#start_datetimepicker').data("DateTimePicker").maxDate(e.date);
        });
    });

    // gets the action information (to update)
    $scope.getAction = function($id) {
        $http
            .get('actions/view/' + $id + '.json')
            .success(function(data) {
                console.log(data.action);
                $scope.action = data.action;
            }).error(function() {
            console.log("Something went wrong during get Action");
        });
    };

    // gets the action types
    $scope.getActionTypes = function() {
        $http
            .get('types.json')
            .success(function(data) {
                $scope.types = data.types;
            }).error(function() {
            console.log("Something went wrong during get Action");
        });
    };

    // if an parameter is passed in the url (#trips/1/action/2), then we want to update the action and we get the values of action 2 (:up)
    if($routeParams['up']) {
        console.log("Update action " + $routeParams['up']);
        $scope.getAction($routeParams['up']);
    }

    // adds an action
    $scope.action = {};
    $scope.action.trip_id = $routeParams['id'];
    //console.log($scope.trip_id);
    $scope.addAction = function() {
        $http
            .post('Actions/add', $scope.action)
            .success(function() {
                console.log($scope.action);
                $scope.action = {};
                $window.location.href = '#/trips/' + $routeParams['id'];
            }).error(function() {
            console.log("Something went wrong during save Action");
        });
    };

    // update an action
    // TODO: BUG => When there is a date, the action does not update ... to investigate
    // TODO: I could use angular material for datepicker: https://material.angularjs.org/latest/demo/datepicker

    $scope.actiontoUpdate = {};
    //console.log($scope.trip_id);
    $scope.updateAction = function($up) {

        // fields to update
        // TODO: I dont' know why it's only working by redefining the fields in a 'actiontoUpdate' variable instead of just 'action'
        $scope.actiontoUpdate.trip_id = $routeParams['id'];
        $scope.actiontoUpdate.id = $routeParams['up'];
        $scope.actiontoUpdate.name = $scope.action.name;
        $scope.actiontoUpdate.type_id = $scope.action.type_id;
        $scope.actiontoUpdate.company = $scope.action.company;
        $scope.actiontoUpdate.identifier = $scope.action.identifier;
        $scope.actiontoUpdate.reservation = $scope.action.reservation;
        $scope.actiontoUpdate.note = $scope.action.note;
        $scope.actiontoUpdate.price = $scope.action.price;
        $scope.actiontoUpdate.currency = $scope.action.currency;
        $scope.actiontoUpdate.start_date = $scope.action.start_date;
        $scope.actiontoUpdate.start_name = $scope.action.start_name;
        $scope.actiontoUpdate.start_long = $scope.action.start_long;
        $scope.actiontoUpdate.start_lat = $scope.action.start_lat;
        $scope.actiontoUpdate.end_date = $scope.action.end_date;
        $scope.actiontoUpdate.end_name = $scope.action.end_name;
        $scope.actiontoUpdate.end_long = $scope.action.end_long;
        $scope.actiontoUpdate.end_lat = $scope.action.end_lat;

        $http
            .post('actions/edit/'+ $up, $scope.actiontoUpdate)
            .success(function() {
                console.log("call updateAction with action " + $up);
                console.log($scope.actiontoUpdate);
                $scope.actiontoUpdate = {};
                $window.location.href = '#/trips/' + $routeParams['id'];
            }).error(function() {
            console.log("Something went wrong during edit Action");
        });
    };

    $scope.loadTripDetails = function() {
        $http
            .get('trips/'+ $routeParams['id'] +'.json')
            .success(function(data) {
                $scope.trip = data.trip;
            }).error(function() {
            console.log("Something went wrong during save Action");
        });
    };


});




