<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csoporte extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
	}

	public function index(){
		$this->load->view('backend/soporte/soporte.php');
	}
}