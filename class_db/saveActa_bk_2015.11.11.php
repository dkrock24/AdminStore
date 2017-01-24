<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
include_once("../validation/conexion.php");
$conexion = login();

$accion	=	$_POST['accion'];

switch ($accion) {
	case 'insert_texto_actaM':
		InsertTextoActaM();
		break;
	case 'update_texto_acta':
		UpdateTextoActa();
		break;
	case 'eliminarPartida':
		eliminarPartida();
		break;
	case 'eliminarPartidaDivorcio':
		eliminarPartidaDivorcio();
		break;
	case 'eliminarPartidaDefuncion':
		eliminarPartidaDefuncion();
		break;
	case 'eliminarPartidaMatrimonio':
		eliminarPartidaMatrimonio();
		break;
	case 'eliminarPartidaGeneral':
		eliminarPartidaGeneral();
		break;

		
}

function eliminarPartidaGeneral(){
	$id = $_POST['id'];

	$id_tipo = "select id_tipo from sr_partidas_generales where id_partida = '".$id."'";
	$statement = mysql_query($id_tipo)or die(mysql_error());
	$id_tipo_partida = mysql_fetch_array($statement);

	$sql1 = "delete from sr_marginaciones_generales where id_tipo_partida = '".$id_tipo_partida['id_tipo']."' and id_partida='".$id."'";
	$sql2 = "delete from sr_partidas_generales where id_partida = '".$id."'";

	mysql_query($sql1)or die(mysql_error()." Error Al Eliminar La marginacion");
	mysql_query($sql2)or die(mysql_error()." Error Al Eliminar La Partida");
	
}


function eliminarPartidaMatrimonio(){
	$id = $_POST['id'];

	$sql1 = "delete from sr_marginaciones where id_tipo_partida = '2' and id_partida='".$id."'";
	$sql2 = "delete from sr_pmatrimonio where id_pmatrimonio = '".$id."'";

	mysql_query($sql1)or die(mysql_error()." Error Al Eliminar La marginacion");
	mysql_query($sql2)or die(mysql_error()." Error Al Eliminar La Partida");
	
}


function eliminarPartidaDefuncion(){
	$id = $_POST['id'];

	$id_tipo = "select id_tipo_partida from sr_pdefuncion where id_partida = '".$id."'";
	$statement = mysql_query($id_tipo)or die(mysql_error());
	$id_tipo_partida = mysql_fetch_array($statement);

	$sql1 = "delete from sr_marginaciones where id_tipo_partida = '".$id_tipo_partida['id_tipo_partida']."' and id_partida='".$id."'";
	$sql2 = "delete from sr_pdefuncion where id_partida = '".$id."'";

	mysql_query($sql1)or die(mysql_error()." Error Al Eliminar La marginacion");
	mysql_query($sql2)or die(mysql_error()." Error Al Eliminar La Partida");
	
}

function eliminarPartidaDivorcio(){
	$id = $_POST['id'];

	$id_tipo = "select id_tipo_partida from sr_pdivorcio where id_partida = '".$id."'";
	$statement = mysql_query($id_tipo)or die(mysql_error());
	$id_tipo_partida = mysql_fetch_array($statement);

	$sql1 = "delete from sr_marginaciones where id_tipo_partida = '".$id_tipo_partida['id_tipo_partida']."' and id_partida='".$id."'";
	$sql2 = "delete from sr_pdivorcio where id_partida = '".$id."'";

	mysql_query($sql1)or die(mysql_error()." Error Al Eliminar La marginacion");
	mysql_query($sql2)or die(mysql_error()." Error Al Eliminar La Partida");
	
}

function eliminarPartida(){
	$id = $_POST['id'];

	$id_tipo = "select id_tipo_partida from sr_pnacimiento where id_pnacimiento = '".$id."'";
	$statement = mysql_query($id_tipo)or die(mysql_error());
	$id_tipo_partida = mysql_fetch_array($statement);

	$sql1 = "delete from sr_marginaciones where id_tipo_partida = '".$id_tipo_partida['id_tipo_partida']."' and id_partida='".$id."'";
	$sql2 = "delete from sr_pnacimiento where id_pnacimiento = '".$id."'";

	mysql_query($sql1)or die(mysql_error()." Error Al Eliminar La marginacion");
	mysql_query($sql2)or die(mysql_error()." Error Al Eliminar La Partida");
	
}

function InsertTextoActaM(){

	echo $texto 		=	$_POST['texto_actaM'];
	echo $alcalde 		=	$_POST['alcalde'];
	echo $secretario 	=	$_POST['secretario'];
	echo $id_usuario 	=	$_POST['id_usuario'];
	echo $hombre 		=	$_POST['hombre'];
	echo $mujer 		=	$_POST['mujer'];
	echo $id_tipo_acta 	= 	$_POST['id_tipo_acta'];
	echo $anioLibro 	= 	$_POST['anioLibro'];
	echo $tipoActa 		= 	$_POST['tipoActa'];
	echo $numeroFL 		= 	$_POST['numeroFL'];

	
	$fecha 				=	Date("Y-m-d");
	$id=0;


	$sql = "insert into sr_actas (id_acta,id_tipo_acta,usuario_id,nombre1,nombre2,alcalde,secretario,fecha_creado,anio,tipo,numero_tipo,acta_texto)
	values('$id','$id_tipo_acta','$id_usuario','$hombre','$mujer','$alcalde','$secretario','$fecha','$anioLibro','$tipoActa','$numeroFL','$texto');";

	mysql_query($sql)or die(mysql_error()." Error Al Insertar Acta de Matrimonio");
}

function UpdateTextoActa(){

	echo $texto 		=	$_POST['texto_actaM'];
	echo $alcalde 		=	$_POST['alcalde'];
	echo $secretario 	=	$_POST['secretario'];
	echo $id_usuario 	=	$_POST['id_usuario'];
	echo $nombre 		=	$_POST['hombre'];
	echo $mujer 		=	$_POST['mujer'];
	echo $idActa 		=	$_POST['idActa'];
	echo $tipoActa 		= $_POST['tipoActa'];

	$sql = "update sr_actas set id_tipo_acta='$tipoActa', nombre1='$nombre', nombre2='$mujer', alcalde='$alcalde', 
			secretario='$secretario',acta_texto='$texto' where id_acta='$idActa'";
	mysql_query($sql)or die(mysql_error()." Error Al Actualziar el Acta");

	$sql2 = "insert into sr_user_update_acta (id_update,id_tipo_acta,id_acta,id_usuario)
			values(1,'$tipoActa','$idActa','$id_usuario')";
	mysql_query($sql2)or die(mysql_error()." Error Al Insertar el Log de la Actualizacion del Acta");

}



?>