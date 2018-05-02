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
    const pedidos = 'sys_pedido';
    const sys_secuencia = 'sys_secuencia';
    const sys_sucursal_pc = 'sys_sucursal_pc';

    

    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    // Busca las sucursales que el usuario tiene asignadas
    public function getSucursalesByUser($id_user)
    {
        //$pc = $this->getMac();

        $this->db->select('*');
        $this->db->from(self::sys_sucursal);
        $this->db->join(self::sys_sucursal_int_usuarios,' on '. 
                        self::sys_sucursal_int_usuarios.'.id_sucursal = '.
                        self::sys_sucursal.'.id_sucursal');

        $this->db->join(self::usuarios,' on '. 
                        self::usuarios.'.id_usuario = '.
                        self::sys_sucursal_int_usuarios.'.id_usuario');

        $this->db->join(self::sys_pais_departamento,' on '. 
                        self::sys_pais_departamento.'.id_departamento = '.
                        self::sys_sucursal.'.id_departamento');

        //$this->db->join(self::sys_sucursal_pc,' on '. 
          //              self::sys_sucursal_pc.'.id_sucursal = '.
            //            self::sys_sucursal.'.id_sucursal');

        $this->db->where(self::usuarios.'.id_usuario',$id_user);
        //$this->db->where(self::sys_sucursal_pc.'.mac_address',$pc);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    } 

    

    // obtiene la mc de la pc y valida el permiso
    public function getMac()
    {
        echo $user =  gethostbyaddr($_SERVER['REMOTE_ADDR'])  ;
        //$pass =  sha1($user);
        return $user;
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
        
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
    }

    public function getEmpleadosBySucursal( $id_sucursal ){
        $this->db->select('*');
        $this->db->from(self::sys_sucursal_int_usuarios);     

        $this->db->join(self::usuarios,' on '. 
                        self::usuarios.'.id_usuario = '.
                        self::sys_sucursal_int_usuarios.'.id_usuario');

        $this->db->join(self::sys_sucursal,' on '. 
                        self::sys_sucursal.'.id_sucursal = '.
                        self::sys_sucursal_int_usuarios.'.id_sucursal');

        $this->db->join(self::sys_pais_departamento,' on '. 
                        self::sys_pais_departamento.'.id_departamento = '.
                        self::sys_sucursal.'.id_departamento');

        $this->db->where(self::sys_sucursal_int_usuarios.'.id_sucursal',$id_sucursal);        
        $this->db->where(self::usuarios.'.rol <>',1);

        $query = $this->db->get();
        
        
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
        $this->db->where('U.rol <>',1);
        $this->db->where('U.rol <>',15);

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
        $this->db->select('P.nombre_producto,PS.id_producto,S.nombre_sucursal,PD.name_detalle,PD.cantidad,PD.unidad_medida_id,PS.nodoID,
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
        $this->db->group_by('IS.codigo_meterial');
        $query = $this->db->get();   
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    // Validacion de Materias en exsitencia por Codigo
    public function getItemsByCodigo($sucursal,$codigo){
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
        $this->db->where('PD.name_detalle',$codigo);
        $query = $this->db->get();        
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    public function getValidarDescuentoInventario($sucursal,$codigo_material){
        $this->db->select('*');
        $this->db->from(self::catalogo_materiales.' AS CM');
        $this->db->join(self::inventario_sucursal.' AS IS',' on IS.codigo_meterial = '.'CM.codigo_material');      
        $this->db->join(self::unidad_medida.' AS UM',' on UM.id_unidad_medida = '.'CM.id_unidad_medida');
        $this->db->where('CM.codigo_material',$codigo_material);        
        $this->db->where('IS.id_sucursal',$sucursal);  
        $query = $this->db->get();
        //echo $this->db->queries[2];
        //echo "<br>";
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    // INSERTAR PEDIDO - ENCABEZADO
    public function InsertPedido($Mesa,$Id_Mesero,$Id_Sucursal){

        // obtener la secuencia de la secursal
        $date = date("Y-m-d");
        $fecha_secuencia;
        $valor_secuencia;

        $this->db->select('*');
        $this->db->from(self::sys_secuencia.' AS s');
        $this->db->where('s.id_sucursal',$Id_Sucursal);
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
                    $this->UpdateSecuencia($Id_Sucursal,$valor_secuencia);
                }
                else
                {
                    $valor_secuencia = "0001";
                    $this->UpdateSecuencia($Id_Sucursal,$valor_secuencia);
                }
            }
        }
        

        session_start();
        $date = date("Y-m-d H:i:s");
        $data = array(
            'secuencia_orden'   => $valor_secuencia,
            'id_sucursal'       => $Id_Sucursal,           
            'id_usuario'        => $_SESSION['idUser'],
            'id_mesero'         => $Id_Mesero, 
            'numero_mesa'       => $Mesa,  
            'elaborado'         => 0,
            'flag_cancelado'    => 0,
            'fechahora_pedido'  => $date,
            'flag_elaborado'    => 1,
            'flag_despachado'   => 0,
            'flag_pausa'        => 0,
            'estado'            => 1,
        );
        $this->db->insert(self::sys_pedido,$data);
        return $this->db->insert_id();
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

    // INSERTAR PEDIDO - DETALLE
    public function InsertPedidoDetalle($Mesa,$Id_Mesero,$Id_Producto,$Precio,$nodo,$Id_Sucursal,$Id_Pedido,$llevar){

          //------ Calculos de precio con y sin IVA por prodcuto
            $valorImpuesto = 0;
            $impuesto = $this->validateImpuestoSucursal($Id_Sucursal,$Id_Producto);
            //var_dump($impuesto);
            if (empty($impuesto)) 
            {
                $impuesto = $this->validateImpuestoPais($Id_Sucursal);
                $valorImpuesto = $impuesto[0]['monto_impuesto'] + 1;
                $precioOriginal = $Precio / $valorImpuesto;
                //echo $precioOriginal."pais<br>";
            }
            else
            {
                //var_dump($impuesto);
                $valorImpuesto = $impuesto[0]['monto_impuesto'] + 1;
                $precioOriginal = $Precio / $valorImpuesto;
                //echo $precioOriginal."sucursal<br>";
            }

        // End    
        
        $date = date("Y-m-d H:m:s");
        $data = array(
            'id_pedido'         => $Id_Pedido,           
            'id_producto'       => $Id_Producto,
            'id_nodo'           => $nodo,           
            'producto_elaborado'=> 0,
            'precio_grabado'    => $Precio,
            'precio_original'   => $precioOriginal,
            'llevar'            => $llevar,
            'estado'            => 0,
        );
        $this->db->insert(self::sys_pedido_detalle,$data);
        return $this->db->insert_id();
    }

    //-------------query para validar  impuesto por sucursal
    public function validateImpuestoSucursal($idSucursal, $productoID)
    {
         $query = $this->db->query('Select si.monto_impuesto from sys_productos_sucursal ps
            Inner join sys_productos p ON p.id_producto = ps.id_producto
            Inner join sys_sucursal_impuesto si ON si.categoria_impuesto = p.categoria_id and si.id_sucursal = '.$idSucursal.' where  p.id_producto ='.$productoID.' group by si.monto_impuesto');
        //echo $this->db->queries[4];
        return $query->result_array();       
        
    }

    

    //-------------query para validar impuesto por pais
    public function validateImpuestoPais($idSucursal)
    {
         $query = $this->db->query('Select sp.monto_impuesto from sys_pais_impuesto sp
                            inner join sys_pais_departamento pd ON pd.id_pais = sp.id_pais
                            inner join sys_sucursal s ON s.id_departamento = pd.id_departamento
                            where s.id_sucursal ='.$idSucursal);
        return $query->result_array();       
        
    }
    
    // INSERTAR PEDIDO DETALLE MATERIA 
    public function setPedidoDetalleMateria($id_pedido_detalle,$unidad_medida_id,$neutro,$adicional,$eliminado,$name_detalle,$cantidad,$precio_adicional){
        
        $date = date("Y-m-d H:m:s");
        $data = array(
            'id_detalle'        => $id_pedido_detalle,           
            'id_unidad'         => $unidad_medida_id,
            'neutro'            => $neutro,            
            'adicional'         => $adicional,
            'eliminado'         => $eliminado,
            'codigo_producto'   => $name_detalle,
            'cantidad'          => $cantidad,
            'precio_adicional'  => $precio_adicional
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
        //echo $this->db->queries[0];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    // Obtener el nombre de un Ingrediente Por Su Codigo
    public function getIngredienteByCodigo($codigo){
        $this->db->select('CM.nombre_matarial,CM.codigo_material');
        $this->db->from(self::inventario_sucursal.' AS InvS');        
        $this->db->join(self::catalogo_materiales.' AS CM',' on CM.codigo_material = '.'InvS.codigo_meterial');              
        $this->db->where('CM.codigo_material',$codigo);    
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->queries[0];
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    // Obtener Detalle del item, por su codigo
    public function getItemsByCodigo2($sucursal,$codigo){
        $this->db->select('*');
        $this->db->from(self::inventario_sucursal.' AS InvS');        
        $this->db->join(self::materiales_adicionales.' AS MA',' on MA.id_material_sucursal = '.'InvS.id_inventario_sucursal');                      
        $this->db->where('InvS.codigo_meterial',$codigo);        
        $this->db->where('InvS.id_sucursal',$sucursal);  
        $query = $this->db->get();
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

    // Flag de Elaborado
    public function despacharPedido($id_orden,$id_sucursal,$nodo){
        
        $data = array(
            'elaborado'   => 1,
            'flag_elaborado' =>1
        );
        $this->db->where('id_pedido', $id_orden);                
        $this->db->update(self::sys_pedido,$data);

        // Buscar elementos a                   
        $data1 = array(
            'producto_elaborado'   => 1,
            'pedido_estado'         =>3
        );
        $this->db->where('id_nodo',$nodo);
        $this->db->where('id_pedido',$id_orden);          
        $this->db->update(self::sys_pedido_detalle,$data1);


    }


 //---------------Modelos para despacho
    public function getPedidosDespachoBySucursal($id_sucursal)
    {
         $query = $this->db->query('Select sp.id_pedido, sp.id_usuario, sp.id_mesero, sp.numero_mesa, sp.elaborado, sp.flag_cancelado, sp.flag_elaborado, sp.flag_despachado, sp.porcentaje_descuento, sp.total_descuento,
        sp.fechahora_pedido, sp.fecha_creado, pd.id_detalle, pd.id_producto, pd.precio_grabado, pd.precio_original, GROUP_CONCAT(p.nombre_producto) as name_producto, u.nombres, u.apellidos, sp.id_sucursal
          from sys_pedido sp
        inner join sys_pedido_detalle pd ON pd.id_pedido = sp.id_pedido
        inner join sys_productos p ON p.id_producto = pd.id_producto
        inner join sr_usuarios u ON u.id_usuario = sp.id_mesero
        where  sp.flag_cancelado = 0 and sp.flag_despachado <> 1
        and sp.id_sucursal = '.$id_sucursal.'  group by sp.id_pedido
          order by sp.flag_elaborado = 0, sp.id_pedido asc');
         //echo $this->db->queries[0];
        return $query->result();       
        
    }

    public function getPedidosDespachoBySucursalLoad($id_sucursal, $lastdate)
    {
         $query = $this->db->query('Select count(*) as numPedidos from sys_pedido sp
            where  sp.flag_cancelado = 0 and sp.flag_despachado <> 1
            and sp.id_sucursal = '.$id_sucursal.' and sp.fechahora_pedido > '.$lastdate.' order by sp.flag_elaborado = 0, sp.id_pedido asc');
         //echo $this->db->queries[0];
        return $query->result();       
        
    }

    public function update_despacho($dataPedido){
        $data = array(
            'flag_despachado'   => 1,            
        );
        $this->db->where('id_pedido', $dataPedido['pedidoID']);    
        $this->db->update(self::pedidos,$data);
    }       

    public function getDatosSucursal($id_sucursal)
    {
         $query = $this->db->query('Select * from sys_sucursal s where s.id_sucursal ='.$id_sucursal);
         //echo $this->db->queries[0];
        return $query->result_array();       
    } 

    public function getEstadoMesa( $numero_mesa , $id_sucursal )
    {
         $query = $this->db->query('select p.id_pedido from sys_pedido as p
                                    where p.flag_cancelado=0 and p.id_sucursal='.$id_sucursal.' and p.numero_mesa='.$numero_mesa);
         //echo $this->db->queries[0];
        return $query->result_array();       
    }   

    public function getEstados(){
        $query = $this->db->query('select * from sys_pedido_estados');
         //echo $this->db->queries[0];
        return $query->result(); 
    }      

}
?>