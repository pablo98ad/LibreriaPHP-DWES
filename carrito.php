<?php
session_start();

if(!isset($_SESSION['user'])){//si no ha iniciado sesion le enviamos al index
	header('Location: index1.php');
	//exit;
}
require('conexion.php');
$productos=$_SESSION['productos'];//RECUPERAMOS LOS PRODUCTOS QUE TENGAMOS ALMACENADOS EN SESSION
//echo print_r($productos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
    <title>Carrito de la libreria bootstrap Pablo Avila</title>
</head>
<body>
<!-- ******************************* CABECERA ************************************************** -->
	<div class="container-xl mt-4 border rounded  bg-light">
	<div class=" row mb-1 pb-1 align-items-center justify-content-center">
		<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-primary border rounded"> -->
		<div  class="col-2 justify-content-center text-center col-sm-2 col-md-2">
			<div  class="pt-4 justify-content-center row">
				<a href="javascript:history.go(-1)" type="button" style="font-size:24px;" class="btn btn-primary">&#129144</a>
			</div>
		</div>
		<div class="pt-2 col-sm-8 col-md-8 col-8 text-center text-primary pb-0 mb-0">
			<img class="img-fluid" src="logo.png"  height="300" width="300"/>
			<br>
			<h5 class="text-center">Libreria Pablo Avila</h5>
			<h6 class="pb-0 mb-0 text-center">Carrito</h6>
		</div>
		<!-- con una row dentro de una col consigo que la estrella tenga un comportamiento aceptable -->
		<div  class="col-2 justify-content-center text-center col-sm-2 col-md-2">
			<div  class="pt-2 row h-100 align-items-center justify-content-center">
				<img class="h-100 img-fluid" id="estrella" src="estrella.gif" style="visibility:hidden;"/>
			</div>
		</div>
	</div>
	<HR>
	<!-- ******************************* CONTENIDO ************************************************** -->
	<div class=" row mb-1 pb-1 "><!--justify-content-center-->
	<?php 
		if(!isset($productos) || sizeof($productos)==0){
			echo"<div class='ml-2 mr-2 h-100 w-100 justify-content-center text-center alert alert-danger' role='alert'><h4 class='alert-heading'>¡¡No hay articulos en el carrito, añade alguno!!</h4></div>";
		}else{
	?>
		<div class="col-sm-8 col-md-9 col-12 text-center text-primary pb-0 mb-0 pl-md-5 pr-1"><!-- Porductos-->
			 <h5 class="text-left">(<?php echo sizeof($productos) ?>) Articulos en el carrito</h5>
			 <hr>
		<?php
			$precioTotal;
			foreach($productos as $id => $cantidad ) {
				//print "$id => $cantidad\n";
				$query = "SELECT * FROM libros WHERE id=$id";
				$result = mysqli_query($conexion, $query);
				$row = mysqli_fetch_array($result);
				echo '<div class="row bg-white border rounded p-0 m-0 ">
					<div class="col-4 col-md-2 p-0 m-0"><img width="100" style="min-width:100%" class=" rounded float-left p-0 m-0" src="data:image/jpeg;base64,'.base64_encode($row['IMAGEN']).'" alt="Card image cap"></div>
					<div class="pl-3 col-8 col-md-10 "> 
						<h5 class="text-left">'.$row["TITULO"].'</h5>
						<p class="p-0 m-0 text-left">'.$row["AUTOR"].'</p>
						<p class="p-0 m-0 text-left">'.$row["EDITORIAL"].'</p>
						<hr>
						<div class="d-flex justify-content-between">';
						
						echo '<select  onchange="actualizarProducto(this,'.$row["ID"].')" class="w-25">';
						for ($i=1;$i<=10;$i++){
							if($i==$cantidad){
								echo '<option selected>'.$i.'</option>';
							}else{
								echo '<option>'.$i.'</option>';
							}
						}					
						echo '</select>';
						echo '<h5 class="d-inline">TOTAL: '.($cantidad*$row['PRECIO']).'€</h5><a style="cursor: pointer;color:red" onclick="eliminarProducto('.$row["ID"].')" title="Borrar articulo/s">&#88</a></div>
					</div>
				</div>
				
				<hr class="m-2">';
				$precioTotal+=($cantidad*$row['PRECIO']);
			}
		?>		 		 
		<div class="row bg-white pl-0 mb-4">
			<div class="col-12 d-flex justify-content-between">
				<button id="botonVaciarCarro" onClick="vaciarCarro()" class="btn btn-danger">Vaciar Carrito</button>
				<a type="button" href="javascript:history.go(-1)" id="botonSeguiComprando"  class="btn btn-primary">Seguir Comprando</a>
			</div>
		
		</div>
			
			
			
			
			
			
		</div>
		
		<div class=" col-sm-4  col-md-3 col-12 text-center text-primary pb-0 mb-0"><!-- Suma total-->
			<div class="pb-3 border rounded border bg-warning ">
				<div class="w-100 d-flex justify-content-between">
					<h5 class="pl-3 text-dark d-inline">TOTAL:</h5><h5 class="pr-3 text-danger d-inline"> <?php echo $precioTotal?>€</h5>
				</div>
				<div style="height:50px"></div>
				<div class="d-flex justify-content-between pl-2 pr-2">
					<button id="botonFinVenta"  class="btn btn-primary">Finalizar Venta</button>
					<button id="botonImprimir"  class="btn btn-secondary">Imprimir</button>
				</div>
			</div>
		</div>
		
		
		<?php } ?>
	</div>








<footer class="row blue border rounded border-info mt-2">
	<div class="col-12 text-primary bg-white border rounded pt-2 pb-2">
	<h6 class="text-center">© 2020 Pablo Ávila Doñate</h6>
  </div>
</footer>

</div> <!-- cierre del class container -->

<script>
	function vaciarCarro(){	
		$.ajax({
			url:'editarCarro.php',
			type:'post',
			data:{orden:'vaciarCarro'},
			success:function(response){
				//alert(response);
				if(response == '1'){
					location.reload();
				}
			}
		});
	}
	
	function eliminarProducto(id){	
		$.ajax({
			url:'editarCarro.php',
			type:'post',
			data:{orden:'eliminarProducto',id:id},
			success:function(response){
				//alert(response);
				if(response == '1'){
					location.reload();
				}
			}
		});
	}
	
	function actualizarProducto(objeto,id ){
		//alert(objeto.value+id);
		$.ajax({
			url:'editarCarro.php',
			type:'post',
			data:{orden:'actualizarProducto',id:id, cantidad:objeto.value},
			success:function(response){
				//alert(response);
				if(response == '1'){
					location.reload();
				}
			}
		});
	}

</script>
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      
  </body>
</html>