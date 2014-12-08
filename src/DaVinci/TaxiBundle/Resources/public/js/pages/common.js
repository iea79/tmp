function togglePreloader(selector, show){
    if(selector === undefined) selector = document.body;
    else if(selector instanceof jQuery) selector = selector[0];
    
    var spin_arr = selector.getElementsByClassName("mp-spinner");
    if(spin_arr.length>0)
        var spin = spin_arr[0];

    if(spin !== undefined||((show !=undefined)&&!show))
    {
        if(spin.parentNode === undefined)
        {
            if(spin !== undefined)
                document.body.removeChild(spin);
        }
        else
            spin.parentNode.removeChild(spin);
    }
    else if((show === undefined)||show)
        selector.insertAdjacentHTML('beforeend','<div class="mp-spinner"><div class="uk-icon-spinner uk-icon-spin"><div></div>');
}


define(['jquery', 'placeholder'], function($){
    require(['uikit'],function(UI){
        
        //remove my account button loading
        $('.autorized').removeClass('loading');
        
        require(['addons/form-select','addons/form-password']);

    });
    
    //return jquery to use in other modules
    return $;
});