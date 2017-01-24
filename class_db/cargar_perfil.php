<?php
include_once("validation/conexion.php");
$conexion = login();

function id()
{
	if(isset($_SESSION['data'][0]))
	{
		return perfilAction($_SESSION['data'][0]);
	}
}

function perfilAction($id)
{
	$sql = "select * from sr_usuarios as U 
			left join sr_cargos as C on U.cargo=C.id_cargo
			where U.id_usuario='".$id."'";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar el perfil");

	$row = mysql_fetch_array($statement);

	return $row;
}
?>