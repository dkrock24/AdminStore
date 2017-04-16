<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class login_model extends CI_Model
{
    const libreria          = 'sr_librerias';
    const configuracion     = 'sr_config';
    const menu              = 'sr_menu';
    const sr_submenu        = 'sr_submenu';
    const empresa           = 'sr_empresa';
    const usuarios          = 'sr_usuarios';
    const logs          = 'sr_log_acceso';

    
    public function __construct()
    {
        parent::__construct();
        
    }
    //obtenemos las entradas de todos o un usuario, dependiendo
    // si le pasamos le id como argument o no
    public function laodLib($location,$parte)
    {
        $this->db->select('*');
        $this->db->from(self::libreria);
        $this->db->where('location',$location);
        $this->db->where('parte',$parte);
        $this->db->where('estado_lib',1);
        //$this->db->join('track_domain as D','D.idDomain = track_domain_site.idSiteDomain');
        //$this->db->join('track_users_rol as R','R.id_rol = track_users.rol');
        ///$this->db->join('track_users_positions as P','P.idPosition = track_users.idPosition');
        //$this->db->join('track_users as U','U.idUser = track_users.idSupervisor');
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
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
    public function submenu($rol)
    {
        $this->db->select('*');
        $this->db->from(self::sr_submenu);        
        $this->db->where('estado_submen',1); 
        $query = $this->db->get();      
        //echo $this->db->queries[0];   
        //exit();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }         
    }

    public function empresa()
    {
        $this->db->select('*');
        $this->db->from(self::empresa); 
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

    public function getSucursal($id_usuario){
        $query = $this->db->query('select * from sys_sucursal as S
                                    join sys_sucursal_int_usuarios as SU on SU.id_sucursal=S.id_sucursal
                                    where SU.id_usuario='.$id_usuario.' and SU.estado=1');    
        return $query->result(); 
    }
}
/*
 * end of application/models/consultas_model.php
 */
