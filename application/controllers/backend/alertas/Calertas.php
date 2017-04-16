<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calertas extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/alertas/alertas_model');	


	}

	public function index()
	{			
		$data['vistas'] = $this->alertas_model->getAlertasVistas();
		$data['mensajes'] = $this->alertas_model->getMensajes();
		$data['sucursales'] = $this->alertas_model->getSucursales();
		$this->load->view('backend/alertas/Vindex.php',$data);
	}
	public function getAlertasNoVistas($id){

		$data = $this->alertas_model->getAlertasLoginNoVistas($id,$_POST);
		$html="";
		$contador=1;
		$html="<table class='table table-bordered table-hover table-striped'>
				<tr>
					<th>#</th>	
					<th>Sucursal</th>
					<th>Usuario</th>
					<th>Mensaje</th>
					<th>Fecha y Hora</th>
				</tr>";
		foreach ($data as $value) {
			$html .= "<tr>";
				$html .= "<td>";
					$html .= $contador;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_sucursal;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nickname;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->mensaje;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->fecha_creado;
				$html .= "</td>";

			$html .= "<tr>";
			$contador++;
		}
		$html .="</table>";
		echo $html;
	}

	

	public function getAlertas(){
		$sucursal = $_POST['id_sucursal'];
		$contador=1;
		$response['success'] = 1;
		$iter = 0;

		do{	
			$response['alertas'] = $this->alertas_model->getAlertasAdmin($sucursal);
			
			if($response['alertas']!=NULL){				
				$response['success'] = 0;
				$this->alertas_model->setAlertasAdmin($response['alertas'][0]->id_notificacion);
				break;	
			}
			sleep(5);

			++$iter;
		}while($iter < 3);

		echo json_encode($response);
	}
}