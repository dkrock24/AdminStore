<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class departamentos_model extends CI_Model
{
    const sys_sucursal      = 'sys_sucursal';
    const sys_pais_departamento  = 'sys_pais_departamento';
    const sys_pais          = 'sys_pais';
    

    
    public function __construct()
    {
        parent::__construct();
        
    }

    public function getDepartamentos()
    {
        $this->db->select('*');
        $this->db->from(self::sys_pais_departamento);
        $this->db->join(self::sys_pais,' on '. self::sys_pais .'.id_pais ='.self::sys_pais_departamento.'.id_pais');
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }
    public function getOneDepartamento($id_pais)
    {
        $this->db->select('*');
        $this->db->from(self::sys_pais_departamento);
        $this->db->join(self::sys_pais,' on '. self::sys_pais .'.id_pais ='.self::sys_pais_departamento.'.id_pais');
        $this->db->where(self::sys_pais_departamento.'.id_pais', $id_pais);

        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }

    // Guardar Nuevo Departamento
    public function save($departamento){
        session_start();
        $data = array(
            'id_pais'   => $departamento['pais'],
            'nombre_departamento'    => $departamento['nombre'],
            'usuario'   => $_SESSION['idUser'],
            'estado_departamento'    => $departamento['estado'],
            
        );
        $this->db->insert(self::sys_pais_departamento,$data);
    }
    //Update Departamento
    public function saveUpdate($departamento, $id_departamento){
        session_start();
        $data = array(
            'id_pais'               => $departamento['pais'],
            'nombre_departamento'   => $departamento['nombre'],            
            'estado_departamento'   => $departamento['estado'],
            
        );
        $this->db->where('id_departamento', $id_departamento);    
        $this->db->update(self::sys_pais_departamento,$data);
    }

    public function getByID($id_departamento)
    {
        $this->db->select('*');
        $this->db->from(self::sys_pais_departamento);
        $this->db->join(self::sys_pais,' on '. self::sys_pais .'.id_pais ='.self::sys_pais_departamento.'.id_pais');
        $this->db->where(self::sys_pais_departamento.'.id_departamento',$id_departamento);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }

    // Delete Departamento
    public function delete($id_departamento)
    {
        $data = array(
            'id_departamento' => $id_departamento
        );
        $this->db->delete(self::sys_pais_departamento, $data);         
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