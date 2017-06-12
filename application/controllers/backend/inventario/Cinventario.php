<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cinventario extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/inventario/inventario_model');			
	}

	public function index()
	{	
		$data['sucursales'] = $this->inventario_model->getSucursal();
		$data['categoriaMateriales'] = $this->inventario_model->getCategoriaMateriales();	
		$data['inventario'] = $this->inventario_model->getInventario();
		$this->load->view('backend/inventario/Vinventario.php',$data);
	}

	public function addInventario()
	{	
		$data['estatus'] = $this->inventario_model->getEstatus();
		$data['unidaMedida'] = $this->inventario_model->getUnidadMedida();
		$data['categoria'] = $this->inventario_model->getCategoriaMaterialesSelect();
		$this->load->view('backend/inventario/VaddInventario.php', $data);
	}

	public function addCategoria()
	{	
		//$data['unidaMedida'] = $this->inventario_model->getUnidadMedida();
		$this->load->view('backend/inventario/VaddCategoria.php');
	}

	public function inventarioBySucursal($sucursalID)
	{	
		$data['nameSucursal'] = $this->inventario_model->getNameSursal($sucursalID);
		$data['materiales'] = $this->inventario_model->inventarioBySucursalDetall($sucursalID);
		$this->load->view('backend/inventario/VinventarioBySucursalDatelle.php', $data);
	}


	public function addEstatus()
	{	
		$this->load->view('backend/inventario/VaddEstatus.php');
	}

	public function viewAddMetarialSucursal($sucursalID)
	{
		$data['sucursalID'] = $sucursalID;
		$data['materiales'] = $this->inventario_model->getMaterialesNotInsert($sucursalID);
		$this->load->view('backend/inventario/VaddCatalogoBySucursalPassOne.php', $data);
	
	}

	public function viewListAdicionales($sucursalID)
	{
		$data['sucursalID'] = $sucursalID;
		$data['adicionales'] = $this->inventario_model->getDataAdicionales($sucursalID);
		$this->load->view('backend/inventario/VlistAdicionales.php', $data);
	
	}

	public function vieMaterialByCategoria($categoriaMaterialId)
	{
		$data['materiales'] = $this->inventario_model->getMaterialesNotInsert($categoriaMaterialId);
		$this->load->view('backend/inventario/VaddCatalogoBySucursalPassOne.php', $data);
	}

	public function save_estatus()
	{	
		$this->inventario_model->save_estatus($_POST);
	}

	public function save_adicional()
	{	
		$this->inventario_model->save_adicional($_POST);
	}

	public function save_material()
	{
		function generarCode()
		{	
			$key = '';
			$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
			$max = strlen($pattern)-1;
			for($i=0;$i < 6;$i++) $key .= $pattern{mt_rand(0,$max)};
			return $key;
		}

		$code = generarCode();
		$validarCode = $this->inventario_model->validateCode($code);
		if($validarCode[0]['numData']==0)
		{
			$this->inventario_model->save_material($_POST, $code);
		}
	}

	public function save_categoria_material()
	{
		
		$this->inventario_model->save_categoria_material($_POST);
		
	}

	public function saveMaterialesList()
	{
		
		$this->inventario_model->save_lista_materiales($_POST);
		
	}

	public function delete_material()
	{	
		$this->inventario_model->delete_material($_POST);
	
	}

	public function delete_categoria_material()
	{	
		$this->inventario_model->delete_categoria_material($_POST);
	
	}

	public function editMaterial($inventarioID)
	{	
		$data['estatus'] = $this->inventario_model->getEstatus();
		$data['unidaMedida'] = $this->inventario_model->getUnidadMedida();
		$data['categoria'] = $this->inventario_model->getCategoriaMateriales();
		$data['material'] = $this->inventario_model->getInventarioByID($inventarioID);
		$this->load->view('backend/inventario/VmodifiInventario.php',$data);

	}

	public function editMaterialCat($categoID)
	{	
	
		$data['categoria'] = $this->inventario_model->getCategoriaMaterialesByID($categoID);
		$this->load->view('backend/inventario/VmodifiCategoriaMaterial.php',$data);

	}


	public function viewInventario($inventarioID)
	{	
		$data['material'] = $this->inventario_model->getInventarioView($inventarioID);
		$this->load->view('backend/inventario/VviewInventario.php',$data);

	}

	public function update_inventario()
	{
		$this->inventario_model->update_inventario($_POST);
	}

	public function update_inventarioCategoria()
	{
		$this->inventario_model->update_inventarioCategoria($_POST);
	}

	public function inactivarCategoria()
	{
		$validCateUsed = $this->inventario_model->ValidateUsedCategoriM($_POST);
		//echo $validCateUsed[0]['numData'];
		if($validCateUsed[0]['numData']==0)
		{
			$this->inventario_model->inactivar_categoria($_POST);
		}
		else
		{
			echo "0";
		}
	}

	public function activarCategoria()
	{
		$this->inventario_model->activar_categoria($_POST);
	}

	public function quitar_material_sucursal()
	{	
		$this->inventario_model->quitar_material_sucursal($_POST);
	
	}

	public function config_meteriales($inventarioSucursal)
	{	
		$data['materialSucursal'] = $this->inventario_model->dataCatalogoInventarioSucursal($inventarioSucursal);
		$this->load->view('backend/inventario/VconfigMateriales.php',$data);

	}

	public function add_pedidoMateriales($inventarioSucursal)
	{	
		$data['unidaMedida'] = $this->inventario_model->getUnidadMedida();
		$data['materialSucursal'] = $this->inventario_model->dataCatalogoInventarioSucursal($inventarioSucursal);
		$this->load->view('backend/inventario/VaddMateriales.php',$data);

	}

	public function asociar_proveedor_meterial()
	{	
		$this->inventario_model->asociar_proveedor_meterial($_POST);
	
	}


	public function desasociar_proveedor_meterial()
	{	
		$this->inventario_model->desasociar_proveedor_meterial($_POST);
	
	}

	
	public function save_config_material()
	{
		
		$this->inventario_model->save_config_material($_POST);
		
	}

	public function save_add_material()
	{
		//var_dump($_POST);
		$this->inventario_model->save_add_material($_POST);
		
	}
	public function update_adicionales()
	{
		//var_dump($_POST);
		$this->inventario_model->update_adicionales($_POST);
		
	}

	public function add_adicionales($inventarioID)
	{	
		$data['material'] = $this->inventario_model->dataMaterial($inventarioID);
		$data['unidaMedida'] = $this->inventario_model->getUnidadMedida();
		$this->load->view('backend/inventario/Vadicionales.php',$data);

	}

	public function Vupdate_adicionales($adicionalID)
	{	
		$data['adicional'] = $this->inventario_model->dataAdicional($adicionalID);
		$data['unidaMedida'] = $this->inventario_model->getUnidadMedida();
		$this->load->view('backend/inventario/VupdateAdicionales.php',$data);

	}

	public function delete_adicional()
	{	
		$this->inventario_model->delete_adicional($_POST);
	
	}

}
