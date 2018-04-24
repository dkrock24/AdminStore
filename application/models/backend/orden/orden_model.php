<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class orden_model extends CI_Model
{
    const categoria = 'sys_categoria_producto';
    
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

    public function getProductoById($id)
    {
        $query = $this->db->query('Select * from productsv1 as p left join categoria as c ON c.id_categoria_producto=p.categoria_id where p.id_producto = "'. $id .'"');
        //echo $this->db->queries[0];
        return $query->result();       
        
    } 
}