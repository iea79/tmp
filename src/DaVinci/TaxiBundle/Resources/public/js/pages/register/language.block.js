require(["jquery"], function($){
    $('.addotherlanguage').click(function () {
        var num = $('.addlangline select').length;

        // Get the data-prototype
        var lang_proto = $($('#language_prototype').val().replace(/__name__/g, num));
        $('.addotherlanguage').before(lang_proto);
        return false;
    });
});