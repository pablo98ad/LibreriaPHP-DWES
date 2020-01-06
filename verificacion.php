<?php
//header('Content-Type: text/html; charset=UTF-8');
require('conexion.php');

session_start();

$user=$_POST["usuario"];
$pass=$_POST["pass"];
$recordar=$_POST["recordar"];

$sql=mysqli_query($conexion,"SELECT NIF FROM usuarios where USUARIO='$user' and PASSWORD='$pass'");

$res = mysqli_fetch_assoc($sql);//OBTENEMOS EL ID SEL USUARIO SI EXISTE, SI NO NO DEVOLVERA NADA

if (isset($res["NIF"])){///COMPROBAMOS SI EXISTE EL USUARIO
	
	//echo "correcto ".$user;
	$_SESSION['userID'] = $res["NIF"];//GUARDAMOS SU ID
	$_SESSION['user'] = $user;//GUARDAMOS SU NOMBRE DE USUARIO
	
	if($recordar=='si'){
		setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time()+9999999);	
	}
	echo "1";
	/*NO FUNCIONA CON LA LLAMADA AJAX JAVASCRIPT ->
	header("location:correo.php");//LO REDIRIJO AL CORREO
	*/
	
	
	
}else{
	echo "0";
	//ECHO $recordar;
	//header("location:avisoerror.php");//SI NO EXISTE EL USUARIO LO LLEVO A AVISOERROR
	
	//ECHO "NO";
}

?>