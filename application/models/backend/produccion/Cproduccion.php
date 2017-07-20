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
		//------Variables para hacer la convercion de la cantida que se envia
		$unidadAConvert = $_POST['unidadAConvert'];
		$maximoExistencia = $_POST['maximo'];
		$unidadDeConvert = $_POST['unidadMedida'];
		$cantidadAConvert = $_POST['catindadEnvio'];
		$IdCatoloInvetario = $_POST['idInventarioMaterial'];
		$idCentroP = $_POST['idCproduccion'];
		//-------- fin codigo--------

		//------Variables para obtener datos de sucursal a la que se envia el materiales
		$sucursalEnvio = $_POST['sucursalId'];
		$codigoMaterial = $_POST['codigoMaterial'];
		//--- Fin codigo

		//-------Hacemos referenci al controlador de convercion
		require_once(APPPATH.'controllers/backend/convert/Cconvert.php'); //include controller
        $aObj = new Cconvert();  //create object 
        //----fin codigo

        //-- metodos para extraer informacion de material y existencias
        $getDataMaterialSend = $aObj->getDataMaterialInventario($codigoMaterial,$sucursalEnvio);// get data material to send from CP
        $actualExistencia = $aObj->getTotalExistencia($codigoMaterial,$sucursalEnvio);// get total Existencia sucursal
        $actualExistenciaCP = $aObj->getTotalExistencia($codigoMaterial,$idCentroP);// get total Existencia CP
		//----fin codigo

        $resultConvert = $aObj->ConvertUnidades($unidadAConvert,$unidadDeConvert,$cantidadAConvert);
        if($maximoExistencia < $resultConvert) 
        {
        	echo "La cantidad enviada sobrepasa la existencia";
        	exit();
        }

        $envioResult = $this->produccion_model->saveEnvio($_POST);
		if ($envioResult) 
		{

		 	$resMaterial = $aObj->restToExistencia($actualExistenciaCP['total_existencia'], $resultConvert, $IdCatoloInvetario);

		 	$sumMaterial = $aObj->sumToExistencia($actualExistencia['total_existencia'], $resultConvert, $getDataMaterialSend['id_inventario_sucursal']);
		 	//var_dump($sumMaterial);

		} 
		echo "Envio realizado correctamente";
	}

	public function saveEnvioDos()
	{
		$envioResult = $this->produccion_model->saveEnvioDos($_POST);
		echo "Envio realizado correctamente";
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

	public function vieListEnvio($cproduccionID)
	{	
		$data['cproduccionID'] = $cproduccionID;	
		$data['unidadMedida'] = $this->produccion_model->getAllUnidadMedida();
		$data['sucursales'] = $this->produccion_model->getAllSucursales();
		$this->load->view('backend/produccion/VviewListEnvios.php',$data);

	}

	public function catalogo_materiales_inventario()
	{		
		$data['catalogoMateriales'] = $this->produccion_model->getCatalogoMateriales($_GET);
		$this->load->view('backend/produccion/autoSearch.php',$data);
	}
	//--------------------------------End mantenimiento de catalogos---------------

}
