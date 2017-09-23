<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class productos_model extends CI_Model
{
    const categoria = 'sys_categoria_producto';
    const producto = 'sys_productos';
    const sucursales = 'sys_sucursal';
    const detalleProducto = 'sys_detalle_producto';
    const psucursales = 'sys_productos_sucursal';
    const unidadMedida = 'sys_unidad_medida';
    const tipoUnidad = 'sys_tipo_unidad_medida';
    const catalogoMateriales = 'sys_catalogo_materiales';

    
    public function __construct()
    {
        parent::__construct();
        
    }
    //obtenemos las entradas de todos o un usuario, dependiendo
    // si le pasamos le id como argument o no
    public function categoria()
    {
        $this->db->select('*');
        $this->db->from(self::categoria);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function getProductos()
    {
        $this->db->select('*');
        $this->db->from(self::producto);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function getAllSucursales()
    {
        $this->db->select('*');
        $this->db->from(self::sucursales);
        $this->db->where(self::sucursales.'.centro_produccion',0);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function getSucursales($prodcutoID)
    {
        //var_dump($prodcutoID);
        $query = $this->db->query('Select s.id_sucursal as id, s.nombre_sucursal as name, p.nombre_pais, ps.id as validate 
            from sys_sucursal s 
            inner join sys_pais_departamento pd on pd.id_departamento = s.id_departamento
            inner join sys_pais p on p.id_pais = pd.id_pais
            left join sys_productos_sucursal ps on ps.id_sucursal = s.id_sucursal 
            and ps.id_producto ='.$prodcutoID.' where s.centro_produccion = 0');
         return $query->result();
         //return $query->result_array();
    
    }

    public function getCategorias()
    {
        //var_dump($prodcutoID);
        $query = $this->db->query('select cp.id_categoria_producto, cp.nombre_categoria_producto 
                from sys_categoria_producto cp ');
         return $query->result();
         //return $query->result_array();
    
    }
    public function getProductoByID($prodcutoID)
    {
        //var_dump($prodcutoID);
        $query = $this->db->query('Select * from  sys_productos p where p.id_producto = '.$prodcutoID);
         return $query->result();
         //return $query->result_array();
    
    }


    public function getNodos()
        {
            $query = $this->db->query('Select * from sys_nodo n where n.estado_nodo = 1');
            return $query->result();
        
        }


    public function save_producto($produc)
    {
        $dateNow = date("YmdHis");
        $dateCreated = date("Y-m-d");
        
        if (isset($_FILES['files']['tmp_name'])) 
        {
            $dataImg = getimagesize($_FILES['files']['tmp_name']);
            if ($dataImg[0] >= 200 or $dataImg[0] <= 350  and $dataImg[1] >= 100 or $dataImg[1] <= 200) 
            {
                //-----------File Imagen profuctos--------------------------------------
                $name = $dateNow."_".$_FILES['files']['name'];
                $fileType = $_FILES['files']['type'];
                $fileError = $_FILES['files']['error'];
                $fileContent = file_get_contents($_FILES['files']['tmp_name']);
                $imagen = "assets/images/productos/".$dateNow."_".$_FILES['files']['name'];

                move_uploaded_file($_FILES['files']['tmp_name'], $imagen);
                //----------------------------------------------------------------------
            }
            else
            {
                echo "3";
                die();
            }
            
        }
        else 
        {
            $name = "default.jpg";
        }
        
        if (isset($_FILES['filevideo']['tmp_name'])) 
        {
            echo "EntreVideo";
        //-----------File video profuctos--------------------------------------
            $nameVideo = $dateNow."_".$_FILES['filevideo']['name'];
            $fileTypeVideo = $_FILES['filevideo']['type'];
            $fileErrorVideo = $_FILES['filevideo']['error'];
            $fileContentVideo = file_get_contents($_FILES['filevideo']['tmp_name']);
            $video = "assets/videos/productos/".$dateNow."_".$_FILES['filevideo']['name'];

            move_uploaded_file($_FILES['filevideo']['tmp_name'], $video);
        //----------------------------------------------------------------------
        }
        else
        {
            $nameVideo = "NULL";
        }    
   
            $productos = array(
             'nombre_producto'      => $produc['nombre'],
             'categoria_id'    => $produc['categoria'],
             'description_producto'      => $produc['descripcion'],
             'video'          => $nameVideo,
             'image'     => $name,
             'fecha_creacion'     => $dateCreated
             );
        
             $this->db->insert(self::producto,$productos);
       
       }

    public function save_categoria($categoriaP)
    {
        $dateNow = date("Y-m-d");
       
        $categorias = array(
             'nombre_categoria_producto'      => $categoriaP['nombre'],
             'descripcion'    => $categoriaP['descripcion'],
             'fecha_creacion'    => $dateNow
             );
        
        $this->db->insert(self::categoria,$categorias);
    }

    public function save_TipounidadMedida($tipoUnidadForm)
    {
        $dateNow = date("Y-m-d");
       
        $tipoUnidadAdd= array(
             'name_tipo_unidad_medida' => $tipoUnidadForm['nombreTipoUnidad'],
             'fecha_creacion'    => $dateNow
             );
        
        $this->db->insert(self::tipoUnidad,$tipoUnidadAdd);
    }

    public function save_unidadMedida($UnidadMedida)
    {
        $dateNow = date("Y-m-d");
       
        $UnidadMedidaAdd = array(
             'nombre_unidad_medida'      => $UnidadMedida['nombreUnidad'],
             'simbolo_unidad_medida'    => $UnidadMedida['simbolo'],
             'id_tipo_unidad_medida'    => $UnidadMedida['tipoUnidad'],
             'valor_unidad_medida'    => $UnidadMedida['valorUnidad'],
             'fecha_creacion'    => $dateNow
             );
        
        $this->db->insert(self::unidadMedida,$UnidadMedidaAdd);
    }

    public function save_ingrediente($ingrediente)
    {
        $dateNow = date("Y-m-d");
        
        $ingredienteDiv = explode("-", $ingrediente['ingrediente']);
        //var_dump($ingredienteDiv);
        $addIngrediente = array(
             'name_detalle'      => $ingredienteDiv[1],
             'id_producto'    => $ingrediente['detalleID'],
             'descripcion'    => $ingrediente['descripcion'],
             'cantidad'    => $ingrediente['cantidad'],
             'unidad_medida_id'    => $ingrediente['unidaMedida'],
             'fecha_creacion'    => $dateNow
             );
        
        $this->db->insert(self::detalleProducto,$addIngrediente);
    }

    public function associate_producto($datos)
    {  
        $dateNow = date("Y-m-d");
        $sucursalP = array(
             'id_sucursal'      => $datos['SucursalId'],
             'id_producto'    => $datos['GlobalProductoId'],
             'fecha_creacion'    => $dateNow
             );
        
        $this->db->insert(self::psucursales,$sucursalP);
    }

    public function disassociate_producto($datos)
    {
         $data = array(
            'id_sucursal' => $datos['SucursalId'],
            'id_producto' => $datos['GlobalProductoId']
        );
        $this->db->delete(self::psucursales, $data); 
    }

    public function delete_producto($datosDelete)
    {
        
        //echo"../../../assets/images/productos/".$datosDelete['ProductoName']; 
         $data = array(
            'id_producto' => $datosDelete['ProductoId']
        );
        $this->db->delete(self::producto, $data);

    }

    public function getNumAssoProdcut($producID)
    {
        $query = $this->db->query('Select count(*) as numData from sys_productos_sucursal  ps where ps.id_producto ='.$producID['ProductoId']);
         //echo $this->db->queries[0];
        return $query->result_array();
    
    }

    public function getNumIngrendientes($producID)
    {
        $query = $this->db->query('Select count(*) as numData from sys_detalle_producto dp 
        inner join sys_productos p on p.id_producto = dp.id_producto 
        where dp.id_producto ='.$producID['productoID']);
         //echo $this->db->queries[0];
        return $query->result_array();
    
    }

    public function getProductorByCategory($producID)
    {
        $this->db->select('*');
        $this->db->from(self::producto);
        $this->db->where(self::producto.'.categoria_id',$producID);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }  
    }

    public function getProductosBySucursal($sucursalID)
    {
        $query = $this->db->query('Select * from sys_productos p
        Inner join sys_productos_sucursal ps ON ps.id_producto = p.id_producto
        where ps.id_sucursal ='.$sucursalID.' group by p.id_producto');
         //echo $this->db->queries[0];
        return $query->result();
       
    }

    public function save_precio($sucursalProductoID)
    {
        
        $data = array(
            'precio'   => $sucursalProductoID['precio']
        );
        $this->db->where('id', $sucursalProductoID['sucursalProdcutoIdSend']);        
        $this->db->update(self::psucursales,$data);
    }    

     public function save_nodo($sucursalProductoID)
    {
        
        $data = array(
            'nodoID'   => $sucursalProductoID['nodoID']
        );
        $this->db->where('id', $sucursalProductoID['sucursalProdcutoIdSend']);        
        $this->db->update(self::psucursales,$data);
    }    


    public function getDetalle($producID)
    {
         $query = $this->db->query('Select dp.id_detalle_producto, dp.name_detalle, dp.id_producto, dp.descripcion, dp.cantidad, dp.unidad_medida_id,
            cm.nombre_matarial, um.nombre_unidad_medida, p.ingredientes_completos
            from sys_detalle_producto dp
            inner join sys_catalogo_materiales cm ON cm.codigo_material = dp.name_detalle
            inner join sys_unidad_medida um ON um.id_unidad_medida = dp.unidad_medida_id
            inner join sys_productos p on p.id_producto = dp.id_producto
            where dp.id_producto ='.$producID);
         //echo $this->db->queries[0];
        return $query->result();
       
    }
    public function getStatusIngrediente($producID)
    {
         $query = $this->db->query('select p.ingredientes_completos from sys_productos p
            where p.id_producto='.$producID);
         //echo $this->db->queries[0];
        return $query->result_array();   
    }
    

    public function unidadMedida()
    {
        
         $query = $this->db->query('Select * from sys_unidad_medida um
        inner join sys_tipo_unidad_medida tum 
        ON tum.id_tipo_unidad_medida =  um.id_tipo_unidad_medida order by tum.id_tipo_unidad_medida');
         //echo $this->db->queries[0];
        return $query->result();
    }

    public function tipoUnidad()
    {
        $this->db->select('*');
        $this->db->from(self::tipoUnidad);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function getCategoriaByID($categoriaID)
    {
        $this->db->select('*');
        $this->db->from(self::categoria);
        $this->db->where(self::categoria.'.id_categoria_producto',$categoriaID); 
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function save_updated($dataModifi){
        session_start();
        $data = array(
            'nombre_categoria_producto'   => $dataModifi['nombreModifi'],
            'descripcion'   => $dataModifi['descripcionModifi'],            
        );
        $this->db->where('id_categoria_producto', $dataModifi['IdModifi']);    
        $this->db->update(self::categoria,$data);
    }

    public function delete_data($datos)
    {
         $data = array(
            'id_categoria_producto' => $datos['dataDeleteID']
        );
        $this->db->delete(self::categoria, $data); 
    }

    public function quitar_detalle($datos)
    {
         $data = array(
            'id_detalle_producto' => $datos['detalleId']
        );
        $this->db->delete(self::detalleProducto, $data); 
    }

    public function delete_dataTipo($datos)
    {
         $data = array(
            'id_tipo_unidad_medida' => $datos['dataDeleteID']
        );
        $this->db->delete(self::tipoUnidad, $data); 
    }


    public function delete_dataUnidad($datos)
    {
         $data = array(
            'id_unidad_medida' => $datos['dataDeleteID']
        );
        $this->db->delete(self::unidadMedida, $data); 
    }


    public function getTipoUnidadByID($tipoUnidadID)
    {
        $this->db->select('*');
        $this->db->from(self::tipoUnidad);
        $this->db->where(self::tipoUnidad.'.id_tipo_unidad_medida',$tipoUnidadID); 
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function getUnidadByID($unidadID)
    {
        $this->db->select('*');
        $this->db->from(self::unidadMedida);
        $this->db->join(self::tipoUnidad,' on '. 
                        self::tipoUnidad.'.id_tipo_unidad_medida = '.
                        self::unidadMedida.'.id_tipo_unidad_medida');
        $this->db->where(self::unidadMedida.'.id_unidad_medida',$unidadID); 
        $query = $this->db->get();
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }        
        
    }

    public function save_updatedTipo($dataModifi){
        session_start();
        $data = array(
            'name_tipo_unidad_medida'   => $dataModifi['nombreModifi'], 
        );
        $this->db->where('id_tipo_unidad_medida', $dataModifi['IdModifi']);    
        $this->db->update(self::tipoUnidad,$data);
    }


    public function save_updatedUnidad($dataModifi){
        session_start();
        $data = array(
            'nombre_unidad_medida'   => $dataModifi['nombreUnidad'], 
            'simbolo_unidad_medida'   => $dataModifi['simboloUnidad'], 
            'id_tipo_unidad_medida'   => $dataModifi['tipoUnidada'], 
            'valor_unidad_medida'   => $dataModifi['valorUnidad'], 
        );
        $this->db->where('id_unidad_medida', $dataModifi['IdModifi']);    
        $this->db->update(self::unidadMedida,$data);
    }

    public function getCatalogoMateriales()
    {
        $searchTerm = $_GET['term'];
        //echo $_GET;
        $query = $this->db->query("Select  cm.nombre_matarial, cm.codigo_material from sys_catalogo_materiales cm  
            where cm.nombre_matarial LIKE '%".$searchTerm."%'");
         //echo $this->db->queries[0];
         return $query->result_array();
        
    }

    public function completos_ingrediente($completoMateriales)
    {
      $data = array( 
            'ingredientes_completos'   => $completoMateriales['IngrendienteStatus'] 
        );
        $this->db->where('id_producto', $completoMateriales['productoID']);    
        $this->db->update(self::producto,$data);
    }

    public function incompletos_ingrediente($incompletoMateriales)
    {
        $data = array( 
            'ingredientes_completos'   => $incompletoMateriales['IngrendienteStatus'] 
        );
        $this->db->where('id_producto', $incompletoMateriales['productoID']);    
        $this->db->update(self::producto,$data);
    }

    public function getArrayInventario($sucursalID)
    {
         $query = $this->db->query('Select cis.codigo_meterial
        from sys_catalogo_inventario_sucursal cis 
        where cis.id_sucursal = '.$sucursalID['IDSucursal']);
         //echo $this->db->queries[0];
        return $query->result_array();

       
    }

    public function getArrayIngredientes($prodcutoID)
    {
         $query = $this->db->query('select dp.name_detalle
        from sys_detalle_producto  dp 
        where dp.id_producto = '.$prodcutoID['IdProductoValidar']);
         //echo $this->db->queries[0];
        return $query->result_array();

       
    }

    public function updateVerificaionIngrediente($IdProductoSucursal, $datoValida)
    {
        $data = array( 
            'verifiDetalle'   => $datoValida 
        );
        $this->db->where('id_producto', $IdProductoSucursal['IdProductoSucursal']);    
        $this->db->update(self::psucursales,$data);
    }

    public function udpate_producto($producto)
    {
        $data = array( 
            'nombre_producto'   => $producto['nombre'],
            'categoria_id'   => $producto['categoria'],
            'description_producto'   => $producto['descripcion'], 
        );
        $this->db->where('id_producto', $producto['idProducto']);    
        $this->db->update(self::producto,$data);
    }

}
/*
 * end of application/models/consultas_model.php
 */
