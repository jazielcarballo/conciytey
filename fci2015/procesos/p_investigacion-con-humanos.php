<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	$lider = mysql_real_escape_string(trim(@$_POST['nombre']));
	$lider_paterno = mysql_real_escape_string(trim(@$_POST['paterno']));
	$lider_materno = mysql_real_escape_string(trim(@$_POST['materno']));
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
	
	
	$fecha_medico = (strlen($fecha_medico) == 0) ? 'NULL' : "'".$fecha_medico."'";
	$fecha_profesor = (strlen($fecha_profesor) == 0) ? 'NULL' : "'".$fecha_profesor."'";
	$fecha_administrador = (strlen($fecha_administrador) == 0) ? 'NULL' : "'".$fecha_administrador."'";
	$fecha_humano = (strlen($fecha_humano) == 0) ? 'NULL' : "'".$fecha_humano."'";
	$fecha_padre = (strlen($fecha_padre) == 0) ? 'NULL' : "'".$fecha_padre."'";
	
	
/*
	if(strlen($lider)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}*/
	
/*sube archivo*/
	$nombre_archivo = 'NULL';
	
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	
	for($y=0;$y<12;$y++) { 
		@$cad .= substr($str,rand(0,62),1); 
	} 
	
	$tamano = $_FILES["file_formato"][ 'size' ];
	if($tamano>0){
		$tamaño_max="50000000000";
		if( $tamano < $tamaño_max){  
			$destino = '../archivos/investigacion-con-humanos/' ;
			$sep=explode('application/',$_FILES["file_formato"]["type"]);
			
			if(count($sep) < 2){ 
				$sep=explode('image/',$_FILES["file_formato"]["type"]); 
				$tipo = str_replace("x-png", "png", $tipo);
				$tipo = str_replace("pjpeg", "jpeg", $tipo);
			}
			
			if(count($sep) >= 2){
			
				$tipo=$sep[1];
				
				
				if($tipo == "jpg" || $tipo == "jpeg" || $tipo == "png" || $tipo == "x-png" | $tipo == "pjpeg"  || $tipo == "pdf"  || $tipo == "msword"  || $tipo == "vnd.openxmlformats-officedocument.wordprocessingml.document"){ 
					if($tipo == 'msword') $tipo = 'doc';
					if($tipo == 'vnd.openxmlformats-officedocument.wordprocessingml.document') $tipo = 'docx';
					
					move_uploaded_file ( $_FILES["file_formato"][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);
					$nombre_archivo = "'".$cad.'.'.$tipo."'";						
				} 
			}
		} 
	}
	
	/**/
	mysql_query("SET NAMES 'utf8'");
	
	$terminado = (strlen(@$_POST['guardar']) > 0) ? 0 : 1;
	
	$sql = "SELECT * FROM formato_investigacion_con_humanos WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
		$sql = " UPDATE formato_investigacion_con_humanos SET lider = '$lider',lider_paterno = '$lider_paterno',lider_materno = '$lider_materno',proyecto = '$proyecto',
				 proposito = '$proposito',riesgos = '$riesgos',procedimientos = '$procedimientos', contacto_estudiante = '$contacto_estudiante',
				 contacto_estudiante_paterno = '$contacto_estudiante_paterno',contacto_estudiante_materno = '$contacto_estudiante_materno',
				 contacto_mentor = '$contacto_mentor',nivel_riesgo = '$nivel_riesgo',medico = '$medico',fecha_medico = $fecha_medico,
				 profesor = '$profesor',fecha_profesor = $fecha_profesor,administrador = '$administrador',fecha_administrador = $fecha_administrador,
				 condiciones_humano = '$condiciones_humano',libre_humano = '$libre_humano',imagenes_humano = '$imagenes_humano',
				 nombre_humano = '$nombre_humano',nombre_humano_paterno = '$nombre_humano_paterno',nombre_humano_materno = '$nombre_humano_materno',
				 fecha_humano = $fecha_humano,condiciones_padre = '$condiciones_padre',cuestionarios_padre = '$cuestionarios_padre',
				 imagenes_padre = '$imagenes_padre',nombre_padre = '$nombre_padre',
				 nombre_padre_paterno = '$nombre_padre_paterno',nombre_padre_materno = '$nombre_padre_materno',fecha_padre = $fecha_padre,
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
		
	}else{
		
				$sql = "INSERT INTO formato_investigacion_con_humanos (lider,participante_id,lider_paterno,lider_materno,proyecto,proposito,riesgos,procedimientos,contacto_estudiante,contacto_estudiante_paterno,contacto_estudiante_materno,
				contacto_mentor,nivel_riesgo,
						medico,fecha_medico,profesor,fecha_profesor,administrador,fecha_administrador,condiciones_humano,libre_humano,imagenes_humano,nombre_humano,nombre_humano_paterno,nombre_humano_materno,
						fecha_humano,condiciones_padre,cuestionarios_padre,imagenes_padre,nombre_padre,nombre_padre_paterno,nombre_padre_materno,fecha_padre,archivo,terminado,status,fecha_registro)";
				
				$sql .= " VALUES ('$lider','".$_SESSION['fenaci']["id_usuario"]."','$lider_paterno','$lider_materno','$proyecto','$proposito','$riesgos','$procedimientos','$contacto_estudiante','$contacto_estudiante_paterno','$contacto_estudiante_materno',
				'$contacto_mentor','$nivel_riesgo','$medico',
				$fecha_medico,'$profesor',$fecha_profesor,'$administrador',$fecha_administrador,'$condiciones_humano','$libre_humano','$imagenes_humano',
				'$nombre_humano','$nombre_humano_paterno','$nombre_humano_materno',$fecha_humano,'$condiciones_padre','$cuestionarios_padre','$imagenes_padre','$nombre_padre','$nombre_padre_paterno','$nombre_padre_materno',$fecha_padre,$nombre_archivo,'$terminado',1,now())";
	
	
	}
	
	//echo $sql;
	//exit();
	
	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../investigacion-con-humanos.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../investigacion-con-humanos.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit; 

?>