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
		redirect("forma-5a.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato_5a WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("forma-5a.php?mensaje=1");
	}
	
	$registro =mysql_fetch_array($o_query, MYSQL_ASSOC);
	
	$query ="SELECT * FROM formato_5a_especies WHERE id_5a = '$id' ORDER BY posicion ASC";
	$o_query = mysql_query($query); 
	
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='forma-5a.php'">Todos los proyectos que involucran animales vertebrados en una institución no registrada/regulada</span></div>
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
            <td colspan="2"><strong>Para ser completado por el estudiante (todas las preguntas son aplicables y deben contestarse)</strong></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Género, especie, nombre común y número de los animales usados. (Usa una forma para cada especie usada):</strong></td>
        </tr>
        <?php while($row = mysql_fetch_array($o_query)): ?>
                <tr>
                    <td colspan="2">
                    	
                        <ul>
                        	<li style="list-style:none;">1.<strong><?= $row['posicion'] ;?></strong></li>
                        	<li>Género: <?= $row['genero'] ;?></li>
                            <li>Especie: <?= $row['especie'] ;?></li>
                            <li>Nombre común: <?= $row['nombre'] ;?></li>
                            <li># de animales: <?= $row['numero'] ;?></li>
                        </ul>
                    </td>
                </tr>
        <?php endwhile?>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%"><strong>2. Describe completamente el alojamiento y manutención de los animales. Incluye las condiciones de jaula o albergue; número de animales en cada uno (a), ambiente, cama, tipo de comida y agua, frecuencia de alimentación, frecuencia de observación, etc.:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['alojamiento'] ;?></td>
        </tr>
        <tr>
            <td width="35%"><strong>3. ¿Qué pasará con los animales después de los experimentos?:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['despues'] ;?></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Permiso:</strong> 
            	<a href="../archivos/forma-5a/<?= $registro['permiso'] ;?>" target="_blank" style="color:#00F"> Ver </a>
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