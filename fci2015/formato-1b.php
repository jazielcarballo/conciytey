<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato1b WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
			
			$("#forma_formato1B").validate({
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
					'compromiso_opciones[]':{ 
						required: "#compromiso:checked",
						minlength: 1
					},
					'expocientifico':{ required: true },
					'expocientifico_paterno':{ required: true },
					'expocientifico_materno':{ required: true },
					'fecha_expocientifico':{ required: true },
					'padre':{ required: true },
					'fecha_padre':{ required: true },
					'a_titular':{ required: true },
					'a_fecha':{ required: true },
					'a_feria_opciones[]':{ 
						required: "#a_feria:checked",
						minlength: 1
					},
					'b_titular':{ required: true },
					'b_fecha':{ required: true },
					'b_feria_opciones[]':{ 
						required: "#b_feria:checked",
						minlength: 1
					},
					'presidente':{ required: true },
					'fecha_presidente':{ required: true }
				},
				
				messages:{
					'compromiso_opciones[]':'Seleccione una.',
					'expocientifico_paterno':'Campo requerido.',
					'expocientifico_materno':'Campo requerido.',
					'expocientifico':'Campo requerido.',
					'lider_paterno':'Campo requerido',
					'lider_materno':'Campo requerido',
					'fecha_expocientifico':'Campo requerido.',
					'padre':'Campo requerido.',
					'fecha_padre':'Campo requerido.',
					'a_titular':'Campo requerido.',
					'a_fecha':'Campo requerido.',
					'a_feria_opciones[]':'Seleccione una.',
					'b_titular':'Campo requerido.',
					'b_fecha':'Campo requerido.',
					'b_feria_opciones[]':'Seleccione una.',
					'presidente':'Campo requerido.',
					'fecha_presidente':'Campo requerido.'
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
	
    	<form name="forma_formato1B" id="forma_formato1B" method="post" action="procesos/p_formato-1b.php" enctype="multipart/form-data">
    
    	<input type="hidden" name="guardar" id="guardar">
    
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Formato 1B - Aprobación de Proyecto Científico Juvenil</h1>
        <p>Requerida para TODOS los proyectos y para cada uno de los autores. Debe llenarse al inicio de la investigación (enero-marzo)</p>
        
          <label><span>1.</span>
          	
            <?php $arr_compromiso = explode(',',@$result_formato['compromiso']);?>
            
                a)  Compromiso del Expocientífico: <input type="checkbox" name="compromiso" id="compromiso" checked style=" display:none;"><!-- -->
                <label for="compromiso_opciones[]" class="error" style="display:none;"></label>
              </label>
              <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="checkbox" name="compromiso_opciones[]" value="riesgos" <?php if(in_array('riesgos',$arr_compromiso)) echo 'checked' ?>>
                    Entiendo los riesgos y posibles peligros para mí en lo dispuesto en el Plan de Investigación y anexos. Además, he leído y respetaré todas las reglas del Protocolo Internacional de Proyectos Científicos Juveniles (PIPCIJ) mientras desarrolle la investigación.
                  </label>
                  <br>
                </div>
                <div class="large-12 medium-12 small-12 columns">
                  <label class="sub-checkbox">
                    <input type="checkbox" name="compromiso_opciones[]" id="compromiso_declaracion" value="declaracion" <?php if(in_array('declaracion',$arr_compromiso)) echo 'checked' ?>>
                    He leído y estoy advertido acerca de la declaración de ética: “El fraude científico y la mala conducta no son toleradas en ningún nivel de investigación o competencia. El plagio, uso o presentación de trabajo de otra persona como propio, falsificación de firmas de autorización y fabricación o falsificación de datos no serán aceptados. Proyectos fraudulentos no calificarán para participar en cualquier Feria afiliada de Intel”.
                  </label>
                </div>
                
              </div>
			
          <div class="clear"></div>
          
          <br>
         
          <div class="large-8 medium-8 small-8 columns">
            <label>Nombre del Expocientífico </label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="expocientifico" type="text" class="radius" id="expocientifico" value="<?= @$result_formato['expocientifico'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="expocientifico_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['expocientifico_paterno'] ?>"placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="expocientifico_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['expocientifico_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Fecha del compromiso</label>
            <input name="fecha_expocientifico" type="date" class="radius" id="fecha_expocientifico" value="<?= @$result_formato['fecha_expocientifico'] ?>" placeholder="Fecha del compromiso"/>
          </div>

          <div class="clear"></div>
          <br>

          <div class="large-12 medium-12 small-12 columns">
            <label>
               b)  Aprobación del Padre o Tutor: He leído y entiendo los riesgos y posibles peligros involucrados en el Plan de Investigación y anexos. Doy consentimiento para que mi hijo/protegido participe en la investigación.
            </label>
          </div>
          <div class="clear"></div>
          <br>
          <div class="large-8 medium-8 small-8 columns">
            <label>Nombre del Padre o Tutor</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="padre" type="text" class="radius" id="nombre" value="<?= @$result_formato['padre'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="padre_paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['padre_paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="padre_materno" type="text" class="radius" id="materno" value="<?= @$result_formato['padre_materno'] ?>" placeholder="Apellido Materno"/>
              </div>
          </div>
          <div class="large-4 medium-4 small-12 columns">
            <label>Fecha del compromiso</label>
            <input name="fecha_padre" type="date" class="radius" id="fecha_padre" value="<?= @$result_formato['fecha_padre'] ?>" placeholder="Fecha del compromiso"/>
          </div>    
          <div class="clear"></div>
          <br>
              <label><span>2.</span>
                REQUISITO PARA PROYECTOS CON NECESIDAD DE APROBACIÓN DEL COMITÉ INSTITUCIONAL DE REVISIÓN Y EL COMITÉ CIENTÍFICO DE <span>REVISIÓN (CIR/CCR. (No Llenar 2 ni 3)</span>
              </label>
          <div class="clear"></div>
          <br>
          <div class="large-5 medium-5 small-5 columns revision">
            <strong>a) Requisito para proyectos que requieren de aprobación del CIR/CCR previa a la experimentación. (i.e. ver punto 8 Formato 1A.).</strong>
            <br><br>
            El <strong>CIR/CCR</strong> ha estudiado cuidadosamente el <strong>Cronograma de Investigación 1A y anexos</strong> de este proyecto y los formatos que requieren ser son incluidos. Mi firma indica su aprobación previa al desarrollo del proyecto.
            <br><br>
            <div class="row">
              <div class="large-12 medium-12 small-12 columns">
                <label>Titular del <strong>CIR/CCR</strong></label>
                <input name="a_titular" type="text" class="radius" id="a_titular" value="<?= @$result_formato['a_titular'] ?>" placeholder="Titular del CIR/CCR"/>
              </div>
              <br>
              <div class="large-12 medium-12 small-12 columns">
                <label>Fecha del compromiso</label>
                <input name="a_fecha" type="date" class="radius" id="a_fecha" value="<?= @$result_formato['a_fecha'] ?>" placeholder="Fecha del compromiso"/>
              </div>
              <br>
            </div>
            <br>
            <div class="row">
              <br><br>
              <?php $arr_a_feria = explode(',',@$result_formato['a_feria']);?>
              <div class="large-3 medium-3 small-3 columns">
              	<input type="checkbox" name="a_feria" id="a_feria" style="display:none;" checked>
                <label>Tipo de Feria</label>
              </div>
              <div class="large-3 medium-3 small-3 columns">
                 <label>
                  <input type="checkbox" name="a_feria_opciones[]" id="a_feria_opciones" value="oficial" <?php if(in_array('oficial',$arr_a_feria)) echo 'checked' ?>>
                  Oficial
                </label>
              </div>
              <div class="large-3 medium-3 small-3 columns">
                <label>
                  <input type="checkbox" name="a_feria_opciones[]" id="a_feria_opciones" value="afiliada" <?php if(in_array('afiliada',$arr_a_feria)) echo 'checked' ?>>
                  Afiliada
                </label>

              </div>
            </div>
            <div>
            	<label for="a_feria_opciones[]" class="error" style="display:none;"></label>
            </div>
          </div>
         <div class="large-5 medium-5 small-5 columns revision">
            <strong>b) Requisito para proyectos desarrollados en instituciones o centros de investigación afiliados sin aprobación previa del CCR.</strong>
            <br><br>
            Este proyecto fue desarrollado en una institución o centro de investigación afiliado <strong>(no es un plantel educativo medio superior u hogar) </strong>sin conocimiento del CCR previo al desarrollo del proyecto, pero cumple con lo dispuesto en el <strong>PIPCIJ. Cumple con el Anexo 1C y aprobaciones institucionales requeridas</strong>
            <br><br>
            <div class="row">
              <div class="large-12 medium-12 small-12 columns">
                <label>Titular del <strong>CIR/CCR</strong></label>
                <input name="b_titular" type="text" class="radius" id="b_titular" value="<?= @$result_formato['b_titular'] ?>" placeholder="Titular del CIR/CCR"/>
              </div>
              <br>
              <div class="large-12 medium-12 small-12 columns">
                <label>Fecha del compromiso</label>
                <input name="b_fecha" type="date" class="radius" id="b_fecha" value="<?= @$result_formato['b_fecha'] ?>" placeholder="Fecha del compromiso"/>
              </div>
              <br>
            </div>
            <br>
            <div class="row">
              <div class="large-3 medium-3 small-3 columns">
              <?php $arr_b_feria = explode(',',@$result_formato['b_feria']);?>
              	<input type="checkbox" name="b_feria" id="b_feria" style="display:none;" checked>
                <label>Tipo de Feria</label>
              </div>
              <div class="large-3 medium-3 small-3 columns">
                 <label>
                  <input type="checkbox" name="b_feria_opciones[]" id="b_feria_opciones" value="oficial" <?php if(in_array('oficial',$arr_b_feria)) echo 'checked' ?>>
                  Oficial
                </label>
              </div>
              <div class="large-3 medium-3 small-3 columns">
                <label>
                  <input type="checkbox" name="b_feria_opciones[]" id="b_feria_opciones" value="afiliada" <?php if(in_array('afiliada',$arr_b_feria)) echo 'checked' ?>>
                  Afiliada
                </label>
              </div>
            </div>
            <div>
            	<label for="b_feria_opciones[]" class="error" style="display:none;"></label>
            </div>
          </div>
              <div class="clear"></div>
              <p><strong>Nota:</strong> En caso de utilizar un sello institucional deberá ser rubricado por el titular del CIR/CCR</p>
          <label><span>3.</span>
              APROBACIÓN DEL COMITÉ CIENTÍFICO DE REVISIÓN CCR PARA PARTICIPAR COMO FINALISTA NACIONAL.</span>
          </label>
          <p><span>El CCR aprobará el proyecto después de su desarrollo y poco antes de su participación en una feria regional/estatal afiliada. Certificando que el proyecto cumple con el Cronograma de Investigación 1A y con lo dispuesto en el PIPCIJ. </span></p>
          <div class="row">
            <div class="large-6 medium-6 small-6 columns">
                <label>Presidente del Comité Científico de Revisión</label>
                <input name="presidente" type="text" class="radius" id="presidente" value="<?= @$result_formato['presidente'] ?>" placeholder="Presidente del Comité Científico de Revisión"/>
            </div>
            <div class="large-5 medium-5 small-5 columns">
              <div class="large-12 medium-12 small-12 columns">
                <label>Fecha del compromiso</label>
                <input name="fecha_presidente" type="date" class="radius" id="fecha_presidente" value="<?= @$result_formato['fecha_presidente'] ?>" placeholder="Fecha del compromiso"/>
              </div>
            </div>
          </div>
          <div class="clear"></div>
         <div class="large-2 medium-3 small-12 columns">
                <button type="" class="btn btn-guardar" name="" id="" onClick="$('#guardar').val(1);$('#forma_formato1B')[0].submit();">Guardar</button>
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
         Firma
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
