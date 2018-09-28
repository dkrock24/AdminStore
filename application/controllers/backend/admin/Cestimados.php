<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cestimados extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/admin/estimado_model');			
	}

	public function index()
	{	
		$data['data'] 	= $this->estimado_model->getYear();
	
		$this->load->view('backend/admin/Vestimado.php',$data);
	}

	public function showMes($id_mes){

		$data['data'] 	= $this->estimado_model->getMonth($id_mes);

		$this->load->view('backend/admin/Vestimado_mes.php',$data);
	}

	public function editMes( $id_mes ){

		$data['data'] 	= $this->estimado_model->getMonth($id_mes);

		$this->load->view('backend/admin/Vestimado_editar.php',$data);
	}

	public function updateMes( $anio ){

		// Actualizar los registro para el mes solicitado

		$this->estimado_model->updateMes( $_POST , $anio );

		$data['data'] 	= $this->estimado_model->getYear();

		$this->load->view('backend/admin/Vestimado.php',$data);
	}

	public function createYear( $year ){

		if( $year != '' or isset($year) ){
			$this->estimado_model->setYear( $year );
			$this->index();
		}else{
			$this->index();
		}
	}
}