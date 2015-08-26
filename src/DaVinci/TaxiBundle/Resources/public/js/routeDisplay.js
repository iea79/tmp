define('routeDisplay', ['googleMaps'], function(googleMaps) {
	var RouteDisplay = function() {
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
                
		this.process = function() {
            var prefix = this.getPrefix(); 
	    	var placeFrom = $("#" + prefix + "_routePoints_0_place").val();
	        var placeTo;
	        alert(prefix);
	        var start = placeFrom;
	                            
	        var intervals = new Array();
	        var paramName = prefix + '_routePoints_';
	        
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
	        
	        for (var index = 1; index < origins.length; index++) {
	        	wayPoints.push({
	        		location: origins[index],
	                stopover: true
	        	});
	        }
	        
            if (origins.length > 0) {
                googleMaps.calculateComplexDistance(origins, destinations);
            }    
            googleMaps.calculateComplexRoute(start, wayPoints, end);
        }
        
        this.load = function() {
            var start = mapPoints[0];
            var end = mapPoints[mapPoints.length - 1];
	        
	        var wayPoints = [];
	        	        
	        for (var index = 1; index < mapPoints.length - 1; index++) {
	        	wayPoints.push({
	        		location: mapPoints[index],
	                stopover: true
	        	});
	        }
	        
            googleMaps.calculateComplexRoute(start, wayPoints, end);
	    }
	}
	
	return new RouteDisplay();
});	