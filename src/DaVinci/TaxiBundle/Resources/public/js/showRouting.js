// show routing process
define("showRouting", ["googleMaps", "routeDisplay"], function(googleMaps, routeDisplay) {
	function showRouting() {
		googleMaps.initialize('map-canvas');
        routeDisplay.load();
        
        var prefix = routeDisplay.getPrefix();
        	    
	    $("#" + prefix + "_routePoints_0_place").focusout(function() {
	        var placeFrom = $("#" + prefix + "_routePoints_0_place").val();
	        var placeTo = $("#" + prefix + "_routePoints_1_place").val();
	
	        if (placeFrom != '' && placeTo != '') {
	            googleMaps.calculateRoute(placeFrom, placeTo);
	            googleMaps.calculateDistance(placeFrom, placeTo);
	
	            return;
	        }
	
	        if (placeFrom != '') {
	            googleMaps.codeAddress(0, placeFrom);
	        }
	    });
	
	    $("#" + prefix + "_routePoints_1_place").focusout(function() {
	        var placeFrom = $("#" + prefix + "_routePoints_0_place").val();
	        var placeTo = $("#" + prefix + "_routePoints_1_place").val();
	
	        if (placeFrom != '' && placeTo != '') {
	            googleMaps.calculateRoute(placeFrom, placeTo);
	            googleMaps.calculateDistance(placeFrom, placeTo);
	
	            return;
	        }
	
	        if (placeTo != '') {
	            googleMaps.codeAddress(1, placeTo);
	        }
	    });
	    
	    $('div.add-destination').on('click', function(e) {
	    	e.preventDefault();
	    	
	    	var collectionHolder = $('div.desticlone');
	        var currentIndex = collectionHolder.find('div.form-block-wrap').length;
	        var newRoutePoint = "<div class='form-block-wrap new-route-point'>" 
	        	+ "<div class='labels'>"
				+ "<label for='" + prefix + "_routePoints_" + currentIndex + "_place'>"
				+ "<i class='mp-icon-point-plus'></i> To:"
				+ "</label>"
				+ "</div>"
				+ "<div class='inputs'>"
				+ "<div class='uk-form-icon'>"
				+ "<input type='text' id='" + prefix + "_routePoints_" + currentIndex + "_place' name='createPassengerRequestRouteInfo[routePoints][" + currentIndex + "][place]' class='flex-input date-pick next-route-point' placeholder='Enter postcode, Venue or Place' value='' />"
				+ "<i class='mp-icon-nord-star'></i>"
				+ "</div>"
				+ "<span class='mp-icon-closed'></span>"
				+ "<div class='errors'></div>"
				+ "</div>"
				+ "</div>";
	
	        collectionHolder.append(newRoutePoint);
	        collectionHolder.data('index', currentIndex + 1);
	        
	        $(".next-route-point").on('focusout', function() {
	        	routeDisplay.process();
	        });
	        
	        $('.new-route-point .mp-icon-closed,.new-point-icon .mp-icon-closed').on('click', function(e) {
		    	e.preventDefault();
		    	
		    	var collectionHolder = $('div.desticlone');
		        var currentIndex = collectionHolder.find('div.form-block-wrap').length;
		        
		        collectionHolder.data('index', currentIndex - 1);
		        $(this).parent().parent().remove();
		        	        
		        routeDisplay.process();	        
		    });
	    });
	    
	    $(".next-route-point").on('focusout', function() {
        	routeDisplay.process();
        });
        
        $('.new-route-point .mp-icon-closed,.new-point-icon .mp-icon-closed').on('click', function(e) {
	    	e.preventDefault();
	    	
	    	var collectionHolder = $('div.desticlone');
	        var currentIndex = collectionHolder.find('div.form-block-wrap').length;
	        
	        collectionHolder.data('index', currentIndex - 1);
	        $(this).parent().parent().remove();
	        	        
	        routeDisplay.process();	        
	    });
        
        $(document).ready(function() {
            $(".next-route-point").on('focusout', function() {
	        	routeDisplay.process();
	        });
            
            $('.new-route-point .mp-icon-closed,.new-point-icon .mp-icon-closed').on('click', function(e) {
                e.preventDefault();

                var collectionHolder = $('div.desticlone');
                var currentIndex = collectionHolder.find('div.form-block-wrap').length;

                collectionHolder.data('index', currentIndex - 1);
                $(this).parent().parent().remove();

                routeDisplay.process();	        
            });
        });
	}
    
	return showRouting();
});