<?php 
	session_start();
	include("../includes/configuracion.php");
	include("../includes/conexion.php");
	
	
	if (strlen($_SESSION["id_usuario"]) == 0)
	{
		redirect("index.php?iMessage=5");		
	}
	
		
	//--------------------------------------------------------------
	$mensaje = mysql_real_escape_string(trim(@$_GET['mensaje']));
	$mensaje = validateint($mensaje);
	
	$id = mysql_real_escape_string(trim(@$_GET['id']));
	
	//--------------------------------------------------------------
	switch ($mensaje) 
	{ 
		case 1: $mensaje = "Se grabo el registro con exito."; break; 		
		case 2: $mensaje = "Registro eliminado con exito."; break; 
		default: $mensaje = ""; break;		
	} 
	//--------------------------------------------------------------	
				
	$query ="SELECT * FROM logo_banner ";
		
	$campo_ordenar = mysql_real_escape_string(trim(@$_REQUEST['campo_ordenar']));
	if (strlen($campo_ordenar) == 0){$campo_ordenar = 0;}

	$opcion_ordenar = mysql_real_escape_string(trim(@$_REQUEST['opcion_ordenar']));	
	if (strlen($opcion_ordenar) == 0){$opcion_ordenar = 0;}
	
	if ($opcion_ordenar == 0)
	{
		$s_opcion_ordenar = " DESC";
		$sort_info = " (descendente)";
	}else{
		$s_opcion_ordenar = " ASC";
		$sort_info = " (ascendente)";
	}

	if ($campo_ordenar == 0)
	{
		$query = $query . " ORDER BY id_banner ASC";
	}else{
		switch ($campo_ordenar) 
		{ 
			case 1: $query = $query ." ORDER BY id_banner " . $s_opcion_ordenar ."" ;break; 
			case 2: $query = $query ." ORDER BY nombre " . $s_opcion_ordenar ."" ;break;
			//case 3: $query = $query ." ORDER BY tipo " . $s_opcion_ordenar ."" ;break; 
			case 4: $query = $query ." ORDER BY status " . $s_opcion_ordenar ."" ;break;
			case 5: $query = $query ." ORDER BY registro " . $s_opcion_ordenar ."" ;break;
			case 6: $query = $query ." ORDER BY modificacion " . $s_opcion_ordenar ."" ;break; 			
			default: $sMensaje = ""; break;		
		} 
	}
	
	$o_query = mysql_query($query); 
	$registros_totales = mysql_num_rows($o_query);
	
	$max_registros = 50;	
	$sum_pag = 0;
	$pag_actual = mysql_real_escape_string(trim(@$_REQUEST['pagina']));
	
	if(strlen($pag_actual)==0 or $pag_actual ==1 ){$pag_actual = 0;}elseif($pag_actual > 1){$sum_pag = (($pag_actual-1)*$max_registros);}
	$o_query = mysql_query($query); 
	$o_count_registros_total = mysql_num_rows($o_query);
	
	if($o_count_registros_total % $max_registros != 0)
	{					
		$total_paginas = intval($o_count_registros_total / $max_registros)+1;
	}else{
		$total_paginas = ($o_count_registros_total / $max_registros);
	}
				
	$query = $query ." LIMIT ". $sum_pag .",". $max_registros ."";
	
	$o_query = mysql_query($query); 
	$o_count_registros =mysql_num_rows($o_query);
	
	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="css/formcheck/theme/classic/formcheck.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<script type="text/javascript" src="js/funciones.js"></script> 
<script src="js/mootools-1.2.4-core.js" type="text/javascript" charset="utf-8"></script>
<script src="js/mootools-1.2.4.4-more.js" type="text/javascript" charset="utf-8"></script>
<script src="js/formcheck/lang/es.js" type="text/javascript" charset="utf-8"></script>
<script src="js/formcheck/formcheck.js" type="text/javascript" charset="utf-8"></script>
<script src="js/main.js" type="text/javascript" charset="utf-8"></script>
<script src="js/MenuMatic_0.68.3.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8"> 
	window.addEvent('domready', function(){
		var myMenu = new MenuMatic();
		//new FormCheck('Anuncio');
		JSClock();
	});
	
	function CambiarPagina(pag_actual)
	{
		if (pag_actual == 0)
		{
			pag_actual = document.getElementById("pag_actualdor").value	
		}
		
		document.busqueda.pagina.value = pag_actual;	
		document.busqueda.submit();
	} 
	
	function Ordenar(campo_ordenar)
	{	
		if(document.busqueda.opcion_ordenar.value == 1)
		{
			document.busqueda.opcion_ordenar.value = 0;
		}
		else
		{
			document.busqueda.opcion_ordenar.value = 1;
		}
		
		document.busqueda.campo_ordenar.value = campo_ordenar;		
		document.busqueda.action = 'banners.php<?php if ($pag_actual >= 0){?>?pagina=<?php echo $pag_actual + 1; ?><?php }?>'
		document.busqueda.submit();
	} 	
