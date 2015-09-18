$(document).ready(function() {
	var $introDiv = $('#toggleIntro');
	var $mapDiv = $('#imgBorder');

	$mapDiv.hide();
	
	$("button#buttonIntro").click(function() {
		$introDiv.slideToggle('slow');
		$(this).text() == 'Intro...' ? $(this).text('Close Intro...') : $(this).text('Intro...');
	});

	$("button#buttonMap").click(function() {
		$mapDiv.slideToggle('slow');
		$(this).text() == 'Open Map...' ? $(this).text('Hide Map...') : $(this).text('Open Map...');
	});
});