require(["pages/common"], function ($) {

    require(['pages/table.resize', 'pages/register/country.block', 'pages/register/language.block', 'intl-tel-input-master/js/intlTelInput', 'charCount'], function () {

        require(['pages/register/phone.block'], function () {
            
            function initProfileForm() {
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
            }
            $('#Profile').on({
                'uk.modal.show': function () {
                    togglePreloader(document.getElementById('Profile'), true);
                    $('#profile-dialog').load(office_passenger_profile, function () {
                        togglePreloader(document.getElementById('Profile'),false);
                        initProfileForm();
                    });
                },
                'uk.modal.hide': function () {
                    togglePreloader(document.getElementById('Profile'),false);

                    //TODO: find all username/sirname/photos on  the page


                }
            });

            // sibols left in textarea
            jQuery(function($) {
                $(document).ready( function() {
                    $(".charcount").charCount();
                });
            });


            //Выбор цвета авто ////////////////////////
            $(window).bind("load", function () {
                $(".my-select").chosenImage({
                    disable_search_threshold: 10
                });
            });

            //remove preloader
            togglePreloader(document.body, false);
        });

    });
});