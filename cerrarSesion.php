<?php

session_start();

setcookie(session_name(), '', time() - 42000); //MATAMOS LA COOOKIEEE
//************************************************************

$_SESSION = array();
session_destroy();//DESTRUIMOS LA SESION


header("location:index1.php");//LO REDIRECCIONAMOS AL INDEX
?>