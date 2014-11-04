define(['jquery'], function($){
    require(['uikit'],function(UI){
        require(['addons/form-select','addons/form-password']);
    });
    
    //return jquery to use in other modules
    return $;
});

function setPreloader(selector){
    //selector.html('<i class="uk-icon-spinner uk-icon-spin"></i>');
    selector.append('<div class="mp-spinner"><div class="uk-icon-spinner uk-icon-spin"><div></div>');
}