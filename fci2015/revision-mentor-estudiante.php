<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
	
	$sql = "SELECT * FROM formato1a WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
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
//				
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
					'titulo':{ required:true},
					'reglas_protocolo':{ required:true},
					'lista_revision':{ required:true},
					'riesgos':{ required:true},
					'areas_opciones_biologicos[]':{ 
						required: "#agentes_biologicos:checked",
						minlength: 1
					},
					'formatos':{ required:true},
					'formato_todos[]':{ 
						required: "#formatos:checked",
						minlength: 6
					},
					'formatos_adicionales_opciones[]':{ 
						required: "#formatos_adicionales:checked",
						minlength: 1
					},
					'formatos_adicionales_humanos[]':{ 
						required: "#formatos_adicionales_humanos:checked",
						minlength: 1
					},
					'formatos_adicionales_vertebrados[]':{ 
						required: "#formatos_adicionales_vertebrados:checked",
						minlength: 1
					},
					'formatos_adicionales_biologicos[]':{ 
						required: "#formatos_adicionales_biologicos:checked",
						minlength: 1
					}
					,
					'formatos_adicionales_quimicos[]':{ 
						required: "#formatos_adicionales_quimicos:checked",
						minlength: 1
					}
					
				},
				
				messages:{
					'nombre':'Campo requerido.',
					'paterno':'Campo requerido',
					'materno':'Campo requerido',
					'titulo':'Campo requerido.',
					'reglas_protocolo':'Campo requerido.',
					'lista_revision':'Campo requerido.',
					'riesgos':'Campo requerido.',
					'areas_opciones_biologicos[]':'Seleccione al menos uno.',
					'formatos':'Campo requerido.',
					'formato_todos[]':'Debe contar con todos los formatos.',
					'formatos_adicionales_opciones[]':'Seleccione al menos un formato adicional.',
					'formatos_adicionales_humanos[]':'Seleccione al menos uno.',
					'formatos_adicionales_vertebrados[]':'Seleccione al menos uno.',
					'formatos_adicionales_biologicos[]':'Seleccione al menos uno.',
					'formatos_adicionales_quimicos[]':'Seleccione al menos uno.'
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
        <form name="forma_formato1A" id="forma_formato1A" method="post" action="procesos/p_revision-mentor-estudiante.php">
        	<input type="hidden" name="guardar" id="guardar">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
        <h1>Formato 1</h1>
        <h4>Lista de Revisión del Mentor / Compromiso de seguridad</h4>
        <p><strong>El llenado completo de este Formato es requerido para todos los proyectos. Solo para participantes con FOLIO 2012. </strong><br>
        Para ser completado por el Mentor en colaboración con el (los) estudiante(s):</p>
        
          <div class="large-8 medium-8 small-12 columns">
            <label>Estudiante autor / Líder del Proyecto</label>
              <div class="small-12 medium-4 large-4 columns">
                <input name="nombre" type="text" class="radius" id="nombre" value="<?= @$result_formato['nombre'] ?>" placeholder="Nombre"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="paterno" type="text" class="radius" id="paterno" value="<?= @$result_formato['paterno'] ?>" placeholder="Apellido Paterno"/>
              </div>
              <div class="small-12 medium-4 large-4 columns">
                <input name="materno" type="text" class="radius" id="materno" value="<?= @$result_formato['materno'] ?>" placeholder="Apellido Materno"/>
              </div>
            <label>Título del Proyecto:</label>
            <input name="titulo" type="text" class="radius" id="titulo" value="<?= @$result_formato['titulo'] ?>" placeholder="Título del Proyecto"/>
          </div>
          <div class="clear"></div>
              <label><span>1.</span>
                <input name="reglas_protocolo" id="reglas_protocolo" value="1" <?php if(@$result_formato['reglas_protocolo'] == 1) echo 'checked' ?> type="checkbox" >
                He revisado las Reglas del Protocolo y sus lineamientos.
                <label for="reglas_protocolo" class="error" style="display:none;">Campo requerido.</label>
              </label>
              <label><span>2.</span>
                <input name="lista_revision" id="lista_revision" value="1" <?php if(@$result_formato['lista_revision'] == 1) echo 'checked' ?> type="checkbox" >
                He revisado la Lista de Revisión del Estudiante (1A) y el Plan de Investigación.
                <label for="lista_revision" class="error" style="display:none;">Campo requerido.</label>
              </label>
              <label><span>3.</span>
                <input name="riesgos" id="riesgos" value="1" <?php if(@$result_formato['riesgos'] == 1) echo 'checked' ?> type="checkbox">
                He trabajado con el (los) estudiante(s) y hemos discutido los posibles riesgos existentes en el proyecto.
                <label for="riesgos" class="error" style="display:none;">Campo requerido.</label>
              </label>
              <label><span>4.</span>
                <!--<input name="areas" id="areas" type="checkbox">-->
                El proyecto involucra alguna de las siguientes áreas y requiere de aprobación previa a la experimentación:
                <!--<label for="areas" class="error" style="display:none;">Campo requerido.</label>-->
              </label>
              <div class="row">
              	<div> 
                <label for="areas_humanos" class="error" style="display:none;"></label>
              	</div>
                
                <?php $arr_areas_biologicos = explode(',',@$result_formato['areas_biologicos']);?>
                
                <div class="large-3 medium-3 small-6 columns">
                  <label class="sub-checkbox">
                    <input name="areas_humanos" id="sujetos_humanos" value="1" <?php if(@$result_formato['areas_humanos'] == 1) echo 'checked' ?> type="checkbox">
                    Sujetos Humanos
                  </label>
                </div>
                <div class="large-9 medium-9 small-12 columns">
                  <label class="sub-checkbox">
                    <input name="areas_opciones" id="agentes_biologicos" value="1" <?php if(strlen(@$result_formato['areas_biologicos']) > 0) echo 'checked' ?> type="checkbox">
                    Agentes biológicos potencialmente peligrosos:
                  </label>
                  <div class="row">
                    <div class="large-5 medium-4 small-12 columns">
                      <label class="sub-checkbox2">
                        <input name="areas_opciones_biologicos[]" id="agentes_biologicos_microorganismos" value="Microorganismos" <?php if(in_array('Microorganismos',$arr_areas_biologicos)) echo 'checked' ?> type="checkbox">
                        Microorganismos
                      </label>
                       
                    </div>
                    <div class="large-3 medium-4 small-12 columns">
                      <label class="sub-checkbox2">
                        <input name="areas_opciones_biologicos[]" id="agentes_biologicos_rADN" value="rADN" <?php if(in_array('rADN',$arr_areas_biologicos)) echo 'checked' ?> type="checkbox" >
                        rADN
                      </label>
                    </div>
                    <div class="large-3 medium-4 small-12 columns">
                       <label class="sub-checkbox2">
                        <input name="areas_opciones_biologicos[]" id="agentes_biologicos_tejidos" value="Tejidos" <?php if(in_array('Tejidos',$arr_areas_biologicos)) echo 'checked' ?> type="checkbox">
                        Tejidos
                      </label>
                    </div>
                    <div> 
                    <label for="areas_opciones_biologicos[]" class="error" style="display:none;"></label>
                    </div>
                  </div>
                </div> 
                
              </div>
              <label><span>5.</span>
                <input name="formatos" id="formatos" type="checkbox" checked style="display:none;">
                Formatos que requieren TODOS LOS PROYECTOS:
                <label for="formatos" class="error" style="display:none;"></label>
              </label>
              
              <?php $arr_formatos = explode(',',@$result_formato['formatos_todos']);?>
              
                <div class="large-4 medium-4 small-12 columns">
                  <label class="sub-checkbox">
                    <input name="formato_todos[]" id="formato_F1" value="F1" <?php if(in_array('F1',$arr_formatos)) echo 'checked' ?>  type="checkbox" >
                    Revisión del Mentor (F1)               
                  </label>
                  <label class="sub-checkbox">
                    <input name="formato_todos[]" id="formato_F1B" value="F1B" <?php if(in_array('F1B',$arr_formatos)) echo 'checked' ?> type="checkbox">
                    Formato de Aprobación (F1B)               
                  </label>
                </div>
                <div class="large-4 medium-4 small-12 columns">
                  <label class="sub-checkbox">
                    <input name="formato_todos[]" id="formato_F1A" value="F1A" <?php if(in_array('F1A',$arr_formatos)) echo 'checked' ?> type="checkbox">
                    Revisión del Estudiante (F1A)        
                  </label>
                  <label class="sub-checkbox">
                    <input name="formato_todos[]" id="formato_F1C" value="F1C" <?php if(in_array('F1C',$arr_formatos)) echo 'checked' ?> type="checkbox">
                    Instalación Institucional (F1C)*        
                  </label>
                </div>
                <div class="large-4 medium-4 small-12 columns">
                  <label class="sub-checkbox">
                    <input name="formato_todos[]" id="formato_investigacion" value="Plan" <?php if(in_array('Plan',$arr_formatos)) echo 'checked' ?> type="checkbox">
                    Plan de Investigación 
                  </label>
                  <label class="sub-checkbox">
                    <input name="formato_todos[]" id="formato_F7" value="F7" <?php if(in_array('F7',$arr_formatos)) echo 'checked' ?> type="checkbox" >
                    Formato de Continuación (F7)* 
                  </label>
                </div>
                <div> 
                  <label for="formato_todos[]" class="error" style="display:none;"></label>
                </div>
                  <div class="large-12 medium-12 small-12 columns nota7">
                    *Solo si aplican para el proyecto. 
                  </div>
                <label><span>6.</span>
                  Formatos adicionales requeridos si aplican para el proyecto (cheque todos las que apliquen):
                </label>
                
                <?php $arr_adicionles_humanos = explode(',',@$result_formato['adicionles_humanos']);?>
                <div class="row">
                  <div class="large-12 medium-12 small-12 columns">
                    <label class="sub-checkbox">
                      Humanos (Requiere aprobación previa por un Comité Institucional de Revisión (CIR) <!-- Ver páginas 3-5 -->)
                    </label>
                    <div class="row">
                      <div class="large-4 medium-4 small-12 columns">
                        <label class="sub-checkbox2">
                          <input name="formatos_adicionales_humanos[]" id="formatos_adicionales_humanos_F4" value="F4" <?php if(in_array('F4',$arr_adicionles_humanos)) echo 'checked' ?> type="checkbox">
                          Sujetos Humanos (F4)
                        </label>                    
                      </div>
                      <div class="large-7 medium-7 small-12 columns">
                        <label class="sub-checkbox2">
                          <input name="formatos_adicionales_humanos[]" id="formatos_adicionales_humanos_F2" value="F2" <?php if(in_array('F2',$arr_adicionles_humanos)) echo 'checked' ?> type="checkbox">
                          Científico Calificado (F2) (Si aplica o es requerido por el CIR)
                        </label>
                      </div>
                    </div>
                  </div>
                  
                  <div> 
                    <label for="formatos_adicionales_humanos[]" class="error" style="display:none;"></label>
                    </div>
                  
                </div>
                
                <?php $arr_adicionales_vertebrados = explode(',',@$result_formato['adicionles_vertebrados']);?>
                <div class="row">
                  <div class="large-12 medium-12 small-12 columns">
                    <label class="sub-checkbox">
                      Animales Vertebrados (Requiere aprobación previa del CCR. <!-- Ver páginas 7-9 -->)
                    </label>
                    <div class="row">
                      <div class="large-12 medium-12 small-12 columns">
                        <label class="sub-checkbox2">
                          <input name="formatos_adicionales_vertebrados[]" id="formatos_adicionales_vertebrados_F5A" value="F5A" <?php if(in_array('F5A',$arr_adicionales_vertebrados)) echo 'checked' ?> type="checkbox">
                          Formato para Animales Vertebrados (F5A) Para proyectos desarrollados en una instalación no regulada.
                        </label>
                        <label class="sub-checkbox2">
                          <input name="formatos_adicionales_vertebrados[]" id="formatos_adicionales_vertebrados_F5B" value="F5B" <?php if(in_array('F5B',$arr_adicionales_vertebrados)) echo 'checked' ?> type="checkbox">
                           Formato para Animales Vertebrados (F5B) Para proyectos desarrollados en una Institución de Investigación Regulada (Requiere además aprobación previa a la experimentación de un CIUCA)
                        </label>
                         <label class="sub-checkbox2">
                          <input name="formatos_adicionales_vertebrados[]" id="formatos_adicionales_vertebrados_F2" value="F2" <?php if(in_array('F2',$arr_adicionales_vertebrados)) echo 'checked' ?> type="checkbox">
                           Formato de Científico Calificado (F2) 
                        </label>
                        <div> 
                        	<label for="formatos_adicionales_vertebrados[]" class="error" style="display:none;"></label>
                        </div>
                        <label class="sub-checkbox">
                          Agentes Biológicos Potencialmente Peligrosos (Requieren aprobación previa del CCR, CIUCA o CIBS. <!-- Ver páginas 14-21 -->)
                        </label>
                        
                        <?php $arr_adicionales_biologicos = explode(',',@$result_formato['adicionles_biologicos']);?>
                          <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                              <label class="sub-checkbox2">
                                <input name="formatos_adicionales_biologicos[]" id="formatos_adicionales_biologicos_F6A" value="F6A" <?php if(in_array('F6A',$arr_adicionales_biologicos)) echo 'checked' ?> type="checkbox">
                                Formato de Agentes Biológicos Potencialmente Peligrosos (F6A)
                              </label>
                              <label class="sub-checkbox2">
                                <input name="formatos_adicionales_biologicos[]" id="formatos_adicionales_biologicos_F6B" value="F6B" <?php if(in_array('F6B',$arr_adicionales_biologicos)) echo 'checked' ?> type="checkbox">
                                 Formato de Tejidos de Animales Vertebrados Humanos y no Humanos (F6B) – a ser completados además del Formato 6A cuando el proyecto usa tejido fresco, cultivos celulares primarios, sangre o productos sanguíneos y fluidos corporales
                              </label>
                               <label class="sub-checkbox2">
                                <input name="formatos_adicionales_biologicos[]" id="formatos_adicionales_biologicos_F2" value="F2" <?php if(in_array('F2',$arr_adicionales_biologicos)) echo 'checked' ?> type="checkbox">
                                 Formato de Científico Calificado (F2)
                              </label>
                              <label class="sub-checkbox2">
                                <input name="formatos_adicionales_biologicos[]" id="formatos_adicionales_biologicos_F3" value="F3" <?php if(in_array('F3',$arr_adicionales_biologicos)) echo 'checked' ?> type="checkbox">
                                 Formato de Evaluación de Riesgo (F3) Para los proyectos que involucran protistas, fósiles y microorganismos, estiércol para composta, materiales para producción de combustibles y otros similares.
                              </label>
                            </div>
                            <div> 
                        		<label for="formatos_adicionales_biologicos[]" class="error" style="display:none;"></label>
                        	</div>
                          </div>

                          <!--<label class="sub-checkbox2">
                          <input type="checkbox">
                           Formato de Científico Calificado (F2) 
                        </label>-->
                        <label class="sub-checkbox">
                          Químicos, Actividades y Aparatos peligrosos (No se requiere aprobación previa. <!-- Ver pp. 23-25 -->)
                        </label>
                        
                        <?php $arr_adicionles_quimicos = explode(',',@$result_formato['adicionles_quimicos']);?>
                          <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                              <label class="sub-checkbox2">
                                <input name="formatos_adicionales_quimicos[]" id="formatos_adicionales_quimicos_F6A" value="F6A" <?php if(in_array('F6A',$arr_adicionles_quimicos)) echo 'checked' ?> type="checkbox" >
                                Formato de Agentes Biológicos Potencialmente Peligrosos (F6A)
                              </label>
                              <label class="sub-checkbox2">
                                <input name="formatos_adicionales_quimicos[]" id="formatos_adicionales_quimicos_F3" value="F3" <?php if(in_array('F3',$arr_adicionles_quimicos)) echo 'checked' ?> type="checkbox">
                                 Formato de Evaluación de Riesgos (F3)
                              </label>
                               <label class="sub-checkbox2">
                                <input name="formatos_adicionales_quimicos[]" id="formatos_adicionales_quimicos_F2" value="F2" <?php if(in_array('F2',$arr_adicionles_quimicos)) echo 'checked' ?> type="checkbox">
                                 Formato de Científico Calificado (F2) (Requerido para proyectos que usen Sustancias Controladas)
                              </label>
                            </div>
                            <div> 
                        		<label for="formatos_adicionales_quimicos[]" class="error" style="display:none;"></label>
                        	</div>
                          </div>
                         </div>
                      </div>
                   </div> 
                </div>
                
                <div> 
                <label for="formatos_adicionales_opciones[]" class="error" style="display:none;"></label>
                </div>
                
				<!--
                <a href="">
                	<button class="btn btn-5">Enviar</button>
                </a>
				-->
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
    <section  class="registro print-only">
      <div class="row">
        <div class="large-5 medium-5 small-12 columns text-center">
          <br><br>
         ______________________________________________________<br>
         Firma del Mentor
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
  </body>
</html>
