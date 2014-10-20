require(['pages/common'], function(){
    require(['addons/form-password']);
    
    $(".passfield").change(function () {
        $('.passfield2').attr('pattern', this.value);
    });
});