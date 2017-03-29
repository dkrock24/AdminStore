<?php

function datos()
{

$usuario = "root";
$password = "lapizzeria2016!";
$host = "localhost";


	if(isset($usuario) and isset($password) and isset($host))
	{

		if($usuario!="" and $host!="")
		{
			return conexion($usuario,$password,$host);
		}
	}
}

function login()
{
	$usuario = "root";
	$password = "lapizzeria2016!";
	$host = "localhost";
	return conexion($usuario,$password,$host);
}

function conexion($usuario,$password,$host)
{
	$con = mysqli_connect($host,$usuario,$password,'db_global_lapizzeria');
	//$mysqli = new mysqli($host, $usuario, $password, 'db_systema_integrado');
	
	if($con)
	{
		return $con;
	}
	
}


