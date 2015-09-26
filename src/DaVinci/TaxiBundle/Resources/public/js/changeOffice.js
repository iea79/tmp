define("changeOffice", function() {
	function changeOffice() {
		$(document).ready(function() {
            $("#activate_switch_office").on('click', function(e) {
		    	e.preventDefault();
                location.href = $("#switch_office").val();
            });    
        });
	}
	
	return changeOffice();
});