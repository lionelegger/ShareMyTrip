<div class="row">
    <?php
//    Hide participants block when travelling alone...
    if (count($trip->users) >= 2) {
        echo "<div class='col-md-4'>";
    } else {
        echo "<div class='col-md-4 hidden'>";
    }
    ?>
        <div class="box clearfix">
            <div class="box-header color-lightgrey">
                <h2 class="modal-title">Share</h2>
                <h4 class="help-block">Participants that share this action with me</h4>
<!--                <h4 class="help-block">{{action.users.length -1}} Participants that share this action with me</h4>-->
            </div>
            <div class="row row-no-padding">
                <div class="col-md-12">
                    <div class="checkbox avatar-list" id="participants">
                        <?php

                        if(!$edit):
                            foreach($trip->users as $user) {

                                if ($user->id == $userSession['id']) {
                                    echo ("<label class='col-md-12 hidden checkbox-inside'>");
                                } else {
                                    echo ("<label class='col-md-12 checkbox-inside'>");
                                }
                                echo ("<div class='avatar label-right clearfix'>");
                                echo ("     <input type='checkbox' ng-checked='true' data-id='".$user->id."'>");
                                if ($user->photo){
                                    echo ("    <img src='".$user->photo_dir."/".$user->photo."' class='avatar-img circle'/>");
                                } else {
                                    echo ("    <img src='files/Users/avatars/avatar-".$user->avatar.".png' class='avatar-img'/>");
                                }
                                echo ("    <div class='avatar-name'>".$user->first_name." ".$user->last_name."</div>");
                                echo ("</div>");
                                echo ("</label>");
                            };
                        endif;

                        if($edit):
                            foreach ($action->trip->users as $tripUser):
                                $participatingId = false;
                                if ($tripUser->id == $userSession['id']) {
                                    echo ("<label class='col-md-12 hidden checkbox-inside'>");
                                } else {
                                    echo ("<label class='col-md-12 checkbox-inside'>");
                                }
                                foreach ($action->users as $user):
                                    if ($user['id'] == $tripUser['id']) {
                                        $participatingId = $user->_joinData->id;
                                    }
                                endforeach;

                                echo ("<div class='avatar label-right clearfix'>");
                                if ($participatingId) {
                                    echo ("<input type='checkbox' class='isParticipating' ng-checked='".$participatingId."' value='".$tripUser->id."' data-participant='".$participatingId."' ng-model='users[".$tripUser->id."]'>");
                                } else {
                                    echo ("<input type='checkbox' value='".$tripUser->id."' ng-model='users[".$tripUser->id."]'>");
                                }
                                if ($tripUser->photo){
                                    echo ("    <img src='".$tripUser->photo_dir."/".$tripUser->photo."' class='avatar-img circle'/>");
                                } else {
                                    echo ("    <img src='files/Users/avatars/avatar-".$tripUser->avatar.".png' class='avatar-img'/>");
                                }
                                echo ("    <div class='avatar-name'>".$tripUser->first_name." ".$tripUser->last_name."</div>");
                                echo ("</div>");


    //                            echo ($tripUser->first_name);
                                echo ("</label>");
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            <div class="box-footer text-right">
                <button class="btn btn-default" id="selectAllUsers" ng-click="selectAllUsers()">Select all</button>
                <button class="btn btn-default" id="selectOnlyMe" ng-click="selectOnlyMe()">Only me</button>
            </div>
        </div>
    </div>

    <?php
        if (count($trip->users) >= 2) {
            echo ("<div class='col-md-8'>");
        } else {
            echo ("<div class='col-md-12'>");
        }
    ?>
        <div class="box">
            <div class="box-header color-lightgrey clearfix">
                <h2 class="modal-title pull-left">Expenses</h2>
                <div ng-if="action.status == 2" class="text-danger pull-right">
                    <h4><span class="glyphicon glyphicon-ban-circle"></span> <strong>Nothing paid!</strong></h4>
                    <div>{{action.price - action.payments.totalAll}} {{action.currency}} still needs to be paid</div>
                    <span class="hidden" id="action-status">2</span>
                </div>
                <div ng-if="action.status == 3" class="text-warning pull-right">
                    <h4><span class="glyphicon glyphicon-record"></span> <strong>Partially paid!</strong></h4>
                    <div>{{action.price - action.payments.totalAll}} {{action.currency}} still needs to be paid</div>
                    <span class="hidden" id="action-status">3</span>
                </div>
                <div ng-if="action.status == 4" class="text-success pull-right">
                    <h4><span class="glyphicon glyphicon-ok-circle"></span> <strong>All paid!</strong></h4>
                    <span class="hidden" id="action-status">4</span>
                </div>
                <div ng-if="action.status == 5" class="text-muted pull-right">
                    <h4><span class="glyphicon glyphicon-exclamation-sign"></span> <strong>Overpaid!</strong></h4>
                    <div>{{-(action.price - action.payments.totalAll)}} {{action.currency}} have been overpaid</div>
                    <span class="hidden" id="action-status">5</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <h3>Price</h3>
                    <h4 class="help-block">Price for all participants that share this action</h4>
                    <div class="input-group">
                        <input type="text" class="form-control input-lg" aria-label="..." id="price" ng-model="action.price">
                        <div class="input-group-btn">
                            <button type="button" id="actionCurrency" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ng-init="action.currency = '<?=$trip->currency?>'">{{action.currency}}<i class="arrow down"></i></button>
                            <!-- TODO: Currency is not working -->
                            <ul class="dropdown-menu dropdown-menu-right" >
                                <li><a href="javascript:void(0)">USD</a></li>
                                <li><a href="javascript:void(0)">EUR</a></li>
                                <li><a href="javascript:void(0)">CHF</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="javascript:void(0)">$</a></li>
                            </ul>
                        </div><!-- /btn-group -->
                    </div><!-- /input-group -->
<!--                    <p class="help-block" ng-hide="!action.price">which means that each {{action.users.length}} participant will pay {{action.price / action.users.length}} {{action.currency}}</p>-->
                </div>
                <hr class="visible-sm">
                <div class="col-md-6 col-md-offset-1">
                    <?php include_once("payments.ctp") ?>
                </div>
            </div>

            <!--<div class="box-footer status-{{action.status}} text-right" ng-hide="!action.price || action.price==action.payments.totalAll">
                <h3>{{action.price - action.payments.totalAll}} {{action.currency}} still needs to be paid&nbsp;<span class="glyphicon glyphicon-upload"></span></h3>
            </div>-->
        </div>
    </div>
</div>





