<?php
	session_start();
	include("includes/conexion.php");
	include("includes/logo_banner.php");
	include("includes/configuracion.php");
	
	if(!isset($_SESSION['fenaci'])) redirect('registro.php');
		
	$sql = "SELECT * FROM formatos";
	$query_formatos = mysql_query($sql);
	
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

  </head>
  <body>
    <?php  require('header-estados.php'); ?>

    <section class="section01">

      <div class="row">
        <h1>Mi Perfil</h1>
        <div class="large-4 medium-4 small-12 columns">
          <div class="large-12 medium-12-small-12 columns">
            Nombre: <?=  $_SESSION['fenaci']["nombre"] ?>
          </div>
          <div class="large-12 medium-12-small-12 columns">
            Mail: <?=  $_SESSION['fenaci']["email"] ?>
          </div>
          <div class="large-12 medium-12-small-12 columns">
            Perfil: <?=  $_SESSION['fenaci']["tipo"] ?>
          </div>
        </div>
         <div  class="large-8 medium-8 small-12 columns">
         
         <form name="forma_archivos" id="forma_archivos" method="post" action="procesos/p_forma_archivos.php" enctype="multipart/form-data">
         
          <strong>Formularios que has llenado</strong>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <td width="550">Formularios</td>
                        <td>status</td>
                    </tr>
                </thead>
                
                <?php 
					$cantidad_subir = 0;
				
					while($row = mysql_fetch_array($query_formatos)): 
					
						//if($row['id'] != 3 AND $row['id'] != 11):
						
					
							$sql = "SELECT archivo,terminado FROM ".$row['tabla']." WHERE participante_id = '".$_SESSION['fenaci']["id_usuario"]."'";
							$query_archivo = mysql_query($sql);
							
							if(mysql_num_rows($query_archivo) > 0):
							
								$result_archivo = mysql_fetch_array($query_archivo);
								
								if($result_archivo['terminado'] == 1):
								
				?>
                                    <tr>
                                        <td class="table-tr"><?= $row['nombre_formato'] ?></td>
                                        <td class="table-tr text-center"><img src="img/thick.jpg" alt=""></td>
                                    </tr>
                		<?php 	
								else: 
									
									$cantidad_subir++;
						?>
                                
                                <tr>
                                    <td class="table-tr"><a href="<?= $row['url'] ?>"><?= $row['nombre_formato'] ?></a>
                                    
                                    <?php if(strlen($result_archivo['archivo']) > 0): ?>
                                            
                                            <div>Ya existe el archivo</div>
                                            <div>
                                            <br>
                                            <label for="">Subir Nuevo</label>
                                            <input type="file" name="file_<?= $row['tabla'] ?>" multiple placeholder="Choose File">
                                            </div>
                                            
                                    <?php 	else: ?>
                                    
                                            <div>
                                            <br>
                                            <label for="">Subir Archivo</label>
                                            <input type="file" name="file_<?= $row['tabla'] ?>" multiple placeholder="Choose File">
                                            </div>                                    		
                                    
                                    <?php 	endif ?>
                                    </td>
                                    <td class="table-tr text-center"><img src="img/thick-cross.jpg" alt=""></td>
                                </tr>
                	<?php 
								endif;
							
							endif;
							
						//endif;
					
					endwhile; 
				?>
                <tr>
                	<td colspan="2">
                        <?php 
							if($cantidad_subir > 0)
								echo '<button type="submit" class="btn btn-5" name="btn_enviar" id="btn_enviar">SUBIR ARCHIVOS</button>';
						?>
                    </td>
                </tr>
            </table>
          <!-- <div style="border-left: 1px solid #555; background:#48CCD8; color:white;" class="large-8 medium-8 small-8 columns">
            Formularios
          </div>
          <div style="border-left: 1px solid #fff; background:#48CCD8; color:white;" class="large-4 medium-4 small-4 columns">
            Status
          </div> -->
		
        </form>
        
        </div>
        
      </div>

    </section>

    <?php
     require('footer.php');
      ?>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
