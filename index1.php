<?php 
	session_start();
	// SESIÓN INICIADA
	if(isset($_SESSION['user'])){
		$usuario=$_SESSION['user'];
	}else{
		$usuario=null;
	}
	
	//$_SESSION['user']="pablo";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<style>
	.pulsado{
	
	
		transition: opacity 2s ease-in-out;
		opacity: 0;
		
	}
	</style>
    <title>Libreria bootstrap Pablo Avila</title>
	
	
	<script language='javascript'>
	var busqueda;
	//compruebo si hay una sesion iniciada	
	var sesion = <?php if($usuario==null) { ?>false<?php } else { ?>true<?php }?>;
	
	function inicio(){
		busqueda= document.getElementById('busqueda').value;
		//alert(busqueda);
		mostrarLogin();//mostramos el formulario de iniciar sesion o el boton de cerrarla
		$.post("CalculoNregistros.php",{search:busqueda},llegadaDatos);
		verNumCarro();//para cuando recargemos la pagina aparezcan cuandos articulos tenemos en el carro		
	}
	
	function addCarro(boton,id){
		if(sesion){

			$("#estrella").css("visibility","visible");
			$("#carrito").load("addCarro.php",{producto:id}, function(){
				
				$(boton).append('<p style="position:absolute;  z-index:2" class="text-success"><b>¡Añadido!</b></p>');
				var anadido=$(boton).children();
				anadido.css('top', '-=57');
				/*setTimeout(function(){
					anadido.addClass('pulsado');
				}, 500);*/
			
				setTimeout(function(){
					anadido.remove();
				}, 600);
				setTimeout(function(){
					anadido.animate({
					 top: '-=50px'});
				}, 11);
				
				window.setTimeout(function() {
					anadido.fadeTo(500, 0).slideUp(500, function() {
					$(this).hide();
				});
				}, 12);
				
				$("#estrella").css("visibility","hidden");
			});
		}else{
			mostrarAlerta('Para poder añadir algo en el carro te tienes que loguear.');
		}
	}
	
	function verNumCarro(){
		if(sesion){
			$("#carrito").load("addCarro.php",{}, function(){});
		}
		
	}
	
	function pulsarEnCarro(){
		if(sesion){
			window.location= 'carrito.php';
		}else{
			mostrarAlerta('Para poder ver el carro primero te tienes que loguear.');
		}	
	}
	
	function mostrarAlerta(mensaje){
		$("#alertas").html("<div class='pb-0 text-center alert alert-danger' role='alert'><h4 class='alert-heading'>AVISO</h4><hr><h5>"+mensaje+"</h5></div>");//w-100 fixed-top
		window.scrollTo(0, 0);
		window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).hide();
            });
        }, 1900);
	}
	
	
		
		
	</script>
	<script language='javascript' src="js/paginacion.js"></script>
	<script language='javascript' src="js/inciarSesion.js"></script>
  </head>

<body onload="inicio()">
<!-- si en el siguiente div pongo ".container-fluid" ocupará toda el área gráfica (horizontal) y no 12 columnas por defecto-->
<!-- mt-3 es para definir el espacio en blanco del principio de la página -->
<!-- m -> margin  ejemplo top: mt-3 -->
<!-- p -> padding -->

<div id="alertas"></div>

<div class="container-xl mt-4 border rounded  bg-light" >
<!-- ******************************* CABECERA ************************************************** -->
	  <div class=" row mb-2 pb-2 align-items-center justify-content-center">
				<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-primary border rounded"> -->
				<div class="pt-2 col-sm-10 col-md-11 col-12 text-center text-primary ">
						
						<img class="img-fluid" src="logo.png"  height="300" width="300"/>
						<br>
						<h5 class="text-center">Libreria Pablo Avila</h5>
						<h6 class="pb-0 mb-0 text-center">Tienda</h6>
				</div>
				
				<!-- con una row dentro de una col consigo que la estrella tenga un comportamiento aceptable -->
				<div  class="col-12 justify-content-center text-center col-sm-2 col-md-1">
					<div  class="pt-2 row h-100 align-items-center justify-content-center">
						<img class="h-100 img-fluid" id="estrella" src="estrella.gif" style="visibility:hidden;"/>
					</div>
					<div  class="pt-4 justify-content-center row">
						<a  onclick="pulsarEnCarro()"  type="button" style="font-size:24px;" class="btn btn-primary">&#128722 <span id="carrito" class="badge badge-light">0</span></a>
					</div>
				</div>
	  </div>
	  <HR>
	  
	<!-- ******************************** CONTENIDO *************************************************** -->	 	  
