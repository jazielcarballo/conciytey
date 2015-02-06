<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
//	echo '<pre>';
//	print_r($_POST);
//	echo '</pre>';
//	exit();
	
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
	
	/*
	if(strlen($lider)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	*/
	
	$fecha = (strlen($fecha) == 0) ? 'NULL' : "'".$fecha."'";
	
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
			$destino = '../archivos/formato-1c/' ;
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
	
	$sql = "SELECT * FROM formato1c WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
		$sql = " UPDATE formato1c SET lider = '$lider',lider_paterno = '$lider_paterno',lider_materno = '$lider_materno',
				 proyecto = '$proyecto',actividad_centro = '$actividad_centro',idea = '$idea',
				 reglas = '$reglas', grupal = '$grupal',tipo_grupo = '$tipo_grupo',tipo_experimento = '$tipo_experimento',
				 cientifico = '$cientifico',cientifico_paterno = '$cientifico_paterno',cientifico_materno = '$cientifico_materno',
				 cargo = '$cargo',institucion = '$institucion',fecha = $fecha,
				 direccion = '$direccion',telefono = '$telefono',email = '$email',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
		
	}else{
		
		$sql = "INSERT INTO formato1c (lider,participante_id,lider_paterno,lider_materno,proyecto,actividad_centro,idea,reglas,grupal,tipo_grupo,tipo_experimento,cientifico,
				cientifico_paterno,cientifico_materno,cargo,institucion,fecha,direccion,telefono,email,archivo,terminado,status,fecha_registro)";
		
		$sql .= " VALUES ('$lider','".$_SESSION['fenaci']["id_usuario"]."','$lider_paterno','$lider_materno','$proyecto','$actividad_centro','$idea','$reglas','$grupal','$tipo_grupo','$tipo_experimento','$cientifico',
				'$cientifico_paterno','$cientifico_materno','$cargo','$institucion',$fecha,'$direccion','$telefono','$email',$nombre_archivo,'$terminado',1,now())";
	}
		
	//echo $sql;
	//exit();
	
	//mysql_query($sql) or die(mysql_error());
	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../formato-1c.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../formato-1c.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

?>