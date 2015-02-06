<?php 
	session_start();
	include '../includes/conexion.php';
	include '../includes/configuracion.php';	
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	exit();
	
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
	
	
	if(strlen($nombre)==0 OR strlen($titulo)==0 OR strlen($reglas_protocolo)==0 OR strlen($lista_revision)==0 OR strlen($riesgos)==0 OR (!is_array($formatos_todos)))
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	
	$str_areas_biologicos = (is_array($areas_biologicos)) ? implode(',',$areas_biologicos) : '';
	$str_formatos_todos = (is_array($formatos_todos)) ? implode(',',$formatos_todos) : '';
	$str_adicionles_humanos = (is_array($adicionles_humanos)) ? implode(',',$adicionles_humanos) : '';
	$str_adicionles_vertebrados = (is_array($adicionles_vertebrados)) ? implode(',',$adicionles_vertebrados) : '';
	$str_adicionles_biologicos = (is_array($adicionles_biologicos)) ? implode(',',$adicionles_biologicos) : '';
	$str_adicionles_quimicos = (is_array($adicionles_quimicos)) ? implode(',',$adicionles_quimicos) : '';
	
	mysql_query("SET NAMES 'utf8'");
		
	$sql = "INSERT INTO formato1a (lider,lider_paterno,lider_materno,titulo,reglas_protocolo,lista_revision,riesgos,areas_humanos,areas_biologicos,formatos_todos,adicionles_humanos,adicionles_vertebrados,adicionles_biologicos,adicionles_quimicos,status,fecha_registro)";
	$sql .= " VALUES ('$nombre','$paterno','$materno','$titulo','$reglas_protocolo','$lista_revision','$riesgos','$areas_humanos','$str_areas_biologicos',";
	$sql .= " '$str_formatos_todos','$str_adicionles_humanos','$str_adicionles_vertebrados','$str_adicionles_biologicos','$str_adicionles_quimicos',1,now())";
	
	
	$sql = " UPDATE formato_investigacion_con_humanos SET nombre = '$nombre',paterno = '$paterno',materno = '$materno',titulo = '$titulo',
				 reglas_protocolo = '$reglas_protocolo',lista_revision = '$lista_revision',riesgos = '$riesgos', 
				 areas_humanos = '$areas_humanos',areas_biologicos = '$areas_biologicos',formatos_todos = '$formatos_todos',
				 adicionles_humanos = '$adicionles_humanos',adicionles_vertebrados = '$adicionles_vertebrados',adicionles_biologicos = '$adicionles_biologicos',
				 adicionles_quimicos = '$adicionles_quimicos',str_areas_biologicos = '$str_areas_biologicos',str_formatos_todos = '$str_formatos_todos',
				 str_adicionles_humanos = '$str_adicionles_humanos',str_adicionles_vertebrados = '$str_adicionles_vertebrados',
				 str_adicionles_biologicos = '$str_adicionles_biologicos',str_adicionles_quimicos = '$str_adicionles_quimicos',
				 archivo = $nombre_archivo, terminado = '$terminado' WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	
	
	
	mysql_query($sql);
	
	exit; 

?>