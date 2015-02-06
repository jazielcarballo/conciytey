<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato_proyecto_en_continuidad WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	if(mysql_num_rows($query) > 0){
		$result_formato = mysql_fetch_array($query);
	}
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
			
			$("#forma_proyecto-en-continuidad").validate({
				/*
				submitHandler: function(form) {	
					
					$('#btn_enviar').css('visibility', 'hidden');
					$('#lbl_enviar').css('visibility', 'visible');
					
					var forma = $('#forma_proyecto-en-continuidad').serialize();
					$.post( "procesos/p_proyecto-en-continuidad.php", forma, function( data ) {
						if($.trim(data) != ''){							
							alert(data);							
							$('#btn_enviar').css('visibility', 'visible');
							$('#lbl_enviar').css('visibility', 'hidden');
						}else{
							alert('Gracias por enviarnos tus datos.');
							window.location='registro-ok.php';							
						}				  		
					});
										
					return false;					
				},
				*/
				rules: {
					'lider':{ required: true },
					'lider_paterno':{ required: true },
					'lider_materno':{ required: true },
					'proyecto':{ required: true },
					'titulo_actual':{ required: true },
					'objetivos_actual':{ required: true },
					'variables_actual':{ required: true },
					'investigacion_actual':{ required: true },
					'cambios_actual':{ required: true },
					'lider_informacion':{ required: true },
					'fecha_informacion':{ required: true }
				},
				
				messages:{
					'lider':'Campo requerido',
					'lider_paterno':'Campo requerido',
					'lider_materno':'Campo requerido',
					'proyecto':'Campo requerido',
					'titulo_actual':'Campo requerido',
					'objetivos_actual':'Campo requerido',
					'variables_actual':'Campo requerido',
					'investigacion_actual':'Campo requerido',
					'cambios_actual':'Campo requerido',
					'lider_informacion':'Campo requerido',
					'fecha_informacion':'Campo requerido'
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
    ?> <!-- inicio-->

      <?php  require('instrucciones.php'); ?>
		<form name="forma_proyecto-en-continuidad" id="forma_proyecto-en-continuidad" method="post" action="procesos/p_proyecto-en-continuidad.php" enctype="multipart/form-data">
      
      	<input type="hidden" name="guardar" id="guardar">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Formato 7</h1>
        <h4>Proyecto en Continuidad</h4>
        <p>Requerido si continúan dentro del mismo campo de estudio que el año anterior; proyectos que se exhiban en la <strong>FMCI</strong><br>
          deberán estar acompañados del <strong>RENPE</strong> o <strong>FOLIO</strong> del año anterior, así como el <strong>Plan de Investigación correspondiente</strong>.<br>
          <strong>De ser necesario utiliza hojas separadas para listar años anteriores.</strong></p>
        <div class="row">
          <div class="large-8 medium-8 small-12 columns">
            <label>Expocientífico/Líder del Proyecto</label>
            <div class="small-12 medium-4 large-4 columns">
                <input name="lider" type="text" class="radius" id="lider" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_paterno" type="text" class="radius" id="lider_paterno" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_materno" type="text" class="radius" id="lider_materno" placeholder="Apellido Materno"/>
              </div>
            </div>
          </div>  
          <div class="large-8 medium-8 small-12 columns">  
            <label>Título del Proyecto:</label>
            <input name="proyecto" type="text" class="radius" id="proyecto" placeholder="Título del Proyecto"/>
          </div>
         
          </div>

          <div class="row">
            <p><strong>Para ser completado por el Expocientífico.</strong> Enlista todos los componentes del proyecto actual que lo hagan nuevo y diferente del de año(s) anterior(es) Usa un formato adicional si tienes antecedentes del año 2009.</p>
            <label>1. Título</label>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto actual</label>
            <input name="titulo_actual" type="text" class="radius" id="titulo_actual" placeholder="Proyecto Actual"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto de Investigación anterior</label>
            <input name="titulo_anterior" type="text" class="radius" id="titulo_anterior" placeholder="2010-2011"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto de Investigación anterior</label>
            <input name="titulo_anterior2" type="text" class="radius" id="titulo_anterior2" placeholder="2009-2010"/>
            </div>
            <label>2. Objetivos</label>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto actual</label>
            <input name="objetivos_actual" type="text" class="radius" id="objetivos_actual" placeholder="Proyecto Actual"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto de Investigación anterior</label>
            <input name="objetivos_anterior" type="text" class="radius" id="objetivos_anterior" placeholder="2010-2011"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto de Investigación anterior</label>
            <input name="objetivos_anterior2" type="text" class="radius" id="objetivos_anterior2" placeholder="2009-2010"/>
            </div>
            <label>3. Variables estudiadas</label>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto actual</label>
            <input name="variables_actual" type="text" class="radius" id="variables_actual" placeholder="Proyecto Actual"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto de Investigación anterior</label>
            <input name="variables_anterior" type="text" class="radius" id="variables_anterior" placeholder="2010-2011"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto de Investigación anterior</label>
            <input name="variables_anterior2" type="text" class="radius" id="variables_anterior2" placeholder="2009-2010"/>
            </div>
            <label>4. Línea de investigación</label>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto actual</label>
            <input name="investigacion_actual" type="text" class="radius" id="investigacion_actual" placeholder="Proyecto Actual"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto de Investigación anterior</label>
            <input name="investigacion_anterior" type="text" class="radius" id="investigacion_anterior" placeholder="2010-2011"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto de Investigación anterior</label>
            <input name="investigacion_anterior2" type="text" class="radius" id="investigacion_anterior2" placeholder="2009-2010"/>
            </div>
            <label>5. Cambios adicionales</label>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto actual</label>
            <input name="cambios_actual" type="text" class="radius" id="cambios_actual" placeholder="Proyecto Actual"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto de Investigación anterior</label>
            <input name="cambios_anterior" type="text" class="radius" id="cambios_anterior" placeholder="2010-2011"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
              <label>Proyecto de Investigación anterior</label>
            <input name="cambios_anterior2" type="text" class="radius" id="cambios_anterior2" placeholder="2009-2010"/>
            </div>
            <p><strong>Este formato debe mostrarse en tu stand para ayudar a los jueces a comprender mejor tu trabajo y lo que se hizo en el presente año.</strong></p>
          </div>

          <div class="row">
            <p>Por la presente, declaro que la información anterior es correcta; que el RENPE o FOLIO y el proyecto expuesto reflejan adecuadamente el trabajo realizado durante el año.</p>
            <div class="small-12 medium-6 large-6 columns">
              <label>Estudiante autor/Líder del Proyecto</label>
            <div class="small-12 medium-4 large-4 columns">
                <input name="lider_informacion" type="text" class="radius" id="lider_informacion" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_informacion_paterno" type="text" class="radius" id="lider_informacion_paterno" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_informacion_materno" type="text" class="radius" id="lider_informacion_materno" placeholder="Apellido Materno"/>
              </div>
            </div>
            </div>
            <div class="small-12 medium-6 large-6 columns">
              <label>Fecha</label>
            <input name="fecha_informacion" type="date" class="radius" id="fecha_informacion" placeholder="Fecha"/>
            </div>
          </div>
          <div class="clear"></div>
              <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_proyecto-en-continuidad')[0].submit();">Guardar</button>
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
    <?php endif; ?>  <!--fin--> 
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
