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
            btn.text("Выбрать");// такого не должно быть! текст в js недопустим
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

// Смена класса кнопок Driver list в office passengers //////////////////// 
    var but_txt;
  $(document).ready(function(){

	var count = 0;
	$(".driverlist").click(function(){
  	$(this).toggleClass("active-gray");
      
  });
});

$(document).ready(function(){

        var $menu = $("#menu");

        $(window).scroll(function(){
            if ( $(this).scrollTop() > 100 && $menu.hasClass("default") ){
                $menu.removeClass("default").addClass("fixed");
            } else if($(this).scrollTop() <= 100 && $menu.hasClass("fixed")) {
                $menu.removeClass("fixed").addClass("default");
            }
        });//scroll
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
$(function(){
	var startCheck = $('.inputs input[type=checkbox]').prop("checked");
	if(startCheck) $('.destination .last').show();
	else $('.destination .last').hide();
});
$(function(){
$('.inputs input[type=checkbox]').click(function(){
	var checked = this.checked;
	if(checked) $('.destination .last').show();
	else $('.destination .last').hide();
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
function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(55.752, 37.615) ,
	scrollwheel: false 
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);

//accordeon for buttoons in step 2 of homepage
$(".order-details .uk-nav-parent-icon").click(function(){
	$(this).find(".uk-parent").toggleClass("uk-open");
});

//show and hide texareas on step 2 of homepage
$(function(){
	$('.kids-pats-line .wishes-1').hide();
	$('.kids-pats-line label input[type=checkbox]:checked').each(function(){
		$(this).parent().parent().find('.wishes-1').show();
	});
	$('.kids-pats-line label input[type=checkbox]').each(function(){
		var checked = this.checked;
		if(!checked) $(this).parent().parent().find('select').prop('disabled', true).parent().addClass("taxi-disabled");
		
		else $(this).parent().parent().find('select').prop('disabled', false).parent().removeClass("taxi-disabled");
			
		
	});
	
});
$(".kids-pats-line  label input[type=checkbox]").click(function(){
	var checked = this.checked;
	var targetBlock = $(this).parent().parent().find('.wishes-1');
	if(checked) targetBlock.show();
	else targetBlock.hide();
	//disable - abanle selects on step 2
	var targetSelect = $(this).parent().parent().find('.select');
	if(!checked) { targetSelect.find('select').prop('disabled', true); targetSelect.parent().find('.select').addClass("taxi-disabled"); }
	else {targetSelect.parent().find('.select').removeClass("taxi-disabled");
			targetSelect.find('select').prop('disabled', false); }
	
	});

//default disable for a in buttons 2 step
$('.spec-request .uk-parent > a, .auto-tip a').click(function(event){
	return false;
	});
//simbols left in textarea in step 2 homepage
var text_area_len = 200;

$('.wishes-1 textarea, .wishes-2 textarea, .about-passenger textarea').keyup(function(){
    if($(this).val().length > text_area_len){
        $(this).val($(this).val().substr(0, text_area_len));
		}
var remainding = text_area_len - $(this).val().length;
$(this).next('.helptext').html("simbols left "+ remainding);
});
