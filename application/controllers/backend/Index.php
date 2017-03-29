<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');		
		$this->load->model('backend/login/login_model');
		
	}

	public function demo(){
		echo "yes";
		exit();
	}

	public function index()
	{
		//exit();
		$configuracion['lib_login'] =  $this->login_model->laodLib("login","header");	
		$configuracion['config'] =  $this->login_model->loadConfig("login");
		$this->load->view('backend/login.php',$configuracion);
		
	}
	public function autenticacion(){
		session_start();
		
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
		//session_start();
		
		$_SESSION['idUser']		=$idUsuario;
		if($_POST)
		{
			$_SESSION['usuario'] 	= $_POST['usuario'];
			$_SESSION['password'] 	= $_POST['password'];
		}	

		$configuracion['lib_login'] = $this->login_model->laodLib("dashboard","header");	
		$configuracion['menu'] 		= $this->login_model->menu($rol);	
		$configuracion['submenu']	= $this->login_model->submenu($rol);
		$configuracion['empresa'] 	= $this->login_model->empresa();	
		$configuracion['usuario'] 	= $this->login_model->getUserByID($idUsuario);	

		$this->load->view('backend/home/home',$configuracion);	


	}

	public function salir(){
		
		$this->index();
			
		//session_destroy($_SESSION);
	}
}
