// ---------------
// Main Ctrl
// ---------------
as = angular.module('myApp', ['ngRoute']);

as.controller('MainCtrl', function($scope, $http, $location, $window) {

    // to get the current user
    $scope.getCurrentUser = function() {
        $http.get('users/current.json')
            .success(function (data) {
                if (undefined !== data.user) {
                    $scope.currentUserId = data.user.id;
                    $scope.currentUserEmail = data.user.email;
                    $scope.currentUserPassword = data.user.password;
                    $scope.currentUserFirstname = data.user.first_name;
                    $scope.currentUserLastname = data.user.last_name;
                }
            }).error(function () {
            $scope.currentUserId = 'user undefined';
        });
    };
    $scope.getCurrentUser();

    // to logout
    $scope.logout = function(){
        $http.get('Users/logout');
    };

    // Add user (Registration)
    $scope.userToAdd = {};
    $scope.addUser = function() {

        $http
            .post('Users/add', $scope.userToAdd)
            .success(function() {
                $scope.userToAdd = {};
                document.location = 'trips';
            }).error(function() {
            console.log("Something went wrong during user registration");
        });
    };


});

// ---------------
// TripsCtrl lists the trips
// ---------------
as.controller('TripsCtrl', function($scope, $rootScope, $http) {
    // Load the list of trips for the logged user
    $scope.loadTrips = function() {
        $http.get('trips.json')
            .success(function(data) {
                $scope.trips = data.trips;
                // dismiss the modal (that does not close on trips page)
                $(".modal-backdrop").hide();
            }).error(function() {
            console.log("Something went wrong during load Trips");
        });
    };
    $scope.loadTrips();

    $scope.loadTrip = function(tripId) {
        secondPress = false;
        $http.get('trips/'+tripId+'.json')
            .success(function(data) {
                $scope.trip = data.trip;
            }).error(function() {
            console.log("Something went wrong during load Trip");
        });
    };

    // adds a trip (and the logged user as a participant with cakephp3)
    $scope.addTrip = function() {
        $scope.tripToAdd={};
        $scope.welcomeMsg=false;
        $scope.tripToAdd.name = $("#add_tripName").val();
        if ($('#add_date_start').val()) {
            $scope.tripToAdd.date_start = $('#add_date_start').val()+' 12:00:00';
        }
        if ($('#add_date_end').val()) {
            $scope.tripToAdd.date_end = $('#add_date_end').val()+' 12:00:00';
        }
        $scope.tripToAdd.currency = $("#add_currency option:selected").val();
        $http
            .post('Trips/add.json', $scope.tripToAdd)
            .success(function(data) {
                $scope.tripToAdd={};
                $scope.loadTrips();
            }).error(function() {
            console.log("Something went wrong during add Trip");
        });
    };

    $scope.editTrip = function(tripId) {
        $scope.btnPressed=false;
        $scope.buttonTxt = "Delete";
        $('.modal .form-message').empty();
        if (tripId){
            $scope.loadTrip(tripId);
        } else {
            $scope.trip={};
            $scope.trips.trip={};
        }
    };

    $scope.editParticipants = function(tripId) {
        $scope.loadTrip(tripId);
        $scope.getTripUsers(tripId);
    };

    // $scope.trip = {};
    $scope.saveTrip = function(tripId) {
        $scope.trip.date_start = $("#date_start").val();
        $scope.trip.date_end = $("#date_end").val();
        $scope.trip.currency = $("#currency option:selected").val();
        $http
            .post('Trips/edit/' + tripId, $scope.trip)
            .success(function() {
                $scope.loadTrips();
            }).error(function() {
            console.log("Something went wrong during save Trip");
        });
    };

    $scope.buttonTxt = "Delete";
    // Confirmation to the deletion of a trip
    $scope.deleteConfirm = function(tripId) {
        if($scope.btnPressed){
            $scope.btnPressed = false;
            $('#tripEdit').modal('toggle');
            $scope.deleteTrip(tripId);
            $scope.buttonTxt = "Delete trip";
        } else {
            $scope.btnPressed = true;
            $scope.buttonTxt = "Are you sure?";
        }
    };

    $scope.buttonUserTxt = "Delete";
    // Confirmation to the deletion of a trip
    $scope.deleteUserConfirm = function(userId) {
        if($scope.btnUserPressed){
            $scope.btnUserPressed = false;
            $scope.tripDeleteUser(userId);
            $scope.buttonUserTxt = "Delete trip";
        } else {
            $scope.btnUserPressed = true;
            $scope.buttonUserTxt = "Are you sure?";
        }
    };

    // Deletes a trip (and the logged user as a participant with cakephp3)
    $scope.deleteTrip = function(tripId) {
        $http
            .delete('Trips/delete/' + tripId)
            .success(function() {
                $scope.loadTrips();
            }).error(function() {
            console.log("Something went wrong during save Trip");
        });
    };

    // get the users of the trip
    $scope.getTripUsers = function(tripId) {
        $http
            .get('trips/'+tripId+'.json')
            .success(function(data) {
                $scope.trips.trip=data.trip;
            }).error(function() {
            console.log("Something went wrong during load Trip");
        });
    };

    // delete a user from a trip
    var secondPress = false;
    $scope.tripDeleteUser = function(userId) {
        console.log("secondPress = " + secondPress);
        if (secondPress===false) {
            $('#tripDeleteUser-'+userId).addClass("btn-danger").removeClass("btn-default");
            $('#tripDeleteUser-'+userId).text('Are you sure?');
            secondPress = true;
            return;
        }
        if (secondPress===true) {
            $http
                .delete('TripsUsers/delete/'+userId+'.json')
                .success(function() {
                    // TODO: We should also remove the deleted user as participant of any action of the current trip
                    $('#tripDeleteUser').addClass("btn-default").removeClass("btn-danger");
                    $('#tripDeleteUser-'+userId).parent().css( "opacity", "0.2" );
                    $('#tripDeleteUser-'+userId).text('Deleted');
                    secondPress=false;
                }).error(function() {
                console.log("Something went wrong during delete tripCurrentUser");
            });
        }


    };

    // check if a user exist
    $scope.userToGet = {};
    $scope.tripCheckUser = function() {
        $http
            .post('Users/getUserFromEmail.json', $scope.userToGet)
            .success(function(data) {
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
        // Do not add yourself as trip participant (by default, the current user is already in the trip)
        if ($scope.currentUserId != $userId){
            $http
                .post('TripsUsers/add.json', $scope.tripUserToAdd)
                .success(function() {
                    $('.modal.fade.in .form-message').text("This user has been added to the current trip");
                    $scope.getTripUsers($tripId);
                    $scope.tripUserToAdd = {};
                }).error(function() {
                console.log("Something went wrong during add trip for User " + id);
            });
        } else {
            $('.modal.fade.in .form-message').text("You already are part of the trip... ");
        }
    };
});


// ---------------
// ActionCtrl deals participants to a trip or an action (Page trips -> Settings)
// ---------------
as.controller('ActionCtrl', function($scope, $rootScope, $http) {
    $scope.addAction = function($trip_id) {
        // Validation process:
        // TYPE_ID
        if (!$("ul#type-id li.active").val()){
            $("html, body").animate({scrollTop: $("#chooseType").offset().top - 120}, "slow", function () {
                $("#chooseType").addClass("alert alert-danger");
            });
            return false;
        } else {
            $("#chooseType").removeClass("alert alert-danger");
        }
        // NAME
        if (!$("#name").val()){
            $("html, body").animate({scrollTop: $("#name").offset().top - 120}, "slow", function () {
                $("#name").parents(".form-group").addClass("has-error alert alert-danger");
            });
            return false;
        } else {
            $("#name").parents(".form-group").removeClass("alert alert-danger");
        }

        var participants = [];
        $("#participants input[type='checkbox']:checked").each(function() {
            participants.push($(this).attr('data-id'));
        });

        var $startTime = '';
        var $endTime = '';
        // Start time
        if ($("#start_time").val()) {
            // if time is set, we add the seconds in order to save it in the correct format in cake HH:mm:ss
            $startTime = " " + $("#start_time").val() + ":00";
        } else if ($("#start_date").val()) {
            // if time is not set, we define it at 12:00:01
            $startTime = " 12:00:01";
        }
        // End time
        if ($("#end_time").val()) {
            $endTime = " " + $("#end_time").val() + ":00";
        } else if ($("#end_date").val()) {
            // if time is not set, we define it at 12:00:01
            $endTime = " 12:00:01";
        }

        $scope.action.status = 1;
        $scope.action.type_id = $("ul#type-id li.active").val();
        $scope.action.start_date = $("#start_date").val() + $startTime;

        // If there is a start_date and an end_time, we suppose that it's the same day and the start_day
        if (!$("#end_date").val() && $("#end_time").val()) {
            $scope.action.end_date = $("#start_date").val() + $endTime;
        } else {
            $scope.action.end_date = $("#end_date").val() + $endTime;
        }
        $scope.action.start_name = $("#start-name").val();
        $scope.action.start_lng = $("#start-lng").val();
        $scope.action.start_lat = $("#start-lat").val();
        $scope.action.end_name = $("#end-name").val();
        $scope.action.end_lng = $("#end-lng").val();
        $scope.action.end_lat = $("#end-lat").val();
        $scope.action.currency = $("#actionCurrency").text();
        if ($("#action-status").text()){
            $scope.action.status = $("#action-status").text();
        } else if (!$scope.action.price) {
            $scope.action.status = 1;
        } else {
            $scope.action.status = 2;
        }

        $scope.action.action_users = participants;
        $http
            .post('Actions/add/'+$trip_id, $scope.action)
            .success(function() {
                document.location = 'actions/plan/' + $trip_id;
            }).error(function() {
            console.log("Something went wrong during add Action");
        });
    };


    $scope.editAction = function($trip_id,$action_id) {
        // NAME
        if (!$("#name").val()){
            $("html, body").animate({scrollTop: $("#name").offset().top - 120}, "slow", function () {
                $("#name").parents(".form-group").addClass("has-error");
            });
            return false;
        }
        // Add the participants that are checked and not isParticipating (added participants)
        $('#participants input:not(.isParticipating):checked').each(function () {
            var participant_id = (this.checked ? $(this).val() : "");
            $scope.actionAddUser($trip_id, $action_id, participant_id);
        });

        // delete all participants that are not checked but are isParticipating (removed participants)
        $('#participants input:not(:checked).isParticipating').each(function () {
            var participation_id = $(this).attr('data-participant');
            $scope.actionDeleteUser(participation_id);
        });

        var $startTime = '';
        var $endTime = '';
        if ($("#start_time").val()) {
            $startTime = " " + $("#start_time").val() + ":00";
        } else if ($("#start_date").val()) {
            $startTime = " 12:00:01";
        }
        if ($("#end_time").val()) {
            $endTime = " " + $("#end_time").val() + ":00";
        } else if ($("#end_date").val()) {
            $endTime = " 12:00:01";
        }
        $scope.action.type_id = $("ul#type-id li.active").val();
        $scope.action.start_date = $("#start_date").val() + $startTime;
        // If there is a start_date and an end_time, we suppose that it's the same day and the start_day
        if (!$("#end_date").val() && $("#end_time").val()) {
            $scope.action.end_date = $("#start_date").val() + $endTime;
        } else {
            $scope.action.end_date = $("#end_date").val() + $endTime;
        }
        $scope.action.start_name = $("#start-name").val();
        $scope.action.start_lng = $("#start-lng").val();
        $scope.action.start_lat = $("#start-lat").val();
        $scope.action.end_name = $("#end-name").val();
        $scope.action.end_lng = $("#end-lng").val();
        $scope.action.end_lat = $("#end-lat").val();
        $scope.action.currency = $("#actionCurrency").text();
        $scope.action.trip = ''; // reset users (we don't want to update the trip)
        $scope.action.type = ''; // reset type (otherwise it deletes all users of the current trip)
        $scope.action.users = ''; // reset users (otherwise it deletes all users of the current trip)
        $scope.action.payments = ''; // reset users (otherwise it deletes all users of the current trip)
        $http
            .post('Actions/edit/' + $action_id, $scope.action)
            .success(function() {
                $scope.actionListPayments($action_id)
                .then(function() {
                    document.location = 'actions/plan/' + $trip_id;
                });
            }).error(function() {
            console.log("Something went wrong during edit Action");
        });

    };

    // Deletes an action (and the participants of this action with cakephp3)
    $scope.deleteAction = function($trip_id,action_id) {
        $http
            .delete('Actions/delete/' + action_id)
            .success(function() {
                document.location = 'actions/plan/' + $trip_id;
            }).error(function() {
            console.log("Something went wrong during delete Action");
        });
    };

    $scope.actionDeleteUser = function($participation_id) {
        $http
            .delete('actions-users/delete/'+$participation_id)
            .success(function() {
            }).error(function() {
            console.log("Something went wrong during delete action for User " + $participation_id);
        });
    };

    // Add a user to an action
    // TODO: do not allow to add a user twice
    $scope.actionAddUser = function($tripId, $actionId, $userId) {
        $scope.actionUserToAdd = {
            action_id : $actionId,
            user_id : $userId
        };

        $http
            .post('actions-users/add.json', $scope.actionUserToAdd)
            .success(function() {
                $scope.actionUserToAdd = {};
                // $scope.actionListParticipants($tripId, $actionId);
            }).error(function() {
            console.log("Something went wrong during add action for User " + $userId);
        });

    };

    $scope.selectAllUsers = function() {
        $('#participants input').prop('checked', true);
    };

    $scope.selectOnlyMe = function() {
        $('#participants label:not(.hidden) input').prop('checked', false);
    };

    $scope.actionListPayments = function($actionId) {
        return $http
            .get('actions/view/'+$actionId+'.json')
            .success(function(data) {
                $scope.action=data.action;
                $scope.action.payments.totalAll=0;
                $scope.action.payments.totalAuth=0;
                $scope.action.payments.forEach(function(payment) {
                    if (payment.user_id == $scope.currentUserId) {
                        $scope.action.payments.totalAuth += payment.amount;
                    }
                    $scope.action.payments.totalAll += payment.amount;
                });
                $scope.updateStatus($actionId);
            }).error(function() {
            console.log("Something went wrong during load Payments");
        });
    };

    // Update the status of the action: 0=not defined / 1 = nothing paid / 2 = partially paid / 3 = All paid / 4 = overpaid
    $scope.updateStatus = function ($actionId) {
        $scope.action.status = 0;
        if($scope.action.payments.totalAll === 0) {
            $scope.action.status = 2; /* nothing paid (red) */
        } else if ($scope.action.payments.totalAll == $scope.action.price) {
            $scope.action.status = 4;  /* All paid (green) */
        } else if ($scope.action.payments.totalAll > $scope.action.price || !$scope.action.price) {
            $scope.action.status = 5; /* Over paid (grey) */
        } else {
            $scope.action.status = 3; /* Partially paid (orange) */
        }
        if ($scope.action.price === null) {
            $scope.action.status = 1; /* not defined (blue) */
        }
        $scope.actionStatusUpdate = {
            status : $scope.action.status
        };
        if ($actionId) {
            $http
                .post('actions/edit/'+$actionId+'.json', $scope.actionStatusUpdate)
                .success(function() {
                    $scope.actionStatusUpdate = {};
                }).error(function() {
                console.log("Something went wrong during update status");
            });
        }
    };

    $scope.actionDeletePayment = function($paymentId, $actionId) {
        $http
            .delete('Payments/delete/'+$paymentId+'.json')
            .success(function() {
                $scope.actionListPayments($actionId);
            }).error(function() {
            console.log("Something went wrong during delete payment");
        });
    };

    var tempPayments = [];
    $scope.actionPaymentToAdd = {};
    var sumPayments = 0;
    $scope.actionAddTempPayment = function($userId) {
        $scope.actionPaymentToAdd.currency = $("#paymentCurrency").text();
        if ($('#datePayment').val()) {
            $scope.actionPaymentToAdd.date = $('#datePayment').val()+' 12:00:00';
        }
        var tempPayment = {
            user_id: $userId,
            amount: $scope.actionPaymentToAdd.amount,
            currency: $scope.actionPaymentToAdd.currency,
            method_id: $scope.actionPaymentToAdd.method_id,
            date: $scope.actionPaymentToAdd.date
        };

        sumPayments = sumPayments + Number($scope.actionPaymentToAdd.amount);
        tempPayments.push(tempPayment);
        $scope.action.payments = tempPayments;
        $scope.action.payments.totalAll=sumPayments;
        $scope.updateStatus();
    };

    // Delete payment within an action
    // TODO: do not allow to pay more than the total?
    $scope.actionAddPayment = function($actionId, $userId) {
        $scope.actionPaymentToAdd = {};
        $scope.actionPaymentToAdd.amount = $('#paymentAmount').val();
        $scope.actionPaymentToAdd.currency = $('#paymentCurrency').text();
        if ($('#datePayment').val()) {
            $scope.actionPaymentToAdd.date = $('#datePayment').val()+' 12:00:00';
        }
        $scope.actionPaymentToAdd.method_id = $('#method_id :selected').val();
        $scope.actionPaymentToAdd.action_id = $actionId;
        $scope.actionPaymentToAdd.user_id = $userId;
        $http
            .post('Payments/add.json', $scope.actionPaymentToAdd)
            .success(function() {
                $scope.actionPaymentToAdd = {};
                $scope.actionListPayments($actionId);
            }).error(function() {
            console.log("Something went wrong during add payment to action " + $actionId);
        });
    };

    // TO FINISH IMPLEMENT (btn 'I pay all')
    $scope.actionPayAll = function($actionId,$userId) {
        $scope.actionPaymentToAdd.amount = $scope.action.price;
        $scope.actionPaymentToAdd.currency = $scope.action.currency;
        var today = new Date().toISOString().slice(0,10) + ' 12:00:00';
        $scope.actionPaymentToAdd.date = today;
        $scope.actionPaymentToAdd.action_id = $actionId;
        $scope.actionPaymentToAdd.user_id = $userId;
        $http
            .post('Payments/add.json', $scope.actionPaymentToAdd)
            .success(function() {
                $scope.actionPaymentToAdd = {};
                $scope.actionListPayments($actionId);
            }).error(function() {
            console.log("Something went wrong during add payment to action " + $actionId);
        });
    };

    // Update payment within an action (Update payment)
    $scope.actionPaymentToEdit = {};
    $scope.actionSavePayment = function($actionId, $userId, $paymentId) {
        if ($paymentId){
            $scope.actionUpdatePayment($actionId,$paymentId);
        } else {
            $scope.action.payments={};
            $scope.actionAddPayment($actionId,$userId);
        }
    };

    $scope.actionEditPayment = function($paymentId) {
        $scope.totalPaid = $("#totalPaid").text();
        if ($paymentId) {
            $http.get('Payments/view/'+$paymentId+'.json')
                .success(function(data) {
                    $scope.actionPaymentToAdd = data.payment;
                    $scope.actionPaymentToAdd.payment_id = $paymentId;
                }).error(function() {
                console.log("Something went wrong Edit Payment");
            });
        } else {
            $scope.actionPaymentToAdd={};
            $scope.actionPaymentToAdd.amount = $scope.action.price - $scope.totalPaid;
        }
    };

    $scope.actionUpdatePayment = function($actionId,$paymentId) {
        // Clean actionPaymentToAdd, otherwise it does not save:
        $scope.actionPaymentToAdd.user = '';
        $scope.actionPaymentToAdd.action = '';
        $scope.actionPaymentToAdd.payment_id = '';
        $scope.actionPaymentToAdd.method = '';
        $scope.actionPaymentToAdd.method_id = $("#method_id option:selected").val();
        $scope.actionPaymentToAdd.currency = $('#paymentCurrency').text();
        if ($('#datePayment').val()) {
            $scope.actionPaymentToAdd.date = $('#datePayment').val()+' 12:00:00';
        }
        $http
            .post('Payments/edit/'+$paymentId, $scope.actionPaymentToAdd)
            .success(function() {
                $scope.actionListPayments($actionId);
                $scope.updateStatus();
            }).error(function() {
            console.log("Something went wrong during update Payment");
        });
    };

});


