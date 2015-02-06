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
	$titulo_actual = mysql_real_escape_string(trim(@$_POST['titulo_actual']));
	$titulo_anterior = mysql_real_escape_string(trim(@$_POST['titulo_anterior']));
	$titulo_anterior2 = mysql_real_escape_string(trim(@$_POST['titulo_anterior2']));
	$objetivos_actual = mysql_real_escape_string(trim(@$_POST['objetivos_actual']));
	$objetivos_anterior = mysql_real_escape_string(trim(@$_POST['objetivos_anterior']));
	$objetivos_anterior2 = mysql_real_escape_string(trim(@$_POST['objetivos_anterior2']));
	$variables_actual = mysql_real_escape_string(trim(@$_POST['variables_actual']));
	$variables_anterior = mysql_real_escape_string(trim(@$_POST['variables_anterior']));
	$variables_anterior2 = mysql_real_escape_string(trim(@$_POST['variables_anterior2']));
	$investigacion_actual = mysql_real_escape_string(trim(@$_POST['investigacion_actual']));
	$investigacion_anterior = mysql_real_escape_string(trim(@$_POST['investigacion_anterior']));
	$investigacion_anterior2 = mysql_real_escape_string(trim(@$_POST['investigacion_anterior2']));
	$cambios_actual = mysql_real_escape_string(trim(@$_POST['cambios_actual']));
	$cambios_anterior = mysql_real_escape_string(trim(@$_POST['cambios_anterior']));
	$cambios_anterior2 = mysql_real_escape_string(trim(@$_POST['cambios_anterior2']));
	$lider_informacion = mysql_real_escape_string(trim(@$_POST['lider_informacion']));
	$fecha_informacion = mysql_real_escape_string(trim(@$_POST['fecha_informacion']));
	
	if(strlen($lider)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	
	mysql_query("SET NAMES 'utf8'");
		
	$sql = "INSERT INTO formato_proyecto_en_continuidad (lider,lider_paterno,lider_materno,proyecto,titulo_actual,titulo_anterior,titulo_anterior2,objetivos_actual,variables_anterior,variables_anterior2,
			investigacion_actual,investigacion_anterior,investigacion_anterior2,cambios_actual,cambios_anterior,cambios_anterior2,lider_informacion,fecha_informacion,
			status,fecha_registro)";
	
	$sql .= " VALUES ('$lider','$lider_paterno','$lider_materno','$proyecto','$titulo_actual','$titulo_anterior','$titulo_anterior2','$objetivos_actual','$objetivos_anterior','$objetivos_anterior2','$variables_actual',
			  '$variables_anterior','$variables_anterior2','$investigacion_actual','$investigacion_anterior','$investigacion_anterior2','$lider_informacion','$fecha_informacion',1,now())";
			
	$sql = " UPDATE formato_investigacion_con_humanos SET lider = '$lider',lider_paterno = '$lider_paterno',lider_materno = '$lider_materno',proyecto = '$proyecto',
				 titulo_actual = '$titulo_actual',titulo_anterior = '$titulo_anterior',titulo_anterior2 = '$titulo_anterior2', 
				 objetivos_actual = '$objetivos_actual',objetivos_anterior = '$objetivos_anterior',objetivos_anterior2 = '$objetivos_anterior2',
				 variables_actual = '$variables_actual',variables_anterior = '$variables_anterior',variables_anterior2 = '$variables_anterior2',
				 investigacion_actual = '$investigacion_actual',investigacion_anterior = '$investigacion_anterior',investigacion_anterior2 = '$investigacion_anterior2',
				 cambios_actual = '$cambios_actual',cambios_anterior = '$cambios_anterior',cambios_anterior2 = '$cambios_anterior2',
				 lider_informacion = '$lider_informacion',fecha_informacion = '$fecha_informacion',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	
	
	
	mysql_query($sql);
	
	
	exit; 

?>