<!-- <div class="full-container">Pagina ---- contenido contenido completo</div> -->
<div class="row">
	<div class="col-md-12">
		<?php if ($_SESSION['rol'] == "1" || $_SESSION['rol'] == "2"): ?>
			<?php include "_partials/admin/index.php" ?>
		<?php else: ?>
			<?php include "_partials/tecnico/index.php" ?>
		<?php endif ?>
	<!-- 	<div class="bgc-white">Pagina ---- contenido</div> -->
	</div>
</div>