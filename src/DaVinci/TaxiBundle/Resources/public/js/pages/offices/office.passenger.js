require(['pages/common'], function ($) {
    require(['jquery.form.min','pages/table.resize', 'intl-tel-input-master/js/intlTelInput'], function () {
        
        

        function initProfileForm() {
            
            $('.passenger-profile-form').submit(function (e) {
                togglePreloader(document.body,false);
                e.preventDefault();
                var form = $('.passenger-profile-form').ajaxSubmit( function (data) {
                    if (data == 'success')
                        $.UIkit.modal("#Profile").hide();
                    else
                    {
                        $('#profile-dialog').html(data);
                        initProfileForm();
                    }
                    togglePreloader(document.body,false);
                });
                togglePreloader($('#profile-dialog'));
            });

            selector = $(".phoneinput");

            selector.intlTelInput({
                defaultCountry: "auto",
                autoFormat: true,
                responsiveDropdown: true,
            });
            // just for formatting/placeholders/autoformat etc - set in template
            selector.intlTelInput("loadUtils", liphone_utils_path);
            $("#taxi_passenger_office_profile_photo").change(function () {
                readURL(this);
            });

            $(".passfield").change(function () {
                $('.passfield2').attr('pattern', this.value);
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

        // Смена класса кнопок Driver list в office passengers //////////////////// 
        var but_txt;
        $(document).ready(function () {

            var count = 0;
            $(".driverlist").click(function () {
                $(this).toggleClass("active-gray");

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
        //remove preloader
        togglePreloader(document.body,false);
    });
});
