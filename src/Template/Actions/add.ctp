<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($trip->name, ['controller' => 'actions', 'action' => 'plan', $trip->id]) ?>
<? $this->Html->addCrumb('Add') ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI&libraries=places"></script>
<?= $this->Html->script('map-icons.js') ?>

<?php include_once("include/form.ctp"); ?>


