<?php
/*
* Clase que implementa la logica de cortes de caja por sucursal
*/
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
		$this->load->model('backend/alertas/alertas_model');
	}

	public function index($id_sucursal)
	{	
		$data['sucursales'] = $this->sucursales_model->getSucursalesById( $id_sucursal );	
		$data['ordenes'] 	= $this->cortes_model->getcortesBySucursal( $id_sucursal );
		$data['ordenesA'] 	= $this->cortes_model->getcortesBySucursalA( $id_sucursal );
		$data['Adicional'] 	= $this->cortes_model->getTotalAdicinales( $id_sucursal );
		$data['series'] 	= $this->cortes_model->getSeriesCortesBySucursal( $id_sucursal );
		$data['cupones'] 	= $this->cortes_model->getTotalOrdenesCupon( $id_sucursal );
		$data['pedidosCerrados'] 	= $this->cortes_model->getPedidosCerrados( $id_sucursal );
		$data['pedidosAbiertos'] 	= $this->cortes_model->getPedidosAbiertos( $id_sucursal );
		$this->load->view('backend/cortes/Vindex.php',$data);
	}

	public function cortar($id_sucursal){
		//Obtener Total de Dinero en Todas las Ordenes a Cortar
		$data 	= $this->cortes_model->getcortesBySucursal($id_sucursal);
		$Monto 	= $data[0]->Monto;

		//Obtener Total de Dinero en Todas las Ordenes a Con Adicionales
		$data 	= $this->cortes_model->getTotalAdicinales_($id_sucursal);
		if($data[0]->Total_Adisional== null)
		{
			$Monto_Adicional = 0;
		}else{
			$Monto_Adicional = $data[0]->Total_Adisional;
		}
		

		//Obtener Total El Numero de Ordenes Sin cortar
		$data 	= $this->cortes_model->getTotalOrdenes_($id_sucursal);
		$Totalordenes = $data[0]->Totalordenes;

		//Ultima Serie al Corte del Dia
		$data 	= $this->cortes_model->getSeriesCortesBySucursal($id_sucursal);
		$Serie 	= $data[0]->secuencia_orden;

		//Total de Cupones
		$data 	= $this->cortes_model->getTotalOrdenesCupon_($id_sucursal);
		$Total_Cupones = $data[0]->Cupones;

		//InsetCorte
		$this->cortes_model->SetInsertCorte($id_sucursal,$Monto,$Monto_Adicional,$Totalordenes,$Serie,$Total_Cupones);

		/* NOTIFICACION DE CORTE*/
		session_start();
		$var_id_usuario = $_SESSION['idUser'];
		$this->alertas_model->setAlerta($id_sucursal,$var_id_usuario,16,2);	
		/* NOTIFICACION DE CORTE*/

	}

	public function getCortesByFilter($id_sucursal)
	{
		$data 	= $this->cortes_model->getCortesByFilter($id_sucursal,$_POST);
		$html="";
		$html="<table>
				<tr>	
					<th>Sucursal</th>
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
					$html .= $value->nombre_sucursal;
				$html .= "</td>";
				$html .= "<td>";
					$html .= $value->nickname;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->fecha_corte;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->moneda." ". number_format($value->monto_corte,2);
				$html .= "</td>";

				$html .= "<td>$ ";
					$html .= number_format($value->monto_adicionales,2);
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
