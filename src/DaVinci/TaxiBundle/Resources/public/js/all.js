$("#passenger form, #manager form, #taxidriver form, #taxicompany form, #independentdriver form").validate();
function setTabswidth (){
	tu0 = $('#info ol').width();
	tu1 = $('#info ol li').length;
	tabswidth = (tu0/tu1)-4;
	$("#info ol li").css({'width' : tabswidth});
	$("#info ol li:last-child").css({'width' : tabswidth-1});
} 

//$(function() {
        $( "#spinner1, #spinner2, #spinner3" ).spinner({
            step: 1,
            numberFormat: "n",
			min: 0,
        });
//});
$(function () {
	$('#timestart, #timeend').timepicker({
		showPeriodLabels: false, // Ð¿Ð¾ÐºÐ°Ð·Ñ‹Ð²Ð°Ñ‚ÑŒ Ð¾Ð±Ð¾Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ñ am Ð¸ pm
		hourText: 'Ð§Ð°ÑÑ‹', // Ð½Ð°Ð·Ð²Ð°Ð½Ð¸Ðµ Ð·Ð°Ð³Ð¾Ð»Ð¾Ð²ÐºÐ° Ñ‡Ð°ÑÐ¾Ð²
		minuteText: 'ÐœÐ¸Ð½ÑƒÑ‚Ñ‹', // Ð½Ð°Ð·Ð²Ð°Ð½Ð¸Ðµ Ð·Ð°Ð³Ð¾Ð»Ð¾Ð²ÐºÐ° Ð¼Ð¸Ð½ÑƒÑ‚
		showMinutes: true, // Ð¿Ð¾ÐºÐ°Ð·Ñ‹Ð²Ð°Ñ‚ÑŒ Ð±Ð»Ð¾Ðº Ñ Ð¼Ð¸Ð½ÑƒÑ‚Ð°Ð¼Ð¸
		rows: 4, // ÑÐºÐ¾Ð»ÑŒÐºÐ¾ Ñ€ÑÐ´Ð¾Ð² Ñ‡Ð°ÑÐ¾Ð² Ð¸ Ð¼Ð¸Ð½ÑƒÑ‚ Ð²Ñ‹Ð²Ð¾Ð´Ð¸Ñ‚ÑŒ
		timeSeparator: ':', // Ñ€Ð°Ð·Ð´ÐµÐ»Ð¸Ñ‚ÐµÐ»ÑŒ Ñ‡Ð°ÑÐ¾Ð² Ð¸ Ð¼Ð¸Ð½ÑƒÑ‚
		hours: {
			starts: 0, // Ð½Ð°ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ° Ñ‡Ð°ÑÐ¾Ð²
			ends: 23 // Ð¾Ñ‚ - Ð´Ð¾
		},
		minutes: {
			starts: 0, // Ð½Ð°ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ° Ð¼Ð¸Ð½ÑƒÑ‚
			ends: 55, // Ð¾Ñ‚ - Ð´Ð¾
			interval: 5 // Ð¸Ð½Ñ‚ÐµÑ€Ð²Ð°Ð» Ð¼ÐµÐ¶Ð´Ñƒ Ð¼Ð¸Ð½ÑƒÑ‚Ð°Ð¼Ð¸
		},
	});
});
		
$(function(){
    var wrapper = $( ".file_upload" ),
        inp = wrapper.find( "input" ),
        btn = wrapper.find( "button" ),
        lbl = wrapper.find( "div" );

    btn.focus(function(){
        inp.focus()
    });
    // Crutches for the :focus style:
    inp.focus(function(){
        wrapper.addClass( "focus" );
    }).blur(function(){
        wrapper.removeClass( "focus" );
    });

    var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;

    inp.change(function(){
        var file_name;
        if( file_api && inp[ 0 ].files[ 0 ] ) 
            file_name = inp[ 0 ].files[ 0 ].name;
        else
            file_name = inp.val().replace( "C:\\fakepath\\", '' );

        if( ! file_name.length )
            return;

        if( lbl.is( ":visible" ) ){
            lbl.text( file_name );
            btn.text( "Ð’Ñ‹Ð±Ñ€Ð°Ñ‚ÑŒ" );
        }else
            btn.text( file_name );
    }).change();

});

