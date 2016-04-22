require(['pages/common'], function ($) {
    require(['jquery.spinner', 'jquery.form', 'datarange', 'chosen.jquery', 'pages/table.resize', 'charCount', 'showRouting', 'showRouteMap', 'inputLimit', 'intl-tel-input-master/js/intlTelInput', 'datatable'], function () {
        require(['chosenImage.jquery'], function () {

            // Добавление доролнительных направлений 
            $('.destination .add-lang').click(function () {
                $('.destination .desticlone .to:last-child').clone().appendTo(".destination .desticlone");
            });

            // symbols left in textarea in step 2 homepage
            $(".charcount").charCount();

            // Скрытие и открытие дополнительных спкцификаций на 2-м шаге главной
            $('.spec-request').click(function () {
                $(this).next('.checks').toggle();
            });

            $('.chois li').change(function () {
                var ind = $('.chois li').index($('li.uk-active')[0]);
                alert(ind);
            });
            
            // Скрытие и открытие обратной даты на 1-м шаге главной
            $(function () {
                $('#round_trip').hide();
                $('.destination .check-box input[type=checkbox]:checked').each(function () {
                    $('.destination #round_trip').show();
                });
            });

            $(".destination .check-box input[type=checkbox]").click(function () {
                var checked = this.checked;
                var targetBlock = $('.destination').parent().find('#round_trip');
                if (checked)
                    targetBlock.show();
                else
                    targetBlock.hide();
            });
                        
            // Ajax request processing            
            
            // accordeon for buttoons in step 2 of homepage
            $(".order-details .uk-nav-parent-icon").click(function() {
                $(this).find(".uk-parent").toggleClass("uk-open");
            });

            // show and hide texareas on step 2 of homepage
            $(function () {
                $('.kids-pats-line .wishes-1').hide();
                $('.kids-pats-line input[type=checkbox]:checked').each(function () {
                    $(this).parent().find('.wishes-1').show();
                });
            });
            
            $(".kids-pats-line input[type=checkbox]").click(function () {
                var checked = this.checked;
                var targetBlock = $(this).parent().find('.wishes-1');
                if (checked)
                    targetBlock.show();
                else
                    targetBlock.hide();
            });

            // default disable for a in buttons 2 step
            $('.spec-request .uk-parent > a, .auto-tip a').click(function (event) {
                return false;
            });

            // datapicker and datarange
            $('.date-input').pickmeup_uikit({
                format: 'd.m.y',
                position        : 'bottom',
                hide_on_select  : true
            });

            var plus_5_days = new Date;
            plus_5_days.addDays(5);                                       
            
            $('.daterange input').pickmeup_uikit({
                format: 'd/m/y',
                position        : 'bottom',
                hide_on_select  : true,
                date        : [
                    new Date,
                    plus_5_days
                ],
                mode        : 'range',
                calendars   : 1
            });
            
            $("#back_passenger_request_button").on('click', function(e) {
                e.preventDefault();
                
                location.href = $(this).attr('value');
            });
            
            $("#edit_passenger_request_button").on('click', function(e) {
                e.preventDefault();
                
                $("#confirmationInfo_edit_passenger_request").val('1');
                $("#main_passenger_request_form").submit();
            });
            
            $("#confirm_passenger_request_button").on('click', function(e) {
                e.preventDefault();
                
                $("#confirmationInfo_edit_passenger_request").val('0');
                $("#main_passenger_request_form").submit();
            });
                      
            $("#cancel_edit_passenger_request_button").on('click', function(e) {
                e.preventDefault();
                
                location.href = $(this).attr('value');
            });
            
            $("#confirm_edit_passenger_request_button").on('click', function(e) {
                e.preventDefault();
                
                $("#editPassengerRequest_edit_passenger_request").val('2');
                $("#main_passenger_request_form").submit();
            });
            

            // Прелоадер для кнопки и вывод имени загруженного файла при добавлении фото при оформлении поездки - шаг 3
            $('.button__file__add input').on('change', function() {
                realVal = $(this).val();
                lastIndex = realVal.lastIndexOf('\\') + 1;
                preloadBtn = $(this).parent().parent('.uk-form-file').find('.uk-icon-spin');
                rezultLoad = $(this).parent().parent('.uk-form-file').find('.image__add__rezult');

                    if(lastIndex !== -1) {
                        realVal = realVal.substr(lastIndex);
                        preloadBtn.show();
                        setTimeout(function() {
                            preloadBtn.hide();
                            rezultLoad.html('Loaded: ' + realVal);
                    }, 1500);
                }
            });

            $(".mobile__phone").intlTelInput();

            function init_phone_field(last)
            {
                // default is true
                last = typeof last !== 'undefined' ? last : true;
                
                var selector;
                if (last)
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

            // remove preloader
            togglePreloader(document.body, false);

        });
    });

});

