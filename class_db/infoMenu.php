<?php
session_start();
include_once("../validation/conexion.php");
//$conexion = login();
$conexion=null;

//$conexion = login();
$GLOBALS['conexion'] = login();


$accion = $_POST['accion'];

switch ($accion) {
	case 'menu': menus(); break;
	case 'saveMenu' : saveMenu(); break;
	case 'submenu' : submenus(); break;
	case 'menusPadres' : menusPadres(); break;
	case 'saveChangeSubmenu' : updateSubMenu(); break;
	case 'activeMenu' : activeMenu(); break;
	case 'activeSubMenu' : activeSubMenu(); break;
	case 'createMenu' : createMenu(); break;
	case 'createSubMenu' : createSubMenu(); break;
	case 'createRol' : createRol(); break;
	case 'createCargo' : createCargo(); break;
	case 'AsignarMenu' : AsignarMenu(); break;
	case 'deleteRol' : deleteRol(); break;
	case 'updateRol' : updateRol(); break;
	case 'deleteCargo' : deleteCargo(); break;
	case 'updateCargo' : updateCargo(); break;
	case 'crearPartidasGenericas' : crearPartidasGenericas(); break;
	case 'activePartidas' : activePartidas(); break;
	case 'dataPartidaGenerar' : dataPartidaGenerar(); break;
	case 'savePartidaGenerada' : savePartidaGenerada(); break;
	case 'HomeMenu' : HomeMenu(); break;
	case 'activeHomeMenu' : activeHomeMenu(); break;
	case 'UpdateHomeMenu' : UpdateHomeMenu(); break;
	case 'saveChangeHomeSubmenu' : saveChangeHomeSubmenu(); break;
	case 'HomeSubMenu' : HomeSubMenu(); break;
	case 'activeHomeSubMenu' : activeHomeSubMenu(); break;
	case 'deleteHomeMenu' : deleteHomeMenu(); break;
	case 'deleteSubMenu' : deleteSubMenu(); break;
	case 'deleteMenu' : deleteMenu(); break;
	case 'deleteSubMenuSistema' : deleteSubMenuSistema(); break;

	
}
// Funcion Global de Consultas a la Base de Datos.
function query_global($sql){
	$statement = mysqli_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar los menus");
	return $statement;
}


// Delete Menu
function deleteMenu(){
	echo $_POST['id'];
	
	echo $sql 	= "delete from sr_menu where id_menu=".$_POST['id'];
	
	$statement = mysql_query($sql)or die(mysql_error(). " No se elimino el Menu");	
}

function deleteSubMenuSistema(){
	$_POST['id'];
	$sql 	= "delete from sr_submenu where id_submenu=".$_POST['id'];
	//$statement = mysql_query($sql)or die(mysql_error(). " No se elimino el Menu");	
	query_global($sql);
}

// Delete SubHomeMenu
function deleteSubMenu(){
	$sql 	= "delete from home_submenu where id_submenu='".$_POST['id']."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " No se elimino el Cargo");	
	query_global($sql);
}

// Delete HomeMenu
function deleteHomeMenu(){	
	$sql 	= "delete from home_menu where id_menu='".$_POST['id']."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " No se elimino el Cargo");	
	query_global($sql);
}

// ****************************** Home Menu
// ******************************
function HomeMenu(){
	$id_menu = $_POST['id'];
	$sql = "select * from home_menu where id_menu ='".$id_menu."'";
	$statement = query_global($sql);//mysql_query($sql)or die(mysql_error(). " Erro al cargar los Home Menus");
	$row = array();
	$row = mysqli_fetch_array($statement);
	echo json_encode($row);
}

function activeHomeMenu()
{
	$id_menu = $_POST['id'];
	$estado = $_POST['estado'];

	if($estado == 1)
	{
		$valor = 0;
	}else
	{
		$valor = 1;
	}
	$sql 	= "update home_menu set estado_menu='".$valor."' where id_menu ='".$id_menu."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " Update / Activacion - Desactivacion(HOME MENUS)");
	query_global($sql);
}

function UpdateHomeMenu(){
	$nombre = $_POST['nombre'];
	$url 	= $_POST['url'];
	$icon 	= $_POST['icon'];
	$id 	= $_POST['id'];

	$sql 	= "update home_menu set nombre_menu='".$nombre."',url_menu='".$url."', icon_menu='".$icon."' where id_menu ='".$id."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " Update realizado Satisfacotiamente");
	query_global($sql);
}

