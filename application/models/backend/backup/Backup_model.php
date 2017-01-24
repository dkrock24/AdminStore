<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class backup_model extends CI_Model
{
    const libreria = 'sr_librerias';
    const configuracion = 'sr_config';
    const menu = 'sr_menu';
    const empresa = 'sr_empresa';
    const usuarios = 'sr_usuarios';
    const backup    = 'log_backups';
    

    
    public function __construct()
    {
        parent::__construct();
        
    }
    public function loadConfig($location)
    {
        $this->db->select('*');
        $this->db->from(self::configuracion);
        $this->db->where('pages_config',$location);
        $this->db->where('estado_config',1);        
        $query = $this->db->get();         
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }         
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
    public function getBackup()
    {
        $this->db->select('*');
        $this->db->from(self::backup); 
        $this->db->order_by("id_bk", "desc");

        $query = $this->db->get();     
        //echo $this->db->queries[0];         
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
    public function getUserByID($id)
    {        
        $this->db->select('*');
        $this->db->from(self::usuarios); 
        $this->db->where('id_usuario',$id);
        $query = $this->db->get();      
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }
    function encrypt($password){
        return sha1($password);
    }
}
/*
 * end of application/models/consultas_model.php
 */
