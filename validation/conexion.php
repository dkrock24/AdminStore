<?php
include "../global_values.php";

function datos()
{


	if(isset($GLOBALS['user']) and isset($GLOBALS['passwd']) and isset($GLOBALS['host']))
	{

		if($GLOBALS['user']!="" and $GLOBALS['host']!="")
		{
			return conexion($GLOBALS['user'],$GLOBALS['passwd'],$GLOBALS['host']);
		}
	}
}


function login()
{
	return conexion($GLOBALS['user'],$GLOBALS['passwd'],$GLOBALS['host']);
}

function conexion($usuario,$password,$host)
{
	$con = mysqli_connect($host,$usuario,$password,$GLOBALS['db']);
	//$mysqli = new mysqli($host, $usuario, $password, 'db_systema_integrado');
	
	if($con)
	{
		return $con;
	}
	
}

