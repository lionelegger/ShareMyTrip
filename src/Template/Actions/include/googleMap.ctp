<style>
    /*FOR GOOGLE MAP*/
    /* Always set the map height explicitly to define the size of the div
           * element that contains the map. */

    #map-departure {
        height: 400px;
        width: 100%;
        border: 5px solid red;
    }

    .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input-start {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
        position: relative;
    }

    #pac-input-end {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-right: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
        position: relative;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    .pac-container {
        font-family: Roboto;
    }

    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

</style>
<br><br>
<div class="row">
    <div class="col-md-12">
        <input id="pac-input-start" class="controls" type="text" placeholder="Enter a departure point">
        <input id="pac-input-end" class="controls" type="text" placeholder="Enter an arrival point">
        <div id="map-departure"></div>
    </div>
</div>

<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map-departure'), {
            center: {lat: 46.2043907, lng: 6.143157699999961},
            zoom: 4,
            mapTypeId: 'roadmap',
            disableDefaultUI: true
        });

        // Create the search box and link it to the UI element.
        var inputStart = document.getElementById('pac-input-start');
        var searchBoxStart = new google.maps.places.SearchBox(inputStart);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputStart);

        var inputEnd = document.getElementById('pac-input-end');
        var searchBoxEnd = new google.maps.places.SearchBox(inputEnd);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(inputEnd);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBoxStart.setBounds(map.getBounds());
            searchBoxEnd.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBoxStart.addListener('places_changed', function() {
            var places = searchBoxStart.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });

            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                var planeStart = {
                    url: '../../img/plane-start.png',
                    // This marker is 20 pixels wide by 32 pixels high.
                    size: new google.maps.Size(20, 20),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 32).
                    anchor: new google.maps.Point(0, 20)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: planeStart,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });

            $('#start-name').val(places[0].name);
            $('#start-lat').val(markers[0].position.lat());
            $('#start-lng').val(markers[0].position.lng());

            map.fitBounds(bounds);
        });

        searchBoxEnd.addListener('places_changed', function() {
            var places = searchBoxEnd.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });

            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                var image = {
                    url: '../../img/plane-end.png',
                    // This marker is 20 pixels wide by 32 pixels high.
                    size: new google.maps.Size(20, 20),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 32).
                    anchor: new google.maps.Point(0, 20)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: image,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });

            $('#end-name').val(places[0].name);
            $('#end-lat').val(markers[0].position.lat());
            $('#end-lng').val(markers[0].position.lng());

            map.fitBounds(bounds);
        });


    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBsahp0E7FSU4WE0dY73LyvTyY6-CWxgI&libraries=places&callback=initAutocomplete"></script>
