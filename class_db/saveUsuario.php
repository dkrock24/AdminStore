<?php
include_once("../validation/conexion.php");
$conexion = login();

$GLOBALS['conexion'] = login();

if($conexion)
{
	
	$accion	=	$_POST['accion'];
	accion($accion);
}
function accion($accion){
	if($accion=='cambiarStatus')
	{
		cambiarStatus();
	}
	if($accion=='delete')
	{
		deleteuser();
	}
	if($accion=='insert_usuario')
	{
		insertUsuario();
	}
	if($accion=='cambiarPassword')
	{
		cambiarPassword();
	}
	if($accion=='cambiarAvatar')
	{
		cambiarAvatar();
	}
	if($accion=='subirAvatar')
	{
		subirAvatar();
	}
	if($accion=='update_usuario')
	{
		updateUsuario();
	}
	if($accion=='deleteUsuario')
	{
		deleteUsuario();
	}
	if($accion=='subirImageNota')
	{
		subirImageNota();
	}

}

function deleteuser(){
	echo $id = $_POST['id'];
	

		$sql = "delete from ccs_track where id_ccs='$id'";
	$statement = mysqli_query($GLOBALS['conexion'],$sql)or die(mysql_error()." Error al hacer Update ccs_track");
	return $statement;
}

function cambiarStatus(){
	echo $id = $_POST['id'];
	echo $status = $_POST['state'];
	

		$sql = "update ccs_track set estatus='$status'
									where id_ccs='$id'							
									
									";
	$statement = mysqli_query($GLOBALS['conexion'],$sql)or die(mysql_error()." Error al hacer Update ccs_track");
	return $statement;
}

function deleteUsuario(){
	$id = $_POST['id'];
	$sql = "delete from sr_usuarios where id_usuario='".$id."'";
	$statement = mysqli_query($GLOBALS['conexion']$sql)or die(mysql_error(). " Error al Eliminar el usuario");
	return $statement;
}

function updateUsuario()
{

	echo $primer_nombre		=	$_POST['primer_nombre'];
	echo $segundo_nombre	=	$_POST['segundo_nombre'];
	echo $primer_apellido	=	$_POST['primer_apellido'];
	echo $segundo_apellido	=	$_POST['segundo_apellido'];
	echo $telefono			=	$_POST['telefono'];
	echo $celular			=	$_POST['celular'];
	echo $direccion			=	$_POST['direccion'];
	echo $dui				=	$_POST['dui'];
	echo $usuario			=	$_POST['usuario'];
	echo $password			=	$_POST['password'];
	echo $fecha_nacimiento	=	$_POST['fecha_nacimiento'];
	echo $genero			=	$_POST['genero'];
	echo $cargo				=	$_POST['cargo'];	
	echo $rol				=	$_POST['rol'];
	echo $id_usuario		=	$_POST['id_usuario'];
	echo $nickname			=	$primer_nombre.".".$primer_apellido;
	

	$sql = 'update sr_usuarios set usuario="'.$usuario.'",
									password="'.$password.'",
									nickname="'.$nickname.'",
									fecha_nacimiento="'.$fecha_nacimiento.'",
									primer_nombre="'.$primer_nombre.'",
									segundo_nombre="'.$segundo_nombre.'",
									primer_apellido="'.$primer_apellido.'",
									segundo_apellido="'.$segundo_apellido.'",
									genero="'.$genero.'",
									telefono="'.$telefono.'",
									celular="'.$celular.'",
									direccion="'.$direccion.'",
									dui="'.$dui.'",
									id_cargo="'.$cargo.'",
									rol="'.$rol.'"


									
									 where id_usuario="'.$id_usuario.'"
									';
	mysqli_query($GLOBALS['conexion'],$sql)or die(mysql_error());
}


