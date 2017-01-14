<?php include_once("include/breadcrumb.ctp"); ?>
<!--TODO: Get Trip name instead of id -->
<? $this->Html->addCrumb($trip_id) ?>
<? $this->Html->addCrumb('Add action') ?>

<div class="row" ng-init="currentTripId=<?=$trip_id?>">
    <?php //include_once("include/participants.ctp"); ?>
    <?php include_once("include/payments.ctp"); ?>
</div>

<?php include_once("include/form.ctp"); ?>
<?php include_once("include/googleMap.ctp"); ?>

