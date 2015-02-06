<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit();
	
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
	
	if(strlen($expocientifico)==0 OR strlen($fecha_expocientifico)==0 OR strlen($padre)==0 OR strlen($fecha_padre)==0)
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	
	$str_compromiso = (is_array($compromiso_opciones)) ? implode(',',$compromiso_opciones) : '';
	$str_a_feria = (is_array($a_feria_opciones)) ? implode(',',$a_feria_opciones) : '';
	$str_b_feria = (is_array($b_feria_opciones)) ? implode(',',$b_feria_opciones) : '';
	
	
	mysql_query("SET NAMES 'utf8'");
		
	$sql = "INSERT INTO formato1b (compromiso,expocientifico,expocientifico_paterno,expocientifico_materno,fecha_expocientifico,padre,fecha_padre,a_titular,a_fecha,a_feria,
			b_titular,b_fecha,b_feria,presidente,fecha_presidente,status,fecha_registro)";
	
	$sql .= " VALUES ('$str_compromiso','$expocientifico','$expocientifico_paterno','$expocientifico_materno','$fecha_expocientifico','$padre','$fecha_padre','$a_titular','$a_fecha','$str_a_feria',
			 '$b_titular','$b_fecha','$str_b_feria','$presidente','$fecha_presidente',1,now())";
	
	$sql = " UPDATE formato_5b SET compromiso_opciones = '$compromiso_opciones',expocientifico_paterno = '$expocientifico_paterno', 
				 expocientifico_materno = '$expocientifico_materno',expocientifico = '$expocientifico',padre = '$padre',fecha_padre = '$fecha_padre',
				 a_titular = '$a_titular', a_fecha = '$a_fecha',a_feria_opciones = '$a_feria_opciones',b_titular = '$b_titular',
				 b_fecha = '$b_fecha',b_feria_opciones = '$b_feria_opciones',presidente = '$presidente',fecha_presidente = '$fecha_presidente'
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	
	
	
	//echo $sql;
	
	mysql_query($sql);
	
	exit; 

?>