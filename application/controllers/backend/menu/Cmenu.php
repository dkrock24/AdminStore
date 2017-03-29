<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmenu extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/menu/menu_model');			
	}

	public function index()
	{	
		
		$menu['menu'] =  $this->menu_model->getMenu1();			
		$this->load->view('backend/menu/Vmenu.php',$menu);
	}
	public function saveMenu()
	{
		$this->menu_model->saveMenu($_POST);	
	}
	public function saveSubMenu()
	{
		$this->acceso_model->saveSubMenu();	
		return 1;
	}

	public function updateCargo()
	{
		$this->acceso_model->updateCargo();	
	}
	public function deleteCargo()
	{
		$this->acceso_model->deleteCargo();	
		return 1;
	}

	public function accesoRol()
	{
		$this->acceso_model->getAccesoRol($_POST);	
		return 1;
	}

	public function guardar_usuario(){
		 $this->usuarios_model->save_user($_POST);
	}
	public function miPerfil(){
		$data['perfil'] = $this->menu_model->getPerfil();

		$this->load->view('backend/perfil/Vindex.php',$data);
	}
	public function cambiarPassword(){
		
		$this->load->view('backend/perfil/VchangePassword.php');
	}
	public function cambiarAvatar(){
		$data['avatar'] = $this->menu_model->getAvatar();
		$data['avatarPersonal'] = $this->menu_model->getAvatarPersonal();
		$data['perfil'] = $this->menu_model->getPerfil();

		$this->load->view('backend/perfil/VchangeAvatar.php',$data);
	}

}
