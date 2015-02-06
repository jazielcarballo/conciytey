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
		redirect("investigacion-con-humanos.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato_investigacion_con_humanos WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("investigacion-con-humanos.php?mensaje=1");
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='investigacion-con-humanos.php'">Todos los proyectos que involucran humanos</span></div>
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
            <td colspan="2"><strong>Para ser completado por el estudiante en colaboración con el Supervisor /Científico Calificado</strong> (Todas las preguntas son aplicables y deben contestarse. Pueden anexarse más hojas):</td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>1) Describe el propósito de esta investigación y lista todos los procedimientos en los que el sujeto estará implicado. Incluye la duración de su participación. Anexa encuestas y cuestionarios a utilizar:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['proposito'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>2) Describe y evalúa cualquier riesgo potencial o incomodidad, así como posibles beneficios (físico, psicológico, social, legal, etc.) que se esperen por su participación en este proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['riesgos'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>3) Describe los procedimientos que serán utilizados para minimizar el riesgo, para obtener su consentimiento y para mantener la confidencialidad:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['procedimientos'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Para resolver dudas acerca de este proyecto, contactar a:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['contacto_estudiante'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Para resolver dudas acerca de este proyecto, contactar a:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['contacto_mentor'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong> Para ser contestado por el CIR antes del desarrollo del proyecto.</strong><br>

				Determinación del riesgo, incluyendo riesgos físicos y psicológicos (Ver Reglas del PIPCIJ, Evaluación del Riesgo, página 5) de las Reglas Generales para los Proyectos participantes en las etapas Clasificatoria y Nacional.
				<br>
				Elija solo aquella que describa el riesgo apropiadamente.
             </td>
        </tr>
        <tr>
            <td colspan="2" class="Letra_negra_pequena">
				<?php 
					switch($registro['nivel_riesgo']){
						case 'recomendado':
							echo 'Mínimo riesgo donde el consentimiento informado es recomendado, pero no  obligatorio.';
							break;
						case 'obligatorio':
							echo 'Mínimo riesgo donde el consentimiento informado es OBLIGATORIO.';
							break;
						case 'cientifico_calificado':
							echo 'Más que mínimo riesgo: se requiere consentimiento informado y Científico Calificado';
							break;
							
					}
				?>
             </td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong> Firmas del CIR (Un mínimo de tres firmas es requerido).</strong></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>1) Médico profesionista (psicólogo, psiquiatra, médico, asistente físico, trabajador(a) social con licencia o enfermera certificada; marque uno) Nombre:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['medico'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha de aprobación:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_medico'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>2) Profesor de CienciasNombre:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['profesor'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha de aprobación:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_profesor'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>3) Administrador escolar Nombre:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['administrador'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha de aprobación:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_administrador'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Para completar por el Sujeto Humano (Antes de las pruebas):</strong></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>He leído y entiendo las condiciones y acepto voluntariamente participar en este estudio como sujeto de investigación:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['condiciones_humano'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Me doy cuenta y soy libre de retirarme de este estudio sin represalias de cualquier clase:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['libre_humano'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Apruebo el uso de imágenes (fotos, videos, etc.) que muestren mi participación en este proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['imagenes_humano'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Nombre:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['nombre_humano'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_humano'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Para completar por el Padre/Tutor (Antes de las pruebas y cuando el participante es menor de 18 años):</strong></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>He leído y entiendo las condiciones y riesgos establecidos por el proyecto y acepto la participación de mi hijo/protegido:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['condiciones_padre'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>He revisado una copia de los cuestionarios y encuestas que se usarán en la investigación:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['cuestionarios_padre'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Apruebo el uso de imágenes (fotos, videos, etc.) involucrando a mi hijo/protegido en este proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= ($registro['imagenes_padre'] == 1) ? 'Si' : 'No' ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Nombre:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['nombre_padre'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Fecha:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_padre'] ;?></td>
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