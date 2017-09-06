<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cimpuesto extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/admin/impuesto_model');	
		$this->load->model('backend/admin/departamentos_model');
		$this->load->model('backend/admin/pais_model');		
		$this->load->model('backend/admin/sucursales_model');
	}

	//Impuesto Por Sucursal

	public function index()
	{		
		$data['impuestos'] =  $this->impuesto_model->getImpuestos();
		$data['impuestosPais'] =  $this->impuesto_model->getImpuestosPais();
		$this->load->view('backend/admin/Vimpuestos.php',$data);
	}
	public function crear()
	{		
		$data['paises'] 		=  $this->pais_model->getPaises();
		$data['departamentos'] 	=  $this->departamentos_model->getDepartamentos();
		$data['categorias'] =  $this->impuesto_model->getCategoriaProductos();
		$this->load->view('backend/admin/VimpuestosCrear.php',$data);
	}
	public function saveImpuesto()
	{		
		$data['sucursales'] 	=  $this->impuesto_model->saveImpuesto($_POST);		
	}
	public function editar($id)
	{		
		$data['paises'] 		=  $this->pais_model->getPaises();
		$data['departamentos'] 	=  $this->departamentos_model->getDepartamentos();
		$data['impuestos'] 		=  $this->impuesto_model->getImpuestosByID($id);

		
		$this->load->view('backend/admin/VimpuestosEditar.php',$data);
	}
	public function updateImpuesto($id_impuesto){
		$data['sucursales'] 	=  $this->impuesto_model->updateImpuesto($_POST,$id_impuesto);		
	}

	//Impuesto Por Pais

	public function crearImpuestoPais(){
		$data['paises'] 		=  $this->pais_model->getPaises();
		$data['departamentos'] 	=  $this->departamentos_model->getDepartamentos();
		$this->load->view('backend/admin/VimpuestosPaisCrear.php',$data);
	}
	public function saveImpuestoPais()
	{		
		$data['pais'] 	=  $this->impuesto_model->saveImpuestoPais($_POST);		
	}
	public function editarImpuestoPais($id)
	{		
		$data['paises'] 		=  $this->pais_model->getPaises();		
		$data['impuestos'] 		=  $this->impuesto_model->getImpuestosPaisById($id);

		
		$this->load->view('backend/admin/VimpuestosPaisEditar.php',$data);	
	}
	public function updateImpuestoPais($id){
		$this->impuesto_model->updateImpuestoPais($_POST,$id);
	}

	public function deleteImpuestoPais($id){
		$this->impuesto_model->deleteImpuestoPais($id);
	}
	public function deleteImpuestoSucursal($id){
		$this->impuesto_model->deleteImpuestoSucursal($id);
	}

	

	

}

