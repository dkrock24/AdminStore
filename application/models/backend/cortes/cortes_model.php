<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cortes_model extends CI_Model
{
    const corte = 'sys_pedido_cortes';
    const corte_detalle =  'sys_pedido_corte_detalle';
    const sys_pedido    =  'sys_pedido';
    

    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function getcortesBySucursal($id_sucursal)
    {      
        $query = $this->db->query('select pais.moneda,pedido.id_pedido,pedido.id_sucursal,count(pedido.id_pedido)AS Pedidos,pedido.secuencia_orden,pedido.fechahora_pedido,sum(cc.total_cobrado) AS Monto
            from sys_pedido as pedido
            join sys_sucursal as sucursal on sucursal.id_sucursal=pedido.id_sucursal
            join sys_pais_departamento as departamento on departamento.id_departamento=sucursal.id_departamento
            join sys_pais as pais on pais.id_pais=departamento.id_pais
            join sys_cajacuentas as cc on cc.ID_pedido=pedido.id_pedido    
            where cc.flag_pagado=1 and pedido.cortado=0  and pedido.id_sucursal='.$id_sucursal.'
            group by pedido.id_sucursal');
            //echo $this->db->queries[0];
            return $query->result(); 
    } 

    public function getcortesBySucursalA($id_sucursal)
    {      
        $query = $this->db->query('select pais.moneda,pedido.id_pedido,pedido.id_sucursal,count(pedido.id_pedido)AS Pedidos,pedido.secuencia_orden,pedido.fechahora_pedido,sum(cc.total_cobrado) AS Monto
            from sys_pedido as pedido
            join sys_sucursal as sucursal on sucursal.id_sucursal=pedido.id_sucursal
            join sys_pais_departamento as departamento on departamento.id_departamento=sucursal.id_departamento
            join sys_pais as pais on pais.id_pais=departamento.id_pais
            
            join sys_cajacuentas as cc on cc.ID_pedido=pedido.id_pedido  
            where cc.flag_pagado=0  and pedido.id_sucursal='.$id_sucursal.'
            group by pedido.id_sucursal');
            //echo $this->db->queries[0];
            return $query->result(); 
    }

    public function getSeriesCortesBySucursal($id_sucursal)
    {      
        $query = $this->db->query('select pedido.secuencia_orden from sys_pedido as pedido
            where pedido.cortado=0 and pedido.flag_cancelado=1  and pedido.id_sucursal='.$id_sucursal.' order by pedido.secuencia_orden desc limit 1');
            //echo $this->db->queries[0];
            return $query->result(); 
    } 

    public function getTotalOrdenesCupon($id_sucursal){
        $query = $this->db->query('select count(pedido.id_pedido)as Cupones from sys_pedido as pedido
        where pedido.cortado=0  and pedido.id_sucursal='.$id_sucursal.' and pedido.codigo_cupon!=null');

         return $query->result(); 
    }

    public function getTotalAdicinales($id_sucursal){
        $query = $this->db->query('select pais.moneda,(select sum(d.precio_adicional) from      sys_pedido_detalle_materia as d where d.id_detalle=detalle.id_detalle)AS Total_Adisional
                from sys_pedido as pedido
                join sys_sucursal as sucursal on sucursal.id_sucursal=pedido.id_sucursal
                join sys_pais_departamento as departamento on departamento.id_departamento=sucursal.id_departamento
                join sys_pais as pais on pais.id_pais=departamento.id_pais
                join sys_pedido_detalle as detalle on detalle.id_pedido=pedido.id_pedido    
                where (pedido.flag_cancelado=0 or pedido.flag_cancelado=1) and pedido.cortado=0  and pedido.id_sucursal='.$id_sucursal.' group by pedido.id_sucursal
                ');
         return $query->result(); 
    }

    public function getPedidosCerrados($id_sucursal){
        $query = $this->db->query('select count(pedido.id_pedido)as total
            from sys_pedido as pedido          
            where pedido.flag_cancelado=1  and pedido.id_sucursal='.$id_sucursal.' and pedido.cortado=0
                ');
         return $query->result();
    }

    public function getPedidosAbiertos($id_sucursal){
        $query = $this->db->query('select count(pedido.id_pedido) as total
            from sys_pedido as pedido          
            where pedido.flag_cancelado=0  and pedido.id_sucursal='.$id_sucursal.' and pedido.cortado=0
            
                ');
         return $query->result();
    }

    public function getTotalOrdenes($id_sucursal){
        $query = $this->db->query('select count(pedido.id_pedido)as Totalordenes
            from sys_pedido as pedido          
            where pedido.id_sucursal='.$id_sucursal.' and pedido.cortado=0 and pedido.flag_cancelado=1
            
                ');
         return $query->result();
    }

    public function SetInsertCorte($id_sucursal,$Monto,$Monto_Adicional,$Totalordenes,$Serie,$Total_Cupones){

        session_start();
        $date = date("Y-m-d H:m:s");
        $data = array(
            'id_sucursal'       => $id_sucursal,
            'id_usuario'        => $_SESSION['idUser'],           
            'fecha_corte'       => $date,
            'monto_corte'       => $Monto,    
            'monto_adicionales' => $Monto_Adicional,    
            'total_ordenes'     => $Totalordenes, 
            'serie_fin'         => $Serie,
            'cupones'           => $Total_Cupones,
            'estado_corte'      => 1,
        );

        $this->db->insert(self::corte,$data);
        $id_corte = $this->db->insert_id();
        //Registrar Todas Las ordenes como historico de corte
        $ordenes = $this->getTodasLasOrdenes($id_sucursal);

        // Insertar Historico de Cortes
        $id_pedido;

        foreach ($ordenes as $value){
            $id_pedido = $value->id_pedido;
            $data = array(
                'id_corte'          => $id_corte,
                'id_pedido_cortado' => $value->id_pedido
            );
            $this->db->insert(self::corte_detalle,$data);

            // Actualizar Bit a Cortado
            $data = array(
            'cortado'   => 1,
            );

            $this->db->where('id_pedido', $id_pedido);                
            $this->db->update(self::sys_pedido,$data);
        }

        return $id_corte;

    }

    public function getTodasLasOrdenes($id_sucursal){
        $query = $this->db->query('select * from sys_pedido as pedido          
                where pedido.id_sucursal='.$id_sucursal.' and pedido.cortado=0 and pedido.flag_cancelado=1');
                return $query->result();
    }

    public function getCortesByFilter($id_sucursal,$data_filter){
        $query = $this->db->query('select S.nombre_sucursal, u.nickname,fecha_corte,monto_corte,monto_adicionales,total_ordenes,serie_fin,cupones,P.moneda from sys_pedido_cortes as pedido_corte
            join sr_usuarios as u on u.id_usuario=pedido_corte.id_usuario
            join sys_sucursal as S on S.id_sucursal=pedido_corte.id_sucursal
            join sys_pais_departamento as D on D.id_departamento=S.id_departamento
            join sys_pais as P on P.id_pais=D.id_pais
                where pedido_corte.id_sucursal='.$id_sucursal.' and 
                CAST(pedido_corte.fecha_corte AS DATE) between "'.$data_filter['fecha_inicio'].'" and "'.$data_filter['fecha_fin'].'"');
                return $query->result();
    }

    /*
    *   CONSULTAS PARA REALIZAR LOS CORTES
    */

    public function getTotalAdicinales_($id_sucursal){
        $query = $this->db->query('select pais.moneda,(select sum(d.precio_adicional) from      sys_pedido_detalle_materia as d where d.id_detalle=detalle.id_detalle)AS Total_Adisional
                from sys_pedido as pedido
                join sys_sucursal as sucursal on sucursal.id_sucursal=pedido.id_sucursal
                join sys_pais_departamento as departamento on departamento.id_departamento=sucursal.id_departamento
                join sys_pais as pais on pais.id_pais=departamento.id_pais
                join sys_pedido_detalle as detalle on detalle.id_pedido=pedido.id_pedido    
                where pedido.flag_cancelado=1 and pedido.cortado=0  and pedido.id_sucursal='.$id_sucursal.' group by pedido.id_sucursal
                ');
         return $query->result(); 
    }

    public function getTotalOrdenes_($id_sucursal){
        $query = $this->db->query('select count(pedido.id_pedido)as Totalordenes
            from sys_pedido as pedido          
            where pedido.id_sucursal='.$id_sucursal.' and pedido.cortado=0 and pedido.flag_cancelado=1
            
                ');
         return $query->result();
    }

    public function getSeriesCortesBySucursal_($id_sucursal)
    {      
        $query = $this->db->query('select pedido.secuencia_orden from sys_pedido as pedido
            where pedido.flag_cancelado=1 and pedido.cortado=0  and pedido.id_sucursal='.$id_sucursal.' order by pedido.secuencia_orden desc limit 1');
            //echo $this->db->queries[0];
            return $query->result(); 
    } 

    public function getTotalOrdenesCupon_($id_sucursal){
        $query = $this->db->query('select count(pedido.id_pedido)as Cupones from sys_pedido as pedido
        where pedido.flag_cancelado=1 and pedido.cortado=0  and pedido.id_sucursal='.$id_sucursal.' and pedido.codigo_cupon!=null');

         return $query->result(); 
    }

    /*
    public function getcortesBySucursal($id_sucursal)
        {      
            $query = $this->db->query('select pais.moneda,pedido.id_pedido,pedido.id_sucursal,count(pedido.id_pedido)AS Pedidos,pedido.secuencia_orden,pedido.fechahora_pedido,sum(detalle.precio_grabado)AS Monto, (select sum(d.precio_adicional) from sys_pedido_detalle_materia as d where d.id_detalle=detalle.id_detalle)AS Total_Adisional
                from sys_pedido as pedido
                join sys_sucursal as sucursal on sucursal.id_sucursal=pedido.id_sucursal
                join sys_pais_departamento as departamento on departamento.id_departamento=sucursal.id_departamento
                join sys_pais as pais on pais.id_pais=departamento.id_pais
                join sys_pedido_detalle as detalle on detalle.id_pedido=pedido.id_pedido    
                where pedido.flag_cancelado=1  and pedido.id_sucursal='.$id_sucursal.'
                group by pedido.id_sucursal');
                //echo $this->db->queries[0];
                return $query->result(); 
        } 
    */
    
}
/*
 * end of application/models/consultas_model.php
 */