function saveChangeHomeSubmenu()
{
	$nombre = $_POST['nombre'];
	$url 	= $_POST['url'];
	$icon 	= $_POST['icon'];
	$id 	= $_POST['id'];
	

	if(isset($id))
	{
		$sql 	= "update home_submenu set nombre_submenu='".$nombre."',url_submenu='".$url."' , id_menu='".$icon."' where id_submenu ='".$id."'";
		
		//$statement = mysql_query($sql)or die(mysql_error(). " Update No realizado (SUBMENUS)");
		query_global($sql);

		$sql1 = "select id_menu from home_submenu where id_submenu ='".$id."'";
		$statement1 = query_global($sql1);// query_global($sql1);//mysql_query($sql1)or die(mysql_error(). " Erro al cargar los submenus");
		$row1 = array();
		$row1 = mysqli_fetch_array($statement1);
		echo json_encode($row1[0]);		
	}
}

function HomeSubMenu(){
	$id_submenu = $_POST['id'];
	$sql = "select * from home_submenu as S 
			left join home_menu M on S.id_menu=M.id_menu
	 		where id_submenu ='".$id_submenu."'";
	$statement = query_global($sql); // mysql_query($sql)or die(mysql_error(). " Erro al cargar los submenus");
	$row = array();
	$row = mysqli_fetch_array($statement);
	echo json_encode($row);
}

function activeHomeSubMenu()
{
	$id_submenu = $_POST['id'];
	$estado = $_POST['estado'];

	if($estado == 1)
	{
		$valor = 0;
	}else
	{
		$valor = 1;
	}
	$sql 	= "update home_submenu set estado_submen='".$valor."' where id_submenu ='".$id_submenu."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " Update / Activacion - Desactivacion(MENUS)");
	query_global($sql);

	$sql = "select id_menu from home_submenu where id_submenu ='".$id_submenu."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " Erro al selecionar idsubmenu ");
	$row = array();
	$row = mysqli_fetch_array(query_global($sql));
	echo json_encode($row);
}
// ******************************
// ******************************



function savePartidaGenerada(){

	$nombre = $_POST['nombre'];
	$id 	= $_POST['id'];

	$sql 	= "update sr_generar_partidas set partida_generada='".$nombre."' where id_generar ='".$id."'";
	$statement = mysql_query($sql)or die(mysql_error());

}
function dataPartidaGenerar(){

	$id = $_POST['id'];
	$sql = "select * from sr_generar_partidas where id_generar ='".$id."'";
	$statement = query_global($sql);// mysql_query($sql)or die(mysql_error(). " Erro al cargar los menus");
	
	$row = array();
	$row = mysql_fetch_array($statement);
	echo json_encode($row);

}

function activePartidas(){

	echo $id 		= $_POST['id'];
	echo $estado 	= $_POST['estado'];

	if($estado==1){
		$estado=0;
	}else{
		$estado=1;
	}
	$sql = "update sr_generar_partidas set estado='$estado' where id_generar='$id' ";
	//mysql_query($sql)or die(mysql_error());
	query_global($sql);
}

function crearPartidasGenericas(){

	$nombre = $_POST['nombre'];
	$estado = $_POST['estado'];

	$sql 	= "insert into sr_generar_partidas (partida_generada,estado)values('$nombre','$estado')";
	//mysql_query($sql)or die(mysql_error());
	query_global($sql);
}

function updateRol(){

	$id_rol 	= $_POST['id_rol'];
	$nombre_rol	= $_POST['nombre'];

	$sql = "update sr_roles set nombre_rol ='".$nombre_rol."' where id_rol ='".$id_rol."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " Update Rol No realizado ");
	query_global($sql);
}

function updateCargo(){

	$id_cargo 		= $_POST['id_cargo'];
	$nombre_rol	= $_POST['nombre'];
	$sql 	= "update sr_cargos set nombre_cargo ='".$nombre_rol."' where id_cargo ='".$id_cargo."'";
	
	//$statement = mysql_query($sql)or die(mysql_error(). " Update Rol realizado Satisfactoriamente");
	query_global($sql);

}

