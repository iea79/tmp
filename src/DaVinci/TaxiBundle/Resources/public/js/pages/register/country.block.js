require(["jquery"], function ($) {

    var country = $('.country_selector');
    $(".country_selector").val($(".country_selector option:first").val());
    var xhr;
    // When country gets selected ...
    country.change(function () {
        // ... retrieve the corresponding form.
        var $form = $(this).closest('form');
        // Simulate form data, but only include the selected sport value.
        var data = {};
        data[country.attr('name')] = country.val();
        // Submit data via AJAX to the form's action path.

        $('.city_selector option').remove();

        if (typeof xhr != 'undefined')
            xhr.abort();
        xhr = $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                //stupid hack to reload uikit select
                $(".city_selector").parent().find('span').html($(html).find('.city_selector option:first').html());
                
                // ReplaceReplace current position field ...
                $('.city_selector').append(
                        // ... with the returned one from the AJAX response.
                        $(html).find('.city_selector option')
                        );
                $(".city_selector").val($(".city_selector option:first").val());

            }
        });
    });
    //remove preloader
    togglePreloader(document.body,false);
});