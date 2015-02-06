<?php session_start(); ?>
<?php include("../../includes/configuracion.php"); ?>
<?php include("../../includes/conexion.php"); ?>
<?php

$sUsuario = mysql_real_escape_string(trim(@$_POST['sUsuario']));
$sClave = mysql_real_escape_string(trim(@$_POST['sClave']));

setcookie("sUsuario", $sUsuario, time() + 3600); 
setcookie("sClave", $sClave, time() + 3600); 

if (strlen($sUsuario) == 0 or strlen($sClave) == 0)
{
	redirect("../index.php?iMensaje=1");
	die;
}

$oLogin="SELECT * FROM usuarios WHERE usuario = '". $sUsuario."'  AND clave = '".$sClave."'";
$oResultadoLogin = mysql_query($oLogin) or die("Error en la consulta;: " . mysql_error()); 
$oRs=mysql_fetch_array($oResultadoLogin, MYSQL_ASSOC);
$oRsEof=mysql_num_rows($oResultadoLogin);

if ($oRsEof ==0)
{
	redirect("../index.php?iMensaje=2");
	die;
}
	$_SESSION["id_usuario"] = $oRs['id_usuario'];
	$_SESSION["nombres"] = $oRs['nombres'];
	$_SESSION["email"] = $oRs['email'];
	$_SESSION["fecha_acceso"] = $oRs['fecha_acceso'];
	$_SESSION["ip_acceso"] = $oRs['ip_acceso'];;		
		
	$Date = date('Y-m-d G:i:s');
	
	$oActualiza="UPDATE Usuarios SET fecha_acceso = '". $Date ."', ip_acceso = '". @$_SERVER['REMOTE_ADDR'] ."' WHERE id_usuario = ". $oRs['id_usuario'] ."";
	$oResultado= mysql_query($oActualiza);  		
	
	redirect("../panel.php");
	die;
?>