function deleteCargo(){

	$id_cargo 	= $_POST['id_cargo'];

	$user = "select rol from sr_usuarios where id_cargo = '".$id_cargo."'";
	$consulta = query_global($user);// mysql_query($user);
	$resultado = mysqli_fetch_array($consulta);
	$contador = count($resultado);

	$data = array();
	

	if($resultado == 0){

		$sql 	= "delete from sr_cargos where id_cargo='".$id_cargo."'";
		$statement = query_global($sql);// mysql_query($sql)or die(mysql_error(). " No se elimino el Cargo");
		$data[0] = 1;
	}
	else
	{
		$data[0] = 2;
	}
	echo json_encode($data);
}


function deleteRol(){

	$rol 		= $_POST['id_rol'];
	$user 		= "select rol from sr_usuarios where rol = '".$rol."'";
	$consulta 	= query_global($user);//  mysql_query($user);
	$resultado 	= mysqli_fetch_array($consulta);
	$contador 	= count($resultado);
	$data 		= array();
	

	if($resultado == 0){
		$sql2 		= "delete from sr_accesos where id_rol ='".$rol."'";
		$statement2 = query_global($sql2);// mysql_query($sql2)or die(mysql_error(). " No se eliminaron los Accesos del Rol");

		$sql 		= "delete from sr_roles where id_rol='".$rol."'";
		$statement 	= query_global($sql);//mysql_query($sql)or die(mysql_error(). " No se elimino el Rol");
		$data[0] 	= 1;
	}
	else
	{
		$data[0] 	= 2;
	}
	echo json_encode($data);
}

function AsignarMenu(){

	$rol 		= $_POST['rol'];
	$id 		= $_POST['id'];
	$estado 	= $_POST['estado'];

	if($estado == 1)
	{
		$valor = 0;
	}else
	{
		$valor = 1;
	}

	$sql 	= "update sr_accesos set estado ='".$valor."' where id_menu ='".$id."' and id_rol='".$rol."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " Update realizado Satisfacotiamente");
	query_global($sql);

}


function createCargo(){
	$nombre = $_POST['nombre'];
	$estado = $_POST['estado'];

	$sql 	= "insert into sr_cargos (nombre_cargo,estado_cargo) values('".$nombre."','".$estado."')";
	//$statement = mysql_query($sql)or die(mysql_error(). " No se Inserto el Cargo en sr_cargos");
	query_global($sql);
}

function createRol(){
	$nombre = $_POST['nombre'];
	$estado = $_POST['estado'];

	$sql 	= "insert into sr_roles (nombre_rol,estado_rol) values('".$nombre."','".$estado."')";
	//$statement = mysql_query($sql)or die(mysql_error(). " No se Inserto el Rol en sr_roles");
	query_global($sql);

	$rs = query_global("SELECT @@identity AS id"); //mysql_query("SELECT @@identity AS id");
	if ($row = mysqli_fetch_row($rs)) {
		$ultimo_id = trim($row[0]);

		$sql = "select id_menu from sr_menu";
		$statement = query_global($sql);// mysql_query($sql)or die(mysql_error(). " No se cargaron los menus");

		while($row = mysqli_fetch_array($statement))
		{
			$sql1 	= "insert into sr_accesos (id_rol,id_menu,estado) 
						values('".$ultimo_id."','".$row['id_menu']."',0)";
			//mysql_query($sql1)or die(mysql_error(). " No se Inserto los Accesos");
			query_global($sql1);
		}
	}
}

function saveMenu(){
	$nombre = $_POST['nombre'];
	$url 	= $_POST['url'];
	$icon 	= $_POST['icon'];
	$id 	= $_POST['id'];
	$sql 	= "update sr_menu set nombre_menu='".$nombre."',url_menu='".$url."', icon_menu='".$icon."' where id_menu ='".$id."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " Update realizado Satisfacotiamente");
	query_global($sql);
}

function menus(){
	$id_menu = $_POST['id'];
	$sql = "select * from sr_menu where id_menu ='".$id_menu."'";
	$statement = query_global($sql);// mysql_query($sql)or die(mysql_error(). " Erro al cargar los menus");
	$row = array();
	$row = mysqli_fetch_array($statement);
	echo json_encode($row);
}
function submenus(){
	$id_submenu = $_POST['id'];
	$sql = "select * from sr_submenu as S 
			left join sr_menu M on S.id_menu=M.id_menu
	 		where id_submenu ='".$id_submenu."'";
	$statement = query_global($sql);//  mysql_query($sql)or die(mysql_error(). " Erro al cargar los submenus");
	$row = array();
	$row = mysqli_fetch_array($statement);
	echo json_encode($row);
}

