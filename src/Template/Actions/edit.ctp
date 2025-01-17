<?php
include_once("include/breadcrumb.ctp");
$this->Html->addCrumb($action->trip->name, ['controller' => 'actions', 'action' => 'plan', $action->trip->id]);
$this->Html->addCrumb($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]);
$this->Html->addCrumb('Edit');

// Navigation
$this->start('navigation');
echo $this->element('Layout/navigation', [
"trip_id" => $trip->id,
"active_plan" => true
]);
echo $this->fetch('navigation');
$this->end();

$edit=true;
include_once ('include/header.ctp');

?>
<p>&nbsp;</p>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI&libraries=places"></script>
<?= $this->Html->script('map-icons.js') ?>


<div ng-init="tripId=<?=$action->trip_id ?>;actionId=<?=$action->id?>;actionListPayments(<?=$action->id?>)" ng-controller="ActionCtrl">

    <?php include_once("include/form.ctp"); ?>
    <hr/>
    <div class="container clearfix">

        <div class="row">
            <div class="col-xs-3 text-left">
                <!-- Button trigger modal -->
                <?php if($action->owner_id == $userSession['id']): ?>
                    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#deleteModal">
                        <span class="glyphicon glyphicon-trash"></span>&nbsp;Delete
                    </button>
                <?php endif ?>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete action">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Delete '<?=$action->name?>'</h4>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this action ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" ng-click="deleteAction(<?=$action->trip->id?>,<?=$action->id?>)">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-9 text-right">
                <a href="actions/plan/<?=$action->trip->id?>" class="btn btn-link btn-lg">Cancel</a>&nbsp;
                <button type="submit" class="btn btn-primary btn-lg pull-right" ng-click="editAction(<?=$action->trip->id?>,<?=$action->id?>);" data-toggle="collapse" href="#collapseParticipation" aria-expanded="false" aria-controls="collapseExample"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
            </div>
        </div>
    </div>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>




