require(["pages/common"], function($){
    require(['charCount'], function(){
	    jQuery(function($) {
	        $(document).ready( function() {
				$("#simbols-left").charCount();
	        });
	    });
        //remove preloader
        togglePreloader(document.body,false);
	});
});