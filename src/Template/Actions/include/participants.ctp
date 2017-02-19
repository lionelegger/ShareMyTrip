<div class="row">
    <div class="col-md-4">
        <div class="box clearfix">
            <h2>Share</h2>
            <p class="help-block">Other participants that share this action with me</p>
            <div class="col-md-6">
                <div class="checkbox" id="participants">

                    <?php

                    if(!$edit):
                        foreach($trip->users as $user) {
                            if ($user->id == $userSession['id']) {
                                echo ("<label class='col-md-12 hidden'>");
                            } else {
                                echo ("<label class='col-md-12'>");
                            }

                            echo ("<input type='checkbox' ng-checked='true' data-id='".$user->id."'>");
                            echo($user->first_name);
                            echo ("</label>");
                        };
                    endif;

                    if($edit):
                        foreach ($action->trip->users as $tripUser):
                            $participatingId = false;
                            if ($tripUser->id == $userSession['id']) {
                                echo ("<label class='col-md-12 hidden'>");
                            } else {
                                echo ("<label class='col-md-12'>");
                            }
                            foreach ($action->users as $user):
                                if ($user['id'] == $tripUser['id']) {
                                    $participatingId = $user->_joinData->id;
//                                    $participatingId = true;
                                }
                            endforeach;
                            if ($participatingId) {
                                echo ("<input type='checkbox' class='isParticipating' ng-checked='".$participatingId."' value='".$tripUser->id."' data-participant='".$participatingId."' ng-model='users[".$tripUser->id."]'>");
                            } else {
                                echo ("<input type='checkbox' value='".$tripUser->id."' ng-model='users[".$tripUser->id."]'>");
                            }
                            echo ($tripUser->first_name);
                            echo ("</label>");
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <button class="btn btn-default" id="selectAllUsers" ng-click="selectAllUsers()">Select all</button>
                <button class="btn btn-default" id="selectOnlyMe" ng-click="selectOnlyMe()">Only me</button>
               <!-- <div class="checkbox">
                    <label class="col-md-12">
                        <input type="checkbox" ng-model="private"> Private
                    </label>
                </div>-->
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box">
            <div class="row">
                <div class="col-md-12">
                    <h2>Budget</h2>
                </div>
                <div class="col-md-5">
                    <h3>Price</h3>
                    <div class="input-group">
                        <input type="text" class="form-control" aria-label="..." id="price" ng-model="action.price">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CHF <span class="caret"></span></button>
                            <!-- TODO: Currency is not working -->
                            <ul class="dropdown-menu dropdown-menu-right" ng-model="action.currency">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">EUR</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">XXX</a></li>
                                <li><a href="#">YYY</a></li>
                            </ul>
                        </div><!-- /btn-group -->
                    </div><!-- /input-group -->
                    <p class="help-block">Please define the price for all persons that share this action</p>

                </div>
                <div class="col-md-6 col-md-offset-1">
                    <?php include_once("payments.ctp") ?>
                </div>
            </div>
        </div>
    </div>
</div>




<!--TODO: Use a cakePHP ActionsCtrl controller that build the list of participants to an action-->
<!--<div class="box" ng-init="actionListParticipants(tripId, actionId);">
    <h4>Participants to this action</h4>
    <div class="row">
        <div class="col-md-9">
            <div class="btn-toolbar">
                <div ng-repeat="user in trips.trip.users">
                    <button style="margin-right: 6px;" role="button" id="user-{{user.id}}" class="btn btn-default" ng-click="actionAddUser(tripId,actionId,user.id)">{{user.first_name}}</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <button role="button" class="btn btn-primary" ng-click="actionAddAllUsers(actionId)">Add all</button>
            <button role="button" class="btn btn-danger" ng-click="actionDeleteAllUsers(actionId)">Only me</button>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
</div>
-->


