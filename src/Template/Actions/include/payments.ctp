<div id="payments">
    <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#payment" ng-click="actionEditPayment(null)">
        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add payment
    </button>
    <!--
    <button type="button" class="btn btn-success pull-right" ng-if="action.price" ng-click="actionPayAll(<?/*= $action->id */?>,<?/*=$userSession['id']*/?>)">
        I paid all
    </button>
    -->
    <h3>Payments</h3>
    <br>
    <div class="payment-list">
        <p ng-if="!action.payments.totalAll" class="text-muted">No payment registered yet.</p>
        <table class="table table-condensed" ng-if="action.payments.totalAll">
            <tr ng-repeat="payment in action.payments">
                <td><strong>{{payment.amount}} {{payment.currency}}</strong></td>
                <td><span ng-if="payment.date" class="text-muted small">{{payment.date | date:'d MMMM yyyy'}}</span></td>
                <td ng-if="payment.method.id" class="hidden-xxs"><span class="text-muted small">{{payment.method.name}}</span></td>
                <td ng-if="actionPaymentToAdd.method_name" class="hidden-xxs"><span class="text-muted small">{{actionPaymentToAdd.method_name}}</span></td>
                <td ng-if="!payment.method.id" class="hidden-xxs">&nbsp;</td>
                <td class="text-right">Paid by&nbsp;<span ng-if="payment.user.id != <?= $userSession['id'] ?>" class="pull-right">{{payment.user.first_name}}</span><span ng-if="payment.user_id==currentUserId" class="pull-right">me <a ng-click="actionEditPayment(payment.id)" data-toggle="modal" data-target="#payment" ng-show="<?=($edit)?>">[edit]</a></span></td>
            </tr>
            <div class="hidden" id="totalPaid">{{action.payments.totalAll}}</div>
            <tr class="sum-light" ng-if="action.payments.length > 1">
                <td>
                    <h4 ng-if="action.payments.totalAll > 0"><strong>{{action.payments.totalAll}} <?=$trip->currency?></strong></h4>
                </td>
                <td colspan="4" class="text-right">
                    <?php if($edit):?>{{action.payments.totalAuth}} <?=$trip->currency?> paid by me<?php endif ?>
                </td>
            </tr>
        </table>
    </div>
    <!-- Button trigger modal -->

    <div class="clearfix">&nbsp;</div>
    <!-- Modal -->
    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="Payment">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header color-lightgrey">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">Payment</h2>
                    <h4 class="help-block">The amount that is still to pay is {{action.price - action.payments.totalAll}} {{action.currency}}</h4>
                </div>
                <div class="modal-body">
                    <form id="payment" method="post" accept-charset="utf-8">
                        <? $userSession = $this->request->session()->read('Auth.User'); ?>
                        <input class="hidden" ng-model="user_id" value="<?= $userSession['id'] ?>">
                        <input class="hidden" ng-model="action_id" value="<?= $action->id ?>">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="amount" class="col-sm-5 control-label">Amount</label>
<!--                                <span class="hidden">{{initAmount = action.price - action.payments.totalAll}}</span>-->
                                <div class="input-group col-sm-6">
                                    <input type="text" class="form-control" id="paymentAmount" ng-model="actionPaymentToAdd.amount" placeholder="{{action.price - action.payments.totalAll}}">
<!--                                    <input type="text" class="form-control" id="paymentAmount" ng-model="actionPaymentToAdd.amount">-->
                                    <div class="input-group-btn">
                                        <button type="button" id="paymentCurrency" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{action.currency}}<i class="arrow down"></i></button>
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

                            </div>
                        </div>

                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="date" class="col-sm-5 control-label">Date</label>
                                <div class="input-group col-sm-6" id="datePaymentGrp">
                                    <input type="text" class="form-control" id="datePayment" name="datePayment" ng-init="date=(actionPaymentToAdd.date)" ng-model="actionPaymentToAdd.date" placeholder="Insert date">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="date" class="col-sm-5 control-label">Method</label>
                                <div class="form-group col-sm-7">
                                    <select class="form-control" id="method_id" ng-model="actionPaymentToAdd.method_id">
                                        <?php
                                        foreach ($allMethods as $method) {
                                            echo ("<option value='".$method->id."' ng-selected='actionPaymentToAdd.method_id == ".$method->id."'>".$method->name."</option>");
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <?php if (!$edit) { ?>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="actionAddTempPayment(<?= $userSession['id'] ?>);">Save</button>
                    <?php } else {?>
                        <button type="button" class="btn btn-danger pull-left" ng-if="actionPaymentToAdd.payment_id" ng-click="actionDeletePayment(actionPaymentToAdd.payment_id,<?= $action->id ?>)" data-dismiss="modal">Delete</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="actionSavePayment(<?= $action->id ?>,<?= $userSession['id'] ?>,actionPaymentToAdd.payment_id)">Save</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
