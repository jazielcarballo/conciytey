<?php
session_start();
if ($_POST['action'] == "checkdata") {
	if ($_SESSION['tmptxt'] == $_POST['tmptxt']) {
		echo "Bienvenido";
	} else {
		echo "Intentalo nuevamente";
	}
	exit;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CAPTCHA con PHP</title>
<meta name="description" content="CAPTCHA con PHP: ejemplo para demostrar la creacion de Captcha con PHP." />
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="descdet">
	<div class="bordeder">
		<strong class="subder">CAPTCHA con PHP </strong><br>
		Ingresar el texto mostrado en la imagen <br>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		  <img src="captcha.php" width="100" height="30" vspace="3"><br>
		  <input name="tmptxt" type="text" size="30"><br>
		  <input name="btget" type="submit" class="boton" value="Verificar Codigo">
		  <input name="action" type="hidden" value="checkdata">
		</form>
	</div>
	</td>
  </tr>
</table>
</body>
</html>
