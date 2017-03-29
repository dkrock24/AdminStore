<?php
session_start();
include_once("conexion.php");
unset($_SESSION['usuario']);  

if((isset($_POST['usuario'])) and (isset($_POST['password']))){
	
	autentificar();
}
else{	
	salir();
}

function autentificar()
{
	if($_POST['usuario']!="" and $_POST['password']!="")
	{
		echo $usuario = $_POST['usuario'];
		echo $password = $_POST['password'];


		$valor = datos();

		if($valor){
			
			validar($usuario,$password);			
		}
		else{
			
			salir();
		}		
	}	
	else
	{
		salir();
	}
}

function validar($usuario,$password)
{
	$flat = false;
	$pass_encrypted = sha1($password);
	
	 //$demo = (string) $password;
	// INFORMACION DEL USUARIO
	$query = 'select * from sr_usuarios where usuario="'.$usuario.'" and password="'.$pass_encrypted.'"';
	$statement = mysql_query($query)or die(mysql_error()." Error de Autentificacion");
	$row = mysql_fetch_array($statement);

	if($row)
	{
		$flat = true;
		$data = array();
		$data[0] = $row['id_usuario'];
		$data[1] = $row['usuario'];
		$data[2] = $row['password'];
		$data[3] = $row['nickname'];
		$data[4] = $row['fecha_nacimiento'];
		$data[5] = $row['primer_nombre'];
		$data[6] = $row['segundo_nombre'];
		$data[7] = $row['primer_apellido'];
		$data[8] = $row['segundo_apellido'];
		$data[9] = $row['genero'];
		$data[10] = $row['avatar'];
		$data[11] = $row['rol'];
		$data[12] = $row['id_estado'];
		
		$_SESSION['data'] = $data;

		$info_empresa = empresa();
		$_SESSION['data_empresa'] = $info_empresa;



		insertLog($data[0]);

		header('Location: '.'../dashboard.php');
		
	}else{
		
		salir();
		$flat = false;
	}
	return $flat;
}

function insertLog($id){
	$fecha 				=	Date("Y-m-d H:m:s");
	$a;
	$sql = "insert into sr_log_acceso(id_log,id_usuario,fecha)
			values('$a','$id','$fecha')";
			mysql_query($sql);
}

function cargarMenu($id_rol){
	//GENERA TODO EL MENU DEL USUARIO
		$dataMenu = array();
		$numero1 ='nombre';
		$numero2 ='url';
		$query = "select * from sr_menu where id_rol_menu='".$id_rol."'";
		$statement = mysql_query($query)or die(mysql_error()."Erro en la generacon del menu");
		while($row = mysql_fetch_array($statement))
		{
			$dataMenu[$numero1] = $row['nombre_menu'];
			$dataMenu[$numero2] = $row['url_menu'];
		}
		return $dataMenu;
}

function empresa()
{
	//INFORMACION DE LA INSTITUCION
	$query 		= "select * from sr_empresa";
	$statement 	= mysql_query($query);
	$row 		= mysql_fetch_array($statement);
	$data = array();

	if($row){
		$data[0] = $row['nombre_empresa'];
		$data[1] = $row['rubro_empresa'];
		$data[2] = $row['logo_empresa'];
		$data[3] = $row['pais'];
		$data[4] = $row['departamento'];
		$data[5] = $row['municipio'];		
		return $data;
	}
	else
	{

	}


}

function salir()
{
	echo "aaaaa";
	header('Location: '.'../login.php');
}
