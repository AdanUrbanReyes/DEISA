$.carga_imagen = function(input, img){
	input.on('change', function(evt){
		var et = evt.target || window.event.srcElement, f = et.files;
	    if (FileReader && f && f.length) {
			var fr = new FileReader();
	        fr.onload = function () {
	            img.attr('src', fr.result);
	        }
	        fr.readAsDataURL(f[0]);
	    }
	});
};

$.existe_recurso = function(url, metodo){
	var http = new XMLHttpRequest();
    http.open(metodo, url, false);
    http.send();
    return http.status != 404;
}