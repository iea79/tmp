define(['jquery'], function($){
    require(['uikit'],function(UI){
        require(['addons/form-select']);
    });
    
    //return jquery to use in other modules
    return $;
});