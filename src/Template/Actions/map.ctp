<!-- TODO: MAP should only show the actions in which the logged user is participating -->
<?php

// Breadcrumb
$this->Html->addCrumb('Trips', ['controller' => 'Trips', 'action' => 'index']);
$this->Html->addCrumb($trip->name, ['controller' => 'actions', 'action' => 'plan', $trip->id]);
$this->Html->addCrumb('Map');

// Navigation
$this->start('navigation');
echo $this->element('Layout/navigation', [
    "trip_id" => $trip->id,
    "active_map" => true
]);
echo $this->fetch('navigation');
$this->end();

include_once ('include/header.ctp');

?>

<style>
    #map-full {
        height: 100%;
        width: 100%;
        position: absolute;
        top: 50px;
        left: 0;
        z-index: -1;
        margin-bottom: -60px;
    }
</style>
<div id="map-full"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI"></script>
<?= $this->Html->script('map-icons.js') ?>


<script>

        var geneva = {lat: 46.2043907, lng: 6.143157699999961};
        var map = new google.maps.Map(document.getElementById('map-full'), {
            zoom: 4,
            mapTypeId: 'roadmap',
            center: geneva,
            disableDefaultUI: false,
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: true,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: true,
            scrollwheel: true
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

            <?php if($action->start_lat):?>

                <?php
                $statusColor = '#999999'; // undefined (gray)
                switch($action->status) {
                    case 1: $statusColor = '#337ab7'; break; // primary (blue)
                    case 2: $statusColor = '#9b1003'; break; // danger (red)
                    case 3: $statusColor = '#ed984c'; break; // warning (orange)
                    case 4: $statusColor = '#2e753f'; break; // success (green)
                    case 5: $statusColor = '#000000'; break; // overpaid (black)
                }
                ?>

                // set the icon types
                var actionType = <?= h($action->type_id) ?>;

                icon.url = 'img/iconMap-<?= $action->type_id ?>.png';

                /* START */
                <?php if ($action->start_lat && $action->start_lng): ?>
                    var latLngStart = new google.maps.LatLng(<?= h($action->start_lat) ?>,<?= h($action->start_lng) ?>);
                    // Create a marker for the status pill.

                    <?php if (!$action->end_lat && !$action->end_lng): ?>

                        markerPoint = new google.maps.Marker({
                            map: map,
                            position: latLngStart,
                            icon: {
                                path: google.maps.SymbolPath.CIRCLE,
                                fillOpacity: 1,
                                fillColor: '#FFFFFF',
                                strokeColor: '<?=$statusColor?>',
                                strokeWeight: 2,
                                scale: 4 //pixels
                            }
                        });

                        markerIcon = new Marker({
                            map: map,
                            position: latLngStart,
                            icon: {
                                path: SQUARE_ROUNDED,
                                fillColor: '<?=$statusColor?>',
                                fillOpacity: 1,
                                strokeColor: '',
                                strokeWeight: 0,
                                scale: 0.68, //pixels
                                anchor: new google.maps.Point(0, 12)
                            },
                            map_icon_label: '<span class="map-icon map-icon-type-<?=$action->type_id?>"></span>',
                            url: 'actions/edit/<?=$action->id?>'
                        });

                    <?php endif ?>
                    bounds.extend(latLngStart);

                <?php endif ?>

                /* END */
                <?php if ($action->end_lat && $action->end_lng): ?>
                    var latLngEnd = new google.maps.LatLng(<?= h($action->end_lat) ?>,<?= h($action->end_lng) ?>);

                    actionPath = new google.maps.Polyline({
                        path: [latLngStart, latLngEnd],
                        icons: [{
                            icon: {
                                path: google.maps.SymbolPath.CIRCLE,
                                fillOpacity: 1,
                                fillColor: '#FFFFFF',
                                strokeColor: '<?=$statusColor?>',
                                strokeWeight: 2,
                                scale: 5 //pixels
                            },
                            offset: '0%'
                        }, {
                            icon: {
                                path: google.maps.SymbolPath.FORWARD_OPEN_ARROW,
                                fillOpacity: 1,
                                fillColor: '<?=$statusColor?>',
                                strokeColor: '<?=$statusColor?>',
                                strokeWeight: 1,
                                scale: 2 //pixels
                            },
                            offset: '99%'
                        }, {
                            icon: {
                                path: google.maps.SymbolPath.CIRCLE,
                                fillOpacity: 1,
                                fillColor: '#FFFFFF',
                                strokeColor: '<?=$statusColor?>',
                                strokeWeight: 2,
                                scale: 5 //pixels
                            },
                            offset: '100%'
                        }],
                        geodesic: false,
                        strokeColor: '<?=$statusColor?>',
                        strokeOpacity: 1,
                        strokeWeight: 2
                    });

                    var Pathbounds = new google.maps.LatLngBounds();
                    Pathbounds.extend(latLngStart);
                    Pathbounds.extend(latLngEnd);

                    var actionCenter = Pathbounds.getCenter();

                    var markerIcon = new Marker({
                        map: map,
                        position: actionCenter,
                        icon: {
                            path: SQUARE_ROUNDED,
                            fillColor: '<?=$statusColor?>',
                            fillOpacity: 1,
                            strokeColor: '',
                            strokeWeight: 0,
                            scale: 0.6, //pixels
                            anchor: new google.maps.Point(0,17)
                        },
                        map_icon_label: '<span class="map-icon map-icon-type-<?=$action->type_id?>"></span>',
                        url: 'actions/edit/<?=$action->id?>'
                    });

                    bounds.extend(latLngEnd);

                    actionPath.setMap(map);
                <?php endif ?>

                google.maps.event.addListener(markerIcon, 'click', function() {
                    window.location.href = this.url;
                });
            <?php endif; ?>

        <?php endforeach; ?>

        map.fitBounds(bounds);

</script>


<!--
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI&callback=initMap"></script>

-->
