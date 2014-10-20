/*Переключаем радиобатоны в засисимости от того какое поле мы используем*/
    $('.uk-width-1-1 input[type="text"]').siblings('input[type="radio"]').prop( "checked", false);
    $('.uk-width-1-1 select').siblings('input[type="radio"]').prop( "checked", false);
    $('.uk-width-4-7 input[type="text"]').change(function () {
        $(this).siblings('input[type="radio"]').prop( "checked", true );
    });
    $('.uk-width-4-7 select').change(function () {
        $(this).parent().siblings('input[type="radio"]').prop( "checked", true );
    });









    $("#content .content-block textarea").keyup(function () {
        if (this.value.length > 300)
            this.value = this.value.substr(0, 300);
    });

    $("#content .content-block .wishes textarea").keyup(function () {
        if (this.value.length > 200)
            this.value = this.value.substr(0, 200);
    });
//register page/////////////////////////////


//check Email js////////////////////////



