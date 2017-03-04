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
		var_dump($datosEquivalentes);
		$resultConvert = $cantidadAConvert * $datosEquivalentes[0]['cantidad_equivalencia'];
		return $resultConvert;
	}


	public function restToExistencia($totalExistencia, $CantidadRestar, $IdCatoloInvetario)
	{
		$resultRestExistencia = $totalExistencia - $CantidadRestar;
		$this->inventario_model->UpdateExistencia($IdCatoloInvetario, $resultRestExistencia);
		//return $result;
	}

	public function sumToExistencia($totalExistencia, $CantidadSumar, $IdCatoloInvetario)
	{
		$resultSumaExistencia = $totalExistencia + $CantidadSumar;
		$this->inventario_model->UpdateExistencia($IdCatoloInvetario, $resultSumaExistencia);
		//return $result;
	}

	public function getTotalExistencia($codigoMaterial, $IdSucursal)
	{
		$datoExistencia = $this->convert_model->getTotalExistencia($codigoMaterial,$IdSucursal);
		return $datoExistencia;
	}
	
}
