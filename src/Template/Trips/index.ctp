<? $this->Html->addCrumb('Trips'); ?>
<!--
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?/*= __('Actions') */?></li>
        <li><?/*= $this->Html->link(__('New Trip'), ['action' => 'add']) */?></li>
        <li><?/*= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) */?></li>
        <li><?/*= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) */?></li>
        <li><?/*= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) */?></li>
        <li><?/*= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) */?></li>
    </ul>
</nav>
-->


<div ng-controller="TripsCtrl">

    <h1>My trips
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" ng-click="editTrip(0)" data-target="#tripEdit">
            <span class="glyphicon glyphicon-plus"></span> Add a trip
        </button>
    </h1>

    <!-- START MODAL -->
    <div class="modal fade" tabindex="-1" role="dialog" id="tripEdit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" ng-if="!trip.id">Add a trip {{trip.id}}</h2>
                    <h2 class="modal-title" ng-if="trip.id">Edit {{trip.name}} ({{trip.id}})</h2>
                </div>

                <form class="form-horizontal" method="post" accept-charset="utf-8">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tripName" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="tripName" placeholder="Trip Name" ng-model="trip.name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="tripNameBTN" ng-if="!trip.id">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" ng-click="addTrip()" data-toggle="collapse" href="#collapseParticipation" aria-expanded="false" aria-controls="collapseExample">Save</button>
                    </div>
                    <div class="collapse" id="collapseParticipation">
                        <!-- collapsing div for trip participation -->
                        <div id="tripParticipants-{{trip.id}}">
                            <div class="hidden" id="tripId">{{trip.id}}</div>
                            <h4 class="modal-body">Friends that share this trip</h4>
                            <form class="form-horizontal" method="post" accept-charset="utf-8">
                                <div class="modal-body">
                                    <div class="form-group" ng-repeat="user in trips.trip.users" id="tripUser-{{user._joinData.id}}" ng-hide="currentUserId == user.id" >
                                        <label class="col-sm-9 text-right control-label">{{user.first_name}}</label>
                                        <button type="button" id="tripDeleteUser-{{user._joinData.id}}" class="btn btn-danger col-sm-2" ng-click="tripDeleteUser(user._joinData.id)">Delete {{user._joinData.id}}</button>
                                    </div>
                                </div>
                            </form>
                            <form class="form-horizontal" method="post" accept-charset="utf-8">
                                <div class="modal-body">
                                    <div class="form-group" id="tripAddUser-form">
                                        <label for="email" class="col-sm-2 control-label">email</label>
                                        <div class="col-sm-7">
                                            <input class="form-control" id="email" placeholder="Enter friend's email address" ng-model="userToGet.email">
                                        </div>
                                        <button type="button" id="tripAddUser" class="btn btn-default col-sm-2" ng-click="tripCheckUser()">Add</button>
                                    </div>
                                    <div class="form-message col-md-offset-2 text-info"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" ng-click="deleteTrip(trip.id)" data-dismiss="modal">Delete Trip</button>
                                    <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success" ng-click="saveTrip(trip.id)" data-dismiss="modal">Save</button>
                                </div>
                            </form>
                        </div><!-- /.collapse -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- END MODAL -->

    <div class="box" ng-repeat="trip in trips">
        <div class="row">
            <div class="trip clearfix">
                <div class="col-md-12 mainContent">
                    <h2 class="trip-title"><a href="actions/plan/{{trip.id}}">{{trip.name}}</a></h2>

                    <ul class="list-inline pull-right">
                        <li ng-repeat="user in trip.users" ng-hide="currentUserId == user.id"><span class="label label-default" >{{user.first_name}}</span></li>
                    </ul>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#tripEdit" ng-click="editTrip(trip.id)">
                        <span class="glyphicon glyphicon-cog"></span> Trip settings
                    </button>
                    <div class="clearfix">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>
