<?php session_start(); ?>
<?php include("../includes/configuracion.php"); ?>
<?php include("../includes/conexion.php"); ?>
<?php
	
	if (strlen($_SESSION["id_usuario"]) == 0)
	{
		redirect("index.php?iMessage=5");
	}
	
	$mensaje = mysql_real_escape_string(trim(@$_GET['mensaje']));
	$mensaje = validateint($mensaje);
	
	//--------------------------------------------------------------
	switch ($mensaje) 
	{ 
		case 1: $mensaje = "Se guardó el archivo correctamente."; break;
		case 2: $mensaje = "Solo se permiten archivos en formatro pdf."; break;
		case 3: $mensaje = "El tamaño del archivo es demasiado grande."; break;
		default: $mensaje = ""; break;		
	} 
	//--------------------------------------------------------------
	
	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="css/formcheck/theme/classic/formcheck.css" type="text/css" media="screen" title="no title" charset="utf-8" />

<link rel="stylesheet" href="css/slimpicker.css" media="screen, projection" />

<script type="text/javascript" src="js/funciones.js"></script> 
<script src="js/mootools-1.2.4-core.js" type="text/javascript" charset="utf-8"></script>
<script src="js/mootools-1.2.4.4-more.js" type="text/javascript" charset="utf-8"></script>
<script src="js/formcheck/lang/es.js" type="text/javascript" charset="utf-8"></script>
<script src="js/formcheck/formcheck.js" type="text/javascript" charset="utf-8"></script>
<script src="js/main.js" type="text/javascript" charset="utf-8"></script>
<script src="js/MenuMatic_0.68.3.js" type="text/javascript" charset="utf-8"></script>

<script src="js/slimpicker.js"></script>

<script type="text/javascript" charset="utf-8"> 
  window.addEvent('domready', function(){
	 var myMenu = new MenuMatic();
	 new FormCheck('noticia');
    JSClock();
  });
  
</script> 
<title>Administracion</title>
</head>
<body>
<div id="header"><?php include("inc_header.php"); ?></div>
<?php include("inc_menu.php"); ?>
<!--<div id="titulo_seccion">Noticias &gt;&gt; Agregar</div>-->
<br>
<div id="contenido">

<?php if (strlen(@$mensaje)>0): ?>
    <div class="info">
    <center>
    	<label class="Titulo_azul"><?php echo $mensaje;?></label>
    </center><br>
    </div>

<?php endif ?>

    <fieldset>
    	<legend class="Letra_negra"><b>Bases</b></legend>
        <form action="procesos/p_guardar_bases.php" method="post" enctype="multipart/form-data" name="noticia" id="noticia">
        	
            <table width="100%" class="Letra_negra_pequena">
                
                <tr valign="top">
                    <td class="Letra_negra_pequena">
                        *Solo archivos pdf no mayores de 50MB, en minisculas sin espacios entre palabras
                    </td>                        
                </tr>    
                <tr valign="top">
                    <td class="Letra_negra_pequena">
                        <input type="file" name="file_bases" >
                    </td>                        
                </tr>
                <tr valign="top">
                    <td class="Letra_negra_pequena">
                        &nbsp;
                    </td>                        
                </tr>
                <tr valign="top">
                    <td c>
                        <a href="../docs/convocatoria-feria-estatal-de-ciencias-e-ingenierias.pdf" target="_blank" style="color:#00F">Ver bases actuales</a>
                    </td>                        
                </tr>
                <tr valign="top">
                    <td class="Letra_negra_pequena">
                        &nbsp;
                    </td>                        
                </tr>
                
                <tr>
                    <td><br><input name="button" type="submit" class="btn_grey" id="button" value="Salvar"></td>
                </tr>    
            </table>
        </form>
    </fieldset>
</div>

<script>
$$('input.slimpicker').each( function(el){
	var picker = new SlimPicker(el);
});
</script>

</body>
</html>