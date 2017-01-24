<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class animacion_model extends CI_Model
{
    const libreria = 'sr_librerias';
    const configuracion = 'sr_config';
    const menu = 'sr_menu';
    const empresa = 'sr_empresa';
    const usuarios = 'sr_usuarios';    
    const roles = 'sr_roles';
    const cargos = 'sr_cargos';
    
    

    
    public function __construct()
    {
        parent::__construct();
        
    }
    //Actualizar Roles
    public function updateRol()
    {
        $data = array(
            'nombre_rol' => $_POST['nombre']
        );
        $this->db->where('id_rol', $_POST['id_rol']);
        $this->db->update(self::roles, $data);   
        //echo $this->db->queries[0];   
    }
    //Delete Rol
    public function deleteRol()
    {
        $data = array(
            'id_rol' => $_POST['id_rol']
        );
        $this->db->delete(self::roles, $data);  
        //echo $this->db->queries[0];   
    }

    //Actualizar Cargos
    public function updateCargo()
    {
        $data = array(
            'nombre_cargo' => $_POST['nombre']
        );
        $this->db->where('id_cargo', $_POST['id_cargo']);
        $this->db->update(self::cargos, $data);   
        //echo $this->db->queries[0];   
    }

    //Delete Cargos
    public function deleteCargo()
    {
        $data = array(
            'id_cargo' => $_POST['id_cargo']
        );
        $this->db->delete(self::cargos, $data);  
        //echo $this->db->queries[0];   
    }

    public function menu($rol)
    {
        $this->db->select('*');
        $this->db->from(self::menu);
        $this->db->join('sr_accesos as A','on '. self::menu .'.id_menu = A.id_menu');
        $this->db->join('sr_roles as R','on R.id_rol = A.id_rol');
        //$this->db->join('sr_submenu as S','on '. self::menu .'.id_menu = S.id_menu');
        $this->db->where('R.id_rol',$rol);        
        $this->db->where('A.estado',1);     
        $this->db->where('A.estado',1); 
        $query = $this->db->get();      
        //echo $this->db->queries[0];   
        //exit();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }         
    }
    public function getInfo()
    {
        $this->db->select('*');
        $this->db->from(self::empresa); 
        $query = $this->db->get();      
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }         
    }
    public function saveMenu()
    {
        $menu = array(
            'nombre_menu' => $_POST['nombre'],
            'url_menu' => $_POST['url'],
            'icon_menu' => $_POST['icon'],
            'class_menu' => $_POST['clas'],
            'id_rol_menu' => 1,
            'estado_menu' => $_POST['estado']
        );
        $this->db->insert(self::menu,$menu);        
    }
    public function getCargos()
    {
        $this->db->select('*');
        $this->db->from(self::cargos); 
        $query = $this->db->get();      
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }         
    }
    public function login($usuario,$password)
    {
        $pass = $this->encrypt($password);
        $this->db->select('*');
        $this->db->from(self::usuarios); 
        $this->db->where('usuario',$usuario);    
        $this->db->where('password',$pass);   
        $query = $this->db->get();            
        //echo $this->db->queries[0];   
        //exit(); 
          
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }  
        else{
            return 0;
        }       
    }
}
/*
 * end of application/models/consultas_model.php
 */
