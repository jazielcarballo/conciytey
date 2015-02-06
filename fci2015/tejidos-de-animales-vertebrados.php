<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato_tejidos_de_animales_vertebrados WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
			
			$("#forma_tejidos-de-animales-vertebrados").validate({
				
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
					'lider_paterno':{ required: true },
					'lider_materno':{ required: true },
					'proyecto':{ required: true },
					'tejido_tipo':{ required: true },
					'tejido_de':{ required: true },
					'tejido_institucion':{ required: true },
					//'supervisor_verifico':{ required: true },
					//'supervisor_certifico':{ required: true },
					'supervisor':{ required: true },
					'fecha_supervisor':{ required: true },
					'titulo_supervisor':{ required: true },
					'institucion_supervisor':{ required: true },
					'telefono_supervisor':{ required: true },
					'email_supervisor':{ 
						required: true,
						email:true 
					}
					
				},
				
				messages:{
					'lider':'Campo requerido',
					'lider_paterno':'Campo requerido',
					'lider_materno':'Campo requerido',
					'proyecto':'Campo requerido',
					'tejido_tipo':'Campo requerido',
					'tejido_de':'Campo requerido',
					'tejido_institucion':'Campo requerido',
					//'supervisor_verifico':'Campo requerido',
					//'supervisor_certifico':'Campo requerido',
					'supervisor':'Campo requerido',
					'fecha_supervisor':'Campo requerido',
					'titulo_supervisor':'Campo requerido',
					'institucion_supervisor':'Campo requerido',
					'telefono_supervisor':'Campo requerido',
					'email_supervisor':{
						'required':'Campo requerido',
						'email':'Debe ser un email valido'
					}
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
		<form name="forma_tejidos-de-animales-vertebrados" id="forma_tejidos-de-animales-vertebrados" method="post" action="procesos/p_tejidos-de-animales-vertebrados.php" enctype="multipart/form-data">
      
      		<input type="hidden" name="guardar" id="guardar">
      
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Formato 6B</h1>
        <h4>Uso de Tejidos de Animales Vertebrados</h4>
        <p>Para <strong>TODOS</strong> los proyectos que usan tejido fresco, incluyendo sangre, productos sanguíneos, cultivos celulares primarios y fluidos corporales. Si la investigación incluye organismos vivos, llenar las formas de humanos o animales correspondientes.
          <br><strong>Todos los proyectos que usen los tejidos mencionados, deben llenar también el formato 6A.</strong></p>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <label>Expocientífico/Líder del Proyecto</label>
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
            <div class="clear"></div>
            <label>Título del Proyecto:</label>
            <input name="proyecto" type="text" class="radius" id="proyecto" value="<?= @$result_formato['proyecto'] ?>" placeholder="Título del Proyecto"/>
          </div>
          </div>
          <div class="row columns">
            <p><strong>Para ser completado por el estudiante:</strong></p>
            <label>1) ¿Qué tipo de tejido(s), órgano(s) o parte(s) serán usados?</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="tejido_tipo" id="tejido_tipo" rows="3" cols="10" ><?= @$result_formato['tejido_tipo'] ?></textarea>
            </div>
            <label>2)  ¿De dónde será obtenido el tejido, órgano, o parte? (identifica cada uno por separado)</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="tejido_de" id="tejido_de" rows="3" cols="10"><?= @$result_formato['tejido_de'] ?></textarea>
            </div>
            <label>3) Si va a ser obtenido de una fuente animal viva o de una fuente en una institución registrada, proporcione información acerca del estudio del cual el tejido es obtenido. Incluye el nombre de la Institución de Investigación, el título del estudio, el número y fecha de aprobación del CIUCA.</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="tejido_institucion" id="tejido_institucion" rows="3" cols="10" ><?= @$result_formato['tejido_institucion'] ?></textarea>
            </div>
            <br>
            <p><strong>Para ser completado por el Científico Calificado o el Supervisor</strong></p>
            <div class="row">
              <label class="sub-checkbox">
                <input type="checkbox" name="supervisor_verifico" value="1" <?php if(@$result_formato['supervisor_verifico'] == '1') echo 'checked' ?>>
                Verificaré que el (los) estudiante(s) trabajen solamente con órganos, tejidos, cultivos o células que serán proporcionados por mí o personal calificado del laboratorio; y si los animales vertebrados fueran sometidos a eutanacia sería por/para propósitos diferentes a la presente investigación del (los) estudiante (s).
              </label>
            </div>
            <p><strong>Y/O</strong></p>
            <div class="row">
              <label class="sub-checkbox">
                <input type="checkbox" name="supervisor_certifico" value="1" <?php if(@$result_formato['supervisor_certifico'] == '1') echo 'checked' ?>>
                Certifico que los tejidos y fluidos usados en este proyecto serán manejados de acuerdo con los estándares   y guías expuestas conforme a las leyes locales y federales de la Secretaría de Salud así como al “Occupational Safety and Health, 29CFR, Subparte Z, 1910.1030 – Blood Borne Pathogens”.
              </label>
              <br>
            </div>
                        
              
              
          </div>

            
            <div class="row">
            <div class="small-12 medium-12 large-12 columns">
              <label>Nombre impreso del Científico Calificado o el Supervisor</label>
            <div class="small-12 medium-4 large-4 columns">
                <input name="supervisor" type="text" class="radius" id="supervisor" value="<?= @$result_formato['supervisor'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="supervisor_paterno" type="text" class="radius" id="supervisor_paterno" value="<?= @$result_formato['supervisor_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="supervisor_materno" type="text" class="radius" id="supervisor_materno" value="<?= @$result_formato['supervisor_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
            </div>
            </div>
             <div class="small-12 medium-6 large-6 columns">
              <label style="padding-top:5px;" class="left">Fecha<span style="color:red;">(abril-mayo)</span></label>
                <input name="fecha_supervisor" type="date" class="radius" id="fecha_supervisor" value="<?= @$result_formato['fecha_supervisor'] ?>" placeholder="Fecha"/>
            </div>
          <div class="clear"></div>
          <div class="row">
            <div class="small-12 medium-6 large-6 columns">
              <label>Título del Supervisor</label>
            <input name="titulo_supervisor" type="text" class="radius" id="titulo_supervisor" value="<?= @$result_formato['titulo_supervisor'] ?>" placeholder="Títluo"/>
            </div>
             <div class="small-12 medium-6 large-6 columns">
              <label style="padding-top:5px;" class="left">Institución</label>
                <input name="institucion_supervisor" type="text" class="radius" id="institucion_supervisor" value="<?= @$result_formato['institucion_supervisor'] ?>" placeholder="Institución"/>
            </div>
          </div>
          <div class="row">
            <div class="small-12 medium-6 large-6 columns">
              <label>Teléfono</label>
            <input name="telefono_supervisor" type="text" class="radius" id="telefono_supervisor" value="<?= @$result_formato['telefono_supervisor'] ?>" placeholder="Teléfono"/>
            </div>
             <div class="small-12 medium-6 large-6 columns">
              <label style="padding-top:5px;" class="left">Correo-e</label>
                <input name="email_supervisor" type="text" class="radius" id="email_supervisor" value="<?= @$result_formato['email_supervisor'] ?>" placeholder="Correo-e"/>
            </div>
          </div>
          
          </div>
          </div>

          <div class="clear"></div>
          <div class="row">
              <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_tejidos-de-animales-vertebrados')[0].submit();">Guardar</button>
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
        <div class="large-5 medium-5 small-12 columns text-center">
          <br><br>
         ______________________________________________________<br>
         Firma del Científico Calificado o Supervisor
        </div>
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
