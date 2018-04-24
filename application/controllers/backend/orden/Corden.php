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
		$html .='<div class="panel panel-default">';
		$html .='<div class="panel-body">';
		$html .='<div class="table-responsive">';
		$html .='<table class="table table-condensed">';
		$html .='<thead>';
		$html .='<tr>';
		$html .='<td><strong>#</strong></td>';
		$html .='<td><strong>Producto</strong></td>';
		$html .='<td class="text-center"><strong>Categoria</strong></td>';
		$html .='<td class="text-center"><strong>Precio</strong></td>';
		$html .='<td class="text-right"><strong>Precio 2</strong></td>';
		$html .='<td class="text-right"><strong>Acciones</strong></td>';
		$html .='</tr>';
		$html .='</thead>';
		$html .='<tbody>';

				foreach ($data as $value) {									
			
		            $html .='<tr><td>'. $contador .'</td>';
					$html .='<td>'. $value->nombre_producto .'</td>';
					$html .='<td class="text-center">'. $value->nombre_categoria_producto .'</td>';
					$html .='<td class="text-center">'. $value->numerico1 .'</td>';
					$html .='<td class="text-right">'. $value->numerico1 .'</td>';
					$html .='<td class="text-right"><button class="btn btn-success btn-xs">Agregar</button><a href="#" class="viewProducto" id="'.$value->id_producto.'"  onclick="myFunction('.$value->id_producto.')">Ver</a></td>';
					$html .='</tr>';

					$contador++;
				}

								$html .='</tbody></table></div></div></div>';

		echo $html;
		//echo json_encode( $data);
	}
}