</script> 
<title>Administracion</title>
</head>
<body>

<div id="header"><?php include('inc_header.php'); ?></div>
<div id="menu"><?php include('inc_menu.php'); ?></div>
<div id="titulo_seccion">Logo & Banner</div>
<!--////////////////////////////////////////////////////////////////-->

<div>
    <div id="opciones" style="border:solid 10px #FFF"></div>
    
    <table width="100%" border="0" cellpadding="6" cellspacing="0" class="Letra_gris_pequena" style="background-color:#EAEAEA; border:#CCC  solid 1px;">
      <tr>
        <td style="background-image:url(images/bgfooter.gif);"><span class="Letra_negra_pequena">&nbsp;<strong>Area para editar</strong><!--</span> <span class="Letra_negra_pequena">Hay <b>-->
        <!--<b><?php echo $registros_totales; ?>
        </b> registros y 
        Pagina
        <b><?php echo $pag_actual+1;?></b>
        de 
        <b><?php if($total_paginas==0){?><?php echo ($total_paginas + 1);?><?php } else{?><?php echo $total_paginas;?><?php }?>
        </b> , Registros mostrados: <b>
        <?php echo $o_count_registros; ?>
        </b>
        </span>--></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="Letra_gris_pequena">
          <tr>
            <td>
            
            <?php if(strlen(@$id)>0):
                    
					$oLogin="SELECT * FROM logo_banner WHERE id_banner = $id";
					$oResultadoLogin = mysql_query($oLogin); 
					$oRs=mysql_fetch_array($oResultadoLogin, MYSQL_ASSOC);
			?>
                    <form name="form1" method="post" action="procesos/guardar_banner.php" enctype="multipart/form-data">
                    	<input type="hidden" name="tipo" value="<?php echo $oRs['tipo']?>">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <table width="100%" class="Letra_negra_pequena">
                            <tr>
                                <td width="45">Medidas:</td>
                                <td width="90">
									<?php 
										switch($oRs['tipo']){
											case 1:
												echo '183 x 103 px';
												break;
											case 2:
												echo '1200 x 156 px';
												break;
											case 3:
												echo '1200 x 400 px';
												break;
											case 4:
												echo '181 x 52 px';
												break;
										}
										
									?>
                                </td>
                                <td>
                                	<?php if(!is_null($oRs['imagen'])): ?>
                                		<a href="../img/logo_banner/<?php echo $oRs['imagen'];?>" target="_blank"><img class="thumbs_img_catalogo" src="../img/logo_banner/thumbnail/50thumb_<?php echo $oRs['imagen'];?>" border="0" alt="Imagen" /></a>
                                        &nbsp;&nbsp;
									<?php endif ?>                                                                            
                                </td>
                                <td width="45">Cambiar imagen:</td>
                                <td width="300"><input name="file_imagen" type="file" id="file_imagen"></td> 
                                <td>
                                	<br><input name="button" type="submit" class="btn_grey" id="button" value="Guardar">
                                    <input type="button" class="btn_grey" value="Cancelar" onClick="window.location='logo.php'">
                                </td>                                                               
                            </tr>
                        </table>
                        
                    </form>
             <?php endif?>
            </td>
          </tr>
        </table></td>
      </tr>
    </table>
<br>
<div id="contenido">
<form id="busqueda" name="busqueda" method="post" action="">
    <input type="hidden" name="opcion_ordenar" value="<?php echo $opcion_ordenar; ?>">
    <input type="hidden" name="campo_ordenar" value="<?php echo $campo_ordenar; ?>">
    <input type="hidden" name="pagina" value="<?php echo $pag_actual; ?>">
</form>
<?php if (strlen(@$mensaje)>0){ ?>
<div class="Letra_Alerta_pequena">
<center><?php echo $mensaje;?></center><br>
</div>
<?php }?>
<table width="100%" class="Letra_negra_pequena">
    <tr style="background-image:url(images/bgfooter.gif);">
        <td align="left"><b>Imagen</b></td>
        <td align="left"><b>Tipo</b></td>
        <td align="center"><b>Modificaci&oacute;n</b></td>                        
        <td align="center"><strong>Editar</strong></td>
    </tr>
