<?php

// 45.33.3.227
// 	lapizzeria2016!
// db_global_lapizzeria
include "../global_values.php";

$GLOBALS['user'],$GLOBALS['passwd'],$GLOBALS['host']

function getID($id_menu){
	$db = new PDO("mysql:host=$GLOBALS['host'];dbname=$GLOBALS['db']",$GLOBALS['user'],$GLOBALS['passwd']);

	$query = $db->prepare("select * from sr_submenu where id_menu='".$id_menu."' && estado_submen = 1");
	
    $query->execute();
    $data['data'] = $query->fetch(); 
    var_dump($data);
    return   $data;  
}

function login(){

	$usuario = $GLOBALS['user'];
	$password = $GLOBALS['passwd'];
	$host = $GLOBALS['host'];
	$db=$GLOBALS['db'];
	$db = new PDO("mysql:host=$host;dbname=$db",$usuario,$password);
}

?>



