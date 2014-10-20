
if ($(".register").length) {

	function setBlockHeight() {
		contentheight = 0;
		$(".active .blockoffice ul").each(function (ind, el) {
			height = $(this).height();
			if (height > contentheight)
				contentheight = height;
		});
		$(".active .blockoffice ul").css({'height': contentheight});
	}
/*Переключаем радиобатоны в засисимости от того какое поле мы используем*/
    $('.uk-width-1-1 input[type="text"]').siblings('input[type="radio"]').prop( "checked", false);
    $('.uk-width-1-1 select').siblings('input[type="radio"]').prop( "checked", false);
    $('.uk-width-4-7 input[type="text"]').change(function () {
        $(this).siblings('input[type="radio"]').prop( "checked", true );
    });
    $('.uk-width-4-7 select').change(function () {
        $(this).parent().siblings('input[type="radio"]').prop( "checked", true );
    });
/***************/

    /*$('.addotherlanguage').click(function () {
				$( ".addlangline select" ).wrap(function() {
				  return "<div class='uk-form-select select uk-width-1-1 float_left' data-uk-form-select='' data-uk-observe=''><span>Please select...</span><i class='uk-icon-caret-down'></i>" + $( this ) + "</div>";
				});

            $( ".addlangline select" ).load(function() {
				$( ".addlangline select" ).wrap( '<div class="uk-form-select select uk-width-1-1 float_left" data-uk-form-select="" data-uk-observe=""><span>Please select...</span><i class="uk-icon-caret-down"></i> </div>' );
            });
    });*/



    $("#content .content-block textarea").keyup(function () {
        if (this.value.length > 300)
            this.value = this.value.substr(0, 300);
    });

    $("#content .content-block .wishes textarea").keyup(function () {
        if (this.value.length > 200)
            this.value = this.value.substr(0, 200);
    });
//register page/////////////////////////////
    function add2PassPattern(text)
    {
        $('.passfield2').attr('pattern', text);
    }
    $(".passfield").change(function () {
        add2PassPattern(this.value);
    });

//check Email js////////////////////////
    $('#resend_email a').click(function (e) {
        e.preventDefault();
        $('#change_email_block').show();
    });



}