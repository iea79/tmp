require(['pages/common'], function ($) {
    require(['pages/table.resize','intl-tel-input-master/js/intlTelInput'], function () {

        // Смена класса кнопок Driver list в office passengers //////////////////// 
        var but_txt;
        $(document).ready(function () {

            var count = 0;
            $(".driverlist").click(function () {
                $(this).toggleClass("active-gray");

            });
        });


        selector = $(".phoneinput");

        selector.intlTelInput({
            defaultCountry: "auto",
            autoFormat: true,
            responsiveDropdown: true,
        });
        // just for formatting/placeholders/autoformat etc - set in template
        selector.intlTelInput("loadUtils", liphone_utils_path);
    });
});
