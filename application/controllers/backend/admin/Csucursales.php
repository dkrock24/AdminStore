<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csucursales extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/admin/sucursales_model');			
		$this->load->model('backend/usuarios/usuarios_model');
		$this->load->model('backend/admin/departamentos_model');
		$this->load->model('backend/admin/pais_model');
	}

	public function index()
	{		
		$data['sucursales'] =  $this->sucursales_model->getSucursales();
		$data['usuarios'] 	=  $this->usuarios_model->getUsers();

		$data['nodos'] 		=  $this->sucursales_model->getNodos();
		$this->load->view('backend/admin/Vsucursales.php',$data);
	}	

	// Acceso a Usuarios Por Sucursal
	public function acceso($id_usuario){
		$data['usuario'] 		=   $this->usuarios_model->getUserByID($id_usuario);
		$data['pais'] 			= 	$this->pais_model->getPaises();	
		$data['departamentos'] 	= 	$this->usuarios_model->getAllDepartamentos();
		$data['sucursal'] 		=	$this->usuarios_model->getAllSucursal();
		$data['sucursalAcceso'] =	$this->sucursales_model->sucursalAccesos($id_usuario);
			
		$this->load->view('backend/admin/VaccesoSucursal.php',$data);
	}

	// Guardar Acceso a sucursal por Usuario
	public function saveAcceso($id_usuario){
		$this->sucursales_model->saveAcceso($id_usuario,$_POST);
	}

	// Delete Acceso a sucursal por Usuario
	public function deleteAcceso($id){
		$this->sucursales_model->deleteAcceso($id);
	}

	public function crear(){
		$data['paises'] 		=  $this->pais_model->getPaises();
		$data['departamentos'] 	=  $this->departamentos_model->getDepartamentos();
		$this->load->view('backend/admin/VSucursalCrear.php',$data);
	}
	public function editar($id_sucursal){
		$data['paises'] 		=  $this->pais_model->getPaises();
		$data['departamentos'] 	=  $this->departamentos_model->getDepartamentos();
		$data['sucursales'] 	=  $this->sucursales_model->getSucursalesByID($id_sucursal);
		$this->load->view('backend/admin/VSucursalEditar.php',$data);
	}
	public function delete($id_sucursal)
	{
		$this->sucursales_model->delete($id_sucursal);
	}
	public function saveUpdate($id_sucursal){
		$this->sucursales_model->saveUpdate($_POST,$id_sucursal);
		$this->load->view('backend/admin/VSucursalEditar.php',$data);
	}	
	public function getDepartamento($id_pais){	
		$data = array();
		$data	=  $this->departamentos_model->getOneDepartamento($id_pais);
		echo json_encode($data);
	}
	public function saveSucursal(){		
		$this->sucursales_model->save($_POST);
	}
	public function getSucursalesByDepartamento($id){		
		$data	=  $this->sucursales_model->getSucursalesByDepartamento($id);
		echo json_encode($data);
	}

	// Nodos Por Sucursal
	public function getNodosSucursal($id){	
		
		$data['nodos']	=  $this->sucursales_model->getNodosSucursal($id);
		$data['sucursales']	=  $this->sucursales_model->getSucursalesByID($id);
		
		$this->load->view('backend/admin/VSucursalNodo.php',$data);
	}

	// Check nodos por sucursal
	public function checkNodosSucursal($id,$estado){		
		if($estado==1){
			$valor = 0;
		}else{
			$valor = 1;
		}
		$data['nodos']	=  $this->sucursales_model->checkNodosSucursal($id,$valor);		
	}

	// Crear Nuevo Nodo
	public function crearNodo(){		
		$this->load->view('backend/admin/VCrearNodo.php');
	}

	// Crear Nuevo Nodo
	public function saveNodo(){		
		$this->sucursales_model->saveNodo($_POST);
	}

	// Editar Nodos
	public function editarNodo($id){
		$data['nodos']	=  $this->sucursales_model->getNodoByID($id);
		$this->load->view('backend/admin/VeditarNodo.php',$data);
	}

	// Editar Nodos
	public function updateNodo($id){
		$data['nodos']	=  $this->sucursales_model->updateNodo($id,$_POST);		
	}

	// Eliminar Nodos
	public function deleteNodo($id){
		$data['nodos']	=  $this->sucursales_model->deleteNodo($id);		
	}


	

	

}
