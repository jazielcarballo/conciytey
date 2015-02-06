<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit();
	
	$lider = mysql_real_escape_string(trim(@$_POST['nombre']));
	$lider_paterno = mysql_real_escape_string(trim(@$_POST['paterno']));
	$lider_materno = mysql_real_escape_string(trim(@$_POST['materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$actividad_centro = mysql_real_escape_string(trim(@$_POST['actividad_centro']));
	$idea = mysql_real_escape_string(trim(@$_POST['idea']));
	$reglas = mysql_real_escape_string(trim(@$_POST['reglas']));
	$grupal = mysql_real_escape_string(trim(@$_POST['grupal']));
	$tipo_grupo = mysql_real_escape_string(trim(@$_POST['tipo_grupo']));
	$tipo_experimento = mysql_real_escape_string(trim(@$_POST['tipo_experimento']));
	$cientifico = mysql_real_escape_string(trim(@$_POST['cientifico']));
	$cientifico_paterno = mysql_real_escape_string(trim(@$_POST['cientifico_paterno']));
	$cientifico_materno = mysql_real_escape_string(trim(@$_POST['cientifico_materno']));
	$cargo = mysql_real_escape_string(trim(@$_POST['cargo']));
	$institucion = mysql_real_escape_string(trim(@$_POST['institucion']));
	$fecha = mysql_real_escape_string(trim(@$_POST['fecha']));
	$direccion = mysql_real_escape_string(trim(@$_POST['direccion']));
	$telefono = mysql_real_escape_string(trim(@$_POST['telefono']));
	$email = mysql_real_escape_string(trim(@$_POST['email']));
	
	if(strlen($lider)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	
	mysql_query("SET NAMES 'utf8'");
		
	$sql = "INSERT INTO formato1C (lider,lider_paterno,lider_materno,proyecto,actividad_centro,idea,reglas,grupal,tipo_grupo,tipo_experimento,cientifico,
			cargo,institucion,fecha,direccion,telefono,email,status,fecha_registro)";
	
	$sql .= " VALUES ('$lider','$lider_paterno','$lider_materno','$proyecto','$actividad_centro','$idea','$reglas','$grupal','$tipo_grupo','$tipo_experimento','$cientifico',
			'$cargo','$institucion','$fecha','$direccion','$telefono','$email',1,now())";
	
	$sql = " UPDATE formato1C SET lider = '$lider',lider_paterno = '$lider_paterno',lider_materno = '$lider_materno',
				 proyecto = '$proyecto',actividad_centro = '$actividad_centro',idea = '$idea',
				 reglas = '$reglas', grupal = '$grupal',tipo_grupo = '$tipo_grupo',tipo_experimento = '$tipo_experimento',
				 cientifico = '$cientifico',cargo = '$cargo',institucion = '$institucion',fecha = '$fecha'
				 direccion = '$direccion',telefono = '$telefono',email = '$email',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";


	mysql_query($sql) or die(mysql_error());
	
	

?>