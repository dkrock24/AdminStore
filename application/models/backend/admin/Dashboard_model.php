<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{
    const querys            = 'trl_global_report_config';   
    const tipos_grafica     = 'trl_global_report_chart';   
    const parametros        = 'trl_global_report_inputs';

    
    public function __construct()
    {
        parent::__construct();
        
    }

    public function getQuerys()
    {
        $this->db->select('*');
        $this->db->from(self::querys);        
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }
    public function getConsultas()
    {
        $this->db->select('*');
        $this->db->from(self::querys);    
        $this->db->join(self::tipos_grafica,' on '. 
                        self::tipos_grafica.'.global_report_chart_id = '.
                        self::querys.'.chart_type_id');            
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }

    public function eliminar_consulta($id){
        $data = array(
            'id_global_report' => $id
        );
        $this->db->delete(self::querys, $data);         
        $this->db->delete(self::parametros, $data);    
    }

    public function getTiposGraficas(){
        $this->db->select('*');
        $this->db->from(self::tipos_grafica);        
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    public function guardar_consulta($data){
        //$date = date("Y-m-d H:m:s");
        $data1 = array(
            'menu_name'     => $data['nombre'],           
            'title'         => $data['titulo'],
            'description'   => $data['descripcion'], 
            'icon'          => $data['icono'],            
            'query'         => $data['query'],
            'chart_type_id' => $data['tipo_grafica'],
            'status'        => $data['estado']
        );
        $this->db->insert(self::querys,$data1);

        $contador = $_POST['numero'];
        if($contador >0 )
        {
            $input_name ='';
            $input_type ='';
            $input_title='';
              
            $longitud = 0;
            $numeroCampos=$contador*1;
            $bloque=0;
            $_flat=1;

            $id_query =  $this->db->insert_id();
            while ($longitud < $numeroCampos)
            {                    
                $input_title    = $data['A'.$_flat];
                $input_name     = $data['B'.$_flat];
                $input_type     = $data['C'.$_flat];
                
                $parametros = array(
                    'input_name'        => $input_name,           
                    'input_type'        => $input_type,
                    'title'             => $input_title, 
                    'id_global_report'  => $id_query,            
                    'input_state'       => 1
                );
                $this->db->insert(self::parametros,$parametros);

                $_flat+=1;
                $longitud++;                   
            }
        }            

    }

    public function getReportes(){
        $this->db->select('*');
        $this->db->from(self::querys);        
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    public function getParametros($id){
        $this->db->select('*');
        $this->db->from(self::parametros);   
        $this->db->where('id_global_report',$id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    // Obtener la query mas el tipo de grafica segun la consulta seleccionada
    public function getDataQuery($id){
        $this->db->select('*');
        $this->db->from(self::querys);         
        $this->db->join(self::tipos_grafica,' on '. 
                        self::tipos_grafica.'.global_report_chart_id = '.
                        self::querys.'.chart_type_id');
        $this->db->where(self::querys.'.id_global_report',$id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function getBuilQuery($oParameter,$sTringQuery){
        $query;
        eval("\$query = \"$sTringQuery\";");

        $aSettings =  $this->db->query($query)->result();
        return $aSettings;
    }
    
}
