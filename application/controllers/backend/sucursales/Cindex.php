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
	}

	public function index()
	{	
		session_start();
		$var_id_usuario = $_SESSION['idUser'];
		$data['sucursales'] = $this->sucursales_model->getSucursalesByUser($var_id_usuario);		

		$this->load->view('backend/sucursales/Vindex.php',$data);
	}
	public function cargar_sucursal($id_sucursal){
		$data['sucursales'] = $this->sucursales_model->getSucursalesById($id_sucursal);		
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
			$valor = $this->ConvertUnidades($producto->Unidad2,$producto->unidad_medida_id,$producto->cantidad,$producto->name_detalle);
			echo $valor;		
		}	
	}

	public function ConvertUnidades($unidadAConvert,$unidadDeConvert,$cantidadAConvert,$codigo_material)
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
		$estado = $this->getCantidadExistencia($unidadAConvert,$resultConvert,$codigo_material);		
		return $estado;
	}

	public function getCantidadExistencia($unidadAConvert,$resultConvert,$codigo_material){
		$aprobado=0;
		//echo $resultConvert;
		$info = $this->sucursales_model->getValidarDescuentoInventario($codigo_material);
		foreach ($info as $value) {
			if($value->id_unidad_medida==$unidadAConvert)
			{
				if($value->total_existencia>=$resultConvert){
					$aprobado=1;
				}
				else
				{
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
		$id_pedido = $this->sucursales_model->InsertPedido($Mesa,$Id_Mesero,$Id_Sucursal);
		echo $id_pedido;
	}
	// Inserta El Detalle de La Orden
	public function GuardarOrdenDetalle($Mesa,$Id_Mesero,$Id_Producto,$Precio,$Id_Sucursal,$Id_Pedido){
		$id_pedido_detalle = $this->sucursales_model->InsertPedidoDetalle($Mesa,$Id_Mesero,$Id_Producto,$Precio,$Id_Sucursal,$Id_Pedido);
		$id_pedido_detalle;
		$this->GuardarOrdenDetalleMaterial($Id_Sucursal,$Id_Producto,$id_pedido_detalle);
	}
	// Insertar Items de Cada Producto como Detalle de La Orden
	public function GuardarOrdenDetalleMaterial($Id_Sucursal,$Id_Producto,$id_pedido_detalle){
		$info = $this->sucursales_model->getProductoItems($Id_Sucursal,$Id_Producto);	
		$data="";
		foreach ($info as $producto) 
		{
			$this->sucursales_model->setPedidoDetalleMateria(
				$id_pedido_detalle,
				$producto->unidad_medida_id,
				$producto->nombre_producto,
				$producto->name_detalle,
				$producto->cantidad
			);

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
	function getAdicionalesByCodigo($codigo){
		$info = $this->sucursales_model->getAdicionalesByCodigo($codigo);	
		echo json_encode($info);
	}

	
	
	
}
