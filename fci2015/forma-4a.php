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
<script src="js/vendor/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
    
    <script language="javascript">
	
		$(function(){
			
			$("#forma-4a").validate({
				
				rules: {
					
					'expocientifico':{ required: true },
					'expocientifico_paterno':{ required: true },
					'expocientifico_materno':{ required: true },
					'proyecto':{ required: true },
					'mentor':{ required: true },
					'email':{ required: true, email:true },
					'proposito':{ required: true },
					'participas':{ required: true },
					'tiempo':{ required: true },
					'riesgos':{ required: true },
					'beneficios':{ required: true },
					'confidencialidad':{ required: true },
					'dudas_mentor':{ required: true },
					'dudas_telefono':{ required: true },
					'dudas_email':{ required: true, email:true },
					'dudas_padre':{ required: true },
					'file_permiso':{ required: true }
					
				},
				
				messages:{
					'expocientifico':'Campo requerido',
					'expocientifico_paterno':'Campo requerido',
					'expocientifico_materno':'Campo requerido',
					'proyecto':'Campo requerido',
					'mentor':'Campo requerido',
					'email':{'required':'Campo requerido','email': 'Debe ser un email valido'},
					'proposito':'Campo requerido',
					'participas':'Campo requerido',
					'tiempo':'Campo requerido',
					'riesgos':'Campo requerido',
					'beneficios':'Campo requerido',
					'confidencialidad':'Campo requerido',
					'dudas_mentor':'Campo requerido',
					'dudas_telefono':'Campo requerido',
					'dudas_email':{'required':'Campo requerido','email': 'Debe ser un email valido'},
					'dudas_padre':'Campo requerido',
					'file_permiso':'Campo requerido'
				}	 
			});
			
		})
		
	</script>
    
    <style>
		label.error {
			color: #f04124;
		}
	</style>
  </head>
  <body>
    <?php  require('header-estados.php'); ?>

    <section class="registro">
      <?php 
      if(@$result_formato['terminado'] == 1): 
        echo '<div class="row"><div class="large-12 medium-12 small-12 columns"><h4>Formulario enviado correctamente.</h4></div></div>';
      else:
    ?>
  
      <?php  require('instrucciones.php'); ?>
		<form name="forma-4a" id="forma-4a" method="post" action="procesos/p_forma-4a.php" enctype="multipart/form-data">
      
      	<input type="hidden" name="guardar" id="guardar">
      
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Forma 4A </h1>
        <h4>Consentimiento Humano Informado</h4>
        <p><strong>Instrucciones: Una forma de consentimiento/permiso Informado debe desarrollarse con el Mentor, Científico Calificado o Supervisor Designado. Esta forma se usa para dar información al participante de la investigación (o al padre/tutor/guardián) y para documentar el consentimiento por escrito, aceptación de un menor o permiso de los padres.</strong></p>
        <ul>
          <li>Cuando  se  requiere  la  documentación  escrita,  el  investigador  debe  conservar  las  formas  originales firmadas.</li>
          <li>Los  estudiantes  pueden  usar  esta  muestra  de  forma  o  copiar  todos  los  elementos  en  un  nuevo documento.</li>
          <li>Si la forma funcionará como permiso de padres, deben anexar copia del cuestionario o encuesta.</li>
        </ul>
        
          <div class="large-12 medium-12 small-12 columns">
            <label>Expocientífico</label>
            <div class="small-12 medium-4 large-4 columns">
                <input name="expocientifico" type="text" class="radius" id="expocientifico" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="expocientifico_paterno" type="text" class="radius" id="mentor_paterno" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="expocientifico_materno" type="text" class="radius" id="mentor_materno" placeholder="Apellido Materno"/>
              </div>
          </div>
           <div class="large-12 medium-12 small-12 columns">
            <label>Proyecto</label>
            <input name="proyecto" type="text" class="radius" id="proyecto" placeholder="Proyecto"/>
          </div>       
          <div class="clear"></div>

          <p><strong>Estoy solicitando tu participación voluntaria en mi proyecto de investigación para una Feria de Ciencias.  Favor de leer la siguiente información. Si deseas participar, favor de firmar en el espacio correspondiente de abajo.</strong></p>
          <div class="clear"></div>

          <div class="large-8 medium-8 small-12 columns">
            <label>4. Mentor:</label>
            <div class="small-12 medium-4 large-4 columns">
                <input name="nombre" type="text" class="radius" id="nombre" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="paterno" type="text" class="radius" id="paterno" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="materno" type="text" class="radius" id="materno" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Correo electrónico</label>
            <input name="email" type="email" class="radius" id="email" placeholder="Correo electrónico"/>
          </div>
          <div class="clear"></div>

          <div class="large-12 medium-12 small-12 columns">
            <label>Propósito del proyecto:</label>
            <textarea class="radius" name="proposito" id="proposito" cols="10" rows="3"></textarea>
            <br>
          </div>
          <div class="large-12 medium-12 small-12 columns">
            <label>Si participas, se te pedirá que:</label>
            <textarea class="radius" name="participas" id="participas" cols="10" rows="3"></textarea>
            <br>
          </div>
          <div class="large-12 medium-12 small-12 columns">
            <label>Tiempo requerido de participación:</label>
            <textarea class="radius" name="tiempo" id="tiempo" cols="10" rows="3"></textarea>
            <br>
          </div>
          <div class="large-12 medium-12 small-12 columns">
            <label>Riesgos potenciales del estudio:</label>
            <textarea class="radius" name="riesgos" id="riesgos" cols="10" rows="3"></textarea>
            <br>
          </div>
          <div class="large-12 medium-12 small-12 columns">
            <label>Beneficios:</label>
            <textarea class="radius" name="beneficios" id="beneficios" cols="10" rows="3"></textarea>
            <br>
          </div>
          <div class="large-12 medium-12 small-12 columns">
            <label>Como se mantendrá la confidencialidad:</label>
            <textarea class="radius" name="confidencialidad" id="confidencialidad" cols="10" rows="3"></textarea>
            <br>
          </div>
          <div class="clear"></div>
          <label for="">Para resolver dudas acerca de este proyecto, contacta a:  </label>
           <div class="large-12 medium-12 small-12 columns">
            <label>Mentor</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="dudas_mentor" type="text" class="radius" id="dudas_mentor" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="mentor_paterno" type="text" class="radius" id="mentor_paterno" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="mentor_materno" type="text" class="radius" id="mentor_materno" placeholder="Apellido Materno"/>
              </div>
          </div>
           <div class="large-4 medium-4 small-12 columns">
              <label>Teléfono</label>            
              <input name="dudas_telefono" type="text" class="radius" id="dudas_telefono" placeholder="Teléfono"/>
            </div>
            <div class="large-3 medium-4 small-12 columns">
                <label>Correo-e</label>
                <input name="dudas_email" type="text" class="radius" id="dudas_email" placeholder="Correo-e"/>
            </div>
            <div class="clear"></div>
            <div class="large-7 medium-7 small-12 columns">
                <label>Nombre del Padre o Guardián</label>

                  <div class="small-12 medium-4 large-4 columns">
                <input name="dudas_padre" type="text" class="radius" id="dudas_padre" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="padre_paterno" type="text" class="radius" id="padre_paterno" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="padre_materno" type="text" class="radius" id="padre_materno" placeholder="Apellido Materno"/>
              </div>

            </div>
            <div class="clear"></div>
            <p><strong>*Para completar esta forma es necesario descargar el archivo de permiso, llenarlo, escanearlo y subirlo</strong></p>
            <div class="clear"></div>

            <div class="large-3 medium-4 small-12 columns">
                <a class="button" href="pdf/permiso.pdf" target="_blank">Descargar Permiso</a>
            </div>


            <div class="large-9 medium-9 small-12 columns">
                <label for="">Adjuntar Permiso</label>
                <input type="file" name="file_permiso" multiple placeholder="Choose File">
            </div>

            <div class="clear"></div>
            <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onclick="$('#guardar').val(1);$('#forma-4a')[0].submit();">Guardar</button>
              </div>
              <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-imprimir" name="" id="">Imprimir</button>
              </div>
              <div class="large-4 medium-4 small-12 columns">
                <input type="file" id="fileupload"/>
                <label id="fileupload-label" for="fileupload">SUBIR ARCHIVOS</label>
              </div>
              <div class="large-3 medium-3 small-12 columns">
                <button type="submit" class="btn btn-5" name="btn_enviar" id="btn_enviar">Enviar</button>
                <label id="lbl_enviar" style="visibility:hidden;">
                    <img id="img_save_sub" src="img/cargando_2.gif" border="0"/>
                    &nbsp; Enviando...                                
                </label>
              </div>
		</form>
    <?php endif; ?>   
    </section>

    <?php
     require('footer.php');
      ?>

    <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
    <script>
    webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
</script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
