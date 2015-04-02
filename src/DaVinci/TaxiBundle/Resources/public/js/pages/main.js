require(['pages/common', 'gmaps'], function ($, gmaps) {
    require(['timepicker', 'jquery.spinner', 'jquery.form', 'datarange', 'addons/datepicker', 'chosen.jquery', 'pages/table.resize', 'charCount'], function () {
        require(['chosenImage.jquery'], function () {

            //Добавление доролнительных направлений 
            $('.destination .add-lang').click(function () {
                $('.destination .desticlone .to:last-child').clone().appendTo(".destination .desticlone");
            });




//simbols left in textarea in step 2 homepage

            $(".charcount").charCount();



//Скрытие и открытие дополнительных спкцификаций на 2-м шаге главной
            $('.spec-request').click(function () {
                $(this).next('.checks').toggle();
            });

            $('.chois li').change(function () {
                var ind = $('.chois li').index($('li.uk-active')[0]);
                alert(ind);
            });
//Скрытие и открытие обратной даты на 1-м шаге главной
            $(function () {
                $('#round_trip').hide();
                $('.destination .check-box input[type=checkbox]:checked').each(function () {
                    $('.destination #round_trip').show();
                });
            });
            $(".destination .check-box input[type=checkbox]").click(function () {
                var checked = this.checked;
                var targetBlock = $('.destination').parent().find('#round_trip');
                if (checked)
                    targetBlock.show();
                else
                    targetBlock.hide();
            });
//Скрытие и открытие данных для заказа другому человеку на 3-м шаге главной
            /* This is not applicable so far, but can be used any moment again 
             
             $(function(){
             $('.another-wrap').hide();
             });
             $(function(){
             $('.nottravel input[type=checkbox]').click(function(){
             var checked = this.checked;
             if(checked) $('.another-wrap').show();
             else $('.another-wrap').hide();
             });z
             }); */
            
 //Ajax request processing            
                    
//Карта для главной страницы
            var GoogleMaps = function() {
                var mapOptions = {
                    zoom: 9,
                    center: new gmaps.LatLng(55.752, 37.615),
                    panControl: true,
                    zoomControl: true,
                    scaleControl: true,
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

                this.initialize = function () {
                    map = new gmaps.Map(
                    	document.getElementById('map-canvas'),
                    	mapOptions
                    );

                    geoCoder = new gmaps.Geocoder();

                    directionsService = new gmaps.DirectionsService();

                    directionsDisplay = new gmaps.DirectionsRenderer();
                    directionsDisplay.setMap(map);

                    distanceService = new gmaps.DistanceMatrixService();
                }

                this.codeAddress = function (key, address) {
                    geoCoder.geocode({'address': address}, function (results, status) {
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

                this.calculateRoute = function (start, end) {
                    var request = {
                        origin: start,
                        destination: end,
                        travelMode: gmaps.TravelMode.DRIVING
                    };
                    directionsService.route(request, function (response, status) {
                        if (status == gmaps.DirectionsStatus.OK) {
                            directionsDisplay.setDirections(response);

                            for (i = 0; i < markers.length; i++) {
                                markers[i].setMap(null);
                            }
                        }
                    });
                }

                this.calculateDistance = function (start, end) {
                    distanceService.getDistanceMatrix(
                            {
                                origins: [start],
                                destinations: [end],
                                travelMode: google.maps.TravelMode.DRIVING,
                                unitSystem: google.maps.UnitSystem.METRIC,
                                avoidHighways: false,
                                avoidTolls: false
                            },
                    this.showDistance
                            );
                }

                this.showDistance = function (response, status) {
                    if (status != gmaps.DistanceMatrixStatus.OK) {
                        alert('Error is happened: ' + status);
                    } else {
                        var origins = response.originAddresses;
                        var destinations = response.destinationAddresses;

                        var results = response.rows[0].elements;

                        $('#distance_route').html(results[0].distance.text);
                        $('#duration_route').html(results[0].duration.text);

                        $('#createPassengerRequestRouteInfo_distance').attr(
                        	'value', results[0].distance.value
                        );
                        $('#createPassengerRequestRouteInfo_duration').attr(
                        	'value', results[0].duration.value
                        );
                    }
                }
            };


            $("#createPassengerRequestRouteInfo_routePoints_0_place").focusout(function () {
                var placeFrom = $("#createPassengerRequestRouteInfo_routePoints_0_place").val();
                var placeTo = $("#createPassengerRequestRouteInfo_routePoints_1_place").val();

                if (placeFrom != '' && placeTo != '') {
                    googleMaps.calculateRoute(placeFrom, placeTo);
                    googleMaps.calculateDistance(placeFrom, placeTo);

                    return;
                }

                if (placeFrom != '') {
                    googleMaps.codeAddress(0, placeFrom);
                }
            });

            $("#createPassengerRequestRouteInfo_routePoints_1_place").focusout(function () {
                var placeFrom = $("#createPassengerRequestRouteInfo_routePoints_0_place").val();
                var placeTo = $("#createPassengerRequestRouteInfo_routePoints_1_place").val();

                if (placeFrom != '' && placeTo != '') {
                    googleMaps.calculateRoute(placeFrom, placeTo);
                    googleMaps.calculateDistance(placeFrom, placeTo);

                    return;
                }

                if (placeTo != '') {
                    googleMaps.codeAddress(1, placeTo);
                }
            });

            $("#calculate_route").click(function () {
                var placeFrom = $("#createPassengerRequestRouteInfo_routePoints_0_place").val();
                var placeTo = $("#createPassengerRequestRouteInfo_routePoints_1_place").val();

                googleMaps.calculateRoute(placeFrom, placeTo);
                googleMaps.calculateDistance(placeFrom, placeTo);
            });


//accordeon for buttoons in step 2 of homepage
            $(".order-details .uk-nav-parent-icon").click(function () {
                $(this).find(".uk-parent").toggleClass("uk-open");
            });

//show and hide texareas on step 2 of homepage
            $(function () {
                $('.kids-pats-line .wishes-1').hide();
                $('.kids-pats-line input[type=checkbox]:checked').each(function () {
                    $(this).parent().find('.wishes-1').show();
                });
            });
            $(".kids-pats-line input[type=checkbox]").click(function () {
                var checked = this.checked;
                var targetBlock = $(this).parent().find('.wishes-1');
                if (checked)
                    targetBlock.show();
                else
                    targetBlock.hide();
            });

//default disable for a in buttons 2 step
            $('.spec-request .uk-parent > a, .auto-tip a').click(function (event) {
                return false;
            });


// for input type number
            $('.minus').click(function () {

                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;

            });

            $('.plus').click(function () {

                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;

            });
            
            var Requester = function() {
            	
            	this.makeRequest = function(requestedUrl, sendData) {
            		$.ajax({
                        url: requestedUrl,
                        data: sendData,
                        type: "POST",
                        dataType: "json",
                        async: false,
                        success: function(data) {
                        	return;
                        }
                    });	
            	}
            	
            }
            
            $('.approve-driver').on("click", function () {
            	alert($(this).attr('value'));
            });
        	
        	var requester = new Requester();
            
            var googleMaps = new GoogleMaps();
            googleMaps.initialize();
                  
            //remove preloader
            togglePreloader(document.body, false);

        });
    });

});

