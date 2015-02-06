<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	
	$lider = mysql_real_escape_string(trim(@$_POST['lider']));
	$lider_paterno = mysql_real_escape_string(trim(@$_POST['lider_paterno']));
	$lider_materno = mysql_real_escape_string(trim(@$_POST['lider_materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$biologicos = mysql_real_escape_string(trim(@$_POST['biologicos']));
	$lugar = mysql_real_escape_string(trim(@$_POST['lugar']));
	$metodo_desecho = mysql_real_escape_string(trim(@$_POST['metodo_desecho']));
	$procedimiento_riesgos = mysql_real_escape_string(trim(@$_POST['procedimiento_riesgos']));
	$seguridad = mysql_real_escape_string(trim(@$_POST['seguridad']));
	$entrenamiento = mysql_real_escape_string(trim(@$_POST['entrenamiento']));
	$acuerdo_recomendaciones = mysql_real_escape_string(trim(@$_POST['acuerdo_recomendaciones']));
	$acuerdo_recomendaciones_exp = mysql_real_escape_string(trim(@$_POST['acuerdo_recomendaciones_txt']));
	$supervisor1 = mysql_real_escape_string(trim(@$_POST['supervisor1']));
	$supervisor1_paterno = mysql_real_escape_string(trim(@$_POST['supervisor1_paterno']));
	$supervisor1_materno = mysql_real_escape_string(trim(@$_POST['supervisor1_materno']));
	$fecha_supervisor1 = mysql_real_escape_string(trim(@$_POST['fecha_supervisor1']));
	$NBS1 = mysql_real_escape_string(trim(@$_POST['NBS1']));
	$NBS2 = mysql_real_escape_string(trim(@$_POST['NBS2']));
	$supervisor2 = mysql_real_escape_string(trim(@$_POST['supervisor2']));
	$supervisor2_paterno = mysql_real_escape_string(trim(@$_POST['supervisor2_paterno']));
	$supervisor2_materno = mysql_real_escape_string(trim(@$_POST['supervisor2_materno']));
	$fecha_supervisor2 = mysql_real_escape_string(trim(@$_POST['fecha_supervisor2']));
	$aprovado_comite = mysql_real_escape_string(trim(@$_POST['aprovado_comite']));
	$supervisor3 = mysql_real_escape_string(trim(@$_POST['supervisor3']));
	$supervisor3_paterno = mysql_real_escape_string(trim(@$_POST['supervisor3_paterno']));
	$supervisor3_materno = mysql_real_escape_string(trim(@$_POST['supervisor3_materno']));
	$fecha_supervisor3 = mysql_real_escape_string(trim(@$_POST['fecha_supervisor3']));
	
	
	if(strlen($NBS1) == 0) $NBS1= 0;
	if(strlen($NBS2) == 0) $NBS2= 0;
	if(strlen($aprovado_comite) == 0) $aprovado_comite= 0;
	
	/*
	if(strlen($lider)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	*/
	
	$fecha_supervisor1 = (strlen($fecha_supervisor1) == 0) ? 'NULL' : "'".$fecha_supervisor1."'";
	$fecha_supervisor2 = (strlen($fecha_supervisor2) == 0) ? 'NULL' : "'".$fecha_supervisor2."'";
	$fecha_supervisor3 = (strlen($fecha_supervisor3) == 0) ? 'NULL' : "'".$fecha_supervisor3."'";
	

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
			$destino = '../archivos/agentes-biologicos/' ;
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
	
	$sql = "SELECT * FROM formato_agentes_biologicos WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
		$sql = " UPDATE formato_agentes_biologicos SET lider = '$lider',lider_paterno = '$lider_paterno', lider_materno = '$lider_materno',
				proyecto = '$proyecto',biologicos = '$biologicos',lugar = '$lugar',metodo_desecho = '$metodo_desecho',
				 procedimiento_riesgos = '$procedimiento_riesgos',seguridad = '$seguridad',entrenamiento = '$entrenamiento',
				 acuerdo_recomendaciones = '$acuerdo_recomendaciones',acuerdo_recomendaciones_exp = '$acuerdo_recomendaciones_exp',
				 supervisor1 = '$supervisor1',supervisor1_paterno = '$supervisor1_paterno',supervisor1_materno = '$supervisor1_materno',
				 fecha_supervisor1 = $fecha_supervisor1,NBS1 = '$NBS1',NBS2 = '$NBS2',supervisor2 = '$supervisor2',supervisor2_paterno = '$supervisor2_paterno',
				 supervisor2_materno = '$supervisor2_materno',fecha_supervisor2 = $fecha_supervisor2,aprovado_comite = '$aprovado_comite',
				 supervisor3 = '$supervisor3',supervisor3_paterno = '$supervisor3_paterno',supervisor3_materno = '$supervisor3_materno',fecha_supervisor3 = $fecha_supervisor3,
				 archivo = $nombre_archivo, terminado = '$terminado', fecha_modificacion = now() WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	}else{
		
		$sql = "INSERT INTO formato_agentes_biologicos (lider,participante_id,lider_paterno,lider_materno,proyecto,biologicos,lugar,metodo_desecho,procedimiento_riesgos,seguridad,
				entrenamiento,acuerdo_recomendaciones,acuerdo_recomendaciones_exp,supervisor1,supervisor1_paterno,supervisor1_materno,fecha_supervisor1,NBS1,NBS2,supervisor2,
				supervisor2_paterno,supervisor2_materno,fecha_supervisor2,aprovado_comite,supervisor3,supervisor3_paterno,supervisor3_materno,fecha_supervisor3,archivo,terminado,status,fecha_registro)";
		
		$sql .= " VALUES ('$lider','".$_SESSION['fenaci']["id_usuario"]."','$lider_paterno','$lider_materno','$proyecto','$biologicos','$lugar','$metodo_desecho','$procedimiento_riesgos','$seguridad','$entrenamiento',
				'$acuerdo_recomendaciones','$acuerdo_recomendaciones_exp','$supervisor1','$supervisor1_paterno','$supervisor1_materno',$fecha_supervisor1,'$NBS1','$NBS2',
				'$supervisor2','$supervisor2_paterno','$supervisor2_materno',$fecha_supervisor2,'$aprovado_comite','$supervisor3','$supervisor3_paterno','$supervisor3_materno',$fecha_supervisor3,$nombre_archivo,'$terminado',1,now())";
			

	}
	
	//echo $sql;
	//exit();

	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../agentes-biologicos.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../agentes-biologicos.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit; 

?>