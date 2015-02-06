<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato1a_individual WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
			
			$("#forma_formato1A").validate({
				
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
					'grado':{ required:true},
					'email':{ 
						required:true,
						email:true
					},
					'telefono':{ required:true},
					'proyecto':{ required:true},
					'escuela':{ required:true},
					'escuela_direccion':{ required:true},
					'escuela_telefono':{ required:true},
					'mentor':{ required:true},
					'mentor_email':{ 
						required:true,
						email:true
					},
					'continuacion':{ required:true},
					'continuacion_opciones':{ required: true},
					'continuacion_si_formato[]':{ 
						required: "#continuacion_si:checked",
						minlength: 1
					},
					'fecha_inicio':{ required:true},
					'fecha_fin':{ required:true},
					'desarrollo':{ required:true},
					'lugar':{ required:true},
					'lugar_opciones[]':{ 
						required: "#lugar:checked",
						minlength: 1
					},
					'lugar_otro':{ 
						required: "#lugar_otro:checked"
					},
					'file_plan':{ required:true}
					
				},
				
				messages:{
					'nombre':'Campo requerido.',
					'paterno':'Campo requerido',
					'materno':'Campo requerido',
					'grado':'Campo requerido.',
					'email':{ 
						'required':'Campo requerido.',
						'email':'Debe ser un email valido'
					},
					'telefono':'Campo requerido.',
					'proyecto':'Campo requerido.',
					'escuela':'Campo requerido.',
					'escuela_direccion':'Campo requerido.',
					'escuela_telefono':'Campo requerido.',
					'mentor':'Campo requerido.',
					'mentor_email':{ 
						'required':'Campo requerido.',
						'email':'Debe ser un email valido'
					},
					'continuacion':'Campo requerido.',
					'continuacion_opciones':'Seleccione una opcion.',
					'continuacion_si_formato[]':'Seleccione una opcion.',
					'fecha_inicio':'Campo requerido.',
					'fecha_fin':'Campo requerido.',
					'desarrollo':'Campo requerido.',
					'lugar':'Campo requerido.',
					'lugar_opciones[]':'Seleccione una opcion.',
					'lugar_otro':'Campo requerido.',
					'file_plan':'Campo requerido.'
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
       
       <form name="forma_formato1A" id="forma_formato1A" method="post" action="procesos/p_revision-estudiante.php" enctype="multipart/form-data">
    		<input type="hidden" name="guardar" id="guardar">
    	
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Formato 1A- Individual/Equipos</h1>
        <h4>Lista de Revisión del Estudiante</h4>
        <p>Este formulario debe ser llenado completamente. En caso de proyecto individual, ignore incisos b) y c) de 1).
            <!-- Sólo para participantes con FOLIO 2012. --></p>
        
          <div class="large-8 medium-8 small-12 columns">
            <label>1. a) Estudiante autor / Líder del Proyecto</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="nombre" type="text" class="radius" id="nombre" value="<?= @$result_formato['nombre']?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['paterno']?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="materno" type="text" class="radius" id="materno" value="<?= @$result_formato['materno']?>" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Grado</label>
            <input name="grado" type="text" class="radius" id="grado" value="<?= @$result_formato['grado']?>" placeholder="Grado"/>
          </div>
          <div class="large-8 medium-8 small-12 columns">
            <label>Correo electrónico</label>
            <input name="email" type="email" class="radius" id="email" value="<?= @$result_formato['email']?>" placeholder="Correo electrónico"/>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Teléfono</label>
            <input name="telefono" type="text" class="radius" id="telefono" value="<?= @$result_formato['telefono']?>" placeholder="Teléfono"/>
          </div>

          <div class="clear"></div>
          <div class="large-8 medium-8 small-12 columns">
            <label>b) Segundo miembro del equipo</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="segundo_nombre" type="text" class="radius" id="nombre" value="<?= @$result_formato['segundo_nombre']?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="segundo_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['segundo_paterno']?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="segundo_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['segundo_materno']?>" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Grado</label>
            <input name="segundo_grado" type="text" class="radius" id="segundo_grado" value="<?= @$result_formato['segundo_grado']?>" placeholder="Grado"/>
          </div>
          <div class="large-8 medium-8 small-12 columns">
            <label>Correo electrónico</label>
            <input name="segundo_email" type="email" class="radius" id="segundo_email" value="<?= @$result_formato['segundo_email']?>" placeholder="Correo electrónico"/>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Teléfono</label>
            <input name="segundo_telefono" type="text" class="radius" id="segundo_telefono" value="<?= @$result_formato['segundo_telefono']?>" placeholder="Teléfono"/>
          </div>

          <div class="clear"></div>
          <div class="large-8 medium-8 small-12 columns">
            <label>c) Tercer miembro del equipo</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="tercero_nombre" type="text" class="radius" id="nombre" value="<?= @$result_formato['tercero_nombre']?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="tercero_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['tercero_paterno']?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="tercero_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['tercero_materno']?>" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Grado</label>
            <input name="tercero_grado" type="text" class="radius" id="tercero_grado" value="<?= @$result_formato['tercero_grado']?>" placeholder="Grado"/>
          </div>
          <div class="large-8 medium-8 small-12 columns">
            <label>Correo electrónico</label>
            <input name="tercero_email" type="email" class="radius" id="tercero_email" value="<?= @$result_formato['tercero_email']?>" placeholder="Correo electrónico"/>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Teléfono</label>
            <input name="tercero_telefono" type="text" class="radius" id="tercero_telefono" value="<?= @$result_formato['tercero_telefono']?>" placeholder="Teléfono"/>
          </div>
          <div class="clear"></div>

          <div class="large-12 medium-12 small-12 columns">
            <label>2. Proyecto</label>
            <input name="proyecto" type="text" class="radius" id="proyecto" value="<?= @$result_formato['proyecto']?>" placeholder="Nombre del Proyecto"/>
          </div>
          <div class="clear"></div>

            <div class="large-5 medium-8 small-12 columns">
              <label>Escuela</label> 
               <input name="escuela" type="text" class="radius" id="escuela" value="<?= @$result_formato['escuela']?>" placeholder="Nombre"/>
              </div>
              <div class="large-4 medium-4 small-12 columns"> 
              <label>Dirección</label>             
                <input name="escuela_direccion" type="text" class="radius" id="escuela_direccion" value="<?= @$result_formato['escuela_direccion']?>" placeholder="Dirección"/>
              </div>
              <div class="large-3 medium-4 small-12 columns">
                <label>Teléfono</label>
                <input name="escuela_telefono" type="text" class="radius" id="escuela_telefono" value="<?= @$result_formato['escuela_telefono']?>" placeholder="Teléfono"/>
              </div>
          <div class="clear"></div>

          <div class="large-8 medium-8 small-12 columns">
            <label>4. Mentor:</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="mentor" type="text" class="radius" id="nombre" value="<?= @$result_formato['mentor']?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="mentor_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['mentor_paterno']?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="mentor_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['mentor_materno']?>" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Correo electrónico</label>
            <input name="mentor_email" type="email" class="radius" id="mentor_email" value="<?= @$result_formato['mentor_email']?>" placeholder="Correo electrónico"/>
          </div>
          <div class="clear"></div>


              <label><span>5.</span>
           
                ¿El proyecto es continuación de año(s) pasado(s)?
                <label for="continuacion" class="error" style="display:none;"></label>
              </label>
              <div class="row">
                <div class="large-3 medium-3 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="continuacion_opciones" id="continuacion_si" value="si" <?php if(@$result_formato['continuacion'] == 'si') echo 'checked' ?>>
                    Sí. Anexamos del 2011:
                  </label>
                </div>
                <?php $arr_continuacion_si = explode(',',@$result_formato['continuacion_si']);?>
                <div class="large-2 medium-2 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="checkbox" name="continuacion_si_formato[]" id="continuacion_si_formato" value="folio" <?php if(@$result_formato['continuacion'] == 'si'){ if(in_array('folio',$arr_continuacion_si)) echo 'checked';} ?>>
                    FOLIO
                  </label>
                </div>
                <div class="large-3 medium-3 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="checkbox" name="continuacion_si_formato[]" id="continuacion_si_formato" value="folio1A" <?php if(@$result_formato['continuacion'] == 'si'){ if(in_array('folio1A',$arr_continuacion_si)) echo 'checked';} ?>>
                    Formato 1A
                  </label>
                </div>
                <div class="large-3 medium-3 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="checkbox" name="continuacion_si_formato[]" id="continuacion_si_formato" value="plan"  <?php if(@$result_formato['continuacion'] == 'si'){ if(in_array('plan',$arr_continuacion_si)) echo 'checked';} ?>>
                    Plan de Investigación  
                  </label>
                  <label for="continuacion_si_formato[]" class="error" style="display:none;"></label>
                </div>
                <div class="large-12 medium-12 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="continuacion_opciones" id="continuacion_F7" value="F7"  <?php if(@$result_formato['continuacion'] == 'F7') echo 'checked' ?>>
                    Formato 7, donde explico (amos) por qué es novedoso y diferente al del año pasado. 
                  </label>
                </div>
                <div class="large-3 medium-3 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="continuacion_opciones" id="continuacion_no" value="no"  <?php if(@$result_formato['continuacion'] == 'no') echo 'checked' ?>>
                    No
                  </label>
                </div>
                
                
              </div>
			<div>
                <label for="continuacion_opciones" class="error" style="display:none;"></label>
                </div>
              <div class="large-8 medium-8 small-12 columns">
                <label style="padding-top:5px;">6. a)Fecha de inicio de documentación y experimentación del ciclo actual (dd/mm/aa): </label>
              </div>
              <div class="large-4 medium-4 small-12 columns">
                <input name="fecha_inicio" type="date" class="radius" id="fecha_inicio" value="<?= @$result_formato['fecha_inicio'] ?>"/>
              </div>
              <div class="large-8 medium-8 small-12 columns">
                <label style="padding-top:5px;" class="left">b)Fecha de finalización de documentación y experimentación del ciclo actual (dd/mm/aa):</label>
              </div>
              <div class="large-4 medium-4 small-12 columns">
                <input name="fecha_fin" type="date" class="radius" id="fecha_fin" value="<?= @$result_formato['fecha_fin']?>"/>
              </div>

              <label><span>7.</span>
               Lugar donde se desarrolla/desarrollará el proyecto (marcar las que apliquen): 
              <label for="lugar" class="error" style="display:none;"></label>
              </label>
              <?php $arr_lugar = explode(',',@$result_formato['lugar']);?>
              <div class="row">
                <div class="large-4 medium-4 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="checkbox" name="lugar_opciones[]" id="lugar_centro" value="centro" <?php if(in_array('centro',$arr_lugar)) echo 'checked' ?>>
                    Centro de Investigación
                  </label>
                  <label class="sub-checkbox">
                    <input type="checkbox" name="lugar_opciones[]" id="lugar_campo" value="campo" <?php if(in_array('campo',$arr_lugar)) echo 'checked' ?>>
                    Investigación de campo
                  </label>
                </div>
                <div class="large-2 medium-2 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="checkbox" name="lugar_opciones[]" id="lugar_escuela" value="escuela" <?php if(in_array('escuela',$arr_lugar)) echo 'checked' ?>>
                    Escuela
                  </label>
                  <label class="sub-checkbox">
                    <input type="checkbox" name="lugar_opciones[]" id="lugar_domicilio" value="domicilio" <?php if(in_array('domicilio',$arr_lugar)) echo 'checked' ?>>
                    Domicilio
                  </label>
                </div>
                <div class="large-3 medium-3 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="checkbox" name="lugar_opciones[]" id="lugar_otro" value="otro" <?php if(in_array('otro',$arr_lugar)) echo 'checked' ?>>
                    Otro  
                  </label>
                  <div style="margin-left:2em;" class="large-12 medium-12 small-12 columns">
                     <input name="lugar_otro" type="text" class="radius" value="<?= @$result_formato['lugar_otro']?>" placeholder="Otro"/>
                  	<label for="lugar_otro" class="error" style="display:none;"></label>
                  </div>
                </div>
                
               
              </div>
              <div>
                <label for="lugar_opciones[]" class="error" style="display:none;"></label>
                </div>

               <div class="large-12 medium-12 small-12 columns">
                  <label>Nombre, dirección y teléfonos del (los) anterior (es):</label>
              </div>
              <div class="large-5 medium-8 small-12 columns">   
               <input name="anterior_nombre" type="text" class="radius" id="anterior_nombre" value="<?= @$result_formato['anterior_nombre']?>" placeholder="Nombre"/>
              </div>
              <div class="large-4 medium-4 small-12 columns">              
                <input name="anterior_direccion" type="text" class="radius" id="anterior_direccion" value="<?= @$result_formato['anterior_direccion']?>" placeholder="Dirección"/>
              </div>
              <div class="large-3 medium-4 small-12 columns">
                <input name="anterior_telefono" type="text" class="radius" id="anterior_telefono" value="<?= @$result_formato['anterior_telefono']?>" placeholder="Teléfono"/>
              </div>

              <p>Complete y adjunte el Plan de investigación como se describe en la Formato 1B.</p>
              
              <div class="large-3 medium-4 small-12 columns">
                <a href="formato-1b.php" target="_blank">Ver Formato 1B</a>
              </div>
              <div class="clear"></div>
              <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_formato1A')[0].submit();">Guardar</button>
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
