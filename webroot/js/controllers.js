// ---------------
// Main Ctrl
// ---------------
as = angular.module('myApp', ['ngRoute']);

as.controller('MainCtrl', function($scope, $http, $location, $window) {

    console.log('call MainCtrl');
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
            }).error(function (data) {
            $scope.currentUserId = 'user undefined';
        });
    };
    $scope.getCurrentUser();

    // to logout
    $scope.logout = function(){
        $http.get('Users/logout');
        console.log("call logout");
    };

    // Add user (Registration)
    $scope.userToAdd = {};
    $scope.addUser = function() {

        $http
            .post('Users/add', $scope.userToAdd)
            .success(function() {
                console.log($scope.userToAdd);
                //$scope.loadTrips();
                $scope.userToAdd = {};
                // $window.location.reload();
                document.location = 'trips';
            }).error(function() {
                console.log($scope.userToAdd);
            console.log("Something went wrong during user registration");
        });
    };

    // Edit user (with image)

    $scope.loadUser = function() {
        $scope.currentUser = {};
        console.log("ID= " + $scope.currentUserId);
        $scope.currentUser.email = $scope.currentUserEmail;
        $scope.currentUser.first_name = $scope.currentUserFirstname;
        $scope.currentUser.last_name = $scope.currentUserLastname;
    };


});

