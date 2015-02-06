<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	
	$expocientifico = mysql_real_escape_string(trim(@$_POST['expocientifico']));
	$expocientifico_paterno = mysql_real_escape_string(trim(@$_POST['expocientifico_paterno']));
	$expocientifico_materno = mysql_real_escape_string(trim(@$_POST['expocientifico_materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$quimicos = mysql_real_escape_string(trim(@$_POST['quimicos']));
	$riesgos = mysql_real_escape_string(trim(@$_POST['riesgos']));
	$seguridad = mysql_real_escape_string(trim(@$_POST['seguridad']));
	$procedimientos = mysql_real_escape_string(trim(@$_POST['procedimientos']));
	$fuentes = mysql_real_escape_string(trim(@$_POST['fuentes']));
	$supervisor = mysql_real_escape_string(trim(@$_POST['supervisor']));
	$supervisor_paterno = mysql_real_escape_string(trim(@$_POST['supervisor_paterno']));
	$supervisor_materno = mysql_real_escape_string(trim(@$_POST['supervisor_materno']));
	$puesto = mysql_real_escape_string(trim(@$_POST['puesto']));
	$telefono = mysql_real_escape_string(trim(@$_POST['telefono']));
	$email = mysql_real_escape_string(trim(@$_POST['email']));
	$fecha_compromiso = mysql_real_escape_string(trim(@$_POST['fecha_compromiso']));
	/*
	if(strlen($expocientifico)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	*/
	
	
	$fecha_compromiso = (strlen($fecha_compromiso) == 0) ? 'NULL' : "'".$fecha_compromiso."'";
	
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
			$destino = '../archivos/supervisor-acesoria/' ;
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
	
	$sql = "SELECT * FROM formato_supervisor_asesoria WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
		$sql = " UPDATE formato_supervisor_asesoria SET expocientifico = '$expocientifico',expocientifico_paterno = '$expocientifico_paterno',expocientifico_materno = '$expocientifico_materno',
				 proyecto = '$proyecto',quimicos = '$quimicos',riesgos = '$riesgos', 
				 seguridad = '$seguridad',procedimientos = '$procedimientos',fuentes = '$fuentes',
				 supervisor = '$supervisor',supervisor_paterno = '$supervisor_paterno',supervisor_materno = '$supervisor_materno',
				 puesto = '$puesto',telefono = '$telefono',email = '$email',
				 fecha_compromiso = $fecha_compromiso,
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	
	}else{
		
		$sql = "INSERT INTO formato_supervisor_asesoria (participante_id,expocientifico,expocientifico_paterno,expocientifico_materno,proyecto,quimicos,riesgos,seguridad,procedimientos,fuentes,
				supervisor,supervisor_paterno,supervisor_materno,puesto,telefono,email,fecha_compromiso,archivo,terminado,status,fecha_registro)";
		
		$sql .= " VALUES ('".$_SESSION['fenaci']["id_usuario"]."','$expocientifico','$expocientifico_paterno','$expocientifico_materno','$proyecto','$quimicos','$riesgos','$seguridad','$procedimientos','$fuentes','$supervisor',
				'$supervisor_paterno','$supervisor_materno','$puesto','$telefono','$email',$fecha_compromiso,$nombre_archivo,'$terminado',1,now())";
	
	
	}
	
	//echo $sql;
	//exit();
	
	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../supervisor-acesoria.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../supervisor-acesoria.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit; 
	

?>