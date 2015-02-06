<?php 
	session_start();
	include("../includes/configuracion.php");
	include("../includes/conexion.php");
	
	$nombre = mysql_real_escape_string(trim(@$_POST['nombre']));
	$email = mysql_real_escape_string(trim(@$_POST['email']));
	$tipo_participante = mysql_real_escape_string(trim(@$_POST['tipo']));
	$password = mysql_real_escape_string(trim(@$_POST['password']));
	$password_confirm = mysql_real_escape_string(trim(@$_POST['password_confirm']));
	
	if (strlen($nombre) == 0 OR strlen($email) == 0 OR strlen($tipo_participante) == 0)
	{
		
		echo '<script language="javascript">alert("Debe proporcionar todos los datos requeridos.");';
		echo 'window.history.back();</script>';
		exit();
	}
	
	if ($password != $password_confirm)
	{
		
		echo '<script language="javascript">alert("La contraseña y la confirmacion son diferentes.");';
		echo 'window.history.back();</script>';
		exit();
	}
	
	$sql = "SELECT * FROM participantes WHERE email = '". $email."'";
	$query = mysql_query($sql);
	
	if(mysql_num_rows($query) > 0){
		echo '<script language="javascript">alert("Proporcione otra cuenta de correo por favor.");';
		echo 'window.history.back();</script>';
		exit();
	}
	
	
	$archivo_identificacion = 'NULL';
	$archivo_curp = 'NULL';
	
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	
	
	
	// Archivo de identificacion
	for($y=0;$y<12;$y++) { 
		@$cad .= substr($str,rand(0,62),1); 
	} 
	
	$tamano = $_FILES["file_indentificacion"][ 'size' ];
	if($tamano>0){
		$tamaño_max="50000000000";
		if( $tamano < $tamaño_max){  
			$destino = '../archivos/registro/identificacion/' ;
			$sep=explode('application/',$_FILES["file_indentificacion"]["type"]);
			
			if(count($sep) < 2){ 
				$sep=explode('image/',$_FILES["file_indentificacion"]["type"]); 
				$tipo = str_replace("x-png", "png", $tipo);
				$tipo = str_replace("pjpeg", "jpeg", $tipo);
			}
			
			if(count($sep) >= 2){
			
				$tipo=$sep[1];
				
				
				if($tipo == "jpg" || $tipo == "jpeg" || $tipo == "png" || $tipo == "x-png" | $tipo == "pjpeg"  || $tipo == "pdf"  || $tipo == "msword"  || $tipo == "vnd.openxmlformats-officedocument.wordprocessingml.document"){ 
					move_uploaded_file ( $_FILES["file_indentificacion"][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);
					$archivo_identificacion = "'".$cad.'.'.$tipo."'";						
				} 
			}
		} 
	}
	
	$cad = '';
	
	// Archivo del curp
	for($y=0;$y<12;$y++) { 
		@$cad .= substr($str,rand(0,62),1); 
	} 
	
	$tamano = $_FILES["file_curp"][ 'size' ];
	if($tamano>0){
		$tamaño_max="50000000000";
		if( $tamano < $tamaño_max){  
			$destino = '../archivos/registro/curp/' ;
			$sep=explode('application/',$_FILES["file_curp"]["type"]);
			
			if(count($sep) == 0){ 
				$sep=explode('image/',$_FILES["file_curp"]["type"]); 
				$tipo = str_replace("x-png", "png", $tipo);
				$tipo = str_replace("pjpeg", "jpeg", $tipo);
			}
			
			$tipo=$sep[1];
			
			
			if($tipo == "jpg" || $tipo == "jpeg" || $tipo == "png" || $tipo == "x-png" | $tipo == "pjpeg"  || $tipo == "pdf"  || $tipo == "msword"  || $tipo == "vnd.openxmlformats-officedocument.wordprocessingml.document"){ 
				move_uploaded_file ( $_FILES["file_curp"][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);
				$archivo_curp = "'".$cad.'.'.$tipo."'";						
			} 
		} 
	}
	
	$sql = "SELECT CONCAT(est.prefijo,(SUBSTRING(par1.folio FROM 4)+1)) AS folio 
			FROM participantes par1
			LEFT JOIN estados est ON est.id = (SELECT camp.valor FROM campos_administrables camp WHERE camp.seccion = 'todas' AND camp.campo = 'estado_id')
			WHERE par1.id = (SELECT MAX(par2.id) FROM participantes par2) ";
	
	$query = mysql_query($sql);
	
	if(mysql_num_rows($query) == 0){
		$sql = "SELECT est.prefijo FROM estados est 
				INNER JOIN campos_administrables camp ON (camp.valor = est.id AND camp.seccion = 'todas' AND camp.campo = 'estado_id')";
		
		$query = mysql_query($sql);
		$result = mysql_fetch_array($query);
		$folio = $result['prefijo'].'100';
		
	}else{
		$result = mysql_fetch_array($query);
		$folio = $result['folio'];
	}

	
	$sql = "INSERT INTO participantes (nombre,email,password,tipo,identificacion,curp,folio,status,fecha_registro,fecha_acceso) ";
	$sql .= " VALUES ('$nombre','$email','$password','$tipo_participante',$archivo_identificacion,$archivo_curp,'$folio',1,now(),now()) ";
	
	if(mysql_query($sql)){
		$sql = "SELECT * FROM participantes WHERE email = '$email'";
		$query = mysql_query($sql);
		$result = mysql_fetch_array($query);
		
		$_SESSION['fenaci']["id_usuario"] = $result['id'];
		$_SESSION['fenaci']["nombre"] = $nombre;
		$_SESSION['fenaci']["email"] = $email;
		$_SESSION['fenaci']["tipo"] = $tipo;
		$_SESSION['fenaci']["folio"] = $result['folio'];
		
		echo '<script language="javascript">alert("Gracias por registrarte.")</script>';
		redirect('../registro-ok.php');
		
		
	}else{
		echo '<script language="javascript">alert("Ocurrio un error, intente mas tarde por favor.");';
		echo 'window.history.back();</script>';
		exit();	
	}
	
	
	die;
?>