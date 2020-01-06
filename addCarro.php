<?php
session_start();

$newProducto=$_POST["producto"];//RECUPERAMOS EL ID DEL PRODUCTO QUE NOS PASAN POR LA LLAMADA AJAX

$productos=$_SESSION['productos'];//RECUPERAMOS LOS PRODUCTOS QUE TENGAMOS ALMACENADOS EN SESSION

if(isset($productos)==0){//SI ES LA PRIMERA VEZ CREAMOS EL ARRAY
	$productos= array();
}
if(isset($newProducto)){
	
	if(isset($productos[$newProducto])){
		$productos[$newProducto]=$productos[$newProducto]+1;
	}else{
		$productos[$newProducto]=1;
	}
	$_SESSION['productos']=$productos;//VOLVEMOS A ALMACENAR EL ARRAY
}

//PARA SABER CUANTOS PRODUCTOS HAY DISTINTOS
echo sizeof($productos);//PONEMOS EL NUMERO DE ELEMENTOS NO REPETIDOS AL LADO DEL CARRITO
?>