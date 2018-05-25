var valor_departamento_focus;

function menu_clic(menu){
	if( menu.classList.contains('list-group-item-info') ){
		menu.classList.remove('list-group-item-info');
	}else{
		menu.classList.add('list-group-item-info');
	}
}

$.re_carga_puestos = function(departamento){
	$.ajax({
		url : $(location).attr('href') + '/buscar/puestos/' + departamento,
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
}

$.carga_menus = function(departamento, puesto, metodo, div){
	div.empty();
	$.ajax({
		url : $(location).attr('href') + '/buscar/' + metodo + '/' + departamento + '/' + puesto,
		dataType : 'json',
		type : 'GET',
		success : function(response){
			$.each(response, function(indice, menu){
				div.append(`
					<button id="${menu.titulo}" type="button" class="list-group-item list-group-item-action" onclick="menu_clic(this);">
						<div class="row">
							<div class="col-md-3 text-center">
								<img alt="${menu.titulo}" class="img-fluid menu" src="${assetImagenesMenus + menu.imagen}"/>
							</div>
							<div class="col-md-9">
								<strong>${menu.titulo}</strong>
								<p>${menu.descripcion}</p>
							</div>
						</div>
					</button>	
				`);
			});
		},
		error: function(jqXHR, estado, error){
			console.log('ESTADO : ' + estado + ' ERROR : ' + error);
			alert('No se pudieron obtener los ' + metodo);
		}
	});	
}

$.des_agregar_menu = function (deptarmento, puesto, menu, lista, metodo){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
	$.ajax({
		url : $(location).attr('href') + '/' + metodo,
		dataType : 'json',
		type : (metodo == 'agregar') ? 'POST' : 'DELETE',
		data : { 'departamento' : deptarmento, 'puesto' : puesto, 'menu' : menu.id },
		success : function(response) {
			lista.append(menu);
		},
		error: function(jqXHR, estado, error){
			console.log('ESTADO : ' + estado + ' ERROR : ' + error + ' JQXHR : ' + jqXHR);
		}
	});	
}

function departamento_focus(e){
	valor_departamento_focus = e.options[e.selectedIndex].value;
}

function departamento_onblur(e){
	var vdb = e.options[e.selectedIndex].value;
	if(valor_departamento_focus != vdb){
		$('select#puesto').empty();
		$.re_carga_puestos(vdb);
	}
}

$.buscar = function (){
	var d = $('select#deptarmento');
	var p = $('select#puesto');
	d.prop('disabled', true);
	p.prop('disabled', true);
	$('button#buscar').prop('hidden', true);

	$('button#cancelar').removeAttr('hidden');
	$('button#agregar').removeAttr('hidden');
	$('button#quitar').removeAttr('hidden');
	d = d.val();
	p = p.val();
	$.carga_menus(d, p, 'menusConAcceso', $('div#menus_con_acceso'));
	$.carga_menus(d, p, 'menusSinAcceso', $('div#menus_sin_acceso'));
}

$.cancelar = function(){
	$('select#deptarmento').removeAttr('disabled');
	$('select#puesto').removeAttr('disabled');
	$('button#cancelar').prop('hidden', true);
	$('button#agregar').prop('hidden', true);
	$('button#quitar').prop('hidden', true);
	$('button#buscar').removeAttr('hidden');
	$('div#menus_con_acceso').empty();
	$('div#menus_sin_acceso').empty();
}

$.agregar = function(){
	var d = $('select#deptarmento').val(), p = $('select#puesto').val(), l = $('div#menus_con_acceso');
	$.each($('div#menus_sin_acceso button.list-group-item-info'), function(indice, menu){		
		$.des_agregar_menu(d, p, menu, l, 'agregar');
	});
	//$('div#menus_con_acceso').append($('div#menus_sin_acceso button.list-group-item-info'));
}

$.quitar = function(){
	var d = $('select#deptarmento').val(), p = $('select#puesto').val(), l = $('div#menus_sin_acceso');
	$.each($('div#menus_con_acceso button.list-group-item-info'), function(indice, menu){
		$.des_agregar_menu(d, p, menu, l, 'quitar');
	});	
	//$('div#menus_sin_acceso').append($('div#menus_con_acceso button.list-group-item-info'));
}

$.establece_escuchadores = function(){

	$('button#buscar').click($.buscar);

	$('button#cancelar').click($.cancelar);

	$('button#agregar').click($.agregar);

	$('button#quitar').click($.quitar);

}

$(function(){

	$.establece_escuchadores();

	$.re_carga_puestos($('select#deptarmento').val());
});