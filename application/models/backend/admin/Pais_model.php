<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class pais_model extends CI_Model
{
    const sys_sucursal      = 'sys_sucursal';
    const sys_pais_departamento  = 'sys_pais_departamento';
    const sys_pais          = 'sys_pais';
    

    
    public function __construct()
    {
        parent::__construct();
        
    }

    public function getPaises()
    {
        $this->db->select('*');
        $this->db->from(self::sys_pais);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }
    
    public function savePais($pais){
        session_start();
        $date = date("Y-m-d H:m:s");
        $data = array(
            'nombre_pais'   => $pais['nombre'],           
            'id_usuario'    => $_SESSION['idUser'],
            'registro_legal'   => $pais['registro_legal'], 
            'fecha_creacion'    => $date,            
            'estado'    => $pais['estado']
        );
        $this->db->insert(self::sys_pais,$data);
    }
    public function getPaisByID($id_pais)
    {
        $this->db->select('*');
        $this->db->from(self::sys_pais);
        $this->db->where(self::sys_pais.'.id_pais',$id_pais);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }
    public function saveUpdate($pais,$id_pais){
        
        $data = array(
            'nombre_pais'   => $pais['nombre'],    
            'registro_legal'   => $pais['registro_legal'],        
            'estado'    => $pais['estado']
        );
        $this->db->where('id_pais', $id_pais);        
        $this->db->update(self::sys_pais,$data);
    }
    // Delete Pais
    public function delete($id_pais)
    {
        $data = array(
            'id_pais' => $id_pais
        );
        $this->db->delete(self::sys_pais, $data);         
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