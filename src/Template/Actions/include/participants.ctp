<!--TODO: Use a cakePHP ActionsCtrl controller that build the list of participants to an action-->
<div class="box col-md-5" ng-controller="ParticipantsCtrl" ng-init="getParticipantsAction(currentTripId, currentActionId);">
    <h4>Participants to this action</h4>
    <div class="row">
        <div class="col-md-9">
            <div class="btn-toolbar">
                <div ng-repeat="user in currentTrip.trip.users">
                    <button style="margin-right: 6px;" role="button" id="user-{{user.id}}" class="btn btn-default" ng-click="actionAddUser(currentTripId,currentActionId,user.id)">{{user.first_name}}</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <!-- TODO: implement function for button switching between "add all" and "only for me" (by default)-->
            <button role="button" class="btn btn-primary">Add all</button>
        </div>
        <div class="col-md-12">
            Participants id:
        <? foreach ($action->participations as $participants):
            echo $participants->id . ", ";
        endforeach; ?>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
</div>



