<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class impuesto_model extends CI_Model
{
    const sys_sucursal              = 'sys_sucursal';
    const sys_pais_departamento     = 'sys_pais_departamento';
    const sys_pais                  = 'sys_pais';
    const sys_sucursal_impuesto     = 'sys_sucursal_impuesto';
    const sys_pais_impuesto         = 'sys_pais_impuesto';

    
    public function __construct()
    {
        parent::__construct();
        
    }

    public function getImpuestos()
    {
        $this->db->from(self::sys_sucursal);
        $this->db->join(self::sys_pais_departamento,' on '. 
                        self::sys_pais_departamento.'.id_departamento = '.
                        self::sys_sucursal.'.id_departamento');
        $this->db->join(self::sys_pais,' on '. 
                        self::sys_pais.'.id_pais = '.
                        self::sys_pais_departamento.'.id_pais');
        $this->db->join(self::sys_sucursal_impuesto,' on '. 
                        self::sys_sucursal_impuesto.'.id_sucursal = '.
                        self::sys_sucursal.'.id_sucursal');
        $this->db->where(self::sys_sucursal_impuesto.'.estado_impuesto',1);
        $query = $this->db->get();
        
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }       
    }
    public function saveImpuesto($data){
        session_start();
        $date = date("Y-m-d");
        $data = array(
            'id_sucursal'   => $data['sucursal'],           
            'nombre_impuesto'    => $data['nombre'], 
            'monto_impuesto'   => $data['monto'], 
            'descripcion_impuesto'   => $data['descripcion'], 
            'creado'    => $date,            
            'estado_impuesto'    => $data['estado'],
            'id_usuario'    => $_SESSION['idUser']            
        );
        $this->db->insert(self::sys_sucursal_impuesto,$data);
    }
    public function getImpuestosByID($id)
    {
        $this->db->from(self::sys_sucursal);
        $this->db->join(self::sys_pais_departamento,' on '. 
                        self::sys_pais_departamento.'.id_departamento = '.
                        self::sys_sucursal.'.id_departamento');
        $this->db->join(self::sys_pais,' on '. 
                        self::sys_pais.'.id_pais = '.
                        self::sys_pais_departamento.'.id_pais');
        $this->db->join(self::sys_sucursal_impuesto,' on '. 
                        self::sys_sucursal_impuesto.'.id_sucursal = '.
                        self::sys_sucursal.'.id_sucursal');
        $this->db->where(self::sys_sucursal_impuesto.'.id_impuesto',$id);
        $query = $this->db->get();        
        //echo $this->db->queries[0];        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }

    public function updateImpuesto($impuesto,$id_impuesto){
        
        $data = array(
            'id_sucursal'   => $impuesto['sucursal'],           
            'nombre_impuesto'    => $impuesto['nombre'], 
            'monto_impuesto'   => $impuesto['monto'], 
            'descripcion_impuesto'   => $impuesto['descripcion'], 
            'estado_impuesto'            => $impuesto['estado']
        );
        $this->db->where('id_impuesto', $id_impuesto);        
        $this->db->update(self::sys_sucursal_impuesto,$data);
    } 

    public function getImpuestosPais()
    {
        $this->db->from(self::sys_pais_impuesto);
        $this->db->join(self::sys_pais,' on '. 
                        self::sys_pais.'.id_pais = '.
                        self::sys_pais_impuesto.'.id_pais');
        $this->db->where(self::sys_pais_impuesto.'.estado_impuesto',1);
        $query = $this->db->get();        
        //echo $this->db->queries[0];        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }       
    } 
    public function saveImpuestoPais($data){
        session_start();
        $date = date("Y-m-d");
        $data = array(
            'id_pais'               => $data['pais'],           
            'nombre_impuesto'       => $data['nombre'], 
            'monto_impuesto'        => $data['monto'], 
            'descripcion_impuesto'  => $data['descripcion'], 
            'creado'                => $date,            
            'estado_impuesto'       => $data['estado'],
            'id_usuario'            => $_SESSION['idUser']            
        );
        $this->db->insert(self::sys_pais_impuesto,$data);
    }
    public function getImpuestosPaisById($id)
    {
        $this->db->from(self::sys_pais_impuesto);
        $this->db->join(self::sys_pais,' on '. 
                        self::sys_pais.'.id_pais = '.
                        self::sys_pais_impuesto.'.id_pais');
        $this->db->where(self::sys_pais_impuesto.'.id_impuesto',$id);
        $query = $this->db->get();        
        //echo $this->db->queries[0];        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }       
    } 
    public function updateImpuestoPais($impuesto,$id_impuesto){
        
        $data = array(
            'id_pais'               => $impuesto['pais'],           
            'nombre_impuesto'       => $impuesto['nombre'], 
            'monto_impuesto'        => $impuesto['monto'], 
            'descripcion_impuesto'  => $impuesto['descripcion'], 
            'estado_impuesto'       => $impuesto['estado']
        );
        $this->db->where('id_impuesto', $id_impuesto);        
        $this->db->update(self::sys_pais_impuesto,$data);
    } 
    public function deleteImpuestoPais($id){
        
         $data = array(
            'id_impuesto' => $id
        );
        $this->db->delete(self::sys_pais_impuesto, $data);    
    }
    public function deleteImpuestoSucursal($id){
        
         $data = array(
            'id_impuesto' => $id
        );
        $this->db->delete(self::sys_sucursal_impuesto, $data);    
    }


     
    
}
/*
 * end of application/models/consultas_model.php
 */

/*
this->db->select('*');
        $this->db->from(self::menu);
        $this->db->join('sr_accesos as A','on '. self::menu .'.id_menu = A.id_menu');
        $this->db->join('sr_roles as R','on R.id_rol = A.id_rol');
        //$this->db->join('sr_submenu as S','on '. self::menu .'.id_menu = S.id_menu');
        $this->db->where('R.id_rol',$rol);        
        $this->db->where('A.estado',1);     
        $this->db->where('A.estado',1); 

        */