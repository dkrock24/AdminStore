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

    public function getDatosEquivalentes($IdUnifromConvert)
    {
        $query = $this->db->query('Select * from sys_unidades_equivalentes ue
            where ue.id_unidad_medida = '.$IdUnifromConvert['unidadAConvert'].' 
            and ue.id_unidad_equivalente = '.$IdUnifromConvert['unidadDeConvert']);
        return $query->result_array();
    
    }
   
}
/*
 * end of application/models/consultas_model.php
 */
