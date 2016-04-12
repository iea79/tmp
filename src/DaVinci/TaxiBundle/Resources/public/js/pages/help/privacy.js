require(["pages/common"], function ($) {
    require(["sticky-kit.min"], function () {
       
                $('#filter').keyup(function () {

                        var rex = new RegExp($(this).val(), 'i');
                        $('.privacy .search_res').hide();
                        $('.privacy .search_res').filter(function () {
                            return rex.test($(this).find('h4').text()) || rex.test($(this).find('a').text()) || rex.test($(this).find('.text').text()) || rex.test($(this).find('.search_res').text());
                            
                        }).show();

                })
                
                $('#filter').keyup();

                $("#sticky_menu").stick_in_parent({
                	recalc_every: true
                });
                
       togglePreloader(document.body, false);
    });
});


