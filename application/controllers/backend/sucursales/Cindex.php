<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cindex extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/sucursales/sucursales_model');	
		$this->load->model('backend/login/login_model');		
	}

	public function index()
	{	
		session_start();
		$var_id_usuario = $_SESSION['idUser'];
		$data['sucursales'] = $this->sucursales_model->getSucursalesByUser($var_id_usuario);		

		$this->load->view('backend/sucursales/Vindex.php',$data);
	}
	public function cargar_sucursal($id_sucursal){
		$data['sucursales'] = $this->sucursales_model->getSucursalesById($id_sucursal);		
		$this->load->view('backend/sucursales/VsucursalCargada.php',$data);
	}
	public function cargar_nodos($id_sucursal){
		$data['sucursales'] = $this->sucursales_model->getSucursalesByNodo($id_sucursal);	
		$data['id_sucursal'] = $id_sucursal;
		$this->load->view('backend/sucursales/VsucursalNodo.php',$data);
	}
	public function nodo($id_nodo,$id_sucursal){
		$data['sucursales'] = $this->sucursales_model->getSucursalByNodoId($id_nodo,$id_sucursal);	
		$data['id_sucursal'] = $id_sucursal;
		$this->load->view('backend/sucursales/VNodo.php',$data);
	}
	public function login($id_sucursal){
		session_start();
		//var_dump($_SESSION);
		//$data['sucursales'] = $this->sucursales_model->getSucursalByNodoId($id_nodo,$id_sucursal);	
		//$data['id_sucursal'] = $id_sucursal;
		$data['sucursales'] = $this->sucursales_model->getSucursalesById($id_sucursal);	
		$this->load->view('backend/sucursales/Vlogin.php',$data);
	}
	public function ordenes($id){

		session_start();
		//var_dump($_SESSION);
		if(isset($_POST))
		{
			if(isset($_POST['usuario'])){
				$_SESSION['uno'] = $_POST['usuario'];
				$_SESSION['dos'] = $_POST['password'];
				$_SESSION['id']  = $id;
			}
		}
		else
		{
			$_SESSION['uno'] 	= $_POST['usuario'];
			$_SESSION['dos'] 	= $_POST['password'];
			$_SESSION['id'] 	= $id;
		}	

		$data['sucursales'] 	= $this->sucursales_model->getSucursalesById($_SESSION['id']);	
		$data['productos']		= $this->sucursales_model->getProductosBySucursales($id);	
		$data['categorias']		= $this->sucursales_model->getCategorias();	
		$autenticar['login'] 	= $this->login_model->login($_SESSION['uno'],$_SESSION['dos']);


		if($autenticar['login']==0){
			$this->load->view('backend/sucursales/Vlogin.php',$data);			
		}else{	
			$this->load->view('backend/sucursales/Vordeness.php',$data);		
		}
		
	}
}
