<?php include_once("include/breadcrumb.ctp"); ?>
<!--TODO: Get Trip name instead of id -->
<? $this->Html->addCrumb($trip_id) ?>
<? $this->Html->addCrumb('Add action') ?>

<div class="row" ng-init="currentTripId=<?=$trip_id?>" ng-controller="ActionCtrl">
    <?php include_once("include/googleMap.ctp"); ?>
    <?php //include_once("include/participants.ctp"); ?>
</div>

<?php include_once("include/form.ctp"); ?>

