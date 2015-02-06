<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato_5a WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
	$query = mysql_query($sql);
	
	$existe_archivo = 0;
	
	if(mysql_num_rows($query) > 0){
		$result_formato = mysql_fetch_array($query);
		
		if(strlen($result_formato['archivo']) > 0) $existe_archivo = 1;
		
		$sql = "SELECT * FROM formato_5a_especies WHERE id_5a = '".$result_formato["id"]."' ORDER BY posicion";
		$query_especies = mysql_query($sql);
		
		if(mysql_num_rows($query_especies) > 0){
			while($row_especies = mysql_fetch_array($query_especies)){
				$arr_especies[$row_especies['posicion']]['genero'] = $row_especies['genero'];
				$arr_especies[$row_especies['posicion']]['especie'] = $row_especies['especie'];
				$arr_especies[$row_especies['posicion']]['nombre'] = $row_especies['nombre'];
				$arr_especies[$row_especies['posicion']]['numero'] = $row_especies['numero'];
			}
		}
		
		
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
			
		var num_genero = 2;	
			
		$(function(){
			
			$("#forma_5a").validate({
				
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
					'genero1':{ required: true },
					'especie1':{ required: true },
					'nombre1':{ required: true },
					'numero1':{ required: true },
					'alojamiento':{ required: true },
					'despues':{ required: true },
					//'file_permiso':{ required: true }
					
				},
				
				messages:{
					'lider':'Campo requerido',
					'lider_paterno':'Campo requerido',
					'lider_materno':'Campo requerido',
					'proyecto':'Campo requerido',
					'genero1':'Campo requerido',
					'especie1':'Campo requerido',
					'nombre1':'Campo requerido',
					'numero1':'Campo requerido',
					'alojamiento':'Campo requerido',
					'despues':'Campo requerido',
					//'file_permiso':'Campo requerido'
				}	 
			});
			
		})
		
		function addEspecie()
		{
			$('#div_genero'+num_genero).css('display', 'block');
			
			num_genero++;
			
			if(num_genero == 6){
				$('#div_agregar').css('display', 'none');
			}
		}
		
		
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
		<form name="forma_5a" id="forma_5a" method="post" action="procesos/p_forma-5a.php" enctype="multipart/form-data">
      
      <input type="hidden" name="guardar" id="guardar">
      
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Forma 5A </h1>
        <h4>Uso de Animales Vertebrados</h4>
        <p><strong>Requerido para todos los proyectos que involucran animales vertebrados en una institución no registrada/regulada. Requiere de aprobación de un Comité Científico de Revisión –CCR- <span style="color:red; margin:0;">previa a la experimentación.</span></strong></p>
        <p><strong>ATENCIÓN:</strong> Esta forma no es necesaria si el estudiante usa solamente tejidos de animales vertebrados en el proyecto.</p>
        
          <div class="large-12 medium-12 small-12 columns">
            <label>Expocientífico/Líder del proyecto</label>
            <div class="small-12 medium-4 large-4 columns">
                <input name="lider" type="text" class="radius" id="lider" value="<?= @$result_formato['lider'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_paterno" type="text" class="radius" id="mentor_paterno" value="<?= @$result_formato['lider_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_materno" type="text" class="radius" id="mentor_materno" value="<?= @$result_formato['lider_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
          </div>
           <div class="large-12 medium-12 small-12 columns">
            <label>Título del Proyecto: </label>
            <input name="proyecto" type="text" class="radius" id="proyecto" value="<?= @$result_formato['proyecto'] ?>" placeholder="Proyecto"/>
          </div>       
          <div class="clear"></div>
          <p><strong>Para ser completado por el estudiante (todas las preguntas son aplicables y deben contestarse)</strong></p>
          <div class="clear"></div>

          <div class="large-12 medium-12 small-12 columns">
            <label>1. Género, especie, nombre común y número de los animales usados. (Usa una forma para cada especie usada)</label>    
          </div>
          
          <div>
              <div class="large-3 medium-3 small-12 columns">
                <input name="genero1" type="text" class="radius" id="genero1" value="<?= @$arr_especies[1]['genero'] ?>" placeholder="Género"/>
              </div>
               <div class="large-3 medium-3 small-12 columns">
                <input name="especie1" type="text" class="radius" id="especie1" value="<?= @$arr_especies[1]['especie'] ?>" placeholder="Especie"/>
              </div>
              <div class="large-4 medium-3 small-12 columns">
                <input name="nombre1" type="text" class="radius" id="nombre1" value="<?= @$arr_especies[1]['nombre'] ?>" placeholder="Nombre común"/>
              </div>
               <div class="large-2 medium-3 small-12 columns">
                <input name="numero1" type="text" class="radius" id="numero1" value="<?= @$arr_especies[1]['numero'] ?>" placeholder="# de animales"/>
              </div>
          </div>
          
          <div id="div_genero2" style="<?= (!isset($arr_especies)) ? 'display:none;' : 'display:block;' ?>">
              <div class="large-3 medium-3 small-12 columns">
                <input name="genero2" type="text" class="radius" id="genero2" value="<?= @$arr_especies[2]['genero'] ?>" placeholder="Género"/>
              </div>
               <div class="large-3 medium-3 small-12 columns">
                <input name="especie2" type="text" class="radius" id="especie2" value="<?= @$arr_especies[2]['especie'] ?>" placeholder="Especie"/>
              </div>
              <div class="large-4 medium-3 small-12 columns">
                <input name="nombre2" type="text" class="radius" id="nombre2" value="<?= @$arr_especies[2]['nombre'] ?>" placeholder="Nombre común"/>
              </div>
               <div class="large-2 medium-3 small-12 columns">
                <input name="numero2" type="text" class="radius" id="numero2" value="<?= @$arr_especies[2]['numero'] ?>" placeholder="# de animales"/>
              </div>
          </div>
          
          <div id="div_genero3" style="<?= (!isset($arr_especies)) ? 'display:none;' : 'display:block;' ?>">
              <div class="large-3 medium-3 small-12 columns">
                <input name="genero3" type="text" class="radius" id="genero3" value="<?= @$arr_especies[3]['genero'] ?>" placeholder="Género"/>
              </div>
               <div class="large-3 medium-3 small-12 columns">
                <input name="especie3" type="text" class="radius" id="especie3" value="<?= @$arr_especies[3]['especie'] ?>" placeholder="Especie"/>
              </div>
              <div class="large-4 medium-3 small-12 columns">
                <input name="nombre3" type="text" class="radius" id="nombre3" value="<?= @$arr_especies[3]['nombre'] ?>" placeholder="Nombre común"/>
              </div>
               <div class="large-2 medium-3 small-12 columns">
                <input name="numero3" type="text" class="radius" id="numero3" value="<?= @$arr_especies[3]['numero'] ?>" placeholder="# de animales"/>
              </div>
          </div>
          
          <div id="div_genero4" style="<?= (!isset($arr_especies)) ? 'display:none;' : 'display:block;' ?>">
              <div class="large-3 medium-3 small-12 columns">
                <input name="genero4" type="text" class="radius" id="genero4" value="<?= @$arr_especies[4]['genero'] ?>" placeholder="Género"/>
              </div>
               <div class="large-3 medium-3 small-12 columns">
                <input name="especie4" type="text" class="radius" id="especie4" value="<?= @$arr_especies[4]['especie'] ?>" placeholder="Especie"/>
              </div>
              <div class="large-4 medium-3 small-12 columns">
                <input name="nombre4" type="text" class="radius" id="nombre4" value="<?= @$arr_especies[4]['nombre'] ?>" placeholder="Nombre común"/>
              </div>
               <div class="large-2 medium-3 small-12 columns">
                <input name="numero4" type="text" class="radius" id="numero4" value="<?= @$arr_especies[4]['numero'] ?>" placeholder="# de animales"/>
              </div>
          </div>
          
          <div id="div_genero5" style="<?= (!isset($arr_especies)) ? 'display:none;' : 'display:block;' ?>">
              <div class="large-3 medium-3 small-12 columns">
                <input name="genero5" type="text" class="radius" id="genero5" value="<?= @$arr_especies[5]['genero'] ?>" placeholder="Género"/>
              </div>
               <div class="large-3 medium-3 small-12 columns">
                <input name="especie5" type="text" class="radius" id="especie5" value="<?= @$arr_especies[5]['especie'] ?>" placeholder="Especie"/>
              </div>
              <div class="large-4 medium-3 small-12 columns">
                <input name="nombre5" type="text" class="radius" id="nombre5" value="<?= @$arr_especies[5]['nombre'] ?>" placeholder="Nombre común"/>
              </div>
               <div class="large-2 medium-3 small-12 columns">
                <input name="numero5" type="text" class="radius" id="numero5" value="<?= @$arr_especies[5]['numero'] ?>" placeholder="# de animales"/>
              </div>
          </div>
          
          
          <div class="clear"></div>
          <?php if(!isset($arr_especies)): ?>
                <div id="div_agregar" class="large-3 medium-4 small-12 columns">
                	<a class="button" href="javascript:void(0)" onClick="addEspecie()">+ Agregar Especie</a>
                </div>
                <div class="clear"></div>
		  <?php endif; ?>
          <div class="large-12 medium-12 small-12 columns">
            <br>
            <label>2. Describe completamente el alojamiento y manutención de los animales. Incluye las condiciones de jaula o albergue; número de animales en cada uno (a), ambiente, cama, tipo de comida y agua, frecuencia de alimentación, frecuencia de observación, etc.</label>
            <textarea class="radius" name="alojamiento" id="alojamiento" value="" cols="10" rows="3"><?= @$result_formato['alojamiento'] ?></textarea>
            <br>
          </div>
          <div class="large-12 medium-12 small-12 columns">
            <label>3. ¿Qué pasará con los animales después de los experimentos?</label>
            <textarea class="radius" name="despues" id="despues" value="" cols="10" rows="3"><?= @$result_formato['despues'] ?></textarea>
            <br>
          </div>

          <div class="clear"></div>
<!--            <p><strong>*Para completar esta forma es necesario descargar el archivo de permiso, firmarlo, escanearlo y subirlo</strong></p>
            <div class="clear"></div>

            <div class="large-3 medium-4 small-12 columns">
                <a class="button" href="pdf/permiso-animales.pdf" target="_blank">Descargar Permiso</a>
            </div>
			-->
            <!-- <div class="large-9 medium-9 small-12 columns">
                <label for="">Adjuntar Permiso</label>
                <input type="file" name="file_permiso" multiple placeholder="Choose File">
            </div> -->
            
            <div class="clear"></div>
            <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_5a')[0].submit();">Guardar</button>
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
        <img src="img/permiso-5a.jpg" alt="">
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