// ---------------
// TripsCtrl lists the trips
// ---------------
as.controller('TripsCtrl', function($scope, $rootScope, $http) {
    // Load the list of trips for the logged user
    console.log('call TripsCtrl');
    $scope.loadTrips = function() {
        console.log('call loadTrips');
        $http.get('trips.json')
            .success(function(data) {
                $scope.trips = data.trips;
                console.log($scope.trips);
                // dismiss the modal (that does not close on trips page)
                $(".modal-backdrop").hide();
            }).error(function() {
            console.log("Something went wrong during load Trips");
        });
    };
    $scope.loadTrips();

    $scope.loadTrip = function(tripId) {
        console.log('call loadTrip');
        $http.get('trips/'+tripId+'.json')
            .success(function(data) {
                $scope.trip = data.trip;
                console.log($scope.trip);
            }).error(function() {
            console.log("Something went wrong during load Trip");
        });
    };

    // adds a trip (and the logged user as a participant with cakephp3)
    $scope.addTrip = function() {
        console.log('call addTrip');

        $scope.tripToAdd={};
        $scope.welcomeMsg=false;
        $scope.tripToAdd.name = $("#add_tripName").val();
        $scope.tripToAdd.date_start = $("#add_date_start").val();
        $scope.tripToAdd.date_end = $("#add_date_end").val();
        $scope.tripToAdd.currency = $("#add_currency option:selected").val();
        console.log("SELECTED="+$scope.tripToAdd.currency);
        $http
            .post('Trips/add.json', $scope.tripToAdd)
            .success(function(data) {
                // $scope.loadTrips();
                console.log(data.tripToAdd);
                $scope.tripToAdd = data.tripToAdd;
                $scope.loadTrips();
                // $scope.getTripUsers(data.trip.id);
            }).error(function() {
            console.log("Something went wrong during add Trip");
        });
    };

    $scope.editTrip = function(tripId) {
        console.log("TRIPID="+tripId);
        $scope.btnPressed=false;
        $scope.buttonTxt = "Delete";
        console.log('call editTrip with trip ' + tripId);
        $('.modal .form-message').empty();
        if (tripId){
            // $('#collapseParticipation').collapse('show');
            $scope.loadTrip(tripId);
            // console.log("currency value is " + $scope.trip.currency);
            // $scope.getTripUsers(tripId);
        } else {
            $scope.trip={};
            $scope.trips.trip={};
            // $('#collapseParticipation').collapse('hide');
            // $scope.addTrip();
        }
    };

    $scope.editParticipants = function(tripId) {
        $scope.loadTrip(tripId);
        $scope.getTripUsers(tripId);
    };

    // $scope.trip = {};
    $scope.saveTrip = function(tripId) {
        console.log('call saveTrip with trip ' + tripId);
        $scope.trip.date_start = $("#date_start").val();
        $scope.trip.date_end = $("#date_end").val();
        $scope.trip.currency = $("#currency option:selected").val();
        console.log("CURRENCY:" + $scope.trip.currency);
        $http
            .post('Trips/edit/' + tripId, $scope.trip)
            .success(function() {
                console.log("trip "+tripId+" saved!");
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

    // Deletes a trip (and the logged user as a participant with cakephp3)
    $scope.deleteTrip = function(tripId) {
        $http
            .delete('Trips/delete/' + tripId)
            .success(function() {
                console.log("Delete trip " + tripId);
                $scope.loadTrips();
            }).error(function() {
            console.log("Something went wrong during save Trip");
        });
    };

    // get the users of the trip
    $scope.getTripUsers = function(tripId) {
        console.log('call getTripUsers');
        $http
            .get('trips/'+tripId+'.json')
            .success(function(data) {
                console.log(data);
                $scope.trips.trip=data.trip;
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
                // TODO: We should also remove the deleted user as participant of any action of the current trip
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
                console.log(data.user);

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
            console.log('call tripAddUser for user ' + $userId + " and trip " + $tripId);
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
    console.log('call ActionCtrl');

    $scope.addAction = function($trip_id) {
        console.log('call addAction');

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
                $("#name").parents(".form-group").addClass("has-error");
            });
            return false;
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
        $scope.action.action_users = participants;
        // $scope.action.payments = '';

        $http
            .post('Actions/add/'+$trip_id, $scope.action)
            .success(function() {
                console.log($scope.action);

                console.log("Action " + $scope.action.name + " added...");
                document.location = 'actions/plan/' + $trip_id;

            }).error(function() {
            console.log("Something went wrong during add Action");
        });
    };


    $scope.editAction = function($trip_id,$action_id) {
        console.log('call editAction for action '+ $action_id + ' and trip ' + $trip_id);
        // NAME
        if (!$("#name").val()){
            $("html, body").animate({scrollTop: $("#name").offset().top - 120}, "slow", function () {
                $("#name").parents(".form-group").addClass("has-error");
            });
            return false;
        }

        // var participants = $("#participants :checked").val();

        // Add the participants that are checked and not isParticipating (added participants)
        $('#participants input:not(.isParticipating):checked').each(function () {
            var participant_id = (this.checked ? $(this).val() : "");
            console.log("It will add participation_id = "+participant_id);
            $scope.actionAddUser($trip_id, $action_id, participant_id);
        });

        // delete all participants that are not checked but are isParticipating (removed participants)
        $('#participants input:not(:checked).isParticipating').each(function () {
            var participation_id = $(this).attr('data-participant');
            console.log("It will delete participation_id = "+participation_id);
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

        console.log("--ID--");
        console.log($scope.action.type_id);

        $http
            .post('Actions/edit/' + $action_id, $scope.action)
            .success(function() {
                console.log($scope.action);
                console.log("Action "+$action_id+" saved!");
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
                console.log("Delete Action " + action_id);
                document.location = 'actions/plan/' + $trip_id;
            }).error(function() {
            console.log("Something went wrong during delete Action");
        });
    };

    $scope.actionDeleteUser = function($participation_id) {
        console.log('call deleteActionUser for: user ' + $participation_id);
        $http
            .delete('actions-users/delete/'+$participation_id)
            .success(function() {
                console.log("Participant "+$participation_id+" has been removed!");
            }).error(function() {
            console.log("Something went wrong during delete action for User " + $participation_id);
        });
    };

    // Add a user to an action
    // TODO: do not allow to add a user twice
    $scope.actionAddUser = function($tripId, $actionId, $userId) {
        console.log('call actionAddUser for: user ' + $userId + ", action " + $actionId + ", trip " + $tripId);
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

    // Delete all participants of the current trip (except authentified user)
    $scope.actionDeleteAllUsers = function($actionId) {
        console.log("call actionDeleteAllUsers for action " + $actionId);
        $http
            .get('actions/view/'+$actionId+'.json')
            .success(function(data) {
                $scope.actions.action.users.forEach(function(user) {
                    // We do not delete the authentified user
                    if (user.id != $scope.currentUserId) {
                        $deleteId = $("#user-"+user.id).attr('deleteId');
                        $http
                            .delete('actions-users/delete/'+$deleteId+'.json')
                            .success(function() {
                                $scope.actionListParticipants($scope.actions.action.trip.id, $actionId);
                                $("#user-"+$userId).removeClass("btn-success");
                                console.log("Participant has been removed!");
                            }).error(function() {
                            console.log("Something went wrong during add action for User " + id);
                        });
                    } else {
                        $("#user-"+$userId+" span.glyphicon.glyphicon-ok").remove();
                    }
                });
            }).error(function() {
            console.log("Something went wrong during add all users for the current action");
        });
    };

    $scope.selectAllUsers = function() {
        console.log("Select all users as participants...");
        $('#participants input').prop('checked', true);
    };

    $scope.selectOnlyMe = function() {
        console.log("Deselect all users except me...");
        $('#participants label:not(.hidden) input').prop('checked', false);
    };


    // Add all participants of the current trip (included authentified user)
    $scope.actionAddAllUsers = function($actionId) {
        console.log("call actionAddAllUsers for action " + $actionId);
        $http
            .get('actions/view/'+$actionId+'.json')
            .success(function(data) {
                $scope.actions.action.trip.users.forEach(function(user) {
                    // We do not delete the authentified user
                    if (user.id != $scope.currentUserId) {
                        $scope.actionUserToAdd = {
                            action_id : $actionId,
                            user_id : user.id
                        };
                        $http
                            .post('actions-users/add.json', $scope.actionUserToAdd)
                            .success(function() {
                                $scope.actionUserToAdd = {};
                                $scope.actionListParticipants($scope.actions.action.trip.id, $actionId);
                            }).error(function() {
                            console.log("Something went wrong during add action for User " + id);
                        });
                    }
                });
            }).error(function() {
            console.log("Something went wrong during add all users for the current action");
        });
    };

    // Check if a user is participating to an action
    $scope.actionListParticipants = function($tripId, $actionId) {
        console.log('call actionListParticipants for action ' + $actionId + ' and trip ' + $tripId);
        $http
            .get('trips/'+$tripId+'.json')
            .success(function(data) {
                console.log(data);
                $scope.trips=data;
                $http
                    .get('actions/view/'+$actionId+'.json')
                    .success(function(data) {
                        console.log(data);
                        $scope.actions=data;
                        $scope.actions.action.users.forEach(function(element) {
                            $userId = element._joinData.user_id;
                            $deleteId = element._joinData.id;
                            console.log ('Participant id = ' + $userId);
                            $("#user-"+$userId).addClass("btn-success").attr("deleteId", $deleteId);
                        });
                    }).error(function() {
                    console.log("Something went wrong during load Action");
                });
            }).error(function() {
            console.log("Something went wrong during load Trip");
        });
    };

    $scope.actionListPayments = function($actionId) {
        console.log('call actionListPayments for action ' + $actionId);
        return $http
            .get('actions/view/'+$actionId+'.json')
            .success(function(data) {
                console.log(data);
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

                // $scope.action.payments.balance = $scope.action.price - $scope.action.payments.total;
            }).error(function() {
            console.log("Something went wrong during load Payments");
        });
    };

    // Update the status of the action: 0=not defined / 1 = nothing paid / 2 = partially paid / 3 = All paid / 4 = overpaid
    $scope.updateStatus = function ($actionId) {
        $scope.action.status = 0;
        console.log ("TOTAL => " + $scope.action.payments.totalAll);
        console.log ("PRICE => " + $scope.action.price);
        if($scope.action.payments.totalAll === 0) {
            $scope.action.status = 2; /* nothing paid (red) */
        } else if ($scope.action.payments.totalAll == $scope.action.price) {
            $scope.action.status = 4;  /* All paid (green) */
        } else if ($scope.action.payments.totalAll > $scope.action.price) {
            $scope.action.status = 5; /* Over paid (green) */
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
                    console.log("Status updated successfully");
                    $scope.actionStatusUpdate = {};
                }).error(function() {
                console.log("Something went wrong during update status");
            });
        }

    };

    $scope.actionDeletePayment = function($paymentId, $actionId) {
        console.log('call actionDeletePayment for payment ' + $paymentId);
        $http
            .delete('Payments/delete/'+$paymentId+'.json')
            .success(function() {
                console.log("Payment deleted");
                $scope.actionListPayments($actionId);
            }).error(function() {
            console.log("Something went wrong during delete payment");
        });
    };

    var tempPayments = [];
    $scope.actionPaymentToAdd = {};
    var sumPayments = 0;
    $scope.actionAddTempPayment = function($userId) {
        console.log('call actionAddPayment for user ' + $userId);
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
        console.log("sumPayments = " + sumPayments);
        tempPayments.push(tempPayment);
        $scope.action.payments = tempPayments;
        console.log($scope.action.payments);

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
        console.log("DATE="+$scope.actionPaymentToAdd.date);
        $scope.actionPaymentToAdd.action_id = $actionId;
        $scope.actionPaymentToAdd.user_id = $userId;
        console.log('call actionAddPayment for action ' + $actionId + ' and user ' + $userId);
        $http
            .post('Payments/add.json', $scope.actionPaymentToAdd)
            .success(function() {
                console.log($scope.actionPaymentToAdd);
                $scope.actionPaymentToAdd = {};
                $scope.actionListPayments($actionId);
            }).error(function() {
            console.log("Something went wrong during add payment to action " + $actionId);
        });
    };

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
                console.log($scope.actionPaymentToAdd);
                $scope.actionPaymentToAdd = {};
                $scope.actionListPayments($actionId);
            }).error(function() {
            console.log("Something went wrong during add payment to action " + $actionId);
        });
    };

    // Update payment within an action (Update payment)
    $scope.actionPaymentToEdit = {};
    $scope.actionSavePayment = function($actionId, $userId, $paymentId) {
        console.log('call actionSavePayment with payment ' + $paymentId);
        if ($paymentId){
            console.log("UPDATE PAYMENT IN DB");
            $scope.actionUpdatePayment($actionId,$paymentId);
        } else {
            $scope.action.payments={};
            $scope.actionAddPayment($actionId,$userId);
        }
    };

    $scope.actionEditPayment = function($paymentId) {
        console.log('call actionEditPayment for payment ' + $paymentId);

        $http.get('Payments/view/'+$paymentId+'.json')
            .success(function(data) {
                $scope.actionPaymentToAdd = data.payment;
                $scope.actionPaymentToAdd.payment_id = $paymentId;
                console.log($scope.actionPaymentToAdd);
            }).error(function() {
            console.log("Something went wrong Edit Payment");
        });
    };


    $scope.actionUpdatePayment = function($actionId,$paymentId) {
        console.log('call actionUpdatePayment for payment ' + $paymentId);
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
        console.log("DATE="+$scope.actionPaymentToAdd.date);
        $http
            .post('Payments/edit/'+$paymentId, $scope.actionPaymentToAdd)
            .success(function() {
                console.log ($scope.actionPaymentToAdd);
                $scope.actionListPayments($actionId);
                $scope.updateStatus();
            }).error(function() {
            console.log("Something went wrong during update Payment");
        });
    };

});


