<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class orden_model extends CI_Model
{
    const categoria = 'sys_categoria_producto';
    const sys_pedido = 'sys_pedido'; 
    const sys_pedido_detalle = 'sys_pedido_detalle'; 
    const sys_secuencia = 'sys_secuencia';
    const sys_productos_sucursal = 'sys_productos_sucursal';
    const sys_sucursal_nodo = 'sys_sucursal_nodo';
    const productsv1 = 'productsv1';
    
    
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
    public function saveOrden( $datos_orden , $productos){

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

        //session_start();
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
        $this->InsertPedidoDetalle(  $id_orden , $datos_orden['sucursalActiva'] , $productos, $datos_orden['nota_interna']);

        return $id_orden;
    }

    public function InsertPedidoDetalle( $id_orden , $id_sucursal , $productos ,$nota_interna ){
        // Insertando el detalle de producto por orden
        $date = date("Y-m-d H:m:s");

        $total = 0;
        $shipping = 0;
        $subtotal = 0;
        $contadorTabla =1;
        $precio_minimo=0;

        foreach ($productos as $value) {
            
            foreach ($value as $demo) {

                $nodo = $this->nodoByProducto( $id_sucursal , $demo->id_producto );

                if($demo->ck =='true'){
                    
                    if($demo->precio_minimo !=0){
                        $total = $demo->precio_minimo * $demo->cnt;
                        //$subtotal +=  $demo->precio_minimo * $demo->cnt;
                    }else{
                        $total = $demo->numerico1 * $demo->cnt;
                        //$subtotal +=  $demo->numerico1 * $demo->cnt;
                    }
                    
                    $precio_minimo = $demo->precio_minimo;
                }else{
                    //$subtotal +=  $demo->numerico1 * $demo->cnt;
                    $total = $demo->numerico1 * $demo->cnt;
                    $precio_minimo = 0;
                } 
                $original = $demo->numerico1 * $demo->cnt;

                $data = array(
                    'id_pedido'         => $id_orden,           
                    'id_producto'       => $demo->id_producto,
                    'id_nodo'           => $nodo[0]->nodoID,           
                    'producto_elaborado'=> 0,
                    'precio_grabado'    => $total,
                    'precio_original'   => $original,
                    'cantidad'          => $demo->cnt,
                    'llevar'            => 0,
                    'pedido_estado'     => 1,
                    'nota_interna'      => $nota_interna,
                    'estado'            => 1,
                );     
                $this->db->insert(self::sys_pedido_detalle,$data);         
            }                   
        }
        return 1;        
        
    }

    public function nodoByProducto( $id_sucursal , $id_producto ){
        
        $this->db->select('*');
        $this->db->from(self::sys_productos_sucursal.' AS ps');
        $this->db->where('ps.id_sucursal', $id_sucursal );
        $this->db->where('ps.id_producto', $id_producto );
        $query = $this->db->get();
        //echo $this->db->queries[3];

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

    public function listarOrdenes( $sucursales ){

        $in = '(' . implode(',', $sucursales) .')';


        $query = $this->db->query('select * from sys_pedido AS P
                    right join sys_pedido_detalle AS PD on P.id_pedido = PD.id_pedido
                    left join productsv1 AS Pr ON Pr.id_producto = PD.id_producto
                    left join sys_sucursal AS S ON S.id_sucursal = P.id_sucursal
                    left join sys_pedido_estados as Pe ON Pe.id_pedido_estado = PD.pedido_estado
                    where S.id_sucursal IN '. $in .' group by P.id_pedido order by P.fechahora_pedido desc, P.id_pedido desc' );
        //echo $this->db->queries[3];
        
        return $query->result();       
    }

    public function detaelleOrden( $idOrden ){

        $query = $this->db->query('select *, Us.nickname as Uno, U.nickname as Dos , es.pedido_estado from sys_pedido AS P
                    left join sys_pedido_detalle AS PD on P.id_pedido = PD.id_pedido
                    left join productsv1 AS Pr on Pr.id_producto = PD.id_producto
                    left join sys_sucursal AS S on S.id_sucursal = P.id_sucursal
                    left join  sys_pais_departamento AS dep on dep.id_departamento = S.id_departamento
                    left join sys_pais as Pais on Pais.id_pais = dep.id_pais
                    left join sr_usuarios as U on U.id_usuario = PD.elaborado_por
                    left join sr_usuarios as Us on Us.id_usuario = PD.entregado_por
                    left join sys_pedido_estados as es on es.id_pedido_estado=PD.pedido_estado
                    where P.id_pedido = '. $idOrden );
        //echo $this->db->queries[3];
        
        return $query->result();       
    }

    public function asociarProductos(){

        $this->db->select('*');
        $this->db->from(self::productsv1);
        $query = $this->db->get();

        if($query->num_rows() > 0 )
        {
            //return $query->result();

            foreach ($query->result() as $productos) {
            $data = array(
                    'id_sucursal'         => 21,           
                    'id_producto'       => $productos->id_producto,
                    'nodoID'           => 1,           
                );     
            $this->db->insert(self::sys_productos_sucursal,$data);  
            }
        }      
    }

    public function actualizarOrden( $orden )
    {
        //$date = date("Y-m-d H:m:s");
        $data = array(
            'pedido_estado'   => $orden['estado'],
            
        );
        $this->db->where('id_pedido', $orden['idOrden']);                
        $this->db->update(self::sys_pedido_detalle,$data);
    }


}