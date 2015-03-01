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
             });
             }); */
//Карта для главной страницы
            var GoogleMaps = function() {
            	var directionsDisplay;
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
                
                var markers = new Array();
                
                this.initialize = function() {
                	map = new gmaps.Map(
                    	document.getElementById('map-canvas'),
                        mapOptions
                    );
                	
                	geoCoder = new gmaps.Geocoder();
                	
                	directionsService = new gmaps.DirectionsService();
                	
                	directionsDisplay = new gmaps.DirectionsRenderer();
                	directionsDisplay.setMap(map);
                }
                
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
            };
            
            var googleMaps = new GoogleMaps();
        	        	
            gmaps.event.addDomListener(window, 'load', googleMaps.initialize);
            
            $(document).ready(function() {
            	googleMaps.initialize();
            	
            	$("#createPassengerRequestRouteInfo_routePoints_0_place").focusout(function() {
                	googleMaps.codeAddress(
                		0, $("#createPassengerRequestRouteInfo_routePoints_0_place").val()	
                	);
                });
                
                $("#createPassengerRequestRouteInfo_routePoints_1_place").focusout(function() {
                	googleMaps.codeAddress(
                		1, $("#createPassengerRequestRouteInfo_routePoints_1_place").val()	
                	);
                });
                
                $("#calculate_route").click(function() {
                	googleMaps.calculateRoute(
                		$("#createPassengerRequestRouteInfo_routePoints_0_place").val(),
                		$("#createPassengerRequestRouteInfo_routePoints_1_place").val()
                	);
                });
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
            
            //remove preloader
            togglePreloader(document.body,false);
        });
    });

});

