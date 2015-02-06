<?php session_start(); ?>
<?php include("../includes/configuracion.php"); ?>
<?php include("../includes/conexion.php"); ?>
<?php	
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
		case 1: $mensaje = "Registro grabado con exito."; break;  
		case 2: $mensaje = "Registro editado con exito"; break; 
		case 3: $mensaje = "Registro eliminado con exito."; break;
		case 4: $mensaje = "No existe el registro indicado."; break;
		default: $mensaje = ""; break;		
	} 
	//--------------------------------------------------------------	
		
	$query ="SELECT count(id) as conteo FROM formato_proyecto_en_continuidad WHERE status <> 0";
	$o_query = mysql_query($query); 
	$o_registros =mysql_fetch_array($o_query, MYSQL_ASSOC);
	
			
	$query ="SELECT * FROM formato_proyecto_en_continuidad WHERE status <> 0";
	
	$hasta = mysql_real_escape_string(trim(@$_REQUEST['hasta']));
	$desde = mysql_real_escape_string(trim(@$_REQUEST['desde']));
	
	$palabra = mysql_real_escape_string(trim(@$_REQUEST['palabra']));
	
	if (strlen($palabra) > 0)
	{
		$query = $query . " AND (lider like '%". $palabra ."%' OR proyecto like '%". $palabra ."%')";
		@$filtro = $filtro . " buscando palabra clava que lleve " . $palabra . " , ";
	}	
	
	if (strlen($desde) > 0)
	{
		$query = $query . " AND LEFT(fecha_registro,10) >= '". $desde ."'";
		@$filtro = $filtro . " fecha de registro desde " . $desde . " , ";
	}
	
	if (strlen($hasta) > 0)
	{
		$query = $query . " AND LEFT(fecha_registro,10) <= '". $hasta ."'";
		@$filtro = $filtro . " fecha de registro hasta " . $hasta . " , ";
	}
	
	$campo_ordenar = mysql_real_escape_string(trim(@$_REQUEST['campo_ordenar']));
	if (strlen($campo_ordenar) == 0){$campo_ordenar = 0;}

	$opcion_ordenar = mysql_real_escape_string(trim(@$_REQUEST['opcion_ordenar']));	
	if (strlen($opcion_ordenar) == 0){$opcion_ordenar = 0;}

	if ($opcion_ordenar == 0){$s_opcion_ordenar = " DESC";$sort_info = " (descendente)";}else{$s_opcion_ordenar = " ASC";$sort_info = " (ascendente)";}

	if ($campo_ordenar == 0){$query = $query . " ORDER BY id DESC";}
	else{
		switch ($campo_ordenar) 
		{ 
			case 1: $query = $query ." ORDER BY id " . $s_opcion_ordenar ."" ;break; 					
			//case 2: $query = $query ." ORDER BY emp.status " . $s_opcion_ordenar ."" ;break;
			case 3: $query = $query ." ORDER BY lider " . $s_opcion_ordenar ."" ;break;					
			case 4: $query = $query ." ORDER BY proyecto " . $s_opcion_ordenar ."" ;break; 
			//case 5: $query = $query ." ORDER BY suc.nombre " . $s_opcion_ordenar ."" ;break; 					
			//case 6: $query = $query ." ORDER BY emp.telefono " . $s_opcion_ordenar ."" ;break; 									 
			case 7: $query = $query ." ORDER BY fecha_registro " . $s_opcion_ordenar ."" ;break; 
			default: $mensaje = ""; break;		
		} 
	}
	
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

<link rel="stylesheet" href="css/slimpicker.css" media="screen, projection" />

<script type="text/javascript" src="js/funciones.js"></script> 
<script src="js/mootools-1.2.4-core.js" type="text/javascript" charset="utf-8"></script>
<script src="js/mootools-1.2.4.4-more.js" type="text/javascript" charset="utf-8"></script>

<script src="js/slimpicker.js"></script>

