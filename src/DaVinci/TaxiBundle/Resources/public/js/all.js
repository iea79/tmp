$("#passenger form, #manager form, #taxidriver form, #taxicompany form, #independentdriver form").validate();
//$(function() {
        $( "#spinner1, #spinner2, #spinner3" ).spinner({
            step: 1,
            numberFormat: "n",
			min: 0,
        });
//});
	
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
            btn.text( "Выбрать" );
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
$(function(){
    
    if($(".register").length) { 
    

    var $country = $('#taxi_company_registration_country');
    // When country gets selected ...
    $country.change(function() {
      // ... retrieve the corresponding form.
      var $form = $(this).closest('form');
      // Simulate form data, but only include the selected sport value.
      var data = {};
      data[$country.attr('name')] = $country.val();
      // Submit data via AJAX to the form's action path.
      $.ajax({
        url : $form.attr('action'),
        type: $form.attr('method'),
        data : data,
        success: function(html) {
          // Replace current position field ...
          $('#taxi_company_registration_city').replaceWith(
            // ... with the returned one from the AJAX response.
            $(html).find('#taxi_company_registration_city')
          );
          // Position field now displays the appropriate positions.
        }
      });
    });
    
	$('.rowcity').hide();	
	$('.rowstreet').hide();	
	$('.rowbuild').hide();	
	
	$('#taxi_company_registration_country').change(function() {
		$('.rowcity').show();	
	});

	$('#taxi_company_registration_city').change(function() {
		$('.rowstreet').show();	
	});
	
	$('.addphone').click(function() {
		$('.adphonik').clone().appendTo(".addphoneareas");	
		$('.addphone').addClass('display_none');	
		return false;
	});
	$('.addotherlanguage').click(function() {
		$('.addlangline select:last-child').clone().appendTo(".style2");	
		$('.addlangline select:last-child').removeClass('display_none');	
		return false;
	});
	$("#content .content-block textarea").keyup(function() {
		if (this.value.length > 300)
			this.value = this.value.substr(0, 300);
	});

	$("#content .content-block .wishes textarea").keyup(function() {
		if (this.value.length > 200)
			this.value = this.value.substr(0, 200);
	});

	$('.destination .add-lang').click(function() {
		$('.destination .desticlone .to:last-child').clone().appendTo(".destination .desticlone");	
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
    }
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
