<div class="modal fade" id="mstagetools" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Registrar estado</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Estado</label>
					<input type="text" class="form-control" id="data-stagetools" maxlength="15">
					<p class="modal-error hidden" style="color:red;">El campo no debe esta vacio</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close-stage">Cerrar</button> 
				<button type="button" class="btn btn-primary" onclick="register_state()">Registrar</button>
			</div>
		</div>
	</div>
</div>