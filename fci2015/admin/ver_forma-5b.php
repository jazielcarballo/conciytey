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
		redirect("forma-5b.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato_5b WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("forma-5b.php?mensaje=1");
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='forma-5b.php'">Todos los proyectos realizados en instituciones de investigación registradas u oficiales</span></div>
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
            <td width="35%"><strong>Título y número del Protocolo de Proyecto Aprobado del CIUCA:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['protocolo'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong>A ser completado por el Científico Calificado o Director del Instituto/Laboratorio:</strong></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td width="35%"><strong>1. ¿Es ésta una idea original del estudiante o es un proyecto adjunto suyo?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['idea'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>2. ¿Está usted al tanto de las reglas del PIPCIJ relativas a este proyecto?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['reglas'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>3. ¿Qué tipo de capacitación (incluir fechas) le fue proporcionada al (los) estudiante (s)?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['capacitacion'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>4. Especies de animales usadas:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['especies'] ;?></td>
        </tr>
        
        <tr>
            <td width="35%"><strong>Número de animales usados:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['numero_animales'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>5. Categoría de permisividad de dolor designada para este estudio (Ver tabla de categorías USDA, pagina 13 de las Reglas Generales para los Proyectos participantes en las etapas Clasificatoria y Nacional):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['dolor'] ;?></td>
        </tr>
        
        <tr>
            <td width="35%"><strong>Describa, en detalle, el rol del (los) estudiante (s) en este proyecto: procedimientos y equipo con que estará (n) involucrado (s); la supervisión que se le (s) dará y las medidas de precaución consideradas. (Puede anexar páginas extra, si lo considera necesario):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['rol'] ;?></td>
        </tr>
        
        <tr>
            <td colspan="2"><strong>Permiso:</strong> 
            	<a href="../archivos/forma-5b/<?= $registro['aprobacion'] ;?>" target="_blank" style="color:#00F"> Ver </a>
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