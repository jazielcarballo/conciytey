<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit();
	
	$lider = mysql_real_escape_string(trim(@$_POST['lider']));
	$lider_paterno = mysql_real_escape_string(trim(@$_POST['lider_paterno']));
	$lider_materno = mysql_real_escape_string(trim(@$_POST['lider_materno']));
	$proyecto = mysql_real_escape_string(trim(@$_POST['proyecto']));
	
	
	$genero[1] = mysql_real_escape_string(trim(@$_POST['genero1']));
	$especie[1] = mysql_real_escape_string(trim(@$_POST['especie1']));
	$nombre[1] = mysql_real_escape_string(trim(@$_POST['nombre1']));
	$numero[1] = mysql_real_escape_string(trim(@$_POST['numero1']));
	
	
	$genero[2] = mysql_real_escape_string(trim(@$_POST['genero2']));
	$especie[2] = mysql_real_escape_string(trim(@$_POST['especie2']));
	$nombre[2] = mysql_real_escape_string(trim(@$_POST['nombre2']));
	$numero[2] = mysql_real_escape_string(trim(@$_POST['numero2']));
	
	$genero[3] = mysql_real_escape_string(trim(@$_POST['genero3']));
	$especie[3] = mysql_real_escape_string(trim(@$_POST['especie3']));
	$nombre[3] = mysql_real_escape_string(trim(@$_POST['nombre3']));
	$numero[3] = mysql_real_escape_string(trim(@$_POST['numero3']));
	
	$genero[4] = mysql_real_escape_string(trim(@$_POST['genero4']));
	$especie[4] = mysql_real_escape_string(trim(@$_POST['especie4']));
	$nombre[4] = mysql_real_escape_string(trim(@$_POST['nombre4']));
	$numero[4] = mysql_real_escape_string(trim(@$_POST['numero4']));
	
	$genero[5] = mysql_real_escape_string(trim(@$_POST['genero5']));
	$especie[5] = mysql_real_escape_string(trim(@$_POST['especie5']));
	$nombre[5] = mysql_real_escape_string(trim(@$_POST['nombre5']));
	$numero[5] = mysql_real_escape_string(trim(@$_POST['numero5']));
	
	
	$alojamiento = mysql_real_escape_string(trim(@$_POST['alojamiento']));
	$despues = mysql_real_escape_string(trim(@$_POST['despues']));
	
	
	if(strlen($lider)==0 OR strlen($proyecto)==0)
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
			$destino = '../archivos/forma-5a/' ;
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
		
	$sql = "INSERT INTO formato_5a (lider,lider_paterno,lider_materno,proyecto,alojamiento,despues,permiso,status,fecha_registro)";
	
	$sql .= " VALUES ('$lider','$lider_paterno','$lider_materno','$proyecto','$alojamiento','$despues','$permiso',1,now())";
	
	$sql = " UPDATE formato_5a SET lider = '$lider',lider_paterno = '$lider_paterno', lider_materno = '$lider_materno',proyecto = '$proyecto',
				 alojamiento = '$alojamiento',despues = '$despues',permiso = '$permiso',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	
	
	//echo $sql;		
	
	if(mysql_query($sql)){
		
		$sql = "SELECT MAX(id) AS id FROM formato_5a";
		$query = mysql_query($sql);
		$result = mysql_fetch_array($query);
		$id = $result['id'];	
	
		
		for($i=1;$i<=5;$i++){
			
			if(strlen($genero[$i]) > 0 AND strlen($especie[$i]) > 0 AND strlen($nombre[$i]) > 0 AND strlen($numero[$i]) > 0){
				$sql = "INSERT INTO formato_5a_especies (id_5a,posicion,genero,especie,nombre,numero)";
				$sql .= "VALUES ('$id','$i','".$genero[$i]."','".$especie[$i]."','".$nombre[$i]."','".$numero[$i]."')";
				mysql_query($sql);
			}	
		}	
	}
	
	//echo '<script>alert("Gracias por enviarnos tus datos.");';
	//echo "window.location='../registro-ok.php';</script>";
	
	exit; 

?>