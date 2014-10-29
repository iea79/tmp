require(["pages/common"], function($){
    require(['pages/pageinfo/stickUp'], function(){
	    jQuery(function($) {
	        $(document).ready( function() {
	            //активируем stickUp на элементе с классом '.navbar-wrapper'
	            $('.buttom-swicher').stickUp();
	        });
	    });
        
    });
});