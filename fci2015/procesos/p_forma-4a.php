<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit();
	
	$expocientifico = mysql_real_escape_string(trim(@$_POST['expocientifico']));
	$expocientifico_paterno = mysql_real_escape_string(trim(@$_POST['expocientifico_paterno']));
	$expocientifico_materno = mysql_real_escape_string(trim(@$_POST['expocientifico_materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	$mentor = mysql_real_escape_string(trim(@$_POST['mentor']));
	$email = mysql_real_escape_string(trim(@$_POST['email']));
	$proposito = mysql_real_escape_string(trim(@$_POST['proposito']));
	$participas = mysql_real_escape_string(trim(@$_POST['participas']));
	$tiempo = mysql_real_escape_string(trim(@$_POST['tiempo']));
	$riesgos = mysql_real_escape_string(trim(@$_POST['riesgos']));
	$beneficios = mysql_real_escape_string(trim(@$_POST['beneficios']));
	$confidencialidad = mysql_real_escape_string(trim(@$_POST['confidencialidad']));
	$dudas_mentor = mysql_real_escape_string(trim(@$_POST['dudas_mentor']));
	$dudas_telefono = mysql_real_escape_string(trim(@$_POST['dudas_telefono']));
	$dudas_email = mysql_real_escape_string(trim(@$_POST['dudas_email']));
	$dudas_padre = mysql_real_escape_string(trim(@$_POST['dudas_padre']));
	
	
	if(strlen($expocientifico)==0 OR strlen($proyecto)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	
	$nombre_archivo = 'NULL';
	
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	
	for($y=0;$y<12;$y++) { 
		@$cad .= substr($str,rand(0,62),1); 
	} 
	
	$tamano = $_FILES["file_permiso"][ 'size' ];
	if($tamano>0){
		$tamaño_max="50000000000";
		if( $tamano < $tamaño_max){  
			$destino = '../archivos/forma-4a/' ;
			$sep=explode('application/',$_FILES["file_permiso"]["type"]);
			
			if(count($sep) == 0){ 
				$sep=explode('image/',$_FILES["file_permiso"]["type"]); 
				$tipo = str_replace("x-png", "png", $tipo);
				$tipo = str_replace("pjpeg", "jpeg", $tipo);
			}
			
			$tipo=$sep[1];
			
			
			if($tipo == "jpg" || $tipo == "jpeg" || $tipo == "png" || $tipo == "x-png" | $tipo == "pjpeg"  || $tipo == "pdf"  || $tipo == "msword"  || $tipo == "vnd.openxmlformats-officedocument.wordprocessingml.document"){  
				move_uploaded_file ( $_FILES["file_permiso"][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);
				$nombre_archivo = "'".$cad.'.'.$tipo."'";						
			} 
		} 
	}
	
	
	mysql_query("SET NAMES 'utf8'");
		
	$sql = "INSERT INTO formato_4a (expocientifico,expocientifico_paterno,expocientifico_materno,proyecto,mentor,email,proposito,participas,tiempo,riesgos,beneficios,
			confidencialidad,dudas_mentor,dudas_telefono,dudas_email,dudas_padre,permiso,status,fecha_registro)";
	
	$sql .= " VALUES ('$expocientifico','$expocientifico_paterno','$expocientifico_materno','$proyecto','$mentor','$email','$proposito','$participas','$tiempo','$riesgos','$beneficios','$confidencialidad',
			'$dudas_mentor','$dudas_telefono','$dudas_email','$dudas_padre',$nombre_archivo,1,now())";
			
	$sql = " UPDATE formato_4a SET expocientifico = '$expocientifico',expocientifico_paterno = '$expocientifico_paterno', 
				 expocientifico_materno = '$expocientifico_materno',proyecto = '$proyecto',mentor = '$mentor',email = '$email',proposito = '$proposito',
				 participas = '$participas',tiempo = '$tiempo',riesgos = '$riesgos',
				 beneficios = '$beneficios',confidencialidad = '$confidencialidad',dudas_mentor = '$dudas_mentor',dudas_telefono = '$dudas_telefono',
				 dudas_email = '$dudas_email',dudas_padre = '$dudas_padre',permiso = '$permiso',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	
	
	mysql_query($sql) or die(mysql_error());
	
	echo '<script>alert("Gracias por enviarnos tus datos.");';
	echo "window.location='../registro-ok.php';</script>";
	
	
	exit; 

?>