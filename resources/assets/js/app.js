
import 'bootstrap';
import "jquery";
 
 
 $('.flex_search_movil').click(function(){

    $('.input_search').removeClass('input_search').addClass('input_search1');

});



 $('.shownone').click(function(){

      $('.input_search').removeClass('input_search').addClass('input_search1');

});

$(function(){

	$("#nav .product1").on("click", irA);

		$(window).scroll(scrollMenu);

});

	function irA(){

		var seccion = $(this).attr("href");

		$('body,html').animate({

				scrollTop: $(seccion).offset().top-100

		}, 800);	

		return false;

	}



$(function(){

	$('.ir-arriba').click(function(){

		$('body,html').animate({

			scrollTop: '0px'

		}, 500);

	});

	$(window).scroll(function(){

		if( $(this).scrollTop() > 100 ){

			$('.ir-arriba').fadeIn('250');

		} else{

			$('.ir-arriba').fadeOut('250');

		};

	});

});