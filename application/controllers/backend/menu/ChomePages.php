<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChomePages extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/menu/menu_model');			
		$this->load->model('backend/menu/notas_model');	
	}

	public function index(){			
		$menu['menu'] 	=  $this->menu_model->getMenu();		
		$menu['icono'] 	=  $this->menu_model->getIcono();	
		$this->load->view('backend/menu/VhomePages.php',$menu);
	}

	public function saveHomeMenu(){			
		echo $valor = $this->menu_model->saveHomePageMenu($_POST);
		return json_encode($valor);
	}
	
	public function saveHomeSubMenu()
	{				
		echo $valor = $this->menu_model->saveHomeSubMenu($_POST);
		return json_encode($valor);
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

	//Guardar Las Notas De cada Menu
	public function saveNota(){		 
		$this->notas_model->saveNotas($_POST);
	}

	public function UpdateNota(){
		$this->notas_model->UpdateNota($_POST);
	}

	//load sub menu para editar
	public function loadSubMenu($id,$paginacion){
		$limit = 5;
		if ($paginacion!=0)
		{
			$page  = $paginacion; 
		}
		else
		{
			$page=1; 
		}
		$start_from = ($page-1) * $limit; 

		$valor['data_entradas'] = $this->menu_model->getMenuHome($id);
		$valor['cont_entradas'] = $this->menu_model->getCountEntradas($id);
		$valor['entradas'] = $this->menu_model->getEntradas($id,$start_from,$limit);
		$valor['paginacion'] = $paginacion;

		$this->load->view('backend/menu/Ventradas.php',$valor);
	}

	public function loadRecord($id_entrada){
		$valor['entradas'] = $this->menu_model->getEntradaByID($id_entrada);		
		$this->load->view('backend/menu/VentradasEdit.php',$valor);
	}

	// Elimina las Publicaciones por cada Entrada de Menu
	public function deleteEntrada(){
		$id_entrada = $_POST['id_entrada'];
		$valor['entradas'] = $this->menu_model->deleteEntradaByID($id_entrada);		
	}
}
