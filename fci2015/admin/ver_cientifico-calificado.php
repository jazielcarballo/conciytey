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
		redirect("cientifico-calificado.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato_cientifico_calificado WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("cientifico-calificado.php?mensaje=1");
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='cientifico-calificado.php'">Proyectos que involucren ADN, tejidos y humanos</span></div>
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
            <td width="35%"><strong>Estudiante autor / Líder del Proyecto:</strong></td>
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
            <td colspan="2"><strong>Para ser completado por el Científico Calificado (deberá ser del área de estudios del proyecto del estudiante)</strong></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <?php if(strlen($registro['maestrias']) > 0): ?>
        <tr>
            <td width="35%"><strong>Maestría (Área):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['maestrias'] ;?></td>
        </tr>
        <?php endif ?>
        <?php if(strlen($registro['doctorado']) > 0): ?>
        <tr>
            <td width="35%"><strong>Doctorado (Área):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['doctorado'] ;?></td>
        </tr>
        <?php endif ?>
        <tr>
            <td width="35%"><strong>Puesto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['puesto'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Institución:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['institucion'] ;?></td>
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
            <td width="35%"><strong>Correo electrónico:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['email'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>¿Está Usted enterado de las reglas del PIPCIJ?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['enterado'] ;?></td>
        </tr>
        <tr>
            <td colspan="2">
            	<strong>¿Algo de lo siguiente será utilizado?:</strong>
                <ul>
                	<li>Sujetos Humanos: <?= $registro['humanos'] ;?></li>
                    <li>Animales Vertebrados: <?= $registro['vertebrados'] ;?></li>
                    <li>Agentes biológicos potencialmente peligrosos (microorganismos, rADN y tejidos, incluyendo sangre y sus subproductos): <?= $registro['biologicos'] ;?></li>
                    <li>Sustancias controladas (alcohol, tabaco, anfetaminas, drogas generales): <?= $registro['sustancias'] ;?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td width="35%"><strong>¿Usted supervisará directamente al (los) estudiante(s)?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['supervisar'] ;?></td>
        </tr>
        <?php if($registro['supervisar'] == 'no'): ?>
        <tr>
            <td width="35%"><strong>a) Si no, ¿Quién fungirá como Supervisor Designado?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['designado'] ;?></td>
        </tr>
        <?php endif ?>
        <tr>
            <td width="35%"><strong>b) Mencione la experiencia o entrenamiento con que cuenta dicha persona:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['designado_experiencia'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>4) Describa las precauciones y el entrenamiento que se tomarán para este proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['precauciones'] ;?></td>
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