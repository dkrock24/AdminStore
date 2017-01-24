<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once("validation/conexion.php");
$conexion = login();

if($conexion)
{
	//return select();
}


function selectCargos()
{
	$sql = "select * from sr_cargos";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar los cargos");
	return $statement;
}

function selectRoles()
{
	$sql = "select * from sr_roles";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar los roles");
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
function usuarios()
{
	$sql	=	"select * from sr_usuarios as U
					left join sr_roles as R
					on U.rol=R.id_rol
					left join sr_cargos as C
					on U.id_cargo=C.id_cargo order by R.id_rol";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar los usuarios");
	return $statement;
	//$row	=	mysql_fetch_array($statement);
	//return $row;
}
function usuariosDetalle($id)
{
	$sql	=	"select * from sr_usuarios as U
					left join sr_roles as R
					on U.rol=R.id_rol
					left join sr_cargos as C
					on U.id_cargo=C.id_cargo where U.id_usuario=$id ";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar los usuarios");
	return $row = mysql_fetch_array($statement);
	//$row	=	mysql_fetch_array($statement);
	//return $row;
}

function cargos()
{
	$sql	=	"select * from sr_cargos";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar los cargos");
	return $statement;// = mysql_fetch_array($statement);	
}

function roles()
{
	$sql	=	"select * from sr_roles";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar los roles");
	return $statement;// = mysql_fetch_array($statement);	
}
function avatar()
{
	$sql	=	"select * from sr_avatar where usuario_avatar = 'sistema' ";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar los avatar");
	return $statement;// = mysql_fetch_array($statement);
}
function avatar_genero($genero)
{
	$sql	=	"select * from sr_avatar where genero_avatar = '".$genero."' and usuario_avatar='sistema' and estado_avatar=1";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar los avatar");
	return $statement;// = mysql_fetch_array($statement);
}

function avatatar_personal($id_usuario)
{
	$sql	=	"select * from sr_avatar where usuario_id = '".$id_usuario."' and estado_avatar=1";
	$statement = mysql_query($sql)or die(mysql_error(). "Erro al cargar los avatar");
	return $statement;// = mysql_fetch_array($statement);
}
?>