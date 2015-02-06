<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato_f WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
			
			$("#forma_formato-f").validate({
				
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
					'proyecto':{ required: true },
					'lider':{ required: true },
					'lider_paterno':{ required: true },
					'lider_materno':{ required: true },
					'segundo':{ required: true },
					'segundo_paterno':{ required: true },
					'segundo_materno':{ required: true },
					'tercero':{ required: true },
					'tercero_paterno':{ required: true },
					'tercero_materno':{ required: true },
					'asesor':{ required: true },
					'asesor_paterno':{ required: true },
					'asesor_materno':{ required: true },
					'escuela':{ required: true },
					'original':{ required: true }
				},
				
				messages:{
					'proyecto':'Campo requerido.',
					'lider':'Campo requerido.',
					'lider_paterno':'Campo requerido.',
					'lider_materno':'Campo requerido.',
					'segundo':'Campo requerido.',
					'segundo_paterno':'Campo requerido.',
					'segundo_materno':'Campo requerido.',
					'tercero':'Campo requerido.',
					'tercero_paterno':'Campo requerido.',
					'tercero_materno':'Campo requerido.',
					'asesor':'Campo requerido.',
					'asesor_paterno':'Campo requerido.',
					'asesor_materno':'Campo requerido.',
					'escuela':'Campo requerido.',
					'original':'Seleccione una opción.'
					
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
       
    	<form name="forma_formato-f" id="forma_formato-f" method="post" action="procesos/p_formato-f.php" enctype="multipart/form-data">
    		<input type="hidden" name="guardar" id="guardar">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Formato F - Compromiso de Ética</h1>
        
          <div class="large-10 medium-10 small-12 columns">
            <label>Nombre del proyecto:</label>
            <input name="proyecto" type="text" class="radius" id="proyecto" value="<?= @$result_formato['proyecto']?>" placeholder="Nombre del proyecto" />      
          </div>
          <div class="clear"></div>
          <div class="large-10 medium-8 small-12 columns">
            <label>Estudiante líder del proyecto:</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider" type="text" class="radius" id="nombre" value="<?= @$result_formato['lider']?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['lider_paterno']?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['lider_materno']?>"placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="clear"></div>
          <div class="large-10 medium-10 small-12 columns">
            <label>Segundo miembro del equipo:</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="segundo" type="text" class="radius" id="nombre" value="<?= @$result_formato['segundo']?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="segundo_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['segundo_paterno']?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="segundo_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['segundo_materno']?>" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="clear"></div>
          <div class="large-10 medium-10 small-12 columns">
            <label>Tercer miembro del equipo:</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="tercero" type="text" class="radius" id="nombre" value="<?= @$result_formato['tercero']?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="tercero_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['tercero_paterno']?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="tercero_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['tercero_materno']?>" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="clear"></div>

           <div class="large-10 medium-10 small-12 columns">
            <label>Asesor:</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="asesor" type="text" class="radius" id="nombre" value="<?= @$result_formato['asesor']?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="asesor_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['asesor_paterno']?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="asesor_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['asesor_materno']?>" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="clear"></div>

            <div class="large-10 medium-10 small-12 columns">
              <label>Escuela</label> 
               <input name="escuela" type="text" class="radius" id="escuela" value="<?= @$result_formato['escuela']?>" placeholder="Nombre de la escuela"/>
              </div>
          <div class="clear"></div>

              Los integrantes del equipo declaramos que el contenido del proyecto cumple con lo siguiente (marcar solo una opción):
              <br><br>
              <label>
              	<input type="radio" name="original" id="continuacion" value="si" <?php if(@$result_formato['original'] == "si") echo 'checked' ?> >
               Es original y se trata de un trabajo inédito que fue planteado y realizado por nosotros.
                <label for="continuacion" class="error" style="display:none;"></label>
              </label>
              <div class="clear"></div>
              <label>
                <input type="radio" name="original" id="continuacion" value="no" <?php if(@$result_formato['original'] == "no") echo 'checked' ?>>
               La idea no es original, pero contempla modificaciones particulares que fueron diseñadas por nosotros.
                <label for="continuacion" class="error" style="display:none;"></label>
              </label>
             <label for="original" class="error" style="display:none;"></label>
              <div class="clear"></div>
              <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_formato-f')[0].submit();">Guardar</button>
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
         ___________________________________________________________________<br>
         Nombre completo y firma del estudiante o líder del proyecto
        </div>
         <div class="large-5 medium-5 small-12 columns text-center">
          <br><br>
         ___________________________________________________________________<br>
         Nombre completo y firma del asesor
        </div>
      </div>

    </section>

    <?php
     require('footer.php');
      ?>

    
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
    <script>
    webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
</script>
  </body>
</html>
