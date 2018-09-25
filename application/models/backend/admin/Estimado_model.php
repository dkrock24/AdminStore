<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Estimado_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        
    }

    public function getYear()
    {
        $query = $this->db->query('select * from sys_prevision_mes order by id_prev asc');
        return $query->result();
       
    }

    public function getMonth( $id_month )
    {
        $query = $this->db->query('select pd.*,pm.nombre_mes from sys_prevision_datos as pd left join sys_prevision_mes as pm on pm.id_prev=pd.id_mes  where id_mes ='. $id_month);
        return $query->result();
       
    }

    public function updateMes( $mes ){



        foreach ($mes as $key =>  $value) {

            if($key != 'DataTables_Table_0_length'){

                $data = array(
                'estimado_dia'   => $value,
                );

                $this->db->where('id', $key );      
                $this->db->update('sys_prevision_datos',$data);
            }            
        }        
    }
}