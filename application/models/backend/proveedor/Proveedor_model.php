<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class proveedor_model extends CI_Model
{
    const proveedor = 'sys_proveedores';
    const sucursal = 'sys_sucursal';
    const proveedorSucursal = 'sys_proveedores_sucursal';

    
    public function __construct()
    {
        parent::__construct();
        
    }
   
    public function getProveedor()
    {
        $query = $this->db->query('Select p.id_proveedor, p.nombre_proveedor, p.descripcion_proveedor, p.correo_proveedor, p.direccion_proveedor, p.telefono_proveedor, p.contacto_referencia_proveedor, p.fecha_creacion_proveedor, ps.id_proveedor_sucursal as proveedorAsociado
            from sys_proveedores p
            left join sys_proveedores_sucursal ps ON ps.id_proveedor =p.id_proveedor
            group by p.id_proveedor');
         return $query->result();  
        
    }

    public function getSucursales()
    {
        $this->db->select('*');
        $this->db->from(self::sucursal);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function getProveedorByID($proveedorID)
    {
        $this->db->select('*');
        $this->db->from(self::proveedor);
        $this->db->where(self::proveedor.'.id_proveedor',$proveedorID); 
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

     public function getSucursalById($sucursalID)
    {
        $this->db->select('*');
        $this->db->from(self::sucursal);
        $this->db->where(self::sucursal.'.id_sucursal',$sucursalID); 
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

     public function getProveedorByIDJoin($proveedorID)
    {
         $query = $this->db->query('Select p.nombre_proveedor, p.descripcion_proveedor,p.correo_proveedor,p.direccion_proveedor,p.telefono_proveedor,p.contacto_referencia_proveedor,
            group_concat(s.nombre_sucursal, "  ") as asociadas
            from sys_proveedores p 
            inner join sys_proveedores_sucursal ps on ps.id_proveedor = p.id_proveedor 
            inner join sys_sucursal s on s.id_sucursal = ps.id_sucursal
            where p.id_proveedor = '.$proveedorID.'
            group by p.id_proveedor');
         return $query->result(); 
        
    }


    public function proveedorBySucursal($sucursalID)
    {
      $query = $this->db->query('Select *
        from sys_sucursal   s
        inner join sys_proveedores_sucursal ps on ps.id_sucursal = s.id_sucursal
        inner join sys_proveedores p on p.id_proveedor = ps.id_proveedor
        where s.id_sucursal ='.$sucursalID);
         return $query->result(); 
        
    }

    public function save_proveedor($proveedor)
    {
        //var_dump($proveedor);
        $dateNow = date("Y-m-d");
       
        $prove = array(
             'nombre_proveedor'      => $proveedor['empresaP'],
             'descripcion_proveedor'    => $proveedor['descripcionP'],
             'correo_proveedor'    => $proveedor['correoP'],
             'direccion_proveedor'    => $proveedor['direccionP'],
             'telefono_proveedor'    => $proveedor['telefonoP'],
             'contacto_referencia_proveedor'    => $proveedor['contactoR'],
             'fecha_creacion_proveedor'    => $dateNow
             );
        
        $this->db->insert(self::proveedor,$prove);
    }


    public function delete_proveedor($datos)
    {
         $data = array(
            'id_proveedor' => $datos['proveedorID']
        );
        $this->db->delete(self::proveedor, $data); 
    }

    public function update_proveedor($proveedor){
        session_start();
        $data = array(
            'nombre_proveedor'   => $proveedor['empresaP'],
            'descripcion_proveedor'   => $proveedor['descripcionP'],            
            'correo_proveedor'   => $proveedor['correoP'],
            'direccion_proveedor'   => $proveedor['direccionP'],
            'telefono_proveedor'   => $proveedor['telefonoP'],
            'contacto_referencia_proveedor'   => $proveedor['contactoR'],
            
        );
        $this->db->where('id_proveedor', $proveedor['proveedorID']);    
        $this->db->update(self::proveedor,$data);
    }

     public function getSucursalesDinamic($proveedorID)
    {
        //var_dump($proveedorID);
        $query = $this->db->query("Select s.id_sucursal as id, IF(s.centro_produccion = '1', CONCAT(s.nombre_sucursal,'', '(CProduccion)'), s.nombre_sucursal) as name, p.nombre_pais, ps.id_proveedor_sucursal as validate 
            from sys_sucursal s 
            inner join sys_pais_departamento pd on pd.id_departamento = s.id_departamento
            inner join sys_pais p on p.id_pais = pd.id_pais
            left join sys_proveedores_sucursal ps on ps.id_sucursal = s.id_sucursal 
            and ps.id_proveedor =".$proveedorID);
         return $query->result();
         //return $query->result_array();
    
    }

    public function associate_producto($datos)
    {  
        $sucursalP = array(
             'id_proveedor'      => $datos['idProveedor'],
             'id_sucursal'    => $datos['SucursalId'],
             'estado_proveedor_sucursal'    => '1'
             );
        
        $this->db->insert(self::proveedorSucursal,$sucursalP);
    }

    public function disassociate_producto($datos)
    {
         $data = array(
            'id_sucursal' => $datos['SucursalId'],
            'id_proveedor' => $datos['idProveedor']
        );
        $this->db->delete(self::proveedorSucursal, $data); 
    }

    public function quitar_proveedor_sucursal($datos)
    {
         $data = array(
            'id_proveedor_sucursal' => $datos['sucurProveedorID']
        );
        $this->db->delete(self::proveedorSucursal, $data); 
    }

}
/*
 * end of application/models/consultas_model.php
 */
