<?php session_start(); ?>
<?php include("../includes/configuracion.php"); ?>
<?php include("../includes/conexion.php"); ?>
<?php	 
	if (strlen($_SESSION["id_usuario"]) == 0)
	{
		redirect("index.php?notification=5");
	}
	
	/*$id = mysql_real_escape_string(trim(@$_GET['id']));

	if (strlen($id) == 0)
	{
		redirect("formato-fipi.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato_fipi WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("formato-fipi.php?mensaje=1");
	}
	
	$registro =mysql_fetch_array($o_query, MYSQL_ASSOC);
	
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

<div id="header"><?php include('inc_header.php'); ?></div>
<div id="menu"><?php include('inc_menu.php'); ?></div>
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='formato-fipi.php'">FORMATO DE INSCRIPCI&Oacute;N DE PROYECTOS DE INVESTIGACI&Oacute;N (FIPI)</span></div>
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
            <td width="25%"><strong>Registro:</strong></td>
            <td class="Letra_negra_pequena">--<?//= substr($registro['fecha_registro'],0,16) ;?></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Clave:</strong></td>
            <td class="Letra_negra_pequena">--</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Nombre del Proyecto:</strong></td>
            <td class="Letra_negra_pequena">--</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Estudiante 1:</strong></td>
            <td class="Letra_negra_pequena">
            	--
                <strong style="margin-left:30px;">Fecha de nacimiento: --</strong>
            </td>
        </tr>
        <tr>
            <td><strong>Estudiante 2:</strong></td>
            <td class="Letra_negra_pequena">
            	--
                <strong style="margin-left:30px;">Fecha de nacimiento: --</strong>
            </td>
        </tr>
        <tr>
            <td><strong>Estudiante 3:</strong></td>
            <td class="Letra_negra_pequena">
            	--
                <strong style="margin-left:30px;">Fecha de nacimiento: --</strong>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Institución:</strong></td>
            <td class="Letra_negra_pequena">--</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Grado:</strong></td>
            <td class="Letra_negra_pequena">--</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Localidad:</strong></td>
            <td class="Letra_negra_pequena">--</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Estado:</strong></td>
            <td class="Letra_negra_pequena">--</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Correo-e:</strong></td>
            <td class="Letra_negra_pequena">--</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Asesor:</strong></td>
            <td class="Letra_negra_pequena">
            	--
                <strong style="margin-left:30px;">Fecha de nacimiento: --</strong>
            </td>
        </tr>
        
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:10px;"><strong>* Aplica sólo en casos de proyectos por equipo.</strong></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Área del Proyecto:</strong></td>
            <td class="Letra_negra_pequena">--</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
            	<strong>Resumen del proyecto </strong>(Marco teórico, definición del problema, objetivos, métodos y materiales a utilizar, resultados esperados) <br> R. </strong>--
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
            	<strong>1) Como parte del proyecto el estudiante usará, manipulará o interactuará con: (seleccione aquellas que apliquen):</strong>
                <ul>
                	<li>Animales vertebrados no humanos.</li>
                    <li>Sustancias controladas.</li>
                    <li>Participantes Humanos.</li>
                    <li>Agentes biológicos potencialmente peligrosos.</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
            	<strong>2) El estudiante diseñó independientemente todos los procedimientos listados en el resumen: <br> R. </strong>--
            	
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong>3) El proyecto pertenece, perteneció o fue elaborado por un instituto de investigación científica: <br> R. </strong>-- </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong>4) Es un proyecto que continúa de otro anterior: <br> R. </strong>-- </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:10px;">Manifiesto/manifestamos que los datos presentados son correctos y verídicos, que la información brindada es producto de mi/nuestra investigación y refleja el trabajo realizado/a realizar en el último año.</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Nombre del estudiante o líder del proyecto:</strong></td>
            <td class="Letra_negra_pequena">--</td>
        </tr>
        <tr>
            <td><strong>Fecha:</strong></td>
            <td class="Letra_negra_pequena">--</td>
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