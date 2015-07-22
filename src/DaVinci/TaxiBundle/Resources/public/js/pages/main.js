require(['pages/common'], function ($) {
    require(['jquery.spinner', 'jquery.form', 'datarange', 'chosen.jquery', 'pages/table.resize', 'charCount', 'showRouting', 'inputLimit'], function () {
        require(['chosenImage.jquery'], function () {

            //Добавление доролнительных направлений 
            $('.destination .add-lang').click(function () {
                $('.destination .desticlone .to:last-child').clone().appendTo(".destination .desticlone");
            });

// simbols left in textarea in step 2 homepage
            $(".charcount").charCount();

// Скрытие и открытие дополнительных спкцификаций на 2-м шаге главной
            $('.spec-request').click(function () {
                $(this).next('.checks').toggle();
            });

            $('.chois li').change(function () {
                var ind = $('.chois li').index($('li.uk-active')[0]);
                alert(ind);
            });
// Скрытие и открытие обратной даты на 1-м шаге главной
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
// Скрытие и открытие данных для заказа другому человеку на 3-м шаге главной
            /* This is not applicable so far, but can be used any moment again 
             
             $(function(){
             $('.another-wrap').hide();
             });
             $(function(){
             $('.nottravel input[type=checkbox]').click(function(){
             var checked = this.checked;
             if(checked) $('.another-wrap').show();
             else $('.another-wrap').hide();
             });z
             }); */
            
// Ajax request processing            
            
// accordeon for buttoons in step 2 of homepage
            $(".order-details .uk-nav-parent-icon").click(function() {
                $(this).find(".uk-parent").toggleClass("uk-open");
            });

// show and hide texareas on step 2 of homepage
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

// default disable for a in buttons 2 step
            $('.spec-request .uk-parent > a, .auto-tip a').click(function (event) {
                return false;
            });

// datapicker and datarange
            $('.date-input').pickmeup_uikit({
                format: 'd.m.y',
                position        : 'bottom',
                hide_on_select  : true
            });

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

            // remove preloader
            togglePreloader(document.body, false);
        });
    });

});

