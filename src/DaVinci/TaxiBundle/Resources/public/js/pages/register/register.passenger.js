require(['pages/common'], function($){
    $(".passfield").change(function () {
        $('.passfield2').attr('pattern', this.value);
    });
});