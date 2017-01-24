<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once("../validation/conexion.php");
$conexion = login();

if($conexion)
{
	//return select();
}

function cargo_usuario($id_cargo)
{
	$sql = "select C.nombre_cargo from sr_usuarios as U
		left join sr_cargos as C
		on U.id_cargo = C.id_cargo
		where C.id_cargo  = '".$id_cargo."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al Cargo");
	$row = mysql_fetch_array($statement);
	return $row;
}
function selectTiposPartidas(){
	$sql = "select * from sr_generar_partidas";
	$statement = mysql_query($sql)or die(mysql_error(). " sr_generar_partidas");
	return $statement;
}

function rol_usuario2($id_usuario)
{
	$sql = "select U.id_cargo from sr_usuarios as U		
		where U.id_usuario = '".$id_usuario."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar los Roles");
	$row = mysql_fetch_array($statement);
	return $row;
}



function select()
{
	$sql = "select * from sr_partidas_generales as A 
			left join sr_generar_partidas as B
			on A.id_tipo=B.id_generar";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las partidas de generales");
	return $statement;
}

function selectDetalle($id_partida)
{
	$sql = "select * from sr_partidas_generales as A 
			left join sr_generar_partidas as B
			on A.id_tipo=B.id_generar where A.id_partida='".$id_partida."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar la partida de divorcio por ID");
	$row = mysql_fetch_array($statement);
	return $row;
}
function selectMarginacion($id_partida)
{
	$sql = "select * from sr_marginaciones_generales as M join sr_usuarios as U
			on M.id_usuario = U.id_usuario
			where id_partida='".$id_partida."'";
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

function template_pdefuncion($id)
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
?>