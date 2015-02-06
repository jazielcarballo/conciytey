<?php
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	
	$sql = "SELECT * FROM secciones_administrables WHERE id = 7";
	$query = mysql_query($sql);	
	$result = mysql_fetch_array($query);
?>
<!doctype html>
<html class="no-js" lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-style-type" content="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="imagetoolbar" content="no" /> 
    <meta name="resource-type" content="document" /> 
    <meta name="distribution" content="global" /> 
    <meta name="Robots" content="Index,Follow" />
    <meta name="author" content="http://www.Influx.com.mx" />
    <meta name="rating" content="General" />
    <meta name="doc-rights" content="Copywritten work" />
    <title>Feria Nacional de Ciencia e Ingeniería</title>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/sections.css" />
    <link rel="stylesheet" href="css/fenaci.css">
    <!--[if IE 7]><link rel="stylesheet" href="css/fenaci-ie7.css"><![endif]-->

    <link rel="stylesheet" href="css/normalize.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
    <script src="js/vendor/modernizr.js"></script>

  </head>
  <body>
    <?php  require('header-estados.php'); ?>

    <section class="section01">

      <div class="row">
        
        <?= $result['contenido'] ?>
        
        <!--<h1>Reconocimientos</h1>
        <p>Se entregarán constancias por nivel educativo en las diferentes áreas y los que obtuvieran los mayores puntajes.</p>
        <p>Reconocimiento (constancia) por proyecto al primer, segundo y tercer lugar de nivel básico de las siguientes áreas:</p>
        <ul>
          <li>Ciencias Sociales</li>
          <li>Ciencias Exactas</li>
          <li>Ingeniería y Computación</li>
          <li>Medicina y Salud</li>
          <li>Ciencias Naturales y Ambiental</li>
        </ul>
        <p>Reconocimiento (constancia) por proyecto al primer, segundo y tercer lugar de nivel medio superior de las siguientes áreas:</p>
        <ul>
          <li>Ciencias Sociales</li>
          <li>Ciencias Exactas</li>
          <li>Ingeniería y Computación</li>
          <li>Medicina y Salud</li>
          <li>Ciencias Naturales y Ambientales</li>
        </ul>
        <p>Reconocimiento (constancia) a los estudiantes y asesor de proyectos que obtengan los mayores puntajes. Dichos proyectos se presentarán en la Feria Regional correspondiente. Los gastos para participar en la Feria Regional serán cubiertos por los organizadores de la misma.</p>
        <p>Cualquier situación no prevista en la presente Convocatoria, se resolverá oportunamente por la _(nombre de la dirección que estará a cargo de la convocatoria)_ (Siglas del consejo).</p>
      -->
      </div>

    </section>

    <?php
     require('footer.php');
      ?>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
