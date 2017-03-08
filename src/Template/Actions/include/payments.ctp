<div id="payments">
    <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#payment">
        Register payment
    </button>
    <h3>Payments</h3>
    <br>
    <div class="payment-list">
        <ul class="refine">
            <li ng-repeat="payment in action.payments">
                <strong>{{payment.amount}} {{payment.currency}}</strong> <span ng-if="payment.date" class="text-muted small">[{{payment.date | date:"yyyy-MM-dd"}}]</span>
                <span ng-if="payment.user.id != <?= $userSession['id'] ?>" class="pull-right">Paid by {{payment.user.first_name}}</span><span ng-if="payment.user_id==currentUserId" class="pull-right"><a ng-click="actionEditPayment(payment.id)" data-toggle="modal" data-target="#payment">Paid by me</a></span>
            </li>
        </ul>
        <p ng-if="!action.payments.totalAll">No payment recorded yet.</p>
        <h4 ng-if="action.payments.totalAll > 0"><strong>{{action.payments.totalAll}} <?=$trip->currency?></strong> <?php if($edit):?><small>from which {{action.payments.totalAuth}} {{action.currency}} paid by me</small><?php endif ?></h4>
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
                    <h4 class="help-block">The amount that is still to pay is {{action.price - action.payments.totalAll}} CHF</h4>
                </div>
                <div class="modal-body">
                    <form id="payment" method="post" accept-charset="utf-8">
                        <? $userSession = $this->request->session()->read('Auth.User'); ?>
                        <input class="hidden" ng-model="user_id" value="<?= $userSession['id'] ?>">
                        <input class="hidden" ng-model="action_id" value="<?= $action->id ?>">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="amount" class="col-sm-5 control-label">Amount</label>
                                <div class="input-group col-sm-6">
                                    <input type="text" class="form-control" id="price" ng-model="actionPaymentToAdd.amount" placeholder="{{action.price - action.payments.totalAll}}">
                                    <div class="input-group-btn">
                                        <button type="button" id="paymentCurrency" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{action.currency}}<i class="arrow down"></i></button>
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

                            </div>
                        </div>

                        <div class="form-horizontal">
                            <div class="form-group">
                                <!-- TODO: Date is not working -->
                                <label for="date" class="col-sm-5 control-label">Date</label>
                                <div class="input-group col-sm-6">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
