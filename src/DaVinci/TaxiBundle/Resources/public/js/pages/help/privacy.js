require(["pages/common"], function ($) {
   
            $('#filter').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.privacy li').hide();
                    $('.privacy li').filter(function () {
                        return rex.test($(this).find('h4').text()) || rex.test($(this).find('li').text());
                    }).show();

            })
            $('#filter').keyup();
            
   togglePreloader(document.body, false);
});


