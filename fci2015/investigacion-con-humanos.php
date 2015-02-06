<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato_investigacion_con_humanos WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
			
			$("#forma_investigacion-con-humanos").validate({
				
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
					
					'nombre':{ required: true },
					'paterno':{ required: true },
					'materno':{ required: true },
					'proyecto':{ required: true },
					'proposito':{ required: true },
					'riesgos':{ required: true },
					'procedimientos':{ required: true },
					'contacto_estudiante':{ required: true },
					'contacto_mentor':{ required: true },
					'nivel_riesgo':{ required: true },
					'medico':{ required: true },
					'fecha_medico':{ required: true },
					'profesor':{ required: true },
					'fecha_profesor':{ required: true },
					'administrador':{ required: true },
					'fecha_administrador':{ required: true },
					/*
					'condiciones_humano':{ required: true },
					'libre_humano':{ required: true },
					'imagenes_humano':{ required: true },
					'nombre_humano':{ required: true },
					'fecha_humano':{ required: true },
					'condiciones_padre':{ required: true },
					'cuestionarios_padre':{ required: true },
					'imagenes_padre':{ required: true }
					*/
				},
				
				messages:{
					'nombre':'Campo requerido',
					'paterno':'Campo requerido',
					'materno':'Campo requerido',
					'proyecto':'Campo requerido',
					'proposito':'Campo requerido',
					'riesgos':'Campo requerido',
					'procedimientos':'Campo requerido',
					'contacto_estudiante':'Campo requerido',
					'contacto_mentor':'Campo requerido',
					'nivel_riesgo':'Seleccione una',
					'medico':'Campo requerido',
					'fecha_medico':'Campo requerido',
					'profesor':'Campo requerido',
					'fecha_profesor':'Campo requerido',
					'administrador':'Campo requerido',
					'fecha_administrador':'Campo requerido'
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
	<form name="forma_investigacion-con-humanos" id="forma_investigacion-con-humanos" method="post" action="procesos/p_investigacion-con-humanos.php" enctype="multipart/form-data">
      
      <input type="hidden" name="guardar" id="guardar">
      
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Formato 4</h1>
        <h4>Investigación con humanos</h4>
        <p>Requerido para todos los proyectos que involucran humanos. Requiere de aprobación de un<br>
          Comité Institucional de Revisión <span style="color:red;">previa a la fase experimental.</span></p>
        <div class="row">
          <div class="large-8 medium-8 small-12 columns">
            <label>Autor/Líder del Proyecto</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="nombre" type="text" class="radius" id="nombre" value="<?= @$result_formato['lider'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['lider_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="materno" type="text" class="radius" id="materno" value="<?= @$result_formato['lider_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
            <label>Título del Proyecto:</label>
            <input name="proyecto" type="text" class="radius" id="proyecto" value="<?= @$result_formato['proyecto'] ?>" placeholder="Título del Proyecto"/>
          </div>
          </div>
          <div class="row columns">
            <p><strong>Para ser completado por el estudiante en colaboración con el Supervisor /Científico Calificado</strong> (Todas las preguntas son aplicables y deben contestarse. Pueden anexarse más hojas)</p>
            <label>1) Describe el propósito de esta investigación y lista todos los procedimientos en los que el sujeto estará implicado. Incluye la duración de su participación. Anexa encuestas y cuestionarios a utilizar.</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="proposito" id="proposito"><?= @$result_formato['proposito'] ?></textarea>
            </div>
            <label>2) Describe y evalúa cualquier riesgo potencial o incomodidad, así como posibles beneficios (físico, psicológico, social, legal, etc.) que se esperen por su participación en este proyecto.</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="riesgos" id="riesgos"><?= @$result_formato['riesgos'] ?></textarea>
            </div>
            <label>3) Describe los procedimientos que serán utilizados para minimizar el riesgo, para obtener su consentimiento y para mantener la confidencialidad.</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="procedimientos" id="procedimientos"><?= @$result_formato['procedimientos'] ?></textarea>
            </div>
            <div class="row">
            <label>Para resolver dudas acerca de este proyecto, contactar a:</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="contacto_estudiante" type="text" class="radius" id="nombre" value="<?= @$result_formato['contacto_estudiante'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="contacto_estudiante_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['contacto_estudiante_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="contacto_estudiante_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['contacto_estudiante_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
            </div>
            <div class="large-12 medium-12 small-12 columns">
                <label style="padding-top:5px;" class="left">Para resolver dudas acerca de este proyecto, contactar a:</label>
                <input style="width:280px;" name="contacto_mentor" type="text" class="radius" id="contacto_mentor" value="<?= @$result_formato['contacto_mentor'] ?>" placeholder="Mentor"/>
              </div>
          </div>

          	<?php $arr_nivel_riesgo = explode(',',@$result_formato['nivel_riesgo']);?>
                  <div class="large-12 medium-12 small-12 columns">
                    <div class="top50"></div>
                    <p><strong>Para ser contestado por el CIR antes del desarrollo del proyecto.</strong></p>
                    <p>Determinación del riesgo, incluyendo riesgos físicos y psicológicos (Ver Reglas del PIPCIJ, Evaluación del Riesgo, página 5) de las Reglas Generales para los Proyectos participantes en las etapas Clasificatoria y Nacional.</p>
                    <p>Elija solo aquella que describa el riesgo apropiadamente.</p>
                    <div class="row">
                      <label class="sub-checkbox">
                        <input type="radio" name="nivel_riesgo" value="recomendado" <?php if(in_array('recomendado',$arr_nivel_riesgo)) echo 'checked' ?>>
                        Mínimo riesgo donde el consentimiento informado es recomendado, pero no  obligatorio.
                      </label>
                      <label class="sub-checkbox">
                        <input type="radio" name="nivel_riesgo" value="obligatorio" <?php if(in_array('obligatorio',$arr_nivel_riesgo)) echo 'checked' ?>>
                        Mínimo riesgo donde el consentimiento informado es OBLIGATORIO.
                      </label>
                      <label class="sub-checkbox">
                        <input type="radio" name="nivel_riesgo" value="cientifico_calificado" <?php if(in_array('cientifico_calificado',$arr_nivel_riesgo)) echo 'checked' ?>>
                        Más que mínimo riesgo: se requiere consentimiento informado y Científico Calificado.
                      </label>
                    </div>
                    <div>
                    	<label for="nivel_riesgo" class="error" style="display:none;"></label>
                    </div>
                  </div>

          <div class="row">
            <p><b>Firmas del CIR (Un mínimo de tres firmas es requerido).</b></p>
            <label>1) Médico profesionista (psicólogo, psiquiatra, médico, asistente físico, trabajador(a) social con licencia o enfermera certificada; marque uno)</label>
            <div class="small-12 medium-6 large-6 columns">
              <label>Nombre</label>
            <input name="medico" type="text" class="radius" id="medico" value="<?= @$result_formato['medico'] ?>" placeholder="Miembro del CIR"/>
            </div>
            <div class="small-12 medium-6 large-6 columns">
              <label>Fecha de aprobación</label>
            <input name="fecha_medico" type="date" class="radius" id="fecha_medico" value="<?= @$result_formato['fecha_medico'] ?>" placeholder="Fecha de aprobación"/>
            </div>

            <label>2)  Profesor de Ciencias</label>
            <div class="small-12 medium-6 large-6 columns">
              <label>Nombre</label>
            <input name="profesor" type="text" class="radius" id="profesor" value="<?= @$result_formato['profesor'] ?>" placeholder="Miembro del CIR"/>
            </div>
            <div class="small-12 medium-6 large-6 columns">
              <label>Fecha de aprobación</label>
            <input name="fecha_profesor" type="date" class="radius" id="fecha_profesor" value="<?= @$result_formato['fecha_profesor'] ?>" placeholder="Fecha de aprobación"/>
            </div>

             <label>3)  Administrador escolar</label>
            <div class="small-12 medium-6 large-6 columns">
              <label>Nombre</label>
            <input name="administrador" type="text" class="radius" id="administrador" value="<?= @$result_formato['administrador'] ?>" placeholder="Miembro del CIR"/>
            </div>
            <div class="small-12 medium-6 large-6 columns">
              <label>Fecha de aprobación</label>
            <input name="fecha_administrador" type="date" class="radius" id="fecha_administrador" value="<?= @$result_formato['fecha_administrador'] ?>" placeholder="Fecha de aprobación"/>
            </div>
          </div>

          <div class="row">
            <p><b>Para completar por el Sujeto Humano (Antes de las pruebas): </b></p>
              <label class="sub-checkbox">
                <input type="checkbox" name="condiciones_humano" value="1" <?php if(@$result_formato['condiciones_humano'] == '1') echo 'checked' ?>>
                He leído y entiendo las condiciones y acepto voluntariamente participar en este estudio como sujeto de investigación.
              </label>
              <label class="sub-checkbox">
                <input type="checkbox" name="libre_humano" value="1" <?php if(@$result_formato['libre_humano'] == '1') echo 'checked' ?>>
                Me doy cuenta y soy libre de retirarme de este estudio sin represalias de cualquier clase.
              </label>
              <label class="sub-checkbox">
                <input type="checkbox" name="imagenes_humano" value="1" <?php if(@$result_formato['imagenes_humano'] == '1') echo 'checked' ?>>
                Apruebo el uso de imágenes (fotos, videos, etc.) que muestren mi participación en este proyecto.
              </label>
              <div class="row">
                <div class="small-12 medium-6 large-6 columns">
                  <label>Nombre</label>
                  <div class="small-12 medium-4 large-4 columns">
                <input name="nombre_humano" type="text" class="radius" id="nombre" value="<?= @$result_formato['nombre_humano'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="nombre_humano_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['nombre_humano_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="nombre_humano_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['nombre_humano_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
                </div>
                <div class="small-12 medium-6 large-6 columns">
                  <label>Fecha</label>
                  <input name="fecha_humano" type="date" class="radius" id="fecha_humano" placeholder="Fecha" value="<?= @$result_formato['fecha_humano'] ?>"/>
                </div>
              </div>
              <p><b>Para completar por el Padre/Tutor (Antes de las pruebas y cuando el participante es menor de 18 años):</b></p>
              <label class="sub-checkbox">
                <input type="checkbox" name="condiciones_padre" value="1" <?php if(@$result_formato['condiciones_padre'] == '1') echo 'checked' ?>>
                He leído y entiendo las condiciones y riesgos establecidos por el proyecto y acepto la participación de mi hijo/protegido.
              </label>
              <label class="sub-checkbox">
                <input type="checkbox" name="cuestionarios_padre" value="1" <?php if(@$result_formato['cuestionarios_padre'] == '1') echo 'checked' ?>>
                He revisado una copia de los cuestionarios y encuestas que se usarán en la investigación.
              </label>
              <label class="sub-checkbox">
                <input type="checkbox" name="imagenes_padre" value="1" <?php if(@$result_formato['imagenes_padre'] == '1') echo 'checked' ?>>
                Apruebo el uso de imágenes (fotos, videos, etc.) involucrando a mi hijo/protegido en este proyecto.
              </label>
              <div class="row">
                <div class="small-12 medium-6 large-6 columns">
                  <label>Nombre</label>
                  <div class="small-12 medium-4 large-4 columns">
                <input name="nombre_padre" type="text" class="radius" id="nombre" value="<?= @$result_formato['nombre_padre'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="nombre_padre_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['nombre_padre_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="nombre_padre_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['nombre_padre_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
                </div>
                <div class="small-12 medium-6 large-6 columns">
                  <label>Fecha</label>
                  <input name="nombre_padre_fecha_padre" type="date" class="radius" id="fecha_padre" value="<?= @$result_formato['fecha_padre'] ?>" placeholder="Fecha"/>
                </div>
              </div>
          </div>
          <div class="clear"></div>
              <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_investigacion-con-humanos')[0].submit();">Guardar</button>
              </div>
              <div class="large-2 medium-3 small-12 columns">
                <input style="width:150px;" onClick="window.print();" type="button" class="btn btn-imprimir" name="" id="" value="Imprimir">
              </div>
              <div class="large-4 medium-4 small-12 columns">
                <input type="file" name="file_formato" id="fileupload"/>
                <label id="fileupload-label" for="fileupload">SUBIR ARCHIVO</label>
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
        <div class="large-5 medium-5 small-12 columns text-center">
          <br><br>
         ______________________________________________________<br>
         Firma del Médico profesionista 
        </div>
        <div class="large-5 medium-5 small-12 columns text-center">
          <br><br>
         ______________________________________________________<br>
         Firma del Profesor de Ciencias 
        </div>
        <div class="large-5 medium-5 small-12 columns text-center">
          <br><br>
         ______________________________________________________<br>
         Firma del Administrador escolar
        </div>
        <br><br><br>
        <strong>Antes de las Pruebas</strong>
        <div class="large-5 medium-5 small-12 columns text-center">
          <br><br>
         ______________________________________________________<br>
         Firma del Sujeto Humano
        </div>
        <div class="large-5 medium-5 small-12 columns text-center">
          <br><br>
         ______________________________________________________<br>
         *Firma del el Padre/Tutor 
         (Cuando el participante es menor de 18 años)
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
