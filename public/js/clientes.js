var valor_municipio_focus;

$.quitar_numero_contacto = function(event){
	var nf = $(event.target.closest('tr'))[0].sectionRowIndex;
	$("tbody#numeros_contacto").find('tr:eq(' + nf + ')').remove();
}

$.agregar_numero_contacto = function(){
	$('tbody#numeros_contacto').append(`
		<tr>
		<td>
		<input type="text" class="form-control" maxlength="13" onkeypress="$.solo_digitos_keypress(event);" required>
		</td>
		<td>
		<input type="text" class="form-control" maxlength="30" onkeyup="$.capitalize_keyup(event);" required>
		</td>
		<td>
		<button class="btn btn-outline-secondary" type="button" onclick="$.quitar_numero_contacto(event);">
		<img src="${ assetImagenes + 'multiplicacion.png' }" class="img-fluid crud">
		</button>
		</td>
		</tr>
		`);
}

$.quitar_correo_electronico = function(event){
	var nf = $(event.target.closest('tr'))[0].sectionRowIndex;
	$("tbody#correos_electronicos").find('tr:eq(' + nf + ')').remove();
}

$.agregar_correo_electronico = function(){
	$('tbody#correos_electronicos').append(`
		<tr>
		<td>
		<input type="email" class="form-control" maxlength="192" onkeyup="$.minusculas_keyup(event);" required>
		</td>
		<td>
		<input type="text" class="form-control" maxlength="30" onkeyup="$.capitalize_keyup(event);" required>
		</td>
		<td>
		<button class="btn btn-outline-secondary" type="button" onclick="$.quitar_correo_electronico(event);">
		<img src="${ assetImagenes + 'multiplicacion.png' }" class="img-fluid crud">
		</button>
		</td>
		</tr>
		`);
}

$.restablece_interfaz_codigo_postal = function(){
	$('input#codigo_postal').removeAttr('readonly');
	$('input#codigo_postal').val('');
	$('button#buscar_codigo_postal').removeAttr('hidden');
	$('button#cancelar_codigo_postal').prop('hidden', true);
	$('input#estado_direccion').val('');
	$('select#municipio').empty();
	$('select#asentamiento').empty();
}

$.restablece_interfaz_direccion = function(){
	$.restablece_interfaz_codigo_postal();
	$('input#calle').val('');
	$('input#numero_exterior').val('');
	$('input#numero_interior').val('');
}

$.buscar_codigo_postal = function(codigo_postal){
	$.ajax({
		url : 'http://localhost/DEISA/public/codigosPostales/obtener/' + codigo_postal,
		dataType : 'json',
		type : 'GET',
		success : function(response){
			console.log(response);
			var ms = $('select#municipio');
			$.each(response, function(indice, codigo_postal){
				$('input#estado_direccion').val(codigo_postal.estado);
				var m = codigo_postal.municipios.split(',');
				$.each(m, function(indice, municipio){
					ms.append($('<option>', { 
						value: municipio,
						text : municipio
					}));
				});
				$('button#buscar_codigo_postal').prop('hidden', true);
				$('button#cancelar_codigo_postal').removeAttr('hidden');
				$('input#codigo_postal').prop('readonly', true);				
			});
		},
		error: function(jqXHR, estado, error){
			console.log('ESTADO : ' + estado + ' ERROR : ' + error);
			$('button#buscar_codigo_postal').removeAttr('hidden');
			$('button#cancelar_codigo_postal').prop('hidden', true);
			$('input#codigo_postal').removeAttr('readonly');
			alert('Wooops! no se encontro ningun codigo postal ' + codigo_postal);
		}
	});	
}

$.cancelar_busqueda_codigo_postal = function(){
	$.restablece_interfaz_codigo_postal();
}

$.buscar_asentamientos = function(codigo_postal, estado, municipio){
	$.ajax({
		url : 'http://localhost/DEISA/public/codigosPostales/obtener/' + codigo_postal + '/' + estado + '/' + municipio,
		dataType : 'json',
		type : 'GET',
		success : function(response){
			console.log(response);
			var as = $('select#asentamiento');
			as.empty();
			$.each(response, function(indice, asentamiento){
				as.append($('<option>', { 
					value: asentamiento,
					text : asentamiento
				}));
			});
		},
		error: function(jqXHR, estado, error){
			console.log('ESTADO : ' + estado + ' ERROR : ' + error);
		}
	});	
}

$.municipio_focus = function (e){
	valor_municipio_focus = (e.target.options.length != 0 ) ? e.target.options[e.target.selectedIndex].value : '';
}

$.municipio_onblur = function (e){
	var vmb = ( e.target.options.length != 0 ) ?  e.target.options[e.target.selectedIndex].value : '';
	if(e.target.options.length != 0 && ( $('select#asentamiento option').length == 0 || valor_municipio_focus != vmb) ){
		$.buscar_asentamientos( $('input#codigo_postal').val(), $('input#estado_direccion').val(), vmb );
	}
}

$.establece_escuchadores = function(){

	$('input#numero').keypress($.solo_digitos_keypress);

	$('input#razon_social').keyup($.mayusculas_keyup);

	$('input#planta').keyup($.mayusculas_keyup);

	$('input#empresa').keyup($.mayusculas_keyup);

	$('input#giro').keyup($.capitalize_keyup);

	$('input#codigo_postal').keypress($.solo_digitos_keypress);

	$('input#calle').keyup($.capitalize_keyup);

	$('input#numero_exterior').keypress($.solo_digitos_keypress);

	$('input#numero_interior').keypress($.solo_digitos_keypress);

	$('input#rfc').keyup($.mayusculas_keyup);

	$('input#rfc').keypress($.solo_alfanumericos_keypress);

	$('input#proveedor').keyup($.mayusculas_keyup);

	$('input#sae').keypress($.solo_digitos_keypress);

	$('button#agregar_numero_contacto').click( $.agregar_numero_contacto );

	$('button#agregar_correo_electronico').click( $.agregar_correo_electronico );

	$('button#buscar_codigo_postal').click(function(event){ $.buscar_codigo_postal($('input#codigo_postal').val())});

	$('button#cancelar_codigo_postal').click($.cancelar_busqueda_codigo_postal);

	$('select#municipio').blur( $.municipio_onblur );

	$('select#municipio').focus( $.municipio_focus );
}

$(function(){

	$.establece_escuchadores();
});