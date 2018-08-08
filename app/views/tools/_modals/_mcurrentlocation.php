<div class="modal fade" id="mcurrentlocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Registrar Locaciones</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Localización</label>
					<input type="text" class="form-control" id="data-locations" maxlength="45">
					<p class="modal-error hidden" style="color:red;">El campo no debe esta vacio</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close-location">Cerrar</button> 
				<button type="button" class="btn btn-primary" onclick="register_locations();">Registrar</button>
			</div>
		</div>
	</div>
</div>