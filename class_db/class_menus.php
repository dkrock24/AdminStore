<?php

include_once("../validation/conexion.php");

$conexion=null;

//$conexion = login();
$GLOBALS['conexion'] = login();

function query_global($sql){
	//echo $sql;
	//var_dump($GLOBALS['conexion']);
	$statement = mysqli_query($GLOBALS['conexion'],$sql)or die(mysqli_error(). " Error al cargar los menus");
	return $statement;
}


function selectPartidasGeneradas(){
	$sql = "select * from sr_generar_partidas";
	//$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar los menus");
	//return $statement;
	return query_global($sql);
}

function selectMenus()
{
	$sql = "select * from sr_menu";
	//$statement = mysqli_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar los menus");
	return query_global($sql);
}

function selectSubMenus($id)
{

	$sql = "select * from sr_submenu where id_menu = '".$id."' ";
	//$statement = mysql_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar SubMenus");
	//return $statement;
	return query_global($sql);
}

function selectMenusRol($rol)
{
	$sql = "select M.icon_menu,M.id_menu,M.estado_menu, M.nombre_menu,R.nombre_rol,R.id_rol,A.id_rol,			A.id_menu,A.estado 
			from  sr_menu as M  
			left join sr_accesos as A
			on M.id_menu = A.id_menu
			left join sr_roles as R
			on R.id_rol = A.id_rol
			where R.id_rol='".$rol."'";
	//$statement = mysql_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar los menus");
	//return $statement;
	return query_global($sql);
}

function menuPadre($id)
{
	$sql = "select M.nombre_menu from sr_submenu as S 
			left join sr_menu as M 
			on S.id_menu=M.id_menu
	 		where S.id_menu = '".$id."' Limit 1 ";
	//$statement = mysql_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar SubMenus");
	//return $statement;
	return query_global($sql);
}

function roles()
{
	$sql = "select * from sr_roles";
	$statement = query_global($sql);// mysql_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar Roles");
	return $statement;
}
function cargos()
{
	$sql = "select * from sr_cargos";
	//$statement = mysql_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar los Cargos");
	//return $statement;
	return query_global($sql);
}

// FUNCIONES DE HOME MENUS

function getHomeMenus()
{
	$sql = "select * from home_menu";
	//$statement = mysql_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar los Home menus");
	//return $statement;
	return query_global($sql);
}

function getHomeSubMenus($id)
{
	$sql = "select * from home_submenu where id_menu = '".$id."' ";
	//$statement = mysql_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar HomeSubMenus");
	//return $statement;
	return query_global($sql);
}

function getMenuPadre($id)
{
	$sql = "select M.nombre_menu from home_submenu as S 
			left join home_menu as M 
			on S.id_menu=M.id_menu
	 		where S.id_menu = '".$id."' Limit 1 ";
	//$statement = mysql_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar SubMenus");
	//return $statement;
	return query_global($sql);
}

function getSelectHomeMenus()
{
	$sql = "select * from home_menu";
	//$statement = mysql_query($GLOBALS['conexion'],$sql)or die(mysql_error(). " Erro al cargar los menus");
	//return $statement;
	return query_global($sql);
}
