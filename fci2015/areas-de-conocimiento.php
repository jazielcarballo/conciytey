<?php
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	
	mysql_query("SET NAMES 'utf8'");
	
	$sql = "SELECT * FROM secciones_administrables WHERE id = 6";
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
        <!--<h1>Áreas de conocimiento</h1>
        <p>Los proyectos deberán ser originales y congruentes con alguna de las siguientes áreas:</p>
        <ul class="ul">
          <li><span class="blue bold">Ciencias Animales y de las Plantas</span> (Ecología, patología, fisiología, genética, evolución).</li>
          <li><span class="blue bold">Ciencias Sociales y del Comportamiento</span> (Psicología, sociología, antropología, arqueología, etnología, aprendizaje, pruebas educacionales, pedagogía).</li>
          <li><span class="blue bold">Bioquímica y Biología Celular y Molecular</span> (Bioquímica general, metabolismo, bioquímica estructural, biología celular, genética celular y molecular, inmunología, biología molecular).</li>
          <li><span class="blue bold">Química</span> (Fisicoquímica, química orgánica, química inorgánica, química analítica, química general, ciencia y tecnología de los alimentos).</li>
          <li><span class="blue bold">Ciencias de la Computación </span> (Algoritmos, bases de datos, inteligencia artificial, redes y comunicaciones, gráficos, ingeniería de software, lenguajes de programación, sistemas de cómputo, sistemas operativos).</li>
          <li><span class="blue bold">Ciencias de la Tierra y de los Planetas </span> (Geología, mineralogía, fisiografía, oceanografía, meteorología, climatología, sismografía, geofísica).</li>
          <li><span class="blue bold">Ingeniería de Materiales y Bioingeniería </span> (Civil, química, sonido, industrial, procesos, ciencias de materiales).</li>
          <li><span class="blue bold">Ingeniería Eléctrica y Mecánica </span> (Ingeniería eléctrica, mecánica, electrónica, controles, termodinámica, solar, robótica, mecatrónica).</li>
          <li><span class="blue bold">Energía y Transporte</span> (Ingeniería del espacio y aeronáutica, aerodinámica, combustibles alternativos, energía de combustibles fósiles, desarrollo de vehículos, energías renovables).</li>
          <li><span class="blue bold">Manejo Ambiental y Análisis Ambiental</span> (Biorremediación, manejos de ecosistemas, ingeniería ambiental, manejo de recursos de la tierra, reciclaje forestal, manejo de desechos, contaminación y calidad del agua, suelo y aire).</li>
          <li><span class="blue bold">Medicina y Salud</span> (Diagnóstico y tratamiento de enfermedades, epidemiología, genética, biología molecular de enfermedades, fisiología y fisiopatología). Estos proyectos deberán de cumplir con un protocolo médico.</li>
          <li><span class="blue bold">Microbiología</span> (Antibióticos, antimicrobianos, bacteriología, genética microbiana, virología).</li>
          <li><span class="blue bold">Física y Astronomía.</span></li>
          <li><span class="blue bold">Ciencias Matemáticas.</span></li>
        </ul>
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
