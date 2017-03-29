<?php
	$con = mysqli_connect("localhost", "root", "")or die(mysqli_error($con));
	mysqli_select_db($con, "db_global_lapizzeria2")or die(mysqli_error($con));
	
	//create response array
	$response = array();
	//by default set to error
	$response['success'] = 1;
	$iter = 0;
	do{
		$sql_pedido = "select pedido.llevar_pedido,pedido.id_usuario,pedido.id_pedido from sys_pedido as pedido				
				where pedido.id_sucursal=".$_POST['id_sucursal']." and pedido.mostrado=0 limit 1";
		$res = mysqli_query($con, $sql_pedido)or die(mysqli_error($con));
		if(mysqli_num_rows($res) > 0){
			$response['success'] = 0;

			for($i=0 ; $row = mysqli_fetch_array($res) ; $i++){
				$response['pedido'][$i] = $row;

				// Pedido Detalle				
				$sql_pedido_detalle = 	"select pedido_d.id_detalle,pedido_d.id_producto,pedido_d.llevar,productos.nombre_producto from sys_pedido_detalle as pedido_d 
										join sys_productos as productos on productos.id_producto=pedido_d.id_producto
										where pedido_d.id_pedido=".$row['id_pedido'];
				$res2 = mysqli_query($con, $sql_pedido_detalle)or die(mysqli_error($con));
				if(mysqli_num_rows($res2) > 0){
					for($j=0 ; $row2 = mysqli_fetch_array($res2) ; $j++){

						$response['detalle'][$j] = $row2;
						// Pedido Detalle Materiales
						$sql_pedido_detalle = "select cm.nombre_matarial,pedido_d_m.adicional,pedido_d_m.eliminado from sys_pedido as pedido
												join sys_pedido_detalle as pedido_d on pedido.id_pedido=pedido_d.id_pedido
												join sys_pedido_detalle_materia as pedido_d_m on pedido_d.id_detalle=pedido_d_m.id_detalle
												join sys_productos as productos on productos.id_producto=pedido_d.id_producto
												join sys_catalogo_materiales cm on cm.codigo_material=pedido_d_m.codigo_producto
												where pedido_d_m.id_detalle=".$row2['id_detalle']." AND (pedido_d_m.adicional=1 or pedido_d_m.eliminado=1)";
						$res3 = mysqli_query($con, $sql_pedido_detalle)or die(mysqli_error($con));
						if(mysqli_num_rows($res2) > 0){
							for($k=0 ; $row3 = mysqli_fetch_array($res3) ; $k++){
								$response['detalle'][$j]['items'][$k] = $row3;
							}
						}
					}
				}
			}
			
			mysqli_query($con, "update sys_pedido set `mostrado`=1 where `id_pedido`=2")or die(mysqli_error($con));
			break;
		}
		//sleep for 5 secs to check for update
		sleep(5);
		++$iter;
	}while($iter < 3);//just check for 3 times, i.e 15 sec ... else respond with success=1
	mysqli_close($con);
	echo json_encode($response);
?>