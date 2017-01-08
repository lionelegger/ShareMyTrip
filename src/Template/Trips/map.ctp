<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($trip->name, ['controller' => 'Trips', 'action' => 'view', $trip->id]) ?>
<? $this->Html->addCrumb('Map') ?>

<nav class="tripNav pull-right">
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Plan'), ['action' => 'view', $trip->id]) ?></button>
    <button class="btn btn-primary" role="button">Map</button>
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Cost'), ['action' => 'map', $trip->id]) ?></button>
</nav>

<h1><?= $trip->name ?> map</h1>

<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>

<div id="map"></div>
<script>
    function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI&callback=initMap">
</script>



