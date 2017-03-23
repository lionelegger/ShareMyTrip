<?php
$this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']);
$this->Html->addCrumb($trip->name, ['controller' => 'actions', 'action' => 'plan', $trip->id]);
$this->Html->addCrumb('Add');

// Navigation
$this->start('navigation');
echo $this->element('Layout/navigation', [
"trip_id" => $trip->id,
"active_plan" => true
]);
echo $this->fetch('navigation');
$this->end();

$edit=false;
include_once ('include/header.ctp');
?>
<p>&nbsp;</p>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI&libraries=places"></script>
<?= $this->Html->script('map-icons.js') ?>

<div ng-init="tripId=<?=$trip->id ?>;" ng-controller="ActionCtrl">
    <?php include_once("include/form.ctp"); ?>
    <hr/>
    <div class="container clearfix">
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="actions/plan/<?=$trip->id?>" class="btn btn-link btn-lg">Cancel</a>&nbsp;
                <button class="btn btn-primary btn-lg" ng-click="validated && addAction(<?=$trip->id?>)"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
            </div>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>





