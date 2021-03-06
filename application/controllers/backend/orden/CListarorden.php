<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CListarorden extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/orden/orden_model');	
		$this->load->model('backend/sucursales/Sucursales_model');	
		$this->load->model('backend/sucursales/sucursales_model');		
	}

	public function index(){

		session_start();
		if(!isset($_SESSION['idUser'])){
			$this->load->view('backend/login.php');
		}
		$data['sucursales'] = $this->Sucursales_model->getSucursalesByUser($_SESSION['idUser']);
		$sucursales = array();
		if($data['sucursales'])
		{
			foreach ($data['sucursales'] as $value) {
				$sucursales[] = $value->id_sucursal;
			}
			$data['ordenes'] = $this->orden_model->listarOrdenes( $sucursales );
		}else{
			$data['ordenes'] = null;
		}
		

		

		$this->load->view('backend/orden/VListaorden.php',$data);
	}

	// Detalle de cada orden
	public function detalle( $idOrden ){

		$data['orden'] = $this->orden_model->detaelleOrden( $idOrden );
		$data['estados']	= $this->sucursales_model->getEstados();

		$this->load->view('backend/orden/VordenDetalle.php',$data);
	}

	//Impresion de Orden
	public function impresion( $idOrden ){

		$data['orden'] = $this->orden_model->detaelleOrden( $idOrden );
		$data['estados']	= $this->sucursales_model->getEstados();
		
		$this->load->view('backend/orden/VimpresionOrden.php',$data);
	}

	public function actualizarOrden( ){

		$orden = $_POST;
		$this->orden_model->actualizarOrden( $orden );
		
		return $this->detalle( $orden['idOrden'] );
		//$this->load->view('backend/orden/VordenDetalle.php',$data);
	}

	public function eliminarOrden( $id_orden ){

		$this->orden_model->eliminarOrden( $id_orden );
		
		return $this->index();
		//$this->load->view('backend/orden/VordenDetalle.php',$data);
	}


	
}