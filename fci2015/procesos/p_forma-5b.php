<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	
	$lider = mysql_real_escape_string(trim(@$_POST['lider']));
	$lider_paterno = mysql_real_escape_string(trim(@$_POST['lider_paterno']));
	$lider_materno = mysql_real_escape_string(trim(@$_POST['lider_materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$protocolo = mysql_real_escape_string(trim(@$_POST['protocolo']));
	$idea = mysql_real_escape_string(trim(@$_POST['idea']));
	$reglas = mysql_real_escape_string(trim(@$_POST['reglas']));
	$capacitacion = mysql_real_escape_string(trim(@$_POST['capacitacion']));
	$especies = mysql_real_escape_string(trim(@$_POST['especies']));
	$numero_animales = mysql_real_escape_string(trim(@$_POST['numero_animales']));
	$dolor = mysql_real_escape_string(trim(@$_POST['dolor']));
	$rol = mysql_real_escape_string(trim(@$_POST['rol']));
	
	/*
	if(strlen($lider)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	*/
	$nombre_archivo = 'NULL';
	
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	
	for($y=0;$y<12;$y++) { 
		@$cad .= substr($str,rand(0,62),1); 
	} 
	
	$tamano = $_FILES["file_formato"][ 'size' ];
	if($tamano>0){
		$tamaño_max="50000000000";
		if( $tamano < $tamaño_max){  
			$destino = '../archivos/forma-5b/' ;
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
	
	$sql = "SELECT * FROM formato_5b WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
		$sql = " UPDATE formato_5b SET lider = '$lider',lider_paterno = '$lider_paterno', lider_materno = '$lider_materno',proyecto = '$proyecto',
				 protocolo = '$protocolo',idea = '$idea',reglas = '$reglas', 
				 capacitacion = '$capacitacion',especies = '$especies',numero_animales = '$numero_animales',
				 dolor = '$dolor',rol = '$rol',archivo = $nombre_archivo, terminado = '$terminado' 
				 WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
				 
	}else{
		
		$sql = "INSERT INTO formato_5b (lider,participante_id,lider_paterno,lider_materno,proyecto,protocolo,idea,reglas,capacitacion,especies,numero_animales,dolor,rol,archivo,terminado,status,fecha_registro)";
		
		$sql .= " VALUES ('$lider','".$_SESSION['fenaci']["id_usuario"]."','$lider_paterno','$lider_materno','$proyecto','$protocolo','$idea','$reglas','$capacitacion','$especies','$numero_animales','$dolor','$rol',$nombre_archivo,'$terminado',1,now())";
				
	
	}

	//echo $sql;
//	exit();
		
	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../forma-5b.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../forma-5b.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit; 

?>