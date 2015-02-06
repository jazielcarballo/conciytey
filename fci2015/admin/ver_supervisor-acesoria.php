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
		redirect("supervisor-acesoria.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato_supervisor_asesoria WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("supervisor-acesoria.php?mensaje=1");
	}
	
	$registro =mysql_fetch_array($o_query, MYSQL_ASSOC);
	
	
	
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='supervisor-acesoria.php'">Requerido si el científico calificado como asesor no está disponible para supervisar el experimento</span></div>
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
            <td width="35%"><strong>Expocientífico:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['expocientifico'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Título del Proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['proyecto'] ;?></td>
        </tr>
 		<tr>
            <td><strong>Liste/Identifique los químicos, actividades o equipo que será utilizado:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['quimicos'] ;?></td>
        </tr>
 		<tr>
            <td><strong>Identifique y evalúe los riesgos potenciales:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['riesgos'] ;?></td>
        </tr>
        <tr>
            <td><strong>Describa las medidas de seguridad y procedimientos a utilizar para reducir los riesgos:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['seguridad'] ;?></td>
        </tr>
 		<tr>
            <td><strong>Describa los procedimientos a utilizar para disponer de los desechos (si es el caso):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['procedimientos'] ;?></td>
        </tr>
 		<tr>
            <td><strong>Liste las fuentes de información de seguridad:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fuentes'] ;?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Para completar por el Supervisor /Científico Calificado:</strong>
				<br>
				Concuerdo con la evaluación de riesgos y programa de precauciones descritas anteriormente. Certifico que he revisado el Plan de Investigación y proveeré supervisión/capacitación directa.
            </td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
 		<tr>
            <td><strong>Nombre impreso del Supervisor:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['supervisor'] ;?></td>
        </tr>
 		<tr>
            <td><strong>Puesto e Institución:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['puesto'] ;?></td>
        </tr>
        <tr>
            <td><strong>Teléfono:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['telefono'] ;?></td>
        </tr>
        <tr>
            <td><strong>Correo electrónico:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['email'] ;?></td>
        </tr>
        <tr>
            <td><strong>Fecha del compromiso:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_compromiso'] ;?></td>
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