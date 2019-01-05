<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');		
		$this->load->model('backend/login/login_model');
		$this->load->model('backend/logs/logs_model');	
		
	}


	public function index()
	{		
		$configuracion['lib_login'] =  $this->login_model->laodLib("login","header");	
		$configuracion['config'] =  $this->login_model->loadConfig("login");
		$configuracion['empresa'] =  $this->login_model->empresa();
		$this->load->view('backend/login.php',$configuracion);
		
	}
	public function autenticacion(){
	    
	    date_default_timezone_set('America/El_Salvador');
		
		//echo base_url();
		if(isset($_SESSION['usuario']) and isset($_SESSION['password']))
		{
			$autenticar['login'] =  $this->login_model->login($_SESSION['usuario'],$_SESSION['password']);
		}else{							
			$autenticar['login'] =  $this->login_model->login($_POST['usuario'],$_POST['password']);
		}		

		if($autenticar['login']==0){
		
			$this->index();
		}else{	
		
			foreach ($autenticar['login'] as $value) {
				
				$this->home($value->rol,$value->id_usuario);
			}			
		}
	}

	public function home($rol,$idUsuario){

			$_SESSION['idUser']		=$idUsuario;
		
			if($_POST)
			{
				$this->logs_model->setLog(1,null,$idUsuario);	
				$_SESSION['usuario'] 	= $_POST['usuario'];
				$_SESSION['password'] 	= $_POST['password'];
			}	

			$configuracion['lib_login'] = $this->login_model->laodLib("dashboard","header");	
			$configuracion['menu'] 		= $this->login_model->menu($rol);	
			$configuracion['submenu']	= $this->login_model->submenu($rol);
			$configuracion['empresa'] 	= $this->login_model->empresa();	
			$configuracion['usuario'] 	= $this->login_model->getUserByID($idUsuario);	
			$configuracion['sucursal'] 	= $this->login_model->getSucursal($idUsuario);		


		

		$this->load->view('backend/home/home',$configuracion);	
	}

	public function salir(){
		//session_start();
		$this->index();
			
		session_destroy();
	}
}
