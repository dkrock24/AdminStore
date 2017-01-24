<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once("../validation/conexion.php");
$conexion = login();

if($conexion)
{
	//return select();
}
function rol_usuario($id_rol)
{
	$sql = "select * from sr_usuarios as U
		left join sr_roles as R
		on U.rol = R.id_rol
		where R.id_rol = '".$id_rol."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar los Roles");
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
	$sql = "select * from sr_actas as Actas 
			left join sr_tipo_actas as T_Actas
			on Actas.id_tipo_acta= T_Actas.id_tipo_acta";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las actas de matrimonio");
	return $statement;
}

function selectDetalle($id_partida)
{
	$sql = "select * from sr_actas as Actas 
			left join sr_tipo_actas as T_Actas
			on Actas.id_tipo_acta= T_Actas.id_tipo_acta where id_acta='".$id_partida."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar la acta de matrimonio");
	$row = mysql_fetch_array($statement);
	return $row;
}
function selectTipoActa()
{
	$sql = "select * from sr_tipo_actas";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar los tipos de partidas y actas");
	//$row = mysql_fetch_array($statement);
	return $statement;
}
function buscarTipoActa($id)
{
	$sql = "select * from sr_tipo_actas where id_tipo_acta = '$id'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar los tipos de partidas y actas");
	//$row = mysql_fetch_array($statement);
	return $statement;
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

function template_pnacimiento($id)
{
	header('Content-Type: text/html; charset=UTF-8'); 
	$sql	=	"select * from sr_pnacimiento_template where id_tipo='".$id."' order by id_pnacimiento ";
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

function selectDetalleActa($id_acta)
{
	$sql = "select * from sr_actas where id_acta='".$id_acta."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar acta generica");
	$row = mysql_fetch_array($statement);
	return $row;
}

function selectMarginacionActa($id_acta)
{
	$sql = "select * from sr_marginaciones_actas as M join sr_usuarios as U
			on M.id_usuario = U.id_usuario
			where M.id_acta='".$id_acta."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar las marginaciones en las actas");
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