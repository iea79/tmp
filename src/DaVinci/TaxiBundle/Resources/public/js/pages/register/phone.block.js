require(["jquery"], function($){
    $('body').on('click', "#addphone", function () {

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
    
    function init_phone_field(last)
    {
        //default is true
        last = typeof last !== 'undefined' ? last : true;
        
        var selector;
        if(last)
            selector = $(".phoneinput:last");
        else
            selector = $(".phoneinput");
        
        selector.intlTelInput({
            defaultCountry: "auto",
            autoFormat: true,
            responsiveDropdown: true,
        });
        // just for formatting/placeholders/autoformat etc - set in template
        selector.intlTelInput("loadUtils", liphone_utils_path);
        selector.width('100%');
    }

    init_phone_field(false); //init all fields

});