<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sobras_model extends CI_Model
{
    const sobras = 'sys_sobras';
    const unidadMedida = 'sys_unidad_medida';
    const sucursales = 'sys_sucursal'; 
  
    public function __construct()
    {
        parent::__construct();
        
    }
   
    public function getDataSobras()
    {
         $query = $this->db->query('Select s.id_sobras, s.codigo_material, s.cantidad_sobras, s.fecha_registro, ss.nombre_sucursal, 
            um.nombre_unidad_medida, cm.nombre_matarial, cm.descripcion_meterial, cm.estatus, um.simbolo_unidad_medida, s.estatus_registro
            from sys_sobras s
            inner join sys_sucursal ss on ss.id_sucursal = s.id_sucursal
            inner join sys_unidad_medida um on um.id_unidad_medida =s.id_unidad_medida
            inner join sys_catalogo_materiales cm on cm.codigo_material = s.codigo_material');
         return $query->result(); 
        
    }

    public function viewSobras($sobrasID)
    {
         $query = $this->db->query('Select s.id_sobras, s.codigo_material, s.cantidad_sobras, s.fecha_registro, ss.nombre_sucursal, 
        um.nombre_unidad_medida, cm.nombre_matarial, cm.descripcion_meterial, cm.estatus, um.simbolo_unidad_medida,  cmp.nombre_categoria_materia, s.estatus_registro as statusChange, s.image
        from sys_sobras s
        inner join sys_sucursal ss on ss.id_sucursal = s.id_sucursal
        inner join sys_unidad_medida um on um.id_unidad_medida =s.id_unidad_medida
        inner join sys_catalogo_materiales cm on cm.codigo_material = s.codigo_material 
        inner join sys_categoria_materia_prima cmp on cmp.id_categoria_materia = cm.id_categoria_material where s.id_sobras ='.$sobrasID);
         return $query->result(); 
        
    }

    public function getSucursales()
    {
        $this->db->select('*');
        $this->db->from(self::sucursales);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
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

    public function save_sobras($sobras)
    {
         $dateNowImg = date("YmdHis");

        if (isset($_FILES['files']['tmp_name'])) 
        {
            //-----------File Imagen profuctos--------------------------------------
                $name = $dateNowImg."_".$_FILES['files']['name'];
                $fileType = $_FILES['files']['type'];
                $fileError = $_FILES['files']['error'];
                $fileContent = file_get_contents($_FILES['files']['tmp_name']);
                $imagen = "assets/images/desperdicios/".$dateNowImg."_".$_FILES['files']['name'];

                move_uploaded_file($_FILES['files']['tmp_name'], $imagen);
            //----------------------------------------------------------------------
        }

        $ingredienteDiv = explode("-", $sobras['ingrediente']);
        $dateNow = date("Y-m-d h:i:sa");
        $categorias = array(
             'id_sucursal'  => $sobras['sucursal'],
             'codigo_material'    => $ingredienteDiv[1],
             'id_usuario_logeado'    => $sobras['userID'],
             'cantidad_sobras'    => $sobras['cantidad'],
             'id_unidad_medida'    => $sobras['unidaMedida'],
             'image'     => $name,
             'fecha_registro'    => $dateNow
             );
        
        $this->db->insert(self::sobras,$categorias);
    }

    public function approved_sobras($approved)
    {
        
        $data = array(
            'estatus_registro'   => $approved['status']
        );
        $this->db->where('id_sobras', $approved['sobrasID']);        
        $this->db->update(self::sobras,$data);
    }   

    public function disapproved_sobras($disapproved)
    {
        
        $data = array(
            'estatus_registro'   => $disapproved['status']
        );
        $this->db->where('id_sobras', $disapproved['sobrasID']);        
        $this->db->update(self::sobras,$data);
    }   


}
/*
 * end of application/models/consultas_model.php
 */
