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
	public function envioMateriales($idSucursalMaterial,$tipoUnidad,$codigoMaterial)
	{		
		$data['dataMaterial'] = $this->produccion_model->getDataMaterial($idSucursalMaterial);
		$data['unidadMedida'] = $this->produccion_model->getUnidadMedida($tipoUnidad);
		$data['sucursales'] = $this->produccion_model->getSucursales($codigoMaterial);
		$this->load->view('backend/produccion/VaddEnvio.php', $data);
	}	

	public function saveEnvio()
	{
		$unidadAConvert = $_POST['unidadAConvert'];
		$maximoExistencia = $_POST['maximo'];
		$unidadDeConvert = $_POST['unidadMedida'];
		$cantidadAConvert = $_POST['catindadEnvio'];
		$IdCatoloInvetario = $_POST['idInventarioMaterial'];

		require_once(APPPATH.'controllers/backend/convert/Cconvert.php'); //include controller
        $aObj = new Cconvert();  //create object 

        $resultConvert = $aObj->ConvertUnidades($unidadAConvert,$unidadDeConvert,$cantidadAConvert); 
        if($maximoExistencia < $resultConvert) 
        {
        	echo "La cantidad enviada sobrepasa la existencia";
        	exit();
        }
         echo $resultConvert;
        $envioResult = $this->produccion_model->saveEnvio($_POST);
		if ($envioResult) 
		{
		 	$resultConvert = $aObj->restToExistencia($maximoExistencia, $resultConvert, $IdCatoloInvetario);

		} 
		return "Envio realizado correctamente";
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
