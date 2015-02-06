<?php include("../../includes/configuracion.php"); ?>
<?php include("../../includes/conexion.php"); ?>

<?php

	$id = mysql_real_escape_string(trim(@$_POST['id']));	
	$tipo_banner = mysql_real_escape_string(trim(@$_POST['tipo']));
	
	$fecha = date('Y-m-d G:i:s');
	
	
	switch($tipo_banner){
		case 1:
			$ancho = 183;
			$alto = 103;
			break;
		case 2:
			$ancho = 1200;
			$alto = 156;
			break;
		case 3:
			$ancho = 1200;
			$alto = 400;
			break;
		case 4:
			$ancho = 181;
			$alto = 52;
			break;
	}
	
	$nombre_imagen = '';
	
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
			
	for($y=0;$y<12;$y++) { 
		@$cad .= substr($str,rand(0,62),1); 
	} 

	$tamano = $_FILES["file_imagen"][ 'size' ];
	if($tamano>0){
		$tamaño_max="50000000000";
		if( $tamano < $tamaño_max){  
			$destino = '../../img/logo_banner/' ;
			$sep=explode('image/',$_FILES["file_imagen"]["type"]);
			$tipo=$sep[1];
			$tipo = str_replace("x-png", "png", $tipo);
			$tipo = str_replace("pjpeg", "jpeg", $tipo);
			
			if($tipo == "gif" || $tipo == "jpeg" || $tipo == "png"  || $tipo == "bmp" || $tipo == "x-png" | $tipo == "pjpeg"){ 
				move_uploaded_file ( $_FILES["file_imagen"][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);
				$nombre_imagen = $cad.'.'.$tipo;
										
				$sRootImages = realpath('../../img/logo_banner'). DIRECTORY_SEPARATOR;
				$sRootImagesThumbs = realpath('../../img/logo_banner/thumbnail'). DIRECTORY_SEPARATOR;
																									
				thumb($nombre_imagen,50,$sRootImages,$sRootImagesThumbs);
				thumb($nombre_imagen,$ancho,$sRootImages,$sRootImagesThumbs,$alto);								
			} 
		} 
	}
	

	if(strlen($nombre_imagen) > 0){
		$query="UPDATE logo_banner SET imagen = '$nombre_imagen', modificacion = '$fecha' WHERE id_banner = '$id'";
		mysql_query($query); 
	}
		
	redirect("../logo.php?mensaje=1");
		
	die;
?>