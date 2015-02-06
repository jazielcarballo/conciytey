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
		redirect("agentes-biologicos.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato_agentes_biologicos WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("agentes-biologicos.php?mensaje=1");
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='agentes-biologicos.php'">Todos los proyectos que involucran microorganismos, rADN, tejido fresco, sangre y/o fluidos corporales</span></div>
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
            <td colspan="2"><strong>Para ser completado por el estudiante en colaboración del Científico Calificado/Supervisor</strong><br> (todas las preguntas deben contestarse y son aplicables. Pueden anexarse páginas adicionales):</td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>1) Identifica los agentes biológicos potencialmente peligrosos a usar en este proyecto. Incluye la fuente, cantidad y nivel de bioseguridad de cada microorganism:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['biologicos'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>2) Describe el lugar de la experimentación incluyendo el nivel de confinamiento biológico:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['lugar'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>3) Describe el método de desecho de todos los materiales cultivados y otros agentes biológicos potencialmente peligrosos:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['metodo_desecho'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>4) Describe los procedimientos que se usarán para minimizar los riesgos (equipo de protección, tipo de capucha, etc.):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['procedimiento_riesgos'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>5) ¿Qué nivel de bioseguridad final recomiendas para este proyecto, dado el diagnóstico de riesgo que observaste?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['seguridad'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td colspan="2"><strong>Para ser completado por el Científico Calificado o el Supervisor</strong><br> (todas las preguntas deben contestarse y son aplicables. Pueden anexarse páginas adicionales):</td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>1) ¿Qué entrenamiento recibió (recibieron) el (los) estudiante (s) para este proyecto?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['entrenamiento'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>2) ¿Está de acuerdo con la información de bioseguridad y recomendaciones dadas arriba por el (los) estudiante (s) investigador (es)?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['acuerdo_recomendaciones'] ;?></td>
        </tr>
        <?php if($registro['acuerdo_recomendaciones'] == 'no') : ?>
                <tr>
                    <td width="35%"><strong>Si contestó que no, explique:</strong></td>
                    <td class="Letra_negra_pequena"><?= $registro['acuerdo_recomendaciones_exp'] ;?></td>
                </tr>
        <?php endif; ?>
        <tr>
            <td width="35%"><strong>Nombre impreso del Supervisor:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['supervisor1'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha de firma (ABRIL-MAYO):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_supervisor1'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td colspan="2"><strong>A completar por el CCR antes de la experimentación en un laboratorio NBS-1</strong>:</td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>El CCR ha estudiado cuidadosamente el Plan de Investigación y la evaluación de riesgo de este proyecto, por lo que aprueba este estudio como de nivel de bioseguridad 1, el cual debe conducirse en un laboratorio categoría NBS-1 o superior:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['NBS1'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>El CCR ha estudiado cuidadosamente el Plan de Investigación y la evaluación de riesgo de este proyecto, por lo que aprueba este estudio como de nivel de bioseguridad 2, el cual debe conducirse en un laboratorio categoría NBS-2 o superior:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['NBS2'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Nombre impreso del Supervisor:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['supervisor2'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha de firma (ABRIL-MAYO):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_supervisor2'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td colspan="2"><strong>A completar por el CCR después de la experimentación en un laboratorio NBS-2 o superior con pre-aprobación institucional</strong>:</td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>Este proyecto fue revisado y aprobado por el comité institucional apropiado (RAC, CIUCA, CIBS) antes de la experimentación en un laboratorio NBS-2 o superior y cumple con las reglas de Intel ISEF. Las formas institucionales requeridas se anexan:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['aprovado_comite'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Nombre impreso del Supervisor:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['supervisor3'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha de firma (ABRIL-MAYO):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_supervisor3'] ;?></td>
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