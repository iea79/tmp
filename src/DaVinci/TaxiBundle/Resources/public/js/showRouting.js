// show routing process
define("showRouting", ["googleMaps", "routeDisplay"], function(googleMaps, routeDisplay) {
	function showRouting() {
		googleMaps.initialize();
	    
	    $("#createPassengerRequestRouteInfo_routePoints_0_place").focusout(function() {
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
	
	    $("#createPassengerRequestRouteInfo_routePoints_1_place").focusout(function() {
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
	    
	    $(document).ready(function() {
	    	$(".next-route-point").on('focusout', function() {
	        	routeDisplay.process();
	        });
	    });
	    
	    $('div.add-destination').on('click', function(e) {
	    	e.preventDefault();
	    	
	    	var collectionHolder = $('div.desticlone');
	        var currentIndex = collectionHolder.find('div.form-block-wrap').length;
	        var newRoutePoint = "<div class='form-block-wrap new-route-point'>" 
	        	+ "<div class='labels new-point-icon'>"
				+ "<label for='createPassengerRequestRouteInfo_routePoints_" + currentIndex + "_place'>"
				+ "<i class='mp-icon-point-b'></i> To:"
				+ "</label>"
				+ "</div>"
				+ "<div class='inputs'>"
				+ "<div class='uk-form-icon'>"
				+ "<i class='mp-icon-nord-star'></i>"
				+ "<input type='text' id='createPassengerRequestRouteInfo_routePoints_" + currentIndex + "_place' name='createPassengerRequestRouteInfo[routePoints][" + currentIndex + "][place]' class='flex-input date-pick next-route-point' placeholder='Enter postcode, Venue or Place' value='' />"
				+ "</div>"
				+ "<div class='errors'></div>"
				+ "</div>"
				+ "</div>";
	
	        collectionHolder.append(newRoutePoint);
	        collectionHolder.data('index', currentIndex + 1);
	        
	        $(".next-route-point").on('focusout', function() {
	        	routeDisplay.process();
	        });
	        
	        $('div.new-point-icon').on('click', function(e) {
		    	e.preventDefault();
		    	
		    	var collectionHolder = $('div.desticlone');
		        var currentIndex = collectionHolder.find('div.form-block-wrap').length;
		        
		        collectionHolder.data('index', currentIndex - 1);
		        $(this).parent().remove();
		        	        
		        routeDisplay.process();	        
		    });
	    });
	    
	    $(".next-route-point").on('focusout', function() {
        	routeDisplay.process();
        });
        
        $('div.new-point-icon').on('click', function(e) {
	    	e.preventDefault();
	    	
	    	var collectionHolder = $('div.desticlone');
	        var currentIndex = collectionHolder.find('div.form-block-wrap').length;
	        
	        collectionHolder.data('index', currentIndex - 1);
	        $(this).parent().remove();
	        	        
	        routeDisplay.process();	        
	    });
	}
	
	return showRouting();
});