<?php session_start(); ?>
<?php include("../includes/configuracion.php"); ?>
<?php include("../includes/conexion.php"); ?>
<?php
 
	if (strlen($_SESSION["id_usuario"]) == 0)
	{
		redirect("index.php?iMessage=5");
	}
	/*
	$query =  "SELECT COUNT(id) mensajes FROM contacto";
	$o_query = mysql_query($query);
	$mensajes = mysql_fetch_object($o_query)->mensajes;
	
	$query =  "SELECT COUNT(id) mensajes FROM contacto WHERE leido = '0'";
	$o_query = mysql_query($query);
	$mensajes_sin_leer = mysql_fetch_object($o_query)->mensajes;
	*/	
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

    <div id="header"><?php include("inc_header.php"); ?></div>
    <?php include("inc_menu.php"); ?>
    <div id="titulo_seccion">Inicio</div>
    <div id="imagen_inicio"><img src="images/img_inicio.jpg" alt="Siempre es un placer atenderte" width="520" height="380" title="Siempre es un placer atenderte"></div>
    <div id="resumen">
        <fieldset id="fieldset">
        	<legend id="legend"><img src="images/report.png" width="16" height="16" alt="Resumen" border="0" /> Resumen</legend>
        	<!--<div class="resumen_col">Mensajes:</div>
            <div class="resumen_col"><b><?php echo $mensajes; ?></b></div>
            <div class="resumen_col">Mensajes sin leer:</div>
            <div class="resumen_col"><b><?php echo $mensajes_sin_leer; ?></b></div>-->
            <div class="resumen_col">Último Login:</div>
            <div class="resumen_col"><b><?php echo substr(@$_SESSION["fecha_acceso"],0,16); ?></b></div>
            <div class="resumen_col">Dirección de entrada:</div>
            <div class="resumen_col"><b><?php echo @$_SESSION["ip_acceso"]; ?></b></div>
        </fieldset>
        
        <!--
        <fieldset class="Letra_negra_pequena" id="fieldset">
            <legend id="legend"><img src="images/rss.png" width="16" height="16" alt="Ultimas noticias" border="0" /> Ultimas noticias</legend>
        -->    
            <!--#include file="rss.asp"-->
        <!--</fieldset>-->
    </div>

</body>
</html>