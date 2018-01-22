/* this file stores js only for front page */

$(document).ready(function() {				   
	/* Homepage Slider */	
	jQuery('#coda-slider-1').codaSlider({
		autoSlide: true, 
		autoSlideInterval: 6000,
		slideEaseDuration: 1600, 
		slideEaseFunction: 'easeInOutExpo', 
		dynamicTabsAlign: 'right',
		dynamicArrows: false, 
		crossLinking: false
	});	
});