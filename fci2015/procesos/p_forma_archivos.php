<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	$sql = "SELECT * FROM formatos";
	$query = mysql_query($sql);
	
	while($row = mysql_fetch_array($query)){
		/*
		echo '<pre>';
		print_r($_FILES["file_".$row['tabla']]);
		echo '</pre>';
		exit();
		*/
		$nombre_archivo = 'NULL';
	
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		
		$cad = '';
		
		for($y=0;$y<12;$y++) { 
			$cad .= substr($str,rand(0,62),1); 
		} 
		
		if(isset($_FILES["file_".$row['tabla']])){
	
			$tamano = $_FILES["file_".$row['tabla']][ 'size' ];
			if($tamano>0){
				
				
				$tamaño_max="50000000000";
				if( $tamano < $tamaño_max){  
					$destino = '../archivos/'.$row['carpeta'].'/' ;
					$sep=explode('application/',$_FILES["file_".$row['tabla']]["type"]);
					
					
					if(count($sep) < 2){ 
						$sep=explode('image/',$_FILES["file_".$row['tabla']]["type"]); 
						$tipo = str_replace("x-png", "png", $tipo);
						$tipo = str_replace("pjpeg", "jpeg", $tipo);
					}
					
					if(count($sep) >= 2){
					
						$tipo=$sep[1];
						
						
						if($tipo == "jpg" || $tipo == "jpeg" || $tipo == "png" || $tipo == "x-png" | $tipo == "pjpeg"  || $tipo == "pdf"  || $tipo == "msword"  || $tipo == "vnd.openxmlformats-officedocument.wordprocessingml.document"){ 
							move_uploaded_file ( $_FILES["file_".$row['tabla']][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);
							$nombre_archivo = "'".$cad.'.'.$tipo."'";	
							
							if($nombre_archivo == 'NULL') $nombre_archivo = "'".$row['archivo']."'";
			
			
							$sql = "UPDATE ".$row['tabla']." SET archivo = $nombre_archivo WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
							mysql_query($sql);					
						} 
					}
				} 
			}
		
		}
	
	}
	

	echo '<script>alert("Se subieron los archivos correctamente.")</script>';
	redirect('../perfil.php');	
	
	exit; 

?>