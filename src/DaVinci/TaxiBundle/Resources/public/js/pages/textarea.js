require(["pages/common"], function($){
    require(['charCount'], function(){
	    jQuery(function($) {
	        $(document).ready( function() {
				$(".charcount").charCount();
	        });
	    });
        //remove preloader
        togglePreloader(document.body,false);
	});
});