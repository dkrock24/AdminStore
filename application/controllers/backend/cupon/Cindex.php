<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cindex extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');		
		$this->load->database('default');	
		$this->load->model('backend/cupon/cupon_model');	
		//$this->load->model('backend/admin/sucursales_model');		
	}

	public function index()
	{	
		$data['cuponActivo'] =  $this->cupon_model->getCuponActivo();		
		$data['cuponInactivo'] =  $this->cupon_model->getCuponInactivo();	
		$data['cupones'] =  $this->cupon_model->getCupones();
		$data['categorias_cupones'] =  $this->cupon_model->getCategoriasCupones();
//		$data['sucursales'] =  $this->sucursales_model->getSucursales();

		$this->load->view('backend/cupon/Vcupones.php',$data);
	}
	public function setCupones()
	{					
		
		$cantidad	=	$_POST['cantidad'];
		$longitud	=	$_POST['longitud'];
		$categoria		=	$_POST['categoria'];
		$descripcion		=	$_POST['descripcion'];
		$contador=1;
		while($contador<=$cantidad)
		{
			$cupon_codigo = $this->generarCodigo($longitud);
			$cupon_codigo = $cupon_codigo."-".$categoria;
			$this->cupon_model->setCupon($cupon_codigo,$categoria,$descripcion);		
			$contador+=1;
		}			
	}

	public function generarCodigo($longitud){
		$key = '';
	 	$pattern = '123456789abcdefghjkmnpqrstuvwxyz'; // 01oil
	 	//$pattern = '1234567890';
	 	$max = strlen($pattern)-1;
	 	for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
	 	return $key;			
	}

	// Crear Categorias Para los Cupos
	public function setCategoria(){
		$this->cupon_model->setCategoria($_POST);	
	}

	public function eliminarCategoria($id){
		$this->cupon_model->eliminarCategoria($id);
	}

	public function pdf($id){
		$categoria = null;
		$descripcion = null;
		$fecha = null;

		$data = $this->cupon_model->getCuponesByID($id);

		foreach ($data as $value) {
			$categoria = $value->id_categoria;
			$descripcion = $value->descripcion_cupon;
			$fecha = $value->fecha_creacion_cupon;
		}
		$cupon['cupon'] = $this->cupon_model->getBachCupone($categoria,$fecha,$descripcion);
		$this->load->view('backend/cupon/VcuponesImprimir.php',$cupon);
	}

	public function pdf2($id){
		$pdf = new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		//$pdf->Cell(40,10,'Hello World2!');

		$categoria = null;
		$fecha = null;

		$data = $this->cupon_model->getCuponesByID($id);

		foreach ($data as $value) {
			$categoria = $value->id_categoria;
			$fecha = $value->fecha_creacion_cupon;
			//$pdf->Cell(40,10,$value->codigo_cupon);
		}
		$cupon = $this->cupon_model->getBachCupone($categoria,$fecha);
		foreach ($cupon as $values) {	
			$a= "<table border=1>nada</table>";
			$pdf->MultiCell(60,5,$value->codigo_cupon);
			$pdf->Ln();
			//$pdf->Cell(40,10,$value->codigo_cupon,0,1);

		}

		$pdf->Output();
	}

	
}
