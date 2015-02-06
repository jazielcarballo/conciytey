<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	//require_once('PhpMailer/class.phpmailer.php');	
	
//	echo '<pre>';
//	print_r($_POST['formato_todos']);
//	echo '</pre>';
//	exit();
	
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$clave = mysql_real_escape_string(trim(@$_POST['clave']));
	$estudiante1 = mysql_real_escape_string(trim(@$_POST['estudiante1']));
	$estudiante1_paterno = mysql_real_escape_string(trim(@$_POST['estudiante1_paterno']));
	$estudiante1_materno = mysql_real_escape_string(trim(@$_POST['estudiante1_materno']));
	$fecha_nacimiento1 = mysql_real_escape_string(trim(@$_POST['fecha_nacimiento1']));
	$estudiante2 = mysql_real_escape_string(trim(@$_POST['estudiante2']));
	$estudiante2_paterno = mysql_real_escape_string(trim(@$_POST['estudiante2_paterno']));
	$estudiante2_materno = mysql_real_escape_string(trim(@$_POST['estudiante2_materno']));
	$fecha_nacimiento2 = mysql_real_escape_string(trim(@$_POST['fecha_nacimiento2']));
	$estudiante3 = mysql_real_escape_string(trim(@$_POST['estudiante3']));
	$estudiante3_paterno = mysql_real_escape_string(trim(@$_POST['estudiante3_paterno']));
	$estudiante3_materno = mysql_real_escape_string(trim(@$_POST['estudiante3_materno']));
	$fecha_nacimiento3 = mysql_real_escape_string(trim(@$_POST['fecha_nacimiento3']));
	$institucion = mysql_real_escape_string(trim(@$_POST['institucion']));
	$grado = mysql_real_escape_string(trim(@$_POST['grado']));
	$localidad = mysql_real_escape_string(trim(@$_POST['localidad']));
	$estado_id = mysql_real_escape_string(trim(@$_POST['estado_id']));
	$email = mysql_real_escape_string(trim(@$_POST['email']));
	$asesor = mysql_real_escape_string(trim(@$_POST['asesor']));
	$asesor_paterno = mysql_real_escape_string(trim(@$_POST['asesor_paterno']));
	$asesor_materno = mysql_real_escape_string(trim(@$_POST['asesor_materno']));
	$fecha_nacimiento_asesor = mysql_real_escape_string(trim(@$_POST['fecha_nacimiento_asesor']));
	$area = mysql_real_escape_string(trim(@$_POST['area']));
	$resumen = mysql_real_escape_string(trim(@$_POST['resumen']));
	$se_usara = @$_POST['se_usara'];
	$independiente = mysql_real_escape_string(trim(@$_POST['independiente']));
	$pertenece_instituto = mysql_real_escape_string(trim(@$_POST['pertenece_instituto']));
	$continuacion = mysql_real_escape_string(trim(@$_POST['continuacion']));
	$lider = mysql_real_escape_string(trim(@$_POST['lider']));
	$lider_paterno = mysql_real_escape_string(trim(@$_POST['lider_paterno']));
	$lider_materno = mysql_real_escape_string(trim(@$_POST['lider_materno']));
	$fecha_lider = mysql_real_escape_string(trim(@$_POST['fecha_lider']));


	/*
	if(strlen($nombre)==0 OR strlen($titulo)==0 OR strlen($reglas_protocolo)==0 OR strlen($lista_revision)==0 OR strlen($riesgos)==0 OR (!is_array($formatos_todos)))
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	*/
	
	
	$str_se_usara = (is_array($se_usara)) ? implode($se_usara) : '';
	
	
	$fecha_nacimiento1 = (strlen($fecha_nacimiento1) == 0) ? 'NULL' : "'".$fecha_nacimiento1."'";
	$fecha_nacimiento2 = (strlen($fecha_nacimiento2) == 0) ? 'NULL' : "'".$fecha_nacimiento2."'";
	$fecha_nacimiento3 = (strlen($fecha_nacimiento3) == 0) ? 'NULL' : "'".$fecha_nacimiento3."'";
	$fecha_nacimiento_asesor = (strlen($fecha_nacimiento_asesor) == 0) ? 'NULL' : "'".$fecha_nacimiento_asesor."'";
	$fecha_lider = (strlen($fecha_lider) == 0) ? 'NULL' : "'".$fecha_lider."'";
	
	
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
			$destino = '../archivos/formato-fipi/' ;
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
	
	$estado_id = (strlen($estado_id) > 0) ? $estado_id : 'NULL';
	
	/**/
	mysql_query("SET NAMES 'utf8'");
	
	$terminado = (strlen(@$_POST['guardar']) > 0) ? 0 : 1;
	
	$sql = "SELECT * FROM formato_fipi WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql) or die (mysql_error());
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
		$sql = " UPDATE formato_fipi SET clave = '$clave',proyecto = '$proyecto', estudiante1 = '$estudiante1',
				 estudiante1_paterno = '$estudiante1_paterno',estudiante1_materno = '$estudiante1_materno', fecha_nacimiento1 = $fecha_nacimiento1,
				 estudiante2 = '$estudiante2',estudiante2_paterno = '$estudiante2_paterno', estudiante2_materno = '$estudiante2_materno', fecha_nacimiento2 = $fecha_nacimiento2,
				 estudiante3 = '$estudiante3',estudiante3_paterno = '$estudiante3_paterno', estudiante3_materno = '$estudiante3_materno', fecha_nacimiento3 = $fecha_nacimiento3,
				 institucion = '$institucion',grado = '$grado', localidad = '$localidad', estado_id = $estado_id, email = '$email',
				 asesor = '$asesor',asesor_paterno = '$asesor_paterno', asesor_materno = '$asesor_materno', fecha_nacimiento_asesor = $fecha_nacimiento_asesor,
				 area = '$area',resumen = '$resumen', se_usara = '$str_se_usara', independiente = '$independiente', pertenece_instituto = '$pertenece_instituto',
				 continuacion = '$continuacion',fecha_lider = $fecha_lider,lider = '$lider',lider_paterno = '$lider_paterno', lider_materno = '$lider_materno',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
		
	}else{
	
		
		$sql = "INSERT INTO formato_fipi (participante_id,clave,proyecto,estudiante1,estudiante1_paterno,estudiante1_materno,fecha_nacimiento1,estudiante2,estudiante2_paterno,estudiante2_materno,
				fecha_nacimiento2,estudiante3,estudiante3_paterno,estudiante3_materno,fecha_nacimiento3,institucion,grado,localidad,estado_id,email,asesor,asesor_paterno,asesor_materno,fecha_nacimiento_asesor,
				area,resumen,se_usara,independiente,pertenece_instituto,continuacion,fecha_lider,lider,lider_paterno,lider_materno,archivo,terminado,status,fecha_registro)";
				
		$sql .= " VALUES ('".$_SESSION['fenaci']["id_usuario"]."','$clave','$proyecto','$estudiante1','$estudiante1_paterno','$estudiante1_materno',$fecha_nacimiento1,
				 '$estudiante2','$estudiante2_paterno','$estudiante2_materno',$fecha_nacimiento2,'$estudiante3','$estudiante3_paterno','$estudiante3_materno',$fecha_nacimiento3,
				 '$institucion','$grado','$localidad',$estado_id,'$email','$asesor','$asesor_paterno','$asesor_materno',$fecha_nacimiento_asesor,'$area','$resumen','$str_se_usara',
				 '$independiente','$pertenece_instituto','$continuacion',$fecha_lider,'$lider','$lider_paterno','$lider_materno',$nombre_archivo,'$terminado',1,now())";
		
	
	}
	
	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../formato-fipi.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../formato-fipi.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit; 

?>