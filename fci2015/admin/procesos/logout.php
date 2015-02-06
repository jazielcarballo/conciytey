<?php
	session_start(); 
	include('../../includes/conexion.php'); 
	include('../../includes/configuracion.php'); 

	 
	$_SESSION["id_usuario"] = "";
	
	redirect("../index.php");
	die;
?>