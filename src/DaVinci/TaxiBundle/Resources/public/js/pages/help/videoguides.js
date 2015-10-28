require(["pages/common"], function ($) {
   
    $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.help-content ul').hide();
            $('.help-content ul').filter(function () {
                return rex.test($(this).find('a').text()) || rex.test($(this).find('li').text());
            }).show();

    })
    $('#filter').keyup();
            
   togglePreloader(document.body, false);
});