<script src="js/formcheck/lang/es.js" type="text/javascript" charset="utf-8"></script>
<script src="js/formcheck/formcheck.js" type="text/javascript" charset="utf-8"></script>
<script src="js/main.js" type="text/javascript" charset="utf-8"></script>
<script src="js/MenuMatic_0.68.3.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8"> 
	window.addEvent('domready', function(){
		var myMenu = new MenuMatic();
		new FormCheck('Anuncio');
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
		document.busqueda.action = 'proyecto-en-continuidad.php<?php if ($pag_actual >= 0){?>?pagina=<?php echo $pag_actual + 1; ?><?php }?>'
		document.busqueda.submit();
	}
</script> 
<title>Administracion</title>
</head>
<body>


<div id="header"><?php include('inc_header.php'); ?></div>
<div id="productos"><?php include('inc_menu.php'); ?></div>
<div id="titulo_seccion">Requerido si continúan dentro del mismo campo de estudio que el año anterior</div>
<!--////////////////////////////////////////////////////////////////-->

<div>
    <div id="opciones" style="border:solid 10px #FFF"></div>
        <table width="100%" border="0" cellpadding="6" cellspacing="0" class="Letra_gris_pequena" style="background-color:#EAEAEA; border:#CCC  solid 1px;">
  <tr>
        <td width="87%" style="background-image:url(images/bgfooter.gif);"><span class="Letra_negra_pequena"><strong>Resumen:</strong></span> <span class="Letra_negra_pequena">Hay <b>
        <?php echo $o_registros['conteo']; ?>
        </b> registros  
         , Pagina <b>
        <?php echo $pag_actual+1;?>
        </b> de <b>
        <?php if($total_paginas==0){?><?php echo ($total_paginas + 1);?><?php } else{?><?php echo $total_paginas;?><?php }?>
        </b> , Registros mostrados: <b>
        <?php echo $o_count_registros; ?>
        </b> , Filtros: <b>
        <?php echo @$filtro; ?>
        </b>
        </span></td>
  </tr>
</table>

    <table width="100%" border="0" cellpadding="6" cellspacing="0" class="Letra_gris_pequena" style="background-color:#EAEAEA; border:#CCC  solid 1px;">

      <tr>
        <td>
        
        <form name="busqueda2" id="busqueda2" method="post">
        
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="Letra_gris_pequena">
          <tr>
            <td width="286" class="Letra_negra_pequena"><strong>Filtros:</strong> Palabra clave:
<input name="palabra" type="text" class="validate['alphanum']  Letra_gris_pequena" id="palabra" value="<?php echo $palabra;?>">
            </td>
            <td width="118" align="right" class="Letra_negra_pequena">Fecha registro:</td>
            <td width="175" class="Letra_negra_pequena">
              <input id="desde" name="desde" type="text" class="slimpicker Letra_gris_pequena" autocomplete="off" alt="{
			dayChars:3,
			dayNames:['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
			daysInMonth:[31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
			format:'yyyy-mm-dd',
			monthNames:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junoi', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			startDay:1,
			yearOrder:'desc',
			yearRange:<?php echo (date("Y") - 10);?>,
			yearStart:<?php echo date("Y");?>
		}" value="<?php if(strlen($desde)>0){ ?><?php echo $desde; ?><?php }?>" />
            </td>
            <td width="111" class="Letra_negra_pequena">(Desde)</td>
            <td width="171" class="Letra_negra_pequena">
              <input id="hasta" name="hasta" type="text" class="slimpicker Letra_gris_pequena" autocomplete="off" alt="{
			dayChars:3,
			dayNames:['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
			daysInMonth:[31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
			format:'yyyy-mm-dd',
			monthNames:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junoi', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			startDay:1,
			yearOrder:'desc',
			yearRange:<?php echo (date("Y") - 10);?>,
			yearStart:<?php echo date("Y");?>
		}" value="<?php if(strlen($hasta)>0){ ?><?php echo $hasta; ?><?php }?>" />
            </td>
            <td width="69" class="Letra_negra_pequena">(Hasta)</td>
            <td width="193">
              <br>
              <input name="button" type="submit" class="btn_grey" id="button" value="Buscar">
              <input name="button2" type="button" class="btn_grey" id="button2" value="Mostrar todos" onClick="window.location='proyecto-en-continuidad.php'">
            </td>
            <td width="5">&nbsp;</td>
          </tr>
        </table>
        </form>
        
        </td>
      </tr>
    </table>
<br>
<div id="contenido">
<form id="busqueda" name="busqueda" action="proyecto-en-continuidad.php" method="get">
<input type="hidden" name="opcion_ordenar" value="<?php echo @$opcion_ordenar; ?>">
    <input type="hidden" name="campo_ordenar" value="<?php echo @$campo_ordenar; ?>">
    <input type="hidden" name="pagina" value="<?php echo @$pag_actual; ?>">
    <input type="hidden" name="palabra" value="<?php echo @$palabra;?>">
    <input type="hidden" name="desde" value="<?php echo @$desde; ?>">
    <input type="hidden" name="hasta" value="<?php echo @$hasta; ?>">
</form>
<?php if (strlen(@$mensaje)>0){ ?>
<div class="Letra_Alerta_pequena">
<center><?php echo $mensaje;?></center><br>
</div>
<?php }?>
<table width="100%" class="Letra_negra_pequena">
    <tr style="background-image:url(images/bgfooter.gif);">
        <td width="3%" align="center">
            <b style="cursor:pointer" title="Order por No." onClick="Ordenar(1)">#
            <?php if ($opcion_ordenar==1 and $campo_ordenar==1){ ?>
            <img src="images/ic_ordenar_down.png" width="9" height="6" border="0">
            <?php }elseif ($campo_ordenar==1){ ?>
            <img src="images/ic_ordenar_up.png" width="9" height="6" border="0">
            <?php } ?>
            </b>
        </td>
        <!--<td align="center"><b style="cursor:pointer" title="Order por Nombre" onClick="Ordenar(2)">Estatus
            <?php if ($opcion_ordenar==1 and $campo_ordenar==2){ ?>
            <img src="images/ic_ordenar_down.png" width="9" height="6" border="0">
            <?php }elseif($campo_ordenar==2){ ?>
            <img src="images/ic_ordenar_up.png" width="9" height="6" border="0">
            <?php } ?>
        </b></td> -->       
        <td align="left"><b style="cursor:pointer" title="Order por Nombre" onClick="Ordenar(3)">Lider
            <?php if ($opcion_ordenar==1 and $campo_ordenar==3){ ?>
            <img src="images/ic_ordenar_down.png" width="9" height="6" border="0">
            <?php }elseif($campo_ordenar==3){ ?>
            <img src="images/ic_ordenar_up.png" width="9" height="6" border="0">
            <?php } ?>
        </b></td>
        <td align="left">
        	<b style="cursor:pointer" title="Order por Padre" onClick="Ordenar(4)">Proyecto
           <?php if ($opcion_ordenar==1 and $campo_ordenar==4){ ?>
            <img src="images/ic_ordenar_down.png" width="9" height="6" border="0">
            <?php }elseif ($campo_ordenar==4){ ?>
            <img src="images/ic_ordenar_up.png" width="9" height="6" border="0">
            <?php } ?>
            </b>
        </td>
                  
        <td width="13%"  align="center">
        	<b style="cursor:pointer" title="Order por Fecha de registro" onClick="Ordenar(7)">Registro
           <?php if ($opcion_ordenar==1 and $campo_ordenar==7){ ?>
            <img src="images/ic_ordenar_down.png" width="9" height="6" border="0">
            <?php }elseif ($campo_ordenar==7){ ?>
            <img src="images/ic_ordenar_up.png" width="9" height="6" border="0">
            <?php } ?>
            </b>
        </td>        
        <td align="center"><strong>Ver</strong></td>
    </tr>
<?php
if($o_count_registros==0)
{?>
    <tr>
        <td colspan="16" align="center"><br><span class="Letra_Alerta_pequena">No se encontraron registros usando los actuales criterios de busqueda.</span><br><br></td>
    </tr>
<?php 
}
$color_fila = 0;
while ($Campos= mysql_fetch_assoc($o_query))
{
	if ($Campos['status']==2){@$estilos = "style='font-style:italic'";$activo="<img src='images/bullet_red.png' title='Inactivo'>";}
	elseif($Campos['status']==1){@$estilos = "";$activo="<img src='images/bullet_blue.png' title='Activo'>";}
	if ($color_fila == 0){$color_fila = 1;}else{$color_fila = 0;}
		
?>
	<tr class="normalsmall" <?php if($color_fila==1){ ?>style="background-color:#b8cde2"<?php }else{?>style="background-color:#dce6f1"<?php }?>onMouseOver="style.backgroundColor='#427bb3',style.color='FFFFFF'"<?php if($color_fila==1){ ?>onMouseOut="style.backgroundColor='#b8cde2',style.color='000000'"<?php }else{?>onMouseOut="style.backgroundColor='#dce6f1',style.color='000000'"<?php }?> style="cursor:pointer">
		<td align="center"><?php echo $Campos['id']; ?></td>        
        <!--<td align="center"><?php echo $activo; ?></td>-->
        <td align="left"><?php echo $Campos['lider']; ?></td>        
        <td align="left"><?php echo $Campos['proyecto']; ?></td>
         
        <td align="center"><?php echo substr($Campos['fecha_registro'],0,10); ?></td>                
        <td width="5%" align="center" valign="top"><a href="ver_proyecto-en-continuidad.php?id=<?php echo $Campos['id']; ?>"><img src="images/zoom.png" width="16" height="16" border="0"></a></td>
        <!--<td width="3%" align="center" valign="top">
        	<a href="procesos/eliminar_empleado.php?id=<?php echo $Campos['id_empleado']; ?>" onClick="return(confirm('&iquest;Est&aacute; seguro de que desea eliminar el registro?'))"><img src="images/cross.png" width="16" height="16" border="0"></a>
        </td>-->
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