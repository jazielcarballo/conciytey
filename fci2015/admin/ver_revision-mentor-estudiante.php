<?php session_start(); ?>
<?php include("../includes/configuracion.php"); ?>
<?php include("../includes/conexion.php"); ?>
<?php	 
	if (strlen($_SESSION["id_usuario"]) == 0)
	{
		redirect("index.php?notification=5");
	}
	
	$id = mysql_real_escape_string(trim(@$_GET['id']));

	if (strlen($id) == 0)
	{
		redirect("revision-mentor-estudiante.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato1a WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("revision-mentor-estudiante.php?mensaje=1");
	}
	
	$registro =mysql_fetch_array($o_query, MYSQL_ASSOC);
	
	$arr_biologicos = explode(',',$registro['areas_biologicos']);
	$arr_formatos_todos = explode(',',$registro['formatos_todos']);
	$arr_adicionles_humanos = explode(',',$registro['adicionles_humanos']);
	$arr_adicionles_vertebrados = explode(',',$registro['adicionles_vertebrados']);
	$arr_adicionles_biologicos = explode(',',$registro['adicionles_biologicos']);
	$arr_adicionles_quimicos = explode(',',$registro['adicionles_quimicos']);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="js/funciones.js"></script> 
<script src="js/mootools-1.2.4-core.js" type="text/javascript" charset="utf-8"></script>
<script src="js/mootools-1.2.4.4-more.js" type="text/javascript" charset="utf-8"></script>
<script src="js/main.js" type="text/javascript" charset="utf-8"></script>
<script src="js/MenuMatic_0.68.3.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8"> 
  window.addEvent('domready', function(){
	 var myMenu = new MenuMatic();
    JSClock();
  });
</script> 
<title>Administracion</title>
</head>
<body>

<div id="header"><?php include('inc_header.php'); ?></div>
<div id="menu"><?php include('inc_menu.php'); ?></div>
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='revision-mentor-estudiante.php'">Revision Mentor Estudiante</span> </div>
<div>
<div id="opciones" style="border:solid 10px #FFF"></div>
<div id="contenido">
<fieldset>
<legend class="Letra_negra"><b>Informaci&oacute;n</b></legend>
<form method="post" action="process/add_prospect.php" id="form" name="form">
    <table width="100%" class="Letra_negra_pequena">
        <tr>
            <td>&nbsp;</td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="65%"><strong>Registro:</strong></td>
            <td class="Letra_negra_pequena"><?= substr($registro['fecha_registro'],0,16) ;?></td>
        </tr>
        <tr>
            <td width="65%"><strong>Estudiante autor / L�der del Proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['lider'] ;?></td>
        </tr>
        <tr>
            <td><strong>T�tulo del Proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['titulo'] ;?></td>
        </tr>
        <tr>
            <td><strong>He revisado las Reglas del Protocolo y sus lineamientos:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['reglas_protocolo'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td><strong>He revisado la Lista de Revisi�n del Estudiante (1A) y el Plan de Investigaci�n:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['lista_revision'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td><strong>He trabajado con el (los) estudiante(s) y hemos discutido los posibles riesgos existentes en el proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['riesgos'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td colspan="2">
            	<strong>El proyecto involucra alguna de las siguientes �reas y requiere de aprobaci�n previa a la experimentaci�n:</strong>
           		<ul>
                	<li>Sujetos Humanos: <?= ($registro['areas_humanos'] == 1) ? 'Si' : 'No' ;?></li>
                    <li>
                    	Agentes biol�gicos potencialmente peligrosos
                        <ul>
                            <li>Microorganismos: <?= (in_array('Microorganismos',$arr_biologicos)) ? 'Si' : 'No' ;?></li>
                            <li>rADN: <?= (in_array('rADN',$arr_biologicos)) ? 'Si' : 'No' ;?></li>
                            <li>Tejidos: <?= (in_array('Tejidos',$arr_biologicos)) ? 'Si' : 'No' ;?></li>
                        </ul>
                    </li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            	<strong>Formatos que requieren TODOS LOS PROYECTOS:</strong>
                <ul>
                    <li>Revisi�n del Mentor (F1): <?= (in_array('F1',$arr_formatos_todos)) ? 'Si' : 'No' ;?></li>
                    <li>Formato de Aprobaci�n (F1B): <?= (in_array('F1B',$arr_formatos_todos)) ? 'Si' : 'No' ;?></li>
                    <li>Revisi�n del Estudiante (F1A): <?= (in_array('F1A',$arr_formatos_todos)) ? 'Si' : 'No' ;?></li>
                    <li>Instalaci�n Institucional (F1C)*: <?= (in_array('F1C',$arr_formatos_todos)) ? 'Si' : 'No' ;?></li>
                    <li>Plan de Investigaci�n: <?= (in_array('Plan',$arr_formatos_todos)) ? 'Si' : 'No' ;?></li>
                    <li>Formato de Continuaci�n (F7)*: <?= (in_array('F7',$arr_formatos_todos)) ? 'Si' : 'No' ;?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            	<strong>Formatos adicionales requeridas si aplican para el proyecto (cheque todas las que apliquen):</strong>
                <ul>
                	<li>
                    	Humanos (Requiere aprobaci�n previa por un Comit� Institucional de Revisi�n (CIR) Ver p�ginas 3-5)
                        <ul>
                        	<li>Sujetos Humanos (F4): <?= (in_array('F4',$arr_adicionles_humanos)) ? 'Si' : 'No' ;?></li>
                            <li>Cient�fico Calificado (F2) (Si aplica o es requerido por el CIR): <?= (in_array('F2',$arr_adicionles_humanos)) ? 'Si' : 'No' ;?></li>
                        </ul>
                    </li>
                    <li>
                    	Animales Vertebrados (Requiere aprobaci�n previa del CCR. Ver p�ginas 7-9)
                        <ul>
                        	<li>Formato para Animales Vertebrados (F5A) Para proyectos desarrollados en una instalaci�n no regulada: <?= (in_array('F5A',$arr_adicionles_vertebrados)) ? 'Si' : 'No' ;?></li>
                            <li>Formato para Animales Vertebrados (F5B) Para proyectos desarrollados en una Instituci�n de Investigaci�n Regulada (Requiere adem�s aprobaci�n previa a la experimentaci�n de un CIUCA): <?= (in_array('F5B',$arr_adicionles_vertebrados)) ? 'Si' : 'No' ;?></li>
                            <li>Formato de Cient�fico Calificado (F2): <?= (in_array('F2',$arr_adicionles_vertebrados)) ? 'Si' : 'No' ;?></li>
                        </ul>
                    </li>
                    <li>
                    	Agentes Biol�gicos Potencialmente Peligrosos (Requieren aprobaci�n previa del CCR, CIUCA o CIBS. Ver p�ginas 14-21)
                        <ul>
                        	<li>Formato de Agentes Biol�gicos Potencialmente Peligrosos (F6A): <?= (in_array('F6A',$arr_adicionles_biologicos)) ? 'Si' : 'No' ;?></li>
                        	<li>Formato de Tejidos de Animales Vertebrados Humanos y no Humanos (F6B) � a ser completados adem�s de la Formato 6A cuando el proyecto usa tejido fresco, cultivos celulares primarios, sangre o productos sangu�neos y fluidos corporales: <?= (in_array('F6B',$arr_adicionles_biologicos)) ? 'Si' : 'No' ;?></li>
                        	<li>Formato de Cient�fico Calificado (F2): <?= (in_array('F2',$arr_adicionles_biologicos)) ? 'Si' : 'No' ;?></li>
                            <li>Formato de Evaluaci�n de Riesgo (F3) Para los proyectos que involucran protistas, f�siles y microorganismos, esti�rcol para composta, materiales para producci�n de combustibles y otros similares: <?= (in_array('F3',$arr_adicionles_biologicos)) ? 'Si' : 'No' ;?></li>
                        </ul>
                    </li>
                    <li>
                    	Qu�micos, Actividades y Aparatos peligrosos (No se requiere aprobaci�n previa. Ver pp. 23-25)
                    	<ul>
                        	<li>Formato de Agentes Biol�gicos Potencialmente Peligrosos (F6A): <?= (in_array('F6A',$arr_adicionles_quimicos)) ? 'Si' : 'No' ;?></li>
                            <li>Formato de Evaluaci�n de Riesgos (F3): <?= (in_array('F3',$arr_adicionles_quimicos)) ? 'Si' : 'No' ;?></li>
                            <li>Formato de Cient�fico Calificado (F2) (Requerido para proyectos que usen Sustancias Controladas): <?= (in_array('F2',$arr_adicionles_quimicos)) ? 'Si' : 'No' ;?></li>
                        </ul>
                    </li>
                </ul>
            </td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>    
    </table>
</form>
</fieldset>
</div>
<div id="paginador"></div>
</div>
</body>
</html>