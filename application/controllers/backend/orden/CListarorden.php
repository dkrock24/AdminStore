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
	}

	public function index(){

		session_start();
		$data['sucursales'] = $this->Sucursales_model->getSucursalesByUser($_SESSION['idUser']);
		$sucursales = array();
		foreach ($data['sucursales'] as $value) {
			$sucursales[] = $value->id_sucursal;
		}

		$data['ordenes'] = $this->orden_model->listarOrdenes( $sucursales );

		$this->load->view('backend/orden/VListaorden.php',$data);
	}

	public function detalle( $idOrden ){

		$data['orden'] = $this->orden_model->detaelleOrden( $idOrden );

		$this->load->view('backend/orden/VordenDetalle.php',$data);
	}
}