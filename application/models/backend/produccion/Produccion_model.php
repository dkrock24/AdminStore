<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class produccion_model extends CI_Model
{
    const categoria = 'sys_categoria_producto';
    const enviosTable = 'sys_envios_materiales';
    const catalogoMateriales = 'sys_catalogo_inventario_sucursal';
    const intEmpleados = 'sys_sucursal_int_usuarios';
    
    public function __construct()
    {
        parent::__construct();
        
    }
   
	public function getCentroProduccion()
    {
         $query = $this->db->query('Select * from sys_sucursal s
			where s.centro_produccion = 1');
         //echo $this->db->queries[0];
        return $query->result();       
        
    }   

    public function listEmpleadosCP($cpID)
    {
         $query = $this->db->query('Select su.id, u.id_usuario, u.nombres, u.apellidos, u.telefono, u.celular, u.direccion
          from sr_usuarios u
        inner join sys_sucursal_int_usuarios su ON su.id_usuario = u.id_usuario
        inner join sys_sucursal s ON s.id_sucursal = su.id_sucursal
        where s.id_sucursal ='.$cpID);
         //echo $this->db->queries[0];
        return $query->result();       
        
    }   

    public function getCentroProducion()
    {
         $query = $this->db->query('Select * from sys_sucursal s
		 where s.centro_produccion = 1');
         //echo $this->db->queries[0];
        return $query->result();       
        
    }

     public function inventarioBySucursalDetall($cpID)
    {
        $query = $this->db->query('Select * from sys_catalogo_inventario_sucursal cis
        Inner join sys_catalogo_materiales cm ON cis.codigo_meterial = cm.codigo_material
        inner join sys_categoria_materia_prima cmp ON cmp.id_categoria_materia = cm.id_categoria_material
        inner join sys_sucursal s ON cis.id_sucursal = s.id_sucursal  
        inner join sys_unidad_medida u ON u.id_unidad_medida = cm.id_unidad_medida
        inner join sys_tipo_unidad_medida tum ON tum.id_tipo_unidad_medida = u.id_tipo_unidad_medida
        where cis.id_sucursal ='.@$cpID.' group by cis.id_inventario_sucursal');
         //echo $this->db->queries[0];
        return $query->result();

       
    }

    public function getListaEviosByCP($cpID)
    {
         $query = $this->db->query('select em.id_envio_materiales, em.codigo_material, em.sucursal_enviado_id, em.cproduccion_id, em.cantidad, em.unidad_medida, em.usuario_registro_envio, em.comentario_envio, em.estatus, em.fecha_registro, cm.nombre_matarial, um.nombre_unidad_medida  from sys_envios_materiales em
          inner join sys_catalogo_materiales cm ON cm.codigo_material = em.codigo_material
          inner join sys_unidad_medida um ON um.id_unidad_medida = em.unidad_medida 
        where em.cproduccion_id ='.@$cpID);
         //echo $this->db->queries[0];
        return $query->result();       
        
    }

    public function getSucursales($codigoMaterial)
    {
         $query = $this->db->query('Select s.id_sucursal, s.nombre_sucursal 
          from sys_sucursal s 
          inner join sys_catalogo_inventario_sucursal cis ON cis.id_sucursal = s.id_sucursal
          where s.centro_produccion = 0 and cis.codigo_meterial = "'.$codigoMaterial.'"
          group by s.id_sucursal');
         //echo $this->db->queries[0];
        return $query->result();       
        
    }
    public function getUnidadMedida($tipoUnidad)
    {
         $query = $this->db->query('Select u.id_unidad_medida, u.nombre_unidad_medida 
          from sys_unidad_medida u
          where  u.id_tipo_unidad_medida ='.@$tipoUnidad);
         //echo $this->db->queries[0];
        return $query->result();       
        
    }

    public function getDataMaterial($idSucursalMaterial)
    {
         $query = $this->db->query('Select cis.id_inventario_sucursal, cis.id_sucursal, cis.codigo_meterial, s.nombre_sucursal, cis.total_existencia, um.nombre_unidad_medida, um.id_unidad_medida
          from sys_catalogo_inventario_sucursal cis
            inner join sys_catalogo_materiales cm on cm.codigo_material = cis.codigo_meterial
            inner join sys_unidad_medida um ON um.id_unidad_medida = cm.id_unidad_medida
                inner join sys_sucursal s ON s.id_sucursal =cis.id_sucursal
            where cis.id_inventario_sucursal ='.$idSucursalMaterial);
         //echo $this->db->queries[0];
        return $query->result_array();       
        
    }

    public function saveEnvio($envio)
    {
        $dateNow = date("Y-m-d h:i:s");
       
        $envios = array(
            'codigo_material'    => $envio['codigoMaterial'],
            'sucursal_enviado_id'    => $envio['sucursalId'],
            'cproduccion_id'    => $envio['idCproduccion'],
            'cantidad'=> $envio['catindadEnvio'],
            'unidad_medida'    => $envio['unidadMedida'],
            'usuario_registro_envio'    => $envio['userID'],
            'estatus'    => 3,
            'fecha_registro'    => $dateNow
             );
        
        $dataInsert = $this->db->insert(self::enviosTable,$envios);
        if($dataInsert)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function UpdateExistencia($envio)
    {
        //var_dump($envio);
        $datoSave = $envio['maximo'] - $envio['catindadEnvio'];
        $data = array(
            'total_existencia'   => $datoSave,         
        
        );
        $this->db->where('id_inventario_sucursal', $envio['idInventarioMaterial']);    
        $this->db->update(self::catalogoMateriales,$data);
    }

    public function getEmpleadoById($empleadoID)
    {
         $query = $this->db->query('Select * from sr_usuarios  u where u.id_usuario ='.$empleadoID);
         //echo $this->db->queries[0];
        return $query->result();       
        
    }

    public function getEnvioById($envioID)
    {
         $query = $this->db->query('select em.id_envio_materiales, em.codigo_material, em.sucursal_enviado_id, em.cproduccion_id, em.cantidad, em.unidad_medida, em.usuario_registro_envio, em.comentario_envio, em.estatus, em.fecha_registro, cm.nombre_matarial, s.nombre_sucursal, sem.nombre_estatus, um.nombre_unidad_medida
            from sys_envios_materiales em
            inner join sys_catalogo_materiales cm ON cm.codigo_material = em.codigo_material 
            inner join sys_sucursal s ON s.id_sucursal = em.sucursal_enviado_id
            inner join sys_estatus_meteriales sem ON sem.id_estatus = em.estatus
            inner join sys_unidad_medida um ON um.id_unidad_medida = em.unidad_medida
            where em.id_envio_materiales ='.@$envioID);
         //echo $this->db->queries[0];
        return $query->result();       
        
    }

    public function delete_empleado($datos)
    {
         $data = array(
            'id' => $datos['empleadoID']
        );
        $this->db->delete(self::intEmpleados, $data); 
    }

}
/*
 * end of application/models/consultas_model.php
 */
