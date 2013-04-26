
	jQuery(document).ready(function($) {

		// fitVid js - Target your .container, .wrapper, .post, etc.
		$(".container").fitVids();
		
		// mobile menu toggle function
		$(function() {
		    $('#togglebutt').click(function() {
				$('nav[role="navigation"]').slideToggle('slow');
			});
		});
		
		// if window is resized and broswer changes from mobile to desktop, need to be sure to display desktop even uf user has hidden via above
		$(window).resize(function(){
			var w = $(window).width();
			if(w >= 720 && $('nav[role="navigation"]').is(':hidden')) {
				$('nav[role="navigation"]').show();
			}
        });
		
		$(window).resize(function(){
			var w = $(window).width();
			if(w < 720) {
				$('nav[role="navigation"]').hide();
			}
        });

	});
