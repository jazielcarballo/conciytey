<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit();
	
	
	$nombre = mysql_real_escape_string(trim(@$_POST['nombre']));
	$paterno = mysql_real_escape_string(trim(@$_POST['paterno']));
	$materno = mysql_real_escape_string(trim(@$_POST['materno']));
	$grado = mysql_real_escape_string(trim(@$_POST['grado']));
	$email = mysql_real_escape_string(trim(@$_POST['email']));
	$telefono = mysql_real_escape_string(trim(@$_POST['telefono']));
	$segundo_nombre = mysql_real_escape_string(trim(@$_POST['segundo_nombre']));
	$segundo_paterno = mysql_real_escape_string(trim(@$_POST['segundo_paterno']));
	$segundo_materno = mysql_real_escape_string(trim(@$_POST['segundo_materno']));
	$segundo_grado = mysql_real_escape_string(trim(@$_POST['segundo_grado']));
	$segundo_email = mysql_real_escape_string(trim(@$_POST['segundo_email']));
	$segundo_telefono = mysql_real_escape_string(trim(@$_POST['segundo_telefono']));
	$tercero_nombre = mysql_real_escape_string(trim(@$_POST['tercero_nombre']));
	$tercero_paterno = mysql_real_escape_string(trim(@$_POST['tercero_paterno']));
	$tercero_materno = mysql_real_escape_string(trim(@$_POST['tercero_materno']));
	$tercero_grado = mysql_real_escape_string(trim(@$_POST['tercero_grado']));
	$tercero_email = mysql_real_escape_string(trim(@$_POST['tercero_email']));
	$tercero_telefono = mysql_real_escape_string(trim(@$_POST['tercero_telefono']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$escuela = mysql_real_escape_string(trim(@$_POST['escuela']));
	$escuela_direccion = mysql_real_escape_string(trim(@$_POST['escuela_direccion']));
	$escuela_telefono = mysql_real_escape_string(trim(@$_POST['escuela_telefono']));
	$mentor = mysql_real_escape_string(trim(@$_POST['mentor']));
	$mentor_paterno = mysql_real_escape_string(trim(@$_POST['mentor_paterno']));
	$mentor_materno = mysql_real_escape_string(trim(@$_POST['mentor_materno']));
	$mentor_email = mysql_real_escape_string(trim(@$_POST['mentor_email']));
	$continuacion_opciones = mysql_real_escape_string(trim(@$_POST['continuacion_opciones']));
	$continuacion_si_formato = @$_POST['continuacion_si_formato'];
	$fecha_inicio = mysql_real_escape_string(trim(@$_POST['fecha_inicio']));
	$fecha_fin = mysql_real_escape_string(trim(@$_POST['fecha_fin']));
	$lugar_opciones = @$_POST['lugar_opciones'];
	$lugar_otro = mysql_real_escape_string(trim(@$_POST['lugar_otro']));
	$anterior_nombre = mysql_real_escape_string(trim(@$_POST['anterior_nombre']));
	$anterior_direccion = mysql_real_escape_string(trim(@$_POST['anterior_direccion']));
	$anterior_telefono = mysql_real_escape_string(trim(@$_POST['anterior_telefono']));

	/*
	if(strlen($nombre)==0 OR strlen($grado)==0 OR strlen($email)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	*/
	
	$str_continuacion_si = (is_array($continuacion_si_formato)) ? implode(',',$continuacion_si_formato) : '';
	$str_lugar = (is_array($lugar_opciones)) ? implode(',',$lugar_opciones) : '';
	
	$nombre_archivo = 'NULL';
	
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	
	for($y=0;$y<12;$y++) { 
		@$cad .= substr($str,rand(0,62),1); 
	} 
	
	$tamano = $_FILES["file_plan"][ 'size' ];
	if($tamano>0){
		$tamaño_max="50000000000";
		if( $tamano < $tamaño_max){  
			$destino = '../archivos/revision-estudiante/' ;
			$sep=explode('application/',$_FILES["file_plan"]["type"]);
			
			if(count($sep) == 0){ 
				$sep=explode('image/',$_FILES["file_plan"]["type"]); 
				$tipo = str_replace("x-png", "png", $tipo);
				$tipo = str_replace("pjpeg", "jpeg", $tipo);
			}
			
			$tipo=$sep[1];
			
			
			if($tipo == "jpg" || $tipo == "jpeg" || $tipo == "png" || $tipo == "x-png" | $tipo == "pjpeg"  || $tipo == "pdf"  || $tipo == "msword"  || $tipo == "vnd.openxmlformats-officedocument.wordprocessingml.document"){ 
				move_uploaded_file ( $_FILES["file_plan"][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);
				$nombre_archivo = "'".$cad.'.'.$tipo."'";						
			} 
		} 
	}
	
	mysql_query("SET NAMES 'utf8'");
	
	
	$terminado = (strlen(@$_POST['guardar']) > 0) ? 0 : 1;
	
	$sql = "SELECT * FROM formato1a_individual WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
		$sql = " UPDATE formato1a_individual SET lider = '$nombre',paterno = '$paterno', materno = '$materno',grado = '$grado',email = '$email',telefono = '$telefono',segundo_nombre = '$segundo_nombre',
			 segundo_grado = '$segundo_grado',segundo_email = '$segundo_email',segundo_telefono = '$segundo_telefono',tercero_nombre = '$tercero_nombre',tercero_grado = '$tercero_grado',
			 tercero_email = '$tercero_email',tercero_telefono = '$tercero_telefono',proyecto = '$proyecto',escuela = '$escuela',escuela_direccion = '$escuela_direccion',escuela_telefono = '$escuela_telefono',
			 mentor = '$mentor',mentor_email = '$mentor_email',continuacion = '$continuacion_opciones',continuacion_si = '$str_continuacion_si',fecha_inicio = '$fecha_inicio',
			 fecha_fin = '$fecha_fin',lugar = '$str_lugar',lugar_otro = '$lugar_otro',anterior_nombre = '$anterior_nombre',anterior_direccion = '$anterior_direccion',anterior_telefono = '$anterior_telefono',
			 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
		
	}else{
		
		$sql = "INSERT INTO formato1a_individual (lider,participante_id,paterno,materno,grado,email,telefono,segundo_nombre,segundo_grado,segundo_email,segundo_telefono,tercero_nombre,tercero_grado,";
		$sql .= " tercero_email,tercero_telefono,proyecto,escuela,escuela_direccion,escuela_telefono,mentor,mentor_email,continuacion,continuacion_si,fecha_inicio,";
		$sql .= " fecha_fin,lugar,lugar_otro,anterior_nombre,anterior_direccion,anterior_telefono,archivo,terminado,status,fecha_registro)";
		$sql .= " VALUES ('$nombre','".$_SESSION['fenaci']["id_usuario"]."','$paterno','$materno','$grado','$email','$telefono','$segundo_nombre','$segundo_grado','$segundo_email','$segundo_telefono','$tercero_nombre','$tercero_grado',
				 '$tercero_email','$tercero_telefono','$proyecto','$escuela','$escuela_direccion','$escuela_telefono','$mentor','$mentor_email','$continuacion_opciones',
				 '$str_continuacion_si','$fecha_inicio','$fecha_fin','$str_lugar','$lugar_otro','$anterior_nombre','$anterior_direccion','$anterior_telefono',$nombre_archivo,'$terminado',1,now())";
		
	$sql = " UPDATE formato_investigacion_con_humanos SET nombre = '$nombre',paterno = '$paterno',materno = '$materno',grado = '$grado',
				 email = '$email',telefono = '$telefono',
				 segundo_nombre = '$segundo_nombre', segundo_paterno = '$segundo_paterno',segundo_materno = '$segundo_materno',
				 segundo_grado = '$segundo_grado',segundo_email = '$segundo_email',segundo_telefono = '$segundo_telefono',
				 tercero_nombre = '$tercero_nombre', tercero_paterno = '$tercero_paterno',tercero_materno = '$tercero_materno',
				 tercero_grado = '$tercero_grado',tercero_email = '$tercero_email',tercero_telefono = '$tercero_telefono',
				 proyecto = '$proyecto',escuela = '$escuela',escuela_direccion = '$escuela_direccion',escuela_telefono = '$escuela_telefono',
				 mentor = '$mentor',mentor_paterno = '$mentor_paterno',mentor_materno = '$mentor_materno',mentor_email = '$mentor_email',
				 continuacion_opciones = '$continuacion_opciones',continuacion_si_formato = '$continuacion_si_formato',
				 fecha_inicio = '$fecha_inicio',fecha_fin = '$fecha_fin',lugar_opciones = '$lugar_opciones',lugar_otro = '$lugar_otro',
				 anterior_nombre = '$anterior_nombre',anterior_direccion = '$anterior_direccion',anterior_telefono = '$anterior_telefono'
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	
	
	
	}
	
	
	echo $sql;
	exit();
	
	if(!mysql_query($sql)){	
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");';
		echo "window.location='../revision-estudiante.php';</script>";
		exit;
	}

	
	if(strlen(@$_POST['guardar']) > 0){
		echo '<script>alert("Gracias por enviarnos tus datos.");';
		echo "window.history.back();</script>";	
		exit; 
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.");';
		echo "window.location='../registro-ok.php';</script>";
	}
	
	exit; 

?>