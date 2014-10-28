define(['jquery'], function($){
    require(['uikit'],function(UI){
        require(['addons/form-select','addons/form-password']);
    });
    
    //return jquery to use in other modules
    return $;
});