<?php 
	session_start();
	include("../../includes/configuracion.php");
	include("../../includes/conexion.php");
	
		
	$id = mysql_real_escape_string(trim(@$_POST['id']));
	
	if(strlen($id) == 0) $id = 0;
	
	$contenido = @$_POST['text_seccion'];
	

	$query="UPDATE  secciones_administrables SET contenido = '$contenido',fecha_modificacion = now() WHERE id = '$id'";
	mysql_query($query); 
	
	//echo $query;
	
	switch($id){
		case 1:
			$url = 'proceso-fases.php';
			break;
		case 2:
			$url = 'feria.php';
			break;
		case 3:
			$url = 'informes.php';
			break;
		case 4:
		
			$estado_id = mysql_real_escape_string(trim(@$_POST['estado']));
			$anio = mysql_real_escape_string(trim(@$_POST['anio']));
			
			$query="UPDATE  campos_administrables SET valor = '$estado_id' WHERE seccion = 'todas' AND campo = 'estado_id'";
			mysql_query($query);
			
			$query="UPDATE  campos_administrables SET valor = '$anio' WHERE seccion = 'todas' AND campo = 'anio'";
			mysql_query($query);
			
			$url = 'seccion_index.php';
			break;
		case 5:
			$url = 'participantes.php';
			break;
		case 6:
			$url = 'areas-de-conocimiento.php';
			break;
		case 7:
			$url = 'reconocimientos.php';
			break;
	}
	
	
	redirect("../".$url."?mensaje=1");		
?>