function updateSubMenu()
{
	$nombre = $_POST['nombre'];
	$url 	= $_POST['url'];
	$icon 	= $_POST['icon'];
	$id 	= $_POST['id'];
	

	if(isset($id))
	{
		$sql 	= "update sr_submenu set nombre_submenu='".$nombre."',url_submenu='".$url."' , id_menu='".$icon."' where id_submenu ='".$id."'";
		
		$statement = query_global($sql);// mysql_query($sql)or die(mysql_error(). " Update No realizado (SUBMENUS)");

		$sql1 = "select id_menu from sr_submenu where id_submenu ='".$id."'";
		$statement1 = query_global($sql1);// mysql_query($sql1)or die(mysql_error(). " Erro al cargar los submenus");
		$row1 = array();
		$row1 = mysqli_fetch_array($statement1);
		echo json_encode($row1[0]);		
	}
}

function activeMenu()
{
	$id_menu = $_POST['id'];
	$estado = $_POST['estado'];

	if($estado == 1)
	{
		$valor = 0;
	}else
	{
		$valor = 1;
	}
	$sql 	= "update sr_menu set estado_menu='".$valor."' where id_menu ='".$id_menu."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " Update / Activacion - Desactivacion(MENUS)");
	query_global($sql);
}

function activeSubMenu()
{
	$id_submenu = $_POST['id'];
	$estado = $_POST['estado'];

	if($estado == 1)
	{
		$valor = 0;
	}else
	{
		$valor = 1;
	}
	$sql 	= "update sr_submenu set estado_submen='".$valor."' where id_submenu ='".$id_submenu."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " Update / Activacion - Desactivacion(MENUS)");
	query_global($sql);

	$sql = "select id_menu from sr_submenu where id_submenu ='".$id_submenu."'";
	//$statement = mysql_query($sql)or die(mysql_error(). " Erro al selecionar idsubmenu ");
	$statement = query_global($sql);
	$row = array();
	$row = mysqli_fetch_array($statement);
	echo json_encode($row);
}


function createMenu()
{
	$nombre 	= $_POST['nombre'];
	$url 		= $_POST['url'];
	$icon 		= $_POST['icon'];
	$clas 		= $_POST['clas'];
	$estado 	= $_POST['estado'];

	
	$sql 	= "insert into sr_menu (nombre_menu,url_menu,icon_menu,class_menu,id_rol_menu,estado_menu)
	values('".$nombre."','".$url."','".$icon."','".$clas."',1,'".$estado."')";
	//$statement = mysql_query($sql)or die(mysql_error(). " No se Inserto en (MENUS)");
	query_global($sql);

	//$menus = "select id_menu from sr_menu";
	//$menu_row = mysql_query($menus)or die(mysql_error()."Error al insertar acceso a usuarios");

	$rs = query_global("SELECT @@identity AS id");// mysql_query("SELECT @@identity AS id");
	if ($row = mysqli_fetch_row($rs))
	{
		$ultimo_id = trim($row[0]);
	}

	$id_roles = "select distinct id_rol from sr_roles";
	$data_roles = query_global($id_roles);// mysql_query($id_roles)or die(mysql_error()."Error en Consultar Roles");


	while($row2 = mysqli_fetch_array($data_roles)){
		$a = $row2['id_rol'];
		$inset_acceso = "insert into sr_accesos (id_rol,id_menu,id_usuario,estado)
		values($a,$ultimo_id,0,0)";
		//mysql_query($inset_acceso)or die(mysql_error()."Error en Insertar Nuevo Acceso");
		query_global($inset_acceso);
	}
}

function createSubMenu()
{
	$nombre 	= $_POST['nombre'];
	$url 		= $_POST['url'];
	$icon 		= $_POST['icon'];
	$clas 		= $_POST['clas'];
	$estado 	= $_POST['estado'];

	
	$sql 	= "insert into sr_submenu (nombre_submenu,url_submenu,titulo_submenu,id_menu,estado_submen)
	values('".$nombre."','".$url."','".$icon."','".$clas."','".$estado."')";
	//$statement = mysql_query($sql)or die(mysql_error(). " No se Inserto en (MENUS)");
	query_global($sql);

}