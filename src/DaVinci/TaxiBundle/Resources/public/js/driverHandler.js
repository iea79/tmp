define("driverHandler", ["officeRequester"], function(officeRequester) {
	function driverHandler() {
		$(document).ready(function () {
			$("a.confirm-deal").on("click", function () {
            	hash = officeRequester.prepareRequest($(this).attr('value'));
            	officeRequester.makeDriverRequest(
            		'confirmation',	
            		hash.query,
            		hash.request_id,
            		{driver_id: hash.driver_id}
            	);
            });
            
            $("a.decline-deal").on("click", function () {
            	hash = officeRequester.prepareRequest($(this).attr('value'));
            	officeRequester.makeDriverRequest(
            		'declination',	
            		hash.query, 
            		hash.request_id,
            		{driver_id: hash.driver_id}
            	);
            });
        });
	}
	
	return driverHandler();
});