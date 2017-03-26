<?php
	$con = mysqli_connect("localhost", "root", "")or die(mysqli_error($con));
	mysqli_select_db($con, "db_global_lapizzeria2")or die(mysqli_error($con));
	
	//create response array
	$response = array();
	//by default set to error
	$response['success'] = 1;
	$iter = 0;
	do{
		$sql = "select productos.nombre_producto from sys_pedido as pedido
				join sys_pedido_detalle as pedido_d on pedido.id_pedido=pedido_d.id_pedido
				join sys_pedido_detalle_materia as pedido_d_m on pedido_d.id_detalle=pedido_d_m.id_detalle
				join sys_productos as productos on productos.id_producto=pedido_d.id_producto
				join sys_catalogo_materiales cm on cm.codigo_material=pedido_d_m.codigo_producto
				where pedido_d.id_nodo=9 and pedido.id_sucursal=1 and pedido.mostrado=0";
		$res = mysqli_query($con, $sql)or die(mysqli_error($con));
		if(mysqli_num_rows($res) > 0){
			//mark them read
			
			
			//set to success
			$response['success'] = 0;
			$temp = array();
			for($i=0 ; $row = mysqli_fetch_array($res) ; $i++){
				$temp[$i] = $row;
			}
			$response['feed'] = $temp;
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