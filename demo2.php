<?php
	//var_dump($_POST);
/*
$mysql_hostname = "127.0.0.1";
$mysql_user = "root";
$mysql_password = "lapizzeria2016!";
$mysql_database = "db_global_lapizzeria";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("Could not connect database 2");
die;*/
$host = "localhost";
$db = "kapricho_control";
$pass = "y84VEkozrTNl";

	$con = mysqli_connect($host, "kapricho_wbcms", $pass)or die(mysqli_error($con));
	//$con = mysqli_connect("localhost", "root", "")or die(mysqli_error($con));
	mysqli_select_db($con, $db)or die(mysqli_error($con));
	//mysqli_select_db($con, "db_lap")or die(mysqli_error($con));

	mysqli_query($con,"SET NAMES utf8");  

	//mysqli_query de comandas y validacion para ser mostradas cuando estan pendientes

	$sql_pedido_prioridad = "select * from sys_pedido where prioridad = 0 AND id_sucursal = '".$_POST['id_sucursal']."'";

	$statement_pedido = mysqli_query( $con , $sql_pedido_prioridad )or die (mysql_error($con));
	$date1 = date("Y-m-d");

	while($rows = mysqli_fetch_array( $statement_pedido )){
		
		$elaborado = $rows['fechahora_elaborado'];

		$abc = date_format(date_create($elaborado),"Y-m-d");
		if( $abc == $date1 ){
			$sql_update_pedido = "update sys_pedido set prioridad=1 where id_pedido ='". $rows['id_pedido']."'";
			mysqli_query( $con , $sql_update_pedido );
		}
	}

	//End mysqli_query


	
	//create response array
	$response = array();
	//by default set to error
	$response['success'] = 1;
	$iter = 1;
	do{
		$sql_pedido = "	select pedido.llevar_pedido,pedido.id_usuario,pedido.id_pedido,pedido.numero_mesa,pedido.fechahora_pedido,pedido.secuencia_orden from sys_pedido as pedido	
						join sys_pedido_detalle as PD on pedido.id_pedido=PD.id_pedido
						where pedido.id_sucursal=".$_POST['id_sucursal']." AND pedido.prioridad=1 AND PD.producto_elaborado=0 AND (PD.pedido_estado=2 or PD.pedido_estado=1) AND PD.id_nodo=".$_POST['id_nodo']." group by PD.id_pedido  order by PD.id_pedido asc";
		$res = mysqli_query($con, $sql_pedido)or die(mysqli_error($con));

		if(mysqli_num_rows($res) > 0){
			$response['success'] = 0;

			for($i=0 ; $row = mysqli_fetch_array($res) ; $i++)
			{
				$response['pedido'][$i] = $row;
				

				// Pedido Detalle
				
				$sql_pedido_detalle = 	"select pedido_d.id_detalle,pedido_d.id_producto,pedido_d.llevar, estados.pedido_estado, productos.nombre_producto,   pedido_d.nota_interna,pedido_d.precio_grabado,pedido_d.precio_original,pedido_d.cantidad,productos.image,productos.descripcion_producto from sys_pedido_detalle as pedido_d 
										join productsv1 as productos on productos.id_producto=pedido_d.id_producto
										join sys_pedido_estados as estados on estados.id_pedido_estado=pedido_d.pedido_estado
										where pedido_d.id_pedido=".$row['id_pedido']." AND pedido_d.producto_elaborado=0 AND pedido_d.id_nodo=".$_POST['id_nodo'];
				$res2 = mysqli_query($con, $sql_pedido_detalle)or die(mysqli_error($con));
				
				if(mysqli_num_rows($res2) > 0)
				{
					for($j=0 ; $row2 = mysqli_fetch_array($res2) ; $j++)
					{					
						$response['pedido'][$i][$j] = $row2;
						// Pedido Detalle Materiales
						$sql_pedido_detalle = "select cm.nombre_matarial,pedido_d_m.adicional,pedido_d_m.eliminado from sys_pedido as pedido
												join sys_pedido_detalle as pedido_d on pedido.id_pedido=pedido_d.id_pedido
												join sys_pedido_detalle_materia as pedido_d_m on pedido_d.id_detalle=pedido_d_m.id_detalle
												join productsv1 as productos on productos.id_producto=pedido_d.id_producto
												join sys_catalogo_materiales cm on cm.codigo_material=pedido_d_m.codigo_producto
												where pedido_d_m.id_detalle=".$row2['id_detalle']." AND (pedido_d_m.adicional=1 || pedido_d_m.eliminado=1)";
						$res3 = mysqli_query($con, $sql_pedido_detalle)or die(mysqli_error($con));
						if(mysqli_num_rows($res3) > 0)
						{
							for($k=0 ; $row3 = mysqli_fetch_array($res3) ; $k++){
								//echo $row3['nombre_matarial']."<br>";
								$response['pedido'][$i][$j][$k] = $row3;
							}
						}
					}

				}
	
				//break;		
			}	
			//var_dump($response['detalle']);				
		}
		//sleep for 5 secs to check for update
		//sleep(1);
		++$iter;
	}while($iter < 0);//just check for 3 times, i.e 15 sec ... else respond with success=1
	mysqli_close($con);
	echo json_encode($response);
?>