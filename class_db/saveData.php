
<?php
include_once("../validation/conexion.php");
$conexion = login();
//VARIABLES

if($conexion)
{
	$accion	=	$_POST['accion'];
	accion($accion);
}
function accion($accion){
	if($accion=='cambiarStatus')
	{
		insertUsuario();
	}
}

function cambiarStatus(){
	echo $id = $_POST['id'];
	echo $status = $_POST['status'];
	

		$sql = "update ccs_tra set estatus='$status'
									where id_ccs='$id'							
									
									";
	mysql_query($sql)or die(mysql_error()." Error al hacer Update ccs_track");
}




?>