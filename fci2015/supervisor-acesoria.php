<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato_supervisor_asesoria WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
			
			$("#forma_supervisor-acesoria").validate({
				
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
					
					'expocientifico':{ required: true },
					'expocientifico_paterno':{ required: true },
					'expocientifico_materno':{ required: true },
					'proyecto':{ required: true },
					'quimicos':{ required: true },
					'riesgos':{ required: true },
					'seguridad':{ required: true },
					'procedimientos':{ required: true },
					'fuentes':{ required: true },
					'supervisor':{ required: true },
					'supervisor_paterno':{ required: true },
					'supervisor_materno':{ required: true },
					'puesto':{ required: true },
					'telefono':{ required: true },
					'email':{ 
						required: true,
						email: true 
					},
					'fecha_compromiso':{ required: true }
				},
				
				messages:{
					'expocientifico':'Campo requerido',
					'expocientifico_paterno':'Campo requerido',
					'expocientifico_materno':'Campo requerido',
					'proyecto':'Campo requerido',
					'quimicos':'Campo requerido',
					'riesgos':'Campo requerido',
					'seguridad':'Campo requerido',
					'procedimientos':'Campo requerido',
					'fuentes':'Campo requerido',
					'supervisor':'Campo requerido',
					'supervisor_paterno':'Campo requerido',
					'supervisor_materno':'Campo requerido',
					'puesto':'Campo requerido',
					'telefono':'Campo requerido',
					'email':{
						'required':'Campo requerido',
						'email':'Debe ser un email valido'
					},
					'fecha_compromiso':'Campo requerido',
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
	<form name="forma_supervisor-acesoria" id="forma_supervisor-acesoria" method="post" action="procesos/p_supervisor-acesoria.php" enctype="multipart/form-data">
		<input type="hidden" name="guardar" id="guardar">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Formato 3</h1>
        <h4>Supervisor para asesoría / Evaluación de Riesgos</h4>
        <p>Requerido si el científico calificado como asesor no está disponible para supervisar el experimento.<br>O si el proyecto utiliza materiales, equipos o implementos peligrosos.<br>
          <span style="color:red;">Debe completarse antes de la experimentación.</span></p>
        <div class="row">
          <div class="large-8 medium-8 small-12 columns">
            <label>Expocientífico</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="expocientifico" type="text" class="radius" id="nombre" value="<?= @$result_formato['expocientifico'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="expocientifico_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['expocientifico_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="expocientifico_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['expocientifico_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
            <label>Título del Proyecto:</label>
            <input name="proyecto" type="text" class="radius" id="proyecto" value="<?= @$result_formato['proyecto'] ?>" placeholder="Título del Proyecto"/>
          </div>
          </div>
          <div class="row columns">
            <p><strong>Para ser completado por el estudiante con la colaboración del Supervisor /Científico Calificado</strong> (Todas las preguntas deben ser contestadas. Pueden agregarse páginas adicionales).</p>
            <label>1. Liste/Identifique los químicos, actividades o equipo que será utilizado.</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="quimicos" id="quimicos"> <?= @$result_formato['quimicos'] ?></textarea>
            </div>
            <label>2. Identifique y evalúe los riesgos potenciales.</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="riesgos" id="riesgos" ><?= @$result_formato['riesgos'] ?></textarea>
            </div>
            <label>3. Describa las medidas de seguridad y procedimientos a utilizar para reducir los riesgos.</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="seguridad" id="seguridad" ><?= @$result_formato['seguridad'] ?></textarea>
            </div>
            <label>4. Describa los procedimientos a utilizar para disponer de los desechos (si es el caso).</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="procedimientos" id="procedimientos"><?= @$result_formato['procedimientos'] ?></textarea>
            </div>
            <label>5. Liste las fuentes de información de seguridad.</label>
            <div class="small-12 medium-12 large-12 columns">
              <textarea name="fuentes" id="fuentes" value="<?= @$result_formato['fuentes'] ?>"><?= @$result_formato['fuentes'] ?></textarea>
            </div>
          </div>

          
                  <div class="large-12 medium-12 small-12 columns">
                    <div class="top50"></div>
                    <p><strong>Para completar por el Supervisor /Científico Calificado:</strong></p>
                    <p>Concuerdo con la evaluación de riesgos y programa de precauciones descritas anteriormente. Certifico que he revisado el <b>Plan de Investigación</b> y proveeré supervisión/capacitación directa.</p>
                  </div>

          <div class="row">
            <div class="small-12 medium-6 large-6 columns">
              <label>Nombre impreso del Supervisor</label>
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
            <div class="small-12 medium-6 large-6 columns">
              <label>Puesto e Institución</label>
            <input name="puesto" type="text" class="radius" id="puesto" value="<?= @$result_formato['puesto'] ?>" placeholder="Puesto"/>
            </div>
          </div>
          <div class="row">
            <div class="small-12 medium-6 large-6 columns">
              <label>Teléfono</label>
            <input name="telefono" type="text" class="radius" id="telefono" value="<?= @$result_formato['telefono'] ?>" placeholder="Teléfono"/>
            </div>
            <div class="small-12 medium-6 large-6 columns">
              <label>Correo electrónico</label>
            <input name="email" type="text" class="radius" id="email" value="<?= @$result_formato['email'] ?>" placeholder="Correo electrónico"/>
            </div>
          </div>
          <div class="row">
            <div class="small-12 medium-6 large-6 columns">
              <label style="padding-top:5px;" class="left">Fecha del compromiso <span style="color:red;">(abril-mayo)</span></label>
                <input name="fecha_compromiso" type="date" class="radius" id="fecha_compromiso" value="<?= @$result_formato['fecha_compromiso'] ?>" placeholder="Fecha del compromiso"/>
            </div>
            
          </div>
          <div class="clear"></div>
              <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_supervisor-acesoria')[0].submit();">Guardar</button>
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
        <div class="large-5 medium-5 small-12 columns text-center">
          <br><br>
         ______________________________________________________<br>
         Firma del Supervisor
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
