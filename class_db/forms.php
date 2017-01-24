
<?php
session_start();

include_once("../validation/conexion.php");
$conexion = login();

$action = $_POST['action'];

switch ($action) {
    case 'selectPartidasGenericas':tipoForm();
        break;
    case 'InsertPartidaGenerica':InsertPartidaGenerica();
        break;
    case 'insert_marginacion':insert_marginacion();
        break;
    case 'UpdatePartidaGenerica':UpdatePartidaGenerica();
        break;
}
//if(isset($action)){
//	tipoForm($_POST['valor']);
//}
function tipoForm()
{
    $id = $_POST['valor']	;
	$sql = "select file from sr_generar_partidas where id_generar ='".$id."'";
	$statement = mysql_query($sql)or die(mysql_error(). " Erro al cargar los menus");
	$row = array();	
	$row = mysql_fetch_array($statement);

	echo json_encode($row);
}
function InsertPartidaGenerica(){
    $usuario = $_POST['usuario'];
    $tipoPartida = $_POST['tipoPartida'];
    $tipo = $_POST['tipo'];
    $numeroLibro= $_POST['numeroLibro'];
    $tipoDcoumento  = $_POST['tipoDcoumento'];
    $numeroFL = $_POST['numeroFL'];
    $nombre1 = $_POST['nombre1'] ;
    if(isset($_POST['nombre2'])){
        $nombre2 = $_POST['nombre2'];
    }else{
        $nombre2 = "";
    }
    $fecha_general = $_POST['fecha_general'];
    $detalle = $_POST['detalle'];
    $id="";
    $fecha = date("Y-m-d");
    $sql = "insert into sr_partidas_generales (id_usuario,id_tipo,nombre1,nombre2,fecha,pagina,numero_pagina,numero_libro,detalle,fecha_ingreso)values(
            '$usuario','$tipoPartida','$nombre1','$nombre2','$fecha_general','$tipoDcoumento',
            '$numeroFL','$numeroLibro','$detalle','$fecha')";
    mysql_query($sql)or die(mysql_error()."Error al insertar partida Generecia");

    $rs = mysql_query("SELECT @@identity AS id");
    if ($row = mysql_fetch_row($rs))
    {
        $ultimo_id = trim($row[0]);
    }
    echo json_encode($row);
}

function insert_marginacion(){
    $id_partida = $_POST['id_partida'];
    $id_tipo    = $_POST['id_tipo'];
    $id_usuario = $_POST['id_usuario'];
    $marginacion = $_POST['marginacion'];
    $fecha = date("Y-m-d");
    $sql = "insert into sr_marginaciones_generales (id_tipo_partida,id_partida,id_usuario,texto_marginacion,fecha_marginacion)values(
        '$id_tipo','$id_partida','$id_usuario','$marginacion','$fecha'
        )";
mysql_query($sql)or die(mysql_error());

}

function UpdatePartidaGenerica()
{    
    $tipoPartida = $_POST['tipoPartida1'];
    $tipo = $_POST['tipo1'];
    echo $numeroLibro= $_POST['numeroLibro1'];
    $tipoDcoumento  = $_POST['tipoDcoumento1'];
    $numeroFL = $_POST['numeroFL1'];
    $nombre1 = $_POST['nombre11'] ;
    if(isset($_POST['nombre21'])){
        $nombre2 = $_POST['nombre21'];
    }else{
        $nombre2 = "";
    }
    $id_partida =  $_POST['id_partida1'];
    $fecha_general = $_POST['fecha_general1'];
    $detalle = $_POST['detalle1'];

    $sql = "update sr_partidas_generales set id_tipo='$tipo', nombre1='$nombre1', nombre2='$nombre2'
            , fecha='$fecha_general', pagina='$tipoDcoumento', numero_pagina='$numeroFL',
            numero_libro='$numeroLibro',detalle='$detalle' where id_partida='$id_partida'";
        mysql_query($sql)or die(mysql_error());
}