<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit();
	
		
	$lider = mysql_real_escape_string(trim(@$_POST['nombre']));
	$paterno = mysql_real_escape_string(trim(@$_POST['paterno']));
	$materno = mysql_real_escape_string(trim(@$_POST['materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$maestrias = mysql_real_escape_string(trim(@$_POST['maestrias_txt']));
	$doctorado = mysql_real_escape_string(trim(@$_POST['doctorado_txt']));
	$puesto = mysql_real_escape_string(trim(@$_POST['puesto']));
	$institucion = mysql_real_escape_string(trim(@$_POST['institucion']));
	$direccion = mysql_real_escape_string(trim(@$_POST['direccion']));
	$telefono = mysql_real_escape_string(trim(@$_POST['telefono']));
	$email = mysql_real_escape_string(trim(@$_POST['email']));
	$enterado = mysql_real_escape_string(trim(@$_POST['enterado']));
	$humanos = mysql_real_escape_string(trim(@$_POST['humanos']));
	$vertebrados = mysql_real_escape_string(trim(@$_POST['vertebrados']));
	$biologicos = mysql_real_escape_string(trim(@$_POST['biologicos']));
	$sustancias = mysql_real_escape_string(trim(@$_POST['sustancias']));
	$supervisar = mysql_real_escape_string(trim(@$_POST['supervisar']));
	$designado = mysql_real_escape_string(trim(@$_POST['designado']));
	$designado_experiencia = mysql_real_escape_string(trim(@$_POST['designado_experiencia']));
	$precauciones = mysql_real_escape_string(trim(@$_POST['precauciones']));

	if(strlen($lider)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	
	mysql_query("SET NAMES 'utf8'");
		
	$sql = "INSERT INTO formato_cientifico_calificado (lider,paterno,materno,proyecto,maestrias,doctorado,puesto,institucion,direccion,telefono,
			email,enterado,humanos,vertebrados,biologicos,sustancias,supervisar,designado,designado_experiencia,precauciones,status,fecha_registro)";
	
	$sql .= " VALUES ('$lider','$lider_paterno','$lider_materno','$proyecto','$maestrias','$doctorado','$puesto','$institucion','$direccion','$telefono','$email',
			'$enterado','$humanos','$vertebrados','$biologicos','$sustancias','$supervisar','$designado','$designado_experiencia','$precauciones',1,now())";

	$sql = " UPDATE formato_cientifico_calificado SET lider = '$lider',paterno = '$paterno', materno = '$materno',
				 proyecto = '$proyecto',maestrias = '$maestrias',doctorado = '$doctorado',puesto = '$puesto',
				 institucion = '$institucion',direccion = '$direccion',telefono = '$telefono',
				 email = '$email',enterado = '$enterado',humanos = '$humanos',vertebrados = '$vertebrados',
				 biologicos = '$biologicos',sustancias = '$sustancias',supervisar = '$supervisar',
				 designado = '$designado',designado_experiencia = '$designado_experiencia',precauciones = '$precauciones',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";


	mysql_query($sql);
	
	

?>