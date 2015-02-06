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
		case 1: $mensaje = "Se editó el contenido correctamente."; break;
		default: $mensaje = ""; break;		
	} 
	//--------------------------------------------------------------
	
	$sql = "SELECT * FROM secciones_administrables WHERE id = 1";
	$query = mysql_query($sql);	
	$result = mysql_fetch_array($query);
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
<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,advhr,|,ltr,rtl,|,fullscreen",
		//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
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
    	<legend class="Letra_negra"><b>Procesos - Fases</b></legend>
        <form action="procesos/p_guardar_seccion.php" method="post" enctype="multipart/form-data" name="noticia" id="noticia">
        	<input type="hidden" name="id" value="1">
            <table width="100%" class="Letra_negra_pequena">
                    
                <tr valign="top">
                    <td width="85%" class="Letra_negra_pequena">
                        <fieldset>
                            <textarea id="text_seccion" name="text_seccion" rows="30" cols="70" style="width: 100%"><?= $result['contenido'] ?></textarea> 
                        </fieldset>
                    
                    
                    	<!--<textarea name="text_promocion" cols="60" rows="10" class="validate['required'] Letra_negra_pequena" id="text_promocion"></textarea>-->
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