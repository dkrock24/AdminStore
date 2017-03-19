<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cconvert extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/convert/convert_model');			
		$this->load->model('backend/inventario/inventario_model');	
	}

	public function ConvertUnidades($unidadAConvert,$unidadDeConvert,$cantidadAConvert)
	{	
		$datosEquivalentes = $this->convert_model->getDatosEquivalentes($unidadAConvert,$unidadDeConvert);
		if (empty($datosEquivalentes)) 
		{
			echo "La undiad a convertir no esta configurada";
			die();
		}
		
		$resultConvert = $cantidadAConvert * $datosEquivalentes[0]['cantidad_equivalencia'];
		return round($resultConvert,2);
	}


	public function restToExistencia($totalExistencia, $CantidadRestar, $IdCatoloInvetario)
	{
		$existencia = $totalExistencia - $CantidadRestar;
		$this->inventario_model->UpdateExistencia($IdCatoloInvetario, $existencia);
		//return $result;
	}

	public function sumToExistencia($totalExistencia, $CantidadSumar, $IdCatoloInvetario)
	{
		//echo "exis".$totalExistencia."Canti".$CantidadSumar."ID".$IdCatoloInvetario;
		$existencia = $totalExistencia + $CantidadSumar;
		$this->inventario_model->UpdateExistencia($IdCatoloInvetario, $existencia);
		//return $result;
	}

	public function getTotalExistencia($codigoMaterial, $IdSucursal)
	{
		$datoExistencia = $this->convert_model->getTotalExistencia($codigoMaterial,$IdSucursal);
		return $datoExistencia;
	}

	public function getDataMaterialInventario($codigoMaterial, $IdSucursal)
	{
		$datoExistencia = $this->convert_model->getDataMaterialInventario($codigoMaterial,$IdSucursal);
		return $datoExistencia;
	}
	
}
