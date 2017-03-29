<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cacceso extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/acceso/acceso_model');			
	}

	public function index()
	{	
		
		$acceso['menu'] =  $this->acceso_model->getMenu();		
		$acceso['roles'] =  $this->acceso_model->getRoles();	
		$acceso['cargos'] =  $this->acceso_model->getCargos();		
		
		$this->load->view('backend/acceso/Vacceso.php',$acceso);
	}
	public function updateRol()
	{
		$this->acceso_model->updateRol();	
	}
	public function deleteRol()
	{
		$this->acceso_model->deleteRol();	
		return 1;
	}

	public function updateCargo()
	{
		$this->acceso_model->updateCargo();	
	}
	public function deleteCargo()
	{
		$this->acceso_model->deleteCargo();	
		return 1;
	}

	public function accesoRol()
	{
		$this->acceso_model->getAccesoRol($_POST);	
		return 1;
	}

	

	public function guardar_usuario(){
		 $this->usuarios_model->save_user($_POST);
	}
}
