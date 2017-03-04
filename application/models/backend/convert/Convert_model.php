<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class convert_model extends CI_Model
{
    const catalogoInventario = 'sys_catalogo_inventario_sucursal';

    public function __construct()
    {
        parent::__construct();
        
    }

    public function getValorUnidadTo($IdUniAConvert)
    {
        $query = $this->db->query('Select um.valor_unidad_medida from sys_unidad_medida um
        where um.id_unidad_medida = '.$IdUniAConvert['unidadAConvert']);
        return $query->result_array();
    
    }

    public function getValorUnidadFrom($IdUnifromConvert)
    {
        $query = $this->db->query('Select um.valor_unidad_medida from sys_unidad_medida um
        where um.id_unidad_medida = '.$IdUnifromConvert['unidadDeConvert']);
        return $query->result_array();
    
    }

    public function getDatosEquivalentes($unidadAConvert,$unidadDeConvert)
    {
        $query = $this->db->query('Select * from sys_unidades_equivalentes ue
            where ue.id_unidad_medida = '.$unidadAConvert.' 
            and ue.id_unidad_equivalente = '.$unidadDeConvert);
        return $query->result_array();
    
    }

    public function getTotalExistencia($codigoMaterial, $IdSucursal)
    {
        $query = $this->db->query('Select cis.total_existencia
            from  sys_catalogo_inventario_sucursal cis 
            where cis.codigo_meterial ="'.$codigoMaterial.'" and cis.id_sucursal ='.$IdSucursal);
        return $query->row_array();
    
    }
   
}
/*
 * end of application/models/consultas_model.php
 */
