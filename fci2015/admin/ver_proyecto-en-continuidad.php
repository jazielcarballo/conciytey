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
		redirect("proyecto-en-continuidad.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato_proyecto_en_continuidad WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("proyecto-en-continuidad.php?mensaje=1");
	}
	
	$registro =mysql_fetch_array($o_query, MYSQL_ASSOC);
	
	//echo $query;
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='proyecto-en-continuidad.php'">Requerido si continúan dentro del mismo campo de estudio que el año anterior</span></div>
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
            <td width="35%"><strong>Registro:</strong></td>
            <td class="Letra_negra_pequena"><?= substr($registro['fecha_registro'],0,16) ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Autor/Líder del Proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['lider'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Título del Proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['proyecto'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td colspan="2"><strong>Para ser completado por el Expocientífico.</strong><br> Enlista todos los componentes del proyecto actual que lo hagan nuevo y diferente del de año(s) anterior(es) Usa un formato adicional si tienes antecedentes del año 2009:</td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
 		<tr>
        	<td colspan="2">
            	
            	<ul>
                	<li><strong>Título Proyecto actual:</strong> <?= $registro['titulo_actual'] ;?></li>
                    <li><strong>Objetivos Proyecto actual:</strong> <?= $registro['objetivos_actual'] ;?></li>
                    <li><strong>Variables estudiadas Proyecto actual:</strong> <?= $registro['variables_actual'] ;?></li>
                    <li><strong>Línea de investigación Proyecto actual:</strong> <?= $registro['investigacion_actual'] ;?></li>
                    <li><strong>Cambios adicionales Proyecto actual:</strong> <?= $registro['cambios_actual'] ;?></li>
                </ul>
                
                <ul>
                	<li><strong>Título Proyecto de Investigación anterior:</strong> <?= $registro['titulo_anterior'] ;?></li>
                    <li><strong>Objetivos Proyecto de Investigación anterior:</strong> <?= $registro['objetivos_anterior'] ;?></li>
                    <li><strong>Variables estudiadas Proyecto de Investigación anterior:</strong> <?= $registro['variables_anterior'] ;?></li>
                    <li><strong>Línea de investigación Proyecto de Investigación anterior:</strong> <?= $registro['investigacion_anterior'] ;?></li>
                    <li><strong>Cambios adicionales Proyecto de Investigación anterior:</strong> <?= $registro['cambios_anterior'] ;?></li>
                </ul>
                
                <ul>
                	<li><strong>Título Proyecto de Investigación anterior:</strong> <?= $registro['titulo_anterior2'] ;?></li>
                    <li><strong>Objetivos Proyecto de Investigación anterior:</strong> <?= $registro['objetivos_anterior2'] ;?></li>
                    <li><strong>Variables estudiadas Proyecto de Investigación anterior:</strong> <?= $registro['variables_anterior2'] ;?></li>
                    <li><strong>Línea de investigación Proyecto de Investigación anterior:</strong> <?= $registro['investigacion_anterior2'] ;?></li>
                    <li><strong>Cambios adicionales Proyecto de Investigación anterior:</strong> <?= $registro['cambios_anterior2'] ;?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td colspan="2"><strong>Este formato debe mostrarse en tu stand para ayudar a los jueces a comprender mejor tu trabajo y lo que se hizo en el presente año.</strong><br> 
            Por la presente, declaro que la información anterior es correcta; que el RENPE o FOLIO y el proyecto expuesto reflejan adecuadamente el trabajo realizado durante el año.</td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>Estudiante autor/Líder del Proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['lider_informacion'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_informacion'] ;?></td>
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