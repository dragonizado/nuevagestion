$(".loadTool").click(function(){
	let _obj = $(this);
	let _id = _obj.data("ajaxid");
	if (_id != '' || _id != null) {
		$.ajax({
			url: _url+'?url=tools/ajax&',
			data:{id:_id},
			dataType:'json',
			type:'get'
		}).done(function(done){
			$('#infotool').html(
				'<center><h3 style="text-transform:uppercase;">'+done.nombre+'</h3></center>'+
				'<div class="row"><div class="col-md-7">'+
				'<p><span>Estado: </span> '+done.estado+'</p>'+
				'<p><span>Tipo: </span> '+done.tipo+'</p>'+
				'<p><span>Modelo: </span> '+done.modelo+'</p>'+
				'<p><span>Nº de serie: </span> '+done.n_serie+'</p>'+
				'<p><span>Nº inventario: </span> '+done.n_inventario+'</p>'+
				'<p><span>Técnico encargado: </span> '+done.tecnico+'</p>'+
				'</div>'+
				'<div class="col-md-5">'+
				'<div class="card" style="width: 18rem; margin: 0 auto;">'+
				'<div class="card-body">'+
				'<h5 class="card-title">Descripción - Observación</h5>'+
				'<h6 class="card-subtitle mb-2 text-muted">'+done.nombre+'</h6>'+
				'<p class="card-text">'+done.descripcion+'</p>'+
				// '<a href="#" class="card-link">Card link</a>'+
				// '<a href="#" class="card-link">Another link</a>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'<div class="row row justify-content-end">'+
				'<button class="btn btn-danger" style="margin-right: 16px;" onclick="closeinfo()">Cerrar</button>'+
				'</div>'
			);
		}).fail(function(fail){
			console.log("Error en el ajax que consulta la herramienta seleccionada. "+fail.responseText)
		});
	}else{
		alert("No se ha obtenido el identificador de la herramienta por favor contactar el servicio técnico.");
	}
	
});

function closeinfo(){
	$('#infotool').html('<center><h3><i class="fa fa-info-circle" aria-hidden="true"></i> No se ha seleccionado una Herramienta</h3></center>');
}