/* This file stores JS that is used in all pages */

jQuery(document).ready(function() {		
	/* Add play buttons on class .videoThumb */	
	jQuery('.videoThumb').prepend('<span></span>');
	
	/* Add ribbons on class .winner */	
	jQuery('.winner').prepend('<span></span>');
	
	/* Fix Contact Form Textarea Focus */
	jQuery(".textarea textarea")
		.focus(function() {jQuery(this).parents('.textarea').addClass("focus");})
		.blur(function() {jQuery(this).parents('.textarea').removeClass("focus");});
	
	/* Remove the scrolbars from textarea in Opeara  */	
	jQuery.each(jQuery.browser, function(i) {
		if($.browser.opera) $("textarea").css("overflow","hidden");
	});
		
	/* Start Portofolio Carousel */
	jQuery("#portofolioSlider .carousel").jcarousel({
		scroll: 4,
		animation: 1500,
		easing: 'easeOutExpo',
		initCallback:  portofolioCarouselInit,
		buttonNextCallback: portofolioCarouselNext,
		buttonPrevCallback: portofolioCarouselPrev,
		itemLoadCallback: {onAfterAnimation: portofolioCarouselCounter}
	});
});

/* Portofolio Carousel Callback Functions */
var itemP, itemN;
function portofolioCarouselInit(carousel) {
	jQuery('#portofolioSlider .jcarousel-next').bind('click', function() {
		carousel.next();
		return false;
	});	
	jQuery('#portofolioSlider .jcarousel-prev').bind('click', function() {
		carousel.prev();
		return false;
	});
};
function portofolioCarouselNext(carousel, button, enabled) {
	enabled ? jQuery('#portofolioSlider .jcarousel-next').removeClass("disabled") : jQuery('#portofolioSlider .jcarousel-next').addClass("disabled");
};
function portofolioCarouselPrev(carousel, button, enabled) {
	enabled ? jQuery('#portofolioSlider .jcarousel-prev').removeClass("disabled") : jQuery('#portofolioSlider .jcarousel-prev').addClass("disabled");
}; 
function portofolioCarouselCounter(carousel, state) {
	if(state == "init") {
			itemN = jQuery("#portofolioSlider .carousel ul li").size();
			itemN < 4 ? itemP = itemN : itemP = 4;
			jQuery("#portofolioSlider .counter").text(itemP+"/"+itemN);	
	}
	if(state == "next") {
		if(!jQuery(this).hasClass("disabled")){
			if(itemP + 4 > itemN) itemP += itemN-itemP;
			else itemP += 4;
			jQuery("#portofolioSlider .counter").text(itemP+"/"+itemN);	
		}
	}
	if(state == "prev") {
		if(!jQuery(this).hasClass("disabled")){
			if(itemP - 4 < 4) itemP -= itemP-4;
			else itemP -= 4;
			jQuery("#portofolioSlider .counter").text(itemP+"/"+itemN);	
		}
	}
}

/* Start jQuery.ScrollTo Plugin  */
/**
 * jQuery.ScrollTo - Easy element scrolling using jQuery.
 * Copyright (c) 2007-2009 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 5/25/2009
 * @author Ariel Flesler
 * @version 1.4.2
 *
 * http://flesler.blogspot.com/2007/10/jqueryscrollto.html
 */
