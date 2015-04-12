define("passengerRequester", function() {
	var PassengerRequester = function() {
    	var host = 'http://taximyprice.com';
		    	        	
    	this.prepareRequest = function(values) {
    		var hash = new Object();
    		var params = values.split('-');
        	
    		for (var i = 0; i < params.length; i++) {
        		if (params[i].charAt(1) != ':') {
        			continue;
        		}
        		
        		var param = params[i].split(':');
        		if (i == 0) {
        			hash.query = param[1];
        		}
        		
        		if (i == 1) {
        			hash.driver_id = param[1];
        		}
        	}
        	
        	return hash;
    	} 
    	
    	this.makeRequest = function(query, sendData) {
    		$.ajax({
                url: host + query,
                data: sendData,
                type: "POST",
                dataType: "json",
                success: function(data) {
                	return;
                }
            });	
    	}
    	
    }
	
    return new PassengerRequester();
});