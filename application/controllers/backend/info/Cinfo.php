<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cinfo extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/info/info_model');			
	}

	public function index()
	{	
		$sistema['info'] =  $this->info_model->getInfo();		
		$this->load->view('backend/info/Vinfo.php',$sistema);
	}
	public function update(){
		$sistema['info'] =  $this->info_model->getInfo();
		$this->load->view('backend/info/VinfoUpdate.php',$sistema);
	}
	public function saveUpdate(){		
		//var_dump($_POST);
		//exit();
		$this->info_model->setInfo($_POST);
		//$sistema['info'] =  $this->info_model->getInfo();
		//$this->load->view('backend/info/VinfoUpdate.php',$sistema);
	}
	
}
