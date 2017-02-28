<div id="payments">
    <h3>Payments <small>STATUS : {{action.status}}</small></h3>
    <div class="payment-list">
        <ul class="list-unstyled">
            <li ng-repeat="payment in action.payments">
                {{payment.user.first_name}} paid {{payment.amount}} {{payment.currency}} [{{payment.date | date:"yyyy-MM-dd"}} | Method: {{payment.method_id}}]
                <span ng-if="payment.user_id==currentUserId"><a ng-click="actionEditPayment(payment.id)" data-toggle="modal" data-target="#payment">[Edit]</a></span>
            </li>
        </ul>
        <hr>
        <h4>TOTAL paid : {{action.payments.totalAll}} {{action.currency}} <?php if($edit):?>(from which {{action.payments.totalAuth}} {{action.currency}} by me)<?php endif ?></h4>
        <p class="help-block">{{action.price - action.payments.totalAll}} {{action.currency}} still needs to be paid to reach the total of {{action.price}} {{action.currency}}</p>
    </div>
    <!-- Button trigger modal -->
    <hr/>
    <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#payment">
        <span class="glyphicon glyphicon-plus"></span> Register payment
    </button>
    <div class="clearfix">&nbsp;</div>
    <!-- Modal -->
    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="Payment">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">Payment confirmation</h2>
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
                                        <option value="1">Paypal</option>
                                        <option value="2">Credit card</option>
                                        <option value="3">Cash</option>
                                        <option>...</option>
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
                        <button type="button" class="btn btn-danger" ng-if="actionPaymentToAdd.payment_id" ng-click="actionDeletePayment(actionPaymentToAdd.payment_id,<?= $action->id ?>)" data-dismiss="modal">Delete</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="actionSavePayment(<?= $action->id ?>,<?= $userSession['id'] ?>,actionPaymentToAdd.payment_id)">Save</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
</div>

<!--TODO: BUG => Date is not saved because cakephp does not take the YYYY-MM-DD format (how to change that?) -->
<script type="text/javascript">
    $(function () {
        $('#datePayment').datetimepicker({
            format: 'YYYY-MM-DD',
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom'
            }

        });


    });
    var dateTimePicker = function() {
        return {
            restrict: "A",
            require: "ngModel",
            link: function (scope, element, attrs, ngModelCtrl) {
                var parent = $(element).parent();
                var dtp = parent.datetimepicker({
                    format: "LL",
                    showTodayButton: true
                });
                dtp.on("dp.change", function (e) {
                    ngModelCtrl.$setViewValue(moment(e.date).format("LL"));
                    scope.$apply();
                });
            }
        };
    };


</script>
