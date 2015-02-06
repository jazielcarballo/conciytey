<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	
	
	//--------------------------------------------------------------
	
	$sql = "SELECT * FROM estados";
	$estados = mysql_query($sql);
	
	//--------------------------------------------------------------
	
	$sql = "SELECT est.estado FROM estados est
			INNER JOIN campos_administrables camp ON (camp.valor = est.id AND camp.seccion = 'todas' AND camp.campo = 'estado_id')";
	$query = mysql_query($sql);	
	$result_estado = mysql_fetch_array($query);
	$estado = $result_estado['estado'];
	
	//--------------------------------------------------------------
	
	$sql = "SELECT * FROM campos_administrables WHERE seccion = 'todas' AND campo = 'anio'";
	$query = mysql_query($sql);	
	$result_estado = mysql_fetch_array($query);
	$anio = $result_estado['valor'];
	//--------------------------------------------------------------
	
	$contenido = str_replace('[estado]',$estado,$result['contenido']);
	$contenido = str_replace('[anio]',$anio,$contenido);

	$sql = "SELECT * FROM formato_fipi WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
			
			$("#forma_formato-fipi").validate({
				
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
					'clave':{ required: true },
					'lider':{ required: true },
					'lider_paterno':{ required: true },
					'lider_materno':{ required: true },
					'institucion':{ required: true },
					'area':{ required: true },
				},
				
				messages:{
					'proyecto':'Campo requerido',
					'clave':'Campo requerido',
					'lider':'Campo requerido',
					'lider_paterno':'Campo requerido',
					'lider_materno':'Campo requerido',
					'institucion':'Campo requerido',
					'area':'Campo requerido',
				}	 
			});
			
		})
		
	</script>
    
    
    <style>
		label.error {
			color: #f04124;
		}
	</style>
    
    
    <style type="text/css" media="print">
	   .no-print { display: none; }
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
		
        <form name="forma_formato-fipi" id="forma_formato-fipi" method="post" action="procesos/p_formato-fipi.php" enctype="multipart/form-data">
        		<input type="hidden" name="guardar" id="guardar">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Protocolo Internacional de Proyectos Científicos Juveniles</h1>
        <h4>Feria de Ciencias e Ingenierías Estado de <?= strtoupper($estado) .' '. $anio ?></h4>
        <h4>Formato de Inscripción de Proyectos de Investigación (FIPI)</h4>
        <p>(No se aceptarán formatos llenados a mano)</p>
        <ul>
          <li>Se debe utilizar lenguaje científico, con la terminología adecuada. Es importante incluir una breve descripción de posibles aplicaciones y solamente se podrá hacer una brevísima reseña del trabajo previo (opcional).</li>
          <li>Lee cuidadosamente y responde las preguntas 1 a la 4. La primera puede quedar sin responder si no aplica ninguno de los temas involucrados. Las tres restantes no deben quedar sin respuesta.</li>
        </ul>
        
          <div class="large-9 medium-9 small-12 columns">
            <label>Nombre del Proyecto:</label>
            <input name="proyecto" type="text" class="radius" id="nombre" placeholder="Nombre" value="<?= @$result_formato['proyecto'] ?>"/>
          </div>
          <div class="large-3 medium-3 small-12 columns no-print">
            <label>Clave</label>
            <input name="clave" type="text" class="radius" id="clave" placeholder="Clave" value="<?= @$result_formato['clave'] ?>"/>
          </div>
           <div class="large-8 medium-8 small-12 columns">
            <label>Estudiante 1</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="estudiante1" type="text" class="radius" id="estudiante1" placeholder="Nombre" value="<?= @$result_formato['estudiante1'] ?>"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="estudiante1_paterno" type="text" class="radius" id="estudiante1_paterno" placeholder="Apellido Paterno" value="<?= @$result_formato['estudiante1_paterno'] ?>"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="estudiante1_materno" type="text" class="radius" id="estudiante1_materno" placeholder="Apellido Materno" value="<?= @$result_formato['estudiante1_materno'] ?>"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Fecha de Nacimiento</label>
            <input name="fecha_nacimiento1" type="date" class="radius" id="fecha_nacimiento1" placeholder="Fecha de Nacimiento" value="<?= @$result_formato['fecha_nacimiento1'] ?>"/>
          </div>
          <div class="large-8 medium-8 small-12 columns">
            <label>Estudiante 2</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="estudiante2" type="text" class="radius" id="estudiante2" placeholder="Nombre" value="<?= @$result_formato['estudiante2'] ?>"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="estudiante2_paterno" type="text" class="radius" id="estudiante2_paterno" placeholder="Apellido Paterno" value="<?= @$result_formato['estudiante2_paterno'] ?>"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="estudiante2_materno" type="text" class="radius" id="estudiante2_materno" placeholder="Apellido Materno" value="<?= @$result_formato['estudiante2_materno'] ?>"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Fecha de Nacimiento</label>
            <input name="fecha_nacimiento2" type="date" class="radius" id="fecha_nacimiento2" placeholder="Fecha de Nacimiento" value="<?= @$result_formato['fecha_nacimiento2'] ?>"/>
          </div>
          <div class="large-8 medium-8 small-12 columns">
            <label>Estudiante 3</label>
            <div class="small-12 medium-4 large-4 columns">
                <input name="estudiante3" type="text" class="radius" id="estudiante3" placeholder="Nombre" value="<?= @$result_formato['estudiante3'] ?>"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="estudiante3_paterno" type="text" class="radius" id="estudiante3_paterno" placeholder="Apellido Paterno" value="<?= @$result_formato['estudiante3_paterno'] ?>"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="estudiante3_materno" type="text" class="radius" id="estudiante3_materno" placeholder="Apellido Materno" value="<?= @$result_formato['estudiante3_materno'] ?>"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Fecha de Nacimiento</label>
            <input name="fecha_nacimiento3" type="date" class="radius" id="fecha_nacimiento3" placeholder="Fecha de Nacimiento" value="<?= @$result_formato['fecha_nacimiento3'] ?>"/>
          </div>
          <div class="large-8 medium-8 small-12 columns">
            <label>Institución:</label>
            <input name="institucion" type="text" class="radius" id="institucion" placeholder="Institución" value="<?= @$result_formato['institucion'] ?>"/>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Grado:</label>
            <input name="grado" type="text" class="radius" id="grado" placeholder="Grado" value="<?= @$result_formato['grado'] ?>"/>
          </div>
          
          <div class="large-5 medium-8 small-12 columns">
            <label>Localidad:</label>
            <input name="localidad" type="text" class="radius" id="localidad" placeholder="Localidad" value="<?= @$result_formato['localidad'] ?>"/>
          </div>
          <div class="large-3 medium-3 small-12 columns">
            <label>Estado:</label>
            <select name="estado_id" id="">
              	<?php while($row = mysql_fetch_array($estados)): ?>
                    <option value="<?= $row['id']?>" <?php if($row['id'] == @$result_formato['estado_id']) echo 'selected'; ?>><?= $row['estado']?></option>
            	<?php endwhile; ?>
            </select>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Correo-e:</label>
            <input name="email" type="email" class="radius" id="email" placeholder="Correo-e" value="<?= @$result_formato['email'] ?>"/>
          </div>
          <div class="large-8 medium-8 small-12 columns">
            <label>Asesor:</label>
            <div class="small-12 medium-4 large-4 columns">
              <input name="asesor" type="text" class="radius" id="asesor" placeholder="Nombre" value="<?= @$result_formato['asesor'] ?>"/>
            </div>
            <div class="small-12 medium-4 large-4 columns">
                <input name="asesor_paterno" type="text" class="radius" id="asesor_paterno" placeholder="Apellido Paterno" value="<?= @$result_formato['asesor_paterno'] ?>"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="asesor_materno" type="text" class="radius" id="asesor_materno" placeholder="Apellido Materno" value="<?= @$result_formato['asesor_materno'] ?>"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Fecha de Nacimiento</label>
            <input name="fecha_nacimiento_asesor" type="date" class="radius" id="fecha_nacimiento_asesor" placeholder="Fecha de Nacimiento" value="<?= @$result_formato['fecha_nacimiento_asesor'] ?>"/>
          </div>
          <span class="nota7">* Aplica sólo en casos de proyectos por equipo.</span><br><br>
          <p><strong>Área del Proyecto (Marcar sólo una):</strong><label for="area" class="error" style="display:none;"></label></p>
          <div class="clear"></div>

           <div class="large-4 medium-4 small-12 columns">
                  <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Ciencias de Animales" <?php if(@$result_formato['area'] == 'Ciencias de Animales') echo 'checked' ?> >
                    Ciencias de Animales                
                  </label>
                  <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Biologia Celular y Molecular" <?php if(@$result_formato['area'] == 'Biologia Celular y Molecular') echo 'checked' ?>>
                    Biología Celular y Molecular              
                  </label>
                  <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Ingenieria de Materiales y Bio Ing." <?php if(@$result_formato['area'] == 'Ingenieria de Materiales y Bio Ing.') echo 'checked' ?>>
                    Ingeniería de Materiales y Bio Ing.
                  </label>
                   <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Analisis Ambiental" <?php if(@$result_formato['area'] == 'Analisis Ambiental') echo 'checked' ?>>
                    Análisis Ambiental
                  </label>
                   <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Medicina y Salud" <?php if(@$result_formato['area'] == 'Medicina y Salud') echo 'checked' ?>>
                    Medicina y Salud
                  </label>
                  <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Ciencias de las Plantas" <?php if(@$result_formato['area'] == 'Ciencias de las Plantas') echo 'checked' ?>>
                    Ciencias de las Plantas 
                  </label>
                </div>

                 <div class="large-4 medium-4 small-12 columns">
                  <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Cs. Sociales  y del Comportamiento" <?php if(@$result_formato['area'] == 'Cs. Sociales  y del Comportamiento') echo 'checked' ?>>
                    Cs. Sociales  y del Comportamiento               
                  </label>
                  <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Cs. de la Computacion" <?php if(@$result_formato['area'] == 'Cs. de la Computacion') echo 'checked' ?>>
                      Cs. de la Computación              
                    </label>
                  <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Ingenieria Electrica y Mecanica" <?php if(@$result_formato['area'] == 'Ingenieria Electrica y Mecanica') echo 'checked' ?>>
                      Ingeniería Eléctrica y Mecánica 
                    </label>
                   <label class="sub-checkbox">
                      <input name="area" id="" type="radio" value="Manejo Ambiental" <?php if(@$result_formato['area'] == 'Manejo Ambiental') echo 'checked' ?>>
                      Manejo Ambiental 
                  </label>
                   <label class="sub-checkbox">
                      <input name="area" id="area" type="radio" value="Microbiologia" <?php if(@$result_formato['area'] == 'Microbiologia') echo 'checked' ?>>
                      Microbiología   
                  </label>
                  <label class="sub-checkbox">
                      <input name="area" id="area" type="radio" value="Quimica" <?php if(@$result_formato['area'] == 'Quimica') echo 'checked' ?>>
                      Química 
                  </label>
                </div>

                 <div class="large-4 medium-4 small-12 columns">
                  <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Bioquimica" <?php if(@$result_formato['area'] == 'Bioquimica') echo 'checked' ?>>
                     Bioquímica               
                    </label>
                  <label class="sub-checkbox">
                  
                    <input name="area" id="area" type="radio" value="Cs. de la Tierra" <?php if(@$result_formato['area'] == 'Cs. de la Tierra') echo 'checked' ?>>
                      Cs. de la Tierra            
                    </label>
                  <label class="sub-checkbox">
                    <input name="area" id="area" type="radio" value="Energia y Transportacion" <?php if(@$result_formato['area'] == 'Energia y Transportacion') echo 'checked' ?>>
                      Energía y Transportación    
                    </label>
                   <label class="sub-checkbox">
                      <input name="area" id="area" type="radio" value="Ciencias Matematicas" <?php if(@$result_formato['area'] == 'Ciencias Matematicas') echo 'checked' ?>>
                      Ciencias Matemáticas 
                  </label>
                   <label class="sub-checkbox">
                      <input name="area" id="area" type="radio" value="Fisica y Astronomia" <?php if(@$result_formato['area'] == 'Fisica y Astronomia') echo 'checked' ?>>
                      Física y Astronomía        
                  </label>
                </div>
          <div class="clear"></div>
              <p><strong>Resumen del proyecto</strong> (Marco teórico, definición del problema, objetivos, métodos y materiales a utilizar, resultados esperados) <strong>Utiliza un máximo de 250 palabras, en letra tipo Arial de 10 puntos.</strong></p>
              <textarea class="radius" name="resumen" id="resumen" cols="10" rows="5"><?= @$result_formato['resumen'] ?></textarea>
          <div class="clear top20"></div>

          <label>
            1) Como parte del proyecto el estudiante usará, manipulará o interactuará con: (seleccione aquellas que apliquen):
          </label>
          
          <?php $arr_se_usara = explode(',',@$result_formato['se_usara']);?>
          <div class="large-6 medium-6 small-12 columns">
            <label class="sub-checkbox">
              <input name="se_usara[]" id="se_usara" type="checkbox" value="humanos" <?php if(in_array('humanos',$arr_se_usara)) echo 'checked' ?>>
               Participantes Humanos.               
            </label>
            <label class="sub-checkbox">
              <input name="se_usara[]" id="se_usara" type="checkbox" value="no_humanos" <?php if(in_array('no_humanos',$arr_se_usara)) echo 'checked' ?>>
               Animales vertebrados no humanos.       
            </label>
          </div>
          <div class="large-6 medium-6 small-12 columns">
            <label class="sub-checkbox">
              <input name="se_usara[]" id="se_usara" type="checkbox" value="biologicos" <?php if(in_array('biologicos',$arr_se_usara)) echo 'checked' ?>>
               Agentes biológicos potencialmente peligrosos.                              
            </label>
            <label class="sub-checkbox">
              <input name="se_usara[]" id="se_usara" type="checkbox" value="controladas" <?php if(in_array('controladas',$arr_se_usara)) echo 'checked' ?>>
               Sustancias controladas.              
            </label>
          </div>
          
            <label>
              2) El estudiante diseñó independientemente todos los procedimientos listados en el resumen.
            </label>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="independiente" id="independiente" value="si" <?php if(@$result_formato['independiente'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-7 medium-7 small-7 columns check-i">
                  <label class="sub-checkbox">
                    <input type="radio" name="independiente" id="independiente" value="no" <?php if(@$result_formato['independiente'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>

            <label>
              3)  El proyecto pertenece, perteneció o fue elaborado por un instituto de investigación científica.
            </label>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns check-i">
                  <label class="sub-checkbox">
                    <input type="radio" name="pertenece_instituto" id="pertenece_instituto" value="si" <?php if(@$result_formato['pertenece_instituto'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-7 medium-7 small-7 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="pertenece_instituto" id="pertenece_instituto" value="no" <?php if(@$result_formato['pertenece_instituto'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>

              <label>
              4)  Es un proyecto que continúa de otro anterior.
            </label>
              <div class="row">
                <div class="large-3 medium-3 small-3 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="continuacion" id="continuacion" value="si" <?php if(@$result_formato['continuacion'] == 'si') echo 'checked' ?>>
                    Sí.
                  </label>
                </div>
                <div class="large-7 medium-7 small-7 columns">
                  <label class="sub-checkbox">
                    <input type="radio" name="continuacion" id="continuacion" value="no" <?php if(@$result_formato['continuacion'] == 'no') echo 'checked' ?>>
                    No.
                  </label>
                </div>
              </div>
              <br>
              <p>Manifiesto/manifestamos que los datos presentados son correctos y verídicos, que la información   brindada es producto de mi/nuestra investigación y refleja el trabajo realizado/a realizar en el último año.</p>
            <div class="large-8 medium-8 small-12 columns">
              <label>Nombre del estudiante o líder del proyecto</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider" type="text" class="radius" id="lider" placeholder="Nombre" value="<?= @$result_formato['lider'] ?>"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_paterno" type="text" class="radius" id="lider_paterno" placeholder="Apellido Paterno" value="<?= @$result_formato['lider_paterno'] ?>"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="lider_materno" type="text" class="radius" id="lider_materno" placeholder="Apellido Materno" value="<?= @$result_formato['lider_materno'] ?>"/>
              </div>
            </div>
            <div class="large-4 medium-4 small-12 columns">
              <label>Fecha</label>
              <input name="fecha_lider" type="date" class="radius" id="fecha_lider" placeholder="Fecha" value="<?= @$result_formato['fecha_lider'] ?>"/>
            </div>

          <div class="clear"></div>
                <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_formato-fipi')[0].submit();">Guardar</button>
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
         Nombre y firma del estudiante o líder del proyecto
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
