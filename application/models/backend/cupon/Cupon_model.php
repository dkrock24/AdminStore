<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cupon_model extends CI_Model
{
    const sys_cupon = 'sys_cupon';  
    const sys_cupon_categoria = 'sys_cupon_categoria';
    
    public function __construct()
    {
        parent::__construct();
        
    }

    //Generar Cupones
    public function setCupon($codigo,$categoria,$descripcion)
    {
        $igual=0;

        //Identificar si existen cupones iguales
        $this->db->select('codigo_cupon');
        $this->db->from(self::sys_cupon);   
        $this->db->where('codigo_cupon',$codigo);          
        $query = $this->db->get();   
        echo $query->num_rows();
        if($query->num_rows() > 0 )
        {
            $codigo=$codigo.rand(2,100);
        }

        $date = date("Y-m-d");
        $data = array(
            'codigo_cupon' => $codigo,
            'id_categoria' => $categoria,
            'estado_cupon' => 0  ,
            'descripcion_cupon' => $descripcion,
            'fecha_creacion_cupon'=>$date
        );
        $this->db->insert(self::sys_cupon,$data);  
    }
    // Cupones Activos
    public function getCuponActivo()
    {
        $this->db->select('count(*) as activos');
        $this->db->from(self::sys_cupon);
        $this->db->where('estado_cupon',0);
        $query = $this->db->get();        
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }     
    }
    // Cupones Inactivos
    public function getCuponInactivo()
    {
        $this->db->select('count(*) as inactivos');
        $this->db->from(self::sys_cupon);
        $this->db->where('estado_cupon',1);
        $query = $this->db->get();        
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }     
    }

    // Get Cupones
    public function getCupones()
    {
        $this->db->select('*');
        $this->db->from(self::sys_cupon);
         $this->db->join(self::sys_cupon_categoria,' on '. 
                        self::sys_cupon_categoria.'.id_cupon_categoria = '.
                        self::sys_cupon.'.id_categoria');
        $this->db->order_by(self::sys_cupon_categoria.'.id_cupon_categoria',"asc");
        
        $query = $this->db->get();        
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }    
    }

    // Guardar Categoria de Cupones
    public function setCategoria($categoria){
        $data = array(
            'nombre_categoria' => $categoria['nombre_categoria'],
            'valor_categoria' => $categoria['categoria_valor'],            
            'estado_categoria' => 1            
        );
        $this->db->insert(self::sys_cupon_categoria,$data);  
    }

    // Obtener las Categorias de los cupones
    public function getCategoriasCupones(){
        //$this->db->select('COUNT(sys_cupon.id_cupon) AS T, sys_cupon_categoria.*');
        //$this->db->from(self::sys_cupon_categoria);      
        //$this->db->join(self::sys_cupon,' on '.   
                        //self::sys_cupon.'.id_categoria = '.
                        //self::sys_cupon_categoria.'.id_cupon_categoria'); 

        $query = "select count(sys_cupon.id_cupon)as T, sys_cupon_categoria.* from
sys_cupon 
right join sys_cupon_categoria on 
sys_cupon.id_categoria= sys_cupon_categoria.id_cupon_categoria
group by sys_cupon_categoria.id_cupon_categoria;";
        $query = $this->db->query($query);  
        $data = $query->result_array();      
        //$query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }  
    }

    public function eliminarCategoria($id){
        $data = array(
            'id_cupon_categoria' => $id
        );
        $this->db->delete(self::sys_cupon_categoria, $data);   
    }

    public function getCuponesByID($id){
        $this->db->select('*');
        $this->db->from(self::sys_cupon);        
        $this->db->where(self::sys_cupon.".id_cupon",$id);     
        $query = $this->db->get();        
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }  
    }

    public function getBachCupone($categoria,$fecha,$descripcion){
        $this->db->select('*');
        $this->db->from(self::sys_cupon);       
        $this->db->join(self::sys_cupon_categoria,' on '. 
                        self::sys_cupon_categoria.'.id_cupon_categoria = '.
                        self::sys_cupon.'.id_categoria'); 
        $this->db->where(self::sys_cupon.".id_categoria",$categoria);     
        $this->db->where(self::sys_cupon.".fecha_creacion_cupon",$fecha);  
        $this->db->where(self::sys_cupon.".descripcion_cupon",$descripcion);  

        $query = $this->db->get();        
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    
}
/*
 * end of application/models/consultas_model.php
 */
