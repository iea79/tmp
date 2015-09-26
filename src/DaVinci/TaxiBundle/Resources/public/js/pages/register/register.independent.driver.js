require(["pages/common"], function($){
    require(['pages/register/country.block', 'pages/register/language.block','intl-tel-input-master/js/intlTelInput'], function(){
        require(['pages/register/phone.block'],function(){
            //remove preloader
            togglePreloader(document.body,false);
        });
        
    });
});
