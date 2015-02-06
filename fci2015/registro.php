<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(isset($_SESSION['fenaci'])) redirect('registro-ok.php');
	
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
	
		$(function(){
			
			$("#forma_registro").validate({
				
				submitHandler: function(form) {	
					
					$('#btn_enviar').css('visibility', 'hidden');
					$('#lbl_enviar').css('visibility', 'visible');
					
					if($('[name="file_indentificacion"]').val() == '' || $('[name="file_curp"]').val() == ''){
						$('#btn_enviar').css('visibility', 'visible');
						$('#lbl_enviar').css('visibility', 'hidden');
						return false;	
					}
					
					form.submit();	
					
				},
				
				rules: {
					
					'nombre':{ required: true },
					'email':{ 
						required: true,
						email: true 
					},
					'tipo':{ required: true },
					'file_indentificacion':{ required: true },
					'file_curp':{ required: true },
					'password':{ required: true },
					'password_confirm':{ required: true }
				},
				
				messages:{
					'nombre':'<br>',
					'email':{
						'required':'<br>',
						'email':'Debe ser un email valido'
					},
					'tipo':'',
					'file_indentificacion':'',
					'file_curp':'',
					'password':'<br>',
					'password_confirm':'<br>'
					
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

    <section class="section01">

      <div class="row">
      
      <form name="forma_registro" id="forma_registro" method="post" action="procesos/p_registro.php" enctype="multipart/form-data">
      
        <h1>Registro <span style="color:#F00; font-size:10px;">(* Requeridos)</span></h1>
        <div class="large-6 medium-6 small-12 columns">
          
          <div class="row">
            <div class="large-12 medium-12 small-12 columns">
              <span style="color:#F00;">*</span>Nombre
             <input name="nombre" type="text" class="radius" id="nombre" placeholder="Nombre Completo"/>
            </div>
            <div class="large-12 medium-12 small-12 columns">
              <span style="color:#F00;">*</span>E-mail <span style="font-size:11px;">( ser&aacute; su usuario para entrar al sitio )</span>
              <input name="email" type="email" class="radius" id="email" placeholder="E-mail" />
            </div>
            <div class="large-12 medium-12 small-12 columns">
              <span style="color:#F00;">*</span>Contraseña
              <input name="password" type="password" class="radius" id="password" placeholder="Contraseña" />
            </div>
            <div class="large-12 medium-12 small-12 columns">
              <span style="color:#F00;">*</span>Confirmar Contraseña
              <input name="password_confirm" type="password" class="radius" id="password_confirm" placeholder="Confirmar Contraseña" />
            </div>
            <div class="large-12 medium-12 small-12 columns">
              <span style="color:#F00;">*</span>Perfil
              <select name="tipo" id="tipo">
                <option value="Estudiante">Estudiante</option>
                <option value="Mentor">Mentor</option>
              </select>
              <br><br>
            </div>
            <div class="small-12 large-12 medium-12 columns top20">
                <button type="submit" class="buton" name="btn_enviar" id="btn_enviar">Enviar</button>
                <label id="lbl_enviar" style="visibility:hidden;">
                <img id="img_save_sub" src="img/cargando_2.gif" border="0"/>
                &nbsp; Enviando...                                
                </label>
                 
             </div>
          </div>
           <label for="file_indentificacion" class="error" style="display:none;"></label> 
        </div>
        <div class="large-5 medium-5 small-12 columns text-left">
          <span style="color:#F00;">*</span>Identificación Oficial:<br> <span class="nota7">(Credencial de elector o credencial escolar, Pasaporte)</span>
           <div class="large-12 medium-12 small-12 columns">
                <input type="file" name="file_indentificacion" id="fileupload"/>
                <label style="margin-left:0;" id="fileupload-label" for="fileupload">SUBIR ARCHIVOS</label>
                
             </div>
             <div class="clear"></div>
             <span style="color:#F00;">*</span>CURP:
             <div class="large-12 medium-12 small-12 columns">
                <input type="file" name="file_curp" id="fileupload2"/>
                <label style="margin-left:0;" id="fileupload-label" for="fileupload2">SUBIR ARCHIVOS</label>
             </div>
             
        </div>
        
        
        
        </form>
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
