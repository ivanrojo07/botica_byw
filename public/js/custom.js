$(function() {

    "use strict";
	
	// REMOVE # FROM URL
	$( 'a[href="#"]' ).click( function(e) {
		e.preventDefault();
	});	
	
	// Backstretch Header Full
	$(".header-full").backstretch([
		  "images/slider/slider-full-img1.jpg", 
		  "images/slider/slider-full-img2.jpg", 
		  "images/slider/slider-full-img3.jpg"
	], {duration: 4000, fade: 750, fadeFirstImage:false});
	
	$(".header-full #next").click(function(x) {
		x.preventDefault();
		$(".header-full").data("backstretch").next();
	});
	$(".header-full #prev").click(function(x) {
		x.preventDefault();
		$(".header-full").data("backstretch").prev();
	});
	
	// Blog Carousel
	$("#blog-post-carousel").owlCarousel({
		autoPlay: true, //Set AutoPlay to 3 seconds
		items : 3,
		stopOnHover : true,
		navigation : true, // Show next and prev buttons
		pagination : false,
		navigationText : ["<span class='fa fa-chevron-left animation'></span>","<span class='fa fa-chevron-right animation'></span>"]
	});
	
	// Featured Blog Carousel
	$("#featured-blog-post-carousel").owlCarousel({
		autoPlay: true, //Set AutoPlay to 3 seconds
		items : 1,
		stopOnHover : true,
		navigation : false, // Show next and prev buttons
		pagination : true,
		navigationText : ["<span class='fa fa-chevron-left animation'></span>","<span class='fa fa-chevron-right animation'></span>"]
	});
	
	// COUNTER
	function count($this){
		var current = parseInt($this.html(), 10);
		$this.html(++current);
		if(current !== $this.data('count')){
			setTimeout(function(){count($this)}, 50);
		}
	}        
	$(".badges-counter").each(function() {
	  $(this).data('count', parseInt($(this).html(), 10));
	  $(this).html('0');
	  count($(this));
	});
	
	// ACCORDION
	var $active = $("#accordion .panel-collapse.in, #accordion-faqs .panel-collapse.in")
					.prev()
					.addClass("active");
					
	$active
		.find("a")
		.append("<span class=\"fa fa-minus pull-right\"></span>");
		
	$("#accordion .panel-heading, #accordion-faqs .panel-heading")
		.not($active)
		.find('a')
		.prepend("<span class=\"fa fa-plus pull-right\"></span>");
	
	$("#accordion, #accordion-faqs").on("show.bs.collapse", function (e) {	
		$("#accordion .panel-heading.active")
			.removeClass("active")
			.find(".fa")
			.toggleClass("fa-plus fa-minus");				
		$(e.target)
			.prev()
			.addClass("active")
			.find(".fa")
			.toggleClass("fa-plus fa-minus");		
	});
	
	$("#accordion, #accordion-faqs").on("hide.bs.collapse", function (e) {
		$(e.target)
			.prev()
			.removeClass("active")
			.find(".fa")
			.removeClass("fa-minus")
			.addClass("fa-plus");
	});
	
	// Gallery FILTERS
	var $grid = $('#gallery-grid');
	$grid.shuffle({
		itemSelector: '.gallery-grid-item', // the selector for the items in the grid
		speed: 500 // Transition/animation speed (milliseconds)
	});
	/* reshuffle when user clicks a filter item */
	$('#gallery-filter li a').click(function (e) {
		// set active class
		$('#gallery-filter li a').removeClass('active');
		$(this).addClass('active');
		// get group name from clicked item
		var groupName = $(this).attr('data-group');
		// reshuffle grid
		$grid.shuffle('shuffle', groupName );
	});
	
	//MAGNIFIC POPUP
	$('#gallery-grid').magnificPopup({
		delegate: 'a', 
		type: 'image',
		gallery: {
			enabled: true
		}
	});
	
	//AJAX CONTACT FORM
	$(".contact-form").submit(function() {
		var rd = this;
		var url = "sendemail.php"; // the script where you handle the form input.
		$.ajax({
			type: "POST",
			url: url,
			data: $(".contact-form").serialize(), // serializes the form's elements.
			success: function(data) {
				$(rd).prev().text(data.message).fadeIn().delay(3000).fadeOut();
			}
		});
		return false; // avoid to execute the actual submit of the form.
	});
	
});