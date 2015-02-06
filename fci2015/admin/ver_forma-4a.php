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
		redirect("forma-4a.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato_4a WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("forma-4a.php?mensaje=1");
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='forma-4a.php'">Consentimiento Humano Informado</span></div>
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
            <td colspan="2"><strong>Estoy solicitando tu participación voluntaria en mi proyecto de investigación para una Feria de Ciencias. Favor de leer la siguiente información. Si deseas participar, favor de firmar en el espacio correspondiente de abajo.</strong></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>4. Mentor:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['mentor'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Correo electrónico:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['email'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Propósito del proyecto:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['proposito'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Si participas, se te pedirá que:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['participas'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Tiempo requerido de participación:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['tiempo'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Riesgos potenciales del estudio:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['riesgos'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Beneficios:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['beneficios'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Como se mantendrá la confidencialidad:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['confidencialidad'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Como se mantendrá la confidencialidad:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['confidencialidad'] ;?></td>
        </tr>
         <tr>
            <td colspan="2"><strong>Para resolver dudas acerca de este proyecto, contacta a:</strong></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>Mentor:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['dudas_mentor'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Teléfono:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['dudas_telefono'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Correo-e:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['dudas_email'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>Nombre del Padre o Guardián:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['dudas_padre'] ;?></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Permiso:</strong> 
            	<a href="../archivos/forma-4a/<?= $registro['permiso'] ;?>" target="_blank" style="color:#00F"> Ver </a>
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