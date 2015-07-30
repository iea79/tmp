require(["pages/common"], function ($) {

    require(['jquery.form.min','pages/table.resize', 'pages/register/country.block', 'pages/register/language.block', 'intl-tel-input-master/js/intlTelInput', 'datarange', 'charCount', 'driverHandler', 'datatable', 'changeOffice'], function () {

        require(['pages/register/phone.block'], function () {

            function initProfileForm() {
                
                $('option:selected', '#taxi_driver_office_profile_vehicle_model').removeAttr('selected')
                $('#taxi_driver_office_profile_vehicle_model option:contains("'+selected_model+'")').attr('selected', 'selected');
 
                $('.driver-profile-form').submit(function (e) {
                    togglePreloader(document.getElementById('Profile'), false);
                    e.preventDefault();
                    var form = $('.driver-profile-form').ajaxSubmit(function (data) {
                        if (data == 'success')
                            $.UIkit.modal("#Profile").hide();
                        else
                        {
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
                    if (example_about == cur_text)
                    {
                        //remove example
                        //saved_text - variable in office_driver_profile_edit_form.html.twig
                        $('#taxi_driver_office_profile_about').val(saved_text);
                    } else
                    {
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
                    if (example_vehicle_about == cur_text)
                    {
                        //remove example
                        //saved_text - variable in office_driver_profile_edit_form.html.twig
                        $('#taxi_driver_office_profile_vehicle_about').val(saved_vehicle_text);
                    } else
                    {
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
                $("#taxi_driver_office_profile_vehicle_photo").change(function () {
                    readURL(this);
                });
                
                //$('.vehicle-class').styler();
                
            }

            // show dialog if driver didn't fill additional data

            var ajx;
            $('#Profile').on({
                'uk.modal.show': function () {
                    $("#profile-dialog").html('');
                    
                    togglePreloader(document.getElementById('Profile'), true);
                    if ($.active > 0) {
                        ajx.abort();//where ajx is ajax variable
                    }
                    ajx = $.ajax({
                        url: office_passenger_profile,
                        dataType: "html",
                        success: function (data) {
                            togglePreloader(document.getElementById('Profile'), false);
                            $("#profile-dialog").html(data);
                            
                            if(typeof is_filled != "undefined"  && !is_filled){
                                //disable cancel if not filled yet
                                $(".uk-close").remove();
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

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#avatar-image').attr('src', e.target.result);
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
                        
            if(typeof is_filled != "undefined"  && !is_filled)
            {
                $("#open-profile-button").click();
            }                      
        });
    });
});