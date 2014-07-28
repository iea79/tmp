$("#passenger form, #manager form, #taxidriver form, #taxicompany form, #independentdriver form").validate();
function setTabswidth (){
	tu0 = $('#info ol').width();
	tu1 = $('#info ol li').length;
	tabswidth = (tu0/tu1)-4;
	$("#info ol li").css({'width' : tabswidth});
	$("#info ol li:last-child").css({'width' : tabswidth-1});
} 

$(function() {
        $( "#spinner1, #spinner2, #spinner3" ).spinner({
            step: 1,
            numberFormat: "n",
			min: 0,
        });
});
$(function () {
	$('#timestart, #timeend').timepicker({
		showPeriodLabels: false, // показывать обозначения am и pm
		hourText: 'Часы', // название заголовка часов
		minuteText: 'Минуты', // название заголовка минут
		showMinutes: true, // показывать блок с минутами
		rows: 4, // сколько рядов часов и минут выводить
		timeSeparator: ':', // разделитель часов и минут
		hours: {
			starts: 0, // настройка часов
			ends: 23 // от - до
		},
		minutes: {
			starts: 0, // настройка минут
			ends: 55, // от - до
			interval: 5 // интервал между минутами
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


	$('.addphone').click(function() {
		$('.addphoneareas:last-child').clone().appendTo(".addphoneline");	
		return false;
	});
	$('.addotherlanguage').click(function() {
		$('.addlangline select:last-child').clone().appendTo(".style2");	
		$('.addlangline select:last-child').removeClass('display_none');	
		return false;
	});
	$('.tcompany').click(function() {
		$("#makechoice").removeClass('display_none');	
	});

	$('#makechoice').children().children('.close').click(function() {
		$(this).parent().parent().addClass('display_none');	
	});
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