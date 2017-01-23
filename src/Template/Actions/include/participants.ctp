<!--TODO: Use a cakePHP ActionsCtrl controller that build the list of participants to an action-->
<div class="box col-md-5" ng-init="actionListParticipants(tripId, actionId);">
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
            <!-- TODO: implement function for button switching between "add all" and "only for me" (by default)-->
            <button role="button" class="btn btn-primary" ng-click="actionAddAllUsers(actionId)">Add all</button>
            <button role="button" class="btn btn-danger" ng-click="actionDeleteAllUsers(actionId)">Only me</button>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
</div>



