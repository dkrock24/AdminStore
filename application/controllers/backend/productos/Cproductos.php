<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cproductos extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/productos/productos_model');			
	}

	public function index()
	{		
		$data['categoria'] = $this->productos_model->categoria();
		$data['producto'] = $this->productos_model->getProductos();
		$data['sucursales'] = $this->productos_model->getAllSucursales();
		$this->load->view('backend/productos/VproductosAdd.php',$data);
	}

	public function unidadMedida()
	{		
		$data['tipoUnidad'] = $this->productos_model->tipoUnidad();
		$data['unidadMedida'] = $this->productos_model->unidadMedida();
		$this->load->view('backend/productos/VunidadMedida.php',$data);
	}


	public function tipoUnidadMedida()
	{		
		$data['tipoUnidad'] = $this->productos_model->tipoUnidad();
		$this->load->view('backend/productos/VtipoUnidadMedida.php',$data);
	}
	
	public function loadSucursales($prodcutoID)
	{
		$data['productoID'] = $prodcutoID;
		$data['sucursales'] = $this->productos_model->getSucursales($prodcutoID);
		$this->load->view('backend/productos/ListSucursales.php',$data);
	}

	public function save_producto()
	{
		 $this->productos_model->save_producto($_POST);
	}

	public function save_ingrediente()
	{
		 $this->productos_model->save_ingrediente($_POST);
	}
	public function save_precio()
	{
		 $this->productos_model->save_precio($_POST);
	}

	public function save_nodo()
	{
		 $this->productos_model->save_nodo($_POST);
	}
	
	public function save_unidadMedida()
	{
		 $this->productos_model->save_unidadMedida($_POST);
	}

	public function save_TipounidadMedida()
	{
		 $this->productos_model->save_TipounidadMedida($_POST);
	}

	public function save_categoria()
	{
		 $this->productos_model->save_categoria($_POST);
	}

	public function associate_producto()
	{
		 $this->productos_model->associate_producto($_POST);
	}

	public function disassociate_producto()
	{
		 $this->productos_model->disassociate_producto($_POST);
	}

	public function delete_producto()
	{	
		$VarValida = $this->productos_model->getNumAssoProdcut($_POST);
		//var_dump($VarValida[0]['numData']);
		if($VarValida[0]['numData']==0)
		{
			$this->productos_model->delete_producto($_POST);
			@unlink('../../../assets/images/productos/'.$_POST['ProductoName']);
			echo "Eliminado correctamente :)";
		}
		else
		{
			echo "Este producto esta asociado a una o mas sucursales!!! :(";	
		}

	}

	public function SearchByCategory($categoryID)
	{
		$data['producto'] = $this->productos_model->getProductorByCategory($categoryID);
		$this->load->view('backend/productos/productosByCategory.php',$data);

	}

	public function productosBySucursal($sucursalID)
	{
		$data['nodos'] = $this->productos_model->getNodos();
		$data['productoByS'] = $this->productos_model->getProductosBySucursal($sucursalID);
		$this->load->view('backend/productos/productosBySucursal.php',$data);

	}


	public function detalleProducto($productoID)
	{	
		$data['productoID'] = $productoID;
		$data['detalle'] = $this->productos_model->getDetalle($productoID);
		$data['ingredienteC'] = $this->productos_model->getStatusIngrediente($productoID);
		$data['unidadMedida'] = $this->productos_model->unidadMedida();
		$this->load->view('backend/productos/datelleProducto.php',$data);

	}

	//-------------------------------Codigo Mantenimiento  ---------------------------

	public function viewCategoria($categoriaID)
	{	
		$data['categoriaP'] = $this->productos_model->getCategoriaByID($categoriaID);
		$this->load->view('backend/productos/Vviewproductos.php',$data);

	}

	public function editDataControll($categoriaID)
	{	
		$data['categoriaP'] = $this->productos_model->getCategoriaByID($categoriaID);
		$this->load->view('backend/productos/VmodifiData.php',$data);

	}

	public function save_updated()
	{
		$this->productos_model->save_updated($_POST);
	}


	public function delete_data()
	{	
		$this->productos_model->delete_data($_POST);
	
	}

	public function quitar_detalle()
	{	
		$this->productos_model->quitar_detalle($_POST);
	
	}

	//--------------------------------End mantenimiento de catalogos---------------


	//-------------------------------Codigo Mantenimiento  Tipo Unidad--------------------------

	public function delete_dataTipo()
	{	
		$this->productos_model->delete_dataTipo($_POST);
	
	}

	public function editDataControllTipo($tipoUnidadID)
	{	
		$data['tipoUnidadData'] = $this->productos_model->getTipoUnidadByID($tipoUnidadID);
		$this->load->view('backend/productos/VmodifiDataTipoUnidad.php',$data);

	}

	public function save_updatedTipo()
	{
		$this->productos_model->save_updatedTipo($_POST);
	}

	//--------------------------------End mantenimiento de catalogos---------------


	
	//-------------------------------Codigo unidad de medida  --------------------------

	public function delete_dataUnidad()
	{	
		$this->productos_model->delete_dataUnidad($_POST);
	
	}


	public function editDataControllUnidad($unidadID)
	{	
		$data['tipoUnidad'] = $this->productos_model->tipoUnidad();
		$data['unidadData'] = $this->productos_model->getUnidadByID($unidadID);
		$this->load->view('backend/productos/VmodifiDataUnidad.php',$data);

	}

	public function save_updatedUnidad()
	{
		$this->productos_model->save_updatedUnidad($_POST);
	}


	public function catalogo_materiales()
	{		
		$data['catalogoMateriales'] = $this->productos_model->getCatalogoMateriales($_GET);
		$this->load->view('backend/productos/autoSearch.php',$data);
	}
	//--------------------------------End mantenimiento de catalogos---------------

	public function completos_ingrediente()
	{	
		$VarValida = $this->productos_model->getNumIngrendientes($_POST);
		//var_dump($VarValida[0]['numData']);
		if($VarValida[0]['numData']>=1)
		{
			$this->productos_model->completos_ingrediente($_POST);	
			echo "Ingredientes completos!!!";
		}
		else
		{
			echo "Es necesario que tenga por lo menos un ingrediente";
		}
		
	
	}

	public function incompletos_ingrediente()
	{	
		$this->productos_model->incompletos_ingrediente($_POST);
	
	}

	public function validar_materiales()
	{	
		$materialInventario = $this->productos_model->getArrayInventario($_POST);
		$ingredienteProucto = $this->productos_model->getArrayIngredientes($_POST);
		$material = array();
		/*foreach ($materialInventario as $value) 
		{
			array_push($material, $value['codigo_meterial']);
		}
		var_dump($ingredienteProucto);
		*/
		$ingredieFaltante=0;
		$ingredieExiste=0;
		foreach ($ingredienteProucto as  $ingrediente) 
		{
			if (in_array($ingrediente['name_detalle'], $materialInventario)) 
			{
			    $ingredieExiste = 1;
			}
			else
			{
				$ingredieFaltante = 1;
			}
		}
		$datoValida = ($ingredieFaltante<=0) ? 1 : 0 ;
		$this->productos_model->updateVerificaionIngrediente($_POST,$datoValida);

	}

}