;(function(d){var k=d.scrollTo=function(a,i,e){d(window).scrollTo(a,i,e)};k.defaults={axis:'xy',duration:parseFloat(d.fn.jquery)>=1.3?0:1};k.window=function(a){return d(window)._scrollable()};d.fn._scrollable=function(){return this.map(function(){var a=this,i=!a.nodeName||d.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!i)return a;var e=(a.contentWindow||a).document||a.ownerDocument||a;return d.browser.safari||e.compatMode=='BackCompat'?e.body:e.documentElement})};d.fn.scrollTo=function(n,j,b){if(typeof j=='object'){b=j;j=0}if(typeof b=='function')b={onAfter:b};if(n=='max')n=9e9;b=d.extend({},k.defaults,b);j=j||b.speed||b.duration;b.queue=b.queue&&b.axis.length>1;if(b.queue)j/=2;b.offset=p(b.offset);b.over=p(b.over);return this._scrollable().each(function(){var q=this,r=d(q),f=n,s,g={},u=r.is('html,body');switch(typeof f){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(f)){f=p(f);break}f=d(f,this);case'object':if(f.is||f.style)s=(f=d(f)).offset()}d.each(b.axis.split(''),function(a,i){var e=i=='x'?'Left':'Top',h=e.toLowerCase(),c='scroll'+e,l=q[c],m=k.max(q,i);if(s){g[c]=s[h]+(u?0:l-r.offset()[h]);if(b.margin){g[c]-=parseInt(f.css('margin'+e))||0;g[c]-=parseInt(f.css('border'+e+'Width'))||0}g[c]+=b.offset[h]||0;if(b.over[h])g[c]+=f[i=='x'?'width':'height']()*b.over[h]}else{var o=f[h];g[c]=o.slice&&o.slice(-1)=='%'?parseFloat(o)/100*m:o}if(/^\d+$/.test(g[c]))g[c]=g[c]<=0?0:Math.min(g[c],m);if(!a&&b.queue){if(l!=g[c])t(b.onAfterFirst);delete g[c]}});t(b.onAfter);function t(a){r.animate(g,j,b.easing,a&&function(){a.call(this,n,b)})}}).end()};k.max=function(a,i){var e=i=='x'?'Width':'Height',h='scroll'+e;if(!d(a).is('html,body'))return a[h]-d(a)[e.toLowerCase()]();var c='client'+e,l=a.ownerDocument.documentElement,m=a.ownerDocument.body;return Math.max(l[h],m[h])-Math.min(l[c],m[c])};function p(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);
/* End jQuery.ScrollTo Plugin  */

/* Make the tabbed menu */
jQuery(document).ready(function() {
	jQuery('#tabContainer .tabContent .viewAll').hide();
	jQuery('#tabNav').show();
	jQuery('#tabNav .jcarouselPrev2, #tabNav .jcarouselNext2').hide();

	jQuery('#tabHolder').width((parseInt(jQuery('#tabMask').width()+30) * jQuery('#tabContainer .tabContent').length));
	
	jQuery('#tabContainer .tabContent').width(jQuery('#tabMask').width());
			
	jQuery("#tabNav .viewAll").append(jQuery(jQuery('#tabs li.active').find('a').attr('href')).find('.viewAll').html());	
	
	jQuery('#tabMask').height($('#tab1').find('li').outerHeight()*4);
	
	jQuery('#tabMenu #tab1 .jcarousel-clip').height(jQuery('#tab1').find('li').outerHeight()*4);
	jQuery('#tabMenu #tab2 .jcarousel-clip').height(jQuery('#tab2').find('li').outerHeight()*3);

	jQuery('#tabs li').click(function () {
		if(jQuery(this).find('a').attr('href') == "#tab1") {
			var panelheight = $($(this).find('a').attr('href')).find('li').outerHeight()*4;
			jQuery('#tabNav .jcarouselPrev2, #tabNav .jcarouselNext2').hide();
			jQuery('#tabNav .jcarouselPrev1, #tabNav .jcarouselNext1').show();

		} else {
			var panelheight = jQuery($(this).find('a').attr('href')).find('li').outerHeight()*3;
			jQuery('#tabNav .jcarouselPrev1, #tabNav .jcarouselNext1').hide();
			jQuery('#tabNav .jcarouselPrev2, #tabNav .jcarouselNext2').show();
		}
				
		jQuery('#tabs li').removeClass('active');
		jQuery(this).addClass('active');
		
		jQuery('#tabMask').animate({'height':panelheight},{queue:false, duration:800});	
		jQuery('#tabMask .jcarousel-clip').animate({'height':panelheight},{queue:false, duration:800});	
		
		jQuery('#tabMask').scrollTo($(this).find('a').attr('href'), 800);
		
		jQuery("#tabNav .viewAll").empty().append(jQuery(jQuery(this).find('a').attr('href')).find('.viewAll').html());	
				
		return false;		
	});
	
	jQuery('#tab1').jcarousel({
        scroll: 4,
		vertical: true,
		animation: 1500,
		easing: 'easeOutExpo',
		initCallback:  tab1CarouselInit,
		buttonNextCallback: tab1CarouselNext,
		buttonPrevCallback: tab1CarouselPrev
    });	
	
	jQuery('#tab2').jcarousel({
        scroll: 4,
		vertical: true,
		animation: 1500,
		easing: 'easeOutExpo',
		initCallback:  tab2CarouselInit,
		buttonNextCallback: tab2CarouselNext,
		buttonPrevCallback: tab2CarouselPrev
    });	

});

