<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creportes extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/reportes/reportes_model');	
		$this->load->model('backend/admin/sucursales_model');	
	}

	public function index()
	{			
		//$data['cortes'] = $this->reportes_model->getCortes();	
		$data['sucursales'] =  $this->sucursales_model->getSucursales();
		$this->load->view('backend/reportes/Vindex.php',$data);
	}

	public function getCortes()
	{		
		$data =  $this->reportes_model->getCortes($_POST);		

		
		$html="";
		$html="<table>
				<tr>	
					<th>Usuario</th>
					<th>Sucursal</th>
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
					$html .= $value->nickname;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_sucursal;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->fecha_corte;
				$html .= "</td>";

				$html .= "<td>$ ";
					$html .= number_format($value->monto_corte,2);
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

	public function ventas(){
		$data['sucursales'] =  $this->sucursales_model->getSucursales();
		$this->load->view('backend/reportes/Vventas.php',$data);
	}

	public function getVentas()
	{		
		$data =  $this->reportes_model->getVentas($_POST);		

		
		$html="";
		$html="<table>
				<tr>						
					<th>Sucursal</th>
					<th>Usuario</th>
					<th>Secuencia</th>
					<th>Precio Gravado</th>
					<th>Llevar</th>
					<th>Nombre Producto</th>
					<th>Fecha y Hora</th>					
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
					$html .= $value->secuencia_orden;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->moneda ." ". number_format($value->precio_grabado,2);
				$html .= "</td>";

				$html .= "<td>";
					$llevar="";
					if($value->llevar==1){$llevar= "Si";}else{$llevar= "No";}
					$html .= $llevar;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->nombre_producto;
				$html .= "</td>";

				$html .= "<td>";
					$html .= $value->fechahora_pedido;
				$html .= "</td>";

			$html .= "<tr>";
		}
		$html .="</table>";
		echo $html;
	}


}