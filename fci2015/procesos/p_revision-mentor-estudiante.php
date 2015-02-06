<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
//	echo '<pre>';
//	print_r($_POST);
//	echo '</pre>';
//	exit();
	
	$nombre = mysql_real_escape_string(trim(@$_POST['nombre']));
	$paterno = mysql_real_escape_string(trim(@$_POST['paterno']));
	$materno = mysql_real_escape_string(trim(@$_POST['materno']));
	$titulo = mysql_real_escape_string(trim(@$_POST['titulo']));
	$reglas_protocolo = mysql_real_escape_string(trim(@$_POST['reglas_protocolo']));
	$lista_revision = mysql_real_escape_string(trim(@$_POST['lista_revision']));
	$riesgos = mysql_real_escape_string(trim(@$_POST['riesgos']));
	$areas_humanos = mysql_real_escape_string(trim(@$_POST['areas_humanos']));
	$areas_biologicos = @$_POST['areas_opciones_biologicos'];
	$formatos_todos = @$_POST['formato_todos'];
	$adicionles_humanos = @$_POST['formatos_adicionales_humanos'];
	$adicionles_vertebrados = @$_POST['formatos_adicionales_vertebrados'];
	$adicionles_biologicos = @$_POST['formatos_adicionales_biologicos'];
	$adicionles_quimicos = @$_POST['formatos_adicionales_quimicos'];
		
	if(strlen($reglas_protocolo) == 0) $reglas_protocolo= 0;
	if(strlen($lista_revision) == 0) $lista_revision= 0;
	if(strlen($riesgos) == 0) $riesgos= 0;
	if(strlen($areas_humanos) == 0) $areas_humanos= 0;
	
	
/*	if(strlen($nombre)==0 OR strlen($titulo)==0 OR strlen($reglas_protocolo)==0 OR strlen($lista_revision)==0 OR strlen($riesgos)==0 OR (!is_array($formatos_todos)))
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
*/	
	$str_areas_biologicos = (is_array($areas_biologicos)) ? implode(',',$areas_biologicos) : '';
	$str_formatos_todos = (is_array($formatos_todos)) ? implode(',',$formatos_todos) : '';
	$str_adicionles_humanos = (is_array($adicionles_humanos)) ? implode(',',$adicionles_humanos) : '';
	$str_adicionles_vertebrados = (is_array($adicionles_vertebrados)) ? implode(',',$adicionles_vertebrados) : '';
	$str_adicionles_biologicos = (is_array($adicionles_biologicos)) ? implode(',',$adicionles_biologicos) : '';
	$str_adicionles_quimicos = (is_array($adicionles_quimicos)) ? implode(',',$adicionles_quimicos) : '';
	
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
			$destino = '../archivos/revision-mentor-estudiante/' ;
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
	
	$sql = "SELECT * FROM formato1a WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	
	if(mysql_num_rows($query) > 0){
		
		$result = mysql_fetch_array($query);
		
		if($nombre_archivo == 'NULL') $nombre_archivo = "'".$result['archivo']."'";
	
		$sql = " UPDATE formato1a SET nombre = '$nombre',paterno = '$paterno',materno = '$materno',titulo = '$titulo',
				 reglas_protocolo = '$reglas_protocolo',lista_revision = '$lista_revision',riesgos = '$riesgos', 
				 areas_humanos = '$areas_humanos',areas_biologicos = '$str_areas_biologicos',formatos_todos = '$str_formatos_todos',
				 adicionles_humanos = '$str_adicionles_humanos',adicionles_vertebrados = '$str_adicionles_vertebrados',adicionles_biologicos = '$str_adicionles_biologicos',
				 adicionles_quimicos = '$str_adicionles_quimicos',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	
	}else{	
	
		$sql = "INSERT INTO formato1a (participante_id,nombre,paterno,materno,titulo,reglas_protocolo,lista_revision,riesgos,areas_humanos,areas_biologicos,formatos_todos,adicionles_humanos,adicionles_vertebrados,adicionles_biologicos,adicionles_quimicos,archivo,terminado,status,fecha_registro)";
		$sql .= " VALUES ('".$_SESSION['fenaci']["id_usuario"]."','$nombre','$paterno','$materno','$titulo','$reglas_protocolo','$lista_revision','$riesgos','$areas_humanos','$areas_biologicos',";
		$sql .= " '$str_formatos_todos','$str_adicionles_humanos','$str_adicionles_vertebrados','$str_adicionles_biologicos','$str_adicionles_quimicos',$nombre_archivo,'$terminado',1,now())";
	
	
	
	
	
	}
	//mysql_query($sql);
	
	//echo $sql;
	//exit();
	
	if(!mysql_query($sql)){
		echo '<script>alert("Ocurrio un error, intente mas tarde por favor.");</script>';
		redirect('../revision-mentor-estudiante.php');
	}else{
		echo '<script>alert("Gracias por enviarnos tus datos.")</script>';
		if(strlen(@$_POST['guardar']) > 0){
			redirect('../revision-mentor-estudiante.php');	
		}else{
			redirect('../perfil.php');	
		}	
	}
	

	exit; 

?>