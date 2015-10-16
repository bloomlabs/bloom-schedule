/**
 * Bloom Schedule
 * Dashboard
 *
 * Distribution, modification or use of this source code without
 * authors permission is strictly forbidden under any circumstance.
 * By using this software you agree to our terms of use and service.
 *
 * @abstract    Bloom Schedule - Dashboard
 * @author      Damian Worsdell <damian@djw.net.au>
 * @copyright   Copyright (C) 2015, Damian Worsdell and Bloom Labs, Inc.
 */

var bookingData;
var dataUpdated;

/* Function: Fade-in update animation */
jQuery.fn.update = function (text) {
	$(this).html(text);
};

/* Function: Fetch booking data from API */
function fetchBookings() {
	$.ajax({
		url: "http://bloom-api.dev/booking/all",
		dataType: "jsonp",
	success: function (data) { bookingData = data;	/* Store our newly aquired data */ }
	});
	
	// Update the fetch time
	dataUpdated = moment().unix().valueOf();
	
	// Fetch the weather every three minutes
	setTimeout(function() { fetchBookings();  }, 180000);
}

/* Function: clock & date */
function clock() {
	var now = moment();

	// Flashing second indicator + display clock
	if (now.format('s') % 2 === 0) {
		$('.footer-clock').html(now.format('h') + '.' + now.format('mm') + '<span class="small">' + now.format('a') + '</span>');
	} else {
		$('.footer-clock').html(now.format('h') + '<span class="dot">.</span>' + now.format('mm') + '<span class="small">' + now.format('a') + '</span>');
	}
	
	// Update every second
	setTimeout(function() { clock(); }, 1000);
}

/* Document Loaded Function */
jQuery(document).ready(function ($) {
	
	// Connect to the Forecast.io API
	fetchBookings();
	
	// Generate the footer clock
	clock();

	// Generate the page
	$('.updated').update('updated <span data-livestamp="' + dataUpdated + '"></span>');
	
	$('current').show();
	$('weather').show();

});
