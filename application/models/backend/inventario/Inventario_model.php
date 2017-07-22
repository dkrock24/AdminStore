<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class inventario_model extends CI_Model
{
    const materiales = 'sys_catalogo_materiales';
    const estatus = 'sys_estatus_meteriales';
    const sucursal = 'sys_sucursal';
    const categoriaMateriales = 'sys_categoria_materia_prima';
    const unidadMedida = 'sys_unidad_medida';
    const proveedores = 'sys_proveedores';
    const materialesSucursal = 'sys_catalogo_inventario_sucursal';
    const listMaterialProveedor = 'sys_list_inventario_proveedor';
    const materialesAdd = 'sys_materiales_add';
    const adicional = 'sys_materiales_adicionales';
    
    
    public function __construct()
    {
        parent::__construct();
        
    }
   
    public function getInventario()
    {
         $query = $this->db->query('Select cm.id_inventario, cm.codigo_material, cm.nombre_matarial, cm.descripcion_meterial, em.nombre_estatus, um.nombre_unidad_medida, cmp.nombre_categoria_materia, cm.fecha_creacion
                from sys_catalogo_materiales cm
                inner join sys_unidad_medida um on um.id_unidad_medida = cm.id_unidad_medida
                inner join sys_categoria_materia_prima cmp on cmp.id_categoria_materia = cm.id_categoria_material
                inner join sys_estatus_meteriales em on em.id_estatus = cm.estatus');
         //echo $this->db->queries[0];
        return $query->result();       
        
    }

    public function getEstatus()
    {
        $this->db->select('*');
        $this->db->from(self::estatus);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function getProveedores()
    {
        $this->db->select('*');
        $this->db->from(self::proveedores);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function getProveedoresBySucursal($sucursalID)
    {
         $query = $this->db->query("Select * 
        from sys_proveedores p
        inner join sys_proveedores_sucursal ps on ps.id_proveedor = p.id_proveedor
        where ps.id_sucursal =".$sucursalID['sucursalID']);
         //echo $this->db->queries[0];
        return $query->result();               
        
    }

    public function getNameSursal($sucursalID)
    {
        $this->db->select('*');
        $this->db->from(self::sucursal);
        $this->db->where(self::sucursal.'.id_sucursal',$sucursalID); 
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result_array();
        }        
        
    }

    public function getCategoriaMaterialesById($categoID)
    {
        $query = $this->db->query("SELECT cm.id_categoria_materia, cm.nombre_categoria_materia, 
            cm.descripcion_categoria_materia, CASE cm.estado_categoria_materia
            WHEN 1 THEN 'Activo'
            ELSE 'Inactivo'
            END AS cateStatus, cm.fecha_creacion
            FROM sys_categoria_materia_prima cm
            where cm.id_categoria_materia =".$categoID);
         //echo $this->db->queries[0];
        return $query->result();        
        
    }

    public function getMaterialesByCategory($categoriaMaterialId)
    {
        $query = $this->db->query("Select * 
        from sys_catalogo_materiales cm
        where cm.id_categoria_material =".$categoriaMaterialId);
         //echo $this->db->queries[0];
        return $query->result();        
        
    }
    

    public function getUnidadMedida()
    {
        $this->db->select('*');
        $this->db->from(self::unidadMedida);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function getSucursal()
    {
        $query = $this->db->query("Select s.id_sucursal, s.id_departamento, s.nombre_sucursal,s.direccion,s.telefono,s.celular,
            s.referencia_zona,s.fecha_creacion,s.estado,s.centro_produccion,s.creado_usuario , 
            IF(s.centro_produccion = '1', CONCAT(s.nombre_sucursal,'', '(CProduccion)'), s.nombre_sucursal) as name
            from sys_sucursal s ");
         return $query->result();    
        
    }

    public function getCategoriaMateriales()
    {
        $query = $this->db->query("SELECT cm.id_categoria_materia, cm.nombre_categoria_materia, 
            cm.descripcion_categoria_materia, CASE cm.estado_categoria_materia
            WHEN 1 THEN 'Activo'
            ELSE 'Inactivo'
            END AS cateStatus, cm.fecha_creacion
            FROM sys_categoria_materia_prima cm");
         //echo $this->db->queries[0];
        return $query->result();
 
        
    }

    public function getCategoriaMaterialesSelect()
    {
        $query = $this->db->query("SELECT cm.id_categoria_materia, cm.nombre_categoria_materia, 
            cm.descripcion_categoria_materia, CASE cm.estado_categoria_materia
            WHEN 1 THEN 'Activo'
            ELSE 'Inactivo'
            END AS cateStatus, cm.fecha_creacion
            FROM sys_categoria_materia_prima cm
            where cm.estado_categoria_materia =1");
         //echo $this->db->queries[0];
        return $query->result();
 
        
    }

    public function save_estatus($estatus)
    {
        $dateNow = date("Y-m-d");
       
        $estatus = array(
             'nombre_estatus'      => $estatus['nombreStatus'],
             'decripcion_estatus'    => $estatus['descripcionStatus'],
             'estatus_active'    => $estatus['estado'],
             'fecha_creacion'    => $dateNow
             );
        
        $this->db->insert(self::estatus,$estatus);
    }

    public function save_adicional($adicional)
    {
        $dateNow = date("Y-m-d");
       
        $adicional = array(
             'id_material_sucursal' => $adicional['id_material_sucursal'],
             'cantidad_adicional'  => $adicional['cantidaAdicional'],
             'unida_medida_adicional'  => $adicional['unidadMedidaAdicional'],
             'precio_adicional'    => $adicional['precioAdicional'],
             'estatu_adicional'    => 1
             );
        
        $this->db->insert(self::adicional,$adicional);
    }

    public function save_categoria_material($categoriaM)
    {
        $dateNow = date("Y-m-d");
       
        $categoriaM = array(
             'nombre_categoria_materia'      => $categoriaM['nombreCategoriaMateria'],
             'descripcion_categoria_materia'    => $categoriaM['descripcionCategoriaMateria'],
             'estado_categoria_materia'    => $categoriaM['estadoCategoria'],
             'fecha_creacion'    => $dateNow
             );
        
        $this->db->insert(self::categoriaMateriales,$categoriaM);
    }

    public function save_material($material, $code)
    {
        $dateNow = date("Y-m-d");
        //-------Generear Codigo de material---------
        $materi = array(
             'nombre_matarial'      => $material['nombreMateria'],
             'descripcion_meterial'    => $material['descripcionMateria'],
             'codigo_material'    =>  strtoupper($code),
             'estatus'    => $material['estatusMateria'],
             'id_unidad_medida'    => $material['unidadMedida'],
             'contenidoNeto'    => $material['cantdaNeto'],
             'id_categoria_material'    => $material['categoriaMaterial'],
             'fecha_creacion'    => $dateNow
             );
        
        $this->db->insert(self::materiales,$materi);
    }

//----------------------------Queries de validaciones de datos----------------------------------------
    public function validateCode($code)
    {
        $query = $this->db->query("Select count(*) as numData from sys_catalogo_materiales where codigo_material ='.$code.'");

        return $query->result_array();
    
    }

    public function ValidateUsedCategoriM($categoID)
    {
        $query = $this->db->query("Select count(*) as numData from sys_catalogo_materiales cm where cm.id_categoria_material = ".$categoID['categoID']);
        //echo $this->db->queries[0];    
        return $query->result_array();
    
    }

//------------------------------END-------------------------------------------------------------------    

    public function delete_material($datos)
    {
         $data = array(
            'id_inventario' => $datos['proveedorID']
        );
        $this->db->delete(self::materiales, $data); 
    }

    public function delete_adicional($datos)
    {
         $data = array(
            'id_materiales_adicionales' => $datos['adicionalID']
        );
        $this->db->delete(self::adicional, $data); 
    }

    public function delete_categoria_material($datos)
    {
         $data = array(
            'id_categoria_materia' => $datos['categoID']
        );
        $this->db->delete(self::categoriaMateriales, $data); 
    }

    public function update_inventario($inventarioID){
        session_start();
        $data = array(
            'nombre_matarial'   => $inventarioID['nombreMaterial'],
            'descripcion_meterial'   => $inventarioID['descripcionP'],
            'estatus'   => $inventarioID['estatusMateria'],
            'id_unidad_medida'   => $inventarioID['unidadMedida'],
            'id_categoria_material'   => $inventarioID['categoriaMaterial']         
        
        );
        $this->db->where('id_inventario', $inventarioID['inventarioID']);    
        $this->db->update(self::materiales,$data);
    }

     public function update_inventarioCategoria($inventarioIDCat){
        session_start();
        $data = array(
            'nombre_categoria_materia'   => $inventarioIDCat['nombreCategoria'],
            'descripcion_categoria_materia'   => $inventarioIDCat['descripcionP'],
            'estado_categoria_materia'   => $inventarioIDCat['estatusCat']         
        
        );
        $this->db->where('id_categoria_materia', $inventarioIDCat['inventarioID']);    
        $this->db->update(self::categoriaMateriales,$data);
    }

    public function getInventarioByID($inventarioID)
    {
        $this->db->select('*');
        $this->db->from(self::materiales);
        $this->db->where(self::materiales.'.id_inventario',$inventarioID); 
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }


    public function getInventarioView($inventarioID)
    {
        $query = $this->db->query('Select cm.id_inventario, cm.codigo_material,  cm.nombre_matarial, cm.descripcion_meterial, em.nombre_estatus, um.nombre_unidad_medida, cmp.nombre_categoria_materia, cm.fecha_creacion, cis.minimo_existencia, cis.maximo_existencia, cis.total_existencia
            from sys_catalogo_materiales cm
            inner join sys_unidad_medida um on um.id_unidad_medida = cm.id_unidad_medida
            inner join sys_categoria_materia_prima cmp on cmp.id_categoria_materia = cm.id_categoria_material
            inner join sys_estatus_meteriales em on em.id_estatus = cm.estatus
            inner join sys_catalogo_inventario_sucursal cis on cis.codigo_meterial = cm.codigo_material
                where cis.id_inventario_sucursal='.@$inventarioID.' group by cm.id_inventario');
         //echo $this->db->queries[0];
        return $query->result();      
    }

    public function inventarioBySucursalDetall($sucursalID)
    {

        //var_dump($sucursalID);die();
        $query = $this->db->query('Select * from sys_catalogo_inventario_sucursal cis
        Inner join sys_catalogo_materiales cm ON cis.codigo_meterial = cm.codigo_material
        inner join sys_categoria_materia_prima cmp ON cmp.id_categoria_materia = cm.id_categoria_material
        Inner join sys_sucursal s ON cis.id_sucursal = s.id_sucursal  
        inner join sys_unidad_medida um ON um.id_unidad_medida = cm.id_unidad_medida
        left join sys_materiales_adicionales ma ON ma.id_material_sucursal = cis.id_inventario_sucursal
        where cis.id_sucursal ='.$sucursalID.' group by cis.id_inventario_sucursal order by cis.total_existencia');
         //echo $this->db->queries[0];
        return $query->result();

       
    }


    public function inactivar_categoria($categoID){
        session_start();
        $data = array(
            'estado_categoria_materia'   => 0,
        );
        $this->db->where('id_categoria_materia', $categoID['categoID']);    
        $this->db->update(self::categoriaMateriales,$data);
    }

    public function activar_categoria($categoID){
        session_start();
        $data = array(
            'estado_categoria_materia'   => 1,
        );
        $this->db->where('id_categoria_materia', $categoID['categoID']);    
        $this->db->update(self::categoriaMateriales,$data);
    }

    public function getMaterialesNotInsert($sucursalID)
    {
        $query = $this->db->query('Select * 
                from sys_catalogo_inventario_sucursal cis
                right join sys_catalogo_materiales cm  ON cm.codigo_material = cis.codigo_meterial
                and cis.id_sucursal = '.$sucursalID.'
                inner join sys_categoria_materia_prima cmp ON cmp.id_categoria_materia = cm.id_categoria_material
                where cis.id_sucursal Is null');
         //echo $this->db->queries[0];
        return $query->result();

       
    }

    public function save_lista_materiales($listMateriales)
    {
        $sucursalID = $listMateriales['sucursalID'];
        foreach ($listMateriales['materialesList'] as $value) 
        {
            $dateNow = date("Y-m-d");
            $listMateriales = array(
                 'codigo_meterial' => $value,
                 'id_sucursal'     => $sucursalID,
                 'LastUpdated'     => $dateNow
                 );
            
            $this->db->insert(self::materialesSucursal,$listMateriales);
        }
        
    }


    public function update_adicionales($adicionales)
    {
       
            $listAdicional = array(
                 'cantidad_adicional' => $adicionales['cantidaAdicional'],
                 'unida_medida_adicional'     => $adicionales['unidadMedidaAdicional'],
                 'precio_adicional'     => $adicionales['precioAdicional']
                 );
            
        $this->db->where('id_materiales_adicionales', $adicionales['adicionalID']);    
        $this->db->update(self::adicional,$listAdicional);

    }
    

    public function quitar_material_sucursal($datos)
    {
         $data = array(
            'id_inventario_sucursal' => $datos['idInventarioSucursal']
        );
        $this->db->delete(self::materialesSucursal, $data); 
    }

    public function dataCatalogoInventarioSucursal($inventarioSucursal)
    {
        //echo  $inventarioSucursal;
        $query = $this->db->query("Select cis.id_inventario_sucursal, cis.codigo_meterial, cis.id_sucursal, cis.minimo_existencia, cis.maximo_existencia,
            cis.total_existencia, cm.id_inventario, cm.nombre_matarial, cm.descripcion_meterial, ps.id_proveedor_sucursal, ps.id_proveedor,     
            id_list_inventario_proveedor,p.nombre_proveedor, um.nombre_unidad_medida, IF(lip.id_list_inventario_proveedor is null, 'Asociar', 'Desasociar') as listInventarioProvee,
            lip.precio_material_inventario_sucursal as listInventarioProveePrecio,lip.id_list_inventario_proveedor, 
            lip.id_catalogo_inventario_sucursal, lip.id_proveedor_sucursal, lip.precio_material_inventario_sucursal
                        from sys_catalogo_inventario_sucursal cis
            inner join sys_catalogo_materiales cm on cm.codigo_material = cis.codigo_meterial
            inner join sys_unidad_medida um ON um.id_unidad_medida = cm.id_unidad_medida
            inner join sys_proveedores_sucursal ps ON ps.id_sucursal = cis.id_sucursal
            inner join sys_proveedores p ON p.id_proveedor = ps.id_proveedor
            left join sys_list_inventario_proveedor lip ON lip.id_proveedor_sucursal = ps.id_proveedor 
                and lip.id_catalogo_inventario_sucursal = cis.id_inventario_sucursal 
            where cis.id_inventario_sucursal =".$inventarioSucursal." group by ps.id_proveedor");
         //echo $this->db->queries[0];
         return $query->result_array();
    }

    public function listProveedoresBySucursal($sucursalID)
    {
         $query = $this->db->query("Select * 
        from sys_proveedores p
        inner join sys_proveedores_sucursal ps on ps.id_proveedor = p.id_proveedor
        where ps.id_sucursal =".$sucursalID);
         //echo $this->db->queries[0];
        return $query->result();               
        
    }

    public function asociar_proveedor_meterial($ListMateProve)
    {

        //var_dump($ListMateProve);
        $listProvee = array(
             'id_catalogo_inventario_sucursal'    => $ListMateProve['materialSucursalId'],
             'id_proveedor_sucursal'    => $ListMateProve['proveedorId']
             );
        
        $this->db->insert(self::listMaterialProveedor,$listProvee);
    }

    public function desasociar_proveedor_meterial($ListMateProve)
    {


       $data = array(
            'id_catalogo_inventario_sucursal' => $ListMateProve['materialSucursalId'],
            'id_proveedor_sucursal' => $ListMateProve['proveedorId']
        );
        $this->db->delete(self::listMaterialProveedor, $data); 
    }
    
    public function save_config_material($materialConfig)
    {
        //var_dump($materialConfig);
        session_start();
        $materialConfigdata = array(
             'minimo_existencia'   => $materialConfig['miniExistencia'],
             'maximo_existencia'   => $materialConfig['maximoExistencia']
             );

        $this->db->where('id_inventario_sucursal', $materialConfig['catalogoSucursalID']);    
        $this->db->update(self::materialesSucursal,$materialConfigdata);
    }


    public function save_add_material($materialConfig)
    {
        //var_dump($materialConfig);
        session_start();
        $dateNow = date("Y-m-d H:i:s");

        $nuevaExistencia = $materialConfig['ActualExistencia'] +  $materialConfig['cantidadNueva'];
        $materialConfigdata = array(
             'total_existencia'   =>  $nuevaExistencia
             );

        $this->db->where('id_inventario_sucursal', $materialConfig['catalogoSucursalID']);    
        $this->db->update(self::materialesSucursal,$materialConfigdata);


        $materialesAdd = array(
             'id_catalogo_inventario_sucursal'    => $materialConfig['catalogoSucursalID'],
             'cantidad_agregada'    => $materialConfig['cantidadNueva'],
             'user_id'    => $materialConfig['userID'],
             'fecha_registro'    => $dateNow
             );
        
        $this->db->insert(self::materialesAdd,$materialesAdd);
    }

    public function UpdateExistencia($IdCatoloInvetario, $existencia)
    {
        $data = array(
            'total_existencia'   => $existencia,         
        
        );
        $this->db->where('id_inventario_sucursal', $IdCatoloInvetario);    
        $this->db->update(self::materialesSucursal,$data);
    }

    public function dataMaterial($inventarioID)
    {
        $query = $this->db->query("Select * 
        from sys_catalogo_materiales cm 
        inner join sys_catalogo_inventario_sucursal cis ON cis.codigo_meterial = cm.codigo_material
        inner join sys_sucursal s ON s.id_sucursal = cis.id_sucursal
        inner join sys_pais_departamento pd ON pd.id_departamento = s.id_departamento
        inner join sys_pais p ON p.id_pais = pd.id_pais
        where cis.id_inventario_sucursal = ".$inventarioID);
         //echo $this->db->queries[0];
        return $query->result_array();        
        
    }

    public function getDataAdicionales($sucursalID)
    {
        $query = $this->db->query("Select * 
        from sys_materiales_adicionales ma
        inner join sys_catalogo_inventario_sucursal cis ON cis.id_inventario_sucursal = ma.id_material_sucursal
        inner join sys_catalogo_materiales cm ON cm.codigo_material =  cis.codigo_meterial
        inner join sys_unidad_medida um ON um.id_unidad_medida = ma.unida_medida_adicional
        inner join sys_sucursal s ON s.id_sucursal = cis.id_sucursal
        inner join sys_pais_departamento pd ON pd.id_departamento = s.id_departamento
        inner join sys_pais p ON p.id_pais =pd.id_pais
        where cis.id_sucursal =".$sucursalID);
         //echo $this->db->queries[0];
         return $query->result();          
        
    }

    public function dataAdicional($adicionalID)
    {
        $query = $this->db->query("Select  * from sys_materiales_adicionales ma
        inner join sys_catalogo_inventario_sucursal cis ON cis.id_inventario_sucursal = ma.id_material_sucursal 
        inner join sys_catalogo_materiales cm ON cm.codigo_material = cis.codigo_meterial
        where ma.id_materiales_adicionales =".$adicionalID);

         return $query->result();          
        
    }

}
/*
 * end of application/models/consultas_model.php
 */
