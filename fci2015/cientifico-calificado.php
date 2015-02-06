<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	
	$sql = "SELECT * FROM formato_cientifico_calificado WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
			
			$("#forma_cientifico-calificado").validate({
				
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
					'maestrias_txt':{ required: "#maestrias:checked" },
					'doctorado_txt':{ required: "#doctorado:checked" },
					'puesto':{ required: true },
					'institucion':{ required: true },
					'direccion':{ required: true },
					'telefono':{ required: true },
					'email':{ required: true,email:true },
					'enterado':{ required: true },
					'supervisar':{ required: true },
					'designado':{ required: "#supervisar_no:checked" },
					'designado_experiencia':{ required: true },
					'precauciones':{ required: true }
					
				},
				
				messages:{
					'nombre':'Campo requerido',
					'paterno':'Campo requerido',
					'materno':'Campo requerido',
					'proyecto':'Campo requerido',
					'maestrias_txt':'Campo requerido',
					'doctorado_txt':'Campo requerido',
					'puesto':'Campo requerido',
					'institucion':'Campo requerido',
					'direccion':'Campo requerido',
					'telefono':'Campo requerido',
					'email':'Campo requerido',
					'enterado':'Campo requerido',
					'supervisar':'Campo requerido',
					'designado':'Campo requerido',
					'designado_experiencia':'Campo requerido',
					'precauciones':'Campo requerido'
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
		<form name="forma_cientifico-calificado" id="forma_cientifico-calificado" method="post" action="procesos/p_cientifico-calificado.php" enctype="multipart/form-data">
      
      	<input type="hidden" name="guardar" id="guardar">
      
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Formato 2</h1>
        <h4>Científico Calificado</h4>
        <p>Requisito para proyectos que involucren sujetos humanos, animales vertebrados, sustancias controladas y agentes biológicos potencialmente patógenos. Es requerida a proyectos que involucren ADN, tejidos y humanos.<br>
          <span style="color:red;">Deberá firmarse previamente a la experimentación.</span></p>
        
          <div class="large-8 medium-8 small-12 columns">
            <label>Estudiante autor / Líder del Proyecto</label>
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
          <div class="large-12 medium-12 small-12 columns">
            <p><strong>Para ser completado por el Científico Calificado</strong> (deberá ser del área de estudios del proyecto del estudiante)</p>
          </div>
          <div class="row">
            <div class="large-3 medium-3 small-8 columns">
              <label class="sub-checkbox">
                <input type="checkbox" name="maestrias" id="maestrias" <?php if(strlen(@$result_formato['maestrias']) > 0) echo 'checked' ?>>
                Maestría (Área)
              </label>
            </div>
            <div class="large-9 medium-9 small-12 columns">
              <input name="maestrias_txt" type="text" class="radius" id="maestrias_txt" value="<?= @$result_formato['maestrias'] ?>" placeholder="Maestría (Área)"/>
            </div>
          </div>
          <div class="row">
            <div class="large-3 medium-3 small-8 columns">
              <label class="sub-checkbox">
                <input type="checkbox" name="doctorado" id="doctorado" <?php if(strlen(@$result_formato['doctorado']) > 0) echo 'checked' ?>>
                Doctorado (Área)
              </label>
            </div>
            <div class="large-9 medium-9 small-12 columns">
              <input name="doctorado_txt" type="text" class="radius" id="doctorado_txt" value="<?= @$result_formato['doctorado'] ?>" placeholder="Doctorado (Área)"/>
            </div>
          </div>
          <div class="large-6 medium-6 small-12 columns">
            <label>Puesto</label>
            <input name="puesto" type="text" class="radius" id="puesto" value="<?= @$result_formato['puesto'] ?>" placeholder="Puesto"/>
          </div>
          <div class="large-6 medium-6 small-12 columns">
            <label>Institución</label>
            <input name="institucion" type="text" class="radius" id="institucion" value="<?= @$result_formato['institucion'] ?>" placeholder="Institución"/>
          </div>
          <div class="large-8 medium-8 small-12 columns">
            <label>Dirección</label>
            <input name="direccion" type="text" class="radius" id="direccion" value="<?= @$result_formato['direccion'] ?>" placeholder="Dirección"/>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Teléfono</label>
            <input name="telefono" type="text" class="radius" id="telefono" value="<?= @$result_formato['telefono'] ?>" placeholder="Teléfono"/>
          </div>

          <div class="clear"></div>
          <div class="large-8 medium-8 small-12 columns">
            <label>Correo electrónico</label>
            <input name="email" type="text" class="radius" id="email" value="<?= @$result_formato['email'] ?>" placeholder="Correo electrónico"/>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            
          </div>

          <div class="clear"></div>

              <div class="row">
              <label><span>1.</span>
                ¿Está Usted enterado de las reglas del PIPCIJ?
                <label for="enterado" class="error" style="display:none;"></label>
              </label>
            </div>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="enterado" value="si" <?php if(@$result_formato['enterado'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-2 medium-2 small-2 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="enterado" value="no" <?php if(@$result_formato['enterado'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>

              <div class="row">
              <label><span>2.</span>
                ¿Algo de lo siguiente será utilizado?
              </label>
            </div>
              <label>a) Sujetos Humanos</label>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="humanos" value="si" <?php if(@$result_formato['humanos'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-2 medium-2 small-2 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="humanos" value="no" <?php if(@$result_formato['humanos'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>
              <label>b)  Animales Vertebrados</label>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="vertebrados" value="si" <?php if(@$result_formato['vertebrados'] == 'si') echo 'checked' ?> >
                    Sí.
                  </label>
                </div>
                <div class="large-2 medium-2 small-2 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="vertebrados" value="no" <?php if(@$result_formato['vertebrados'] == 'no') echo 'checked' ?> >
                    No.
                  </label>
                </div>
              </div>
              <label>c) Agentes biológicos potencialmente peligrosos (microorganismos, rADN y tejidos, incluyendo sangre y sus subproductos)</label>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="biologicos" value="si" <?php if(@$result_formato['biologicos'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-2 medium-2 small-2 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="biologicos" value="no" <?php if(@$result_formato['biologicos'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>
              <label>d) Sustancias controladas (alcohol, tabaco, anfetaminas, drogas generales)</label>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="sustancias" value="si" <?php if(@$result_formato['sustancias'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-2 medium-2 small-2 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="sustancias" value="no" <?php if(@$result_formato['sustancias'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>

              <div class="row">
                <label>3) ¿Usted supervisará directamente al (los) estudiante(s)?
                <label for="supervisar" class="error" style="display:none;"></label>
                </label>
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="supervisar" value="si" <?php if(@$result_formato['supervisar'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-2 medium-2 small-2 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="supervisar" id="supervisar_no" value="no" <?php if(@$result_formato['supervisar'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>

              <div class="large-12 medium-12 small-12 columns">
                <label style="padding-top:5px;" class="left">a) Si no, ¿Quién fungirá como Supervisor Designado? </label>
                <input style="width:400px;" name="designado" type="text" class="radius" id="designado" value="<?= @$result_formato['designado'] ?>" placeholder="Supervisor Designado"/>
              </div>
              <div class="large-12 medium-12 small-12 columns">
                <label style="padding-top:5px;" class="left">b) Mencione la experiencia o entrenamiento con que cuenta dicha persona:</label>
                <input style="width:400px;" name="designado_experiencia" type="text" class="radius" id="designado_experiencia" value="<?= @$result_formato['designado_experiencia'] ?>"  placeholder="Experiencia"/>
              </div>

              <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                <label style="padding-top:5px;" class="left">4) Describa las precauciones y el entrenamiento que se tomarán para este proyecto:</label>
              </div>
              <div class="large-12 medium-12 small-12 columns">
                <input name="precauciones" type="text" class="radius" id="precauciones" value="<?= @$result_formato['precauciones'] ?>" placeholder="Precauciones y el entrenamiento"/>
              </div>
              </div>
              

              
                  <div class="large-12 medium-12 small-12 columns">
                    <p>Si es afirmativo, es requisito cumplir con la forma 3 <strong>Supervisor Designado</strong> de proyectos que involucran sustancias o implementos peligrosos.</p>
                    <hr>
                    <p>Doy fe de haber revisado y aprobado el <strong>Plan de Investigación</strong> previo al desarrollo del proyecto. Si el estudiante o el asesor designado no han sido entrenados en los procedimientos necesarios, me aseguraré de su entrenamiento y supervisión de la investigación. Estoy familiarizado con las técnicas y procedimientos descritos en el <strong>Plan de Investigación</strong>. Entiendo que un <strong>Asesor Designado</strong> deberá ser requerido cuando el estudiante no desempeñe la investigación bajo mi supervisión.</p>
                  </div>

                 <div class="clear"></div>
              <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_cientifico-calificado')[0].submit();">Guardar</button>
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
