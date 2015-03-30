require(["pages/common"], function ($) {
    require(['charCount'], function () {

        $(".charcount").charCount();

        $('#passenger_review_send').click(function (e) {
            e.preventDefault();
            if (!$('#passenger_review_text').val()) {       
                $('#passenger_review_text').addClass("uk-animation-shake").delay(500).queue(function () {
                    $(this).removeClass("uk-animation-shake").dequeue();
                });
            }
        });



        //remove preloader
        togglePreloader(document.body, false);
    });
});