<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccaja extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/sucursales/caja_model');	
		$this->load->model('backend/convert/convert_model');
		$this->load->model('backend/login/login_model');		
	}

	public function save_compras()
	{	
		$this->caja_model->save_compras($_POST);	

	}

	public function caja_view($id_sucursal)
	{
		$data['idSucursal'] = $id_sucursal;
		$data['datoSucursal'] = $this->caja_model->getDatosSucursal($id_sucursal);
		$data['pedidos'] = $this->caja_model->getPedidosDespachoBySucursal($id_sucursal);	
		$this->load->view('backend/sucursales/Vcaja.php',$data);
	}

	public function cerrar_cuenta()
	{	
		$this->caja_model->cerrar_cuenta($_POST);	
	}

	public function anular_cuenta()
	{	

		$idPedido = $_POST['idpedidounico'];
		$nota = $_POST['commentAnulacion'];
		$grupo = "CUENTA";
		$accion = "anulacion";
		$existPedido = $this->caja_model->getPedidoCuenta($idPedido);
		if($existPedido[0]['numPedidos']== 0)
		{
			$this->caja_model->anular_cuenta_insert($_POST);
			$this->caja_model->addevento_historial($idPedido, $nota, $grupo, $accion);	
		}
		else
		{
			$this->caja_model->anular_cuenta_update($_POST);
			$this->caja_model->addevento_historial($idPedido, $nota, $grupo, $accion);
		}
		
	}


	public function addevento_historial($idPedido, $nota, $grupo, $accion)
	{	
		
		$this->caja_model->addevento_historial($_POST);
		
	}
		
}
