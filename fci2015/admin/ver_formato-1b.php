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
		redirect("formato-1b.php?mensaje=1");
	}
	
	$query ="SELECT * FROM formato1b WHERE id = '$id'";
	$o_query = mysql_query($query); 
		
	if (mysql_num_rows($o_query)==0)
	{
		redirect("formato-1b.php?mensaje=1");
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
<div id="titulo_seccion"><span style="cursor:pointer" onClick="window.location='formato-1b.php'">Todos los proyectos y para cada uno de los autores</span></div>
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
        	<td colspan="2">
            	<?php $arr_compromiso = explode(',',$registro['compromiso']) ?>
            	<strong>a) Compromiso del Expocient�fico:</strong>
                <ul>
                    <li>Entiendo los riesgos y posibles peligros para m� en lo dispuesto en el Plan de Investigaci�n y anexos. Adem�s, he le�do y respetar� todas las reglas del Protocolo Internacional de Proyectos Cient�ficos Juveniles (PIPCIJ) mientras desarrolle la investigaci�n: <?= (in_array('riesgos',$arr_compromiso)) ? 'Si' : 'No' ;?></li>
                    <li>He le�do y estoy advertido acerca de la declaraci�n de �tica: "El fraude cient�fico y la mala conducta no son toleradas en ning�n nivel de investigaci�n o competencia. El plagio, uso o presentaci�n de trabajo de otra persona como propio, falsificaci�n de firmas de autorizaci�n y fabricaci�n o falsificaci�n de datos no ser�n aceptados. Proyectos fraudulentos no calificar�n para participar en cualquier Feria afiliada de Intel": <?= (in_array('declaracion',$arr_compromiso)) ? 'Si' : 'No' ;?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td><strong>Nombre del Expocient�fico:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['expocientifico'] ;?></td>
        </tr>
        <tr>
            <td><strong>Fecha del compromiso:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_expocientifico'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
		<tr>
            <td colspan="2"><strong>b) Aprobaci�n del Padre o Tutor: He le�do y entiendo los riesgos y posibles peligros involucrados en el Plan de Investigaci�n y anexos. Doy consentimiento para que mi hijo/protegido participe en la investigaci�n.</strong></td>
        </tr>
        <tr>
            <td><strong>Nombre del Padre o Tutor:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['padre'] ;?></td>
        </tr>
        <tr>
            <td><strong>Fecha del compromiso:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_padre'] ;?></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td colspan="2"><strong>2. REQUISITO PARA PROYECTOS CON NECESIDAD DE APROBACI�N DEL COMIT� INSTITUCIONAL DE REVISI�N Y EL COMIT� CIENT�FICO DE REVISI�N (CIR/CCR. (No Llenar 2 Ni 3)</strong></td>
        </tr>
        <tr>
            <td colspan="2"><strong>a) Requisito para proyectos que requieren de aprobaci�n del CIR/CCR previa a la experimentaci�n. (i.e. ver punto 8 Formato 1A.) </strong></td>
        </tr>
        <tr>
            <td colspan="2">El CIR/CCR ha estudiado cuidadosamente el Cronograma de Investigaci�n 1A y anexos de este proyecto y los formatos que requiere son incluidos. Mi firma indica su aprobaci�n previa al desarrollo del proyecto. </td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td><strong>Titular del CIR/CCR:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['a_titular'] ;?></td>
        </tr>
        <tr>
            <td><strong>Fecha del compromiso:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['a_fecha'] ;?></td>
        </tr>
        <tr>
            <td colspan="2">
            	<?php $arr_a_feria = explode(',',$registro['a_feria']) ?>
            	<strong>Tipo de Feria:</strong>
                <ul>
                    <li>Oficial: <?= (in_array('oficial',$arr_a_feria)) ? 'Si' : 'No' ;?></li>
                    <li>Afiliada: <?= (in_array('afiliada',$arr_a_feria)) ? 'Si' : 'No' ;?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2"><strong>b) Requisito para proyectos desarrollados en instituciones o centros de investigaci�n afiliados sin aprobaci�n previa del CCR. </strong></td>
        </tr>
        <tr>
            <td colspan="2">Este proyecto fue desarrollado en una instituci�n o centro de investigaci�n afiliado (no es un plantel educativo medio superior u hogar)sin conocimiento del CCR previo al desarrollo del proyecto, pero cumple con lo dispuesto en el PIPCIJ. Cumple con el Anexo 1C y aprobaciones institucionales requeridas </td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td><strong>Titular del CIR/CCR:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['b_titular'] ;?></td>
        </tr>
        <tr>
            <td><strong>Fecha del compromiso:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['b_fecha'] ;?></td>
        </tr>
        <tr>
            <td colspan="2">
            	<?php $arr_b_feria = explode(',',$registro['b_feria']) ?>
            	<strong>Tipo de Feria:</strong>
                <ul>
                    <li>Oficial: <?= (in_array('oficial',$arr_b_feria)) ? 'Si' : 'No' ;?></li>
                    <li>Afiliada: <?= (in_array('afiliada',$arr_b_feria)) ? 'Si' : 'No' ;?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2"><strong>3. APROBACI�N DEL COMIT� CIENT�FICO DE REVISI�N CCR PARA PARTICIPAR COMO FINALISTA NACIONAL.
El CCR aprobar� el proyecto despu�s de su desarrollo y poco antes de su participaci�n en una feria regional/estatal afiliada. Certificando que el proyecto cumple con el Cronograma de Investigaci�n 1A y con lo dispuesto en el PIPCIJ.</strong></td>
        </tr>
        <tr>
            <td><strong></strong></td>
            <td class="Letra_gris_pequena">&nbsp;</td>
        </tr> 
        <tr>
            <td><strong>Presidente del Comit� Cient�fico de Revisi�n:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['presidente'] ;?></td>
        </tr>
        <tr>
            <td><strong>Fecha del compromiso:</strong></td>
            <td class="Letra_negra_pequena"><?= $registro['fecha_presidente'] ;?></td>
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