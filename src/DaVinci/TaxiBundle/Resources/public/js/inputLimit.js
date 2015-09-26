// input limit for number values
define("inputLimit", function() {
	function inputLimit() {
	    $('.minus').click(function () {
	        var input = $(this).parent().find('input');
	        var count = parseInt(input.val()) - 1;
	        
	        count = (count < 0) ? 0 : count;

	        input.val(count);
	        input.change();
	        
	        return false;
	    });

	    $('.plus').click(function () {
	    	var input = $(this).parent().find('input');
	    	var count = parseInt(input.val()) + 1;
	    	
	    	count = (count > 12) ? 12 : count;
	    	     	
	        input.val(count);
	        input.change();
	        
	        return false;
	    });
	    
	    $('.limited').focusout(function () {
	    	var input = $(this).parent().find('input');
	    	var count = input.val();
	    	
	    	count = (count > 12 || count < 0) ? 0 : count;
	    	     	
	        input.val(count);
	        input.change();
	        
	        return false;
	    });
	}
	
	return inputLimit();
});