<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once("validation/conexion.php");
$conexion = login();

if($conexion)
{
	//return select();
}

function lista_bk()
{
	$sql = "select * from ccs_track as track join css_compania site
			on track.idCompania = site.idCompania order by track.estatus ASC";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar referidos");
	return $statement;
}

function selectDetalle($id_partida)
{
	$sql = "select * from ccs_track as track join css_compania site
			on track.idCompania = site.idCompania where track.id_ccs='".$id_partida."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar referidos");
	return $statement;
}
