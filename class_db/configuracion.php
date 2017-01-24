<?php
// Configuracion de los slider del login y del bloqueo de la session

//include_once("../validation/conexion.php");
$con = null;
function login()
{
	$usuario = "root";
	$password = "lapizzeria2016!";
	$host = "localhost";
	return conexion($usuario,$password,$host);
}
function conexion($usuario,$password,$host)
{
	$bd="db_global_lapizzeria";
	$con = mysqli_connect($host,$usuario,$password,$bd);
	$_flat = false;

	if($con)
	{
		$_flat = true;
	}
	
	return $con;	
}


if(isset($_POST['val1']) && isset($_POST['val2']))
{
	echo $id = $_POST['val1'];
	echo "<br>";
	echo $valor = $_POST['val2'];
	insertLogin($id,$valor);
}
function insertLogin($id,$valor){
	$conexion = login();
	$sql = "update sr_config set estado_config='".$valor."' where id_config='".$id."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Error al cargar la configuracion 1");
	if(mysql_affected_rows() == 1){
		  $valor = 1; 
	} 
	else
	{
		  $valor = 0;
	}
}

function config()
{
	
	$data = array();
	$conexion = login();

	if(login()!="")
	{
		$sql = "select * from sr_config";
		$statement = mysqli_query($conexion,$sql)or die(mysql_error(). " Error al cargar la configuracion");
		$num = 0;
		while ($row = mysqli_fetch_array($statement)) {
			$data['id'][$num]		= $row['id_config'];
			$data['pagina'][$num]  = $row['pages_config'];
			$data['accion'][$num]  = $row['estado_config'];

			//	echo "<br>";
			$num++;
		}

	}
	return $data;
}

function empresa()
{
	$conexion = login();

	$sql = "select * from sr_empresa";
	$statement = mysql_query($sql)or die(mysql_error(). " Error al cargar la info de la empresa");
	$row = mysql_fetch_array($statement);
	return $row;
}
function other()
{
	$user =  gethostbyaddr($_SERVER['REMOTE_ADDR']) ;

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