function togglePreloader(selector,show){
    if(selector === undefined) selector = document.body;
    var spin = selector.getElementsByClassName("mp-spinner")[0];
    if(spin !== undefined||((show !=undefined)&&!show))
        spin.parentNode.removeChild(spin);
    else
        selector.insertAdjacentHTML('beforeend','<div class="mp-spinner"><div class="uk-icon-spinner uk-icon-spin"><div></div>');
}

define(['jquery'], function($){
    require(['uikit'],function(UI){
        
        //remove my account button loading
        $('.autorized').removeClass('loading');
        
        require(['addons/form-select','addons/form-password']);
    });
    
    //return jquery to use in other modules
    return $;
});