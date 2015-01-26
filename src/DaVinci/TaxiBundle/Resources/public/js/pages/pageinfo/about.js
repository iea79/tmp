require(["pages/common"], function($){
    require(['pages/pageinfo/stickUp'], function(){
	            $('.buttom-swicher').stickUp({
	            	parts: {
	            		0:'passenger',
	            		1:'driver',
	            		2:'company'
	            	},
	            	itemClass: 'menuitem',
	            	itemHover: 'uk-active'
	            });
        //remove preloader
        togglePreloader(document.body,false);
    });
});