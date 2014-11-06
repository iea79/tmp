require(["gmaps", "pages/common"], function (gMaps , $) {
    require(['timepicker', 'jquery.spinner', 'jquery.form', 'datarange', 'addons/datepicker', 'chosen.jquery', 'pages/table.resize'], function () {
        require(['chosenImage.jquery'], function () {

            //Добавление доролнительных направлений 
            $('.destination .add-lang').click(function () {
                $('.destination .desticlone .to:last-child').clone().appendTo(".destination .desticlone");
            });






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
                var startCheck = $('.inputs input[type=checkbox]').prop("checked");
                if (startCheck)
                    $('.destination .last').show();
                else
                    $('.destination .last').hide();
            });
            $(function () {
                $('.inputs input[type=checkbox]').click(function () {
                    var checked = this.checked;
                    if (checked)
                        $('.destination .last').show();
                    else
                        $('.destination .last').hide();
                });
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
            var map;
            (function initialize() {
                var mapOptions = {
                    zoom: 8,
                    center: new gMaps.LatLng(55.752, 37.615),
                    scrollwheel: false
                };
                map = new gMaps.Map(document.getElementById('map-canvas'),
                        mapOptions);
            })();

            //gMaps.event.addDomListener(window, 'load', initialize);

//accordeon for buttoons in step 2 of homepage
            $(".order-details .uk-nav-parent-icon").click(function () {
                $(this).find(".uk-parent").toggleClass("uk-open");
            });

//show and hide texareas on step 2 of homepage
            $(function () {
                $('.kids-pats-line .wishes-1').hide();
                $('.kids-pats-line label input[type=checkbox]:checked').each(function () {
                    $(this).parent().parent().find('.wishes-1').show();
                });
                $('.kids-pats-line label input[type=checkbox]').each(function () {
                    var checked = this.checked;
                    if (!checked)
                        $(this).parent().parent().find('select').prop('disabled', true).parent().addClass("taxi-disabled");

                    else
                        $(this).parent().parent().find('select').prop('disabled', false).parent().removeClass("taxi-disabled");


                });

            });
            $(".kids-pats-line  label input[type=checkbox]").click(function () {
                var checked = this.checked;
                var targetBlock = $(this).parent().parent().find('.wishes-1');
                if (checked)
                    targetBlock.show();
                else
                    targetBlock.hide();
                //disable - abanle selects on step 2
                var targetSelect = $(this).parent().parent().find('.select');
                if (!checked) {
                    targetSelect.find('select').prop('disabled', true);
                    targetSelect.parent().find('.select').addClass("taxi-disabled");
                }
                else {
                    targetSelect.parent().find('.select').removeClass("taxi-disabled");
                    targetSelect.find('select').prop('disabled', false);
                }

            });

//default disable for a in buttons 2 step
            $('.spec-request .uk-parent > a, .auto-tip a').click(function (event) {
                return false;
            });
//simbols left in textarea in step 2 homepage
            var text_area_len = 200;
            
            //remove preloader
            togglePreloader(document.body,false);
        });
    });

});

