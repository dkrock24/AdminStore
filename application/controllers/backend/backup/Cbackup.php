<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbackup extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/backup/backup_model');			
	}

	public function index()
	{	
		$info['backup'] =  $this->backup_model->getBackup();
		
		$this->load->view('backend/backup/Vbackup.php',$info);
	}

	public function restaurarBk()
	{	
		$info['backup'] =  $this->backup_model->getBackup();
		$this->load->view('backend/backup/VrestaurarBk.php',$info);
	}

	public function downloadBK(){
		$this->load->view('backend/backup/VdownloadBk.php');
	}
	
}