function setBlockHeight(){
	contentheight = 0;
	$(".active .blockoffice ul").each(function(ind, el){
	height = $(this).height();
	if (height > contentheight)
		contentheight = height;
	});
	$(".active .blockoffice ul").css({'height' : contentheight});
}

function setAttribute(){
/*	$("#makechoice li a").removeClass('active');
	$("#makechoice li a").click(function () {
		$('.bloff').removeClass('active');
		$(this).addClass('active');
		var example = $("a.active").attr('href').split('#');
		$(".bloff").each(function(ind, el){
			if ($(this).attr('id') == example[1]){
				$(this).addClass('active');
			}
		});
		$("#makechoice").addClass('display_none');	
		setBlockHeight();
		return false;

	});
	*/
} 

$(document).ready(function() {

	$('.rowcity').hide();	
	$('.rowstreet').hide();	
	$('.rowbuild').hide();	
	
	$('#country').change(function() {
		$('.rowcity').show();	
	});

	$('#city').change(function() {
		$('.rowstreet').show();	
	});
	
	$('#street').change(function() {
		$('.rowbuild').show();	
	});

	$('.addphone').click(function() {
		$('.addphoneareas:last-child').clone().appendTo(".addphoneline");	
		$('.addphone').addClass('display_none');	
		$('.addphoneareas:last-child .questiontooltip').addClass("display_none");	
		return false;
	});
	$('.addotherlanguage').click(function() {
		$('.addlangline select:last-child').clone().appendTo(".style2");	
		$('.addlangline select:last-child').removeClass('display_none');	
		return false;
	});
/*	$('.tcompany').click(function() {
		$("#makechoice").removeClass('display_none');	
	});

	$('#makechoice').children().children('.close').click(function() {
		$(this).parent().parent().addClass('display_none');	
	});
	*/
	setAttribute();
	$("#content .content-block textarea").keyup(function() {
		if (this.value.length > 300)
			this.value = this.value.substr(0, 300);
	});

	$("#content .content-block .wishes textarea").keyup(function() {
		if (this.value.length > 200)
			this.value = this.value.substr(0, 200);
	});
	$('#info').tabs({ active: 2});
	setTabswidth();
	$('.cabinet .content-block li').click(function() {
		$('.paychek').prependTo(this);	
	});

	$('.destination .addlang').click(function() {
		$('.destination .desticlone label:last-child').clone().appendTo(".destination .desticlone");	
	});

	$(".dates").each(function (i) {
		this.id += i + 1;
	});
	$(".styled").each(function (i) {
		this.id += i + 1;
		this.name += i + 1;
	});

	$.datepicker.setDefaults({changeYear: true});
	$("#datepicker, #datepicker0, #datepicker1, #datepicker2, #datepicker3, #datepicker4").datepicker();
	$("#datepickerstart, #datepickerend").datepicker({
		dateFormat: 'dd/mm/y' 
	});
	
	
	$('.ui-datepicker-year').addClass('styled');
	$('.usertype').hide();

	$('#myselect, #myselect1').change(function() {
		$('.content-block').attr('class','content-block');
		$('.usertype').hide();
		var valopt = $("#myselect option:selected, #myselect1 option:selected").text();
		var res = valopt.replace(/\s/g, "").toLowerCase();
		$('.usertype').each(function(){
			if ($(this).attr('id') == res){
				$(this).show();
				$('.content-block').addClass(res);

			}
		});



		if (res == "taxicompany"){
			$('.tabs').addClass('display_none');
			$('.threetabs').removeClass('display_none');
		} else if (res == "passenger"){
			$('.tabs').addClass('display_none');
		} else {
			$('.tabs').removeClass('display_none');
			$('.threetabs').addClass('display_none');
		}

	});
	
	
	$('.imitateselect').click(function() {
		$(this).children('.imitateoptions').show();
		return false;
	});
	
	$('.imitateoptions span.tips').click(function(e){
		atrcl = $(this).attr("class");
		if(atrcl != $(this).parent().siblings('.disop')){
			$(this).parent().siblings('.disop').removeClass('tip1 tip2');
			$(this).parent().siblings('.disop').addClass(atrcl);
		} else {}
		$('.imitateoptions').hide();
		return false;
	});
		
	$('.imitateoptions span.thumbs').click(function(e){
		$(this).parent().parent().siblings('.disop').removeClass('trust1 trust2 trust3 trust-1 trust-2 trust-3');
		atrcl = $(this).attr("class");
		if(atrcl != $(this).parent().parent().siblings('.disop')){
			$(this).parent().parent().siblings('.disop').addClass(atrcl);
		} else {}
		$('.imitateoptions').hide();
		return false;
	});
	$('#manager .addlang').click(function() {
		$('.style1').last().addClass('style13');
		$('#manager .style1').clone().insertAfter('.style1').addClass('style2');	
		$('.style2').removeClass('style1');
		return false;
	});
	$('#taxidriver .addlang').click(function() {
		$('.style1').last().addClass('style13');
		$('#taxidriver .style1').clone().insertAfter('.style1').addClass('style2');	
		$('.style2').removeClass('style1');
		return false;
	});
	$('#independentdriver .addlang').click(function() {
		$('.style1').last().addClass('style13');
		$('#independentdriver .style1').clone().insertAfter('.style1').addClass('style2');	
		$('.style2').removeClass('style1');
		return false;
	});

	
});

