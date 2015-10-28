define('routeDisplay', ['googleMaps'], function(googleMaps) {
	var RouteDisplay = function() {
		this.process = function() {
	    	var placeFrom = $("#createPassengerRequestRouteInfo_routePoints_0_place").val();
	        var placeTo;
	        
	        var start = placeFrom;
	                            
	        var intervals = new Array();
	        var paramName = 'createPassengerRequestRouteInfo_routePoints_';
	        
	        $(".next-route-point").each(function() {
	        	var paramValue = $(this).attr('id');
	        	var elementId = paramValue.substr(paramName.length, 1);
	        	
	        	if ($(this).val() != '') {
	        		intervals[elementId] = $(this).val();
	        	}
	        });
	        
	        
	        var origins = new Array();
	        var destinations = new Array();
	        var count = 0;
	        
	        for (var index in intervals) {
	        	placeTo = intervals[index];
	        	
	        	origins[count] = placeFrom;
	        	destinations[count] = placeTo;
	        	
	        	placeFrom = placeTo;
	        	
	        	count++;
	        }
	        
	        var wayPoints = [];
	        var end = placeTo;
	        
	        for (var index = 0; index < origins.length; index++) {
	        	if (index == 0) {
	        		continue;
	        	}
	        	
	        	wayPoints.push({
	        		location: origins[index],
	                stopover: true
	        	});
	        }
	        
	        googleMaps.calculateComplexDistance(origins, destinations);
	        googleMaps.calculateComplexRoute(start, wayPoints, end);
		}    
	}
	
	return new RouteDisplay();
});	