$.email_autocompletado = function(){
	var nombre = $('input#email');
	nombre.typeahead({
		source: function(query, callback){
			$.get( $('form#usuarios').attr('action') + '/autocompletado/email/' + query)
			.done(function(data) {
				callback(data);
  			});
		},
		items : 11,
		fitToElement : true
	});
}

$.obten_puestos = function(departamento){
	$.ajax({
		url : $('form#usuarios').attr('action') + '/puestos/' + departamento,
		dataType : 'json',
		type : 'GET',
		success : function(response){
			$.each(response, function(indice, puesto){
				$('select#puesto').append($('<option>', { 
					value: puesto.puesto,
					text : puesto.puesto 
				}));
			});
		},
		error: function(jqXHR, estado, error){
			console.log('ESTADO : ' + estado + ' ERROR : ' + error);
		}
	});
};

$.establece_usuario = function(usuario){
	if(usuario != null) {
		var urli = 'http://localhost/DEISA/public/storage/avatars/' + usuario.email.split('@')[0];
		$('input#email').val(usuario.email);
		$('input#password').val('');
		$('input#name').val(usuario.name);
		$('input#primer_apellido').val(usuario.primer_apellido);
		$('input#segundo_apellido').val(usuario.segundo_apellido);
		$("select#puesto option[value='" + usuario.puesto + "']").prop('selected', true);
		$('img#avatar').attr('src', ($.existe_recurso(urli, 'HEAD')) ? urli : 'http://localhost/DEISA/public/imagenes/avatar.png' );
	}
}

$.limpia_interfaz = function(){
	$('input#email').val('');
	$('input#password').val('');
	$('input#name').val('');
	$('input#primer_apellido').val('');
	$('input#segundo_apellido').val('');
	$('select#puesto option:first-child').prop('selected', true);
	if($('input#archivo')[0].files.length == 0){
		$('img#avatar').attr('src', 'http://localhost/DEISA/public/imagenes/avatar.png');		
	}	
}

$.restablece_interfaz = function(){
	$.limpia_interfaz();
	$('button#buscar').removeAttr('hidden');
	$('button#cancelar').prop('hidden', true);
	$('input#email').removeAttr('readonly');
	$('button#guardar').removeAttr('hidden');
	$('button#modificar').prop('hidden', true);
	$('button#eliminar').prop('hidden', true);
	$('form#usuarios').css('background-color', '');
}

$.buscar = function(email){
	if(email != null && email.trim() != ''){
		$.ajax({
			url : $('form#usuarios').attr('action') + '/buscar/' + email,
			dataType : 'json',
			type : 'GET',
			success : function(response){
					$.establece_usuario(response);
					$('button#buscar').prop('hidden', true);
					$('button#cancelar').removeAttr('hidden');
					$('input#email').prop('readonly', true);
					$('button#guardar').prop('hidden', true);
					if(response.estado == 'Activo'){
						$('form#usuarios').css('background-color', '#B4DCED');
						$('button#modificar').removeAttr('hidden');
						$('button#eliminar').removeAttr('hidden');
					}else{
						$('form#usuarios').css('background-color', '#F47E7B');
					}
			},
			error : function(jqXHR, estado, error){
				console.log('ESTADO : ' + estado + ' ERROR : ' + error);
				$('button#buscar').removeAttr('hidden');
				$('button#cancelar').prop('hidden', true);
				$('input#email').removeAttr('readonly');
				$('button#guardar').removeAttr('hidden');
				$('button#modificar').prop('hidden', true);
				$('button#eliminar').prop('hidden', true);
				alert('Wooops! no se encontro el usuario con email:' + email);
			}
		});
	}
};

$.cancelar_busqueda = function(){
	$.restablece_interfaz();
}

$.establece_escuchadores = function(){

	$('input#email').keyup($.minusculas_keyup);

	$('input#name').keyup($.capitalize_keyup);

	$('input#primer_apellido').keyup($.capitalize_keyup);
	
	$('input#segundo_apellido').keyup($.capitalize_keyup);

	$('button#buscar').click(function(){$.buscar($('input#email').val())});

	$('button#cancelar').click($.cancelar_busqueda);

	$('button#mostrar').mousedown(function(){
		$('input#password').attr('type', 'text');
	});

	$('button#mostrar').mouseup(function(){
		$('input#password').attr('type', 'password');
	});


	$('button#guardar').focus(function(){
		$('input#_method').attr('value', 'POST');
	});

	$('button#modificar').focus(function(){
		$('input#_method').attr('value', 'PUT');
	});

	$('button#eliminar').focus(function(){
		$('input#_method').attr('value', 'DELETE');
	});		
	
}

$(function(){

	$.carga_imagen($('#archivo'), $('#avatar'));

	$.obten_puestos($('#departamento').val());

	$.email_autocompletado();

	$.establece_escuchadores();

});