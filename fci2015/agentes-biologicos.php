<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato_agentes_biologicos WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
			
			$("#forma_agentes-biologicos").validate({
				
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
					'biologicos':{ required: true },
					'lugar':{ required: true },
					'metodo_desecho':{ required: true },
					'procedimiento_riesgos':{ required: true },
					'seguridad':{ required: true },
					'entrenamiento':{ required: true },
					'acuerdo_recomendaciones':{ required: true },
					'acuerdo_recomendaciones_txt':{ required: "#acuerdo_recomendaciones_no:checked" },
					'supervisor1':{ required: true },
					'fecha_supervisor1':{ required: true },
					/*'NBS1':{ required: true },
					'NBS2':{ required: true },
					'supervisor2':{ required: true },
					'fecha_supervisor2':{ required: true },
					'aprovado_comite':{ required: true },
					'supervisor3':{ required: true },
					'fecha_supervisor3':{ required: true }*/
				},
				
				messages:{
					'lider':'Campo requerido',
					'lider_paterno':'Campo requerido',
					'lider_materno':'Campo requerido',
					'proyecto':'Campo requerido',
					'biologicos':'Campo requerido',
					'lugar':'Campo requerido',
					'metodo_desecho':'Campo requerido',
					'procedimiento_riesgos':'Campo requerido',
					'seguridad':'Campo requerido',
					'entrenamiento':'Campo requerido',
					'acuerdo_recomendaciones':'Seleccione una opcion',
					'acuerdo_recomendaciones_txt':'Campo requerido',
					'supervisor1':'Campo requerido',
					'fecha_supervisor1':'Campo requerido',
					/*'NBS1':'Campo requerido',
					'NBS2':'Campo requerido',
					'supervisor2':'Campo requerido',
					'fecha_supervisor2':'Campo requerido',
					'aprovado_comite':'Campo requerido',
					'supervisor3':'Campo requerido',
					'fecha_supervisor3':'Campo requerido'*/
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
                <form name="forma_agentes-biologicos" id="forma_agentes-biologicos" method="post" action="procesos/p_agentes-biologicos.php" enctype="multipart/form-data">
              
                    <input type="hidden" name="guardar" id="guardar">
              <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                <h1>Formato 6A</h1>
                <h4>Agentes biológicos potencialmente peligrosos</h4>
                <p>Para <strong>TODOS</strong> los proyectos que involucran microorganismos, rADN,  tejido fresco, sangre y/o fluidos corporales.<br>
                  Requiere aprobación de <strong>CCR/CIUCA/CIBS/RAC</strong> <span style="color:red;">previa a la experimentación.</span></p>
                <div class="row">
                  <div class="large-8 medium-8 small-12 columns">
                    <label>Expocientífico/Líder del Proyecto</label>
                    <div class="small-12 medium-4 large-4 columns">
                        <input name="lider" type="text" class="radius" id="lider" placeholder="Nombre" value="<?= @$result_formato['lider'] ?>"/>
                      </div>
                      <div class="small-12 medium-4 large-4 columns">
                        <input name="lider_paterno" type="text" class="radius" id="lider_paterno" placeholder="Apellido Paterno" value="<?= @$result_formato['lider_paterno'] ?>"/>
                      </div>
                      <div class="small-12 medium-4 large-4 columns">
                        <input name="lider_materno" type="text" class="radius" id="lider_materno" placeholder="Apellido Materno" value="<?= @$result_formato['lider_materno'] ?>"/>
                      </div>
                    <label>Título del Proyecto:</label>
                    <input name="proyecto" type="text" class="radius" id="proyecto" placeholder="Título del Proyecto" value="<?= @$result_formato['proyecto'] ?>"/>
                  </div>
                  </div>
                  <div class="row columns">
                    <p><strong>Para ser completado por el estudiante en colaboración del Científico Calificado/Supervisor</strong> (todas las preguntas deben contestarse y son aplicables. Pueden anexarse páginas adicionales):</p>
                    <label>1) Identifica los agentes biológicos potencialmente peligrosos a usar en este proyecto. Incluye la fuente, cantidad y nivel de bioseguridad de cada microorganismo.</label>
                    <div class="small-12 medium-12 large-12 columns">
                      <textarea name="biologicos" rows="3" cols="10" ><?= @$result_formato['biologicos'] ?></textarea>
                    </div>
                    <label>2)  Describe el lugar de la experimentación incluyendo el nivel de confinamiento biológico.</label>
                    <div class="small-12 medium-12 large-12 columns">
                      <textarea name="lugar" rows="3" cols="10"><?= @$result_formato['lugar'] ?></textarea>
                    </div>
                    <label>3) Describe el método de desecho de todos los materiales cultivados y otros agentes biológicos potencialmente peligrosos.</label>
                    <div class="small-12 medium-12 large-12 columns">
                      <textarea name="metodo_desecho" rows="3" cols="10"><?= @$result_formato['metodo_desecho'] ?></textarea>
                    </div>
                    <label>4) Describe los procedimientos que se usarán para minimizar los riesgos (equipo de protección, tipo de capucha, etc.)</label>
                    <div class="small-12 medium-12 large-12 columns">
                      <textarea name="procedimiento_riesgos" rows="3" cols="10"><?= @$result_formato['procedimiento_riesgos'] ?></textarea>
                    </div>
                    <label>5) ¿Qué nivel de bioseguridad final recomiendas para este proyecto, dado el diagnóstico de riesgo que observaste?</label>
                    <div class="small-12 medium-12 large-12 columns">
                      <textarea name="seguridad" rows="3" cols="10"><?= @$result_formato['seguridad'] ?></textarea>
                    </div>
        
                    <br>
                    <p><strong>Para ser completado por el Científico Calificado o el Supervisor.</strong></p>
                    <label>1) ¿Qué entrenamiento recibió (recibieron) el (los) estudiante (s) para este proyecto?</label>
                    <div class="small-12 medium-12 large-12 columns">
                      <textarea width="100%" name="entrenamiento" rows="3" cols="10"><?= @$result_formato['entrenamiento'] ?></textarea>
                    </div>
                    <div class="row">
                      <label><span>2)</span>
                        ¿Está de acuerdo con la información de bioseguridad y recomendaciones dadas arriba por el (los) estudiante (s) investigador (es)?  
                      </label>
                    </div>
                      <div class="row">
                        <div class="large-3 medium-3 small-3 columns">
                          <label class="sub-checkbox">
                            <input type="radio" name="acuerdo_recomendaciones" value="si" <?php if(@$result_formato['acuerdo_recomendaciones'] == 'si') echo 'checked' ?>>
                            Sí.
                          </label>
                        </div>
                        <div class="large-2 medium-2 small-2 columns">
                          <label class="sub-checkbox">
                            <input type="radio" name="acuerdo_recomendaciones" id="acuerdo_recomendaciones_no" value="no" <?php if(@$result_formato['acuerdo_recomendaciones'] == 'no') echo 'checked' ?>>
                            No.
                          </label>
                        </div>
                      </div>
                      <div>
                        <label for="acuerdo_recomendaciones" class="error" style="display:none;"></label>
                      </div>
                      <label>Si contestó que no, explique.</label>
                    <div class="small-12 medium-12 large-12 columns">
                      <textarea width="100%" name="acuerdo_recomendaciones_txt" rows="3" cols="10"><?= @$result_formato['acuerdo_recomendaciones_exp'] ?></textarea>
                      <br>
                    </div>
                  </div>
        
                  <div class="row">
                    <br><br>
                    <div class="small-12 medium-12 large-12 columns">
                      <label>Nombre impreso del Supervisor</label>
                    <div class="small-12 medium-4 large-4 columns">
                        <input name="supervisor1" type="text" class="radius" id="supervisor1" placeholder="Nombre" value="<?= @$result_formato['supervisor1'] ?>"/>
                      </div>
                      <div class="small-12 medium-4 large-4 columns">
                        <input name="supervisor1_paterno" type="text" class="radius" id="supervisor1_paterno" placeholder="Apellido Paterno" value="<?= @$result_formato['supervisor1_paterno'] ?>"/>
                      </div>
                      <div class="small-12 medium-4 large-4 columns">
                        <input name="supervisor1_materno" type="text" class="radius" id="supervisor1_materno" placeholder="Apellido Materno" value="<?= @$result_formato['supervisor1_materno'] ?>"/>
                      </div>
                    </div>
                    <div class="clear"></div>
                     <div class="small-12 medium-6 large-6 columns">
                      <label style="padding-top:5px;" class="left">Fecha de firma <span style="color:red;">(abril-mayo)</span></label>
                        <input name="fecha_supervisor1" type="date" class="radius" id="fecha_supervisor1" placeholder="Fecha del firma" value="<?= @$result_formato['fecha_supervisor1'] ?>"/>
                    </div>
                  </div>
                  
                  <div class="row">
                    <p><strong>A completar por el CCR antes de la experimentación en un laboratorio NBS-1:</strong></p>
                    <div class="row">
                      <label class="sub-checkbox">
                        <input type="checkbox" name="NBS1" value="1" <?php if(@$result_formato['NBS1'] == 1) echo 'checked' ?>>
                        El CCR ha estudiado cuidadosamente el Plan de Investigación y la evaluación de riesgo de este proyecto, por lo que aprueba este estudio como de nivel de bioseguridad 1, el cual debe conducirse en un laboratorio categoría NBS-1 o superior.
                      </label>
                    </div>
                    <br>
                    <div class="row">
                      <label class="sub-checkbox">
                        <input type="checkbox" name="NBS2" value="1" <?php if(@$result_formato['NBS2'] == 1) echo 'checked' ?>>
                        El CCR ha estudiado cuidadosamente el Plan de Investigación y la evaluación de riesgo de este proyecto, por lo que aprueba este estudio como de nivel de bioseguridad 2, el cual debe conducirse en un laboratorio categoría NBS-2 o superior.
                      </label>
                    </div>
                    <div class="row">
                    <div class="small-12 medium-12 large-12 columns">
                      <label>Nombre impreso del Supervisor</label>
                    <div class="small-12 medium-4 large-4 columns">
                        <input name="supervisor2" type="text" class="radius" id="supervisor2" placeholder="Nombre" value="<?= @$result_formato['supervisor2'] ?>"/>
                      </div>
                      <div class="small-12 medium-4 large-4 columns">
                        <input name="supervisor2_paterno" type="text" class="radius" id="supervisor2_paterno" placeholder="Apellido Paterno" value="<?= @$result_formato['supervisor2_paterno'] ?>"/>
                      </div>
                      <div class="small-12 medium-4 large-4 columns">
                        <input name="supervisor2_materno" type="text" class="radius" id="supervisor2_materno" placeholder="Apellido Materno" value="<?= @$result_formato['supervisor2_materno'] ?>"/>
                      </div>
                    </div>
                    </div>
                     <div class="small-12 medium-6 large-6 columns">
                      <label style="padding-top:5px;" class="left">Fecha de firma <span style="color:red;">(abril-mayo)</span></label>
                        <input name="fecha_supervisor2" type="date" class="radius" id="fecha_supervisor2" placeholder="Fecha del firma" value="<?= @$result_formato['fecha_supervisor2'] ?>"/>
                    </div>
                  </div>
                  <p><strong>A completar por el CCR después de la experimentación en un laboratorio NBS-2 o superior con preaprobación institucional:</strong></p>
                  <div class="row">
                      <label class="sub-checkbox">
                        <input type="checkbox" name="aprovado_comite" value="1" <?php if(@$result_formato['aprovado_comite'] == 1) echo 'checked' ?>>
                        Este proyecto fue revisado y aprobado por el comité institucional apropiado (RAC, CIUCA, CIBS) antes de la experimentación en un laboratorio NBS-2 o superior y cumple con las reglas de Intel ISEF. Las formas institucionales requeridas se anexan.
                      </label>
                    </div>
                    <div class="small-12 medium-12 large-12 columns">
                      <label>Nombre impreso del Supervisor</label>
                    <div class="small-12 medium-4 large-4 columns">
                        <input name="supervisor3" type="text" class="radius" id="supervisor3" placeholder="Nombre" value="<?= @$result_formato['supervisor3'] ?>"/>
                      </div>
                      <div class="small-12 medium-4 large-4 columns">
                        <input name="supervisor3_paterno" type="text" class="radius" id="supervisor3_paterno" placeholder="Apellido Paterno" value="<?= @$result_formato['supervisor3_paterno'] ?>"/>
                      </div>
                      <div class="small-12 medium-4 large-4 columns">
                        <input name="supervisor3_materno" type="text" class="radius" id="supervisor3_materno" placeholder="Apellido Materno" value="<?= @$result_formato['supervisor3_materno'] ?>"/>
                      </div>
                    </div>
                    </div>
                     <div class="small-12 medium-6 large-6 columns">
                      <label style="padding-top:5px;" class="left">Fecha de firma <span style="color:red;">(abril-mayo)</span></label>
                        <input name="fecha_supervisor3" type="date" class="radius" id="fecha_supervisor3" placeholder="Fecha del firma" value="<?= @$result_formato['fecha_supervisor3'] ?>"/>
                    </div>
                  </div>
                  </div>
        
                  <div class="clear"></div>
                  <div class="row">
                      <div class="large-2 medium-3 small-12 columns">
                        <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_agentes-biologicos')[0].submit();">Guardar</button>
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
                  </div>
                  <!-- Mensaje de error -->
                  <div id="div_error_archivo" class="large-9 push-1 medium-10 small-12 columns log-error text-center" style="display:none; font-size:.85em;" >
                    Es necesario anexar el formato impreso ( subir archivo ) para completar el formulario
                  </div>
                </form>
                
    	  <?php endif; ?>  <!--fin-->        
                <div class="clear"></div>
    </section>
    <section  class="registro print-only">
      <div class="row">
        <div class="large-5 medium-5 small-12 columns text-center">
          Firmar por el CCR antes de la experimentación en un laboratorio NBS-1
          <br><br>
         ______________________________________________________<br>
         Firma del Presidente del CCR
         <br><br>
        </div>
        <div class="large-5 medium-5 small-12 columns text-center">
         Firmar por el CCR después de la experimentación en un laboratorio NBS-2 o superior con pre-aprobación institucional:
          <br><br>
         ______________________________________________________<br>
         Firma del Presidente del CCR
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
