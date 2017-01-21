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
    function initMap() {
        //var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            mapTypeId: 'roadmap',
            center: {lat: 46.2043907, lng: 6.143157699999961}
        });

        // set the icon sizes
        var iconStart = {
            // This marker is 20 pixels wide by 20 pixels high.
            size: new google.maps.Size(20, 20),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the circle at (10, 10).
            anchor: new google.maps.Point(10, 10)
        };
        var iconEnd = {
            size: new google.maps.Size(20, 20),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(10, 10)
        };

        markers = [];
        var bounds = new google.maps.LatLngBounds();

        <?php foreach ($actions as $action): ?>

            // set the icon types
            var actionType = <?= h($action->type_id) ?>;

            iconStart.url = 'img/unknown.png';
            iconEnd.url = 'img/unknown.png';
            <?php switch($action->type_id) {
                case '1':
                    echo "iconStart.url = 'img/plane-start.png';";
                    echo "iconEnd.url = 'img/plane-end.png';";
                break;
                case '9':
                    echo "iconStart.url = 'img/hotel.png';";
                break;
            }?>

            /* START */
            <?php if ($action->start_lat && $action->start_lng): ?>

            var latLngStart = new google.maps.LatLng(<?= h($action->start_lat) ?>,<?= h($action->start_lng) ?>);
            // Create a marker for the starting point.
            markers.push(new google.maps.Marker({
                map: map,
                icon: iconStart,
                title: '<?= h($action->start_name) ?>',
                position: latLngStart
            }));
            bounds.extend(latLngStart);
            <?php endif ?>

            /* END */
            <?php if ($action->end_lat && $action->end_lng): ?>
            var latLngEnd = new google.maps.LatLng(<?= h($action->end_lat) ?>,<?= h($action->end_lng) ?>);
            // Create a marker for the ending point.
            markers.push(new google.maps.Marker({
                map: map,
                icon: iconEnd,
                title: '<?= h($action->start_name) ?>',
                position: latLngEnd
            }));
            bounds.extend(latLngEnd);

            // draw the line between start and end
            var actionCoordinates = [
                latLngStart,
                latLngEnd
            ];
            var actionPath = new google.maps.Polyline({
                path: actionCoordinates,
                geodesic: true,
                strokeColor: '#197b30',
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




