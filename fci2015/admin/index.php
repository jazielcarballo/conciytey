<?php include("../includes/configuracion.php"); ?>
<?php include("../includes/conexion.php"); ?>
<?php
	//--------------------------------------------------------------
	$iMensaje = @$_GET['iMensaje'];
	$iMensaje = validateint($iMensaje);
	//--------------------------------------------------------------
	switch ($iMensaje) 
	{ 
		case 1: $sMensaje = "Los datos ingresados no son validos."; break; 
		case 2: $sMensaje = "Los datos ingresados son incorrectos."; break; 
		case 3: $sMensaje = "El usuario ingresado no esta activo."; break; 
		case 4: $sMensaje = "La sesión se ha cerrado."; break; 
		case 5: $sMensaje = "La sesión ha caducado."; break;
		default: $sMensaje = ""; break;		
	} 
	//--------------------------------------------------------------	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico"/>
<title>Influx | Administración de su sitio web</title>
<link href="css/estilos_div.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<link rel="stylesheet" href="../formcheck/theme/classic/formcheck.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<script type="text/javascript" src="js/funciones.js"></script>
<script src="../formcheck/core.js" type="text/javascript" charset="utf-8"></script>
<script src="../formcheck/more.js" type="text/javascript" charset="utf-8"></script>
<script src="../formcheck/lang/es.js" type="text/javascript" charset="utf-8"></script>
<script src="../formcheck/formcheck.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    window.addEvent('domready', function(){
        new FormCheck('LoginAdmin');
    });
</script>
<style>
body {
	background-color:#000;
}
.success_message{
  background-image: url(img/success.png);
  background-position: left center;
  background-repeat: no-repeat;
  background-color: #A3FFC0;
  border: 1px solid #63E27B;
  position:relative;
    margin-top:5px;
	margin-bottom:5px;
	padding:10px 10px 10px 50px;
	display:inline-block;
	color:#000;
}

.error_message{
  background-image: url(img/error.png);
  background-position: left center;
  background-repeat: no-repeat;
  position:relative;
  margin-top:5px;
	margin-bottom:5px;
	padding:10px 10px 10px 50px;
	font-weight: normal;
	display:inline-block;
	color:#333;
	background-color: #FBE6F2;
	border: 1px solid #D893A1;
}
</style>
</head>
<body>
<form name="LoginAdmin" id="LoginAdmin" action="procesos/login.php" method="Post">
  <div id="contenedor">
    <div id="header">
      <div id="logo"></div>
      <div id="tit">Administración de su sitio web</div>
      <div id="tit2">Acceso para el administrador del sistema </div>
      <div id="contenedor_campos">
        <div id="campo1">Usuario:
          <input name="sUsuario" type="text" id="sUsuario" class="validate['required','alphanum'] searchText"  style="width:110px;" onKeyPress="ValidarTexto()" maxlength="20" />
        </div>
        <div id="campo2">Contraseña:
          <input name="sClave" type="password" class="validate['required','alphanum'] searchText" id="sClave" style="width:110px;" onKeyPress="ValidarTexto()"  maxlength="20" />
        </div>
        <div id="campo3">
          <input type="image" class="validate['submit']"  name="imageField" id="imageField" src="images/btn_entrar.jpg"  />
        </div>
      </div>
     <center> 
     <?php if(strlen($sMensaje)>0):?>
     <div class="error_message"><?php echo $sMensaje; ?></div>
     <?php endif?>
     
     </center>
    </div>
    <div id="cuerpoimg"><img src="images/img_index.jpg" alt="Administración de su sitio web" /></div>
  </div>
</form>
</body>
</html>
