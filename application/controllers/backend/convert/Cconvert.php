<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cconvert extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/convert/convert_model');			
	}

	public function ConvertUnidades()
	{		
		$datosEquivalentes = $this->convert_model->getDatosEquivalentes($_POST);
		$resultConvert = $_POST['cantidadAConvert'] * $datosEquivalentes[0]['cantidad_equivalencia'];
		
		echo $resultConvert;
	}


	public function restToExistencia($totalExistencia, $CantidadRestar)
	{
		$result = $totalExistencia - $CantidadRestar;
		return $result;
	}

	public function getTotalExistencia($codigoMaterial, $IdSucursal)
	{
		$datoExistencia = $this->convert_model->getTotalExistencia($codigoMaterial,$IdSucursal);
		return $datoExistencia;
	}
	
}
