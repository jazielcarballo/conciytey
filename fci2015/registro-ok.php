<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
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
        <h1>Registro</h1>
        <p class="subheader">Hola</p>
        <div class="large-6 medium-6 small-12 columns">
          Sus datos han sido enviados correctamente.
        </div>
        <br><br>
         <!--<div class="large-12 medium-12 small-12 columns">
           Por favor seleccione el formulario que desea enviar
          <br><br>
          <ul>
            <li>Formato1 para: <a href="revision-mentor-estudiante.php">El Mentor en colaboración con el (los) estudiante(s):</a></li>
            <li>Formato1A para: <a href="revision-estudiante.php">Estudiante</a></li>
            <li>Formato1B para: <a href="formato-1b.php">Todos los proyectos y para cada uno de los autores</a></li>
            <li>Formato1C para: <a href="formato-1c.php">El científico que asesorará </a></li>
            <li>Formato2 para: <a href="cientifico-calificado.php">Proyectos que involucren ADN, tejidos y humanos</a></li>
            <li>Formato3 <a href="supervisor-acesoria.php">Requerido si el científico calificado como asesor no está disponible para supervisar el experimento.</a></li>
            <li>Formato4 para: <a href="investigacion-con-humanos.php">Todos los proyectos que involucran humanos</a></li>
            <li>Formato4A para: <a href="forma-4a.php">Consentimiento Humano Informado</a></li>
            <li>Formato5A para: <a href="forma-5a.php">Todos los proyectos que involucran animales vertebrados en una institución no registrada/regulada.</a></li>
            <li>Formato5B para: <a href="forma-5b.php">Todos los proyectos realizados en instituciones de investigación registradas u oficiales</a></li>
            <li>Formato6A para: <a href="agentes-biologicos.php">Todos los proyectos que involucran microorganismos, rADN,  tejido fresco, sangre y/o fluidos corporales. </a></li>
            <li>Formato6B para: <a href="tejidos-de-animales-vertebrados.php">Todos los proyectos que usan tejido fresco, incluyendo sangre, productos sanguíneos, cultivos celulares primarios y fluidos corporales</a></li>
            <li>Formato7 <a href="proyecto-en-continuidad.php">Requerido si continúan dentro del mismo campo de estudio que el año anterior</a></li>
          </ul>
        </div>-->
        <br>

        <p class="subheader">Formatos básicos para registrar proyectos</p><br>

        <table>
          <thead>
            <tr>
              <td width="200">Nombre</td>
              <td width="200">Asunto</td>
              <td width="200">Observaciones</td>
              <td width="200">Carácter </td>
              <td width="200">Fase </td>
              <td width="200">&nbsp; </td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Formato  A</td>
              <td>Carta de Postulación </td>
              <td>Documento que llena el director del plantel al que pertenece el equipo que presentará el proyecto.</td>
              <td>Obligatorio</td>
              <td>Antes de Fase I. Previa al  Registro de proyecto.</td>
              <td><a class="button tiny" href="pdf/FORMATO-A-Carta-de-postulacion-NL.doc" target="_blank">Descargar formato</a></td>
            </tr>

            <tr>
              <td>Formato B</td>
              <td>Propuesta de Investigación. Indicaciones </td>
              <td>Documento que sirve como guía para la elaboración de la propuesta de investigación.</td>
              <td>Obligatorio</td>
              <td>Antes de Fase I. Previa al  Registro de proyecto.</td>
              <td><a class="button tiny" href="pdf/FORMATO-B-Propuesta-de-investigacion-NL.pdf" target="_blank">Descargar formato</a></td>
            </tr>

            <tr>
              <td>Formato C</td>
              <td>FIPI</td>
              <td>Instrucciones y formato Protocolo Internacional de Proyectos Científicos.</td>
              <td>Obligatorio</td>
              <td>Antes de Fase I. Previa al  Registro de proyecto.</td>
              <td><a class="button tiny" href="formato-fipi.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato D </td>
              <td>Avance del proyecto</td>
              <td>Instrucciones y extensión de cada rubro para presentar el avance del proyecto.</td>
              <td>Obligatorio</td>
              <td>Después de Fase 2. Primera evaluación.</td>
              <td><a class="button tiny" href="pdf/FORMATO-D-Avance-de-proyecto-NL.pdf" target="_blank">Descargar formato</a></td>
            </tr>

            <tr>
              <td>Formato E </td>
              <td>Asesor Externo</td>
              <td>Carta compromiso del asesor externo mismo que deberá pertenecer a una institución de educación superior o centro de investigación.</td>
              <td>Opcional </td>
              <td>Fase 2 y/o 3</td>
              <td><a class="button tiny" href="pdf/FORMATO-E-Asesor-externo-NL.doc" target="_blank">Descargar formato</a></td>
            </tr>

            <tr>
              <td>Formato F</td>
              <td>Plan de Investigación (PI)</td>
              <td>Guía para presentar el Plan de Investigación que deberá de anexarse al Formato 1A.</td>
              <td>Obligatorio</td>
              <td>Fase I. Registro de Proyectos.</td>
              <td><a class="button tiny" href="formato-f.php">Ir a formato</a></td>
            </tr>
          </tbody>
        </table>

        <br>

        <p class="subheader">Formatos adicionales  de los proyectos registrados</p><br>

        <table>
          <thead>
            <tr>
              <td width="200">Nombre</td>
              <td width="200">Asunto</td>
              <td width="200">Observaciones</td>
              <td width="200">Carácter </td>
              <td width="200">Fase </td>
              <td width="200">&nbsp; </td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Formato 1</td>
              <td>Mentor-Seguridad</td>
              <td>Este formato es para ser completado por el profesor-mentor en colaboración con los estudiantes autores del proyecto.</td>
              <td>Obligatorio </td>
              <td>Fase I. Al inicio de la investigación.</td>
              <td><a class="button tiny" href="revision-mentor-estudiante.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato 1 A</td>
              <td>Lista de revisión del (los) estudiante(s)</td>
              <td>Este formato debe llenarse individualmente o por el equipo.</td>
              <td>Obligatorio </td>
              <td>Fase I. Al inicio de la investigación.</td>
              <td><a class="button tiny" href="revision-estudiante.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato 1B</td>
              <td>Aprobación del proyecto</td>
              <td>Lo debe llenar el líder de proyecto y lo firma.</td>
              <td>Obligatorio </td>
              <td>Fase I. Al inicio de la investigación.</td>
              <td><a class="button tiny" href="formato-1b.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato 1C</td>
              <td>Institución de investigación</td>
              <td>Cuando el proyecto no se realiza en la escuela, sino en alguna institución o centro de investigación, el científico o asesor externo deberá llenar este formato.</td>
              <td>Según sea el caso</td>
              <td>Al terminar la experimentación (según sea el caso Fase I y/o Fase II).</td>
              <td><a class="button tiny" href="formato-1c.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato 2</td>
              <td>Científico Calificado</td>
              <td>Requisito para proyectos que involucren sujetos humanos, animales vertebrados, sustancias controladas y agentes biológicos potencialmente patógenos. Es requerida a proyectos que involucren ADN, tejidos y humanos.</td>
              <td>Según sea el caso</td>
              <td>Previo a la experimentación (según sea el caso Fase I y/o Fase II).</td>
              <td><a class="button tiny" href="cientifico-calificado.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato 3</td>
              <td>Asesoría para la evaluación de riesgos</td>
              <td>Requerido si el científico calificado como asesor no está disponible para supervisar el experimento. O si el proyecto utiliza materiales, equipos o implementos peligrosos.</td>
              <td>Según sea el caso</td>
              <td>Antes de la experimentación.</td>
              <td><a class="button tiny" href="supervisor-acesoria.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato 4 </td>
              <td>Investigación con humanos</td>
              <td>Requerido para todos los proyectos que involucran humanos. Requiere de aprobación de un Comité Institucional de Revisión previa.</td>
              <td>Según sea el caso</td>
              <td>Antes de la experimentación.</td>
              <td><a class="button tiny" href="investigacion-con-humanos.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato 5A</td>
              <td>Uso de animales vertebrados</td>
              <td>Requerido para TODOS los proyectos que involucran animales vertebrados en una institución no registrada/regulada. Requiere de aprobación de un Comité Científico de Revisión –CCR.</td>
              <td>Según sea el caso</td>
              <td>Antes de la experimentación.</td>
              <td><a class="button tiny" href="forma-5a.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato 5B</td>
              <td>Uso de animales vertebrados</td>
              <td>Requerida para todos los proyectos realizados en instituciones de investigación registradas u oficiales.<br> Se requiere además la autorización previa de un Comité Institucional de Uso y Cuidado Animal (CIUCA).</td>
              <td>Según sea el caso</td>
              <td>Antes de la experimentación.</td>
              <td><a class="button tiny" href="forma-5b.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato 6A</td>
              <td>Uso de agentes biológicos o potencialmente peligrosos</td>
              <td>Agentes biológicos potencialmente peligrosos Para TODOS los proyectos que involucran microorganismos, rADN,  tejido fresco, sangre y/o fluidos corporales. 
              <br>Requiere aprobación de CCR/CIUCA/CIBS/RAC previa a la experimentación.</td>
              <td>Según sea el caso</td>
              <td>Antes de la experimentación.</td>
              <td><a class="button tiny" href="agentes-biologicos.php">Ir a formato</a></td>
            </tr>

            <tr>
              <td>Formato 6B</td>
              <td>Uso de Tejidos de Animales Vertebrados</td>
              <td>Para TODOS los proyectos que usan tejido fresco, incluyendo sangre, productos sanguíneos, cultivos celulares primarios y fluidos corporales. Si la investigación incluye organismos vivos, llenar las formas de humanos o animales correspondientes.
              <br>Todos los proyectos que usen los tejidos mencionados, deben llenar también el formato 6A.</td>
              <td>Según sea el caso</td>
              <td>Antes de la experimentación.</td>
              <td><a class="button tiny" href="tejidos-de-animales-vertebrados.php">Ir a formato</a></td>
            </tr>
          </tbody>
        </table>

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
