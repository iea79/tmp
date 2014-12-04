(function($)
{
    $(function()
    {
        var placeholder_support = !!('placeholder' in document.createElement( 'input' ));
        if (!placeholder_support)
        {
            var inputs = $('input[placeholder]'),
                    len = inputs.length,
                    input,
                    placeholder_class = 'placeholder';
            while (len--)
            {
                inputs[len].value = inputs[len].value ? inputs[len].value : inputs.eq(len).addClass(placeholder_class).attr('placeholder');
                inputs.eq(len).focus(function()
                {
                    var th = $(this);
                    if (this.value == th.attr('placeholder'))
                    {
                        th.removeClass(placeholder_class);
                        this.value = '';
                    }
                }).blur(function()
                {
                    var th = $(this);
                    if (this.value == '')
                    {
                        th.addClass(placeholder_class);
                        this.value = th.attr('placeholder');
                    }
                });
                (function(input)
                {
                    $(input.form).bind('submit', function()
                    {
                        if (input.value == $(input).attr('placeholder')) input.value = '';
                    });
                }(inputs[len]));
            }
        }
    });
}(jQuery));