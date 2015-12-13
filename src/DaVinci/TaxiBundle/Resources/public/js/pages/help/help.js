require(["pages/common"], function ($) {
   
            $('#filter').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.help .search_res').hide();
                    $('.help .search_res').filter(function () {
                        return rex.test($(this).find('li').text()) || rex.test($(this).find('a').text()) || rex.test($(this).find('.search_res').text());
                        // return rex.test($(this).find('li').text()) || rex.test($(this).find('a').text()) || rex.test($(this).find('.text').text()) || rex.test($(this).find('.search_res').text());
                        
                    }).show();

            })
            $('#filter').keyup();
            
   togglePreloader(document.body, false);
});


