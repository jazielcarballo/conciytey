<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato1c WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
			
			$("#forma_formato1c").validate({
				
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
					'actividad_centro':{ required: true },
					'idea':{ required: true },
					'reglas':{ required: true },
					'grupal':{ required: true },
					'tipo_grupo':{ required: "#grupal_si:checked" },
					'tipo_experimento':{ required: true },
					'cientifico':{ required: true },
					'cargo':{ required: true },
					'institucion':{ required: true },
					'fecha':{ required: true },
					'direccion':{ required: true },
					'telefono':{ required: true },
					'email':{ required: true }
				},
				
				messages:{
					'nombre':'Campo requerido',
					'paterno':'Campo requerido',
					'materno':'Campo requerido',
					'proyecto':'Campo requerido',
					'actividad_centro':'Campo requerido',
					'idea':'Campo requerido',
					'reglas':'Campo requerido',
					'grupal':'Campo requerido',
					'tipo_grupo':'Campo requerido',
					'tipo_experimento':'Campo requerido',
					'cientifico':'Campo requerido',
					'cargo':'Campo requerido',
					'institucion':'Campo requerido',
					'fecha':'Campo requerido',
					'direccion':'Campo requerido',
					'telefono':'Campo requerido',
					'email':'Campo requerido'
					
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
<form name="forma_formato1c" id="forma_formato1c" method="post" action="procesos/p_formato-1c.php" enctype="multipart/form-data">
      
      <input type="hidden" name="guardar" id="guardar">
      
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Formato 1C</h1>
        <h4>Institución de Investigación / Industria / Instalación</h4>
        <p>Este formulario debe ser llenado completamente por el científico que asesorará el proyecto dentro de la institución de investigación. No es para proyectos desarrollados en la escuela.</p>
        <p><strong>Este formato debe mostrarse junto con el proyecto.</strong></p>
        
          <div class="large-12 medium-12 small-12 columns">
            <label>Autor/Líder del equipo:</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="nombre" type="text" class="radius" id="nombre" value="<?= @$result_formato['lider'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['lider_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="materno" type="text" class="radius" id="materno" value="<?= @$result_formato['lider_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="large-12 medium-12 small-12 columns">
            <label>Proyecto</label>
            <input name="proyecto" type="text" class="radius" id="proyecto" value="<?= @$result_formato['proyecto'] ?>" placeholder="Proyecto"/>
            <p><strong>Debe ser llenado por el Científico Asesor, y no por el Mentor Científico, <span style="color:red; margin:0;">después de la experimentación.</span></strong></p>
          </div>
          <div class="clear"></div>
              <label><span>5.</span>
                El estudiante, al realizar su investigación en este centro: (seleccione solo una)
              	<label for="actividad_centro" class="error" style="display:none;"></label>
              </label>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="actividad_centro" value="equipo" <?php if(@$result_formato['actividad_centro'] == 'equipo') echo 'checked' ?>>
                    Solo utilizó el equipo.
                  </label>
                </div>
                <div class="large-7 medium-7 small-7 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="actividad_centro" value="colaboro" <?php if(@$result_formato['actividad_centro'] == 'colaboro') echo 'checked' ?>>
                    Colaboró en el diseño de experimentos.
                  </label>
                </div>
              </div>
              <div class="clear"></div>
              <div class="large-12 medium-12 small-12 columns">
                <label>1. ¿Cómo obtuvo la idea el estudiante para su proyecto?</label>
                <span class="nota7">(i.e. tomado de un examen o prueba, asignado, idea original del estudiante).</span>
                <textarea class="radius" name="idea" id="idea" cols="10" rows="3"><?= @$result_formato['idea'] ?></textarea>
              </div>
              <div class="clear"></div>
              <label><span>2.</span>
               ¿Estuvo Usted al tanto de las reglas del PIPCIJ antes de la experimentación?
               <label for="reglas" class="error" style="display:none;"></label>
              </label>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="reglas" value="si" <?php if(@$result_formato['reglas'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-7 medium-7 small-7 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="reglas" value="no" <?php if(@$result_formato['reglas'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>
              <div class="clear"></div>
              <label><span>3.</span>
               ¿El trabajo del estudiante fue parte de una investigación grupal?
               <label for="grupal" class="error" style="display:none;"></label>
              </label>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="grupal" id="grupal_si" value="si" <?php if(@$result_formato['grupal'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-7 medium-7 small-7 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="grupal" value="no" <?php if(@$result_formato['grupal'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>
              <div class="large-12 medium-12 small-12 columns">
                <label>En caso de ser afirmativo, ¿Qué tipo de grupo es/era? (escolar, investigadores adultos, etc.)</label>
                <input name="tipo_grupo" type="text" class="radius" id="tipo_grupo" value="<?= @$result_formato['tipo_grupo'] ?>" placeholder="Tipo de Grupo"/>
              </div>
               <div class="large-12 medium-12 small-12 columns">
                <label>4. ¿Qué tipo de experimentos realizó el estudiante y qué tan independiente trabajó?</label>
                <span class="nota7">Por favor liste y describa cada una. (No describa los procedimientos, solo las observaciones).</span>
                <textarea class="radius" name="tipo_experimento" id="tipo_experimento" cols="10" rows="3"><?= @$result_formato['tipo_experimento'] ?></textarea>
                <br>
              </div>
              <p>Los proyectos que involucran sujetos humanos, animales vertebrados no humanos o agentes biológicos potencialmente peligrosos requieren de la revisión y aprobación de un <strong>Comité Regulatorio (CCR, CIR, CIUCA, CIBS). Debe anexar una copia de su aprobación.</strong></p>
              <br>
              <div class="large-8 medium-8 small-8 columns">
                <label>Nombre del Científico Calificado</label>
                  <div class="small-12 medium-4 large-4 columns">
                <input name="cientifico" type="text" class="radius" id="nombre" value="<?= @$result_formato['cientifico'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="cientifico_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['cientifico_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="cientifico_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['cientifico_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
              </div>
              <div class="large-4 medium-4 small-4 columns">
                <label>Cargo</label>
                <input name="cargo" type="text" class="radius" id="cargo" value="<?= @$result_formato['cargo'] ?>" placeholder="Cargo"/>
              </div>
               <div class="large-6 medium-6 small-6 columns">
                <label>Institución afiliada</label>
                <input name="institucion" type="text" class="radius" id="institucion" value="<?= @$result_formato['institucion'] ?>" placeholder="Institución afiliada"/>
              </div>
              <div class="large-6 medium-6 small-12 columns">
                <label>Fecha del compromiso</label>
                <input name="fecha" type="date" class="radius" id="fecha" value="<?= @$result_formato['fecha'] ?>" placeholder="Fecha del compromiso"/>
              </div>
              <div class="clear"></div>
              <div class="large-4 medium-4 small-12 columns">
               <label>Dirección</label>  
               <input name="direccion" type="text" class="radius" id="direccion" value="<?= @$result_formato['direccion'] ?>" placeholder="Dirección"/>
              </div>
              <div class="large-4 medium-4 small-12 columns">
                <label>Teléfono</label>             
                <input name="telefono" type="text" class="radius" id="telefono" value="<?= @$result_formato['telefono'] ?>" placeholder="Teléfono"/>
              </div> 
              <div class="large-4 medium-4 small-12 columns">
                <label>Correo-e</label>
                <input name="email" type="text" class="radius" id="email" value="<?= @$result_formato['email'] ?>" placeholder="Correo-e"/>
              </div>
              <div class="clear"></div>
              <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_formato1C')[0].submit();">Guardar</button>
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
    	  <?php endif; ?>          
    </section>

     <section  class="registro print-only">
      <div class="row">
        <div class="large-5 medium-5 small-12 columns text-center">
          <br><br>
         ______________________________________________________<br>
         Firma del Científico Calificado
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
