<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	$lider = mysql_real_escape_string(trim(@$_POST['lider']));
	$lider_paterno = mysql_real_escape_string(trim(@$_POST['lider_paterno']));
	$lider_materno = mysql_real_escape_string(trim(@$_POST['lider_materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$tejido_tipo = mysql_real_escape_string(trim(@$_POST['tejido_tipo']));
	$tejido_de = mysql_real_escape_string(trim(@$_POST['tejido_de']));
	$tejido_institucion = mysql_real_escape_string(trim(@$_POST['tejido_institucion']));
	$supervisor_verifico = mysql_real_escape_string(trim(@$_POST['supervisor_verifico']));
	$supervisor_certifico = mysql_real_escape_string(trim(@$_POST['supervisor_certifico']));
	$supervisor = mysql_real_escape_string(trim(@$_POST['supervisor']));
	$supervisor_paterno = mysql_real_escape_string(trim(@$_POST['supervisor_paterno']));
	$supervisor_materno = mysql_real_escape_string(trim(@$_POST['supervisor_materno']));
	$fecha_supervisor = mysql_real_escape_string(trim(@$_POST['fecha_supervisor']));
	$titulo_supervisor = mysql_real_escape_string(trim(@$_POST['titulo_supervisor']));
	$institucion_supervisor = mysql_real_escape_string(trim(@$_POST['institucion_supervisor']));
	$telefono_supervisor = mysql_real_escape_string(trim(@$_POST['telefono_supervisor']));
	$email_supervisor = mysql_real_escape_string(trim(@$_POST['email_supervisor']));
	
	if(strlen($supervisor_verifico) == 0) $supervisor_verifico= 0;
	if(strlen($supervisor_certifico) == 0) $supervisor_certifico= 0;
	
	
	
	$fecha_supervisor = (strlen($fecha_supervisor) == 0) ? 'NULL' : "'".$fecha_supervisor."'";
		
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
			$destino = '../archivos/tejidos-de-animales-vertebrados/' ;
			$sep=explode('application/',$_FILES["file_formato"]["type"]);
			
			if(count($sep) < 2){ 
				$sep=explode('image/',$_FILES["file_formato"]["type"]); 
				$tipo = str_replace("x-png", "png", $tipo);
				$tipo = str_replace("pjpeg", "jpeg", $tipo);
			}
			
			if(count($sep) >= 2){
			
				$tipo=$sep[1];
				
				
				if($tipo == "jpg" || $tipo == "jpeg" || $tipo == "png" || $tipo == "x-png" | $tipo == "pjpeg"  || $tipo == "pdf"  || $tipo == "msword"  || $tipo == "vnd.openxmlformats-officedocument.wordprocessingml.document"){ 
					if($tipo == 'msword') $tipo == 'doc';
					if($tipo == 'vnd.openxmlformats-officedocument.wordprocessingml.document') $tipo == 'docx';
					
					move_uploaded_file ( $_FILES["file_formato"][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);
					$nombre_archivo = "'".$cad.'.'.$tipo."'";						
				} 
			}
		} 
	}
	
	
	mysql_query("SET NAMES 'utf8'");
	
	$terminado = (strlen(@$_POST['guardar']) > 0) ? 0 : 1;
	
	$sql = "SELECT * FROM formato_tejidos_de_animales_vertebrados WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
		$sql = " UPDATE formato_tejidos_de_animales_vertebrados SET lider = '$lider',lider_paterno = '$lider_paterno',lider_materno = '$lider_materno',proyecto = '$proyecto',
				 tejido_tipo = '$tejido_tipo',tejido_de = '$tejido_de',tejido_institucion = '$tejido_institucion', 
				 supervisor_verifico = '$supervisor_verifico',supervisor_certifico = '$supervisor_certifico',
				 supervisor = '$supervisor',supervisor_paterno = '$supervisor_paterno',supervisor_materno = '$supervisor_materno',fecha_supervisor = $fecha_supervisor,titulo_supervisor = '$titulo_supervisor',
				 Institucion_supervisor = '$institucion_supervisor',telefono_supervisor = '$telefono_supervisor',email_supervisor = '$email_supervisor',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
		
	}else{
	
		$sql = "INSERT INTO formato_tejidos_de_animales_vertebrados (participante_id,lider,lider_paterno,lider_materno,proyecto,tejido_tipo,tejido_de,tejido_institucion,supervisor_verifico,supervisor_certifico,
				supervisor,supervisor_paterno,supervisor_materno,fecha_supervisor,titulo_supervisor,institucion_supervisor,telefono_supervisor,email_supervisor,archivo,terminado,status,fecha_registro)";
		
		$sql .= " VALUES ('".$_SESSION['fenaci']["id_usuario"]."','$lider','$lider_paterno','$lider_materno','$proyecto','$tejido_tipo','$tejido_de','$tejido_institucion','$supervisor_verifico','$supervisor_certifico','$supervisor',
				  '$supervisor_paterno','$supervisor_materno',$fecha_supervisor,'$titulo_supervisor','$institucion_supervisor','$telefono_supervisor','$email_supervisor',$nombre_archivo,'$terminado',1,now())";
			
	
	
	}
	
	//echo $sql;
	//exit();
	
	
	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../tejidos-de-animales-vertebrados.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../tejidos-de-animales-vertebrados.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit; 

?>