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
		redirect("formato-1c.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato1c WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("formato-1c.php?mensaje=1");
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='formato-1b.php'">Todos los proyectos y para cada uno de los autores</span></div>
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
            <td width="35%"><strong>Autor/Líder del equipo:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['lider'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['proyecto'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>El estudiante, al realizar su investigación en este centro:</strong></td>
            <td class="Letra_negra_pequena">
				<?= ($registro['proyecto'] == 'equipo') ? 'Solo utilizó el equipo' : 'Colaboró en el diseño de experimentos.' ;?>
            </td>
        </tr>
        <tr>
            <td width="35%"><strong>¿Cómo obtuvo la idea el estudiante para su proyecto?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['idea'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>¿Estuvo Usted al tanto de las reglas del PIPCIJ antes de la experimentación?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['reglas'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>¿El trabajo del estudiante fue parte de una investigación grupal?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['grupal'] ;?></td>
        </tr>
        <?php if($registro['grupal'] == 'si'): ?>
        		<tr>
                    <td width="35%"><strong>En caso de ser afirmativo, ¿Qué tipo de grupo es/era? (escolar, investigadores adultos, etc.):</strong></td>
                    <td class="Letra_negra_pequena"><?= $registro['tipo_grupo'] ;?></td>
                </tr>
        <?php endif ?>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td width="35%"><strong>4. ¿Qué tipo de experimentos realizó el estudiante y qué tan independiente trabajó?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['tipo_experimento'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td colspan="5"><strong>Los proyectos que involucran sujetos humanos, animales vertebrados no humanos o agentes biológicos potencialmente peligrosos requieren de la revisión y aprobación de un Comité Regulatorio (CCR, CIR, CIUCA, CIBS). Debe anexar una copia de su aprobación.</strong></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>Nombre del Científico Calificado:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['cientifico'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Cargo:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['cargo'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Institución afiliada:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['institucion'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha del compromiso:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Dirección:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['direccion'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Teléfono:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['telefono'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Correo-e:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['email'] ;?></td>
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