function tab1CarouselInit(carousel) {
	jQuery('#tabNav .jcarouselNext1').bind('click', function() {
		carousel.next();
		return false;
	});	
	jQuery('#tabNav .jcarouselPrev1').bind('click', function() {
		carousel.prev();
		return false;
	});
};
function tab1CarouselNext(carousel, button, enabled) {
	enabled ? jQuery('#tabNav .jcarouselNext1').removeClass("disabled") : jQuery('#tabMenu .jcarouselNext1').addClass("disabled");
};
function tab1CarouselPrev(carousel, button, enabled) {
	enabled ? jQuery('#tabNav .jcarouselPrev1').removeClass("disabled") : jQuery('#tabMenu .jcarouselPrev1').addClass("disabled");
};

function tab2CarouselInit(carousel) {
	jQuery('#tabNav .jcarouselNext2').bind('click', function() {
		carousel.next();
		return false;
	});	
	jQuery('#tabNav .jcarouselPrev2').bind('click', function() {
		carousel.prev();
		return false;
	});
};
function tab2CarouselNext(carousel, button, enabled) {
	enabled ? jQuery('#tabNav .jcarouselNext2').removeClass("disabled") : jQuery('#tabMenu .jcarouselNext2').addClass("disabled");
};
function tab2CarouselPrev(carousel, button, enabled) {
	enabled ? jQuery('#tabNav .jcarouselPrev2').removeClass("disabled") : jQuery('#tabMenu .jcarouselPrev2').addClass("disabled");
};

/* Start ToggleVal Plugin  */
/* -------------------------------------------------- *
 * ToggleVal 2.1
 * Updated: 1/16/09
 * -------------------------------------------------- *
 * Author: Aaron Kuzemchak
 * URL: http://aaronkuzemchak.com/
 * Copyright: 2008-2009 Aaron Kuzemchak
 * License: MIT License
** -------------------------------------------------- */
(function(jQuery){jQuery.fn.toggleVal=function(theOptions){if(!theOptions||typeof(theOptions)=="object"){theOptions=jQuery.extend({focusClass:"tv-focused",changedClass:"tv-changed",populateFrom:"default",text:null,removeLabels:false},theOptions)}else if(typeof(theOptions)=="string"&&theOptions.toLowerCase()=="destroy"){var destroy=true}return this.each(function(){if(destroy){jQuery(this).unbind("focus.toggleval").unbind("blur.toggleval").removeData("defText");return false}var defText="";switch(theOptions.populateFrom){case"alt":defText=jQuery(this).attr("alt");jQuery(this).val(defText);break;case"label":defText=jQuery("label[for='"+jQuery(this).attr("id")+"']").text();jQuery(this).val(defText);break;case"custom":defText=theOptions.text;jQuery(this).val(defText);break;default:defText=jQuery(this).val()}jQuery(this).addClass("toggleval").data("defText",defText);if(theOptions.removeLabels==true){jQuery("label[for='"+jQuery(this).attr("id")+"']").remove()}jQuery(this).bind("focus.toggleval",function(){if(jQuery(this).val()==jQuery(this).data("defText")){jQuery(this).val("")}jQuery(this).addClass(theOptions.focusClass).removeClass(theOptions.changedClass)}).bind("blur.toggleval",function(){if(jQuery(this).val()==""){jQuery(this).val(jQuery(this).data("defText"))}jQuery(this).removeClass(theOptions.focusClass);if(jQuery(this).val()!=jQuery(this).data("defText")){jQuery(this).addClass(theOptions.changedClass)}else{jQuery(this).removeClass(theOptions.changedClass)}})})}})(jQuery);
/* End ToggleVal Plugin  */

/* Start customInput() Plugin  */
/*-------------------------------------------------------------------- 
 * jQuery plugin: customInput()
 * by Maggie Wachs and Scott Jehl, http://www.filamentgroup.com
 * Copyright (c) 2009 Filament Group
 * Dual licensed under the MIT (filamentgroup.com/examples/mit-license.txt) and GPL (filamentgroup.com/examples/gpl-license.txt) licenses.
 * Article: http://www.filamentgroup.com/lab/accessible_custom_designed_checkbox_radio_button_inputs_styled_css_jquery/  
--------------------------------------------------------------------*/
jQuery.fn.customInput=function(){jQuery(this).each(function(i){if(jQuery(this).is('[type=checkbox],[type=radio]')){var input=jQuery(this);var label=jQuery('label[for='+input.attr('id')+']');var inputType=(input.is('[type=checkbox]'))?'checkbox':'radio';jQuery('<div class="custom-'+inputType+'"></div>').insertBefore(input).append(input,label);var allInputs=jQuery('input[name='+input.attr('name')+']');label.hover(function(){jQuery(this).addClass('hover');if(inputType=='checkbox'&&input.is(':checked')){jQuery(this).addClass('checkedHover');}},function(){jQuery(this).removeClass('hover checkedHover');});input.bind('updateState',function(){if(input.is(':checked')){if(input.is(':radio')){allInputs.each(function(){jQuery('label[for='+jQuery(this).attr('id')+']').removeClass('checked');});};label.addClass('checked');}
else{label.removeClass('checked checkedHover checkedFocus');}}).trigger('updateState').click(function(){jQuery(this).trigger('updateState');}).focus(function(){label.addClass('focus');if(inputType=='checkbox'&&input.is(':checked')){jQuery(this).addClass('checkedFocus');}}).blur(function(){label.removeClass('focus checkedFocus');});}});};
/* End customInput() Plugin  */

