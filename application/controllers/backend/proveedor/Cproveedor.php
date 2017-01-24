<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cproveedor extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/proveedor/proveedor_model');			
	}

	public function index()
	{	
		$data['sucursales'] = $this->proveedor_model->getSucursales();	
		$data['proveedor'] = $this->proveedor_model->getProveedor();
		$this->load->view('backend/proveedor/Vproveedor.php',$data);
	}

	public function addProveedor()
	{	
		//$data['sucursales'] = $this->proveedor_model->getSucursales();
		$this->load->view('backend/proveedor/VaddProveedor.php');
	}

	public function save_proveedor()
	{
		 $this->proveedor_model->save_proveedor($_POST);
	}

	public function delete_proveedor()
	{	
		$this->proveedor_model->delete_proveedor($_POST);
	
	}

	public function editProveedor($proveedorID)
	{	
		$data['proveedor'] = $this->proveedor_model->getProveedorByID($proveedorID);
		$this->load->view('backend/proveedor/VmodifiProveedor.php',$data);

	}

	public function viewProveedor($proveedorID)
	{	
		$data['proveedor'] = $this->proveedor_model->getProveedorByIDJoin($proveedorID);
		$this->load->view('backend/proveedor/VviewProveedor.php',$data);

	}

	public function update_proveedor()
	{
		$this->proveedor_model->update_proveedor($_POST);
	}


	public function proveedorBySucursal($sucursalID)
	{	
		$data['sucursalInfo'] = $this->proveedor_model->getSucursalById($sucursalID);
		$data['proveedorBySucursal'] = $this->proveedor_model->proveedorBySucursal($sucursalID);
		$this->load->view('backend/proveedor/listProveedoresBySucursal.php',$data);

	}

	public function viewAddProveedor($sucursalID)
	{	
		$data['sucursalID'] = $sucusalID;
		$data['proveedorBySucursal'] = $this->proveedor_model->proveedorBySucursal($sucursalID);
		$this->load->view('backend/proveedor/listProveedoresBySucursal.php',$data);

	}


	public function loadSucursales($proveedorID)
	{
		
		$data['proveedor'] = $this->proveedor_model->getProveedorByID($proveedorID);
		$data['sucursales'] = $this->proveedor_model->getSucursalesDinamic($proveedorID);
		$this->load->view('backend/proveedor/ListSucursales.php',$data);
	}

	public function associate_producto()
	{
		 $this->proveedor_model->associate_producto($_POST);
	}

	public function disassociate_producto()
	{
		 $this->proveedor_model->disassociate_producto($_POST);
	}

	public function quitar_proveedor_sucursal()
	{	
		$this->proveedor_model->quitar_proveedor_sucursal($_POST);
	
	}

}