function insertUsuario()
{
	$primer_nombre		=	$_POST['primer_nombre'];
	$segundo_nombre		=	$_POST['segundo_nombre'];
	$primer_apellido	=	$_POST['primer_apellido'];
	$segundo_apellido	=	$_POST['segundo_apellido'];
	$telefono			=	$_POST['telefono'];
	$celular			=	$_POST['celular'];
	$direccion			=	$_POST['direccion'];
	$dui				=	$_POST['dui'];
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$fecha_nacimiento	=	$_POST['fecha_nacimiento'];
	$genero				=	$_POST['genero'];
	$cargo				=	$_POST['cargo'];
	$avatar				=	$_POST['avatar'];
	$rol				=	$_POST['rol'];
	$nickname			=	$primer_nombre.".".$primer_apellido;
	$fecha_creacion		=	date("Y-m-d");

	$pass_encrypted		= sha1($password);

	$sql = 'insert into sr_usuarios (usuario,password,nickname,fecha_nacimiento,primer_nombre,
									segundo_nombre,primer_apellido,segundo_apellido,genero,avatar,
									telefono,celular,direccion,dui,fecha_creacion,id_cargo,rol,id_estado)
									values("'.$usuario.'","'.$pass_encrypted.'","'.$nickname.'","'.$fecha_nacimiento.'",
									"'.$primer_nombre.'","'.$segundo_nombre.'","'.$primer_apellido.'","'.$segundo_apellido.'",
									"'.$genero.'","'.$avatar.'","'.$telefono.'","'.$celular.'","'.$direccion.'","'.$dui.'","'.$fecha_creacion.'",
									"'.$cargo.'","'.$rol.'",1)';
	mysqli_query($GLOBALS['conexion'],$sql)or die(mysql_error());

	
}
function cambiarPassword() 
{
	$password		=	$_POST['password'];
	$usuario		=	$_POST['usuario'];
	$new_pass		= sha1($password);

	$sql = "update sr_usuarios set password='$new_pass', estado=1 where id_usuario=$usuario";
	mysql_query($GLOBALS['conexion'],$sql)or die(mysql_error());
}
function cambiarAvatar()
{
	$avatar		=	$_POST['avatar'];
	$usuario	=	$_POST['usuario'];

	$sql = "update sr_usuarios set avatar='$avatar' where id_usuario=$usuario";
	mysqli_query($GLOBALS['conexion'],$sql)or die(mysql_error());
}

function subirAvatar()
{
	
	echo $usuario	=	$_POST['usuario'];
	echo "<br>";
	echo $genero	=	$_POST['genero'];
	echo "<br>";
	echo $name = $_FILES['file']['name'];
	echo "<br>";
	echo $fileType = $_FILES['file']['type'];
	echo "<br>";
	echo $fileError = $_FILES['file']['error'];
	echo "<br>";
	$fileContent = file_get_contents($_FILES['file']['tmp_name']);
	$imagen = "../assets/images/avatars/".$_FILES['file']['name'];

	if(is_uploaded_file($_FILES['file']['tmp_name']))
	{
		echo " yes";
		move_uploaded_file($_FILES['file']['tmp_name'], $imagen);

		$sql = "insert into sr_avatar (nombre_avatar,url_avatar,genero_avatar,usuario_id,usuario_avatar,estado_avatar)
		values('".$name."','".$name."','".$genero."','".$usuario."','personal',1)";
		mysqli_query($GLOBALS['conexion'],$sql)or die(mysql_error());
	}


	//$sql = "update sr_usuarios set avatar='$avatar' where id_usuario=$usuario";
	//mysql_query($sql)or die(mysql_error());

}

function subirImageNota()
{
	$nombre_nuevo = $_POST['nuevo_nombre'];
	echo "<br>";
	echo $name = $_FILES['file']['name'];
	echo "<br>";
	echo $fileType = $_FILES['file']['type'];
	echo "<br>";
	echo $fileError = $_FILES['file']['error'];
	echo "<br>";
	$fileContent = file_get_contents($_FILES['file']['tmp_name']);
	$imagen = "../assets/images/avatars/".$nombre_nuevo.$_FILES['file']['name'];
	$documentos = "../assets/documentos/".$nombre_nuevo.$_FILES['documento']['name'];

	if(is_uploaded_file($_FILES['file']['tmp_name']))
	{
		move_uploaded_file($_FILES['file']['tmp_name'], $imagen);
	}
	if(is_uploaded_file($_FILES['documento']['tmp_name']))
	{
		move_uploaded_file($_FILES['documento']['tmp_name'], $documentos);
	}
	//$sql = "update sr_usuarios set avatar='$avatar' where id_usuario=$usuario";
	//mysql_query($sql)or die(mysql_error());

}

?>