jQuery(document).ready(function() {		
	/* Add a class for all the input fields that need a custom look */
	jQuery('.customRadioHere').addClass('customRadio');
	jQuery('.customCheckboxHere').addClass('customCheckbox');
	
	/* Using  customInput plugin make a custom looking radio and checkbox */
	jQuery('input').customInput();
	
	/* Hide the default looking radio and checkbox */
	jQuery('.customCheckboxHere input, .customRadioHere input').css({'left':'-9999px'});
	
	/* Lightbox Settings */		
	jQuery.nyroModalSettings({
		minWidth: 340,
		closeButton: '<a href="#" class="nyroModalClose" id="closeBut" title="close window">close window</a>',
		showBackground: function (elts, settings, callback) {
			elts.bg.css({opacity:0}).fadeTo(500, 0.5, callback);
		}
	});

	/* Login Lightbox */
	jQuery('.loginLightbox').nyroModal({
		width:340,
		endShowContent: function (elts, settings, callback) {			
			sIFR.replace(myriadPro, {
				selector: '#login h2',
				wmode: 'transparent',
				css: ['.sIFR-root {color:#464646;}']
			});
		}
	});
	
	/* Image Lightbox */
	jQuery('.imageLightbox').nyroModal({});
	
	/* Footer Contact Form Settings */
	var contactForm = $("#footerForm");  
	var inputName = contactForm.find(".name"); 
	var inputEmail = contactForm.find(".email");  
	var inputMessage = contactForm.find(".message");
	var loadingImage = contactForm.find('.loadingImage');	
	var responseText = contactForm.find(".responseText");

	// On Submitting  	
	contactForm.bind("submit", function(e){
		if(validateName(e, inputName) & validateEmail(e, inputEmail) & validateMessage(e, inputMessage)) { 
			ajaxSend(contactForm, responseText, loadingImage);
		};
		return false;
	});
		
	// On key press  
	inputName.bind("keyup", function(e){
		validateName(e,  inputName);
	});
	inputEmail.bind("keyup", function(e){
		validateEmail(e,  inputEmail);
	});
	inputMessage.bind("keyup", function(e){
		validateMessage(e,  inputMessage);
	});
	
	/* Using ToggleVal Plugin to make the text in textInput forms toggle */
	jQuery(".textInput").toggleVal();
});

/* Functions requierd by the contact forms */
function validateName(event, input){  
	if(input.val().length < 4 || input.val() == "your name"){
		if(event.type != "keyup") {
			input.addClass("error"); 
			input.parent().find('.errorText').slideDown(); 
		}
		return false;
	}else{input.removeClass("error"); input.parent().find('.errorText').slideUp(); return true;}  
}
function validateEmail(event, input){
	var a = input.val();
	var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
	
	if(filter.test(a)){
		input.removeClass("error"); 
		input.parent().find('.errorText').slideUp(); 
		return true;
	}else{
		if(event.type != "keyup") {
			input.addClass("error"); 
			input.parent().find('.errorText').slideDown(); 
		}
		return false;
	}
} 
function validateMessage(event, input){  
	if(input.val().length < 10 || input.val() == "your message"){
		if(event.type != "keyup") {
			input.parent().addClass("error"); 
			input.parent().find('.errorText').slideDown(); 
		}
		return false;
	}else{input.parent().removeClass("error"); input.parent().find('.errorText').slideUp(); return true;}  
} 
function ajaxSend(form, response, loading){	
	loading.show();
	response.slideUp().animate({X:""} , 200, "linear", function(){
		response.html('<small class="grey">Please wait, your message is being processed.</small><br />').slideDown();		
	});
	
	// Make AJAX request 		
	$.post('contactScript.php', form.serialize(), function(data){
		loading.hide(200);
		response.slideUp().animate({X:""} , 200, "linear", function(){response.html(data).slideDown();});
	});

	//Cancel default action
	return false;
};