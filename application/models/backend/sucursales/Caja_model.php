<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class caja_model extends CI_Model
{
    const cargos = 'sr_cargos';
    const roles = 'sr_roles';
    const avatar = 'sr_avatar';
    const usuarios = 'sr_usuarios';
    const sys_sucursal = 'sys_sucursal';
    const sys_pais_departamento  = 'sys_pais_departamento';
    const sys_pais          = 'sys_pais';
    const sys_sucursal_int_usuarios = 'sys_sucursal_int_usuarios';
    const sys_nodo = 'sys_nodo';
    const sys_sucursal_nodo = 'sys_sucursal_nodo';
    const sys_productos = 'sys_productos';
    const sys_productos_sucursal = 'sys_productos_sucursal';
    const categorias = 'sys_categoria_producto';
    const sucursal_suarios = 'sys_sucursal_int_usuarios';
    const producto_detalle = 'sys_detalle_producto';
    const unidad_medida = 'sys_unidad_medida';
    const inventario_sucursal = 'sys_catalogo_inventario_sucursal';
    const catalogo_materiales = 'sys_catalogo_materiales'; 
    const unidades_equivalentes = 'sys_unidades_equivalentes'; 
    const sys_pedido = 'sys_pedido'; 
    const sys_pedido_detalle = 'sys_pedido_detalle'; 
    const sys_pedido_detalle_materia = 'sys_pedido_detalle_materia'; 
    const materiales_adicionales = 'sys_materiales_adicionales';
    const pedidos = 'sys_pedido';
    const sys_secuencia = 'sys_secuencia';
    const compras = 'sys_compras';
    const cuentaTabla = 'sys_cajacuentas';
    const cuenta_descuento = 'sys_cuenta_descuento';
    const cuenta_historial = 'sys_historial';
    const sys_cupon = 'sys_cupon';


    
    public function __construct()
    {
        parent::__construct();
        
    }

    public function save_compras($compra)
    {
        $dateNow = date("Y-m-d h:i:s");
       
        $categorias = array(
             'empresa'      => $compra['compradoA'],
             'descripcion'    => $compra['descripcionP'],
             'precio'    => $compra['precio'],
             'fechatiempo'    => $dateNow,
             'via'    => $compra['pagadoVia'],
             );
        
        $this->db->insert(self::compras,$categorias);
    }

    //---------------Modelos para despacho
    public function getPedidosDespachoBySucursal($id_sucursal)
    {
         $query = $this->db->query('SELECT sp.id_pedido, sp.secuencia_orden, sp.id_usuario, sp.id_mesero, sp.numero_mesa, sp.elaborado, sp.flag_cancelado, sp.flag_elaborado, sp.flag_despachado, sp.porcentaje_descuento, sp.total_descuento, sp.fechahora_pedido, sp.fecha_creado, pd.id_detalle, pd.id_producto, pd.precio_grabado, pd.precio_original, 
          GROUP_CONCAT(DISTINCT pd.id_detalle,"_",p.nombre_producto,"_",pd.precio_grabado) AS name_producto, 
          GROUP_CONCAT(DISTINCT pd.id_detalle,"_",p.nombre_producto) AS name_productos, 
          u.nombres, u.apellidos, sp.id_sucursal, 
          SUM(pd.precio_original) AS totalSin, 
          SUM(pd.precio_grabado) AS totalCon,
          GROUP_CONCAT(DISTINCT si.categoria_impuesto,"_",si.monto_impuesto) AS monto_impuesto, pai.monto_impuesto AS impuesto_pais, GROUP_CONCAT(DISTINCT sh.fechahora,"::",sh.accion,"::",sh.nota) AS historial, IF(MAX(sh.valor) IS NULL, 0, MAX(sh.valor)) AS descuentos, sh.grupo
          FROM sys_pedido sp
          INNER JOIN sys_pedido_detalle pd ON pd.id_pedido = sp.id_pedido AND pd.estado !=5
          LEFT JOIN sys_cajacuentas cc ON cc.ID_pedido = sp.id_pedido
          INNER JOIN sys_productos p ON p.id_producto = pd.id_producto
          INNER JOIN sr_usuarios u ON u.id_usuario = sp.id_mesero
          INNER JOIN sys_sucursal s ON s.id_sucursal = sp.id_sucursal
          INNER JOIN sys_categoria_producto cp ON cp.id_categoria_producto = p.categoria_id
          INNER JOIN sys_pais_departamento pad ON pad.id_departamento = s.id_departamento
          INNER JOIN sys_pais_impuesto pai ON pai.id_pais = pad.id_pais
          LEFT JOIN sys_sucursal_impuesto si ON si.id_sucursal = s.id_sucursal
          LEFT JOIN sys_historial sh ON sh.ID_pedido = sp.id_pedido
              where  sp.flag_cancelado = 0 and  cc.flag_pagado is null
              and sp.id_sucursal = '.$id_sucursal.'  group by sp.id_pedido
                order by sp.flag_elaborado = 0, sp.id_pedido asc');
               //echo $this->db->queries[1];
              return $query->result();       
        
    } 

     public function getPedidosByDetalle($id_sucursal)
    {
         $query = $this->db->query('SELECT sp.id_pedido, sp.secuencia_orden, sp.id_usuario, sp.id_mesero, sp.numero_mesa, sp.elaborado, sp.flag_cancelado, sp.flag_elaborado, sp.flag_despachado, sp.porcentaje_descuento, sp.total_descuento, sp.fechahora_pedido, sp.fecha_creado, pd.id_detalle, pd.id_producto, pd.precio_grabado, pd.precio_original, 
          GROUP_CONCAT(DISTINCT pd.id_detalle,"_",p.nombre_producto,"_",pd.precio_grabado) AS name_producto, 
          GROUP_CONCAT(DISTINCT pd.id_detalle,"_",p.nombre_producto) AS name_productos, 
          u.nombres, u.apellidos, sp.id_sucursal, 
          SUM(pd.precio_original) AS totalSin, 
          SUM(pd.precio_grabado) AS totalCon,
            GROUP_CONCAT(DISTINCT si.categoria_impuesto,"_",si.monto_impuesto) AS monto_impuesto, pai.monto_impuesto AS impuesto_pais, GROUP_CONCAT(DISTINCT sh.fechahora,"::",sh.accion,"::",sh.nota) AS historial, IF(MAX(sh.valor) IS NULL, 0, MAX(sh.valor)) AS descuentos, sh.grupo
          FROM sys_pedido sp
          inner join sys_pedido_detalle pd ON pd.id_pedido = sp.id_pedido and pd.estado !=5
          left join sys_cajacuentas cc ON cc.ID_pedido = sp.id_pedido 
          inner join sys_productos p ON p.id_producto = pd.id_producto
          inner join sr_usuarios u ON u.id_usuario = sp.id_mesero
          inner join sys_sucursal s ON s.id_sucursal = sp.id_sucursal
          INNER JOIN sys_categoria_producto cp ON cp.id_categoria_producto = p.categoria_id
          INNER JOIN sys_pais_departamento pad ON pad.id_departamento = s.id_departamento
          INNER JOIN sys_pais_impuesto pai ON pai.id_pais = pad.id_pais
          LEFT join sys_sucursal_impuesto si ON si.id_sucursal = s.id_sucursal
          LEFT join sys_historial sh ON sh.ID_pedido = sp.id_pedido
          where  sp.elaborado = 0 and  cc.flag_pagado is null
          and sp.id_sucursal = '.$id_sucursal.'  group by sp.id_pedido
          order by sp.elaborado = 0 desc');
          // echo $this->db->queries[2];
          return $query->result();       
        
    } 

    //---------------Modelos para despacho
    public function get_lastPedidos($datosPedido)
    {
        $query = $this->db->query('Select count(sp.id_pedido) as "pedidoNum"
        from sys_pedido sp
        inner join sys_pedido_detalle pd ON pd.id_pedido = sp.id_pedido and pd.estado !=5
        left join sys_cajacuentas cc ON cc.ID_pedido = sp.id_pedido 
        inner join sys_productos p ON p.id_producto = pd.id_producto
        inner join sr_usuarios u ON u.id_usuario = sp.id_mesero
        inner join sys_sucursal s ON s.id_sucursal = sp.id_sucursal
        left join sys_sucursal_impuesto si ON si.id_sucursal = s.id_sucursal
        left join sys_historial sh ON sh.ID_pedido = sp.id_pedido
        where  sp.flag_cancelado = 0 and sp.flag_despachado <> 1 and cc.flag_pagado is null and sp.id_pedido > '.$datosPedido['lastPedido'].'
        and sp.id_sucursal = '.$datosPedido['sucursalID'].'  group by sp.id_pedido
          order by sp.flag_elaborado = 0, sp.id_pedido asc');
       return $query->result();       
        
    } 

    //---------------Modelos para despacho
    public function get_lastPedidosNull($datosPedido)
    {
        $query = $this->db->query('Select count(sp.id_pedido) as "pedidoNum"
        from sys_pedido sp
        inner join sys_pedido_detalle pd ON pd.id_pedido = sp.id_pedido and pd.estado !=5
        left join sys_cajacuentas cc ON cc.ID_pedido = sp.id_pedido 
        inner join sys_productos p ON p.id_producto = pd.id_producto
        inner join sr_usuarios u ON u.id_usuario = sp.id_mesero
        inner join sys_sucursal s ON s.id_sucursal = sp.id_sucursal
        left join sys_sucursal_impuesto si ON si.id_sucursal = s.id_sucursal
        left join sys_historial sh ON sh.ID_pedido = sp.id_pedido
        where  sp.flag_cancelado = 0 and sp.flag_despachado <> 1 and cc.flag_pagado is null
        and sp.id_sucursal = '.$datosPedido['sucursalID'].'  group by sp.id_pedido
          order by sp.flag_elaborado = 0, sp.id_pedido asc');
       return $query->result();       
        
    } 

    public function getDatosSucursal($id_sucursal)
    {
         $query = $this->db->query('Select * from sys_sucursal s where s.id_sucursal ='.$id_sucursal);
         //echo $this->db->queries[0];
        return $query->result_array();       
        
    }

    public function cerrar_cuenta($cuenta)
    {
        $datePagado = date("Y-m-d h:i:s");
        $dateAnulado = "0000-00-00 00:00:00";
        $categorias = array(
             'ID_pedido'      => $cuenta['idpedidounico'],
             'flag_pagado'    => 1,
             'flag_nopropina'    => 0,
             'flag_exento'    => 0,
             'flag_tiquetado'    => 0,
             'flag_anulado'      => 0,
             'metodo_pago'    => $cuenta['metodoPago'],
             'numero_tarjeta'    => $cuenta['numSend'],
             'total_neto'    => trim($cuenta['pagoNeto']),
             'total_iva'    => trim($cuenta['pagoIva']),
             'total_propina'    => trim($cuenta['pagoPropina']),
             'total_cobrado'    => trim($cuenta['pagoTotal']),
             'fechahora_pagado'      => $datePagado,
             'fechahora_anulado'    => $dateAnulado,
             );
        
        $this->db->insert(self::cuentaTabla,$categorias);

        $data = array(
            'flag_cancelado'   => 1,
        );
        $this->db->where('id_pedido', $cuenta['idpedidounico']);                
        $this->db->update(self::pedidos,$data);

    }

    public function anular_cuenta_insert($cuenta)
    {
        $datePagado = "0000-00-00 00:00:00";
        $dateAnulado = date("Y-m-d h:i:s");
        $categorias = array(
             'ID_pedido'      => $cuenta['idpedidounico'],
             'flag_pagado'    => 0,
             'flag_nopropina'    => 0,
             'flag_exento'    => 0,
             'flag_tiquetado'    => 0,
             'flag_anulado'      => 1,
             'metodo_pago'    => 'anulada',
             'numero_tarjeta'    => '0000',
             'total_neto'    => trim($cuenta['pagoNeto']),
             'total_iva'    => trim($cuenta['pagoIva']),
             'total_propina'    => trim($cuenta['pagoPropina']),
             'total_cobrado'    => trim($cuenta['pagoTotal']),
             'fechahora_pagado'      => $datePagado,
             'fechahora_anulado'    => $dateAnulado,
             );
        
        $this->db->insert(self::cuentaTabla,$categorias);

    }


    public function anular_cuenta_update($cuenta)
    {
        $dateAnulado = date("Y-m-d H:i:s");
        $data = array(
            'flag_pagado'   => 0,
            'flag_anulado'   => 1,
            'fechahora_anulado' => $date
        );
        $this->db->where('ID_pedido', $cuenta['idpedidounico']);                
        $this->db->update(self::cuentaTabla,$data);
    }

    public function getPedidoCuenta($id_pedido)
    {
         $query = $this->db->query('select count(*) as numPedidos from sys_cajacuentas c where c.ID_pedido  ='.$id_pedido);
        return $query->result_array();       
        
    }

    public function addevento_historial($idPedido, $nota, $grupo, $accion, $valor)
    {
        $dateregistro = date("Y-m-d H:i:s");
        $categorias = array(
            'ID_pedido'      => $idPedido,
            'fechahora'    => $dateregistro,
            'nota'    => $nota,
            'grupo'    => $grupo,
            'accion'    => $accion,
            'valor'    => $valor,
             );
        
        $this->db->insert(self::cuenta_historial,$categorias);
    }

    public function separar_cuenta($separarCuenta)
    {
        //-------create nuevo pedido para la separacion de cuentas
        $query = $this->db->query('INSERT INTO sys_pedido 
        SELECT "", secuencia_orden, id_sucursal, id_usuario, id_mesero, numero_mesa, elaborado, mostrado, flag_cancelado,flag_elaborado, flag_despachado, flag_pausa, prioridad, llevar_pedido, porcentaje_descuento, total_descuento, motivo_descuento,codigo_cupon, fechahora_pedido, fechahora_elaborado, fechahora_despachado, fecha_creado, cortado, estado 
            FROM sys_pedido WHERE id_pedido='.$separarCuenta['idpedidounico']);
    
        $query2 = $this->db->query("SELECT max(p.id_pedido) as cuentaNueva FROM sys_pedido p");
        $nuevoID = $query2->result_array();     

        foreach ($separarCuenta['myItems'] as $value) 
        {
            $data = array(
            'id_pedido'   => $nuevoID[0]['cuentaNueva'],
            );
            $this->db->where('id_detalle', $value);                
            $this->db->update(self::sys_pedido_detalle,$data);
        }

        return true;
    }

    public function validaCupon($validaCupon)
    {
        $query = $this->db->query("SELECT count(sc.id_cupon) as validanum, sc.id_cupon, sc.estado_cupon, s.nombre_sucursal, sc.fecha_canjeado_cupon, cc.valor_categoria
          FROM sys_cupon sc 
          inner join sys_cupon_categoria cc ON cc.id_cupon_categoria = sc.id_categoria
          left JOIN sys_sucursal s ON s.id_sucursal = sc.id_sucursal 
          WHERE sc.codigo_cupon ='".$validaCupon['codigoCupon']."'");
        //echo $this->db->queries[0];
        return $query->result_array();       
        
    }


    public function confirmar_cupon($id_cupon, $sucursalID)
    {
        $dateCanjeado = date("Y-m-d H:m:s");
        $data = array(
            'id_sucursal'   => $sucursalID,
            'estado_cupon'   => 1,
            'fecha_canjeado_cupon' => $dateCanjeado
        );
        $this->db->where('id_cupon', $id_cupon);                
        $this->db->update(self::sys_cupon,$data);
    }


    public function eliminar_item($item)
    {
        $data = array(
            'estado'   => 5
        );
        $this->db->where('id_detalle', $item['idpedidounico']);                
        $this->db->update(self::sys_pedido_detalle,$data);
    }
    
}
