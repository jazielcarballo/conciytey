<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
		
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

/*
	if(strlen($lider)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	*/
	
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
			$destino = '../archivos/cientifico-calificado/' ;
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
	
	$sql = "SELECT * FROM formato_cientifico_calificado WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
	
		$sql = " UPDATE formato_cientifico_calificado SET lider = '$lider',lider_paterno = '$paterno', lider_materno = '$materno',
					 proyecto = '$proyecto',maestrias = '$maestrias',doctorado = '$doctorado',puesto = '$puesto',
					 institucion = '$institucion',direccion = '$direccion',telefono = '$telefono',
					 email = '$email',enterado = '$enterado',humanos = '$humanos',vertebrados = '$vertebrados',
					 biologicos = '$biologicos',sustancias = '$sustancias',supervisar = '$supervisar',
					 designado = '$designado',designado_experiencia = '$designado_experiencia',precauciones = '$precauciones',
					 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
		

	}else{
		
		$sql = "INSERT INTO formato_cientifico_calificado (lider,participante_id,lider_paterno,lider_materno,proyecto,maestrias,doctorado,puesto,institucion,direccion,telefono,
				email,enterado,humanos,vertebrados,biologicos,sustancias,supervisar,designado,designado_experiencia,precauciones,archivo,terminado,status,fecha_registro)";
		
		$sql .= " VALUES ('$lider','".$_SESSION['fenaci']["id_usuario"]."','$paterno','$materno','$proyecto','$maestrias','$doctorado','$puesto','$institucion','$direccion','$telefono','$email',
				'$enterado','$humanos','$vertebrados','$biologicos','$sustancias','$supervisar','$designado','$designado_experiencia','$precauciones',$nombre_archivo,'$terminado',1,now())";
	
	}

	//echo $sql;
	//exit();

	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../cientifico-calificado.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../cientifico-calificado.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit;
	
	

?>