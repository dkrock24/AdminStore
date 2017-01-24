<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpais extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/admin/pais_model');			
	}

	public function index()
	{		
		$data['paises'] =  $this->pais_model->getPaises();
		$this->load->view('backend/admin/Vpais.php',$data);
	}
	public function crear()
	{	
		$this->load->view('backend/admin/VPaisCrear.php');
	}
	public function editar($id_pais)
	{	
		$data['paises'] =  $this->pais_model->getPaisByID($id_pais);
		$this->load->view('backend/admin/VPaisEditar.php',$data);
	}
	public function saveUpdate($id_pais)
	{	
		$data['paises'] =  $this->pais_model->saveUpdate($_POST,$id_pais);		
	}
	public function delete($id_pais)
	{
		$this->pais_model->delete($id_pais);
	}
	public function savePais(){
		$this->pais_model->savePais($_POST);
	}
}
