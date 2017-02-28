<?php
// Initialize the values if edit mode
$start_name_value = '';
$end_name_value = '';
if ($action->start_name) {
    $start_name_value = 'value="' . $action->start_name . '"';
}
if ($action->end_name) {
    $end_name_value = 'value="' . $action->end_name . '"';
}
?>

<input id="pac-input-start" class="controls" type="text" <?= $start_name_value ?> placeholder="Enter a departure point">
<input id="pac-input-end" class="controls" type="text" <?= $end_name_value ?> placeholder="Enter an arrival point">

<div id="map"></div>

<?php

// set pills colors
$statusColor = '#666666'; // undefined (gray)
switch ($action->status) {
    case 1:
        $statusColor = '#264f9b';
        break; // primary (blue)
    case 2:
        $statusColor = '#9b1003';
        break; // danger (red)
    case 3:
        $statusColor = '#ed984c';
        break; // warning (orange)
    case 4:
        $statusColor = '#2e753f';
        break; // success (green)
}
?>
<script>

    // To get the Action type from the selected
    var actionType = 0; // by default
    function updateTypeId() {
        actionType = $('ul.map-icon-btn li.map-icon.active').val();
        console.log("actionType = " + actionType);
        // add the .active class when an actionType already exists in the DB
        $("ul.map-icon-btn li.map-icon-type-" + actionType).addClass("active");
        // fill the hidden select/option with the right value
        $("#type-id option").val(actionType);
        return actionType;
    }

    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete() {

//      TODO: make that we can pick a specific point when google found many
//      TODO: BUG => When we edit an action already geolocalised and we change the start or end location, the old path is not cleaned

//      Initialize values
        var LatLngStart = '';
        var LatLngEnd = '';
        var markersStart = [];
        var markersEnd = [];
        var actionPath = [];

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 46.2043907, lng: 6.143157699999961},
            zoom: 4,
            mapTypeId: 'roadmap',
            disableDefaultUI: false,
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            mapTypeControl: false,
            scaleControl: true,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: true,
            scrollwheel: false
        });

        // Create the search box and link it to the UI element.
        var inputStart = document.getElementById('pac-input-start');
        var searchBoxStart = new google.maps.places.SearchBox(inputStart);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputStart);


        var inputEnd = document.getElementById('pac-input-end');
        var searchBoxEnd = new google.maps.places.SearchBox(inputEnd);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(inputEnd);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
            searchBoxStart.setBounds(map.getBounds());
            searchBoxEnd.setBounds(map.getBounds());
        });

        // -------------------------------------------------
        // Put the markers if they already exist in the DB
        // -------------------------------------------------

        <?php
        if ($action->start_lat && $action->start_lng) {
            echo("var LatLngStart = {lat:" . $action->start_lat . ",lng:" . $action->start_lng . "}; ");
        };
        if ($action->end_lat && $action->end_lng) {
            echo("var LatLngEnd = {lat:" . $action->end_lat . ",lng:" . $action->end_lng . "};\n");
        };
        ?>

        // Render Start Marker (if it exists)
        if (!LatLngEnd && LatLngStart) {

            console.log("no LatLngEnd....");

            var markerIcon = new Marker({
                map: map,
                position: LatLngStart,
                icon: {
                    path: SQUARE_ROUNDED,
                    fillColor: '<?=$statusColor?>',
                    fillOpacity: 1,
                    strokeColor: '',
                    strokeWeight: 0,
                    scale: 0.68, //pixels
                    anchor: new google.maps.Point(0, 12)
                },
                map_icon_label: '<span class="map-icon map-icon-type-<?=$action->type_id?>"></span>'
            });

            var markerPoint = new google.maps.Marker({
                map: map,
                position: LatLngStart,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    fillOpacity: 1,
                    fillColor: '#FFFFFF',
                    strokeColor: '<?=$statusColor?>',
                    strokeWeight: 2,
                    scale: 5 //pixels
                }
            });

        };

        // Render End Marker (if it exists)
        if (LatLngEnd) {

            actionPath = new google.maps.Polyline({
                path: [LatLngStart, LatLngEnd],
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

            var bounds = new google.maps.LatLngBounds();
            bounds.extend(LatLngStart);
            bounds.extend(LatLngEnd);

            var actionCenter = bounds.getCenter();
            map.fitBounds(bounds);

            var markerIcon = new Marker({
                map: map,
                position: actionCenter,
                icon: {
                    path: SQUARE_ROUNDED,
                    fillColor: '<?=$statusColor?>',
                    fillOpacity: 1,
                    strokeColor: '',
                    strokeWeight: 0,
                    scale: 0.68, //pixels
                    anchor: new google.maps.Point(0, 12)
                },
                map_icon_label: '<span class="map-icon map-icon-type-<?=$action->type_id?>"></span>'
            });

            actionPath.setMap(map);
        }

        // -------------------------------------------------
        // Put the markers when start input is changed
        // -------------------------------------------------

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBoxStart.addListener('places_changed', function () {

            actionType = updateTypeId();
            var places = searchBoxStart.getPlaces();
            if (places.length == 0) {
                return;
            }

            // Clear out loaded markers
            markerIcon.setMap(null);
            actionPath.setMap(null);

            // Clear out the old markers.
            markersStart.forEach(function (marker) {

                console.log("---------> CLEAR MARKERS !!!!!!!!!!!")

                marker.setMap(null);
                // clear out old lines
                if (actionPath.setMap) {
                    actionPath.setMap(null);
                }
                // clear out old icons
                if (markerIcon.setMap) {
                    markerIcon.setMap(null);
                }
            });
            markersStart = [];

            // For each place, get the icon, name and location.
            var boundsStart = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                markersStart.push(new google.maps.Marker({
                    map: map,
                    position: place.geometry.location,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        fillOpacity: 1,
                        fillColor: '#FFFFFF',
                        strokeColor: '<?=$statusColor?>',
                        strokeWeight: 2,
                        scale: 4 //pixels
                    }
                }));

                LatLngStart = place.geometry.location;

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    boundsStart.union(place.geometry.viewport);
                } else {
                    boundsStart.extend(place.geometry.location);
                }

                // draw the line between start and end
                if (LatLngEnd) {
                    actionPath = new google.maps.Polyline({
                        path: [LatLngStart, LatLngEnd],
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
                                strokeWeight: 2,
                                scale: 2 //pixels
                            },
                            offset: '99%'
                        }, {
                            icon: {
                                path: google.maps.SymbolPath.CIRCLE,
                                fillOpacity: 1,
                                fillColor: '#FFFFFF',
                                strokeColor: '<?=$statusColor?>',
                                strokeWeight: 1,
                                scale: 5 //pixels
                            },
                            offset: '100%'
                        }],
                        geodesic: false,
                        strokeColor: '<?=$statusColor?>',
                        strokeOpacity: 1,
                        strokeWeight: 2
                    });

                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(LatLngStart);
                    bounds.extend(LatLngEnd);
                    var actionCenter = bounds.getCenter();

                    markerIcon = new Marker({
                        map: map,
                        position: actionCenter,
                        icon: {
                            path: SQUARE_ROUNDED,
                            fillColor: '<?=$statusColor?>',
                            fillOpacity: 1,
                            strokeColor: '',
                            strokeWeight: 0,
                            scale: 0.68, //pixels
                            anchor: new google.maps.Point(0, 12)
                        },
                        map_icon_label: '<span class="map-icon map-icon-type-' + actionType + '"></span>'
                    });

                    actionPath.setMap(map);
                }

            });

            $('#start-name').val(places[0].name);
            $('#start-lat').val(markersStart[0].position.lat());
            $('#start-lng').val(markersStart[0].position.lng());

            if (LatLngEnd) {
                boundsStart.extend(LatLngEnd);
            }
            map.fitBounds(boundsStart);

        });

        // UPDATE MARKERS when SEARCH BOX END is modified
        searchBoxEnd.addListener('places_changed', function () {

            console.log("End point has been modified...");

            actionType = updateTypeId();
            var places = searchBoxEnd.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out loaded markers
            markerIcon.setMap(null);
            actionPath.setMap(null);

            // Clear out the old markers.
            markersEnd.forEach(function (marker) {
                console.log("Clear the markerEnd....");
                marker.setMap(null);

                // clear out old lines
                if (actionPath.setMap) {
                    console.log("we need to clear the actionPath....");
                    actionPath.setMap(null);
                }
                // clear out old icons
                if (markerIcon.setMap) {
                    console.log("we need to clear the markerIcon....");
                    markerIcon.setMap(null);
                }
            });

            markersEnd = [];

            // For each place, get the icon, name and location.
            var boundsEnd = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                markersEnd.push(new google.maps.Marker({
                    map: map,
                    position: place.geometry.location,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        fillOpacity: 1,
                        fillColor: '#FFFFFF',
                        strokeColor: '<?=$statusColor?>',
                        strokeWeight: 2,
                        scale: 4 //pixels
                    }
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    boundsEnd.union(place.geometry.viewport);
                } else {
                    boundsEnd.extend(place.geometry.location);
                }

                LatLngEnd = place.geometry.location;

                actionPath = new google.maps.Polyline({
                    path: [LatLngStart, LatLngEnd],
                    icons: [{
                        icon: {
                            path: google.maps.SymbolPath.CIRCLE,
                            fillOpacity: 1,
                            fillColor: '#FFFFFF',
                            strokeColor: '<?=$statusColor?>',
                            strokeWeight: 2,
                            scale: 4 //pixels
                        },
                        offset: '0%'
                    }, {
                        icon: {
                            path: google.maps.SymbolPath.CIRCLE,
                            fillOpacity: 1,
                            fillColor: '<?=$statusColor?>',
                            strokeColor: '<?=$statusColor?>',
                            strokeWeight: 1,
                            scale: 2 //pixels
                        },
                        offset: '50%'
                    }, {
                        icon: {
                            path: google.maps.SymbolPath.FORWARD_OPEN_ARROW,
                            fillOpacity: 1,
                            fillColor: '<?=$statusColor?>',
                            strokeColor: '<?=$statusColor?>',
                            strokeWeight: 1,
                            scale: 2 //pixels
                        },
                        offset: '100%'
                    }],
                    geodesic: false,
                    strokeColor: '<?=$statusColor?>',
                    strokeOpacity: 1,
                    strokeWeight: 2
                });

                var bounds = new google.maps.LatLngBounds();
                bounds.extend(LatLngStart);
                bounds.extend(LatLngEnd);
//                map.fitBounds(bounds);
                var actionCenter = bounds.getCenter();

                markerIcon = new Marker({
                    map: map,
                    position: actionCenter,
                    icon: {
                        path: SQUARE_ROUNDED,
                        fillColor: '<?=$statusColor?>',
                        fillOpacity: 1,
                        strokeColor: '',
                        strokeWeight: 0,
                        scale: 0.68, //pixels
                        anchor: new google.maps.Point(0, 12)
                    },
                    map_icon_label: '<span class="map-icon map-icon-type-' + actionType + '"></span>'
                });

                actionPath.setMap(map);
            });

            $('#end-name').val(places[0].name);
            $('#end-lat').val(markersEnd[0].position.lat());
            $('#end-lng').val(markersEnd[0].position.lng());


            if (LatLngStart) {
                boundsEnd.extend(LatLngStart);
            }
            map.fitBounds(boundsEnd);

        });

    }
    google.maps.event.addDomListener(window, 'load', initAutocomplete);

    // for category 2, hide the Google arrival point
    $("#pac-input-end").attr('ng-hide', 'category==2');

</script>

