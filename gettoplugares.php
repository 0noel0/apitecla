<?php
	include 'conexion.php';

	$dinero=$_REQUEST['dinero'];
	$personas=$_REQUEST['personas'];
	$idtipotrip=$_REQUEST['idtipotrip'];
	//$limite=$_REQUEST['limite'];

	$respuesta=array('resultado'=>2);
	json_encode($respuesta);

	$conexion=mysql_connect($servidor,$usuario,$password) or
	die ("Problemas en la conexion antes de seleecionar la base ");
	
	mysql_select_db($baseDatos,$conexion)
	or die("Problemas en la seleccion de la base de datos Antes de la consulta");

	$registros=mysql_query("SELECT lugar.idlugar, lugar.nombrelugar, lugar.descripcionlugar, lugar.X_lugar, lugar.Y_lugar, lugar.UrlImagenlugar, lugar.likeslugar
		FROM lugar, lugar_has_tipoTrip WHERE lugar.idlugar = lugar_has_tipoTrip.lugar_idlugar AND lugar_has_tipoTrip.tipoTrip_idtipoTrip =  $idtipotrip  order by lugar.likeslugar desc LIMIT 0,10", $conexion) or
	die(json_encode($respuesta));

	$filas=array();
	while ($reg=mysql_fetch_assoc($registros))
	{
	$filas[]=array_map('utf8_encode', $reg);
	}

	
	echo json_encode($filas);
	//echo json_encode($filas2);

	//echo json_encode($answ);

	mysql_close($conexion);
?>
