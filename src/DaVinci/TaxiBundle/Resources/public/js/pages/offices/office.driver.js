require(["pages/common"], function ($) {
    require(['jquery.form.min','pages/table.resize', 'pages/register/country.block', 'pages/register/language.block', 'intl-tel-input-master/js/intlTelInput', 'datarange', 'charCount', 'driverHandler', 'datatable', 'changeOffice', 'showRouteMap'], function () {
        require(['pages/register/phone.block'], function () {

            function initProfileForm() {
                
                $('option:selected', '#taxi_driver_office_profile_vehicle_model').removeAttr('selected')
                $('#taxi_driver_office_profile_vehicle_model option:contains("'+selected_model+'")').attr('selected', 'selected');
 
                $('.driver-profile-form').submit(function (e) {
                    togglePreloader(document.getElementById('Profile'), false);
                    e.preventDefault();
                    
                    var form = $('.driver-profile-form').ajaxSubmit(function(data) {
                        if (data == 'success') {
                            $.UIkit.modal("#Profile").hide();
                        } else {
                            $('#profile-dialog').html(data);
                            initProfileForm();
                        }
                        
                        togglePreloader(document.getElementById('Profile'), false);
                    });
                    
                    togglePreloader(document.getElementById('Profile'));
                });

                selector = $(".phoneinput");

                selector.intlTelInput({
                    defaultCountry: "auto",
                    autoFormat: true,
                    responsiveDropdown: true,
                });

                $('#about_me_example').click(function () {
                    var cur_text = $('#taxi_driver_office_profile_about').val()

                    //switch state 
                    $(this).toggleClass('example-active');

                    //if user didn't change example.
                    if (example_about == cur_text) {
                        //remove example
                        //saved_text - variable in office_driver_profile_edit_form.html.twig
                        $('#taxi_driver_office_profile_about').val(saved_text);
                    } else {
                        //add example
                        saved_text = cur_text;
                        $('#taxi_driver_office_profile_about').val(example_about);

                    }
                })
                
                $('#about_vehicle_example').click(function () {
                    var cur_text = $('#taxi_driver_office_profile_vehicle_about').val()

                    //switch state 
                    $(this).toggleClass('example-active');

                    //if user didn't change example.
                    if (example_vehicle_about == cur_text) {
                        //remove example
                        //saved_text - variable in office_driver_profile_edit_form.html.twig
                        $('#taxi_driver_office_profile_vehicle_about').val(saved_vehicle_text);
                    } else {
                        //add example
                        saved_vehicle_text = cur_text;
                        $('#taxi_driver_office_profile_vehicle_about').val(example_vehicle_about);
                    }
                })
                
                $(".charcount").charCount();

                $('#Profile select').styler({'selectSearch':0});

                $("#taxi_driver_office_profile_vehicle_make").change(function(){
                    
                    // ... retrieve the corresponding form.
                    var $form = $(this).closest('form');
                    // Simulate form data, but only include the selected sport value.
                    var data = {};
                    data[$('#taxi_driver_office_profile_vehicle_make').attr('name')] = $('#taxi_driver_office_profile_vehicle_make').val();
                    // Submit data via AJAX to the form's action path.

                    var vehicle_model_selector = $('#taxi_driver_office_profile_vehicle_model');
 
                    $('#taxi_driver_office_profile_vehicle_model option').remove();
                    vehicle_model_selector.trigger('refresh');

                    if (typeof xhr != 'undefined')
                        xhr.abort();
                        xhr = $.ajax({
                        url: $form.attr('action'),
                        type: $form.attr('method'),
                        data: data,
                        success: function (html) {
                            var options = $(html).find('#taxi_driver_office_profile_vehicle_model option');
                            // ReplaceReplace current position field ...
                            vehicle_model_selector.append(
                                    // ... with the returned one from the AJAX response.
                                    options
                            );
                            vehicle_model_selector.val(options.first().val());
                            vehicle_model_selector.trigger('refresh');
                        }
                    });
                });

                // Add/change vehicle photo
                $("#taxi_driver_office_profile_vehicle_photo").change(function () {
                    readURLVehicle(this);
                });
                
                // Add/change driver photo
                $("#taxi_driver_office_profile_user_photo").change(function () {
                    readURLDriverPhoto(this);
                });

                $('#taxi_driver_office_profile_vehicle_seats option[value="0"]').hide().this().parent().parent('jq-selectbox').trigger('refresh');
                
                //$('.vehicle-class').styler();

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
                
            }

            // show dialog if driver didn't fill additional data

            function editInsuranceAccepted () {
                var vehicleClassIndependentDriver = document.getElementById('taxi_driver_office_profile_vehicle_vehicleClass');
                var checkboxInsuranceAccepted = document.getElementById('taxi_driver_office_profile_insuranceAccepted');

                $(vehicleClassIndependentDriver).change( function(){
                    var vehicleClassVal = $(this).val();

                    if ( vehicleClassVal <= 0) {
                        $(checkboxInsuranceAccepted).removeAttr('checked');
                        // $(checkboxInsuranceAccepted).attr('checked',false);
                        // alert('Мало');
                    } else {
                        // $(checkboxInsuranceAccepted).attr('checked', 'checked');
                        $(checkboxInsuranceAccepted).attr('checked', true);
                        // alert('Норм');
                    }
                    return true;
                });
                
            }


            var ajx;
            $('#Profile').on({

                'uk.modal.show': function () {
                    $("#profile-dialog").html('');
                    
                    togglePreloader(document.getElementById('Profile'), true);
                    if ($.active > 0) {
                        // where ajx is ajax variable
                        ajx.abort();
                    }
                    
                    ajx = $.ajax({
                        url: office_passenger_profile,
                        dataType: "html",
                        success: function (data) {
                            togglePreloader(document.getElementById('Profile'), false);
                            $("#profile-dialog").html(data);
                            
                            if (typeof is_filled != "undefined"  && !is_filled){
                                // disable cancel if not filled yet
                                $(".uk-close").remove();
                                editInsuranceAccepted();
                            }

                            initProfileForm();
                        }
                    });
                },
                'uk.modal.hide': function () {
                    togglePreloader(document.getElementById('Profile'), false);

                    //TODO: find all username/sirname/photos on  the page
                }
            });

            
            //Выбор цвета авто ////////////////////////
            $(window).bind("load", function () {
                $(".my-select").chosenImage({
                    disable_search_threshold: 10
                });
            });

            // Add/change driver photo
            function readURLDriverPhoto(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var drImg = $('#avatar-image');
                    var preloadDriverImg = $(drImg).parent('.photo');

                    reader.onload = function (e) {
                        preloadDriverImg.addClass('loading_photo');
                        setTimeout(function() {
                            preloadDriverImg.removeClass('loading_photo');
                            $(drImg).attr('src', e.target.result);
                        }, 1500);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Add/change driver vehicle photo
            function readURLVehicle(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var vDrImg = $('#vechicle-driver-image');
                    var preloadDriverImg = $(vDrImg).parent('.photo');

                    reader.onload = function (e) {
                        
                        preloadDriverImg.addClass('loading_photo');
                        setTimeout(function() {
                            preloadDriverImg.removeClass('loading_photo');
                            $(vDrImg).attr('src', e.target.result);
                        }, 1500);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // datarange
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
            
            //remove preloader
            togglePreloader(document.body, false);
                        
            if (typeof is_filled != "undefined"  && !is_filled) {
                $("#open-profile-button").click();
            };

        });

    });
});