$( window ).resize(function(){
    $( ".file_upload input" ).triggerHandler( "change" );
	setTabswidth();
});


//register page/////////////////////////////
     function add2PassPattern(text)
     {
        $('.passfield2').attr('pattern',text);
     }
     $(".passfield").change(function(){
        add2PassPattern(this.value);
     });
     
//check Email js////////////////////////
$('#resend_email a').click(function(e){
    e.preventDefault();
    $('#change_email_block').show();
});
//Table Responsive/////////////////////
$(document).ready(function() {
  var switched = false;
  var updateTables = function() {
    if (($(window).width() < 760) && !switched ){
      switched = true;
      $("table.responsive").each(function(i, element) {
        splitTable($(element));
      });
      return true;
    }
    else if (switched && ($(window).width() > 760)) {
      switched = false;
      $("table.responsive").each(function(i, element) {
        unsplitTable($(element));
      });
    }
  };
   
  $(window).load(updateTables);
  $(window).on("redraw",function(){switched=false;updateTables();}); // An event to listen for
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
	
	function unsplitTable(original) {
    original.closest(".table-wrapper").find(".pinned").remove();
    original.unwrap();
    original.unwrap();
	}

  function setCellHeights(original, copy) {
    var tr = original.find('tr'),
        tr_copy = copy.find('tr'),
        heights = [];

    tr.each(function (index) {
      var self = $(this),
          tx = self.find('th, td');

      tx.each(function () {
        var height = $(this).outerHeight(true);
        heights[index] = heights[index] || 0;
        if (height > heights[index]) heights[index] = height;
      });

    });

    tr_copy.each(function (index) {
      $(this).height(heights[index]);
    });
  }

});
// Смена названий кнопок Driver list в office passahgers //////////////////// 
    var but_txt;
  $(document).ready(function(){

	var count = 0;
	$(".driverlist").click(function(){
  	$(this).toggleClass("active-gray");
      
      if ($(this).text() != "Hide drivers 1, 2,")
   	 {    but_txt = $(this).text();
   		 $(this).text( "Hide drivers 1, 2,");}
    else $(this).text( but_txt);
	});

  });
