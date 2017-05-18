<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CglobalReporte extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/reportes/globalReporte_model');	
		$this->load->model('backend/admin/sucursales_model');	
	}

	public function index()
	{			
		// Productos Por Cada Sucursal
		$data['sucursales'] =  $this->sucursales_model->getSucursales();
		$this->load->view('backend/reportes/Vproductos.php',$data);
	}

	public function getProductos()
	{		
		$data =  $this->globalReporte_model->getProductos($_POST);		

		
		$html="";
		$html="<table>
				<tr>	
					<th>Pais</th>
					<th>Dep.</th>
					<th>Sucursal</th>
					<th>Nombre Producto</th>
					<th>Categoria</th>
					<th>Precio</th>
					
				</tr>";
		foreach ($data as $value) {
			$html .= "<tr>";

				$html .= "<td>";
					$html .= $value->nombre_pais;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_departamento;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_sucursal;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_producto;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_categoria_producto;
				$html .= "</td>";

				$html .= "<td> ". $value->moneda." ";
					$html .= number_format($value->precio,2);
				$html .= "</td>";


			$html .= "<tr>";
		}
		$html .="</table>";
		echo $html;
	}

	public function materiales(){
		$data['sucursales'] =  $this->sucursales_model->getSucursales();
		$this->load->view('backend/reportes/Vmateriales.php',$data);
	}

	public function getMateriales()
	{		
		$data =  $this->globalReporte_model->getMateriales($_POST);		

		
		$html="";
		$html="<table>
				<tr>						
					<th>Sucursal</th>
					<th>Categoria</th>
					<th>Material</th>
					<th>Codigo</th>
					<th>Minimo</th>
					<th>Maximo</th>
					<th>Total</th>					
				</tr>";
		foreach ($data as $value) {
			$html .= "<tr>";
				$html .= "<td>";
					$html .= $value->nombre_sucursal;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_categoria_materia;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_matarial;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->codigo_meterial;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->minimo_existencia ." ".$value->simbolo_unidad_medida;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->maximo_existencia ." ".$value->simbolo_unidad_medida;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->total_existencia ." ".$value->simbolo_unidad_medida;
				$html .= "</td>";

			$html .= "<tr>";
		}
		$html .="</table>";
		echo $html;
	}

	public function minimoExistencias(){
		$data['sucursales'] =  $this->sucursales_model->getSucursales();
		$this->load->view('backend/reportes/VminimoExistencias.php',$data);
	}

	public function getMinimoExistencias()
	{		
		$data =  $this->globalReporte_model->getMinimoExistencias($_POST);		

		
		$html="";
		$html="<table>
				<tr>						
					<th>Sucursal</th>
					<th>Categoria</th>
					<th>Material</th>
					<th>Codigo</th>
					<th>Minimo</th>
					<th>Maximo</th>
					<th>Total</th>					
				</tr>";
		foreach ($data as $value) {
			$html .= "<tr>";
				$html .= "<td>";
					$html .= $value->nombre_sucursal;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_categoria_materia;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_matarial;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->codigo_meterial;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->minimo_existencia ." ".$value->simbolo_unidad_medida;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->maximo_existencia ." ".$value->simbolo_unidad_medida;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->total_existencia ." ".$value->simbolo_unidad_medida;
				$html .= "</td>";

			$html .= "<tr>";
		}
		$html .="</table>";
		echo $html;
	}

	public function sobras(){
		$data['sucursales'] =  $this->sucursales_model->getSucursales();
		$this->load->view('backend/reportes/Vsobras.php',$data);
	}

	public function getSobras()
	{		
		$data =  $this->globalReporte_model->getSobras($_POST);		

		
		$html="";
		$html="<table>
				<tr>						
					<th>Sucursal</th>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Cantidad</th>
					<th>Unidad</th>
					<th>Empleado</th>				
				</tr>";
		foreach ($data as $value) {
			$html .= "<tr>";
				$html .= "<td>";
					$html .= $value->nombre_sucursal;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->codigo_material;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_matarial;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->cantidad_sobras;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_unidad_medida;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nickname;
				$html .= "</td>";

			$html .= "<tr>";
		}
		$html .="</table>";
		echo $html;
	}


}