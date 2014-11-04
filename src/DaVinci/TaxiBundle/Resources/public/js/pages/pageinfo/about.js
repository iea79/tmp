require(["pages/common"], function($){
    require(['pages/pageinfo/stickUp'], function(){
	    jQuery(function($) {
	        $(document).ready( function() {
	            $('.buttom-swicher').stickUp({
	            	parts: {
	            		0:'passenger',
	            		1:'driver',
	            		2:'company'
	            	},
	            	itemClass: 'menuitem',
	            	itemHover: 'uk-active'
	            });
	        });
	    });
        
    });
});