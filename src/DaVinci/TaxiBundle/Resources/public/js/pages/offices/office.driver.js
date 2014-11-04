require(["pages/common"], function ($) {
   require(['pages/table.resize'],function(){
   //Выбор цвета авто ////////////////////////
    $(window).bind("load", function () {
        $(".my-select").chosenImage({
            disable_search_threshold: 10
        });
    });
    
        //remove preloader
        togglePreloader(document.body,false);
   });
});