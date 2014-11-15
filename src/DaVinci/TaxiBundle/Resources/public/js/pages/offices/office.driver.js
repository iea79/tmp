require(["pages/common"], function ($) {

    require(['pages/table.resize', 'pages/register/country.block', 'pages/register/language.block', 'intl-tel-input-master/js/intlTelInput'], function () {

        require(['pages/register/phone.block'], function () {
            
            function initProfileForm() {
                $('.driver-profile-form').submit(function (e) {
                    togglePreloader(document.body, false);
                    e.preventDefault();
                    var form = $('.driver-profile-form').ajaxSubmit(function (data) {
                        if (data == 'success')
                            $.UIkit.modal("#Profile").hide();
                        else
                        {
                            $('#profile-dialog').html(data);
                            initProfileForm();
                        }
                        togglePreloader(document.body, false);
                    });
                    togglePreloader($('#profile-dialog'));
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
                    togglePreloader(document.getElementById('Profile'));
                    $('#profile-dialog').load(office_passenger_profile, function () {
                        togglePreloader(document.getElementById('Profile'));
                        initProfileForm();
                    });
                },
                'uk.modal.hide': function () {
                    togglePreloader($('#profile-dialog'));

                    //TODO: find all username/sirname/photos on  the page


                }
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