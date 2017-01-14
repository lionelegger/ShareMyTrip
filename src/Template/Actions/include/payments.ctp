<div class="box col-md-5">
    <h4>Payments</h4>
    <p>I paid 100 CHF (<a href="#">edit</a>)</p>
    <p>Toto paid 349 CHF</p>
    <p>894 still needs to be paid</p>
    <!-- Button trigger modal -->
    <hr/>
    <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#payment">
        <span class="glyphicon glyphicon-plus"></span> Register payment
    </button>
    <div class="clearfix">&nbsp;</div>
    <!-- Modal -->
    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="Payment">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Payment confirmation</h4>
                    <p>The overall bill for this trip is 3492 CHF</p>
                </div>
                <div class="modal-body">
                    <form id="payment" method="post" accept-charset="utf-8">
                        <? $userSession = $this->request->session()->read('Auth.User'); ?>
                        <input class="hidden" ng-model="user_id" value="<?= $userSession['id'] ?>">
                        <input class="hidden" ng-model="action_id" value="<?= $action->id ?>">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="amount" class="col-sm-4 control-label">Amount I paid</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="amount" ng-model="actionPaymentToAdd.amount" placeholder="1200">
                                </div>
                                <div class="form-group col-sm-2">
                                    <select class="form-control" id="currency" ng-model="actionPaymentToAdd.currency">
                                        <option>CHF</option>
                                        <option>USD</option>
                                        <option>THB</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="date" class="col-sm-4 control-label">Payment date</label>
                                <div class="input-group col-sm-7">
                                    <input type="text" class="form-control" id="date" ng-model="actionPaymentToAdd.date" placeholder="Insert date">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="date" class="col-sm-4 control-label">Payment method</label>
                                <div class="form-group col-sm-8">
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="actionAddPayment(<?= $action->id ?>,<?= $userSession['id'] ?>);">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
</div>
