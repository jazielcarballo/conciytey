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
		redirect("revision-estudiante.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato1a_individual WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("revision-estudiante.php?mensaje=1");
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='revision-estudiante.php'">Revision Estudiante</span></div>
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
            <td><strong>Estudiante autor / Líder del Proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['lider'] ;?></td>
        </tr>
        <tr>
            <td><strong>Título del Proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['proyecto'] ;?></td>
        </tr>
        <tr>
            <td><strong>Grado:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['grado'] ;?></td>
        </tr>
        <tr>
            <td><strong>Correo electrónico:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['email'] ;?></td>
        </tr>
        <tr>
            <td><strong>Teléfono:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['telefono'] ;?></td>
        </tr>
        <tr>
            <td><strong>b) Segundo miembro del equipo:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['segundo_nombre'] ;?></td>
        </tr>
        <tr>
            <td><strong>Grado:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['segundo_grado'] ;?></td>
        </tr>
        <tr>
            <td><strong>Correo electrónico:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['segundo_email'] ;?></td>
        </tr>
        <tr>
            <td><strong>Teléfono:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['segundo_telefono'] ;?></td>
        </tr>
        <tr>
            <td><strong>c) Tercer miembro del equipo:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['tercero_nombre'] ;?></td>
        </tr>
        <tr>
            <td><strong>Grado:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['tercero_grado'] ;?></td>
        </tr>
        <tr>
            <td><strong>Correo electrónico:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['tercero_email'] ;?></td>
        </tr>
        <tr>
            <td><strong>Teléfono:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['tercero_telefono'] ;?></td>
        </tr>
        <tr>
            <td><strong>Escuela:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['escuela'] ;?></td>
        </tr>
        <tr>
            <td><strong>Dirección:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['escuela_direccion'] ;?></td>
        </tr>
        <tr>
            <td><strong>Teléfono:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['escuela_telefono'] ;?></td>
        </tr>
        <tr>
            <td><strong>Mentor:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['mentor'] ;?></td>
        </tr>
        <tr>
            <td><strong>Correo electrónico:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['mentor_email'] ;?></td>
        </tr>
        
        <tr>
            <td colspan="2">
            	<strong>¿El proyecto es continuación de año(s) pasado(s)?</strong>
           		<ul>
                	<?php 
						if($registro['continuacion'] == 'si'): 
							
							$arr_formatos = explode(',',$registro['continuacion_si']);
					?>
                            <li>Sí. Anexamos del 2011:
                                <ul>
                                    <li>FOLIO: <?= (in_array('folio',$arr_formatos)) ? 'Si' : 'No' ;?></li>
                                    <li>Formato 1A: <?= (in_array('folio1A',$arr_formatos)) ? 'Si' : 'No' ;?></li>
                                    <li>Plan de Investigación: <?= (in_array('plan',$arr_formatos)) ? 'Si' : 'No' ;?></li>
                                </ul>
                            </li>
                    <?php elseif($registro['continuacion'] == 'F7'): ?>
                    		<li>Formato 7, donde explico (amos) por qué es novedoso y diferente al del año pasado.</li>
                    <?php elseif($registro['continuacion'] == 'no'): ?>
                    		<li>No</li>
                    <?php endif ?>
                </ul>
            </td>
        </tr>
        <tr>
            <td><strong>a)Fecha de inicio de documentación y experimentación del ciclo actual (dd/mm/aa):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_inicio'] ;?></td>
        </tr>
        <tr>
            <td><strong>b)Fecha de finalización de documentación y experimentación del ciclo actual (dd/mm/aa):</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_fin'] ;?></td>
        </tr>
        <tr>
            <td colspan="2">
            	<strong>Lugar donde se desarrolla/desarrollará el proyecto (marcar las que apliquen):</strong>
                <?php $arr_lugar = explode(',',$registro['lugar']); ?>
                
                <ul>
                    <li>Centro de Investigación: <?= (in_array('centro',$arr_lugar)) ? 'Si' : 'No' ;?></li>
                    <li>Investigación de campo: <?= (in_array('campo',$arr_lugar)) ? 'Si' : 'No' ;?></li>
                    <li>Escuela: <?= (in_array('escuela',$arr_lugar)) ? 'Si' : 'No' ;?></li>
                    <li>Domicilio: <?= (in_array('domicilio',$arr_lugar)) ? 'Si' : 'No' ;?></li>
                    <li>Otro: <?= (in_array('otro',$arr_lugar)) ? $registro['lugar_otro'] : '--' ;?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            	<strong>Nombre, dirección y teléfonos del (los) anterior (es):</strong>
                <ul>
                    <li>Nombre: <?= $registro['anterior_nombre'] ;?></li>
                    <li>Dirección: <?= $registro['anterior_direccion'] ;?></li>
                    <li>Teléfonos: <?= $registro['anterior_telefono'] ;?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2"><strong>Plan de investigación:</strong> 
            	<a href="../archivos/revision-estudiante/<?= $registro['archivo'] ;?>" target="_blank" style="color:#00F"> Ver </a>
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