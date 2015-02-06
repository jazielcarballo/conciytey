<?php
	
	
	function noCache() 
		{
		  header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
		  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		  header("Cache-Control: no-store, no-cache, must-revalidate");
		  header("Cache-Control: post-check=0, pre-check=0", false);
		  header("Pragma: no-cache");
		}
	//---------------------------------------------------------	
	function GetMonthString($n)
		{
			$timestamp = mktime(0, 0, 0, $n, 1, 2005);
			
			return date("M", $timestamp);
		}	
	//---------------------------------------------------------		
	function ValidateInt($inData) 
		{
			  $intRetVal = -1;
			  $IntValue = intval($inData);
			  $StrValue = strval($IntValue);
			  if($StrValue == $inData) {
				$intRetVal = $IntValue;
			  }
			
			  return $intRetVal;
		}
	//---------------------------------------------------------		
	function ValidateString($element) {
		return !preg_match ("/[a-zA-Z0-9_\-]/", $element);
	}
	//---------------------------------------------------------		
	function isValidEmail($email){
		return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
	}
	//---------------------------------------------------------	
	function CodeGenerate($longitud){ 
       $cadena="[^A-Z0-9]"; 
       return substr(eregi_replace($cadena, "", md5(rand())) . 
       eregi_replace($cadena, "", md5(rand())) . 
       eregi_replace($cadena, "", md5(rand())), 
       0, $longitud); 
	} 	
//---------------------------------------------------------		
function age($sDate){
	list($anio,$mes,$dia) = explode("-",$sDate);
	$anio_dif = date("Y") - $anio;
	$mes_dif = date("m") - $mes;
	$dia_dif = date("d") - $dia;
	if ($dia_dif < 0 || $mes_dif < 0)
	$anio_dif--;
	return $anio_dif;
}
//---------------------------------------------------------	
function errorPath($sError)
{
	$sUrl = $_SERVER["SERVER_NAME"];
	$sError = $sError . " -- ".$sUrl;
	$filename = "logs/warnings.log";
	$fh = fopen($filename, "a") or die("Could not open log file.");
	fwrite($fh, date("d-m-Y, H:i")." - $sError\n") or die("Could not write file!");
	fclose($fh);
	
	return("<script language='JavaScript' type='text/javascript'>location.href='http://www.nyonga.com/error.php?return=$sUrl'</script>");
	exit();
}
//---------------------------------------------------------	
function errorProcess($sError)
	{
		$sUrl = $_SERVER["SERVER_NAME"];
		$sError = $sError . " -- ".$sUrl;
		$filename = "../logs/warnings.log";
		$fh = fopen($filename, "a") or die("Could not open log file.");
		fwrite($fh, date("d-m-Y, H:i")." - $sError \n") or die("Could not write file!");
		fclose($fh);
		
		return("<script language='JavaScript' type='text/javascript'>location.href='http://www.nyonga.com/error.php?return=$sUrl'</script>");
		exit();
	}
//---------------------------------------------------------	
function ConvertDate($sTime)
	{
		$timestamp = $time;
		$date_time_array = getdate($timestamp);
		$hours = $date_time_array['hours'];
		$minutes = $date_time_array['minutes'];
		$seconds = $date_time_array['seconds'];
		$month = $date_time_array['mon'];
		$day = $date_time_array['mday'];
		$year = $date_time_array['year'];
		$timestamp = mktime($hours + 0,$minutes,$seconds,$month,$day,$year);
		$theDate = strftime('%Y-%m-%d %H:%M:%S',$timestamp);	
		return $theDate; 
	}
	
