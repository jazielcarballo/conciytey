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
			$destino = '../archivos/proyecto-en-continuidad/' ;
			$sep=explode('application/',$_FILES["file_formato"]["type"]);
			
			if(count($sep) == 0){ 
				$sep=explode('image/',$_FILES["file_formato"]["type"]); 
				$tipo = str_replace("x-png", "png", $tipo);
				$tipo = str_replace("pjpeg", "jpeg", $tipo);
			}
			
			$tipo=$sep[1];
			
			
			if($tipo == "jpg" || $tipo == "jpeg" || $tipo == "png" || $tipo == "x-png" | $tipo == "pjpeg"  || $tipo == "pdf"  || $tipo == "msword"  || $tipo == "vnd.openxmlformats-officedocument.wordprocessingml.document"){ 
				if($tipo == 'msword') $tipo = 'doc';
				if($tipo == 'vnd.openxmlformats-officedocument.wordprocessingml.document') $tipo = 'docx';
				
				move_uploaded_file ( $_FILES["file_formato"][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);
				$nombre_archivo = "'".$cad.'.'.$tipo."'";						
			} 
		} 
	}
	
	/**/
	mysql_query("SET NAMES 'utf8'");
	
	$terminado = (strlen(@$_POST['guardar']) > 0) ? 0 : 1;
	
	$sql = "SELECT * FROM formato_proyecto_en_continuidad WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
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
	
	}
	
	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../proyecto-en-continuidad.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../proyecto-en-continuidad.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit; 

?>