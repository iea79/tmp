require(["jquery"], function($){
    $('body').on('click', ".addotherlanguage", function () {
        var num = $('.addlangline select').length;

     if(num < 2){
        // Get the data-prototype
        var lang_proto = $($('#language_prototype').val().replace(/__name__/g, num));
        $('.addotherlanguage').before(lang_proto);
        return false;
     }
     else{
        alert('Выбрано больше чем 2 языка!');
        return false;
     }   
    });
    $('body').on('click','.lang-close',function(){
        $(this).prev('select').remove();
        
        $(this).remove();
        return false;
    })
    
});
