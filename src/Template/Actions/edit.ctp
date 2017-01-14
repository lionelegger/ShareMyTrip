<?php include_once("include/breadcrumb.ctp"); ?>
<!--TODO: Get Trip name instead of id -->
<? $this->Html->addCrumb($action->trip_id) ?>
<? $this->Html->addCrumb($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]) ?>

<div class="row" ng-init="currentTripId=<?=$action->trip_id?>;currentActionId=<?=$action->id?>;">
    <?php include_once("include/participants.ctp"); ?>
    <?php include_once("include/payments.ctp"); ?>
</div>

<?php include_once("include/form.ctp"); ?>
<?php include_once("include/googleMap.ctp"); ?>
<br/>
<hr/>
<div class="text-center">
    <h3><span class="glyphicon glyphicon-remove"></span>
        <?= $this->Form->postLink(
            'Delete this action',
            ['action' => 'delete', $action->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $action->id)]
        )
        ?>
    </h3>
</div>

