//copy of coommon.js togglePreloader function
function togglePreloader(selector, show){
    if(selector === undefined) selector = document.body;
    else if(typeof jQuery !== "undefined" && selector instanceof jQuery) selector = selector[0];
    
    var spin_arr = selector.getElementsByClassName("mp-spinner");
    if(spin_arr.length>0)
        var spin = spin_arr[0];
    
    if(spin === undefined) return;
    
    if(((show !== undefined)&&!show))
    {
        if(spin.parentNode === undefined)
            document.body.removeChild(spin);
        else
            spin.parentNode.removeChild(spin);
    }
    else if((show === undefined)||show)
        selector.insertAdjacentHTML('beforeend','<div class="mp-spinner"><div class="uk-icon-spinner uk-icon-spin"><div></div>');
}


togglePreloader(document.body,false);
