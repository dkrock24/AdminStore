<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClongPolling extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		//$this->load->model('backend/sucursales/sucursales_model');	
		//$this->load->model('backend/convert/convert_model');
		//$this->load->model('backend/login/login_model');		
	}

	public function index()
	{	
		$response['success'] = 0;
		$response['feed'] = 1;
		
		echo json_encode($response);
	}
}