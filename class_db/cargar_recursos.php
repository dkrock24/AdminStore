<?php

include_once("validation/conexion.php");

function laodLib($location,$parte)
{
	$lib = array();
	$conexion = login();

	if($conexion)
	{

		$sql = "select * from sr_librerias where location='".$location."' and parte='".$parte."' and estado_lib=1";
		$statement = mysql_query($sql)or die(mysql_error(). " Error al cargar librerias del INDEX.PHP");
		$num = 0;
		while($row = mysql_fetch_array($statement))
		{
			$lib[$num] = $row['url_libreria'];
			$num++;			
		}
	}
	else
	{
		echo "nada";

	}
	return $lib;

}

function loadConfig($location)
{
	$conexion = login();
	if($conexion)
	{

	$config = array();
	$sql = "select * from sr_config where pages_config='".$location."' and estado_config=1";
	$statement = mysql_query($sql)or die(mysql_error(). "Error al Cargar la configuracion");
	$num = 0;
		while($row = mysql_fetch_array($statement))
		{
			$config[$num] = $row['accion'];
			$num++;
		}
	}
	return $config;
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

function usuario()
{
	$user =  gethostbyaddr($_SERVER['REMOTE_ADDR'])  ;
	$pass =  sha1($user);

	$sql = "select * from sr_infoo where info = '$pass'";
	$statement = mysql_query($sql)or die(mysql_error(). "Error Login");
	while($row = mysql_fetch_array($statement))
	{
		$result = $row['info'];	
	}
	if($result)
	{
		if($result==$pass)
		{
			return $result;
		}
		else
		{
			header("location:404.html");
		}		
	}else
	{
		header("location:404.html");
	}
}

?>