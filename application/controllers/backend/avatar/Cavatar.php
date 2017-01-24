<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cavatar extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/avatar/avatar_model');			
	}

	public function index()
	{	
		//$sistema['info'] =  $this->info_model->getInfo();
		$this->load->view('backend/avatar/Vavatar.php');
	}
	
}
