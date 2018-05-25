var route_areas;

$.nombre_autocompletado = function(){
	var nombre = $('input#nombre');
	nombre.typeahead({
		source: function(query, callback){
			$.get( route_areas + '/autocompletado/nombre/' + query)
			.done(function(data) {
				callback(data);
  			});
		},
		items : 11,
		fitToElement : true
	});
}

$.supervisor_autocompletado = function(){
	var nombre = $('input#supervisor');
	nombre.typeahead({
		source: function(query, callback){
			$.get( 'http://localhost/DEISA/public/register/autocompletado/email/' + query)
			.done(function(data) {
				callback(data);
  			});
		},
		items : 11,
		fitToElement : true
	});
}

$.establece_area = function(area){
	if(area != null) {
		$('input#nombre').val(area.nombre);
		$("select#departamento option[value='" + area.departamento + "']").prop('selected', true);
		$('input#supervisor').val(area.supervisor);
	}
}

$.limpia_interfaz = function(){
	$('input#nombre').val('');
	$('select#departamento option:first-child').prop('selected', true);
	$('input#supervisor').val('');
}

$.restablece_interfaz = function(){
	$.limpia_interfaz();
	$('button#buscar').removeAttr('hidden');
	$('button#cancelar').prop('hidden', true);
	$('input#nombre').removeAttr('readonly');
	$('button#guardar').removeAttr('hidden');
	$('button#modificar').prop('hidden', true);
}

$.buscar = function(nombre){
	if(nombre != null && nombre.trim() != ''){
		$.ajax({
			url : route_areas + '/buscar/' + nombre,
			dataType : 'json',
			type : 'GET',
			success : function(response){
					$.establece_area(response);
					$('button#buscar').prop('hidden', true);
					$('button#cancelar').removeAttr('hidden');
					$('input#nombre').prop('readonly', true);
					$('button#guardar').prop('hidden', true);
					$('button#modificar').removeAttr('hidden');
			},
			error : function(jqXHR, estado, error){
				console.log('ESTADO : ' + estado + ' ERROR : ' + error);
				alert('No se encontro el area con nombre:' + nombre);
				$('button#buscar').removeAttr('hidden');
				$('button#cancelar').prop('hidden', true);
				$('input#nombre').removeAttr('readonly');
				$('button#guardar').removeAttr('hidden');
				$('button#modificar').prop('hidden', true);
			}
		});
	}
};

$.cancelar_busqueda = function(){
	$.restablece_interfaz();
}

$.establece_escuchadores = function(){

	$('input#nombre').keyup($.capitalize_deja_pasar_mayusculas_keyup);

	$('input#supervisor').keyup($.minusculas_keyup);

	$('button#buscar').click(function(){$.buscar($('input#nombre').val())});

	$('button#cancelar').click($.cancelar_busqueda);

	$('button#guardar').focus(function(){
		$('form#areas').attr('action', route_areas);
		$('input#_method').attr('value', 'POST');
	});

	$('button#modificar').focus(function(){
		$('form#areas').attr('action', route_areas + '/' + $('input#nombre').val());
		$('input#_method').attr('value', 'PUT');
	});
	
}

$(function(){

	route_areas = $('form#areas').attr('action');

	$.nombre_autocompletado();

	$.supervisor_autocompletado();

	$.establece_escuchadores();

});