<div class="row">
	<div class="col-md-12">
		<div class="bgc-white p-20 bd">
			<h2>Herramientas</h2>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col-md-12">
		<div class="bgc-white p-20 bd">
			<form action="<?=URL;?>public/index.php?url=tools/multitools" method="post">
			<table id="dataTable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Selección</th>
						<th>Nombre</th>
						<th>Ubicación</th>
						<th>Técnico</th>
						<!-- <th>Opciones</th> -->
					</tr>
				</thead>
				<tbody>
						<?php 
							if($_SESSION['rol'] != '3'){
								include "_table_tools_admin.php";
							}else{
								include "_table_tools_tecnico.php";
							}
						 ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-12">
					<button id="btn-search-outtech" class="btn btn-info" name="btn_register" disabled>Agregar</button>
				</div>
			</div>
			</form>

		</div>
	</div>
</div>

<script>
	$('.tools_check').click(function(){
		let obj = $(this);
		let submit = 0;
		if (obj.is(':checked')){
			obj.parent().parent().find("select").prop('disabled',false);
		}else{
			obj.parent().parent().find("select").prop('disabled',true);
		}
		$(".tools_check").each(function(index,value){
			if(value.checked == true){
				submit = submit + 1;
			console.log(value.checked);
			}
		});
		if(submit >= 1){
			$("#btn-search-outtech").prop('disabled',false);
		}else{
			$("#btn-search-outtech").prop('disabled',true);
		}
	});
</script>

