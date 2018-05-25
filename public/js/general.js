var alfanumericos_regex = /^[a-zA-Z0-9]+$/;
var digitos_regex = /^[0-9]+$/;

$.solo_digitos_keypress =  function( event ) {
	if (event.which != 13 && !( digitos_regex.test(event.key) ) ) {
		event.preventDefault();
	}
}

$.solo_alfanumericos_keypress = function(event){
	if( event.which != 13 && !(alfanumericos_regex.test(event.key)) ){
		event.preventDefault();
	}
}

$.mayusculas_keyup =  function( event ) {
	var t = event.target;
	$(t).val($(t).val().toUpperCase());
}

$.minusculas_keyup =  function( event ) {
	var t = event.target;
	$(t).val($(t).val().toLowerCase());
}

$.capitalize_keyup = function( event ){
	var t = event.target;
	$(t).val($(t).val().toLowerCase().replace(/\b\w/g, function(l){ return l.toUpperCase() }));
}

$.capitalize_deja_pasar_mayusculas_keyup = function(event){
	var t = event.target;
	$(t).val($(t).val().replace(/\b\w/g, function(l){ return l.toUpperCase() }));
}