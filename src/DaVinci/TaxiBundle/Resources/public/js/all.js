/*$("#passenger form, #manager form, #taxidriver form, #taxicompany form, #independentdriver form").validate();*/
//Добавление доролнительных направлений 
$('.destination .add-lang').click(function () {
    $('.destination .desticlone .to:last-child').clone().appendTo(".destination .desticlone");
});

$(function () {
    var wrapper = $(".file_upload"),
            inp = wrapper.find("input"),
            btn = wrapper.find("button"),
            lbl = wrapper.find("div");

    btn.focus(function () {
        inp.focus();
    });
    // Crutches for the :focus style:
    inp.focus(function () {
        wrapper.addClass("focus");
    }).blur(function () {
        wrapper.removeClass("focus");
    });

    var file_api = (window.File && window.FileReader && window.FileList && window.Blob) ? true : false;

    inp.change(function () {
        var file_name;
        if (file_api && inp[ 0 ].files[ 0 ])
            file_name = inp[ 0 ].files[ 0 ].name;
        else
            file_name = inp.val().replace("C:\\fakepath\\", '');

        if (!file_name.length)
            return;

        if (lbl.is(":visible")) {
            lbl.text(file_name);
            btn.text("Выбрать");
        } else
            btn.text(file_name);
    }).change();

});

/*
 $( window ).resize(function(){
 $( ".file_upload input" ).triggerHandler( "change" );
 setTabswidth();
 });
 */
//register page/////////////////////////////
function add2PassPattern(text)
{
    $('.passfield2').attr('pattern', text);
}
$(".passfield").change(function () {
    add2PassPattern(this.value);
});

//check Email js////////////////////////
$('#resend_email a').click(function (e) {
    e.preventDefault();
    $('#change_email_block').show();
});

//Table Responsive/////////////////////


$(document).ready(function () {
    var switched = false;
    var updateTables = function () {
        if (($(window).width() < 760) && !switched) {
            switched = true;
            $("table.responsive").each(function (i, element) {
                splitTable($(element));
            });
            return true;
        }
        else if (switched && ($(window).width() > 760)) {
            switched = false;
            $("table.responsive").each(function (i, element) {
                unsplitTable($(element));
            });
        }
    };

    $(window).load(updateTables);
    $(window).on("redraw", function () {
        switched = false;
        updateTables();
    }); // An event to listen for
    $(window).on("resize", updateTables);


    function splitTable(original)
    {
        original.wrap("<div class='table-wrapper' />");

        var copy = original.clone();
        copy.find("td:not(:last-child), th:not(:last-child)").css("display", "none");
        copy.removeClass("responsive");

        original.closest(".table-wrapper").append(copy);
        copy.wrap("<div class='pinned' />");
        original.wrap("<div class='scrollable' />");

        setCellHeights(original, copy);
    }
    ;

    function unsplitTable(original) {
        original.closest(".table-wrapper").find(".pinned").remove();
        original.unwrap();
        original.unwrap();
    }
    ;

    function setCellHeights(original, copy) {
        var tr = original.find('tr'),
                tr_copy = copy.find('tr'),
                heights = [];

        tr.each(function (index) {
            var self = $(this),
                    tx = self.find('td');

            tx.each(function () {
                var height = $(this).outerHeight(true);
                heights[index] = heights[index] || 0;
                if (height > heights[index] && index>1)
                    heights[index] = height;
            });

        });

        tr_copy.each(function (index) {
            $(this).height(heights[index]);
        }); 
    }
    ;

});

 //Выбор цвета авто ////////////////////////
$(window).bind("load", function() {
  $(".my-select").chosenImage({
    disable_search_threshold: 10 
  });
});

// Смена названий кнопок Driver list в office passengers //////////////////// 
    var but_txt;
  $(document).ready(function(){

	var count = 0;
	$(".driverlist").click(function(){
  	$(this).toggleClass("active-gray");
      
      if ($(this).text() != "Hide drivers list: 1, 2,...")
   	 {    but_txt = $(this).text();
   		 $(this).text( "Hide drivers list: 1, 2,...");}
    else $(this).text( but_txt);
	});

  });

//Скрытие и открытие дополнительных спкцификаций на 2-м шаге главной
$('.spec-request').click(function () {
    $(this).next('.checks').toggle();
});

$('.chois li').change(function () {
    var ind = $('.chois li').index($('li.uk-active')[0]);
    alert(ind);
});

