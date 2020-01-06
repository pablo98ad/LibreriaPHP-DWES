<?php
session_start();
$haySesion= $_POST['sesionn'];

$user=$_SESSION['user'];
//echo"<script>alert($user); </script>";

if($haySesion!='false'){
?>	
	<div class="bg-secondary mb-2 mt-4 pb-2">
		<h5>Sesion Iniciada</h5>
		<div class="bg-warning ml-2 mr-2 rounded"><h6 class=" d-inline pb-2 pt-">Hola <h6 class="d-inline text-success"><?php echo $user; ?></h6></h6></div>
		<a class="mt-2 mb-2 btn btn-primary" href="cerrarSesion.php" role="button">Cerrar Sesion</a>
	</div>
	
<?php
}else{
?>
<div  id="logueo" class="form border mt-4 pb-2 bg-secondary text-center">
		<h5>Inicio Sesion</h5>
		<div class="form-group bg-warning ml-2 mr-2 mt-0 pt-0 rounded">
			<label for="userInput">Ususario</label>
			<input name="usuario" type="username" class="form-control" id="userInput" placeholder="Ususario">
		</div>
		<div class="form-group ml-2 mr-2 mt-0 pt-0 bg-warning rounded">
			<label for="passInput">Contraseña</label>
			<input name="pass" type="password" class="mt-0 pt-0 form-control" id="passInput" placeholder="Contraseña">
		</div>
		<div class="form-check mb-2">
			<input name="recordar" type="checkbox" class="form-check-input " id="dropdownCheck2">
			<label class="form-check-label" for="dropdownCheck2">Recordar sesion</label>
		</div>
		<button type="submit" id="botonLogueo" onClick="loguearse()" class="btn btn-primary">Iniciar Sesion</button>
		
	</div>
	

	
<?php
	
	
}






?>