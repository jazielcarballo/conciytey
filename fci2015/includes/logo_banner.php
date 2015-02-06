<?php
	
	$sql ="SELECT * FROM logo_banner WHERE tipo = 1";
	$query = mysql_query($sql);
	$result = mysql_fetch_array($query);
	$logo = $result['imagen'];
	
	
	$sql ="SELECT * FROM logo_banner WHERE tipo = 2";
	$query = mysql_query($sql);
	$result = mysql_fetch_array($query);
	$banner = $result['imagen'];
	
	
	$sql ="SELECT * FROM logo_banner WHERE tipo = 3";
	$query = mysql_query($sql);
	$result = mysql_fetch_array($query);
	$banner_index = $result['imagen'];
	
	$sql ="SELECT * FROM logo_banner WHERE tipo = 4";
	$query = mysql_query($sql);
	$result = mysql_fetch_array($query);
	$logo_consejo = $result['imagen'];
?>