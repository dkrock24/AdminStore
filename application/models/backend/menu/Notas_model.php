<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class notas_model extends CI_Model
{
    const entradas = 'home_menu_entradas';
    
    public function __construct()
    {
        parent::__construct();
        
    }
    //Actualizar Roles
    public function saveNotas($data)
    {
        $entradas = array(
            'id_submenu'    => $_POST['menuNota'],
            'id_usuario'    => $_POST['usuario'],
            'titulo'        => $_POST['titulo'],
            'subtitulo'     => $_POST['subtitulo'],
            'contenido'     => $_POST['contenido'],
            'imagen'        => $_POST['nombreImagen'],
            'documento'     => $_POST['nombreDocumento'],
            'video'         => $_POST['video'],
            'referencia'    => $_POST['referencia'],
            'orden'         => 0,
            'estado'        => $_POST['estado']
        );
        $this->db->insert(self::entradas,$entradas);  
    }

    public function UpdateNota(){
        //var_dump($_POST);
        //exit();
        if($_POST['nombreImagen1']!=""){
            $nueva_imagen = $_POST['nombreImagen1'];
        }
        if($_POST['nombreDocumento1']!=""){
            $nueva_documento = $_POST['nombreDocumento1'];
        }

        if($nueva_imagen!="" && $nueva_documento!=""){
                $data = array(
                'titulo'    => $_POST['titulo1'],
                'subtitulo' => $_POST['subtitulo1'],
                'contenido' => $_POST['contenido1'],
                'imagen'    => $nueva_imagen,
                'documento' => $nueva_documento,
                'video'     => $_POST['video1'],
                'referencia'=> $_POST['referencia1'],            
                'estado'    => $_POST['estado1']
            );
        }

        if($nueva_imagen=="" && $nueva_documento==""){
                $data = array(
                'titulo'    => $_POST['titulo1'],
                'subtitulo' => $_POST['subtitulo1'],
                'contenido' => $_POST['contenido1'],
                'video'     => $_POST['video1'],
                'referencia'=> $_POST['referencia1'],            
                'estado'    => $_POST['estado1']
            );
        }

        if($nueva_imagen!="" && $nueva_documento==""){
                $data = array(
                'titulo'    => $_POST['titulo1'],
                'subtitulo' => $_POST['subtitulo1'],
                'contenido' => $_POST['contenido1'],
                'imagen'    => $nueva_imagen,                
                'video'     => $_POST['video1'],
                'referencia'=> $_POST['referencia1'],            
                'estado'    => $_POST['estado1']
            );
        }

        if($nueva_imagen=="" && $nueva_documento!=""){
                $data = array(
                'titulo'    => $_POST['titulo1'],
                'subtitulo' => $_POST['subtitulo1'],
                'contenido' => $_POST['contenido1'],
                'documento' => $nueva_documento,           
                'video'     => $_POST['video1'],
                'referencia'=> $_POST['referencia1'],            
                'estado'    => $_POST['estado1']
            );
        }
        
        $this->db->where('id_entrada', $_POST['IdNota']);
        $this->db->update(self::entradas, $data);   
        //echo $this->db->queries[0];   
    }
}
/*
 * end of application/models/consultas_model.php
 */
