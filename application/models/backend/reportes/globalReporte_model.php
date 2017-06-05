<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class GlobalReporte_model extends CI_Model
{
    const corte = 'sys_pedido_cortes';    

    public function __construct()
    {
        parent::__construct();        
    }
    
    public function getProductos($data_filter)
    {  
        $filtro="";
        if($data_filter['sucursal']!="todas")
        {
            $filtro = " where S.id_sucursal=".$data_filter['sucursal']." ";
        }   	
    	$query = $this->db->query('select * from sys_productos as Pro
            join sys_categoria_producto as Pc on Pc.id_categoria_producto=Pro.categoria_id
            join sys_productos_sucursal as Ps on Ps.id_producto=Pro.id_producto
            join sys_sucursal as S on S.id_sucursal=Ps.id_sucursal 
            join sys_pais_departamento as De on De.id_departamento=S.id_departamento
            join sys_pais as Pa on Pa.id_pais=De.id_pais
            '.$filtro.' ');
        return $query->result();
    }

    public function getMateriales($data_filter){

    	$filtro="";
    	if($data_filter['sucursal']!="todas")
    	{
    		$filtro = " where S.id_sucursal=".$data_filter['sucursal']." ";
    	}
    	$query = $this->db->query('select Ci.codigo_meterial,Ci.minimo_existencia,Ci.maximo_existencia,Ci.total_existencia,
            S.nombre_sucursal,
            Cm.nombre_matarial,
            Mp.nombre_categoria_materia,
            Um.nombre_unidad_medida,
            Um.simbolo_unidad_medida
        from sys_catalogo_inventario_sucursal as Ci
        join sys_sucursal as S on S.id_sucursal=Ci.id_sucursal
        join sys_catalogo_materiales as Cm on Cm.codigo_material=Ci.codigo_meterial
        join sys_categoria_materia_prima as Mp on Mp.id_categoria_materia=Cm.id_categoria_material
        join sys_unidad_medida as Um on Um.id_unidad_medida=Cm.id_unidad_medida '. $filtro.'');
                return $query->result();
    }
    
    public function getMinimoExistencias($data_filter){

        $filtro="";
        if($data_filter['sucursal']!="todas")
        {
            $filtro = " and S.id_sucursal=".$data_filter['sucursal']." ";
        }
        $query = $this->db->query('select Ci.codigo_meterial,Ci.minimo_existencia,Ci.maximo_existencia,Ci.total_existencia,
            S.nombre_sucursal,
            Cm.nombre_matarial,
            Mp.nombre_categoria_materia,
            Um.nombre_unidad_medida,
            Um.simbolo_unidad_medida
        from sys_catalogo_inventario_sucursal as Ci
        join sys_sucursal as S on S.id_sucursal=Ci.id_sucursal
        join sys_catalogo_materiales as Cm on Cm.codigo_material=Ci.codigo_meterial
        join sys_categoria_materia_prima as Mp on Mp.id_categoria_materia=Cm.id_categoria_material
        join sys_unidad_medida as Um on Um.id_unidad_medida=Cm.id_unidad_medida
        where Ci.total_existencia<=Ci.minimo_existencia '. $filtro.'');
                return $query->result();
    }

    public function getSobras($data_filter){

        $filtro="";
        if($data_filter['sucursal']!="todas")
        {
            $filtro = " S.id_sucursal=".$data_filter['sucursal']." and ";
        }
        $query = $this->db->query('select S.nombre_sucursal,So.codigo_material,So.cantidad_sobras,U.nickname,So.cantidad_sobras,Um.nombre_unidad_medida,Cm.nombre_matarial,So.fecha_registro
        from sys_sucursal as S 
        join sys_sobras as So on S.id_sucursal=So.id_sucursal
        join sr_usuarios as U on U.id_usuario=So.id_usuario_logeado
        join sys_unidad_medida as Um on Um.id_unidad_medida=So.id_unidad_medida
        join sys_catalogo_materiales as Cm on Cm.codigo_material=So.codigo_material where '. $filtro.' CAST(So.fecha_registro AS DATE) between "'.$data_filter['fecha_inicio'].'" and "'.$data_filter['fecha_fin'].'"');
                return $query->result();
    }

    public function getEnvios($data_filter){

        $filtro="";
        if($data_filter['sucursal']!="todas")
        {
            $filtro = " S.id_sucursal=".$data_filter['sucursal']." and ";
        }
        $query = $this->db->query('select E.codigo_material,E.cantidad,E.comentario_envio,E.fecha_registro,S.nombre_sucursal,Su.nombre_sucursal as Centro,M.nombre_matarial,U.nombre_unidad_medida,Usu.nickname,E.estatus from sys_envios_materiales as E
join sys_sucursal as S on S.id_sucursal=E.sucursal_enviado_id
join sys_sucursal as Su on Su.id_sucursal=E.cproduccion_id
join sys_catalogo_materiales as M on M.codigo_material=E.codigo_material
join sys_unidad_medida as U on U.id_unidad_medida=E.unidad_medida
join sr_usuarios as Usu on Usu.id_usuario=E.usuario_registro_envio where '. $filtro.' CAST(E.fecha_registro AS DATE) between "'.$data_filter['fecha_inicio'].'" and "'.$data_filter['fecha_fin'].'"');
                return $query->result();
    }

    public function getCron(){
        $query = $this->db->query('select Ci.codigo_meterial,Ci.minimo_existencia,Ci.maximo_existencia,Ci.total_existencia,
            S.nombre_sucursal,
            Cm.nombre_matarial,
            Mp.nombre_categoria_materia,
            Um.nombre_unidad_medida,
            Um.simbolo_unidad_medida
        from sys_catalogo_inventario_sucursal as Ci
        join sys_sucursal as S on S.id_sucursal=Ci.id_sucursal
        join sys_catalogo_materiales as Cm on Cm.codigo_material=Ci.codigo_meterial
        join sys_categoria_materia_prima as Mp on Mp.id_categoria_materia=Cm.id_categoria_material
        join sys_unidad_medida as Um on Um.id_unidad_medida=Cm.id_unidad_medida
        where Ci.total_existencia<=Ci.minimo_existencia');
                return $query->result();
    }
    
}