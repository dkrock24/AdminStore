<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class canimacion extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		
		
		$this->load->database('default');	
		$this->load->model('backend/animacion/Animacion_model');			
	}

	public function index()
	{	
		//$sistema['info'] =  $this->info_model->getInfo();
		$this->load->view('backend/animacion/Vanimacion.php');
	}
	
}
