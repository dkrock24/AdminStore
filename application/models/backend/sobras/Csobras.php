<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csobras extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/sobras/sobras_model');			
	}

	public function index()
	{	
		//var_dump($_SESSION);
		$data['datosSobras'] = $this->sobras_model->getDataSobras();
		$data['unidadMedida'] = $this->sobras_model->getUnidadMedida();
		$data['sucursales'] = $this->sobras_model->getSucursales();	
		$this->load->view('backend/sobras/Vsobras.php', $data);
	}
	
	public function onlySave()
	{	
	
		$data['unidadMedida'] = $this->sobras_model->getUnidadMedida();
		$data['sucursales'] = $this->sobras_model->getSucursales();	
		$this->load->view('backend/sobras/onlySaveSobras.php', $data);
	}

	public function save_sobras()
	{
		 $this->sobras_model->save_sobras($_POST);
	}

	public function viewSobras($sobrasID)
	{	
		$data['datosSobras'] = $this->sobras_model->viewSobras($sobrasID);
		$this->load->view('backend/sobras/VviewSobras.php',$data);

	}
	
	public function approved_sobras()
	{
		 $this->sobras_model->approved_sobras($_POST);
	}

	public function disapproved_sobras()
	{
		 $this->sobras_model->disapproved_sobras($_POST);
	}

}
