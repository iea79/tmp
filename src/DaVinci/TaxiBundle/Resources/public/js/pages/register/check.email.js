require(["pages/common"], function($){
    $('#resend_email a').click(function (e) {
        e.preventDefault();
        $('#change_email_block').show();
    });
    //remove preloader
    togglePreloader(document.body,false);
});
