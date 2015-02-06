<?php
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	
	$sql = "SELECT * FROM secciones_administrables WHERE id = 2";
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
        <h1>Feria Mundial Intel ISEF</h1>
        <div class="large-7 medium-12 small-12 columns feria-m">
        <p>
        Más de un millón de estudiantes de secundaria compiten en ferias científicas cada año La Feria Internacional de Ciencia y Tecnología 
        de Intel (ISEF) es la única feria científica internacional que representa todas las ciencias naturales para los estudiantes. Cada año, 
        más de un millón de estudiantes de noveno a doceavo año de secundaria compiten en ferias científicas regionales, y casi 500 ferias 
        afiliadas a Intel ISEF se llevan a cabo alrededor del mundo. Más de 1.200 estudiantes de más de 40 países tienen la oportunidad de 
        competir por más de USD 30 millones en becas y premios en Intel ISEF, en 14 categorías científicas y una categoría de proyecto en equipo.
        <br><br>
        La feria la ha administrado Science Service por más de 50 años, una de las organizaciones sin fines de lucro más respetadas que 
        promueven la causa científica. Desde 1996 Intel Corporation, como patrocinador titular, ha destinado millones de dólares (USD) 
        al desarrollo y la promoción de esta competencia. Adicionalmente, cada comité voluntario que representa la ciudad anfitriona, 
        recauda fondos para patrocinar actividades durante la feria.
        </p>

        <h2>Patrocinio de Intel</h2>
        <p>En 1996, Intel se convirtió en el primer patrocinador titular de ISEF con el objetivo de reconocer e incentivar la excelencia en ciencia 
        de los mejores jóvenes científicos del mundo, y para estimular a más jóvenes a explorar la ciencia y la tecnología en su educación 
        universitaria y en su carrera.
		<br><br>
        Desde que se asumió el patrocinio, Intel se ha enfocado en aumentar la participación internacional y añadir nuevos premios, tales como la beca 
        Intel Foundation Young Scientists Scholarships, el premio Achievement Awards, el premio Best Use of a PC (Mejor Utilización de un Computador), 
        el premio Best of Category (Mejor de su Categoría), y premios para docentes y directores de la feria.</p>
        </div>
        <div class="large-5 medium-12 small-12 columns top20">
          <iframe width="380" height="300" src="//www.youtube.com/embed/SKJ3a1iFMOs" frameborder="0" allowfullscreen></iframe>
        </div>
        
      
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
