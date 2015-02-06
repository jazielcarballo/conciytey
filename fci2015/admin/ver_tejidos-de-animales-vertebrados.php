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
		redirect("tejidos-de-animales-vertebrados.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato_tejidos_de_animales_vertebrados WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("tejidos-de-animales-vertebrados.php?mensaje=1");
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='tejidos-de-animales-vertebrados.php'">Todos los proyectos que usan tejido fresco, incluyendo sangre, productos sanguíneos, cultivos celulares primarios y fluidos corporales</span></div>
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
            <td colspan="2"><strong>Para ser completado por el estudiante</strong>:</td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>1) ¿Qué tipo de tejido(s), órgano(s) o parte(s) serán usados?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['tejido_tipo'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>2) ¿De dónde será obtenido el tejido, órgano, o parte? (identifica cada uno por separado):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['tejido_de'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>3) Si va a ser obtenido de una fuente animal viva o de una fuente en una institución registrada, proporcione información acerca del estudio del cual el tejido es obtenido. Incluye el nombre de la Institución de Investigación, el título del estudio, el número y fecha de aprobación del CIUCA:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['tejido_institucion'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td colspan="2"><strong>Para ser completado por el Científico Calificado o el Supervisor</strong>:</td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>Verificaré que el (los) estudiante(s) trabajen solamente con órganos, tejidos, cultivos o células que serán proporcionados por mí o personal calificado del laboratorio; y si los animales vertebrados fueran eutanatizados sería por/para propósitos diferentes a la presente investigación del (los) estudiante (s):</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['supervisor_verifico'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Certifico que los tejidos y fluidos usados en este proyecto serán manejados de acuerdo con los estándares y guías expuestas conforme a las leyes locales y federales de la Secretaría de Salud así como al "Occupational Safety and Health, 29CFR, Subparte Z, 1910.1030 – Blood Borne Pathogens":</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['supervisor_certifico'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Nombre impreso:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['supervisor'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha(ABRIL-MAYO):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_supervisor'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Título del Supervisor:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['titulo_supervisor'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Institución:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['Institucion_supervisor'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Teléfono:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['telefono_supervisor'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Correo-e:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['email_supervisor'] ;?></td>
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