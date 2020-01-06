<?php

session_start();

$orden= $_POST['orden'];


switch ($orden) {
    case 'vaciarCarro':
        unset($_SESSION['productos']);
		echo '1';
        break;
	case 'eliminarProducto':
		$id= $_POST['id'];
		unset($_SESSION['productos'][$id]);
        echo "1";
        break;
	case 'actualizarProducto':
		$id= $_POST['id'];
		$cantidad= $_POST['cantidad'];
		$_SESSION['productos'][$id]=$cantidad;
        echo "1";
        break;
}
?>