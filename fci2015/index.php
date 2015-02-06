<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	
	$sql = "SELECT * FROM secciones_administrables WHERE id = 4";
	$query = mysql_query($sql);	
	$result = mysql_fetch_array($query);
	
	//--------------------------------------------------------------
	
	$sql = "SELECT est.estado FROM estados est
			INNER JOIN campos_administrables camp ON (camp.valor = est.id AND camp.seccion = 'todas' AND camp.campo = 'estado_id')";
	$query = mysql_query($sql);	
	$result_estado = mysql_fetch_array($query);
	$estado = $result_estado['estado'];
	
	
	//--------------------------------------------------------------
	
	$sql = "SELECT * FROM campos_administrables WHERE seccion = 'todas' AND campo = 'anio'";
	$query = mysql_query($sql);	
	$result_estado = mysql_fetch_array($query);
	$anio = $result_estado['valor'];
	
	//--------------------------------------------------------------
	
	$contenido = str_replace('[estado]',$estado,$result['contenido']);
	$contenido = str_replace('[anio]',$anio,$contenido);
	
	
	//unset($_SESSION['fenaci']);
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
    <?php
     require('header.php');
      ?>

    <section class="banner">
      <img src="img/logo_banner/thumbnail/1200thumb_<?= $banner_index ?>" alt="banner"/>
      <div class="show-for-medium-up text-center txt-banner">
          FERIA DE CIENCIAS E INGENIERÍA 
          <br><span class="red">ESTADO DE <?= strtoupper($estado) .' '. $anio ?></span>
          <br><br>
          <a class="btn-b btn-1 btn-1f" href="docs/bases.pdf" target="_blank">B A S E S</a>
      </div>
    </section>

      <div class="show-for-small-only text-center txt-banner">
          FERIA DE CIENCIAS E INGENIERÍA 
          <br><span class="red">ESTADO DE <?= strtoupper($estado) .' '. $anio ?></span>
          <br><br>
          <a class="btn-b btn-1 btn-1f" href="docs/bases.pdf" target="_blank">B A S E S</a>
      </div>

      <div class="show-for-small-only div-line"></div>

    <section class="section01">

      <div class="small-12 medium-8 medium-centered large-8 large-centered columns text-center">
        <?= $contenido ?>
        
        <!--
        <p>El Consejo Nacional de Ciencia y Tecnología (CONACYT) y el <span class="red">Consejo _____________________</span> con fundamento en el Programa Especial de Ciencia, Tecnología e Innovación (PECITI) 2014-2018 y <span class="red">en ____ del Estado de ________ y ___ del _____________________ </span>con el objeto de impulsar la investigación científica y tecnológica entre los jóvenes en los diferentes sistemas educativos de la entidad, así como fomentar las vocaciones científicas, 
        </p>
        <h1>C O N V O C A N</h1>
        <p>
        A estudiantes <span class="red">_(ejemplo: poblanos, morelenses)_</span> interesados en el desarrollo de proyectos científicos o tecnológicos a participar en la
        </p>
        <h1>FERIA DE CIENCIAS E INGENIERÍAS
          <br><span class="red">ESTADO DE _______ 2015</span></h1>
        <p>
        bajo las siguientes:
        <br><br>
        
      	<a href="docs/bases.pdf" target="_blank"><button class="btn btn-5 btn-5a icon-edit-alt"><span>BASES</span></button></a>
      </p>
      -->
      
      <!--<a href="docs/convocatoria-feria-estatal-de-ciencias-e-ingenierias.pdf" target="_blank"><button class="btn btn-5 btn-5a icon-edit-alt"><span>BASES</span></button></a>-->
      </div>

      <div class="div-line"></div>

      <div data-equalizer>
        <a href="participantes.php">
          <div class="small-12 medium-3 large-3 columns b1 text-center" data-equalizer-watch>
            <img src="img/bot-participantes.png" alt="participantes"/>
            <p>PARTICIPANTES</p>
          </div>
        </a>

        <a href="areas-de-conocimiento.php">
          <div class="small-12 medium-3 large-3 columns b2 text-center" data-equalizer-watch>
            <img src="img/bot-area.png" alt="areas de conocimiento"/>
            <p>ÁREAS DE CONOCIMIENTO</p>
          </div>
        </a>

        <a href="registro.php">
          <div class="small-12 medium-3 large-3 columns b3 text-center" data-equalizer-watch>
            <img src="img/bot-registro.png" alt="registro del proyecto"/>
            <p>REGISTRO DEL PROYECTO</p>
          </div>
        </a>

        <a href="reconocimientos.php">
          <div class="small-12 medium-3 large-3 columns b4 text-center" data-equalizer-watch>
            <img src="img/bot-reconocimiento.png" alt="reconocimientos"/>
            <p>RECONOCIMIENTOS</p>
            
          </div>
        </a>
      </div>

      <div class="div-line"></div>

    </section>

    <footer>
        <div class="small-10 small-centered medium-2 large-2 columns right">
          <!-- <a href="http://www.conacyt.mx/" target="_blank"><img src="img/logo-conacyt.png" alt="conacyt"/></a> -->
        </div>
        <div class="clearfix"></div>
        <div class="small-12 medium-4 large-4 columns">
          DERECHOS RESERVADOS © 2015
        </div>
    </footer>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
