define('showRouteMap', ['gmaps'], function(gmaps) {

    // Maps for routs

    $('.showRouteMap').one('click', function() {
        
        var thisModal = $(this).closest('.route-modal');
        var start = thisModal.find('.routePoints_0_place').text();
        var end = thisModal.find('.routePoints_1_place:last').text();
        var oneRouteMap = thisModal.find('.map_request').attr('id');

        // Проверка адресов и блока с картой
        // alert(start + ' - ' + end + ' Map ID: ' + oneRouteMap);


        // Init map
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById(oneRouteMap), {
            zoom: 9,
            center: new google.maps.LatLng(55.752, 37.615),
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        directionsDisplay.setMap(map);
        
        // Route display
        var waypts = [];
        var waypoints = [];

        var request = {
            origin: start,
            destination: end,
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };

        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                var route = response.routes[0];
            } else {
                console.log('status: ' + status);
            }
        });

    });

});

