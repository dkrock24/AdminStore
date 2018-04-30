<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class orden_model extends CI_Model
{
    const categoria = 'sys_categoria_producto';
    const sys_pedido = 'sys_pedido'; 
    const sys_pedido_detalle = 'sys_pedido_detalle'; 
    const sys_secuencia = 'sys_secuencia';
    const sys_productos_sucursal = 'sys_productos_sucursal';
    
    public function __construct()
    {
        parent::__construct();
        
    }
   
	public function getByCodigo($codigo)
    {
        $query = $this->db->query('Select * from productsv1 as p left join categoria as c ON c.id_categoria_producto=p.categoria_id where p.nombre_producto like "%'. $codigo .'%"');
        //echo $this->db->queries[0];
        return $query->result();       
        
    } 

    public function getByCategoria($categoria)
    {
        $query = $this->db->query('Select * from productsv1 as p left join categoria as c ON c.id_categoria_producto=p.categoria_id where c.id_categoria_producto = "'. $categoria .'"');
        //echo $this->db->queries[0];
        return $query->result();       
        
    } 

    public function getProductoById($id,$cantidad,$ck)
    {
        $query = $this->db->query('Select  *, "'.$cantidad.'" AS cnt, "'.$ck.'" AS ck  from productsv1 as p left join categoria as c ON c.id_categoria_producto=p.categoria_id where p.id_producto = "'. $id .'"');

        //echo $this->db->queries[0];
        return $query->result();       
        
    } 

    // SAve Encabezado de la orden
    public function saveOrden( $datos_orden ){

        // obtener la secuencia de la secursal
        $date = date("Y-m-d");
        $fecha_secuencia;
        $valor_secuencia;

        $this->db->select('*');
        $this->db->from(self::sys_secuencia.' AS s');
        $this->db->where('s.id_sucursal', $datos_orden['sucursalActiva'] );
        $query = $this->db->get();

        if($query->num_rows() > 0 )
        {
            $info = $query->result();
            foreach ($info as $value) {
                $fecha_secuencia    = strtotime($value->fecha_secuencia,time());
                $fecha_actual       = strtotime($date,time());
                $numero             = $value->valor_secuencia;
                $numero++;
                if($fecha_secuencia==$fecha_actual){
                    $valor_secuencia = str_pad($numero,4,"0",STR_PAD_LEFT) ;
                    $this->UpdateSecuencia( $datos_orden['sucursalActiva'] ,$valor_secuencia);
                }
                else
                {
                    $valor_secuencia = "0001";
                    $this->UpdateSecuencia( $datos_orden['sucursalActiva'] ,$valor_secuencia);
                }
            }
        }

        session_start();
        $date = date("Y-m-d H:i:s");
        $data = array(
            'secuencia_orden'   => $valor_secuencia,
            'id_sucursal'       => $datos_orden['sucursalActiva'],           
            'id_usuario'        => $_SESSION['idUser'],
            'id_mesero'         => 0, 
            'numero_mesa'       => 0,  
            'elaborado'         => 0,
            'flag_cancelado'    => $datos_orden['pagado'],
            'fechahora_pedido'  => $date,
            'flag_elaborado'    => 1,
            'flag_despachado'   => 0,
            'flag_pausa'        => 0,
            'estado'            => 1,
            'cliente'           => $datos_orden['cliente'],
            'email'             => $datos_orden['email'],
            'telefono'          => $datos_orden['telefono'],
            'celular'           => $datos_orden['celular'],
            'de'                => $datos_orden['de'],
            'para'              => $datos_orden['para'],
            'direccion'         => $datos_orden['direccion'],
            'dedicatoria'       => $datos_orden['texto'],
            'fecha_sugerida_entrega'=>$datos_orden['fecha_entrega'],
            'tarjeta'           => $datos_orden['tarjeta'],
            'cvs'               => $datos_orden['cvs'],
            'nota_interna'      => $datos_orden['nota_interna'],
        );
        $this->db->insert(self::sys_pedido,$data);

        //Insertando pedido Detalle
        $id_orden = $this->db->insert_id();
        $this->InsertPedidoDetalle(  $id_orden , $datos_orden['sucursalActiva']);

        return $id_orden;
    }

    public function InsertPedidoDetalle( $id_orden , $id_sucursal ){
        // Insertando el detalle de producto por orden

        foreach ($_SESSION['cart'] as $value) {
            
            foreach ($value as $demo) {

                $nodo = $this->nodoByProducto( $id_sucursal , $demo->id_producto );

                if($demo->ck =='true'){
                    
                    if($demo->precio_minimo !=0){
                        $total = $demo->precio_minimo * $demo->cnt;
                        $subtotal +=  $demo->precio_minimo * $demo->cnt;
                    }else{
                        $total = $demo->numerico1 * $demo->cnt;
                        $subtotal +=  $demo->numerico1 * $demo->cnt;
                    }
                    
                    $precio_minimo = $demo->precio_minimo;
                }else{
                    $subtotal +=  $demo->numerico1 * $demo->cnt;
                    $total = $demo->numerico1 * $demo->cnt;
                    $precio_minimo = 0;
                }               
            }                   
        }

        $date = date("Y-m-d H:m:s");
        $data = array(
            'id_pedido'         => $id_orden,           
            'id_producto'       => $Id_Producto,
            'id_nodo'           => $nodo,           
            'producto_elaborado'=> 0,
            'precio_grabado'    => $Precio,
            'precio_original'   => $precioOriginal,
            'llevar'            => $llevar,
            'estado'            => 1,
        );
        $this->db->insert(self::sys_pedido_detalle,$data);
    }

    public function nodoByProducto( $id_sucursal , $id_producto ){
        
        $this->db->select('*');
        $this->db->from(self::sys_productos_sucursal.' AS pd');
        $this->db->where('pd.id_sucursal', $id_sucursal );
        $query = $this->db->get();

        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    public function UpdateSecuencia($Id_Sucursal,$valor_secuencia)
    {
        $date = date("Y-m-d H:m:s");
        $data = array(
            'fecha_secuencia'   => $date,
            'valor_secuencia'   => $valor_secuencia
        );
        $this->db->where('id_sucursal', $Id_Sucursal);                
        $this->db->update(self::sys_secuencia,$data);
    }
}