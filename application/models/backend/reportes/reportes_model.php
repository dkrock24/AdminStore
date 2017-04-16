<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class reportes_model extends CI_Model
{
    const corte = 'sys_pedido_cortes';    

    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function getCortes($data_filter)
    {     	
    	$query = $this->db->query('select u.nickname,s.nombre_sucursal,fecha_corte,monto_corte,monto_adicionales,total_ordenes,serie_fin,cupones,P.moneda from sys_pedido_cortes as pedido_corte
					    		join sr_usuarios as u on u.id_usuario=pedido_corte.id_usuario
					    		join sys_sucursal as s on s.id_sucursal=pedido_corte.id_sucursal					    		
            					join sys_pais_departamento as D on D.id_departamento=s.id_departamento
            					join sys_pais as P on P.id_pais=D.id_pais
					                where pedido_corte.id_sucursal='.$data_filter['sucursal'].' and 
					                CAST(pedido_corte.fecha_corte AS DATE) between "'.$data_filter['fecha_inicio'].'" and "'.$data_filter['fecha_fin'].'"');
                return $query->result();
    }

    public function getVentas($data_filter){

    	$filtro="";
    	if($data_filter['sucursal']!="todas")
    	{
    		$filtro = " P.id_sucursal=".$data_filter['sucursal']." and ";
    	}
    	$query = $this->db->query('select S.nombre_sucursal,U.nickname,P.secuencia_orden,D.precio_grabado,D.llevar,Pr.nombre_producto,P.fechahora_pedido,Pa.moneda
									from sys_pedido as P
									join sys_pedido_detalle as D on P.id_pedido=D.id_pedido
									join sys_productos as Pr on Pr.id_producto=D.id_producto
									join sys_sucursal as S on S.id_sucursal=P.id_sucursal
									join sys_pais_departamento as De on De.id_departamento=S.id_departamento
            						join sys_pais as Pa on Pa.id_pais=De.id_pais
									join sr_usuarios as U on U.id_usuario=P.id_mesero
                where  P.cortado=1 and '. $filtro.' CAST(P.fechahora_pedido AS DATE) between "'.$data_filter['fecha_inicio'].'" and "'.$data_filter['fecha_fin'].'" order by P.id_sucursal');
                return $query->result();
    }
}