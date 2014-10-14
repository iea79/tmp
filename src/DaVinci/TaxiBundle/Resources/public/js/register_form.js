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

//	$('#country').change(function() {
//		$('.rowcity').show();	
//	});
//	$('#city').change(function() {
//		$('.rowstreet').show();	
//	});
//	$('#street').change(function() {
//		$('.rowbuild').show();	
//	});

/*Переключаем радиобатоны в засисимости от того какое поле мы используем*/
    $('.uk-width-1-1 input[type="text"]').change(function () {
        $(this).siblings('input[type="radio"]').prop( "checked", true );
    });

    $('.uk-width-1-1 select').change(function () {
        $(this).parent().siblings('input[type="radio"]').prop( "checked", true );
    });
/***************/

    //$('.register select').wrap('<div class="uk-form-select select uk-width-1-1 float_left" data-uk-form-select=""></div>');


    $('#taxi_company_registration_address_country').change(function () {
        $('.rowcity').show();
    });

    var $country = $('.country_selector');
    var xhr;
    // When country gets selected ...
    $country.change(function () {
        // ... retrieve the corresponding form.
        var $form = $(this).closest('form');
        // Simulate form data, but only include the selected sport value.
        var data = {};
        data[$country.attr('name')] = $country.val();
        // Submit data via AJAX to the form's action path.
        
        $('.city_selector option').remove();
        
        if(typeof xhr != 'undefined')
            xhr.abort();
        xhr = $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                // ReplaceReplace current position field ...
                $('.city_selector').append(
                        // ... with the returned one from the AJAX response.
                        $(html).find('.city_selector option')
                );
                $(".city_selector").val($(".city_selector option:first").val());
//                $('#taxi_company_registration_address_city').change('change', function () {
//                    $('.rowstreet').show();
//                });

            }
        });
    });

    $('.addphone').click(function () {

        $('.addphone').addClass('display_none'); //don't if want more phones
        // get the new index
        var num = $('.adphonik').length;

        // Get the data-prototype
        var phone_proto = $($('#phone_prototype').val().replace(/__name__/g, num));
        phone_proto.attr('tabindex', num + +phone_proto.attr('tabindex') + 2);
        var internet_proto = $($('#internet_prototype').val().replace(/__name__/g, num));
        internet_proto.attr('tabindex', num + +internet_proto.attr('tabindex') + 2);
        var whatsapp_proto = $($('#whatsapp_prototype').val().replace(/__name__/g, num));
        whatsapp_proto.attr('tabindex', num + +whatsapp_proto.attr('tabindex') + 2);

        //replace proto elements
        var newForm = $($('#phone_block_prototype').val());


        $(newForm).find('#phones_input').replaceWith($(phone_proto));
        $(newForm).find('#has_internet_input').replaceWith($(internet_proto));
        $(newForm).find('#has_whatsapp_input').replaceWith($(whatsapp_proto));


        $('.addphone').before(newForm);
        init_phone_field();

        return false;
    });

    $('.addotherlanguage').click(function () {
        var num = $('.addlangline select').length;

        // Get the data-prototype
        var lang_proto = $($('#language_prototype').val().replace(/__name__/g, num));
        $('.addotherlanguage').before(lang_proto);
        return false;
    });
    $("#content .content-block textarea").keyup(function () {
        if (this.value.length > 300)
            this.value = this.value.substr(0, 300);
    });

    $("#content .content-block .wishes textarea").keyup(function () {
        if (this.value.length > 200)
            this.value = this.value.substr(0, 200);
    });


/*    $('#manager .addlang').click(function () {
        $('.style1').last().addClass('style13');
        $('#manager .style1').clone().insertAfter('.style1').addClass('style2');
        $('.style2').removeClass('style1');
        return false;
    });
    $('#taxidriver .addlang').click(function () {
        $('.style1').last().addClass('style13');
        $('#taxidriver .style1').clone().insertAfter('.style1').addClass('style2');
        $('.style2').removeClass('style1');
        return false;
    });
    $('#independentdriver .addlang').click(function () {
        $('.style1').last().addClass('style13');
        $('#independentdriver .style1').clone().insertAfter('.style1').addClass('style2');
        $('.style2').removeClass('style1');
        return false;
    });
*/

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

    function init_phone_field()
    {
        $(".phoneinput:last").intlTelInput({
            defaultCountry: "auto",
            autoFormat: true,
            responsiveDropdown: true,
            utilsScript: liphone_utils_path // just for formatting/placeholders/autoformat etc
        });
    }
    $phone_fields = $(".phoneinput");
    if ($phone_fields.length)
    {
        init_phone_field();
    }

}