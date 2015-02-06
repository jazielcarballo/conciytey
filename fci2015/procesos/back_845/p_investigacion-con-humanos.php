<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit();
	
	$lider = mysql_real_escape_string(trim(@$_POST['nombre']));
	$lider_paterno = mysql_real_escape_string(trim(@$_POST['lider_paterno']));
	$lider_materno = mysql_real_escape_string(trim(@$_POST['lider_materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$proposito = mysql_real_escape_string(trim(@$_POST['proposito']));
	$riesgos = mysql_real_escape_string(trim(@$_POST['riesgos']));
	$procedimientos = mysql_real_escape_string(trim(@$_POST['procedimientos']));
	$contacto_estudiante = mysql_real_escape_string(trim(@$_POST['contacto_estudiante']));
	$contacto_estudiante_paterno = mysql_real_escape_string(trim(@$_POST['contacto_estudiante_paterno']));
	$contacto_estudiante_materno = mysql_real_escape_string(trim(@$_POST['contacto_estudiante_materno']));
	$contacto_mentor = mysql_real_escape_string(trim(@$_POST['contacto_mentor']));
	$nivel_riesgo = mysql_real_escape_string(trim(@$_POST['nivel_riesgo']));
	$medico = mysql_real_escape_string(trim(@$_POST['medico']));
	$fecha_medico = mysql_real_escape_string(trim(@$_POST['fecha_medico']));
	$profesor = mysql_real_escape_string(trim(@$_POST['profesor']));
	$fecha_profesor = mysql_real_escape_string(trim(@$_POST['fecha_profesor']));
	$administrador = mysql_real_escape_string(trim(@$_POST['administrador']));
	$fecha_administrador = mysql_real_escape_string(trim(@$_POST['fecha_administrador']));
	$condiciones_humano = mysql_real_escape_string(trim(@$_POST['condiciones_humano']));
	$libre_humano = mysql_real_escape_string(trim(@$_POST['libre_humano']));
	$imagenes_humano = mysql_real_escape_string(trim(@$_POST['imagenes_humano']));
	$nombre_humano = mysql_real_escape_string(trim(@$_POST['nombre_humano']));
	$nombre_humano_paterno = mysql_real_escape_string(trim(@$_POST['nombre_humano_paterno']));
	$nombre_humano_materno = mysql_real_escape_string(trim(@$_POST['nombre_humano_materno']));
	$fecha_humano = mysql_real_escape_string(trim(@$_POST['fecha_humano']));
	$condiciones_padre = mysql_real_escape_string(trim(@$_POST['condiciones_padre']));
	$cuestionarios_padre = mysql_real_escape_string(trim(@$_POST['cuestionarios_padre']));
	$imagenes_padre = mysql_real_escape_string(trim(@$_POST['imagenes_padre']));
	$nombre_padre = mysql_real_escape_string(trim(@$_POST['nombre_padre']));
	$nombre_padre_paterno = mysql_real_escape_string(trim(@$_POST['nombre_padre_paterno']));
	$nombre_padre_materno = mysql_real_escape_string(trim(@$_POST['nombre_padre_materno']));
	$fecha_padre = mysql_real_escape_string(trim(@$_POST['fecha_padre']));
	
	if(strlen($condiciones_humano) == 0) $condiciones_humano= 0;
	if(strlen($libre_humano) == 0) $libre_humano= 0;
	if(strlen($imagenes_humano) == 0) $imagenes_humano= 0;
	
	if(strlen($condiciones_padre) == 0) $condiciones_padre= 0;
	if(strlen($cuestionarios_padre) == 0) $cuestionarios_padre= 0;
	if(strlen($imagenes_padre) == 0) $imagenes_padre= 0;
	

	if(strlen($lider)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	
	mysql_query("SET NAMES 'utf8'");
		
	$sql = "INSERT INTO formato_investigacion_con_humanos (lider,lider_paterno,lider_materno,proyecto,proposito,riesgos,procedimientos,contacto_estudiante,contacto_mentor,nivel_riesgo,
			medico,fecha_medico,profesor,fecha_profesor,administrador,fecha_administrador,condiciones_humano,libre_humano,imagenes_humano,nombre_humano,nombre_humano_paterno,nombre_humano_materno
			fecha_humano,condiciones_padre,cuestionarios_padre,imagenes_padre,nombre_padre,nombre_padre_paterno,nombre_padre_materno,fecha_padre,status,fecha_registro)";
	
	$sql .= " VALUES ('$lider','$lider_paterno','$lider_materno','$proyecto','$proposito','$riesgos','$procedimientos','$contacto_estudiante','$contacto_mentor','$nivel_riesgo','$medico',
	'$fecha_medico','$profesor','$fecha_profesor','$administrador','$fecha_administrador','$condiciones_humano','$libre_humano','$imagenes_humano'
	,'$nombre_humano','$nombre_humano_paterno','$nombre_humano_materno','$fecha_humano','$condiciones_padre','$cuestionarios_padre','$imagenes_padre','$nombre_padre','$nombre_padre_paterno','$nombre_padre_materno','$fecha_padre',1,now())";
	
	$sql = " UPDATE formato_investigacion_con_humanos SET lider = '$lider',lider_paterno = '$lider_paterno',lider_materno = '$lider_materno',proyecto = '$proyecto',
				 proposito = '$proposito',riesgos = '$riesgos',procedimientos = '$procedimientos', contacto_estudiante = '$contacto_estudiante',
				 contacto_estudiante_paterno = '$contacto_estudiante_paterno',contacto_estudiante_materno = '$contacto_estudiante_materno',
				 contacto_mentor = '$contacto_mentor',nivel_riesgo = '$nivel_riesgo',medico = '$medico',fecha_medico = '$fecha_medico'
				 profesor = '$profesor',fecha_profesor = '$fecha_profesor',administrador = '$administrador',fecha_administrador = '$fecha_administrador',
				 condiciones_humano = '$condiciones_humano',libre_humano = '$libre_humano',imagenes_humano = '$imagenes_humano',
				 nombre_humano = '$nombre_humano',nombre_humano_paterno = '$nombre_humano_paterno',nombre_humano_materno = '$nombre_humano_materno',
				 fecha_humano = '$fecha_humano',condiciones_padre = '$condiciones_padre',cuestionarios_padre = '$cuestionarios_padre',
				 imagenes_padre = '$imagenes_padre',nombre_padre = '$nombre_padre',
				 nombre_padre_paterno = '$nombre_padre_paterno',nombre_padre_materno = '$nombre_padre_materno',fecha_padre = '$fecha_padre',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	
	mysql_query($sql) or die(mysql_error());
	
	exit; 

?>