<?php
	include 'conexion.php';

	$dinero=$_REQUEST['dinero'];
	$personas=$_REQUEST['personas'];
	$idtipotrip=$_REQUEST['idtipotrip'];
	$limite=$_REQUEST['limite'];

	$respuesta=array('resultado'=>2);
	json_encode($respuesta);

	$conexion=mysql_connect($servidor,$usuario,$password) or
	die ("Problemas en la conexion antes de seleecionar la base ");
	
	mysql_select_db($baseDatos,$conexion)
	or die("Problemas en la seleccion de la base de datos Antes de la consulta");

	$registros=mysql_query("SELECT lugar.idlugar, lugar.nombrelugar, lugar.descripcionlugar, lugar.X_lugar, lugar.Y_lugar, lugar.UrlImagenlugar, lugar.likeslugar, lugar.propietario_idpropietario
		FROM lugar, lugar_has_tipoTrip WHERE lugar.idlugar = lugar_has_tipoTrip.lugar_idlugar AND lugar_has_tipoTrip.tipoTrip_idtipoTrip =  $idtipotrip
		AND lugar_has_tipoTrip.rangoPrecios <=  $dinero/$personas order by rand() LIMIT 0,1", $conexion) or
	die(json_encode($respuesta));

	$filas=array();
	while ($reg=mysql_fetch_assoc($registros))
	{
	$filas[]=array_map('utf8_encode', $reg);
	}
	
	$registros2=mysql_query("SELECT comentario.idcomentario, comentario.comentario, usuario.Nombreusuario, usuario.Apellidousuario, comentario.fecha from comentario, lugar_has_tipoTrip, lugar, usuario where lugar.idlugar = lugar_has_tipoTrip.lugar_idlugar and comentario.lugar_idlugar = lugar_has_tipoTrip.lugar_idlugar and lugar_has_tipoTrip.tipoTrip_idtipoTrip=$idtipotrip and comentario.usuario_idusuario = usuario.idusuario order by comentario.idcomentario desc LIMIT $limite,5", $conexion) or
	die(json_encode($respuesta));

	$filas2=array();
	while ($reg2=mysql_fetch_assoc($registros2))
	{
	$filas2[]=array_map('utf8_encode', $reg2);
	}

	$answ=array("lugar"=>$filas, "comentarios"=>$filas2);
	
	//echo json_encode($filas);
	//echo json_encode($filas2);

	echo json_encode($answ);

	mysql_close($conexion);
?>
