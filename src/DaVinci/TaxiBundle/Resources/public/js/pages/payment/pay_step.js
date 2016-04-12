require(["pages/common"], function($){
	require(["sticky-kit.min"], function(){

		$('.pay__total__info_open_faq').click(function(e) {
			e.preventDefault();
			$('.pay__total__info_faq_list').toggleClass('open');
		});

	    $("#sticky_box").stick_in_parent({
	    	recalc_every: true
	    });

	    $('.method__select__row input').on('change',function() {
	    	var paySwicher = $(this).prop('checked');
	    	var payForm = $(this).parent('.method__select__row').find('form');
	    	var allPayForm = $(this).closest('.pay__method__select').find('form');

	    	if(paySwicher == true) {
	    		allPayForm.removeClass('active');
	    		payForm.addClass('active');
	    	} else {
	    		payForm.removeClass('active');
	    	}
	    	return
	    });

	    // Open payment steps
	    $('#open_steps_2').show();

		$('#open_steps_2').click(function(){
			$(this).hide();
			$('#open_steps_3').show();
	    	$('#pay_step2').slideDown('300');
		});

		$('#open_steps_3').click(function(){
			$(this).hide();
			$('#open_steps_4').show();
	    	$('#pay_step3').slideDown('300');
		});

		$('#open_steps_4').click(function(){
			$(this).hide();
	    	$('#pay_step4').slideDown('300');
	    	$('#pay_steps_btn').show();
		});

		//remove preloader
	    togglePreloader(document.body,false);
	});
});