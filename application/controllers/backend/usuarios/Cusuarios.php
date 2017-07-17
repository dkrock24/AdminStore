<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cusuarios extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/usuarios/usuarios_model');			
	}

	public function index()
	{		
		$data['cargos'] =  $this->usuarios_model->cargos();
		$data['roles'] =  $this->usuarios_model->roles();
		$data['avatar'] =  $this->usuarios_model->avatar();
		$data['usuario'] = $this->usuarios_model->getAllUsers();
		$data['sucursal'] = $this->usuarios_model->getAllSucursal();
		$data['departamentos'] = $this->usuarios_model->getAllDepartamentos();		
		$this->load->view('backend/usuarios/Vusuarios.php',$data);
	}
	public function guardar_usuario(){
		 $this->usuarios_model->save_user($_POST);
	}
	public function eliminar_usuario($id){
		$this->usuarios_model->eliminar_usuario($id);
	}
	public function editar_usuarios(){

	}

	public function userAdmin(){
		$data['cargos'] =  $this->usuarios_model->cargos();
		$data['roles'] =  $this->usuarios_model->roles();
		$data['avatar'] =  $this->usuarios_model->avatar();
		$data['usuario'] = $this->usuarios_model->getAllUsers();
		$data['sucursal'] = $this->usuarios_model->getAllSucursal();
		$this->load->view('backend/usuarios/VuserAdmin.php',$data);
	}

	public function getUsuarioByID($id_usuario){
		$data['cargos'] =  $this->usuarios_model->cargos();
		$data['roles'] =  $this->usuarios_model->roles();
		$data['avatar'] =  $this->usuarios_model->avatar();
		$data['usuario'] = $this->usuarios_model->getUsuarioByID($id_usuario);
		$this->load->view('backend/usuarios/VusuariosEdit.php',$data);
	}
	public function update_user()
	{
		//var_dump($_POST);
		$this->usuarios_model->update_user($_POST);	
		

	}
}
