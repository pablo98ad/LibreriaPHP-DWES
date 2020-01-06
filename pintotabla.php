<?php
	//sleep(1);
	// conexión con la base de datos
	require('conexion.php');
	$apartirde=$_POST["inicio"];
	$cantidad=$_POST["fin"];
	$busqueda= $_POST['search'];
	
	$query = "SELECT * FROM libros WHERE titulo LIKE '%$busqueda%' order by ID LIMIT $apartirde,$cantidad";
	$result = mysqli_query($conexion, $query);
	$nregistros = mysqli_num_rows($result);
	/*echo "<script>alert($nregistros)</script>";*/
	
	if($nregistros>0){
		while($row = mysqli_fetch_array($result)){
?>
		 <div id="articulo" class="p-1 col-md-3 col-sm-6 col-6" >
            <div class="card bg-secondary h-100" >
				 <?php echo '<img class="card-img-top img-fluid" id="imagenArticulo" src="data:image/jpeg;base64,'.base64_encode($row['IMAGEN']).'" alt="Card image cap">'?>
                <div class="card-body text-center">
					<div class="overflow-auto" style="height:7em">
						<h5  class="card-title "><?php echo trim($row["TITULO"]); ?></h5>
						<p class="card-text m-0 p-0"><?php echo trim($row["AUTOR"]).' | '.trim($row["EDITORIAL"]); ?></p>
					</div>
					<h3 class="card-text d-inline"><?php echo trim($row['PRECIO']).'€' ?></h3>
					<button type="button" onclick="addCarro(<?php echo $row["ID"] ?>)" class="btn btn-primary float-right d-inline">Comprar</button>      
				</div>
            </div>
        </div>
		 <?php
	 }
	}else{
		echo"<div class='ml-2 mr-2 h-100 w-100 justify-content-center text-center alert alert-danger' role='alert'><h4 class='alert-heading'>¡¡No hay articulos relaccioanos con la busqueda!!</h4></div>";
	}

	 # cerramos la conexion 
	mysqli_close($conexion); 
 ?>
</table>
