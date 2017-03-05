<div class="row">
    <?php if (count($trip->users) >= 2) :?>
        <div class="col-md-4">
            <div class="box clearfix">
                <div class="box-header color-lightgrey">
                    <h2 class="modal-title">Share</h2>
                    <p class="help-block">Other participants that share this action with me</p>
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
                                    echo ("    <img src='".$user->photo_dir."/".$user->photo."' class='avatar-img'/>");
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
                                    echo ("    <img src='".$tripUser->photo_dir."/".$tripUser->photo."' class='avatar-img'/>");
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
    <?php endif ?>
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
                <span ng-if="action.status == 2">
                    <h4 class="pull-right text-danger"><span class="glyphicon glyphicon-ban-circle"></span> <strong>Nothing paid!</strong></h4>
                </span>
                <span ng-if="action.status == 3">
                    <h4 class="pull-right text-warning"><span class="glyphicon glyphicon-record"></span> <strong>Partially paid!</strong></h4>
                </span>
                <span ng-if="action.status == 4">
                    <h4 class="pull-right text-success"><span class="glyphicon glyphicon-ok-circle"></span> <strong>All paid!</strong></h4>
                </span>
                <span ng-if="action.status == 5">
                    <h4 class="pull-right"><span class="glyphicon glyphicon-exclamation-sign"></span> <strong>Overpaid!</strong></h4>
                </span>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <h3>Price</h3>
                    <div class="input-group">
                        <input type="text" class="form-control" aria-label="..." id="price" ng-model="action.price">
                        <div class="input-group-btn">
                            <button type="button" id="actionCurrency" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{action.currency}}<i class="arrow down"></i></button>
                            <!-- TODO: Currency is not working -->
                            <ul class="dropdown-menu dropdown-menu-right" >
                                <li><a href="javascript:void(0)">CHF</a></li>
                                <li><a href="javascript:void(0)">USD</a></li>
                                <li><a href="javascript:void(0)">EUR</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="javascript:void(0)">XXX</a></li>
                                <li><a href="javascript:void(0)">YYY</a></li>
                            </ul>
                        </div><!-- /btn-group -->
                    </div><!-- /input-group -->
                    <p class="help-block">Please define the price for all persons that share this action</p>

                </div>
                <div class="col-md-6 col-md-offset-1">
                    <?php include_once("payments.ctp") ?>
                </div>
            </div>
            <!--
            <div class="box-footer status-{{action.status}} text-center">
                <h3>{{action.price - action.payments.totalAll}} {{action.currency}} still needs to be paid to reach the total of {{action.price}} {{action.currency}}</h3>
            </div>
            -->
        </div>
    </div>
</div>

<script>

</script>




