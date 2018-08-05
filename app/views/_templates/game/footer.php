<script>
	


	$(".tm-lo-sf").click(function(){
		let dataid = $(this).data('fadeoutid');
		$(".matche-"+dataid).slideToggle();
	});

	//Se analiza el campo cuando se presiona una tecla sobre el
	$(".goals").keyup(function(){
		let obj = $(this).parent().parent();
		let obj_local = obj.find(".local-team").find("input.score");
		let obj_visit = obj.find(".visit-team").find("input.score");
		
		// se extrae el valor del campo para realizar las operaciones
		let local = obj_local.val();
		let visit = obj_visit.val();

		// variables para la tabla de posiciones
		let gf_local = gc_local = dg_local = pts_local = null;
		let gf_visit = gc_visit = dg_visit = pts_visit = null;
		
		
		let winner = null;
		let loser = null;

		obj_local.removeClass("is-valid");
		obj_local.removeClass("is-invalid");
		obj_visit.removeClass("is-valid");
		obj_visit.removeClass("is-invalid");

		if(local != "" && visit != ""){
			if(local > visit){
				gf_local = local;
				gc_local = visit;
				dg_local = local - visit;
				pts_local = 3;

				gf_visit = visit;
				gc_visit = local;
				dg_visit = visit - local;
				pts_visit = 0;

				obj_local.removeClass("is-invalid").addClass("is-valid");
				obj_visit.removeClass("is-valid").addClass("is-invalid");

				winner = obj_local.data("winner");
				loser = obj_visit.data("winner");
			}else if(local == visit){
				winner = "Empate";
				gf_local = local;
				gc_local = visit;
				dg_local = local - visit;
				pts_local = 1;

				gf_visit = visit;
				gc_visit = local;
				dg_visit = visit - local;
				pts_visit = 1;
				console.log("El encuentro termina en empate");
			}else if(local < visit){

				gf_local = local;
				gc_local = visit;
				dg_local = local - visit;
				pts_local = 0;

				gf_visit = visit;
				gc_visit = local;
				dg_visit = visit - local;
				pts_visit = 3;

				obj_visit.removeClass("is-invalid").addClass("is-valid");
				obj_local.removeClass("is-valid").addClass("is-invalid");

				winner = obj_visit.data("winner");
				loser = obj_local.data("winner");
			}	

			obj_local.attr("data-gf",gf_local);
			obj_local.attr("data-gc",gc_local);
			obj_local.attr("data-dg",dg_local);
			obj_local.attr("data-pts",pts_local);

			obj_local.parent().find("input.marcador_local_GF").val(gf_local);
			obj_local.parent().find("input.marcador_local_GC").val(gc_local);
			obj_local.parent().find("input.marcador_local_DF").val(dg_local);
			obj_local.parent().find("input.marcador_local_PTS").val(pts_local);


			obj_visit.attr("data-gf",gf_visit);
			obj_visit.attr("data-gc",gc_visit);
			obj_visit.attr("data-dg",dg_visit);
			obj_visit.attr("data-pts",pts_visit);

			obj_visit.parent().find("input.marcador_visit_GF").val(gf_visit);
			obj_visit.parent().find("input.marcador_visit_GC").val(gc_visit);
			obj_visit.parent().find("input.marcador_visit_DF").val(dg_visit);
			obj_visit.parent().find("input.marcador_visit_PTS").val(pts_visit);

			console.log("el equipo ganador es: "+winner);

		console.log("Datos del equipo local --- Nombre: "+obj_local.data("winner")+"|| goles favor: "+gf_local+"|| Goles contra: "+gc_local+"|| Diferencia de goles: "+dg_local+" Puntos: "+pts_local);

		console.log("Datos del equipo Visitante --- Nombre: "+obj_visit.data("winner")+" goles favor: "+gf_visit+" Goles contra: "+gc_visit+" Diferencia de goles: "+dg_visit+" Puntos: "+pts_visit);
		}
		

		// analizarequipos(winner);
		obj.find(".match-winner").val(winner);
		obj.find(".match-winner").attr("data-losername",loser);
		console.log("marcador: "+local+" - "+visit);
	});




	$(".goals-out-e").keyup(function(){
		let obj = $(this).parent().parent();
		let obj_local = obj.find(".local-team").find("input.score");
		let obj_visit = obj.find(".visit-team").find("input.score");
		
		// se extrae el valor del campo para realizar las operaciones
		let local = obj_local.val();
		let visit = obj_visit.val();

		// variables para la tabla de posiciones
		let gf_local = gc_local = dg_local = pts_local = null;
		let gf_visit = gc_visit = dg_visit = pts_visit = null;
		
		
		let winner = null;
		let loser = null;

		obj_local.removeClass("is-valid");
		obj_local.removeClass("is-invalid");
		obj_visit.removeClass("is-valid");
		obj_visit.removeClass("is-invalid");

		obj_local.parent().find(".penalts").addClass("hidden");
		obj_local.parent().find(".penalts").prop("checked",false);
		obj_local.parent().find(".penalts-text").addClass("hidden");
		obj_visit.parent().find(".penalts").addClass("hidden");
		obj_visit.parent().find(".penalts").prop("checked",false);
		obj_visit.parent().find(".penalts-text").addClass("hidden");

		if(local != "" && visit != ""){
			if(local > visit){
				gf_local = local;
				gc_local = visit;
				dg_local = local - visit;
				pts_local = 3;

				gf_visit = visit;
				gc_visit = local;
				dg_visit = visit - local;
				pts_visit = 0;

				obj_local.removeClass("is-invalid").addClass("is-valid");
				obj_visit.removeClass("is-valid").addClass("is-invalid");

				winner = obj_local.data("winner");
				loser = obj_visit.data("winner");
			}else if(local == visit){
				winner = "Empate";
				gf_local = local;
				gc_local = visit;
				dg_local = local - visit;
				pts_local = 1;

				gf_visit = visit;
				gc_visit = local;
				dg_visit = visit - local;
				pts_visit = 1;

				obj_local.parent().find(".penalts").removeClass("hidden");
				obj_local.parent().find(".penalts-text").removeClass("hidden");
				obj_visit.parent().find(".penalts").removeClass("hidden");
				obj_visit.parent().find(".penalts-text").removeClass("hidden");
				alert("el partido termina "+local+" - "+visit+" Debe seleccionar el equipo ganador en penales.");
				console.log("El encuentro termina en empate");
			}else if(local < visit){

				gf_local = local;
				gc_local = visit;
				dg_local = local - visit;
				pts_local = 0;

				gf_visit = visit;
				gc_visit = local;
				dg_visit = visit - local;
				pts_visit = 3;

				obj_visit.removeClass("is-invalid").addClass("is-valid");
				obj_local.removeClass("is-valid").addClass("is-invalid");

				winner = obj_visit.data("winner");
				loser = obj_local.data("winner");
			}	

			obj_local.attr("data-gf",gf_local);
			obj_local.attr("data-gc",gc_local);
			obj_local.attr("data-dg",dg_local);
			obj_local.attr("data-pts",pts_local);

			obj_local.parent().find("input.marcador_local_GF").val(gf_local);
			obj_local.parent().find("input.marcador_local_GC").val(gc_local);
			obj_local.parent().find("input.marcador_local_DF").val(dg_local);
			obj_local.parent().find("input.marcador_local_PTS").val(pts_local);


			obj_visit.attr("data-gf",gf_visit);
			obj_visit.attr("data-gc",gc_visit);
			obj_visit.attr("data-dg",dg_visit);
			obj_visit.attr("data-pts",pts_visit);

			obj_visit.parent().find("input.marcador_visit_GF").val(gf_visit);
			obj_visit.parent().find("input.marcador_visit_GC").val(gc_visit);
			obj_visit.parent().find("input.marcador_visit_DF").val(dg_visit);
			obj_visit.parent().find("input.marcador_visit_PTS").val(pts_visit);

			console.log("el equipo ganador es: "+winner);

		console.log("Datos del equipo local --- Nombre: "+obj_local.data("winner")+"|| goles favor: "+gf_local+"|| Goles contra: "+gc_local+"|| Diferencia de goles: "+dg_local+" Puntos: "+pts_local);

		console.log("Datos del equipo Visitante --- Nombre: "+obj_visit.data("winner")+" goles favor: "+gf_visit+" Goles contra: "+gc_visit+" Diferencia de goles: "+dg_visit+" Puntos: "+pts_visit);
		}
		

		// analizarequipos(winner);
		obj.find(".match-winner").val(winner);
		obj.find(".match-loser").val(loser);
		obj.find(".match-winner").attr("data-losername",loser);
		console.log("marcador: "+local+" - "+visit);
	});

	$(".penalts").change(function(){
			let obj = $(this).parent().parent();
			obj.removeClass("bg-danger");
		if($(this).is(":checked")){
			let winner = $(this).data("fatality");
			let loser = $(this).data("fatalityloser");
			obj.find(".match-winner").val(winner);
			obj.find(".match-loser").val(loser);
		}else{
			obj.find(".match-winner").val("");
		}
	});


	$("form").submit(function(e){
		// e.preventDefault();
		if($(this).get(0).checkValidity()){
			if(valid_input()){
				$(".btn-next").addClass("hidden");
				$("#btn-submit-loading").removeClass("hidden");
			}else{
				return false;
			}
		}else{
			return false;
		}
	});

	function valid_input(){
		let men = true;
		$(".goals-out-e").parent().parent().find(".match-winner").each(function(index,data){
			if($(this).val() == "Empate" || $(this).val() == ""){
				$(this).parent().addClass("bg-danger");
				men = false;
				return false;
			}
		});

		if(!men){
			alert("debes seleccionar que equipo gana en penales.");
		}
		return men;
	}
</script>

<script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;
	console.log(tecla);
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
    //Tecla de tab
     if (tecla==0){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>
</body>
</html>