function thumb($sImage,$iScale,$sRootImages,$sRootImagesThumbs)
	{
		
		//$sImage = strtolower($sImage);
		
		if(strrpos($sImage,".jpg")){$sRoot = imagecreatefromjpeg($sRootImages.$sImage);};
		if(strrpos($sImage,".jpeg")){$sRoot = imagecreatefromjpeg($sRootImages.$sImage);};
		if(strrpos($sImage,".png")){$sRoot = imagecreatefrompng($sRootImages.$sImage);};
		if(strrpos($sImage,".gif")){$sRoot = imagecreatefromgif($sRootImages.$sImage);};
		if(strrpos($sImage,".bmp")){$sRoot = imagecreatefromwbmp($sRootImages.$sImage);};

		$iWidthReal = imagesx($sRoot);
		$iHeightReal = imagesy($sRoot);
		$iWidthNew = $iScale;
		$iHeightNew = ($iHeightReal * $iScale) / $iWidthReal;
		$oThumb = imagecreatetruecolor($iWidthNew,$iHeightNew);
		imagecopyresampled($oThumb,$sRoot,0,0,0,0,$iWidthNew,$iHeightNew,$iWidthReal,$iHeightReal);
		
		if(strrpos($sImage,".jpg")){imagejpeg($oThumb,$sRootImagesThumbs.$iScale."thumb_$sImage",90);};
		if(strrpos($sImage,".jpeg")){imagejpeg($oThumb,$sRootImagesThumbs.$iScale."thumb_$sImage",90);};
		if(strrpos($sImage,".png")){imagepng($oThumb,$sRootImagesThumbs.$iScale."thumb_$sImage",9);};
		if(strrpos($sImage,".gif")){imagegif($oThumb,$sRootImagesThumbs.$iScale."thumb_$sImage",90);};
		if(strrpos($sImage,".bmp")){imagewbmp($oThumb,$sRootImagesThumbs.$iScale."thumb_$sImage",90);};
		
	}
	
	function thumbHeight($sImage,$iScale,$sRootImages,$sRootImagesThumbs)
	{
		
		//$sImage = strtolower($sImage);
		
		if(strrpos($sImage,".jpg")){$sRoot = imagecreatefromjpeg($sRootImages.$sImage);};
		if(strrpos($sImage,".jpeg")){$sRoot = imagecreatefromjpeg($sRootImages.$sImage);};
		if(strrpos($sImage,".png")){$sRoot = imagecreatefrompng($sRootImages.$sImage);};
		if(strrpos($sImage,".gif")){$sRoot = imagecreatefromgif($sRootImages.$sImage);};
		if(strrpos($sImage,".bmp")){$sRoot = imagecreatefromwbmp($sRootImages.$sImage);};

		$iWidthReal = imagesx($sRoot);
		$iHeightReal = imagesy($sRoot);		
		$iHeightNew = $iScale;
		$iWidthNew = ($iWidthReal * $iScale) / $iHeightReal;				
		$oThumb = imagecreatetruecolor($iWidthNew,$iHeightNew);
		imagecopyresampled($oThumb,$sRoot,0,0,0,0,$iWidthNew,$iHeightNew,$iWidthReal,$iHeightReal);
		
		if(strrpos($sImage,".jpg")){imagejpeg($oThumb,$sRootImagesThumbs.$iScale."thumb_$sImage",90);};
		if(strrpos($sImage,".jpeg")){imagejpeg($oThumb,$sRootImagesThumbs.$iScale."thumb_$sImage",90);};
		if(strrpos($sImage,".png")){imagepng($oThumb,$sRootImagesThumbs.$iScale."thumb_$sImage",9);};
		if(strrpos($sImage,".gif")){imagegif($oThumb,$sRootImagesThumbs.$iScale."thumb_$sImage",90);};
		if(strrpos($sImage,".bmp")){imagewbmp($oThumb,$sRootImagesThumbs.$iScale."thumb_$sImage",90);};
		
	}	

	function is_email($email)
	{       
       $email=trim($email); 
       $email=strtolower($email); 
       $email=addslashes($email); 
	   
	   $error_email = true; 
	   
       if(!$email)
	   { 
			$error_email= false; 
       }else{ 
			if(!preg_match("/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/", $email))
			{ 
				$error_email= false; 
			} 
		} 
		return $error_email; 		
	}
	
	function redirect($url)
	{
		echo '<script language="javascript">window.location="'.$url.'"</script>';
		exit();
	}
?>
