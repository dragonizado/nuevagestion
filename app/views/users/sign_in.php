<div class="row">
	<div class="col-md-4">
		<div class="bgc-white p-20 bd">
			<?php include "_form.php"; ?>
		</div>
	</div>

	<div class="col-md-8">
		<div class="bgc-white p-20 bd">
			<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Documento</th>
						<th>correo</th>
						<th>Rol</th>
						<th>Estado</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?=$tableBody;?>
				</tbody>
			</table>
		</div>
	</div>

</div>