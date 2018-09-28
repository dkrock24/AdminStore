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

    public function updateMes( $mes , $anio ){



        foreach ($mes as $key =>  $value) {

            if($key != 'DataTables_Table_0_length'){

                $data = array(
                'estimado_dia'   => $value,
                );

                $this->db->where('id', $key );      
                //$this->db->where('anio', $anio ); 
                $this->db->update('sys_prevision_datos',$data);
            }            
        }        
    }

    public function setYear( $year ){
        echo $year;
        // obtenemos todos los meses con el total de dias por cada uno
        $query  = $this->db->query('select * from sys_prevision_mes as mes');
        $mes    = $query->result();

        $anio = $this->getLastYear( $year );

        if( $anio == 0 )
        {
            // recorreremos por mes para crear el nuevo anio
            foreach ($mes as $nuevoMes) {

                //Valores del mes a crear para el nuevo anio
                $mes_id     = $nuevoMes->id_prev;
                $mes_num    = $nuevoMes->numero_mes;
                $mes_dias   = $nuevoMes->dia_mes;

                $cont_dias_mes = 1;
                while( $cont_dias_mes <= $mes_dias ){

                    $data = array(
                        'anio'  => $year,       
                        'id_mes' => $mes_id,
                        'dia_mes' => $cont_dias_mes,
                        'estimado_dia' =>   350    ,   
                        'fecha_creado' => date('Y-m-d'),
                        'fecha_actualizado' => date('Y-m-d'),
                        'estado'    => 1
                    );
                    $this->db->insert('sys_prevision_datos',$data);

                    $cont_dias_mes++;
                }
            }
        }
    }

    public function getLastYear( $year ){
        $query  = $this->db->query('select * from sys_prevision_datos where anio ='. $year );
        $exits_year = $query->result();

        if( $exits_year != null ){
            return 1;
        }else{
            return 0;
        }
    }
}