require(['pages/common'], function($){
    require(['addons/form-password'], function(){
    
        $(".passfield").change(function () {
            $('.passfield2').attr('pattern', this.value);
        });
    });
});