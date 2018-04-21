<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cindex extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/sucursales/sucursales_model');	
		$this->load->model('backend/convert/convert_model');
		$this->load->model('backend/login/login_model');	
		$this->load->model('backend/logs/logs_model');	
		$this->load->model('backend/alertas/alertas_model');
		
	}

	// Sucursales Asignadas a cada usuario
	public function index()
	{	
		session_start();
		$var_id_usuario = $_SESSION['idUser'];
		$data['sucursales'] = $this->sucursales_model->getSucursalesByUser($var_id_usuario);		

		$this->load->view('backend/sucursales/Vindex.php',$data);
	}

	public function cargar_sucursal($id_sucursal){
		session_start();
		$var_id_usuario = $_SESSION['idUser'];
		$data['sucursales'] = $this->sucursales_model->getSucursalesById($id_sucursal);	

		$this->logs_model->setLog(2,$id_sucursal,$var_id_usuario);	

		/* NOTIFICACION DE CORTE*/	
		$this->alertas_model->setAlerta($id_sucursal,$var_id_usuario,16,1);	
		/* NOTIFICACION DE CORTE*/

		$this->load->view('backend/sucursales/VsucursalCargada.php',$data);
	}
	public function cargar_nodos($id_sucursal){
		$data['sucursales'] = $this->sucursales_model->getSucursalesByNodo($id_sucursal);	
		$data['id_sucursal'] = $id_sucursal;
		$this->load->view('backend/sucursales/VsucursalNodo.php',$data);
	}
	public function nodo($id_nodo,$id_sucursal){
		$data['sucursales'] = $this->sucursales_model->getSucursalByNodoId($id_nodo,$id_sucursal);	
		$data['id_sucursal'] = $id_sucursal;
		$this->load->view('backend/sucursales/VNodo.php',$data);
	}
	public function login($id_sucursal){
		session_start();
		//var_dump($_SESSION);
		//$data['sucursales'] = $this->sucursales_model->getSucursalByNodoId($id_nodo,$id_sucursal);	
		//$data['id_sucursal'] = $id_sucursal;
		$data['sucursales'] = $this->sucursales_model->getSucursalesById($id_sucursal);	
		$this->load->view('backend/sucursales/Vlogin.php',$data);
	}

	//Esta enviando los usuarios asignados por sucursal al pos
	public function UsuariosSucursal($id_sucursal){
		$info = $this->sucursales_model->getUsuariosSucursal($id_sucursal);	

			$data="";
			foreach ($info as $usuario) {
				echo "[ ".$usuario->id_usuario." ]  ". $usuario->nickname."\n";
			}	
	
	}

	public function validarMesero($id_sucursal,$id_mesero){
		$info = $this->sucursales_model->getValidarUsuariosSucursal($id_sucursal,$id_mesero);
		echo $info;
	}

	public function ordenes($id){
		session_start();
		//var_dump($_SESSION);
		if(isset($_POST))
		{
			if(isset($_POST['usuario'])){
				$_SESSION['uno'] = $_POST['usuario'];
				$_SESSION['dos'] = $_POST['password'];
				$_SESSION['id']  = $id;
			}
		}
		else
		{
			$_SESSION['uno'] 	= $_POST['usuario'];
			$_SESSION['dos'] 	= $_POST['password'];
			$_SESSION['id'] 	= $id;
		}	

		$data['sucursales'] 	= $this->sucursales_model->getSucursalesById($_SESSION['id']);	
		$data['productos']		= $this->sucursales_model->getProductosBySucursales($id);	
		$data['categorias']		= $this->sucursales_model->getCategorias();	
			
		$autenticar['login'] 	= $this->login_model->login($_SESSION['uno'],$_SESSION['dos']);


		if($autenticar['login']==0){
			$this->load->view('backend/sucursales/Vlogin.php',$data);			
		}else{	
			$this->load->view('backend/sucursales/Vordeness.php',$data);		
		}
	}

	//Verifica existencia de materiales en el inventario
	public function getProductoItems($sucursal,$id_producto){
		$info = $this->sucursales_model->getProductoItems($sucursal,$id_producto);	
		$data="";
		foreach ($info as $producto) {
			//echo $contador;
			/*echo 	//"[ ".$producto->nombre_producto." ] ".
					//"[ ".$producto->id_producto." ] ".
					//"[ ".$producto->name_detalle." ] ".
					"[ ".$producto->cantidad." ] ".
					"[ ".$producto->unidad_medida_id." ] ".
					//"[ ".$producto->nombre_unidad_medida." ] ".
					//"[ ".$producto->simbolo_unidad_medida." ] ".
					//"[ ".$producto->NombreUnidad2." ] ".
					//"[ ".$producto->Simbolo2." ] ".
					"[ ".$producto->Unidad2." ] ".
					"[ ".$producto->total_existencia." ] "."\n\n";*/
			$valor = $this->ConvertUnidades($sucursal,$producto->Unidad2,$producto->unidad_medida_id,$producto->cantidad,$producto->name_detalle);
			echo $valor;
		}	
	}

	public function ConvertUnidades($sucursal,$unidadAConvert,$unidadDeConvert,$cantidadAConvert,$codigo_material)
	{
		//echo "De ".$unidadAConvert;
		//echo " A ";
		//echo $unidadDeConvert;
		//echo " = ";
		$datosEquivalentes = $this->convert_model->getDatosEquivalentes($unidadAConvert,$unidadDeConvert);
		foreach ($datosEquivalentes as $value) {
			$valor =  $value['cantidad_equivalencia'];

			$resultConvert = $cantidadAConvert * $valor;			
			//echo $resultConvert;			
			//echo "(".$cantidadAConvert ."*". $valor.")";
			//echo "<br>";
		}
		//var_dump($datosEquivalentes[0]['cantidad_equivalencia']);		
		$estado = $this->getCantidadExistencia($sucursal,$unidadAConvert,$resultConvert,$codigo_material);		
		return $estado;
	}

	public function getCantidadExistencia($sucursal,$unidadAConvert,$resultConvert,$codigo_material){
		$aprobado=0;
		//echo $resultConvert;
		//echo $codigo_material . "<br>";
		$info = $this->sucursales_model->getValidarDescuentoInventario($sucursal,$codigo_material);

		foreach ($info as $value) {
			if($value->id_unidad_medida==$unidadAConvert)
			{
				if($value->total_existencia >= $resultConvert){
					$aprobado=1;
				}
				else
				{
					//echo $codigo_material;
					$aprobado=2;
				}
			}
			else
			{
				$aprobado = 0;				
			}			
		}
		return $aprobado;
	}

	// Guarda  el en Encabezado de la Orden
	public function GuardarOrden($Mesa,$Id_Mesero,$Id_Sucursal){
		
		$id_pedido= 0;

		if($_POST['id_pedido'] == '0' ){
			$id_pedido = $this->sucursales_model->InsertPedido($Mesa,$Id_Mesero,$Id_Sucursal);
		}
		else{
			$id_pedido =  $_POST['id_pedido'];
		}
		
		$data = $_POST['info'];

		
		/* Si el $id_pedido de Encabezado del pedido existe realiza
		 los siguientes guardados de informacion*/

		if(isset($id_pedido)){

			foreach ($data as $pedido)
			{		
				if(isset($pedido['llevar']['abc'])){					
					$llevar = $pedido['llevar']['abc'];
				}else{
					$llevar=0;
				}
				if(isset($pedido['ingredientes'])){					
					$ingredientes = $pedido['ingredientes'];
				}else{
					$ingredientes=0;
				}
				if(isset($pedido['adicionales'])){					
					$adicionales = $pedido['adicionales'];
				}else{
					$adicionales=0;
				}

				if($_POST['id_pedido'] != 0){

					$this->GuardarOrdenDetalle($Mesa,$Id_Mesero,$pedido['ID'],$pedido['precio'],$Id_Sucursal,$_POST['id_pedido'],$llevar,$ingredientes,$adicionales);

				}else{

					$this->GuardarOrdenDetalle($Mesa,$Id_Mesero,$pedido['ID'],$pedido['precio'],$Id_Sucursal,$id_pedido,$llevar,$ingredientes,$adicionales);

				}
				
			}
		}
	}
	// Inserta El Detalle de La Orden
	public function GuardarOrdenDetalle($Mesa,$Id_Mesero,$Id_Producto,$Precio,$Id_Sucursal,$Id_Pedido,$llevar,$Ingredientes,$Adicionales){	
		$info 				= $this->sucursales_model->getProductoItems($Id_Sucursal,$Id_Producto);
		$id_pedido_detalle 	= $this->sucursales_model->InsertPedidoDetalle($Mesa,$Id_Mesero,$Id_Producto,$Precio,$info[0]->nodoID,$Id_Sucursal,$Id_Pedido,$llevar);
		$data 				= $_POST['info'];

		// Eliminar Ingredientes
		if($Ingredientes!=0){
			foreach ($Ingredientes as $ingrediente) { // Recorrer Items a Quitar
				foreach ($info as $itemsProducto) { // Items de productos
					if($itemsProducto->name_detalle==$ingrediente['codigo_m'])
					{
						$this->insertItems($id_pedido_detalle,$itemsProducto->unidad_medida_id,0,0,1,$itemsProducto->name_detalle,	$itemsProducto->cantidad,0);
					}
					else
					{
						$this->insertItems($id_pedido_detalle,$itemsProducto->unidad_medida_id,1,0,0,$itemsProducto->name_detalle,	$itemsProducto->cantidad,0);
					}
				}
			}
		}
		else
		{
			foreach ($info as $itemsProducto) {
				$this->insertItems($id_pedido_detalle,$itemsProducto->unidad_medida_id,1,0,0,$itemsProducto->name_detalle,	$itemsProducto->cantidad,0);
			}
		}

		// Agregar Ingredientes
		if($Adicionales!=0){		// Insertar Adicionales a la Orden Por Producto
			foreach ($Adicionales as $adicional) {
				$items = $this->getItemsByCodigo2($Id_Sucursal,$adicional['codigo']);
				foreach ($items as $value) 
				{
					$this->insertItems(	$id_pedido_detalle,$value->unida_medida_adicional,0,1,0,$value->codigo_meterial,$value->cantidad_adicional,$adicional['precio']);
				}						
			}					
		}
		//$info = $this->sucursales_model->getProductoItems($Id_Sucursal,$Id_Producto);
		foreach ($info as $producto) 
		{
			// Despues de Insertar El Detall de Cada Producto, Descontarmeos del Inventario Su Equivalente
			$valor = $this->ConvertUnidades2(
				$Id_Sucursal,
				$producto->name_detalle,
				$producto->Unidad2,
				$producto->unidad_medida_id,
				$producto->cantidad,
				$producto->name_detalle,
				$producto->total_existencia
			);	
		}

	}

	// Insertar Items de Cada Producto como Detalle de La Orden
	public function GuardarOrdenDetalleMaterial($Id_Sucursal,$Id_Producto,$id_pedido_detalle){
		//$info = $this->sucursales_model->getItemsByCodigo($Id_Sucursal,$Id_Producto);
		$info = $this->sucursales_model->getProductoItems($Id_Sucursal,$Id_Producto);
		$data = $_POST['info'];

			foreach ($data as  $ordenPedido) { // Elementos de la orden
				
				if(isset($ordenPedido['ingredientes'])){// Si la Orden tiene elementos a Quitar

					foreach ($ordenPedido['ingredientes'] as $ingredientes) { // Recorrer Items a Quitar
						foreach ($info as $itemsProducto) { // Items de productos
							if($itemsProducto->name_detalle==$ingredientes['codigo_m'])
							{
								//var_dump($ingredientes['nombre_m']);
								$this->insertItems($id_pedido_detalle,$itemsProducto->unidad_medida_id,0,0,1,$itemsProducto->name_detalle,	$itemsProducto->cantidad,0);
								
							}
							else
							{
								$this->insertItems($id_pedido_detalle,$itemsProducto->unidad_medida_id,1,0,0,$itemsProducto->name_detalle,	$itemsProducto->cantidad,0);
															
							}
						}
					}
				}

				if(isset($ordenPedido['adicionales'])){		// Insertar Adicionales a la Orden Por Producto

					foreach ($ordenPedido['adicionales'] as $adicionales) {
						$items = $this->getItemsByCodigo2($Id_Sucursal,$adicionales['codigo']);
						foreach ($items as $value) {
							$this->insertItems(	$id_pedido_detalle,$value->unida_medida_adicional,0,1,0,$value->codigo_meterial,$value->cantidad_adicional,$adicionales['precio']);
						}						
					}					
				}
				
			}

		
		
		/*
		foreach ($info as $producto) 
		{
			// Despues de Insertar El Detall de Cada Producto, Descontarmeos del Inventario Su Equivalente
			$valor = $this->ConvertUnidades2(
				$Id_Sucursal,
				$producto->name_detalle,
				$producto->Unidad2,
				$producto->unidad_medida_id,
				$producto->cantidad,
				$producto->name_detalle,
				$producto->total_existencia
			);	
		}*/
	}

	public function insertItems($id_detalle,$id_unidad,$neutro,$adicional,$eliminado,$codigo_producto,$cantidad,$precio_adicional){
		$this->sucursales_model->setPedidoDetalleMateria($id_detalle,$id_unidad,$neutro,$adicional,$eliminado,$codigo_producto,$cantidad,$precio_adicional);

	}

	public function getItemsByCodigo2($sucursal,$codigo){
		$data = $this->sucursales_model->getItemsByCodigo2($sucursal,$codigo);
		return $data;
	}

	public function ConvertUnidades2($Id_Sucursal,$Id_Producto,$unidadAConvert,$unidadDeConvert,$cantidadAConvert,$codigo_material,$total_existencia)
	{

		$datosEquivalentes = $this->convert_model->getDatosEquivalentes($unidadAConvert,$unidadDeConvert);
		foreach ($datosEquivalentes as $value) {
			$valor =  $value['cantidad_equivalencia'];
			$resultConvert = $cantidadAConvert * $valor;
		}		
		$this->Reducir_Inventario($Id_Sucursal,$Id_Producto,$resultConvert,$total_existencia);		
	}

	// Descuento Parcial o Total del Inventario Por Sucursal y Codigo Producto
	function Reducir_Inventario($Id_Sucursal,$Id_Producto,$Valor_Descuento,$total_existencia){
		$reduccion = $total_existencia - $Valor_Descuento ;
		echo $Id_Producto." Inventario : ".$total_existencia . " - ".$Valor_Descuento. " = ". ($total_existencia-$Valor_Descuento);
		echo "<br>";
		$this->sucursales_model->setReduccionInventario($Id_Sucursal,$Id_Producto,$reduccion);		
	}


	// para los ingredientes en laorden
	function getProductoIngredientes($sucursal,$id_producto){
		$info = $this->sucursales_model->getProductoItems($sucursal,$id_producto);	
		//foreach ($info as $value) {
		//	echo $value->name_detalle;
		//}
		echo json_encode($info);
	}

	// para los ingredientes en laorden
	function getAdicionalesBySucursal($sucursal){
		$info = $this->sucursales_model->getAdicionalesBySucursal($sucursal);	
		echo json_encode($info);
	}
	// Quitar ingrediente en el producto
	function getIngredienteByCodigo($codigo){
		$info = $this->sucursales_model->getIngredienteByCodigo($codigo);	
		echo json_encode($info);
	}
	

	function getAdicionalesByCodigo($codigo){
		$info = $this->sucursales_model->getAdicionalesByCodigo($codigo);	
		echo json_encode($info);
	}

	// Buscar precio de Adicional
	function getPrecioAdicionalByCodigo($codigo){
		$info = $this->sucursales_model->getAdicionalesByCodigo($codigo);	
		echo json_encode($info);
	}



	//----------Funciones para pantalla despacho

	public function update_despacho()
	{
		$this->sucursales_model->update_despacho($_POST);
	}

	public function despacho_view($id_sucursal)
	{
		$data['idSucursal'] = $id_sucursal;
		$data['datoSucursal'] = $this->sucursales_model->getDatosSucursal($id_sucursal);	
		$this->load->view('backend/sucursales/Vdespacho.php',$data);
	}

	public function despacho_view_master($id_sucursal)
	{
		$data['idSucursal'] = $id_sucursal;
		$data['pedidos'] = $this->sucursales_model->getPedidosDespachoBySucursal($id_sucursal);
		$this->load->view('backend/sucursales/master.chef.php',$data);
	}
	

	// Despachar pedido
	function despacharPedido($id_orden,$id_sucursal,$nodo){
		$this->sucursales_model->despacharPedido($id_orden,$id_sucursal,$nodo);
	}

	//-------------------------Funcione para pantalla de caja

	public function caja_view($id_sucursal)
	{
		$data['idSucursal'] = $id_sucursal;
		$data['datoSucursal'] = $this->sucursales_model->getDatosSucursal($id_sucursal);
		$data['pedidos'] = $this->sucursales_model->getPedidosDespachoBySucursal($id_sucursal);	
		$this->load->view('backend/sucursales/Vcaja.php',$data);
	}


	public function getEstadoMesa( $numero_mesa , $id_sucursal ){
		$data =  $this->sucursales_model->getEstadoMesa( $numero_mesa , $id_sucursal );

		if($data){
			echo $data[0]['id_pedido'];
		}
		
	}
}
