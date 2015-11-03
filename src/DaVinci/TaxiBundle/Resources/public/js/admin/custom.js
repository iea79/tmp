$( document ).ready(function() {
    selector = $(".phone");

    selector.intlTelInput({
        defaultCountry: "auto",
        autoFormat: true,
        responsiveDropdown: true,
    });
    // just for formatting/placeholders/autoformat etc - set in template
    selector.intlTelInput("loadUtils", "/bundles/davincitaxi/js/intl-tel-input-master/lib/libphonenumber/build/utils.js");
    });