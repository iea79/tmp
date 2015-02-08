require(["jquery"], function ($) {

    var country = $('.country_selector');

    var xhr;
    // When country gets selected ...
    $('body').on('change', ".country_selector", function () {
        // ... retrieve the corresponding form.
        var $form = $(this).closest('form');
        // Simulate form data, but only include the selected sport value.
        var data = {};
        data[country.attr('name')] = country.val();
        // Submit data via AJAX to the form's action path.

        var city_selector = $("select.city_selector");
        
        //clear dropdown
        city_selector.find('option').remove();
        city_selector.trigger('refresh');
        
        if (typeof xhr != 'undefined')
            xhr.abort();
        xhr = $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {

                var options = $(html).find('.city_selector option');
                // ReplaceReplace current position field ...
                city_selector.append(
                        // ... with the returned one from the AJAX response.
                        options
                        );
                city_selector.val(options.first().val());
                city_selector.trigger('refresh');
            }
        });
    });
});