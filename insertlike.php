<?php
	include 'conexion.php';

//	$idusuario=$_REQUEST['idusuario'];
	$idlugar=$_REQUEST['idlugar'];
//	$idpropietario=$_REQUEST['idpropietario'];

	
	json_encode($respuesta);
	$conexion=mysql_connect($servidor,$usuario,$password) or
	die ("Problemas en la conexion");

	mysql_select_db($baseDatos,$conexion)
	or die("Problemas en la seleccion de la base de datos");

	$resultado=mysql_query("UPDATE  lugar SET likeslugar=likeslugar+1 where idlugar=$idlugar",$conexion) or
	die( json_encode($respuesta));
	//Si la respuesta es correcta enviamos 1 y sino enviamos 0
	//if($resultado){

		$resultado2=mysql_query("SELECT  idlugar, likeslugar from lugar where idlugar=$idlugar",$conexion) or
		die( json_encode($respuesta));
		$filas=array();
		while ($reg=mysql_fetch_assoc($resultado2))
		{
		$filas[]=array_map('utf8_encode', $reg);
		}

		echo json_encode($filas);


	//}
	//$respuesta=array('resultado'=>1);
	//echo json_encode($respuesta);
	mysql_close($conexion);
?>
