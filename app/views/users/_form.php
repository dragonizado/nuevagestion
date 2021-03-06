<?php if ($id == ''): ?>
<form action="<?=URL?>public/index.php?url=default/signin" method="post" >
	<?php else: ?>
<form action="<?=URL?>public/index.php?url=default/signin&id=<?=$id;?>" method="post" >
<?php endif ?>
	<div class="form-row">
		<h4>
			<?php if ($id == ''): ?>
				Registro de usuario
				<?php else: ?>
				Editar usuario
			<?php endif ?>
		</h4>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<input type="hidden" class="form-control" id="formid" name="id" value="<?=$id;?>">
			<label for="inputEmail4">Correo: <span style="color:red;">*</span></label> 
			<input type="email" class="form-control" id="inputEmail4" name="email" value="<?=$correo;?>" placeholder="Correo" autocomplete="false" required>
		</div>
		<div class="form-group col-md-6">
			<label for="inputPassword4">Contraseña: <span style="color:red;">*</span></label> 
			<input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Contraseña" autocomplete="false" <?php ($id == '')?'required':''; ?> >
		</div>
	</div>
	<div class="form-group">
		<label for="inputUser">Usuario: <span style="color:red;">*</span></label> 
		<input type="text" class="form-control" id="inputUser" name="nickname" value="<?=$nombre;?>"  required>
	</div>
	<div class="form-group">
		<label for="inputAddress">Nombre: <span style="color:red;">*</span></label> 
		<input type="text" class="form-control" id="inputAddress" name="firtsname" value="<?=$nombre;?>"  required>
	</div>
	<div class="form-group">
		<label for="inputAddress2">Apellido: <span style="color:red;">*</span></label> 
		<input type="text" class="form-control" id="inputAddress2" name="secondname" value="<?=$apellido;?>"  required>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="inputCity">Documento: <span style="color:red;">*</span></label> 
			<input type="text" class="form-control" id="inputCity" name="document" value="<?=$documento;?>" placeholder="##########" required>
		</div>
		<div class="form-group col-md-4">
			<label for="inputRol">Rol: <span style="color:red;">*</span></label> 
			<select id="inputRol" name="rol" class="form-control" value="<?=$rol;?>" required>
				<option value="3" <?php echo ($id != '' && $rol == '3' )?'selected="selected"':''; ?> >Tecnico</option>
				<option value="2" <?php echo ($id != '' && $rol == '2' )?'selected="selected"':''; ?> >Administrador</option>
			</select>
		</div>

		<div class="form-group col-md-4">
			<label for="inputState">Estado: <span style="color:red;">*</span></label> 
			<select id="inputState" name="state" class="form-control" value="<?=$estado;?>" required>
				<option value="ACTIVO" <?php echo ($id != '' && $estado == 'ACTIVO' )?'selected="selected"':''; ?> >Activo</option>
				<option value="INACTIVO" <?php echo ($id != '' && $estado == 'INACTIVO' )?'selected="selected"':''; ?> >Sin activar</option>
				<option value="DESHABILITADO" <?php echo ($id != '' && $estado == 'DESHABILITADO' )?'selected="selected"':''; ?> >Deshabilitado</option>
			</select>
		</div>
		<div class="form-group col-md-12 <?= ($id != '' && $rol == '3')?'hidden':''; ?> <?= ($id == '' && $rol == '')?'hidden':''; ?>" id="email_sender">
			<input type="checkbox" name="send_email" id="send_email" <?= ($send_email == true)?'checked':'';?>>
			<label for="send_email">Enviar notificaciones del sistema a este usuario?</label>
		</div>
	</div>
	<?php if ($id == ''): ?>
		<button type="submit" class="btn btn-primary" name="btn-register">Registrar</button>
		<?php else: ?>
		<button type="submit" class="btn btn-success" name="btn-save">Guardar</button>
		<a href="<?=URL?>public/index.php?url=default/signin" class="btn btn-danger">Cancelar</a>
	<?php endif ?>
	</form>

	<script>
		$('#inputRol').change(function(){
			let obj = $("#inputRol option:selected");
			if(obj.val() != '3'){
				$("#email_sender").removeClass("hidden");
			}else{
				$("#email_sender").addClass("hidden");
				$("#send_email").prop('checked',false);
			}
		});
	</script>