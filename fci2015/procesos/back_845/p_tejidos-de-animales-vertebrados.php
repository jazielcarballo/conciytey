<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit();
	
	$lider = mysql_real_escape_string(trim(@$_POST['lider']));
	$lider_paterno = mysql_real_escape_string(trim(@$_POST['lider_paterno']));
	$lider_materno = mysql_real_escape_string(trim(@$_POST['lider_materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$tejido_tipo = mysql_real_escape_string(trim(@$_POST['tejido_tipo']));
	$tejido_de = mysql_real_escape_string(trim(@$_POST['tejido_de']));
	$tejido_institucion = mysql_real_escape_string(trim(@$_POST['tejido_institucion']));
	$supervisor_verifico = mysql_real_escape_string(trim(@$_POST['supervisor_verifico']));
	$supervisor_certifico = mysql_real_escape_string(trim(@$_POST['supervisor_certifico']));
	$supervisor = mysql_real_escape_string(trim(@$_POST['supervisor']));
	$fecha_supervisor = mysql_real_escape_string(trim(@$_POST['fecha_supervisor']));
	$titulo_supervisor = mysql_real_escape_string(trim(@$_POST['titulo_supervisor']));
	$Institucion_supervisor = mysql_real_escape_string(trim(@$_POST['Institucion_supervisor']));
	$telefono_supervisor = mysql_real_escape_string(trim(@$_POST['telefono_supervisor']));
	$email_supervisor = mysql_real_escape_string(trim(@$_POST['email_supervisor']));
	
	if(strlen($supervisor_verifico) == 0) $supervisor_verifico= 0;
	if(strlen($supervisor_certifico) == 0) $supervisor_certifico= 0;
		
	/*
	if(strlen($lider)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	*/
	
	mysql_query("SET NAMES 'utf8'");
	
	$sql = "INSERT INTO formato_tejidos_de_animales_vertebrados (lider,lider_paterno,lider_materno,proyecto,tejido_tipo,tejido_de,tejido_institucion,supervisor_verifico,supervisor_certifico,
			supervisor,fecha_supervisor,titulo_supervisor,Institucion_supervisor,telefono_supervisor,email_supervisor,status,fecha_registro)";
	
	$sql .= " VALUES ('$lider','$lider_paterno','$lider_paterno','$proyecto','$tejido_tipo','$tejido_de','$tejido_institucion','$supervisor_verifico','$supervisor_certifico','$supervisor',
			  '$fecha_supervisor','$titulo_supervisor','$Institucion_supervisor','$telefono_supervisor','$email_supervisor',1,now())";
			
	$sql = " UPDATE formato_investigacion_con_humanos SET lider = '$lider',lider_paterno = '$lider_paterno',lider_materno = '$lider_materno',proyecto = '$proyecto',
				 tejido_tipo = '$tejido_tipo',tejido_de = '$tejido_de',tejido_institucion = '$tejido_institucion', 
				 supervisor_verifico = '$supervisor_verifico',supervisor_certifico = '$supervisor_certifico',supervisor_certifico = '$supervisor_certifico',
				 supervisor = '$supervisor',fecha_supervisor = '$fecha_supervisor',titulo_supervisor = '$titulo_supervisor',
				 Institucion_supervisor = '$Institucion_supervisor',telefono_supervisor = '$telefono_supervisor',email_supervisor = '$email_supervisor',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	//echo $sql;
	
	mysql_query($sql);
	
	exit; 

?>