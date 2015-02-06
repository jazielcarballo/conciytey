<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$lider = mysql_real_escape_string(trim(@$_POST['lider']));
	$lider_paterno = mysql_real_escape_string(trim(@$_POST['lider_paterno']));
	$lider_materno = mysql_real_escape_string(trim(@$_POST['lider_materno']));
	$segundo = mysql_real_escape_string(trim(@$_POST['segundo']));
	$segundo_paterno = mysql_real_escape_string(trim(@$_POST['segundo_paterno']));
	$segundo_materno = mysql_real_escape_string(trim(@$_POST['segundo_materno']));
	$tercero = mysql_real_escape_string(trim(@$_POST['tercero']));
	$tercero_paterno = mysql_real_escape_string(trim(@$_POST['tercero_paterno']));
	$tercero_materno = mysql_real_escape_string(trim(@$_POST['tercero_materno']));
	$asesor = mysql_real_escape_string(trim(@$_POST['asesor']));
	$asesor_paterno = mysql_real_escape_string(trim(@$_POST['asesor_paterno']));
	$asesor_materno = mysql_real_escape_string(trim(@$_POST['asesor_materno']));
	$escuela = mysql_real_escape_string(trim(@$_POST['escuela']));
	$original = mysql_real_escape_string(trim(@$_POST['original']));
	
	
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
			$destino = '../archivos/formato-f/' ;
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
	
	$sql = "SELECT * FROM formato_f WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
		$sql = " UPDATE formato_f SET proyecto = '$proyecto',lider = '$lider',lider_paterno = '$lider_paterno', lider_materno = '$lider_materno',
				 segundo = '$segundo',segundo_paterno = '$segundo_paterno', segundo_materno = '$segundo_materno',
				 tercero = '$tercero',tercero_paterno = '$tercero_paterno', tercero_materno = '$tercero_materno',
				 asesor = '$asesor',asesor_paterno = '$asesor_paterno', asesor_materno = '$asesor_materno',
				 escuela = '$escuela',original = '$original',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	}else{
		
		$sql = "INSERT INTO formato_f (participante_id,proyecto,lider,lider_paterno,lider_materno,segundo,segundo_paterno,segundo_materno,
				tercero,tercero_paterno,tercero_materno,asesor,asesor_paterno,asesor_materno,escuela,original,
				archivo,terminado,status,fecha_registro)";
		
		$sql .= " VALUES ('".$_SESSION['fenaci']["id_usuario"]."','$proyecto','$lider','$lider_paterno','$lider_materno','$segundo','$segundo_paterno','$segundo_materno',
				  '$tercero','$tercero_paterno','$tercero_materno','$asesor','$asesor_paterno','$asesor_materno','$escuela','$original',
				  $nombre_archivo,'$terminado',1,now())";
			

	}
	
	//echo $sql;
	//exit();

	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../formato-f.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../formato-f.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit; 

?>