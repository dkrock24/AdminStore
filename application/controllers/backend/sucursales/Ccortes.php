<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccortes extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/sucursales/sucursales_model');	
		$this->load->model('backend/convert/convert_model');
		$this->load->model('backend/login/login_model');
		$this->load->model('backend/cortes/cortes_model');
	}

	public function index($id_sucursal)
	{	
		$data['sucursales'] = $this->sucursales_model->getSucursalesById($id_sucursal);	
		$data['ordenes'] 	= $this->cortes_model->getcortesBySucursal($id_sucursal);
		$data['ordenesA'] 	= $this->cortes_model->getcortesBySucursalA($id_sucursal);
		$data['Adicional'] 	= $this->cortes_model->getTotalAdicinales($id_sucursal);
		$data['series'] 	= $this->cortes_model->getSeriesCortesBySucursal($id_sucursal);
		$data['cupones'] 	= $this->cortes_model->getTotalOrdenesCupon($id_sucursal);
		$data['pedidosCerrados'] 	= $this->cortes_model->getPedidosCerrados($id_sucursal);
		$data['pedidosAbiertos'] 	= $this->cortes_model->getPedidosAbiertos($id_sucursal);
		$this->load->view('backend/cortes/Vindex.php',$data);
	}

	public function cortar($id_sucursal){
		//Obtener Total de Dinero en Todas las Ordenes a Cortar
		$data 	= $this->cortes_model->getcortesBySucursal($id_sucursal);
		$Monto 	= $data[0]->Monto;

		//Obtener Total de Dinero en Todas las Ordenes a Con Adicionales
		$data 	= $this->cortes_model->getTotalAdicinales($id_sucursal);
		$Monto_Adicional = $data[0]->Total_Adisional;

		//Obtener Total El Numero de Ordenes Sin cortar
		$data 	= $this->cortes_model->getTotalOrdenes($id_sucursal);
		$Totalordenes = $data[0]->Totalordenes;

		//Ultima Serie al Corte del Dia
		$data 	= $this->cortes_model->getSeriesCortesBySucursal($id_sucursal);
		$Serie 	= $data[0]->secuencia_orden;

		//Total de Cupones
		$data 	= $this->cortes_model->getTotalOrdenesCupon($id_sucursal);
		$Total_Cupones = $data[0]->Cupones;

		//InsetCorte
		$this->cortes_model->SetInsertCorte($id_sucursal,$Monto,$Monto_Adicional,$Totalordenes,$Serie,$Total_Cupones);

		//$Fecha_Corte 	=	date("Y-m-d H:m:s");

	}

	public function getCortesByFilter($id_sucursal)
	{
		$data 	= $this->cortes_model->getCortesByFilter($id_sucursal,$_POST);
		$html="";
		$html="<table>
				<tr>	
					<th>Usuario</th>
					<th>Fecha Corte</th>
					<th>Monto</th>
					<th>Adicionales</th>
					<th>Ordenes</th>
					<th>Serie Fin</th>
					<th>Cupones</th>
				</tr>";
		foreach ($data as $value) {
			$html .= "<tr>";
				$html .= "<td>";
					$html .= $value->id_usuario;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->fecha_corte;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->monto_corte;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->monto_adicionales;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->total_ordenes;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->serie_fin;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->cupones;
				$html .= "</td>";

			$html .= "<tr>";
		}
		$html .="</table>";
		echo $html;
	}	
	
	
}
