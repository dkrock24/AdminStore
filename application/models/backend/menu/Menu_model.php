<?php
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class menu_model extends CI_Model
{
    const libreria = 'sr_librerias';
    const configuracion = 'sr_config';
    const menu = 'sr_menu';
    const empresa = 'sr_empresa';
    const usuarios = 'sr_usuarios';    
    const roles = 'sr_roles';
    const cargos = 'sr_cargos';
    const home_menu = 'home_menu';
    const home_submenu = 'home_submenu';
    const home_iconos = 'home_iconos';
    const sr_avatar = 'sr_avatar';
    const home_menu_entradas = 'home_menu_entradas';

    

    

    

    
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
    public function getIcono()
    {
        $this->db->select('*');
        $this->db->from(self::home_iconos); 
        $query = $this->db->get();      
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }         
    }
    public function getMenu()
    {
        $this->db->select('*');
        $this->db->from(self::home_menu); 
        $query = $this->db->get();      
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }         
    }
    
    public function getMenu1()
    {
        $this->db->select('*');
        $this->db->from(self::menu); 
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

    // Funciones Para Homepages
    public function saveHomePageMenu($data)
    {
        $home_page = array(
            'nombre_menu'   => $data['nombre_menu'],
            'url_menu'      => $data['url_menu'],
            'icon_menu'     => $data['nombreImagen'],
            'class_menu'    => $data['class_menu'],            
            'seccion'       => $data['seccion'],  
            'pages'         => $data['pages'],
            'estado_menu'   => $data['estado_menu']
        );
        $this->db->insert(self::home_menu,$home_page);         
        return 1;       
    }
    public function saveHomeSubMenu($data)
    {
        $home_page = array(
            'nombre_submenu'    => $data['nombre_submenu'],
            'url_submenu'       => $data['url_submenu'],
            'titulo_submenu'    => $data['icon_submenu'],
            'icon_menu'         => $data['icon'],
            'id_menu'           => $data['menuPadre'],            
            'estado_submen'     => $data['estado_menu']            
        );
        $this->db->insert(self::home_submenu,$home_page); 
        return 1;       
    }
    public function getPerfil()
    {
        if(isset($_SESSION['idUser'][0]))
        {
            $this->db->select('*');
            $this->db->from(self::usuarios);
            $this->db->join(self::cargos.' as C','on '. self::usuarios .'.cargo = C.id_cargo');     
            $this->db->where(self::usuarios.'.id_usuario',$_SESSION['idUser'][0]);        
            $query = $this->db->get();      
            //echo $this->db->queries[0];   
            //exit();

            if($query->num_rows() > 0 )
            {
                return $query->result();
            }              
        }
    }
    public function getAvatar(){

        $this->db->select('*');
        $this->db->from(self::sr_avatar);            
        $this->db->where('usuario_avatar','sistema');        
        $query = $this->db->get();      

        if($query->num_rows() > 0 )
        {
            return $query->result();
        }          
    }
    public function getAvatarPersonal(){

        $this->db->select('*');
        $this->db->from(self::sr_avatar);            
        $this->db->where('usuario_id',$_SESSION['idUser'][0]);        
        $this->db->where('estado_avatar',1); 
        $query = $this->db->get();      

        if($query->num_rows() > 0 )
        {
            return $query->result();
        }          
    }

    // Retorna los Menus del portal de UAIP
    public function getMenuHome($id){
        $this->db->select('*');
        $this->db->from(self::home_menu_entradas);            
        $this->db->where('id_submenu',$id);
        $this->db->where('estado',1);
        $query = $this->db->get();

        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    public function getCountEntradas($id){
        $this->db->select('count(*) as total');
        $this->db->from(self::home_menu_entradas);            
        $this->db->where('id_submenu',$id);
        $this->db->where('estado',1);
        $query = $this->db->get();

        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    public function getEntradas($id,$start_from,$limit){
        
        $this->db->select('*');
        $this->db->from(self::home_menu_entradas);            
        $this->db->where('id_submenu',$id);
        //$this->db->where('estado',1);        
        //$this->db->order_by("id_entrada", "asc");
        $this->db->limit($limit,$start_from);
        //$this->db->limit(10,20)->get_compiled_select('mytable', FALSE);
        //echo $this->db->queries[0];   

        $query = $this->db->get();

        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    public function getEntradaByID($id_entrada){
        $this->db->select('*');
        $this->db->from(self::home_menu_entradas);            
        $this->db->where('id_entrada',$id_entrada);
        $query = $this->db->get();

        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    public function deleteEntradaByID($id_entrada){

        $data = array(
            'id_entrada' => $id_entrada
        );
        $this->db->delete(self::home_menu_entradas, $data); 
    }
}
/*
 * end of application/models/consultas_model.php
 */
