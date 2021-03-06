define('googleMaps', ['gmaps'], function(gmaps) {
    var GoogleMaps = function() {

        var mapOptions = {
            zoom: 9,
            center: new gmaps.LatLng(55.752, 37.615),
            panControl: true,
            zoomControl: true,
            scaleControl: true,
            draggable: true,
            scrollwheel: false,
            mapTypeId: gmaps.MapTypeId.ROADMAP
        };

        var map;
        var geoCoder;
        var directionsService;
        var directionsDisplay;
        var distanceService;

        var distance;
        var duration;

        var markers = new Array();
        
        this.initialize = function(mapId) {
            map = new gmaps.Map(
                document.getElementById(mapId),
                mapOptions
            );

            geoCoder = new gmaps.Geocoder();

            directionsService = new gmaps.DirectionsService();

            directionsDisplay = new gmaps.DirectionsRenderer();
            directionsDisplay.setMap(map);

            distanceService = new gmaps.DistanceMatrixService();
        }

        // this.initialize2 = function() {
        //     map = new gmaps.Map(
        //         document.getElementById('map'),
        //         mapOptions
        //     );

        //     geoCoder = new gmaps.Geocoder();

        //     directionsService = new gmaps.DirectionsService();

        //     directionsDisplay = new gmaps.DirectionsRenderer();
        //     directionsDisplay.setMap(map);

        //     distanceService = new gmaps.DistanceMatrixService();
        // }

        this.codeAddress = function(key, address) {
            geoCoder.geocode({'address': address}, function(results, status) {
                if (status == gmaps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new gmaps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });

                    markers[key] = marker;
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }

        this.calculateRoute = function(start, end) {
            var request = {
                origin: start,
                destination: end,
                travelMode: gmaps.TravelMode.DRIVING
            };
            directionsService.route(request, function(response, status) {
                if (status == gmaps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);

                    for (i = 0; i < markers.length; i++) {
                        markers[i].setMap(null);
                    }
                }
            });
        }
        
        this.calculateComplexRoute = function(start, wayPoints, end) {
            var request = {
                origin: start,
                destination: end,
                waypoints: wayPoints,
                travelMode: gmaps.TravelMode.DRIVING
            };
            directionsService.route(request, function(response, status) {
                if (status == gmaps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);

                    for (i = 0; i < markers.length; i++) {
                        markers[i].setMap(null);
                    }
                }
            });
        }

        this.calculateDistance = function(start, end) {
            distanceService.getDistanceMatrix({
                    origins: [start],
                    destinations: [end],
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.METRIC,
                    avoidHighways: false,
                    avoidTolls: false
                }, this.showDistance);
        }
        
        this.calculateComplexDistance = function(originPoints, destinationPoints) {
        	distanceService.getDistanceMatrix({
                    origins: originPoints,
                    destinations: destinationPoints,
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.METRIC,
                    avoidHighways: false,
                    avoidTolls: false
                }, this.showFullDistance);
        } 

        this.showDistance = function(response, status) {
            if (status != gmaps.DistanceMatrixStatus.OK) {
                alert('Error is happened: ' + status);
            } else {
                var origins = response.originAddresses;
                var destinations = response.destinationAddresses;

                var results = response.rows[0].elements;
                
                var distanceInKm = results[0].distance.value / 1000;
                var distanceInMile = distanceInKm * 0.621;
                var mins = results[0].duration.value / 60;
                
                var prefix = this.getPrefix();

                $('#distance_route').html(
                	distanceInKm.toFixed(1) + ' km / '
                	+ distanceInMile.toFixed(1) + ' mi'
                );
                $('#duration_route').html(
                	mins.toFixed(1) + ' mins'
                );

                $('#' + prefix + '_distance').attr(
                	'value', results[0].distance.value
                );
                $('#' + prefix + '_duration').attr(
                	'value', results[0].duration.value
                );
            }
        }
        
        this.showFullDistance = function(response, status) {
            if (status != gmaps.DistanceMatrixStatus.OK) {
                alert('Error is happened: ' + status);
            } else {
                var origins = response.originAddresses;
                var destinations = response.destinationAddresses;
             
                var distance = 0.0;
                var duration = 0;

                for (var i = 0; i < origins.length; i++) {
                	var results = response.rows[i].elements;
                	for (var j = 0; j < results.length; j++) {
						var element = results[j];
						
						distance += element.distance.value;
						duration += element.duration.value;
					}
                }
                
                var distanceInKm = distance / 1000;
                var distanceInMile = distanceInKm * 0.621;
                var mins = duration / 60;
                
                var prefix = (
                    $("#createPassengerRequestRouteInfo_routePoints_0_place").length
                    || $("#createPassengerRequestRouteInfo_routePoints_1_place").length
                ) ? 'createPassengerRequestRouteInfo' : 'editPassengerRequest';
                
                $('#distance_route').html(
                	distanceInKm.toFixed(1) + ' km / '
                	+ distanceInMile.toFixed(1) + ' mi'
                );
                $('#duration_route').html(
                	mins.toFixed(1) + ' mins'
                );

                $('#' + prefix + '_distance').attr(
                	'value', results[0].distance.value
                );
                $('#' + prefix + '_duration').attr(
                	'value', results[0].duration.value
                );
            }
        }
        
        this.getPrefix = function() {
            if (
                $("#createPassengerRequestRouteInfo_routePoints_0_place").length
                || $("#createPassengerRequestRouteInfo_routePoints_1_place").length
            ) {
                return 'createPassengerRequestRouteInfo';                
            } else {
                return 'editPassengerRequest';
            }
        }
    };
    
    return new GoogleMaps();


});