require(['pages/common', 'gmaps'], function ($, gmaps) {
    require(['timepicker', 'jquery.spinner', 'jquery.form', 'datarange', 'addons/datepicker', 'chosen.jquery', 'pages/table.resize', 'charCount'], function () {
        require(['chosenImage.jquery'], function () {

            //Добавление доролнительных направлений 
            $('.destination .add-lang').click(function () {
                $('.destination .desticlone .to:last-child').clone().appendTo(".destination .desticlone");
            });




//simbols left in textarea in step 2 homepage

            $(".charcount").charCount();



//Скрытие и открытие дополнительных спкцификаций на 2-м шаге главной
            $('.spec-request').click(function () {
                $(this).next('.checks').toggle();
            });

            $('.chois li').change(function () {
                var ind = $('.chois li').index($('li.uk-active')[0]);
                alert(ind);
            });
//Скрытие и открытие обратной даты на 1-м шаге главной
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
//Скрытие и открытие данных для заказа другому человеку на 3-м шаге главной
            /* This is not applicable so far, but can be used any moment again 
             
             $(function(){
             $('.another-wrap').hide();
             });
             $(function(){
             $('.nottravel input[type=checkbox]').click(function(){
             var checked = this.checked;
             if(checked) $('.another-wrap').show();
             else $('.another-wrap').hide();
             });
             }); */
//Карта для главной страницы
            var initialize = function() {
            	var mapOptions = {
                    zoom: 9,
                    center: new gmaps.LatLng(55.752, 37.615),
                    panControl: true,
        			zoomControl: true,
        			scaleControl: true,
        		    mapTypeId: gmaps.MapTypeId.ROADMAP
                };
            	
                var map = new gmaps.Map(
                	document.getElementById('map-canvas'),
                    mapOptions
                );
            };
            
            gmaps.event.addDomListener(window, 'load', initialize);
            
            $(document).ready(function() {
            	initialize();
            });

//accordeon for buttoons in step 2 of homepage
            $(".order-details .uk-nav-parent-icon").click(function () {
                $(this).find(".uk-parent").toggleClass("uk-open");
            });

//show and hide texareas on step 2 of homepage
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

//default disable for a in buttons 2 step
            $('.spec-request .uk-parent > a, .auto-tip a').click(function (event) {
                return false;
            });
            
            //remove preloader
            togglePreloader(document.body,false);
        });
    });

});

