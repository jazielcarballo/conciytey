<?php 
	include("../../includes/configuracion.php");
	include("../../includes/conexion.php");
	
	//echo $_FILES["file_bases"]["type"];
	//exit();
	

	$tamano = @$_FILES["file_bases"][ 'size' ];
	
	
	if(strlen($tamano)>0){
		
		$tamaño_max="50000000000";
		if( $tamano < $tamaño_max){  
			
			$sep=explode('application/',$_FILES["file_bases"]["type"]);
			
			if(count($sep) == 0){
				redirect("../bases.php?mensaje=2&io");
			}
			
			$tipo=$sep[1];
			
			if($tipo == "pdf"){ 
				
				if(file_exists('../../docs/bases.pdf')){
					copy('../../docs/bases.pdf','../../docs/bases_bck'.date('YmdGis').'.pdf');
					unlink('../../docs/bases.pdf');
				}
				
				move_uploaded_file ( $_FILES["file_bases"][ 'tmp_name' ], '../../docs/bases.pdf');
										
			} else{
				
				redirect("../bases.php?mensaje=2");	
			}
		
		}else{
			
			redirect("../bases.php?mensaje=3");
			
		}
		 
	}
	
	redirect("../bases.php?mensaje=1");
		
	die;
?>