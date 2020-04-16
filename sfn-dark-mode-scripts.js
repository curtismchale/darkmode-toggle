jQuery(document).ready(function($) {

	var mq = window.matchMedia('(prefers-color-scheme: dark)' );

	// turning on darkmode if that is what the user picked last time
	if ( localStorage.getItem('darkmode') || mq.matches ){
		$('body').addClass('darkmode--activated');
	}

	$(document).on('click touchstart', '#darkmode-toggle', function(e){

		e.preventDefault();

		$('body').toggleClass('darkmode--activated');

		if( $( 'body' ).hasClass('darkmode--activated') ){
			localStorage.setItem('darkmode', true );
		} else {
			localStorage.removeItem('darkmode' );
		}

	});
});
