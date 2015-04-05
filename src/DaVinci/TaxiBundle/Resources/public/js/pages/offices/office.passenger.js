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

        var Requester = function() {
        	
        	var host = 'http://taximyprice.com';
        	// var host = 'http://taxi-my-price.dev';
        	
        	this.prepareRequest = function(values) {
        		var hash = new Object();
        		var params = values.split('-');
            	
        		for (var i = 0; i < params.length; i++) {
            		if (params[i].charAt(1) != ':') {
            			continue;
            		}
            		
            		var param = params[i].split(':');
            		if (i == 0) {
            			hash.query = param[1];
            		}
            		
            		if (i == 1) {
            			hash.driver_id = param[1];
            		}
            	}
            	
            	return hash;
        	} 
        	
        	this.makeRequest = function(query, sendData) {
        		$.ajax({
                    url: host + query,
                    data: sendData,
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                    	return;
                    }
                });	
        	}
        	
        }
        var requester = new Requester();
        
        // Смена класса кнопок Driver list в office passengers //////////////////// 
        var but_txt;
        $(document).ready(function () {
            var count = 0;
            $(".driverlist").click(function () {
                $(this).toggleClass("active-gray");
            });
            
            $("button.approve-driver").on("click", function () {
            	hash = requester.prepareRequest($(this).attr('value'));
            	requester.makeRequest(
            		hash.query, 
            		{driver_id: hash.driver_id}
            	);
            });
            
            $("button.decline-driver").on("click", function () {
            	hash = requester.prepareRequest($(this).attr('value'));
            	requester.makeRequest(
            		hash.query, 
            		{driver_id: hash.driver_id}
            	);
            });
        });
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#avatar-image').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        //remove preloader
        togglePreloader(document.body,false);
    });
});
