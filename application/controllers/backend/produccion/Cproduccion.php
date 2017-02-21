<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cproduccion extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/produccion/produccion_model');			
	}

	public function index()
	{		
		$data['cproduccion'] = $this->produccion_model->getCentroProducion();
		$data['produccion'] = $this->produccion_model->getCentroProduccion();
		$this->load->view('backend/produccion/VcProduccion.php', $data);
	}

	public function indexDos($cpID)
	{	
		$data['cpID'] = $cpID;	
		$data['materiales'] = $this->produccion_model->inventarioBySucursalDetall($cpID);
		$data['empleados'] = $this->produccion_model->listEmpleadosCP($cpID);
		$data['produccion'] = $this->produccion_model->getCentroProduccion();
		$data['envios'] = $this->produccion_model->getListaEviosByCP($cpID);
		$this->load->view('backend/produccion/Vproduccion.php', $data);
	}
	public function listEmpleadosCP()
	{		
		$data['empleados'] = $this->produccion_model->listEmpleadosCP();
		$this->load->view('backend/produccion/listEmpleadoCP.php', $data);
	}
	public function envioMateriales($idSucursalMaterial)
	{		
		$data['dataMaterial'] = $this->produccion_model->getDataMaterial($idSucursalMaterial);
		$data['unidadMedida'] = $this->produccion_model->getUnidadMedida($idSucursalMaterial);
		$data['sucursales'] = $this->produccion_model->getSucursales();
		$this->load->view('backend/produccion/VaddEnvio.php', $data);
	}	

	public function saveEnvio()
	{
		 $this->produccion_model->saveEnvio($_POST);
		 $this->produccion_model->UpdateExistencia($_POST);
	}

	public function viewEmpleado($empleadoID)
	{	
		$data['empleado'] = $this->produccion_model->getEmpleadoById($empleadoID);
		$this->load->view('backend/produccion/VviewEmpleados.php',$data);

	}

	public function viewEnvio($envioID)
	{	
		$data['enviosData'] = $this->produccion_model->getEnvioById($envioID);
		$this->load->view('backend/produccion/VviewEnvios.php',$data);

	}

	public function delete_empleado()
	{	
		$this->produccion_model->delete_empleado($_POST);
	
	}
}
