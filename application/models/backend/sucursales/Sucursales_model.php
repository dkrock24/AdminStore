<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sucursales_model extends CI_Model
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

    

    

    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function getSucursalesByUser($id_user)
    {
        $this->db->select('*');
        $this->db->from(self::sys_sucursal);
        $this->db->join(self::sys_sucursal_int_usuarios,' on '. 
                        self::sys_sucursal_int_usuarios.'.id_sucursal = '.
                        self::sys_sucursal.'.id_sucursal');

        $this->db->join(self::usuarios,' on '. 
                        self::usuarios.'.id_usuario = '.
                        self::sys_sucursal_int_usuarios.'.id_usuario');
        $this->db->where(self::usuarios.'.id_usuario',$id_user);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    } 
    public function getSucursalesById($id_sucursal)
    {
        $this->db->select('*');
        $this->db->from(self::sys_sucursal);
        $this->db->join(self::sys_sucursal_nodo,' on '. 
                        self::sys_sucursal_nodo.'.id_sucursal = '.
                        self::sys_sucursal.'.id_sucursal');

        $this->db->join(self::sys_nodo,' on '. 
                        self::sys_nodo.'.id_nodo = '.
                        self::sys_sucursal_nodo.'.id_nodo');
        $this->db->where(self::sys_sucursal.'.id_sucursal',$id_sucursal);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }  
    public function getSucursalesByNodo($id_sucursal)
    {
        $this->db->select('*');
        $this->db->from(self::sys_sucursal);
        $this->db->join(self::sys_sucursal_nodo,' on '. 
                        self::sys_sucursal_nodo.'.id_sucursal = '.
                        self::sys_sucursal.'.id_sucursal');

        $this->db->join(self::sys_nodo,' on '. 
                        self::sys_nodo.'.id_nodo = '.
                        self::sys_sucursal_nodo.'.id_nodo');
        $this->db->where(self::sys_sucursal.'.id_sucursal',$id_sucursal);
        $this->db->where(self::sys_sucursal_nodo.'.sucursal_estado_nodo',1);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }  
    public function getSucursalByNodoId($id_nodo,$id_sucursal)
    {
        $this->db->select('*');
        $this->db->from(self::sys_sucursal);
        $this->db->join(self::sys_sucursal_nodo,' on '. 
                        self::sys_sucursal_nodo.'.id_sucursal = '.
                        self::sys_sucursal.'.id_sucursal');

        $this->db->join(self::sys_nodo,' on '. 
                        self::sys_nodo.'.id_nodo = '.
                        self::sys_sucursal_nodo.'.id_nodo');
        $this->db->where(self::sys_sucursal.'.id_sucursal',$id_sucursal);
        //$this->db->where(self::sys_sucursal_nodo.'.sucursal_estado_nodo',1);
        $this->db->where(self::sys_sucursal_nodo.'.id_nodo',$id_nodo);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }

    public function login($usuario){
        $this->db->select('*');
        $this->db->from(self::usuarios);        
        $this->db->where(self::usuarios.'.usuario',$id_sucursal);        
        $this->db->where(self::usuarios.'.password',$id_nodo);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    public function getCategorias(){
        $this->db->select('*');
        $this->db->from(self::categorias);        
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    public function getProductosBySucursales($id_sucursal){
        $this->db->select('*');
        $this->db->from(self::sys_productos.' AS P');        
        $this->db->join(self::sys_productos_sucursal.' AS PS ',' on PS.id_producto = P.id_producto');
        $this->db->join(self::sys_sucursal.' AS S',' on S.id_sucursal = '.'PS.id_sucursal');
        $this->db->join(self::sys_pais_departamento.' AS D',' on D.id_departamento = S.id_departamento');
        $this->db->join(self::sys_pais.' AS PA',' on PA.id_pais = D.id_pais');

        $this->db->where('S.id_sucursal',$id_sucursal);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    public function getUsuariosSucursal($id_sucursal){
        $this->db->select('*');
        $this->db->from(self::sys_sucursal.' AS S');        
        $this->db->join(self::sucursal_suarios.' AS SU ',' on SU.id_sucursal = S.id_sucursal');
        $this->db->join(self::usuarios.' AS U',' on U.id_usuario = '.'SU.id_usuario');
        $this->db->where('S.id_sucursal',$id_sucursal);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    public function getValidarUsuariosSucursal($id_sucursal,$id_mesero){
        $this->db->select('*');
        $this->db->from(self::sys_sucursal.' AS S');        
        $this->db->join(self::sucursal_suarios.' AS SU ',' on SU.id_sucursal = S.id_sucursal');
        $this->db->join(self::usuarios.' AS U',' on U.id_usuario = '.'SU.id_usuario');
        $this->db->where('S.id_sucursal',$id_sucursal);
         $this->db->where('U.id_usuario',$id_mesero);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return 1;
        } 
    }

    // Validacion de Materias en exsitencia por producto
    public function getProductoItems($sucursal,$id_producto){
        $this->db->select('P.nombre_producto,PS.id_producto,S.nombre_sucursal,PD.name_detalle,PD.cantidad,PD.unidad_medida_id,
            UM.nombre_unidad_medida,UM.simbolo_unidad_medida,IS.total_existencia,CM.id_unidad_medida,SUM.nombre_unidad_medida AS NombreUnidad2,SUM.simbolo_unidad_medida AS Simbolo2,SUM.id_unidad_medida AS Unidad2,CM.nombre_matarial AS Ingredientes');
        $this->db->from(self::sys_productos.' AS P');
        $this->db->join(self::sys_productos_sucursal.' AS PS',' on P.id_producto = '.'PS.id_producto');
        $this->db->join(self::sys_sucursal.' AS S',' on S.id_sucursal = '.'PS.id_sucursal');
        $this->db->join(self::producto_detalle.' AS PD',' on PD.id_producto = '.'P.id_producto');
        $this->db->join(self::unidad_medida.' AS UM',' on UM.id_unidad_medida = '.'PD.unidad_medida_id');        
        $this->db->join(self::inventario_sucursal.' AS IS',' on IS.codigo_meterial = '.'PD.name_detalle');
        $this->db->join(self::catalogo_materiales.' AS CM',' on CM.codigo_material = '.'IS.codigo_meterial');
        $this->db->join(self::unidad_medida.' AS SUM',' on SUM.id_unidad_medida = '.'CM.id_unidad_medida');
        $this->db->where('S.id_sucursal',$sucursal);
        $this->db->where('P.id_producto',$id_producto);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    public function getValidarDescuentoInventario($codigo_material){
        $this->db->select('*');
        $this->db->from(self::catalogo_materiales.' AS CM');
        $this->db->join(self::inventario_sucursal.' AS IS',' on IS.codigo_meterial = '.'CM.codigo_material');      
        $this->db->join(self::unidad_medida.' AS UM',' on UM.id_unidad_medida = '.'CM.id_unidad_medida');
        $this->db->where('CM.codigo_material',$codigo_material);        
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    // INSERTAR PEDIDO - ENCABEZADO
    public function InsertPedido($Mesa,$Id_Mesero,$Id_Sucursal){
        session_start();
        $date = date("Y-m-d H:m:s");
        $data = array(
            'id_sucursal'       => $Id_Sucursal,           
            'id_usuario'        => $_SESSION['idUser'],
            'id_mesero'         => $Id_Mesero, 
            'numero_mesa'       => $Mesa,            
            'flag_cancelado'    => 0,
            'fechahora_pedido'  => $date,
            'flag_elaborado'    => 0,
            'flag_despachado'   => 0,
            'flag_pausa'        => 0,
            'estado'            => 1,
        );
        $this->db->insert(self::sys_pedido,$data);
        return $this->db->insert_id();
    }

    // INSERTAR PEDIDO - DETALLE
    public function InsertPedidoDetalle($Mesa,$Id_Mesero,$Id_Producto,$Precio,$Id_Sucursal,$Id_Pedido){
        session_start();
        $date = date("Y-m-d H:m:s");
        $data = array(
            'id_pedido'         => $Id_Pedido,           
            'id_producto'       => $Id_Producto,
            'nodo'              => "",            
            'precio_grabado'    => $Precio,
            'precio_original'   => $Precio,
            'estado'            => 0,
        );
        $this->db->insert(self::sys_pedido_detalle,$data);
        return $this->db->insert_id();
    }
    
    // INSERTAR PEDIDO DETALLE MATERIA 
    public function setPedidoDetalleMateria($id_pedido_detalle,$unidad_medida_id,$nombre_producto,$name_detalle,$cantidad){
        
        $date = date("Y-m-d H:m:s");
        $data = array(
            'id_detalle'        => $id_pedido_detalle,           
            'id_unidad'         => $unidad_medida_id,
            'nombre_producto'   => $nombre_producto, 
            'codigo_producto'   => $name_detalle,            
            'cantidad'          => $cantidad,
            'total'             => $cantidad
        );
        $this->db->insert(self::sys_pedido_detalle_materia,$data);
        return $this->db->insert_id();
    }    

    // Reduccion Total Existencias en Inventio
    public function setReduccionInventario($Id_Sucursal,$Id_Producto,$reduccion){
        $data = array(
            'total_existencia'   => $reduccion
        );
        $this->db->where('codigo_meterial', $Id_Producto);        
        $this->db->where('id_sucursal', $Id_Sucursal);  
        $this->db->update(self::inventario_sucursal,$data);
    }

    public function getAdicionalesBySucursal($sucursal){
        $this->db->select('*');
        $this->db->from(self::inventario_sucursal.' AS InvS');
        $this->db->join(self::materiales_adicionales.' AS MA',' on InvS.id_inventario_sucursal = '.'MA.id_material_sucursal');              
        $this->db->join(self::catalogo_materiales.' AS CM',' on CM.codigo_material = '.'InvS.codigo_meterial');              
        $this->db->where('InvS.id_sucursal',$sucursal);        
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    // Obtener el nombre de un Ingrediente Por Su Codigo
    public function getIngredienteByCodigo($codigo){
        $this->db->select('CM.nombre_matarial');
        $this->db->from(self::inventario_sucursal.' AS InvS');        
        $this->db->join(self::catalogo_materiales.' AS CM',' on CM.codigo_material = '.'InvS.codigo_meterial');              
        $this->db->where('CM.codigo_material',$codigo);        
        $query = $this->db->get();
        //echo $this->db->queries[0];
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    // Obtener Los Adicionales Por El Codigo
    public function getAdicionalesByCodigo($codigo){
        $this->db->select('*');
        $this->db->from(self::inventario_sucursal.' AS InvS');
        $this->db->join(self::materiales_adicionales.' AS MA',' on InvS.id_inventario_sucursal = '.'MA.id_material_sucursal');              
        $this->db->join(self::catalogo_materiales.' AS CM',' on CM.codigo_material = '.'InvS.codigo_meterial');              
        $this->db->where('CM.codigo_material',$codigo);        
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }


    
}
/*
 * end of application/models/consultas_model.php
 */
