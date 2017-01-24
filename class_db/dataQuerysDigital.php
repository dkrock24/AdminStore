<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once("../validation/conexion.php");
$conexion = login();

if($conexion)
{
	//return select();
}

//------------------Codigo agragado por ruben para propias consultas
function template_pnacimiento($id)
{
	header('Content-Type: text/html; charset=UTF-8'); 
	$sql	=	"select * from sr_pnacimiento_template where id_tipo='".$id."' ";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar el template de la partida");
	$data = array();
	$contador =0;
	while($row	=	mysql_fetch_array($statement))
	{
		$data['template'][$contador] = $row['item1'];
		$contador++;
	}	
	return $data;
}

function logo($pages)
{
	$sql	=	"select * from sr_logos where pages_logo='".$pages."' and estado_logo=1";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar el Logo");
	//$row	=	mysql_fetch_array($statement);
	$data = array();
	$contador =0;
	while ( $row	=	mysql_fetch_array($statement)) {
		$data['logo'][$contador] = $row['url_logo'];
		$contador++;
	}
	return $data;
}

function empresa()
{
	$sql	=	"select * from sr_empresa";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar el Logo");
	$row	=	mysql_fetch_array($statement);
	return $row;
}
function select()
{
	$sql = "select * from sr_pnacimiento";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las partidas de nacimiento");
	return $statement;
}

function selectAD()
{
	$sql = "Select tpd.id_tipo, tpd.nombre  from sr_tipo_partida_digital tpd where tpd.estado = 1";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las partidas de nacimiento");
	return $statement;
}

function selectDG()
{
	$sql = "select ad.id_partida as id, ad.nombre_partida as nombre, tpd.nombre as tipo,
		 ad.axo_partida as axo, ad.texto_partida as texto, ad.fecha_creacion as creado 
		 	from sr_partidas_digitales ad
			inner join sr_tipo_partida_digital tpd on tpd.id_tipo = ad.tipo_partida
			order by ad.id_partida asc";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las partidas de nacimiento");
	return $statement;
}

function selectDetalleDG($id_partida)
{
	$sql = "select * from sr_partidas_digitales dp where dp.id_partida='".$id_partida."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar la partida de nacimiento por ID");
	$row = mysql_fetch_array($statement);
	return $row;
}
function selectMarginacion($id_tipo,$id_partida)
{
	$sql = "select * from sr_marginaciones as M join sr_usuarios as U
			on M.id_usuario = U.id_usuario
			where id_tipo_partida=$id_tipo and id_partida='".$id_partida."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las marginaciones");
	$data = array();
	$num =0;
	//$row = mysql_fetch_array($statement);
	/*
	while($row = mysql_fetch_array($statement))
	{
		$data[$num] = $row['texto_marginacion'];
		$num++;
	}*/
	return $statement;
}
function selectActa($id_partida)
{
	$sql = "Select * from sr_partidas_digitales pd where pd.id_partida=".$id_partida;
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las partidas de nacimiento");
	return $statement;
}

function selectCDG()
{
	$sql = "Select * from sr_tipo_partida_digital";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las partidas de nacimiento");
	return $statement;
}
function selectAllarginacionDG($idActa)
{
	$sql = "Select * from sr_marginacion_actas_digitales mdg where mdg.id_acta_digital =".$idActa;
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las partidas de nacimiento");
	return $statement;
}

function selecCargo($idcargo)
{
	$sql = "Select c.nombre_cargo as name from sr_usuarios u
		inner join sr_cargos c on u.id_cargo = c.id_cargo and u.id_usuario  = ".$idcargo;
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las partidas de nacimiento");
	$row = mysql_fetch_array($statement);
	return $row;
}



?>