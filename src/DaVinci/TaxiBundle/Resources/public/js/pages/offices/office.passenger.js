require(['pages/common'], function ($) {
    require(['jquery.form.min','pages/table.resize', 'intl-tel-input-master/js/intlTelInput'], function () {

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
        
        var ajx;
        $('#Profile').on({
            'uk.modal.show': function () {
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
