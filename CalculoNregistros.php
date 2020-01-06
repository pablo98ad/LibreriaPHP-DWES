<?php
	// conexión con la base de datos
	require('conexion.php');
	$busqueda= $_POST['search'];
	//echo $busqueda;
	$consulta = "SELECT * FROM libros WHERE titulo LIKE '%$busqueda%'";
	$resultado = mysqli_query($conexion,$consulta);
	$nregistros = mysqli_num_rows($resultado);
	
	echo $nregistros;
	
	// cerramos la conexión 
	 mysqli_close($conexion); 
?>