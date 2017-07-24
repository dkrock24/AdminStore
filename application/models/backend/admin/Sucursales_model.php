<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sucursales_model extends CI_Model
{
    const sys_sucursal              = 'sys_sucursal';
    const sys_sucursal_nodo         = 'sys_sucursal_nodo';
    const sys_nodo                  = 'sys_nodo';
    const sys_pais_departamento     = 'sys_pais_departamento';
    const sys_pais                  = 'sys_pais';   
    const sys_sucursal_int_usuarios = 'sys_sucursal_int_usuarios';   
    const sys_secuencia             = 'sys_secuencia';
    const sys_sucursal_pc           = 'sys_sucursal_pc';
    

    
    public function __construct()
    {
        parent::__construct();
        
    }

    // Sucurales con departamentos y paises
    public function getSucursales()
    {
        $this->db->select('*');
        $this->db->from(self::sys_sucursal);
        $this->db->join(self::sys_pais_departamento,' on '. 
                        self::sys_pais_departamento.'.id_departamento = '.
                        self::sys_sucursal.'.id_departamento');
        $this->db->join(self::sys_pais,' on '. 
                        self::sys_pais.'.id_pais = '.
                        self::sys_pais_departamento.'.id_pais');
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }

    // Obtener las compuitadoras que estan asociadas a la sucursal
    public function getPcPorSucursal($id_sucursal){

        $this->db->select('*');
        $this->db->from(self::sys_sucursal);
        
        $this->db->join(self::sys_sucursal_pc,' on '. 
                        self::sys_sucursal_pc.'.id_sucursal = '.
                        self::sys_sucursal.'.id_sucursal');

        $this->db->where(self::sys_sucursal.'.id_sucursal',$id_sucursal);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    // Nueva pc para la sucursal
    public function setPc($pc_nombre,$id_sucursal){
        $data = array(
            'mac_address'   => $pc_nombre,
            'id_sucursal'   => $id_sucursal,
            'fecha_creacion' => $date = date("Y-m-d"),
            'estado' => 1
        );
        $this->db->insert(self::sys_sucursal_pc,$data);
    }

    // Eliminar cp
        public function eliminarPc($id_pc)
        {
            $data = array(
            'id_pc' => $id_pc        
            );
            $this->db->delete(self::sys_sucursal_pc, $data);
        }

    // Get Sucurales
    public function getOnlySucursal()
    {
        $this->db->select('*');
        $this->db->from(self::sys_sucursal);        
        $query = $this->db->get();        
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }

    // Crear Sucursal
    public function save($sucursal){
        session_start();
        if(isset($sucursal['CProduccion']))
        {
            $cp =  $sucursal['CProduccion'];
        }
        else{
            $cp = "";
        }
        $data = array(
            'id_departamento'   => $sucursal['departamento'],
            'nombre_sucursal'   => $sucursal['nombre'],
            'direccion'         => $sucursal['direccion'],
            'telefono'          => $sucursal['telefono'],
            'celular'           => $sucursal['celular'],
            'referencia_zona'   => $sucursal['zona'],
            'numero_mesas'      => $sucursal['mesas'],
            'estado'            => $sucursal['estado'],
            'centro_produccion' => $cp,
            'creado_usuario'    => $_SESSION['idUser']
        );
        $this->db->insert(self::sys_sucursal,$data);

        //Crear Cada Nodo Para la sucursal que se crea
        $id_last_sucursal = $this->db->insert_id();

        // Insertar La Secuencia de esta sucursal
        $date = date("Y-m-d");
        $data_secuencia = array(
            'id_sucursal'   => $id_last_sucursal,
            'fecha_secuencia'   => $date,
            'valor_secuencia'   => "0000"
        );
        $this->db->insert(self::sys_secuencia,$data_secuencia);

        //Obtener Todos Los Nodos
        $nodos = $this->getNodos();
        foreach ($nodos as $nodo) {
            $this->crearSucursalNodo($id_last_sucursal,$nodo->id_nodo,0);
        }
    }

    // Actualizar Sucursal
    public function saveUpdate($sucursal,$id_sucursal){
        
        $data = array(
            'id_departamento'   => $sucursal['departamento'],
            'nombre_sucursal'   => $sucursal['nombre'],
            'direccion'         => $sucursal['direccion'],
            'telefono'          => $sucursal['telefono'],
            'celular'           => $sucursal['celular'],
            'referencia_zona'   => $sucursal['zona'],
            'numero_mesas'      => $sucursal['mesas'],
            'estado'            => $sucursal['estado']
        );
        $this->db->where('id_sucursal', $id_sucursal);        
        $this->db->update(self::sys_sucursal,$data);
    }    

    // Sucursales por ID
    public function getSucursalesByID($id_sucursal)
    {
        $this->db->select('*');
        $this->db->from(self::sys_sucursal);
        $this->db->join(self::sys_pais_departamento,' on '. 
                        self::sys_pais_departamento.'.id_departamento = '.
                        self::sys_sucursal.'.id_departamento');
        $this->db->join(self::sys_pais,' on '. 
                        self::sys_pais.'.id_pais = '.
                        self::sys_pais_departamento.'.id_pais');
        $this->db->where(self::sys_sucursal.'.id_sucursal',$id_sucursal); 
        $query = $this->db->get();
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }

    // Delete Sucursal
    public function delete($id_sucursal)
    {

        $data = array(
            'id_sucursal' => $id_sucursal        
        );
        $this->db->delete(self::sys_secuencia, $data);
        $this->db->delete(self::sys_sucursal_nodo, $data);        
        $this->db->delete(self::sys_sucursal_int_usuarios, $data);   
        $this->db->delete(self::sys_sucursal, $data);  
        
    }

    // Sucurales por Departamentos
    public function getSucursalesByDepartamento($id_departamento)
    {
        $this->db->select('*');
        $this->db->from(self::sys_sucursal);
        $this->db->join(self::sys_pais_departamento,' on '. 
                        self::sys_pais_departamento.'.id_departamento = '.
                        self::sys_sucursal.'.id_departamento');        
        $this->db->where(self::sys_pais_departamento.'.id_departamento',$id_departamento); 
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }

    // Nodos Por Sucursal
        public function getNodosSucursal($id){
            $this->db->select('*');
            $this->db->from(self::sys_sucursal);
            $this->db->join(self::sys_sucursal_nodo,' on '. 
                            self::sys_sucursal_nodo.'.id_sucursal = '.
                            self::sys_sucursal.'.id_sucursal');  
            $this->db->join(self::sys_nodo,' on '. 
                            self::sys_nodo.'.id_nodo = '.
                            self::sys_sucursal_nodo.'.id_nodo');        
            $this->db->where(self::sys_sucursal.'.id_sucursal',$id); 
            $query = $this->db->get();
            //echo $this->db->queries[0];
            
            if($query->num_rows() > 0 )
            {
                return $query->result();
            }        
        }


    //  Sucursal
        public function getSucursal($id){
            $this->db->select('*');
            $this->db->from(self::sys_sucursal);
            $this->db->join(self::sys_sucursal_nodo,' on '. 
                            self::sys_sucursal_nodo.'.id_sucursal = '.
                            self::sys_sucursal.'.id_sucursal');  
            $this->db->join(self::sys_nodo,' on '. 
                            self::sys_nodo.'.id_nodo = '.
                            self::sys_sucursal_nodo.'.id_nodo');        
            $this->db->where(self::sys_sucursal.'.id_sucursal',$id); 
            $query = $this->db->get();
            //echo $this->db->queries[0];
            
            if($query->num_rows() > 0 )
            {
                return $query->result();
            }        
        }

    // Check nodos por sucursal
        public function checkNodosSucursal($id,$estado){     
            $data = array(
                'sucursal_estado_nodo'   => $estado            
            );
            $this->db->where('id_nodo_sucursal', $id);        
            $this->db->update(self::sys_sucursal_nodo,$data);
        }

    // Get Nodos
        public function getNodos(){
            $this->db->select('*');
            $this->db->from(self::sys_nodo);           
            $query = $this->db->get();            
            
            if($query->num_rows() > 0 )
            {
                return $query->result();
            }        
        }

    // Crear sucursal-nodo
        public function crearSucursalNodo($sucursal,$nodo,$estado){
            $data = array(
                'id_sucursal'           => $sucursal,
                'id_nodo'               => $nodo,
                'sucursal_estado_nodo'  => $estado
            );
            $this->db->insert(self::sys_sucursal_nodo,$data);
        }

    // Crear Nuevo Nodo
        public function saveNodo($nodo){

            $data = array(
                'nombre_nodo'       => $nodo['nombre'],
                'categoria_nodo'    => $nodo['categoria'],
                'url_nodo'          => $nodo['url'],
                'estado_nodo'       => $nodo['estado']
            );

            $this->db->insert(self::sys_nodo,$data);
            $id_last_nodo = $this->db->insert_id();

            //Obtener las sucursales
            $sucursal = $this->getOnlySucursal();
            foreach ($sucursal as $sucursales) {
                $this->crearSucursalNodo($sucursales->id_sucursal,$id_last_nodo,0);
            }
        }

    //Get Nodo By ID
        public function getNodoByID($id){
            $this->db->select('*');
            $this->db->from(self::sys_nodo);              
            $this->db->where(self::sys_nodo.'.id_nodo',$id); 
            $query = $this->db->get();
            //echo $this->db->queries[0];
            
            if($query->num_rows() > 0 )
            {
                return $query->result();
            }        
        }

    // Update Nodo
        public function updateNodo($id,$nodo){     
            $data = array(
                'nombre_nodo'       => $nodo['nombre'],
                'categoria_nodo'    => $nodo['categoria'],
                'url_nodo'          => $nodo['url'],
                'estado_nodo'       => $nodo['estado']            
            );
            $this->db->where('id_nodo', $id);        
            $this->db->update(self::sys_nodo,$data);
        }

    // Delete Nodo Sucursal
        public function deleteNodo($id)
        {
            $data = array(
                'id_nodo' => $id
            );
            $this->db->delete(self::sys_nodo, $data);         
        }

    // Guardar Acceso Por Usuario a Sucursal
        public function saveAcceso($id_usuario,$sucursal){   
            if($this->getAccesosSucursal($id_usuario,$sucursal)=="")
            {         
                session_start();
                $data = array(
                    'id_sucursal'   => $sucursal['sucursal'],
                    'id_usuario'    => $id_usuario,
                    'estado'        => 1,                
                    'creado_por'    =>  $_SESSION['idUser']
                );
                $this->db->insert(self::sys_sucursal_int_usuarios,$data);
            }
        }  

    // Obtener Accesos Sucursal Por Usuario
        public function getAccesosSucursal($id_usuario,$sucursal){
            $this->db->select('*');
            $this->db->from(self::sys_sucursal_int_usuarios);                
            $this->db->where(self::sys_sucursal_int_usuarios.'.id_usuario',$id_usuario); 
            $this->db->where(self::sys_sucursal_int_usuarios.'.id_sucursal',$sucursal['sucursal']); 
            $query = $this->db->get();
            //echo $this->db->queries[4];
            
            if($query->num_rows() > 0 )
            {
                return $query->result();
            }
        }
    // Delete Accesos Sucursal Por Usuario
        public function deleteAcceso($id)
        {
            $data = array(
                'id' => $id
            );
            $this->db->delete(self::sys_sucursal_int_usuarios, $data);         
        }

    // Sucursales por usuario
        public function sucursalAccesos($id_usuario){
            $this->db->select('*');
            $this->db->from(self::sys_sucursal_int_usuarios);
            $this->db->join(self::sys_sucursal,' on '. 
                            self::sys_sucursal.'.id_sucursal = '.
                            self::sys_sucursal_int_usuarios.'.id_sucursal');       
            $this->db->where(self::sys_sucursal_int_usuarios.'.id_usuario',$id_usuario); 
            $query = $this->db->get();
            //echo $this->db->queries[4];
            
            if($query->num_rows() > 0 )
            {
                return $query->result();
            }    
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