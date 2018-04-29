<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corden extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/orden/orden_model');			
		$this->load->model('backend/sucursales/Sucursales_model');
		$this->load->model('backend/productos/Productos_model');
	}

	public function index(){
		session_start();
		$data['sucursales'] = $this->Sucursales_model->getSucursalesByUser($_SESSION['idUser']);
		$data['categorias'] = $this->Productos_model->categoria();
		
		$this->load->view('backend/orden/Vorden.php', $data);
	}

	public function getProductoById($id){
		if(isset($id)){
			$data = $this->orden_model->getProductoById($id);
		}
		echo json_encode( $data );
	}

	public function delete($id){
		session_start();
			$num = 0;

				foreach (array_keys($_SESSION['cart']) as $key) {
										
					foreach ($_SESSION['cart'][$key] as $keys => $value) {
						if($value->id_producto == $id){
							unset($_SESSION['cart'][$key][$keys]);							
						}
					}
					
				}

			$this->showCart();
	}

	public function showCart(){

		$html1 = '';
		$total = 0;
		$shipping = 0;
		$subtotal = 0;
		$contadorTabla =1;
		$precio_minimo=0;

		foreach ($_SESSION['cart'] as $value) {

			foreach ($value as $demo) {

				if($demo->ck =='true'){
					
					if($demo->precio_minimo !=0){
						$total = $demo->precio_minimo * $demo->cnt;
						$subtotal +=  $demo->precio_minimo * $demo->cnt;
					}else{
						$total = $demo->numerico1 * $demo->cnt;
						$subtotal +=  $demo->numerico1 * $demo->cnt;
					}
					
					$precio_minimo = $demo->precio_minimo;
				}else{
					$subtotal +=  $demo->numerico1 * $demo->cnt;
					$total = $demo->numerico1 * $demo->cnt;
					$precio_minimo = 0;
				}				

				$html1 .= '<tr>';
				$html1 .= '<td>'. $contadorTabla .'</td>';
				$html1 .= '<td>'. $demo->nombre_producto .'</td>';
				$html1 .= '<td class="text-center">'. $demo->numerico1 .'</td>';
				$html1 .= '<td class="text-center">'. $precio_minimo .'</td>';
				$html1 .= '<td class="text-center">'. $demo->cnt .'</td>';
				$html1 .= '<td class="text-right">'. $total .'</td>';
				$html1 .= '<td class="text-right"><a href="#" class="btn btn-default btn-xs" onclick="deleteItem('.$demo->id_producto.')">Eliminar</a></td>';
				$html1 .= '</tr>'; 	
				$contadorTabla++;
			}					
		}	
		$html1 .= '<tr>';
		$html1 .= '<td class="highrow"></td>';
		$html1 .= '<td class="highrow"></td>';
		$html1 .= '<td class="highrow"></td>';
		$html1 .= '<td class="highrow"></td>';

		$html1 .= '<td class="highrow text-center"><strong>Subtotal</strong></td>';
		$html1 .= ' <td class="highrow text-right">'. $subtotal .'</td>';
		$html1 .= '<td class="highrow"></td>';
		$html1 .= '</tr>'; 

		$html1 .= '<tr>';
		$html1 .= '<td class="emptyrow"></td>';
		$html1 .= '<td class="emptyrow"></td>';
		$html1 .= '<td class="emptyrow"></td>';
		$html1 .= '<td class="emptyrow"></td>';
		$html1 .= '<td class="emptyrow text-center"><strong>Shipping</strong></td>';
		$html1 .= '<td class="emptyrow text-right">'. $shipping .'</td>';
		$html1 .= '</tr>';

		$html1 .= '<tr>';
		$html1 .= '<td class="emptyrow"></td>';
		$html1 .= '<td class="emptyrow"></td>';
		$html1 .= '<td class="emptyrow"></td>';
		$html1 .= '<td class="emptyrow"></td>';
		$html1 .= '<td class="emptyrow text-center"><strong>Total</strong></td>';
		$html1 .= '<td class="emptyrow text-right">'. $subtotal .'</td>';
		$html1 .= '</tr>';
                                  
          
		echo $html1;
	}

	public function agregar($datos,$cantidad,$ck){
			
		session_start();
		$data = $this->orden_model->getProductoById($datos,$cantidad,$ck);
		var_dump($data);
		
		if( !isset( $_SESSION['cart'] ) )
		{
			$_SESSION['cart'] = array();
			array_push($_SESSION['cart'],$data);
		}else{
			array_push($_SESSION['cart'],$data);
		}

		$this->showCart();
	}

	public function buscar(){
		
		$data='';
		if($_POST['codProducto']!=null){
			$data = $this->orden_model->getByCodigo($_POST['codProducto']);
		}

		if($_POST['categoria']!=null){
			$data = $this->orden_model->getByCategoria($_POST['categoria']);
		}
		$contador =1;
		$html = '';
		$html .='<div class="panel panel-default gridBuscar">';
		$html .='<div class="panel-body">';
		$html .='<div class="table-responsive"><a href="#" class="btn btn-success btn-xs" onclick="cerrarBuscador()">Cerrar</a>';
		$html .='<table class="table table-condensed">';
		$html .='<thead>';
		$html .='<tr>';
		$html .='<td><strong>#</strong></td>';
		$html .='<td><strong>Producto</strong></td>';
		$html .='<td class="text-center"><strong>Categoria</strong></td>';
		$html .='<td class="text-center"><strong>Precio Sugerido</strong></td>';
		$html .='<td class="text-right"><strong>Precio Minimo</strong></td>';
		$html .='<td class="text-right"><strong>Cantidad</strong></td>';
		$html .='<td class="text-right"><strong>Acciones</strong></td>';
		$html .='</tr>';
		$html .='</thead>';
		$html .='<tbody>';

				foreach ($data as $value) {									
			
		            $html .='<tr><td>'. $contador .'</td>';
					$html .='<td>'. $value->nombre_producto .'</td>';
					$html .='<td class="text-center">'. $value->nombre_categoria_producto .'</td>';
					$html .='<td class="text-center">'. $value->numerico1 .'</td>';
					$html .='<td class="text-right">'. $value->precio_minimo .' <input type="checkbox" id="minimo'.$value->id_producto.'" name="minimo'.$value->id_producto.'" /></td>';
					$html .='<td class="text-right"><input type="number" id="producto'.$value->id_producto.'" value=1 min="1" name="producto'.$value->id_producto.'"/></td>';
					$html .='<td class="text-right"><a href="#" class="btn btn-success btn-xs" id="'.$value->id_producto.'" onclick="agregar('.$value->id_producto.')">Agregar</a><a href="#" class="btn btn-default btn-xs viewProducto" id="'.$value->id_producto.'"  onclick="myFunction('.$value->id_producto.')">Ver</a></td>';
					$html .='</tr>';

					$contador++;
				}

								$html .='</tbody></table></div></div></div>';

		echo $html;
		//echo json_encode( $data);
	}

	public function procesarOrden(){
		session_start();
		// Procesar Orden de Pedido

		//Datos Cliente desde le dorumlario
		if(isset($_POST) and isset($_SESSION['cart'])){
			$datos_cliente = $_POST;

			//Insertando a cliente
			$this->orden_model->saveOrden($_POST);


		}else{
			echo "No existen Datos que esar";
		}
		


		//Obteniendo orden de compra
		var_dump($_SESSION['cart']);


	}
}