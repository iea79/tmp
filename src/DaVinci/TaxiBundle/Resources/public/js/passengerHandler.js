define("passengerHandler", ["officeRequester"], function(officeRequester) {
	function passengerHandler() {
		$(document).ready(function () {
            $(".driverlist").click(function () {
                $(this).toggleClass("active-gray");
            });
            
            $("button.approve-driver").on("click", function () {
            	hash = officeRequester.prepareRequest($(this).attr('value'));
            	officeRequester.makeRequest(
            		hash.query,
            		hash.request_id,
            		{driver_id: hash.driver_id}
            	);
            });
            
            $("button.decline-driver").on("click", function () {
            	hash = officeRequester.prepareRequest($(this).attr('value'));
            	officeRequester.makeRequest(
            		hash.query,
            		hash.request_id,
            		{driver_id: hash.driver_id}
            	);
            });
        });
	}
	
	return passengerHandler();
});