<?php
	include 'conexion.php';

	$comentario=$_REQUEST['comentario'];
	$like=$_REQUEST['like'];
	$idusuario=$_REQUEST['idusuario'];
	$idlugar=$_REQUEST['idlugar'];
	$idpropietario=$_REQUEST['idpropietario'];

	
	json_encode($respuesta);
	$conexion=mysql_connect($servidor,$usuario,$password) or
	die ("Problemas en la conexion");

	mysql_select_db($baseDatos,$conexion)
	or die("Problemas en la seleccion de la base de datos");

	$resultado=mysql_query("INSERT into comentario (comentario, nlike, usuario_idusuario, lugar_idlugar, lugar_propietario_idpropietario) values('$comentario','$like','$idusuario','$idlugar', '$idpropietario')",$conexion) or
	die( json_encode($respuesta));
	//Si la respuesta es correcta enviamos 1 y sino enviamos 0
	if($resultado)
	$respuesta=array('resultado'=>1);
	echo json_encode($respuesta);
	mysql_close($conexion);
?>
