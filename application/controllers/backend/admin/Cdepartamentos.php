<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cdepartamentos extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/admin/departamentos_model');
		$this->load->model('backend/admin/pais_model');			
	}

	public function index()
	{		
		$data['departamentos'] =  $this->departamentos_model->getDepartamentos();
		$this->load->view('backend/admin/Vdepartamentos.php',$data);
	}
	public function crear()
	{
		$data['paises'] 		=  $this->pais_model->getPaises();
		$this->load->view('backend/admin/VDepartamentosCrear.php',$data);
	}
	public function editar($id_departamento)
	{
		$data['departamento'] =  $this->departamentos_model->getByID($id_departamento);
		$data['paises'] = $this->pais_model->getPaises();
		$this->load->view('backend/admin/VDepartamentosEditar.php',$data);
	}
	public function saveUpdate($id_departamento)
	{
		$data['departamento'] =  $this->departamentos_model->saveUpdate($_POST,$id_departamento);
	}
	public function delete($id_departamento)
	{
		$this->departamentos_model->delete($id_departamento);
	}
	public function saveDepartamento(){		
		$this->departamentos_model->save($_POST);
	}
}
