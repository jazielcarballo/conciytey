<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit();
		
	$expocientifico = mysql_real_escape_string(trim(@$_POST['expocientifico']));
	$expocientifico_paterno = mysql_real_escape_string(trim(@$_POST['expocientifico_paterno']));
	$expocientifico_materno = mysql_real_escape_string(trim(@$_POST['expocientifico_materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$quimicos = mysql_real_escape_string(trim(@$_POST['quimicos']));
	$riesgos = mysql_real_escape_string(trim(@$_POST['riesgos']));
	$seguridad = mysql_real_escape_string(trim(@$_POST['seguridad']));
	$procedimientos = mysql_real_escape_string(trim(@$_POST['procedimientos']));
	$fuentes = mysql_real_escape_string(trim(@$_POST['fuentes']));
	$supervisor = mysql_real_escape_string(trim(@$_POST['supervisor']));
	$supervisor_paterno = mysql_real_escape_string(trim(@$_POST['supervisor_paterno']));
	$supervisor_materno = mysql_real_escape_string(trim(@$_POST['supervisor_materno']));
	$puesto = mysql_real_escape_string(trim(@$_POST['puesto']));
	$telefono = mysql_real_escape_string(trim(@$_POST['telefono']));
	$email = mysql_real_escape_string(trim(@$_POST['email']));
	$fecha_compromiso = mysql_real_escape_string(trim(@$_POST['fecha_compromiso']));
	
	if(strlen($expocientifico)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	
	mysql_query("SET NAMES 'utf8'");
		
	$sql = "INSERT INTO formato_supervisor_asesoria (expocientifico,expocientifico_paterno,expocientifico_materno,proyecto,quimicos,riesgos,seguridad,procedimientos,fuentes,
			supervisor,supervisor_paterno,supervisor_materno,puesto,telefono,email,fecha_compromiso,status,fecha_registro)";
	
	$sql .= " VALUES ('$expocientifico','$expocientifico_paterno','$expocientifico_materno','$proyecto','$quimicos','$riesgos','$seguridad','$procedimientos','$fuentes','$supervisor',
			'$supervisor_paterno','$supervisor_materno','$puesto','$telefono','$email','$fecha_compromiso',1,now())";
	
	$sql = " UPDATE formato_investigacion_con_humanos SET expocientifico = '$expocientifico',expocientifico_paterno = '$expocientifico_paterno',expocientifico_materno = '$expocientifico_materno',
				 proyecto = '$proyecto',quimicos = '$quimicos',riesgos = '$riesgos', 
				 seguridad = '$seguridad',procedimientos = '$procedimientos',fuentes = '$fuentes',
				 supervisor = '$supervisor',supervisor_paterno = '$supervisor_paterno',supervisor_materno = '$supervisor_materno',
				 puesto = '$puesto',telefono = '$telefono',email = '$email',
				 fecha_compromiso = '$fecha_compromiso',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	
	
	mysql_query($sql);
	

?>