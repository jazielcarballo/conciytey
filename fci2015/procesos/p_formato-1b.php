<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	

	$compromiso_opciones = @$_POST['compromiso_opciones'];
	$expocientifico_paterno = mysql_real_escape_string(trim(@$_POST['expocientifico_paterno']));
	$expocientifico_materno = mysql_real_escape_string(trim(@$_POST['expocientifico_materno']));
	$expocientifico = mysql_real_escape_string(trim(@$_POST['expocientifico']));
	$fecha_expocientifico = mysql_real_escape_string(trim(@$_POST['fecha_expocientifico']));
	$padre = mysql_real_escape_string(trim(@$_POST['padre']));
	$padre_paterno = mysql_real_escape_string(trim(@$_POST['padre_paterno']));
	$padre_materno = mysql_real_escape_string(trim(@$_POST['padre_materno']));
	$fecha_padre = mysql_real_escape_string(trim(@$_POST['fecha_padre']));
	$a_titular = mysql_real_escape_string(trim(@$_POST['a_titular']));
	$a_fecha = mysql_real_escape_string(trim(@$_POST['a_fecha']));
	$a_feria_opciones = @$_POST['a_feria_opciones'];
	$b_titular = mysql_real_escape_string(trim(@$_POST['b_titular']));
	$b_fecha = mysql_real_escape_string(trim(@$_POST['b_fecha']));
	$b_feria_opciones = @$_POST['a_feria_opciones'];
	$presidente = mysql_real_escape_string(trim(@$_POST['presidente']));
	$fecha_presidente = mysql_real_escape_string(trim(@$_POST['fecha_presidente']));
	
	/*
	if(strlen($expocientifico)==0 OR strlen($fecha_expocientifico)==0 OR strlen($padre)==0 OR strlen($fecha_padre)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	*/
	
	$str_compromiso = (is_array($compromiso_opciones)) ? implode(',',$compromiso_opciones) : '';
	$str_a_feria = (is_array($a_feria_opciones)) ? implode(',',$a_feria_opciones) : '';
	$str_b_feria = (is_array($b_feria_opciones)) ? implode(',',$b_feria_opciones) : '';
	
	$fecha_expocientifico = (strlen($fecha_expocientifico) == 0) ? 'NULL' : "'".$fecha_expocientifico."'";
	$fecha_padre = (strlen($fecha_padre) == 0) ? 'NULL' : "'".$fecha_padre."'";
	$a_fecha = (strlen($a_fecha) == 0) ? 'NULL' : "'".$a_fecha."'";
	$b_fecha = (strlen($b_fecha) == 0) ? 'NULL' : "'".$b_fecha."'";
	$fecha_presidente = (strlen($fecha_presidente) == 0) ? 'NULL' : "'".$fecha_presidente."'";
	
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
			$destino = '../archivos/formato-1b/' ;
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
	
	$sql = "SELECT * FROM formato1b WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
		
		$sql = " UPDATE formato1b SET compromiso = '$str_compromiso',expocientifico_paterno = '$expocientifico_paterno', 
				 expocientifico_materno = '$expocientifico_materno',expocientifico = '$expocientifico',fecha_expocientifico=$fecha_expocientifico, padre = '$padre',
				 fecha_padre = $fecha_padre,padre_paterno='$padre_paterno',padre_materno='$padre_materno',
				 a_titular = '$a_titular', a_fecha = $a_fecha,a_feria = '$str_a_feria',b_titular = '$b_titular',
				 b_fecha = $b_fecha,b_feria = '$str_b_feria',presidente = '$presidente',fecha_presidente = $fecha_presidente,
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
		
	}else{
		
		$sql = "INSERT INTO formato1b (compromiso,participante_id,expocientifico,expocientifico_paterno,expocientifico_materno,fecha_expocientifico,padre,padre_paterno,padre_materno,fecha_padre,a_titular,a_fecha,a_feria,
				b_titular,b_fecha,b_feria,presidente,fecha_presidente,archivo,terminado,status,fecha_registro)";
		
		$sql .= " VALUES ('$str_compromiso','".$_SESSION['fenaci']["id_usuario"]."','$expocientifico','$expocientifico_paterno','$expocientifico_materno',$fecha_expocientifico,'$padre','$padre_paterno','$padre_materno',$fecha_padre,'$a_titular',$a_fecha,'$str_a_feria',
				 '$b_titular',$b_fecha,'$str_b_feria','$presidente',$fecha_presidente,$nombre_archivo,'$terminado',1,now())";
	}
	
	//echo $sql;
	//exit();
	
	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../formato-1b.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../formato-1b.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit; 

?>