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
                <h1 class="header-title">My trips</small></h1>
            </div>
            <div class="col-sm-4 text-right">
                <button type="button" class="btn btn-primary btn-lg btn-calltoaction" data-toggle="modal" ng-click="editTrip(0)" data-target="#tripEdit">
                    <span class="glyphicon glyphicon-plus"></span>
                    <span class="btn-text"><strong>NEW trip</strong></span>
                </button>
            </div>
        </div>
    </div>
</div>
<br>
<div ng-controller="TripsCtrl" class="container clearfix">



    <?php
        if(iterator_count($trips)==0) {
            echo ("<h1>Write a welcome message with explanations</h1>");
        }
    ?>
    <!-- START MODAL -->
    <div class="modal fade" tabindex="-1" role="dialog" id="tripEdit">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="post" accept-charset="utf-8">
                    <div class="modal-header color-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title" ng-if="!trip.id">Add a trip</h2>
                        <h2 class="modal-title" ng-if="trip.id">Edit {{trip.name}}</h2>
                        <br/>
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
                        <div class="modal-body">
                            <div id="tripParticipants-{{trip.id}}">
                                <div class="hidden" id="tripId">{{trip.id}}</div>
                                <h3 class="modal-title">Friends that share this trip</h3>
                                <form class="form" method="post" accept-charset="utf-8">
                                    <div class="row row-no-padding">
                                        <div class="avatar-list">
                                            <div class="col-md-12" ng-repeat="user in trips.trip.users" id="tripUser-{{user._joinData.id}}" ng-hide="currentUserId == user.id" >
                                                <div class="col-xs-3">
                                                    <button type="button" id="tripDeleteUser-{{user._joinData.id}}" class="btn btn-default" ng-click="tripDeleteUser(user._joinData.id)"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                                                </div>
                                                <div class="col-xs-9">
                                                    <div class="avatar label-right clearfix">
                                                        <img ng-if="!user.photo" ng-src="files/Users/avatars/avatar-{{user.avatar}}.png" class="avatar-img">
                                                        <img ng-if="user.photo" ng-src="{{user.photo_dir}}/{{user.photo}}" class="avatar-img circle">
                                                        <div class="avatar-name">{{user.first_name}} {{user.last_name}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <br/>
                                <form class="form-horizontal" method="post" accept-charset="utf-8">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <input class="form-control" id="email" placeholder="Enter friend's email address" ng-model="userToGet.email">
                                                <span class="input-group-btn">
                                                    <button type="button" id="tripAddUser" class="btn btn-default" ng-click="tripCheckUser()">Add</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-11 form-message col-md-offset-1 text-danger"></div>
                                    </div><!-- /.row -->
                                </form>
                            </div><!-- /.collapse -->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger pull-left" id="deleteTrip" ng-init="btnPressed=false" ng-click="deleteConfirm(trip.id)">{{buttonTxt}}</button>
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" ng-click="saveTrip(trip.id)" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- END MODAL -->

    <div class="row">
        <div class="col-md-6" ng-repeat="trip in trips">
            <div class="box">
                <div class="row">
                    <div class="col-md-12 trip clearfix">
                        <div class="box-header color-primary clearfix">
                            <h2 class="box-title col-md-12"><a href="actions/plan/{{trip.id}}">{{trip.name}}</a></h2>
                            <div class="users col-md-12">
                                <ul class="list-inline pull-right">
                                    <li ng-repeat="user in trip.users" ng-hide="currentUserId == user.id">
                                        <div class="avatar label-bottom">
                                            <img ng-if="!user.photo" ng-src="files/Users/avatars/avatar-{{user.avatar}}.png" class="avatar-img">
                                            <img ng-if="user.photo" ng-src="{{user.photo_dir}}{{user.photo}}" class="avatar-img circle"/>
                                            <div class="label avatar-name" >{{user.first_name}}</div>
                                        </div>
                                    </li>
                                    <!--
                                    <li>
                                        <div class="avatar label-bottom">
                                            <div class="avatar-add avatar-img"></div>
                                            <div class="label avatar-name" >Add</div>
                                        </div>
                                    </li>
                                    -->
                                </ul>
                            </div>
                            <button type="button" class="btn btn-link top-right" ng-if="currentUserId == trip.owner_id" data-toggle="modal" data-target="#tripEdit" ng-click="editTrip(trip.id)">
                                <span class="glyphicon glyphicon-cog"></span> Edit
                            </button>
                        </div>
                        <div class="mainContent">
                            <h4>2017-10-12 to 2017-10-17</h4>
                            <p>You still owe 234 CHF to Tata</p>
                            <div class="clearfix">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
