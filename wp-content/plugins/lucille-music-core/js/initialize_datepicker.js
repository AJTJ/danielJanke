jQuery(document).ready( function($) {
	'use strict';
	
	jQuery( ".swp_datepicker" ).datepicker({
		dateFormat : "yy/mm/dd"
	});

	jQuery("#timepicker").timepicker();
});	