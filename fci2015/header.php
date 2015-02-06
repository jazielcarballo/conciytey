    <script language="javascript">
		function login()
		{
			if($.trim($('#usuario_login').val()) == '' || $.trim($('#usuario_login').val()) == ''){
				$('#div_login_error').text('Especifique usuario y contraseña.');					
				$('#div_login_error').css('display', 'block');
				return false;	
			}	
			
			$('#div_login_error').css('display', 'none');
			
			$('#btn_login').css('visibility', 'hidden');
			$('#lbl_login').css('visibility', 'visible');
			
			//return false;
			
			var forma = $('#forma_login').serialize();
			
			$.post( "procesos/p_login.php", forma, function( data ) {
				if($.trim(data) != ''){		
					$('#div_login_error').text(data);					
					$('#div_login_error').css('display', 'block');
					//alert(data);							
					//console.log(data);
					$('#btn_login').css('visibility', 'visible');
					$('#lbl_login').css('visibility', 'hidden');
				}else{
					window.location='registro-ok.php';							
				}				  		
			});
		}
		
		
		function logout()
		{
			$.post( "procesos/p_logout.php",function( data ) {
				
				window.location='index.php';							
							  		
			});	
		}
		
    </script>
    
    
    <header>
      <div id="myModal" class="reveal-modal" data-reveal>
        <div class="large-12 medium-12 small-12 columns inicio">
              <div class="row">
                 <form id="forma_login">   
                    <div class="large-12 medium-10 small-12 columns text-center">
                      <h1>Iniciar Sesión</h1>
                    </div> 
                    <div class="clear"></div>
                    <div class="large-12 medium-10 small-12 columns">
                      <label class="left"> Usuario: </label>
                      <input type="text" name="usuario_login" id="usuario_login" placeholder="email" />
                    </div>                 
                    <div class="large-12 medium-10 small-12 columns ">
                      <label class="left"> Contrase&ntilde;a: </label>
                      <input type="password" name="password_login" id="password_login" placeholder="Contrase&ntilde;a" />
                    </div>
                    <!-- Mensaje de error -->
                    <div id="div_login_error" class="large-12 medium-10 small-12 columns log-error text-center" style="display:none;">
                     Usuario y/o contraseña incorrectos.
                    </div>
                      <div class="clear top10"></div>
                       <div class="large-12 medium-10 small-12 columns text-center" style="font-size:1.3em;">
                     <strong>¿No tienes cuenta?</strong> <a href="registro.php">Registrate.</a>
                    </div>
                    <div class="large-12 medium-9 small-9 columns top20"> 
                      <button type="button" class="buton" name="" id="btn_login" onclick="login()">Entrar</button>
                      <label id="lbl_login" style="visibility:hidden;">
                        <img id="img_save_sub" src="img/cargando_2.gif" border="0"/>
                        &nbsp; Login...                                
                       </label>
                    </div>                 
                </form>
              </div>
            </div>
            <a class="close-reveal-modal">&#215;</a>
          </div>
          
          
            <div id="cerrar-s" class="reveal-modal" data-reveal>
                <div class="large-12 medium-12 small-12 columns inicio">
                  <div class="row">
                     <form>   
                        <div class="large-12 medium-10 small-12 columns text-center">
                          <h1>Cerrar Sesión</h1>
                        </div> 
                        <div class="clear"></div>
                        <div class="large-12 medium-10 small-12 columns text-center">
                          <h5>¿Está seguro que desea cerrar la sesión?</h5>
                        </div>                 
                          <div class="clear top20"></div>
                        <div class="large-6 medium-9 small-9 columns text-center"> 
                          <button type="button" class="buton" name="" id="" onclick="$('#cerrar-s').foundation('reveal', 'close');">Permanecer</button>
                        </div>
                        <div class="large-6 medium-9 small-9 columns text-center cancel"> 
                          <button type="button" class="buton" name="" id="" onclick="logout()">Salir</button>
                        </div>                  
                    </form>
                  </div>
                </div>
                <a class="close-reveal-modal">&#215;</a>
            </div>
          
      <section>
          <div class="small-6 medium-3 large-3 columns conacyt-l">
            <a href="index.php"><img src="img/logo-conacyt-gob.jpg" alt="logotipo" title="Inicio"/></a>
          </div>
          <div class="large-2 medium-3 small-6 columns text-center">
            <img style="width:60%; margin-top:18px;" src="img/logo_banner/thumbnail/183thumb_<?= $logo ?>" alt="logo" title="logo"/>
          </div>
          <div class="small-6 medium-3 large-2 columns conacyt-l">
            <a href="index.php"><img src="img/logo-i2t2.jpg" alt="logotipo" title="Inicio"/></a>
          </div>
          <div class="small-6 medium-3 large-2 columns conacyt-l">
            <a href="index.php"><img src="img/logo_banner/thumbnail/181thumb_<?= $logo_consejo ?>" alt="logotipo" title="Inicio"/></a>
          </div>
          
          <?php if(isset($_SESSION['fenaci'])): ?>
                 <div class="large-3 medium-3 small-6 columns usuario text-right">
                    <img src="img/ic-user.jpg" alt=""> <a href="perfil.php"><?= $_SESSION['fenaci']["nombre"] ?></a> <br />
                    <strong>Folio:<?= $_SESSION['fenaci']["folio"] ?></strong> <br> 
                    <a href="#" data-reveal-id="cerrar-s">Cerrar Sesi&oacute;n</a>
                </div> 
          <?php else: ?>
                <div class="large-3 medium-3 small-6 columns usuario text-right">
                	<a href="#" data-reveal-id="myModal">Iniciar Sesi&oacute;n</a>
                </div>
          <?php endif ?>
          
          
           
          
          <div class="clear hide-for-medium-only hide-for-small-only"></div>
          <div class="small-6 medium-3 large-2 columns redes">
            <a href="#" class="icon-facebook-squared"></a>
            <a href="#" class="icon-twitter-squared"></a>
          </div>
          <div class="clearfix"></div>
            <nav class="top-bar" data-topbar>
              <ul class="title-area"> 
              <li class="name"></li>
                <li class="toggle-topbar menu-icon">
                  <a href="#"><span>Menú</span></a>
                </li> 
              </ul> 
            <section class="top-bar-section"> 
              <!-- Right Nav Section --> 
                <ul>
                  <!-- <li class="active"><a href="registro.php">REGISTRO</a></li> -->
                  <li><a href="feria.php">LA FERIA</a></li>
                  <li><a href="proceso-fases.php">PROCESO Y FASES</a></li>
                  
                  <li><a href="informes.php">INFORMES</a></li>
                  <li><a href="feria-mundial.php">FERIA MUNDIAL</a></li>
                </ul>
                <ul class="right">
                  <li class="active2"><a href="docs/bases.pdf" target="_blank">BASES</a></li>
                </ul>
              </section>
            </nav>
      </section>
    </header>