<div class="pt-3 row border rounded border-info bg-white">

	<!-- ******************************* INICIO SESION Y BUSQUEDA ************************************************** -->
			<div id="menuVertical" class=" p-0 m-0  mt-2 col-md-2 col-sm-4 col-12">
			
				<div class="row ">
					<div class="col-12 text-center">
							<form class="pb-2 form bg-info">
								<div class="pl-2 pr-2">
									<h5>Buscar <small> (titulo)</small></h5>
									<input id="busqueda" onkeyup="inicio()" class="form-control" type="text" placeholder="Buscar" aria-label="Search">
								</div>
							</form>
					</div>	
				</div>
				<!-- SE RELLENA CON LA FUNCION mostrarLogin() -->
				<div class="row pb-2">
					<div id="login" class="col-12  text-center">
						
					</div>
				</div>
			</div>	
	<!-- ******************************* PRODUCTOS ************************************************** -->
				<div  class="col-md-10 col-sm-8 col-12 ">
					<div id="articulos" class="row">
					<!-- Se rellena con llamada ajax-->	
					</div>
				</div> 
</div>
<!-- ******************************** PAGINACION *************************************************** -->	 
<section>
<div class="row mt-2 bg-white pt-3 justify-content-center">
<nav>
<ul class='pagination'>

			<!-- botón PRIMERA -->
			<li onclick="primera()" id="primera" class='page-item'><a class='page-link' href='#'>Primera</a></li>

			<!-- botón ANTERIOR -->
			<li onclick="anterior()" id="anterior" class='page-item'><a class='page-link' href='#'><<</a></li>
	
			<!-- 5 botones -->
			<li  onclick="cualquiera(1)" id="1li" class='page-item'><a id="1" class='page-link' href='#'></a></li>
			<li  onclick="cualquiera(2)" id="2li" class='page-item'><a id="2" class='page-link' href='#'></a></li>
			<li  onclick="cualquiera(3)" id="3li" class='page-item'><a id="3" class='page-link' href='#'></a></li>
			<li  onclick="cualquiera(4)" id="4li" class='page-item'><a id="4" class='page-link' href='#'></a></li>
			<li  onclick="cualquiera(5)" id="5li" class='page-item'><a id="5" class='page-link' href='#'></a></li>

			<!-- botón SIGUIENTE -->
			<li onclick="siguiente()" id="siguiente" class='page-item'><a class='page-link' href='#'>>></a></li>

			<!-- botón ÚLTIMA -->
			<li onclick="ultima()" id="ultima" class='page-item'><a id="totales" class='page-link' href='#'>Última</a></li>

</ul>
</nav>
<!--
<div class="pt-2 pl-1 pr-1 h-100  text-center text-primary border rounded bg-primary m-0 p-0">
	<h5 id="actual" class="text-center text-white m-0 p-0"></h5>
</div>			
<div class="h-100 text-center text-primary border rounded bg-success ">
	<h5 id="totales" class="text-center text-white m-0 p-0"></h5>
</div>
-->

</div> <!-- div blanco barra de navegacion -->
</section>

<!-- ******************************** PIE DE PÁGINA ********************************************** -->
<footer class="row blue border rounded border-info mt-2">
	<div class="col text-primary bg-white border rounded pt-2 pb-2">
	<h6 class="text-center">© 2020 Pablo Ávila Doñate</h6>
  </div>
</footer>


</div> <!-- class="container" -->


<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
</body>
</html>