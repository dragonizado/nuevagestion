<div class="modal fade" id="mtypetool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Registrar Tipo de herramienta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Tipo de herramienta</label>
					<input type="text" class="form-control" id="data-typetool" maxlength="30">
					<p class="modal-error hidden" style="color:red;">El campo no debe esta vacio</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close-type">Cerrar</button> 
				<button type="button" class="btn btn-primary" onclick="register_types();">Registrar</button>
			</div>
		</div>
	</div>
</div>