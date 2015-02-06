<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato_5b WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	$existe_archivo = 0;
	
	if(mysql_num_rows($query) > 0){
		$result_formato = mysql_fetch_array($query);
		
		if(strlen($result_formato['archivo']) > 0) $existe_archivo = 1;
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
		
		var archivo = <?= $existe_archivo?>;
		
		$(document).on('change','#fileupload' , function(){ $('#div_error_archivo').css('display','none'); });
		
		$(function(){
			
			$("#forma-5b").validate({
				
				submitHandler: function(form) {	
					
					$('#div_error_archivo').css('display','none');
					
					$('#btn_enviar').css('visibility', 'hidden');
					$('#lbl_enviar').css('visibility', 'visible');
					
					if(!archivo && $.trim($('#fileupload').val()) == ''){
						$('#div_error_archivo').css('display','block');
						$('#btn_enviar').css('visibility', 'visible');
						$('#lbl_enviar').css('visibility', 'hidden');
						return false;
					}
					
					form.submit();					
				},
				
				rules: {
					
					'lider':{ required: true },
					'proyecto':{ required: true },
					'lider_paterno':{ required: true },
					'lider_materno':{ required: true },
					'protocolo':{ required: true },
					'idea':{ required: true },
					'reglas':{ required: true },
					'capacitacion':{ required: true },
					'especies':{ required: true },
					'numero_animales':{ required: true },
					'dolor':{ required: true },
					'rol':{ required: true },
					'file_aprobacion':{ required: true }
				},
				
				messages:{
					'lider':'Campo requerido',
					'lider_paterno':'Campo requerido',
					'lider_materno':'Campo requerido',
					'proyecto':'Campo requerido',
					'protocolo':'Campo requerido',
					'idea':'Campo requerido',
					'reglas':'Seleccione una opcion',
					'capacitacion':'Campo requerido',
					'especies':'Campo requerido',
					'numero_animales':'Campo requerido',
					'dolor':'Campo requerido',
					'rol':'Campo requerido',
					'file_aprobacion':'Campo requerido'
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
		<form name="forma-5b" id="forma-5b" method="post" action="procesos/p_forma-5b.php" enctype="multipart/form-data">
        <input type="hidden" name="guardar" id="guardar">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Forma 5B </h1>
        <h4>Uso de Animales Vertebrados</h4>
        <p><strong>Requerida para todos los proyectos realizados en instituciones de investigación registradas u oficiales.</strong></p>
        <p>Se requiere además la autorización previa de un Comité Institucional de Uso y Cuidado Animal (CIUCA).</p>
        
          <div class="large-12 medium-12 small-12 columns">
            <label>Expocientífico/Líder del proyecto</label>
            <div class="small-12 medium-4 large-4 columns">
                <input name="lider" type="text" class="radius" id="lider" value="<?= @$result_formato['lider'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_paterno" type="text" class="radius" id="lider_paterno" value="<?= @$result_formato['lider_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_materno" type="text" class="radius" id="lider_materno" value="<?= @$result_formato['lider_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
          </div>
           <div class="large-12 medium-12 small-12 columns">
            <label>Título del Proyecto: </label>
            <input name="proyecto" type="text" class="radius" id="proyecto" value="<?= @$result_formato['proyecto'] ?>" placeholder="Proyecto"/>
          </div>
          <div class="large-12 medium-12 small-12 columns">
            <label>Título y número del Protocolo de Proyecto Aprobado del CIUCA: </label>
            <input name="protocolo" type="text" class="radius" id="protocolo" value="<?= @$result_formato['protocolo'] ?>" placeholder="Título y número del Protocolo de Proyecto "/>
          </div>       
          <div class="clear"></div>
          <p><strong>A ser completado por el Científico Calificado o Director del Instituto/Laboratorio:</strong></p>
          <div class="clear"></div>

          <div class="large-12 medium-12 small-12 columns">
            <label>1. ¿Es ésta una idea original del estudiante o es un proyecto adjunto suyo?</label>
             <textarea class="radius" name="idea" id="idea" cols="10" rows="3"><?= @$result_formato['idea'] ?></textarea>   
          </div>
          <div class="large-12 medium-12 small-12 columns">
            <label>2. ¿Está usted al tanto de las reglas del PIPCIJ relativas a este proyecto?</label>
             <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="reglas" id="reglas" value="si" <?php if(@$result_formato['reglas'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-7 medium-7 small-7 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="reglas" id="reglas" value="no" <?php if(@$result_formato['reglas'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>
              <div>
              	<label for="reglas" class="error" style="display:none;"></label>
              </div>
          </div>
          <div class="clear"></div>

          <div class="large-12 medium-12 small-12 columns">
            <br>
            <label>3. ¿Qué tipo de capacitación (incluir fechas) le fue proporcionada al (los) estudiante (s)?</label>
            <textarea class="radius" name="capacitacion" id="capacitacion" cols="10" rows="3"><?= @$result_formato['capacitacion'] ?></textarea>
            <br>
          </div>
          <div class="clear"></div>

          <div class="large-8 medium-8 small-8 columns">
              <label>4. Especies de animales usadas: </label>
              <input name="especies" type="text" class="radius" id="especies" value="<?= @$result_formato['especies'] ?>" placeholder="Especies de animales"/>
          </div>
          <div class="large-3 medium-3 small-3 columns">
              <label>Número de animales usados:</label>
              <input name="numero_animales" type="text" class="radius" id="numero_animales" value="<?= @$result_formato['numero_animales'] ?>" placeholder="Número de animales usados"/>
          </div>
          <div class="clear"></div>
          <div class="large-12 medium-12 small-12 columns">
            <label>5. Categoría de permisividad de dolor designada para este estudio (Ver tabla de categorías USDA, pagina 13 de las Reglas Generales para los Proyectos participantes en las etapas Clasificatoria y Nacional):</label>
            <textarea class="radius" name="dolor" id="dolor" cols="10" rows="3"><?= @$result_formato['dolor'] ?></textarea>
            <br>
          </div>
          <div class="large-12 medium-12 small-12 columns">
            <label>Describa, en detalle, el rol del (los) estudiante (s) en este proyecto: procedimientos y equipo con que estará (n) involucrado (s); la supervisión que se le (s) dará y las medidas de precaución consideradas. (Puede anexar páginas extra, si lo considera necesario).</label>
            <textarea class="radius" name="rol" id="rol" cols="10" rows="3"><?= @$result_formato['rol'] ?></textarea>
            <br>
          </div>
         
<!--
          <div class="clear"></div>
            <p><strong>* Para completar el formulario es necesario que descargue y anexe una copia de la Aprobación de la Institución CIUCA. Una carta del Científico Calificado o Director no es suficiente.</strong></p>
            <div class="clear"></div>

            <div class="large-3 medium-4 small-12 columns">
                <a class="button" href="pdf/certificacion.pdf" target="_blank">Descargar Certificado</a>
            </div>
			
             <div class="large-9 medium-9 small-12 columns">
                <label for="">Adjuntar Aprobación</label>
                <input type="file" name="file_aprobacion" multiple placeholder="Choose File">
            </div> -->
            
            <div class="clear"></div>
            <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma-5b')[0].submit();">Guardar</button>
              </div>
              <div class="large-2 medium-3 small-12 columns">
                <input style="width:150px;" onClick="window.print();" type="button" class="btn btn-imprimir" name="" id="" value="Imprimir">
              </div>
              <div class="large-4 medium-4 small-12 columns">
                <input type="file" name="file_formato" id="fileupload"/>
                <label id="fileupload-label" for="fileupload">SUBIR ARCHIVOS</label>
              </div>
              <div class="large-3 medium-3 small-12 columns">
                <button type="submit" class="btn btn-5" name="btn_enviar" id="btn_enviar">Enviar</button>
                <label id="lbl_enviar" style="visibility:hidden;">
                    <img id="img_save_sub" src="img/cargando_2.gif" border="0"/>
                    &nbsp; Enviando...                                
                </label>
              </div>
              <!-- Mensaje de error -->
              <div id="div_error_archivo" class="large-9 push-1 medium-10 small-12 columns log-error text-center" style="display:none; font-size:.85em;" >
                Es necesario anexar el formato impreso ( subir archivo ) para completar el formulario
              </div>
		</form>
    <?php endif; ?>  <!--fin-->  
    </section>
    <section  class="registro print-only">
      <div class="row">
        <img src="img/permiso-5b.jpg" alt="">
      </div>

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
