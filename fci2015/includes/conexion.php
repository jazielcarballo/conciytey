<?php
	//----------------------|Connection database|----------------------
	
	//$oConnection = mysql_connect("localhost", "root", "azsxdcQWERTY.12");
	//mysql_select_db("fenaci", $oConnection);
	
	$oConnection = mysql_connect("localhost", "root", "nosemipas");
	mysql_select_db("fci2015", $oConnection);
	
	mysql_query("SET NAMES 'utf8'");
	
	//Variable que se usa para darle un nombre especifico al carrito
	//$nombre_carrito = 'carrito_zizoo';
?>