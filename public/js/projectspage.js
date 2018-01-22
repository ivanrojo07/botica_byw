/* This file stores JS that is used in Projects Page */

$(document).ready(function() {				   
	/* Projects Slider */
	jQuery('#projectGallerySlider').codaSlider({dynamicArrows: false, autoSlide: false, slideEaseDuration: 2500, slideEaseFunction: 'easeOutExpo'});
	
	var gSlideNr = jQuery('#sliderNav .coda-nav ul li').length;
	
	jQuery("#center .projectGallery .panel-wrapper").eq(0).find('a:has(img)').addClass('activeImage');

	jQuery('#sliderNav .coda-nav ul li').click(
		function () {
			jQuery("#center .projectGallery .counter").text(jQuery('#sliderNav .coda-nav ul li').index(this)+1+"/"+gSlideNr);
			
			jQuery("#center .projectGallery .panel-wrapper").find('.activeImage').removeClass('activeImage');
			jQuery("#center .projectGallery .panel-wrapper").eq(jQuery('#sliderNav .coda-nav ul li').index(this)).find('a:has(img)').addClass('activeImage');
			
			jQuery('.activeImage').nyroModal({});
		}
	);
	
	/* Lightbox */
	jQuery('.activeImage').nyroModal({});

	jQuery('#largerImage').click(function(e) {
		e.preventDefault();
		jQuery('.activeImage').nyroModalManual({});
		return false;
	});

});