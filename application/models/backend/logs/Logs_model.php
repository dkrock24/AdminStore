<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class logs_model extends CI_Model
{
    const sys_procesos_log = 'sys_procesos_log';
    

    public function __construct()
    {
        parent::__construct();
        
    }

    function setLog($proceso,$sucursal,$usuario){
        //$date = date("Y-m-d H:m:s");
        $data = array(
            'proceso_id'    => $proceso,
            'sucursal_id'    => $sucursal,
            'id_usuario'    => $usuario
        );
        $this->db->insert(self::sys_procesos_log,$data);
    }
    
    public function getAllLogs()
    {      
        $query = $this->db->query('select p.nombre_proceso,u.nickname,s.nombre_sucursal,logss.fecha_log from sys_procesos_log as logss 
    join sys_procesos as p on logss.proceso_id = p.id
    left join sys_sucursal as s on s.id_sucursal=logss.sucursal_id
    join sr_usuarios as u on u.id_usuario=logss.id_usuario');
            //echo $this->db->queries[0];
            return $query->result(); 
    } 
}
