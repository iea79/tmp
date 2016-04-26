require(['pages/common'], function ($) {
    require(['jquery.form.min','pages/table.resize', 'showRouting', 'inputLimit', 'datarange', 'passengerHandler', 'changeOffice', 'intl-tel-input-master/js/intlTelInput'], function () {

        function initProfileForm() {
            
            $('.passenger-profile-form').submit(function (e) {
                togglePreloader(document.getElementById('Profile'),true);
                e.preventDefault();
                var form = $('.passenger-profile-form').ajaxSubmit( function (data) {
                    if (data == 'success')
                        $.UIkit.modal("#Profile").hide();
                    else
                    {
                        $('#profile-dialog').html(data);
                        initProfileForm();
                    }
                    togglePreloader(document.getElementById('Profile'),false);
                });
                
            });

            selector = $(".phoneinput");

            selector.intlTelInput({
                defaultCountry: "auto",
                autoFormat: true,
                responsiveDropdown: true
            });
            // just for formatting/placeholders/autoformat etc - set in template
            selector.intlTelInput("loadUtils", liphone_utils_path);

            $("#taxi_passenger_office_profile_photo").change(function () {
                readURL(this);
            });

            $(".passfield").change(function () {
                $('.passfield2').attr('pattern', this.value);
            });

                $('#Profile select').styler({'selectSearch':0});

        }
        
        var ajx;
        $('#Profile').on({
            'uk.modal.show': function () {
                $("#profile-dialog").html('');
                togglePreloader(document.getElementById('Profile'), true);
                if($.active > 0){ 
                    ajx.abort();//where ajx is ajax variable
                }
                ajx = $.ajax({
                        url: office_passenger_profile,
                        dataType: "html",
                        success: function(data) {
                          togglePreloader(document.getElementById('Profile'), false);
                          $("#profile-dialog").html(data);
                          initProfileForm();
                        }
                      });
            },
            'uk.modal.hide': function () {
                togglePreloader(document.getElementById('Profile'), false);
                
                //TODO: find all username/sirname/photos on  the page
                
                
            }
        });

        // datapicker and datarange
        $('.date-input').pickmeup_uikit({
            format: 'd.m.y',
            position        : 'bottom',
            hide_on_select  : true
        });

        // Смена класса кнопок Driver list в office passengers //////////////////// 
        var but_txt;
                
        // Add/change passenger photo vol.2
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var passImg = $('#avatar-image');
                var preloadWrapImg = $(passImg).parent('.photo');

                reader.onload = function (e) {

                    preloadWrapImg.addClass('loading_photo');
                    setTimeout(function() {
                        preloadWrapImg.removeClass('loading_photo');
                        $(passImg).attr('src', e.target.result);
                    }, 1500);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

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
                
        //remove preloader
        togglePreloader(document.body,false);

    });
});
