function register_state(){
	let _btn_close_modal = $("#btn-close-stage");
	let data_obj = $("#data-stagetools");
	let _description = data_obj.val();
	if(_description != ""){
		data_obj.removeClass("is-invalid");
		data_obj.parent().find('.modal-error').addClass('hidden');
		$.ajax({
			url: _url+'?url=tools/ajax_Rstage',
			data:{description:_description,ajax:_token},
			dataType:'json',
			type:'post'
		}).done(function(done){
			if (done == false){
				alert("Error al registrar el estado");
				return false;
			}
			$("#es_her").append('<option value="'+_description+'">'+_description+'</option>');
			data_obj.val('');
			_btn_close_modal.click();
		}).fail(function(fail){
			console.log("Error en el ajax que registra el estado: "+fail.resposeText);
		});
	}else{
		data_obj.addClass("is-invalid");
		data_obj.parent().find('.modal-error').removeClass('hidden');
	}
}


function register_types(){
	let _btn_close_modal = $("#btn-close-type");
	let data_obj = $("#data-typetool");
	let _description = data_obj.val();
	if(_description != ""){
		data_obj.removeClass("is-invalid");
		data_obj.parent().find('.modal-error').addClass('hidden');
		$.ajax({
			url: _url+'?url=tools/ajax_Rtype',
			data:{description:_description,ajax:_token},
			dataType:'json',
			type:'post'
		}).done(function(done){
			if (done == false){
				alert("Error al registrar el tipo de herramienta");
				return false;
			}
			$("#type").append('<option value="'+_description+'">'+_description+'</option>');
			data_obj.val('');
			_btn_close_modal.click();
		}).fail(function(fail){
			console.log("Error en el ajax que registra el tipo de herramienta: "+fail.resposeText);
		});
	}else{
		data_obj.addClass("is-invalid");
		data_obj.parent().find('.modal-error').removeClass('hidden');
	}
}

function register_locations(){
	let _btn_close_modal = $("#btn-close-location");
	let data_obj = $("#data-locations");
	let _description = data_obj.val();
	if(_description != ""){
		data_obj.removeClass("is-invalid");
		data_obj.parent().find('.modal-error').addClass('hidden');
		$.ajax({
			url: _url+'?url=tools/ajax_Rlocation',
			data:{description:_description,ajax:_token},
			dataType:'json',
			type:'post'
		}).done(function(done){
			if (done.stage == false){
				alert("Error al registrar el tipo de herramienta");
				return false;
			}
			$("#Current_location").append('<option value="'+done.ident+'">'+_description+'</option>');
			data_obj.val('');
			_btn_close_modal.click();
		}).fail(function(fail){
			console.log("Error en el ajax que registra el tipo de herramienta: "+fail.resposeText);
		});
	}else{
		data_obj.addClass("is-invalid");
		data_obj.parent().find('.modal-error').removeClass('hidden');
	}
}