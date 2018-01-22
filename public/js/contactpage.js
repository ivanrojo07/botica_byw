/* this file stores js only for contact page */

$(document).ready(function() {	
	// Make the custom select forms 
	jQuery(".selectForm").sexyCombo({
		showListCallback: function () {
			jQuery(".list-wrapper.visible").parent().addClass('showList');
		},
		hideListCallback: function () {
			jQuery(".list-wrapper.invisible").parent().removeClass('showList');
		}
	});
	
	// Contact Form
	var cForm = $("#contactForm");  
	var cinputName = cForm.find(".name"); 
	var cinputEmail = cForm.find(".email");  
	var cinputMessage = cForm.find(".message");
	var cloadingImage = cForm.find('.loadingImage');	
	var cresponseText = cForm.find(".responseText");

	// On Submitting  	
	cForm.bind("submit", function(e){
		if(validateName(e, cinputName) & validateEmail(e, cinputEmail) & validateMessage(e, cinputMessage)) { 
			ajaxSend(cForm, cresponseText, cloadingImage);
		};
		return false;
	});
		
	// On key press  
	cinputName.bind("keyup", function(e){
		validateName(e,  cinputName);
	});
	cinputEmail.bind("keyup", function(e){
		validateEmail(e,  cinputEmail);
	});
	cinputMessage.bind("keyup", function(e){
		validateMessage(e,  cinputMessage);
	});
});