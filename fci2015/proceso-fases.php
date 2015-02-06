<?php
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	
	$sql = "SELECT * FROM secciones_administrables WHERE id = 1";
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
        <h1>Proceso y fases de evaluación</h1>
        <p>La evaluación se hará conforme al nivel educativo de los estudiantes y se clasificarán en dos grupos: 
          <br>a) Básica y 
          <br>b) Media Superior. </p>
        <p>El proceso de evaluación considera 3 fases y será coordinado por el <span class="red">_(nombre del departamento o dirección que estará a cargo de la convocatoria)_ (Siglas del consejo)</span>.</p>
        <p>La primera y segunda evaluación la realizará un comité de expertos en el área de conocimiento de cada proyecto y será a través de un sistema en línea. La tercera evaluación o final se llevará a cabo de forma presencial, durante la realización de la Feria; para ello se conformará un grupo de especialistas, según el número de proyectos finalistas.</p>
        <p>Las fases de evaluación son las siguientes:</p>  
        <h2>Primera fase:</h2>
        <p>a) Se realizará una <em>primera evaluación</em> en línea de los proyectos registrados. Los resultados se publicarán en la página web <span class="red">http://dirección del consejo</span> a partir del 7 de mayo de 2015.</p>
        <p>b) Los proyectos aprobados en esta fase, podrán participar en la segunda fase.</p>
        <h2>Segunda fase:</h2>
        <p>a) A los proyectos que clasifiquen a esta fase se les <em>recomienda</em> contar con un asesor externo quien deberá ser un profesor o investigador de una universidad o centro de investigación especialista en el tema del proyecto.</p>
        <p>b) Ingresar al sistema web y adjuntar lo siguiente:
          <ul class="ul">
            <li>Avances del proyecto conforme al <span class="red">Formato 5</span>.</li>
            <li>Los formatos correspondientes a cada proyecto, los cuales serán publicados con oportunidad en la página web <span class="red">http:// dirección del consejo</span>. </li>
          </ul> 
        </p>
        <p>La documentación deberá ingresarse al sistema en línea del 23 al 30 de junio del 2015, a fin de llevar a cabo la <em>segunda evaluación</em> en línea.</p>
        <p>c) Los resultados de la segunda evaluación serán publicados en la página <span class="red">http:// dirección del consejo</span> a partir del 17 de agosto de 2015 y los proyectos aprobados podrán ser considerados para la tercera fase.</p>
        <h2>Tercera fase:</h2>
        <p>a) Los proyectos aprobados para esta fase serán <em>proyectos finalistas</em> que deberán presentarse en la Feria para la última evaluación. </p>
        <p>b) Al momento de presentarse en la Feria, el estudiante o líder del proyecto deberá entregar el <em>reporte de investigación del proyecto</em> <span class="red">(Formato 6)</span> impreso, engargolado y por triplicado, a fin de asegurar su participación. </p>
        <p>c) La evaluación final de los proyectos se llevará a cabo durante la realización de la Feria y cada proyecto será revisado por al menos tres especialistas en el área del conocimiento y de investigación correspondiente, quienes fungirán como <em>jueces</em>.</p>
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
