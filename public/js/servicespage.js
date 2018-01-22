/* This file stores JS that is used in Services Page */

jQuery(document).ready(function() {
	jQuery('#priceTable .priceHolder').width((parseInt(jQuery('#priceTable .priceMask').width()+30) * jQuery('#priceTable .tabContent').length));
	
	jQuery('#priceTable .tabContent').width(jQuery('#priceTable .priceMask').width());
				
	jQuery('#priceTable .priceMask').height(jQuery('#pack1').height());
	
	jQuery('#priceTable .priceTabs li').click(function () {
		//Get the height of the sub-panel  
		var panelheight = $($(this).find('a').attr('href')).height();  
		
		//Set class for the selected item  
		jQuery('#priceTable .priceTabs li').removeClass('active');  
		jQuery(this).addClass('active');  
		
		//Resize the height  
		jQuery('#priceTable .priceMask').animate({'height':panelheight},{queue:false, duration:500});           
		
		//Scroll to the correct panel, the panel id is grabbed from the href attribute of the anchor  
		jQuery('#priceTable .priceMask').scrollTo(jQuery(this).find('a').attr('href'), 800);
		
		//Discard the link default behavior  
		return false;  	
	});
	
});