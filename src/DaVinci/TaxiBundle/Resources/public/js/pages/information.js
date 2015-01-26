require(["pages/common"], function($){
    require(['charCount'], function(){
    	
		$(".charcount").charCount();
				
        //remove preloader
        togglePreloader(document.body,false);
	});
});