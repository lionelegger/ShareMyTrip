<!-- TODO: MAP should only show the actions in which the logged user is participating -->
<? $this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']) ?>
<? $this->Html->addCrumb($trip->name, ['controller' => 'actions', 'action' => 'plan', $trip->id]) ?>
<? $this->Html->addCrumb('Map') ?>

<nav class="tripNav pull-right">
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Plan'), ['controller' => 'actions', 'action' => 'plan', $trip->id]) ?></button>
    <button class="btn btn-primary" role="button">Map</button>
    <button class="btn btn-default" role="button"><?= $this->Html->link(__('Budget'), ['controller' => 'actions', 'action' => 'budget', $trip->id]) ?></button>
</nav>

<h1><?= $trip->name ?> map</h1>

<style>
    #map {
        height: 100%;
        width: 100%;
        position: absolute;
        top: 50px;
        left: 0;
        z-index: -1;
    }

</style>
<div id="map"></div>
<script>

</script>

<script>
    //  TODO: Make that when we click on a specific action, we get to the detail of the action

    function initMap() {
        var geneva = {lat: 46.2043907, lng: 6.143157699999961};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            mapTypeId: 'roadmap',
            center: geneva
        });

        // set the icon size
        var icon = {
            // This marker is 20 pixels wide by 20 pixels high.
            size: new google.maps.Size(20, 20),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the circle at (10, 10).
            anchor: new google.maps.Point(10, 10)
        };

        markers = [];
        var bounds = new google.maps.LatLngBounds();

        <?php foreach ($actions as $action): ?>

        <?php
        $statusColor = '#666666'; // undefined (gray)
        switch($action->status) {
            case 1: $statusColor = '#ed984c'; break; // warning (orange)
            case 2: $statusColor = '#9b1003'; break; // danger (red)
            case 3: $statusColor = '#2e753f'; break; // success (green)
        }
        ?>

        // set the icon types
        var actionType = <?= h($action->type_id) ?>;

        icon.url = 'img/iconMap-<?= $action->type_id ?>.png';

        /* START */
        <?php if ($action->start_lat && $action->start_lng): ?>
            var latLngStart = new google.maps.LatLng(<?= h($action->start_lat) ?>,<?= h($action->start_lng) ?>);
            // Create a marker for the status pill.
            markers.push(new google.maps.Marker({
                map: map,
                position: latLngStart,
                zIndex: 1,
                optimized: false,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    fillOpacity: 1,
                    fillColor: '<?=$statusColor?>',
                    strokeColor: '<?=$statusColor?>',
                    strokeWeight: 1,
                    scale: 10 //pixels
                }
            }));
            // Create a marker for the starting point.
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: '<?= h($action->start_name) ?>',
                position: latLngStart,
                optimized: false,
                zIndex: 20
            }));
            bounds.extend(latLngStart);
        <?php endif ?>

        /* END */
        <?php if ($action->end_lat && $action->end_lng): ?>
            var latLngEnd = new google.maps.LatLng(<?= h($action->end_lat) ?>,<?= h($action->end_lng) ?>);
            // Create a marker for the status pill.
            markers.push(new google.maps.Marker({
                map: map,
                position: latLngEnd,
                zIndex: 1,
                optimized: false,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    fillOpacity: 1,
                    fillColor: '<?=$statusColor?>',
                    strokeColor: '<?=$statusColor?>',
                    strokeWeight: 1.0,
                    scale: 10 //pixels
                }
            }));
            // Create a marker for the ending point.
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: '<?= h($action->start_name) ?>',
                position: latLngEnd,
                optimized: false,
                zIndex: 20
            }));
            bounds.extend(latLngEnd);

            // draw the line between start and end
            var actionPath = new google.maps.Polyline({
                icons: [{
                    icon: {path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW},
                    offset: '50%'
                }],
                path: [latLngStart, latLngEnd],
                geodesic: true,
                strokeColor: '<?=$statusColor?>',
                strokeOpacity: 1,
                strokeWeight: 2
            });

            actionPath.setMap(map);
        <?php endif ?>

        <?php endforeach; ?>

        map.fitBounds(bounds);

    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI&callback=initMap"></script>




