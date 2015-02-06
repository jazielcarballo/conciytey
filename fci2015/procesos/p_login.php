<?php 
	session_start();
	include("../includes/configuracion.php");
	include("../includes/conexion.php");
	
	$usuario = mysql_real_escape_string(trim(@$_POST['usuario_login']));
	$password = mysql_real_escape_string(trim(@$_POST['password_login']));
	
	if (strlen($usuario) == 0 OR strlen($password) == 0)
	{
		echo 'Especifique usuario y contraseña.';
		exit();
	}
	
	$sql = "SELECT * FROM participantes WHERE email = '$usuario' AND password = '$password' AND status = 1";
	$query = mysql_query($sql);
	
	if(mysql_num_rows($query) == 0){
		echo 'Usuario y/o contraseña incorrectos.';
		exit();
	}
	
	$result = mysql_fetch_array($query);
	
	$_SESSION['fenaci']["id_usuario"] = $result['id'];
	$_SESSION['fenaci']["nombre"] =  $result['nombre'];
	$_SESSION['fenaci']["email"] =  $result['email'];
	$_SESSION['fenaci']["tipo"] =  $result['tipo'];
	$_SESSION['fenaci']["folio"] = $result['folio'];
	
	
	die;
?>