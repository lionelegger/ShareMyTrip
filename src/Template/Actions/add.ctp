
<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($trip->name, ['controller' => 'actions', 'action' => 'plan', $trip->id]) ?>
<? $this->Html->addCrumb('Add') ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI&libraries=places"></script>
<?= $this->Html->script('map-icons.js') ?>

<div ng-init="tripId=<?=$trip->id ?>;" ng-controller="ActionCtrl">
    <?php $edit=false;?>
    <?php include_once("include/form.ctp"); ?>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="actions/plan/<?=$trip->id?>" class="btn btn-default">Cancel</a>&nbsp;
            <button class="btn btn-primary" ng-click="addAction(<?=$trip->id?>)">Add</button>
        </div>
    </div>
</div>





