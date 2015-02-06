<?php
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	
	$sql = "SELECT * FROM secciones_administrables WHERE id = 5";
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
      <!--
        <h1>Participantes</h1>
        <p>Estudiantes que se encuentren inscritos en instituciones educativas públicas o privadas asentadas en el <span class="red">Estado de _______,</span> de los siguientes niveles educativos
        <br>a) básico (secundaria)
        <br>b) media superior </p>
        <p>La edad de los estudiantes deberá ser entre los 14 años y hasta aquellos que hayan cumplido los 20 años al 25 de julio de 2016.</p>
        <p>El proyecto a registrar deberá ser de investigación científica o de desarrollo tecnológico.</p>
        <p>El proyecto podrá ser desarrollado de manera individual o en equipo de 3 estudiantes como máximo, los cuales deberán ser irremplazables.</p>
        <p>Los estudiantes deberán estar registrados en un solo proyecto.</p>
        <p>En caso de que el proyecto se presente en equipo, los estudiantes deberán elegir a un <em>líder del proyecto</em>, quien se encargará de llevar a cabo el registro del mismo y será el contacto y enlace con el <span class="red">_(nombre del departamento o dirección que estará a cargo de la convocatoria)_ (Siglas del consejo)</span>.</p>
        <p>Deberán contar con un <em>asesor</em>, quien será un docente adscrito a la institución educativa a la que pertenecen y que cuente con la formación académica congruente con el área de conocimiento del proyecto.</p>
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
