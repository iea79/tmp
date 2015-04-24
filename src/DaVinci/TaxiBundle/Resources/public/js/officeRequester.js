define("officeRequester", function() {
	var OfficeRequester = function() {
    	var host = 'http://taximyprice.com';
		// var host = 'http://taxi-my-price.dev';
		
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
        		
        		if (i == 2) {
        			hash.request_id = param[1];
        		}
        	}
        	
        	return hash;
    	} 
    	
    	this.makeRequest = function(query, requestId, sendData) {
    		$.ajax({
                url: host + query,
                data: sendData,
                type: "POST",
                dataType: "json",
                success: function(data) {
                	if (data.status == 'ok') {
                		$("result_" + requestId).html("Request completed!");
                		$("approve_driver_" + requestId).remove();
                		
                		location.reload(true);
                	}
                	
                	return;
                }
            });	
    	}
    	
    	this.makeDriverRequest = function(action, query, requestId, sendData) {
    		$.ajax({
                url: host + query,
                data: sendData,
                type: "POST",
                dataType: "json",
                success: function(data) {
                	if (data.status == 'ok' && action == 'confirmation') {
                		$("request_status_" + requestId).html("sold");
                		$("confirm_"  + requestId).html("Deal confirmed");
                		
                		location.reload(true);
                	}
                	
                	return;
                }
            });	
    	}
    }
	
    return new OfficeRequester();
});