<?php
if($o_count_registros==0)
{?>
    <tr>
        <td colspan="8" align="center"><br><span class="Letra_Alerta_pequena">No se encontraron registros.</span><br><br></td>
    </tr>
<?php 
}
$color_fila = 0;
while ($Campos= mysql_fetch_assoc($o_query))
{
	switch($Campos['tipo']){
		case 1:
			$medidas = 'Logo ( 183 x 103 px )';
			break;
		case 2:
			$medidas = 'Banner interior ( 1200 x 156 px )';
			break;
		case 3:
			$medidas = 'Banner index ( 1200 x 400 px )';
			break;
		case 4:
			$medidas = 'Logo Consejo ( 181 x 52 px )';
			break;
	}
										
	
	if ($Campos['activo']==2){@$estilos = "style='font-style:italic'";$activo="<img src='images/bullet_red.png' title='Inactivo'>";}
	elseif($Campos['activo']==1){@$estilos = "";$activo="<img src='images/bullet_blue.png' title='Activo'>";}
	if ($color_fila == 0){$color_fila = 1;}else{$color_fila = 0;}
?>
	<tr class="normalsmall" <?php if($color_fila==1){ ?>style="background-color:#b8cde2"<?php }else{?>style="background-color:#dce6f1"<?php }?>onMouseOver="style.backgroundColor='#427bb3',style.color='FFFFFF'"<?php if($color_fila==1){ ?>onMouseOut="style.backgroundColor='#b8cde2',style.color='000000'"<?php }else{?>onMouseOut="style.backgroundColor='#dce6f1',style.color='000000'"<?php }?> style="cursor:pointer">
        <td style="padding:5;" align="left" <?php echo @$estilos;?>>
        	<a href="../img/logo_banner/<?php echo $Campos['imagen'];?>" target="_blank">
        		<img class="thumbs_img_catalogo" src="../img/logo_banner/thumbnail/50thumb_<?php echo $Campos['imagen'];?>" border="0" alt="Imagen" />
        	</a>
        </td>
        <td align="left" <?php echo @$estilos;?>><?php echo $medidas; ?></td>
        <td align="center" <?php echo @$estilos;?>><?php echo substr($Campos['modificacion'],0,16); ?></td>
        <td width="6%" align="center" valign="top"><a href="logo.php?id=<?php echo $Campos['id_banner']; ?>"><img src="images/pencil.png" width="16" height="16" border="0"></a></td>
      </tr>
<?php
} 
?>
</table>

</div>
<div id="paginador">
<table width="100%">
<tr>
<td align="center">
<table>
    <tr>
		<?php if($pag_actual > 1){?>
                <td width="10"><a href="JavaScript:CambiarPagina(1);"><img src="images/btn_pag_izq_ini.png" alt="Primera p&aacute;gina" width="7" height="9" border="0"></a></td>
                <td width="10">&nbsp;</td>
                <td width="10"><a href="JavaScript:CambiarPagina(<?php echo ($pag_actual-1);?>);"><img src="images/btn_pag_izq.png" alt="P&aacute;gina anterior" width="6" height="9" border="0"></a></td>
                <td width="10">&nbsp;</td>
        <?php }else{?>
                <td width="10"><img src="images/btn_pag_izq_ini_off.png" alt="Primera p&aacute;gina" width="7" height="9" border="0"></td>
                <td width="10">&nbsp;</td>
                <td width="10"><img src="images/btn_pag_izq_off.png" alt="P&aacute;gina anterior" width="6" height="9" border="0"></td>
                <td width="10">&nbsp;</td>
        <?php }?>
           
        <td class="Letra_negra_pequena">
            Pagina
            <select name="pag_actualdor" class="Letra_negra_pequena" id="pag_actualdor" onChange="CambiarPagina(0)">
            <?php for ($i = 1; $i <= $total_paginas; $i++) {?>	
            <option value="<?php echo $i?>" <?php if($i==$pag_actual){?>selected<?php } ?>><?php echo $i?></option>
            <?php } ?>
            </select> 
            de <?php echo $total_paginas;?>
        </td>
        
        <?php if($pag_actual == 0) $pag_actual = 1; ?>
        
        <?php if($total_paginas > $pag_actual){?>
                <td width="10">&nbsp;</td>
                <td width="10"><a href="JavaScript:CambiarPagina(<?php echo ($pag_actual+1);?>);"><img src="images/btn_pag_der.png" alt="P&aacute;gina siguiente" width="6" height="9" border="0"></a></td>
                <td width="10">&nbsp;</td>
                <td width="10"><a href="JavaScript:CambiarPagina(<?php echo $total_paginas; ?>);"><img src="images/btn_pag_der_fin.png" alt="Ultima p&aacute;gina" width="7" height="9" border="0"></a></td>
        <?php }else{?>
                <td width="10">&nbsp;</td>
                <td width="10"><img src="images/btn_pag_der_off.png" alt="P&aacute;gina siguiente" width="6" height="9" border="0"></td>
                <td width="10">&nbsp;</td>
                <td width="10"><img src="images/btn_pag_der_fin_off.png" alt="Ultima p&aacute;gina" width="7" height="9" border="0"></td>
        <?php }?>
    </tr>
</table>
</td>
</tr>
</table>
</div>
</div>

<!--////////////////////////////////////////////////////////////////-->
</div>
<script>
$$('input.slimpicker').each( function(el){
	var picker = new SlimPicker(el);
});
</script>
</body>
</html>