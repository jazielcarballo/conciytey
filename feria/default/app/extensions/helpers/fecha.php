<?php

class Fecha {
    
    
      public static function dateMD($date) {
          
          $dia=date("d",strtotime($date));
           switch (date("m", strtotime($date))) {
                                                    case 1: $mesNombre = "Enero";
                                                        break;
                                                    case 2: $mesNombre = "Febrero";
                                                        break;
                                                    case 3: $mesNombre = "Marzo";
                                                        break;
                                                    case 4: $mesNombre = "Abril";
                                                        break;
                                                    case 5: $mesNombre = "Mayo";
                                                        break;
                                                    case 6: $mesNombre = "Junio";
                                                        break;
                                                    case 7: $mesNombre = "Julio";
                                                        break;
                                                    case 8: $mesNombre = "Agosto";
                                                        break;
                                                    case 9: $mesNombre = "Septiembre";
                                                        break;
                                                    case 10: $mesNombre = "Octubre";
                                                        break;
                                                    case 11: $mesNombre = "Noviembre";
                                                        break;
                                                    case 12: $mesNombre = "Diciembre";
                                                        break;
                                                }
          
          
        
            return $dia." ".$mesNombre;
        
    }
    
    
        public static function dateDM($date) {
			$meses = array("", "Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		    list($fecha) = explode(" ", $date, 1);
			if(intval($fecha) == 0){ return ""; } 
			list($anio, $mes, $dia) = explode("-", $fecha);
			//$ff = $dia." de ".Meses((int) $mes)." del ".$anio;
			$ff = $dia."/".$meses[intval($mes)]; //."/".$anio;
			return $ff;
    }
     public static function dateDMA($date) {
          
          $dia=date("d",strtotime($date));
          $ano=date("Y",strtotime($date));
          
           switch (date("m", strtotime($date))) {
                                                    case 1: $mesNombre = "Enero";
                                                        break;
                                                    case 2: $mesNombre = "Febrero";
                                                        break;
                                                    case 3: $mesNombre = "Marzo";
                                                        break;
                                                    case 4: $mesNombre = "Abril";
                                                        break;
                                                    case 5: $mesNombre = "Mayo";
                                                        break;
                                                    case 6: $mesNombre = "Junio";
                                                        break;
                                                    case 7: $mesNombre = "Julio";
                                                        break;
                                                    case 8: $mesNombre = "Agosto";
                                                        break;
                                                    case 9: $mesNombre = "Septiembre";
                                                        break;
                                                    case 10: $mesNombre = "Octubre";
                                                        break;
                                                    case 11: $mesNombre = "Noviembre";
                                                        break;
                                                    case 12: $mesNombre = "Diciembre";
                                                        break;
                                                }
          
          
        
            return $dia." de ".$mesNombre." de ".$ano;
        
    }
    
    
     public static function dateHMA($date) {
         
         $hora=date("H:i a",strtotime($date));
         
          return $hora;
     }
     
      public static function dateHMPM($date) {
         
         $hora=date("h:i a",strtotime($date));
         
          return $hora;
     }
    
}
?>
