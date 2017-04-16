<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clogs extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/logs/logs_model');	
	}

	public function setLog($proceso,$sucursal,$usuario){
		$this->logs_model->setLog($proceso,$sucursal,$usuario);	
	}

	public function index()
	{	
		$data['login_log'] = $this->logs_model->getAllLogs();	
		$this->load->view('backend/logs/Vindex.php',$data);
	}
}