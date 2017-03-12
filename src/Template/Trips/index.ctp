<? $this->Html->addCrumb('Trips'); ?>

<?php // Navigation
$this->start('navigation');
echo $this->element('Layout/navigation', [
    "active_trips" => true,
    "disabled_plan" => true,
    "disabled_map" => true,
    "disabled_budget" => true
]);
echo $this->fetch('navigation');
$this->end();
?>

<div class="header-container color-lightgrey">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="header-title no-avatar">My trips</small></h1>
            </div>
            <div class="col-sm-4 text-right">
                <button type="button" class="btn btn-primary btn-lg btn-calltoaction" data-toggle="modal" ng-click="editTrip()" data-target="#tripAdd">
                    <span class="glyphicon glyphicon-plus"></span>
                    <span class="btn-text"><strong>Add a trip</strong></span>
                </button>
            </div>
        </div>
    </div>
</div>
<br>
<div ng-controller="TripsCtrl" class="container clearfix" ng-init="welcomeMsg=true;">
    <?php if(iterator_count($trips)==0): ?>
    <div class="welcome text-right" ng-if="welcomeMsg==true">
        <h3>Welcome {{currentUserFirstname}} !</h3>
        <p>Click on the "<strong>Add a trip</strong>" button to create your first trip.</p>
        <p>Then you can "<strong>Add friends</strong>" with whom you will share this trip.</p>
        <p>Finally, click on "<strong>Plan the trip</strong>" to add actions to your trip ...</p>
        <h4 class="help-block">Happy holidays!</h4>
    </div>
    <?php endif ?>

    <!-- START trip ADD MODAL -->
    <div class="modal fade" tabindex="-1" role="dialog" id="tripAdd">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="post" accept-charset="utf-8">
                    <div class="modal-header color-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title color-primary">Add a trip</h2>
                        <br/>
                        <div class="form-group">
                            <label for="tripName" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="add_tripName" placeholder="Trip Name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="currency" class="col-sm-3 control-label">Currency</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="add_currency" >
                                    <option value="USD" selected="selected">USD [Dollars]</option>
                                    <option value="EUR">EUR [Euros]</option>
                                    <option value="CHF">CHF [Swiss Francs]</option>
                                    <option value="$">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for="date_start" class="col-sm-3 control-label">From</label>
                            <div class="col-sm-9">
                                <div class='input-group date' id='add_datepickerStart'>
                                    <input type='text' class='form-control' id="add_date_start" placeholder='YYYY-MM-DD'/>
                                    <span class='input-group-addon'>
                                        <span class='glyphicon glyphicon-calendar'></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="date_end" class="col-sm-3 control-label">To</label>
                            <div class="col-sm-9">
                                <div class='input-group date' id='add_datepickerEnd'>
                                    <input type='text' class='form-control' id="add_date_end" placeholder='YYYY-MM-DD' />
                                    <span class='input-group-addon'>
                                        <span class='glyphicon glyphicon-calendar'></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="tripNameBTN">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" ng-click="addTrip()" data-toggle="collapse" data-dismiss="modal">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- END MODAL -->


    <!-- START trip EDIT MODAL -->
    <div class="modal fade" tabindex="-1" role="dialog" id="tripEdit">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="post" accept-charset="utf-8">
                    <div class="modal-header color-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title">Edit {{trip.name}}</h2>
                        <br/>
                        <div class="form-group">
                            <label for="tripName" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="tripName" placeholder="Trip Name" ng-model="trip.name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="currency" class="col-sm-3 control-label">Currency</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="currency" ng-model="trip.currency">
                                    <option value="USD">USD [Dollars]</option>
                                    <option value="EUR">EUR [Euros]</option>
                                    <option value="CHF">CHF [Swiss Francs]</option>
                                    <option value="$">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for="date_start" class="col-sm-3 control-label">From</label>
                            <div class="col-sm-9">
                                <div class='input-group date' id='datepickerStart'>
                                    <input type='text' class='form-control' id="date_start" placeholder='YYYY-MM-DD' ng-model="trip.date_start"/>
                                    <span class='input-group-addon'>
                                        <span class='glyphicon glyphicon-calendar'></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for="date_end" class="col-sm-3 control-label">To</label>
                            <div class="col-sm-9">
                                <div class='input-group date' id='datepickerEnd'>
                                    <input type='text' class='form-control' id="date_end" placeholder='YYYY-MM-DD' ng-model="trip.date_end"/>
                                    <span class='input-group-addon'>
                                        <span class='glyphicon glyphicon-calendar'></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="tripNameBTN">
                        <button class="btn btn-danger pull-left" id="deleteTrip" ng-init="btnPressed=false" ng-click="deleteConfirm(trip.id)">{{buttonTxt}}</button>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" ng-click="saveTrip(trip.id)" data-dismiss="modal">Save</button>
                    </div>

                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- END MODAL -->

    <!-- START PARTICIPATION MODAL -->
    <div class="modal fade" tabindex="-1" role="dialog" id="participation">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="post" accept-charset="utf-8">
                    <!-- collapsing div for trip participation -->
                    <div class="modal-header color-lightgrey">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Friends sharing this trip</h3>
                    </div>
                    <div class="modal-body">
                        <div id="tripParticipants-{{trip.id}}">
                            <div class="hidden" id="tripId">{{trip.id}}</div>
                            <form class="form" method="post" accept-charset="utf-8">
                                <div class="row row-no-padding">
                                    <div class="avatar-list">
                                        <div class="col-md-12" ng-repeat="user in trips.trip.users" id="tripUser-{{user._joinData.id}}" ng-hide="currentUserId == user.id" >
                                            <button type="button" id="tripDeleteUser-{{user._joinData.id}}" class="btn btn-default pull-left" ng-click="tripDeleteUser(user._joinData.id)"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                                            <div class="avatar label-right clearfix">
                                                <img ng-if="!user.photo" ng-src="files/Users/avatars/avatar-{{user.avatar}}.png" class="avatar-img">
                                                <img ng-if="user.photo" ng-src="{{user.photo_dir}}/{{user.photo}}" class="avatar-img circle">
                                                <div class="avatar-name">{{user.first_name}} {{user.last_name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br/>
                            <form class="form-horizontal" method="post" accept-charset="utf-8">
                                <div class="row text-right">
                                    <div class="col-xs-1">
                                        <label for="email" class="control-label text-muted"><span class="glyphicon glyphicon-plus"></span></label>
                                    </div>
                                    <div class="col-xs-10">
                                        <div class="input-group">
                                            <input class="form-control" id="email" placeholder="Enter friend's email address" ng-model="userToGet.email">
                                            <span class="input-group-btn">
                                                <button type="button" id="tripAddUser" class="btn btn-default" ng-click="tripCheckUser()">Add</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-xs-offset-1 text-left form-message text-success"></div>
                                </div><!-- /.row -->
                            </form>
                        </div><!-- /.collapse -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" ng-click="loadTrips()" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- END MODAL -->

    <div class="row">
        <div ng-repeat="trip in trips">
            <!--  to align properly every 3 trips  -->
            <div class="clearfix" ng-if="$index % 3 == 0"></div>
            <div class="col-md-4">
                <div class="box section-container">
                    <a href="actions/plan/{{trip.id}}"></a>
                    <div class="row">
                        <div class="col-md-12 trip clearfix">
                            <div class="box-header color-primary clearfix text-center">
                                <h2 class="box-title"><a href="actions/plan/{{trip.id}}">{{trip.name}}</a></h2>
                                <button type="button" class="btn btn-link top-right" ng-if="currentUserId == trip.owner_id" data-toggle="modal" data-target="#tripEdit" ng-click="editTrip(trip.id)">
                                    <span class="glyphicon glyphicon-cog"></span> Settings
                                </button>
                                <h4 class="trip-date" ng-if="trip.date_start"><span class="glyphicon glyphicon-calendar glyphicon-sm"></span> {{trip.date_start | date:'d MMMM'}} <span ng-if="trip.date_end">-</span> {{trip.date_end | date:'d MMMM'}} {{trip.date_end | date:'yyyy'}}</h4>
                            </div>
                            <div class="mainContent clearfix text-center">
                                <div class="avatar-list col-xs-12">
                                    <ul class="list-inline">
                                        <li class="with-alone text-muted"><h3 ng-if="trip.users.length>1">With</h3><!--<h3 ng-if="trip.users.length==1">Alone</h3>--></li>
                                        <li ng-repeat="user in trip.users" ng-hide="currentUserId == user.id">
                                            <div class="avatar avatar-md label-bottom">
                                                <img ng-if="!user.photo" ng-src="files/Users/avatars/avatar-{{user.avatar}}.png" class="avatar-img">
                                                <img ng-if="user.photo" ng-src="{{user.photo_dir}}{{user.photo}}" class="avatar-img circle"/>
                                                <div class="label avatar-name" >{{user.first_name}}</div>
                                            </div>
                                        </li>
                                        <li ng-hide="currentUserId != trip.owner_id">
                                            <div class="avatar avatar-md label-bottom btn-avatar">
                                                <a class="avatar-add avatar-img" data-toggle="modal" data-target="#participation" ng-click="editParticipants(trip.id)"></a>
                                                <div class="label avatar-name"><span ng-if="trip.users.length==1">Add friends</span><span ng-if="trip.users.length>1">Add/Remove</span></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!--                            <h4>This trip starts in 66 days...</h4>-->
                                <!--                            <p class="alert alert-danger"><strong>You still owe 234 CHF to Tata</strong></p>-->
                            </div>
                            <div class="box-footer text-center">
                                <a class="btn btn-lg btn-default" href="actions/plan/{{trip.id}}">Plan this trip</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row clearfix">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
