<?php include_once("include/breadcrumb.ctp"); ?>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI&libraries=places"></script>
<?= $this->Html->script('map-icons.js') ?>

<!--TODO: Get Trip name instead of id -->
<? $this->Html->addCrumb($action->trip_id) ?>
<? $this->Html->addCrumb($action->name, ['controller' => 'Actions', 'action' => 'edit', $action->id]) ?>
<div ng-init="tripId=<?=$action->trip_id ?>;actionId=<?=$action->id?>;actionListPayments(<?= $action->id ?>)" ng-controller="ActionCtrl">
    <?php include_once("include/form.ctp"); ?>
    <div class="row">
        <div class="col-md-4">
            <?php include_once("include/participants.ctp"); ?>
        </div>
        <div class="col-md-8">
            <?php include_once("include/payments.ctp"); ?>
        </div>
    </div>
</div>
<br/>
<hr/>
<div class="row">
    <div class="col-md-12">
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
    </div>
</div>





