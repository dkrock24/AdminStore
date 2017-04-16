<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class alertas_model extends CI_Model
{
	const notificaciones    =  'sys_notificaciones';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAlertasAdmin($sucursal){
    	$query = $this->db->query('select *,S.nombre_sucursal,U.nickname from sys_notificaciones as N 
    								join sys_notificaciones_mensajes as NM on N.id_mensaje=NM.id_mensaje 
    								join sys_sucursal as S on S.id_sucursal=N.id_sucursal
    								join sr_usuarios as U on U.id_usuario=N.id_usuario
    								where N.propietario='.$sucursal.' and N.mostrado=0 Limit 1');    
        return $query->result(); 
    }

    public function setAlertasAdmin($id){
    	$data = array(
            'mostrado'   => 1,
            );
            $this->db->where('id_notificacion', $id);                
            $this->db->update(self::notificaciones,$data);
    }

    // Insert de Alertas Genericas
    public function setAlerta($id_sucursal,$var_id_usuario,$propietario,$mensaje){
    	$data = array(
            'id_sucursal'  	=> $id_sucursal,
            'id_usuario' 	=> $var_id_usuario,
            'propietario' 	=> $propietario,
            'id_mensaje' 	=> $mensaje,
            'mostrado' 		=> 0,
            'visto' 		=> 0,

        );
        $this->db->insert(self::notificaciones,$data);
    }
    // GEt No Vistas
    public function getAlertasVistas(){
    	$query = $this->db->query('select count(*)as Total from sys_notificaciones as N 
    								join sys_notificaciones_mensajes as NM on N.id_mensaje=NM.id_mensaje 
    								join sys_sucursal as S on S.id_sucursal=N.id_sucursal
    								join sr_usuarios as U on U.id_usuario=N.id_usuario
    								and N.visto=0');    
        return $query->result(); 
    }
    // Obtener Alertas Por Tipo de Mensaje
    public function getAlertasLoginNoVistas($id_mensaje){
    	$query = $this->db->query('select *,S.nombre_sucursal,U.nickname,NM.mensaje from sys_notificaciones as N 
    								join sys_notificaciones_mensajes as NM on N.id_mensaje=NM.id_mensaje 
    								join sys_sucursal as S on S.id_sucursal=N.id_sucursal
    								join sr_usuarios as U on U.id_usuario=N.id_usuario
    								and N.visto=0 and N.id_mensaje='.$id_mensaje);    
        return $query->result(); 
    }

    
}

?>