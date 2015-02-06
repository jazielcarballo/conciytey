<?php 
	session_start();
	include '../configuracion/conexion.php';
	include '../configuracion/configuracion.php';	
	//require_once('PhpMailer/class.phpmailer.php');	
	
	echo '<pre>';
	print_r($_POST['formato_todos']);
	echo '</pre>';
	exit();
	
	
	$nombre = mysql_real_escape_string(trim(@$_POST['nombre']));
	$titulo = mysql_real_escape_string(trim(@$_POST['titulo']));
	$reglas_protocolo = mysql_real_escape_string(trim(@$_POST['reglas_protocolo']));
	$lista_revision = mysql_real_escape_string(trim(@$_POST['lista_revision']));
	$riesgos = mysql_real_escape_string(trim(@$_POST['riesgos']));
	$areas_humanos = mysql_real_escape_string(trim(@$_POST['areas_humanos']));
	$areas_biologicos = mysql_real_escape_string(trim(@$_POST['areas_opciones_biologicos']));
	$formatos_todos = mysql_real_escape_string(trim(@$_POST['formato_todos']));
	$adicionles_humanos = mysql_real_escape_string(trim(@$_POST['formatos_adicionales_humanos']));
	$adicionles_vertebrados = mysql_real_escape_string(trim(@$_POST['formatos_adicionales_vertebrados']));
	$adicionles_biologicos = mysql_real_escape_string(trim(@$_POST['formatos_adicionales_biologicos']));
	$adicionles_quimicos = mysql_real_escape_string(trim(@$_POST['formatos_adicionales_quimicos']));
	
	
	
	if(strlen($nombre)==0 OR strlen($titulo)==0 OR strlen($reglas_protocolo)==0 OR strlen($lista_revision)==0 OR strlen($riesgos)==0 OR (!is_array($formatos_todos)))
	{
		echo "Debe proporcionar los campos requeridos.";
		die();
	}
	
	$str_areas_biologicos = (is_array($areas_biologicos)) ? implode($areas_biologicos) : '';
	$str_formatos_todos = (is_array($formatos_todos)) ? implode($formatos_todos) : '';
	$str_adicionles_humanos = (is_array($adicionles_humanos)) ? implode($adicionles_humanos) : '';
	$str_adicionles_vertebrados = (is_array($adicionles_vertebrados)) ? implode($adicionles_vertebrados) : '';
	$str_adicionles_biologicos = (is_array($adicionles_biologicos)) ? implode($adicionles_biologicos) : '';
	$str_adicionles_quimicos = (is_array($adicionles_quimicos)) ? implode($adicionles_quimicos) : '';
	
	//if (!strcmp($sCaptcha,$_SESSION['tmptxt'])==0) {echo " El campo captcha no conicide con la imagen";die();}
	
		
	$sql = "INSERT INTO solicitudes (nombre,titulo,reglas_protocolo,lista_revision,riesgos,areas_humanos,areas_biologicos,formatos_todos,adicionles_humanos,adicionles_vertebrados,adicionles_biologicos,adicionles_quimicos,status,fecha_registro)";
	$sql .= " VALUES ('$nombre','$titulo','$reglas_protocolo','$lista_revision','$riesgos','$areas_humanos','$str_areas_biologicos',";
	$sql .= " '$str_formatos_todos','$str_adicionles_humanos','$str_adicionles_vertebrados','$str_adicionles_biologicos','$str_adicionles_quimicos',1,'".date('Y-m-d')."')";
	
	mysql_query($sql);
	
	
	
	/***********************/
	#Mensaje administrador
	/***********************/
	/*
	$archivo = file_get_contents("templates/mensaje_administrador.html");
	$archivo = ucfirst($archivo);
	$archivo = nl2br($archivo);	
	
	$archivo = str_replace('[nombre]',$nombre,$archivo);
	$archivo = str_replace('[email]',$email,$archivo);
	$archivo = str_replace('[telefono]',$telefono,$archivo);
	$archivo = str_replace('[empresa]',$empresa,$archivo);
	$archivo = str_replace('[estado]',$estado,$archivo);
	$archivo = str_replace('[mensaje]',$mensaje,$archivo);
	
	$mail = new PHPMailer();		
	
	$mail->IsSMTP();
	$mail->Host       = 'mail.iacsa.com.mx';
	$mail->SMTPDebug  = 0;
	$mail->SMTPAuth   = true;		
	$mail->Port       = 587;
	$mail->Username   = 'auxiliarventas@iacsa.com.mx';
	$mail->Password   = 'auxiliarventas';
	$mail->SetFrom('auxiliarventas@iacsa.com.mx', 'IACSA');
	$mail->Subject    = 'Mensaje desde la forma de contacto de IACSA';
	$mail->AltBody    = 'Mensaje desde la forma de contacto de IACSA';
	$mail->MsgHTML($archivo);	
	$address = 'auxiliarventas@iacsa.com.mx';
	//$address = $email;	
	$mail->AddAddress($address, 'Forma de contacto de IACSA');
	$mail->Send();
	*/
	
	
	/***********************/
	#Mensaje autorrespuesta
	/***********************/
	
	$archivo = file_get_contents("templates/mensaje_autorespuesta.html");
	$archivo = ucfirst($archivo);
	$archivo = nl2br($archivo);	
	
	$mail = new PHPMailer();		
	
	$mail->IsSMTP();
	$mail->Host       = 'mail.iacsa.com.mx';
	$mail->SMTPDebug  = 0;
	$mail->SMTPAuth   = true;		
	$mail->Port       = 587;
	$mail->Username   = 'auxiliarventas@iacsa.com.mx';
	$mail->Password   = 'auxiliarventas';
	$mail->SetFrom('auxiliarventas@iacsa.com.mx', 'IACSA');
	$mail->Subject    = 'Mensaje desde la forma de contacto de IACSA';
	$mail->AltBody    = 'Mensaje desde la forma de contacto de IACSA';
	$mail->MsgHTML($archivo);	
	$address = $email;	
	$mail->AddAddress($address, 'Forma de contacto de IACSA');
	$mail->Send();
	
	exit; 

?>