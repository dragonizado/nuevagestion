	<div id="loader">
		<div class="spinner"></div>
	</div>
	<script>
		window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        setTimeout(() => {
          loader.classList.add('fadeOut');
        }, 300);
      });
	</script>
    <div class="peers ai-s fxw-nw h-100vh">
    	<div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url(assets/static/images/bg.jpg)">
    		<div class="pos-a centerXY">
    			<div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px">
    				<img class="pos-a centerXY" src="assets/static/images/logo.png" alt="">
    			</div>
    		</div>
    	</div>
    	<div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
    		<h4 class="fw-300 c-grey-900 mB-40">Inciar Sesión</h4>
    		<form method="post">
    			<div class="form-group">
    				<label class="text-normal text-dark">Correo</label> 
    				<input type="email" id="username" name="username" class="form-control" placeholder="johndoe@contoso.com"></div>
    				<div class="form-group">
    					<label class="text-normal text-dark">Contraseña</label> 
    					<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
    				</div>
    				<span style="color:red;"><?=$this->loginErrors;?></span>
    				<div class="form-group">
    					<div class="peers ai-c jc-sb fxw-nw">
    						<div class="peer">
    							<div class="checkbox checkbox-circle checkbox-info peers ai-c">
    								<input type="checkbox" id="inputCall1" name="inputCheckboxesCall" class="peer"> 
    								<label for="inputCall1" class="peers peer-greed js-sb ai-c">
    									<span class="peer peer-greed">Recuerdame</span>
    								</label>
    							</div>
    						</div>
    						<div class="peer">
    							<button class="btn btn-primary">Iniciar</button>
    						</div>
    					</div>
    				</div>
    			</form>
    		</div>
    	</div>
    	<script type="text/javascript" src="<?=URL;?>public/js/themes/vendor.js"></script>
    	<script type="text/javascript" src="<?=URL;?>public/js/themes/bundle.js"></script>