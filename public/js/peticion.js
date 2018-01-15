'use strict'
$(obtener_registros());
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
function obtener_registros(busqueda, etiqueta)
{

	// console.log(etiqueta);
	if (etiqueta == 'query') {
		
		$.ajax({
			//url : "http://localhost/clientes",
			//poner if por cada etiqueta
			url : "buscarcliente",
			type : "GET",
			dataType : "html",
			data :{busqueda:busqueda},
			}).done(function(resultado){
			$("#datos").html(resultado);

		});
	}
	if (etiqueta == 'producto') {
		$.ajax({
			url : "buscarproducto",
			type : "GET",
			dataType : "html",
			data :{busqueda:busqueda},
			}).done(function(resultado){
			$("#datos").html(resultado);

		});
	}
	if (etiqueta == 'empleado') {
		$.ajax({
			url : "buscarempleado",
			type : "GET",
			dataType : "html",
			data :{busqueda:busqueda},
			}).done(function(resultado){
			$("#datos").html(resultado);

		});
	}
	if (etiqueta == 'provedor') {
		
		$.ajax({
			url : "buscarprovedor",
			type : "GET",
			dataType : "html",
			data :{busqueda:busqueda},
			}).done(function(resultado){
			$("#datos").html(resultado);

		});
	}
		

}

$(document).on('keyup', ':input', function()
{

	var valor=$(this).val();
	var etiqueta = $(this).attr('id');


	
	if (valor!="")
	{
		obtener_registros(valor,etiqueta);
	}
	else
		{
			obtener_registros(' ',etiqueta);
			
		}
});

$(document).on('change', ':input', function(){
$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
});
$.ajax({
	url: "cotizacionautosave",
	type: "POST",
	dataType : "html",
	data:{
		personal_id: $("#personal_id").val(),
		empleado_id: $("#empleado_id").val(),
		cotiza: $("#cotiza").val(),
		fecha: $("#fecha").val(),
		validez_cot: $("#validez_cot").val()
	}
}).done(function(resultado){
		$("#app").html(resultado);
	});
});

function agregarProducto(producto){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url: "{{ url('/incotizacion') }}",
		type: "POST",
		dataType: "html",
		data: {
			cotizacion_id: $("#cotizacion_id").val(),
			producto_id: producto
		},
	}).done(function(result){
		$("#productoscotizados").html(result);
	});
}

