
$.establece_escuchadores = function(){

	$('input#name').keyup($.capitalize_keyup);

	$('input#primer_apellido').keyup($.capitalize_keyup);
	
	$('input#segundo_apellido').keyup($.capitalize_keyup);

	$('button#mostrar').mousedown(function(){
		$('input#password').attr('type', 'text');
	});

	$('button#mostrar').mouseup(function(){
		$('input#password').attr('type', 'password');
	});
	
}

$(function(){
	
	$.carga_imagen($('#archivo'), $('#avatar'));

	$.establece_escuchadores();

});