<?php

class modelo extends CI_Model {
    
    function conectar($login, $password) {        
        $this->db->select('*');
        $this->db->where('rut', $login);
//        $this->db->where('pass', md5($password));
        return $this->db->get("usuario");
    }
    //todo tecnico
    function guardar_tec($nombre, $empresa, $estado) {
        $this->db->select('*');
        $this->db->where('nombre', $nombre);
        $this->db->where('empresa', $empresa);
        $cantidad = $this->db->get('tecnico')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "nombre" => $nombre,
                "empresa" => $empresa,
                "estado" => $estado
            );
            $this->db->insert("tecnico", $data);
            return 0;
        else:
            return 1;
        endif;
    }
    function grilla_tec() {
        $this->db->select('*');
        return $this->db->get("tecnico");
    }
    //todo servicio
    function guardar_s($nombre, $estado) {
        $this->db->select('*');
        $this->db->where('nombre', $nombre);        
        $cantidad = $this->db->get('servicio')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "nombre" => $nombre,                
                "estado" => $estado
            );
            $this->db->insert("servicio", $data);
            return 0;
        else:
            return 1;
        endif;
    }
    function grilla_s() {
        $this->db->select('*');
        return $this->db->get("servicio");
    }
    //todo usuario
    function guardar_u($rut,$nombre, $apellido, $clave , $tipo, $estado) {
        $this->db->select('*');
        $this->db->where('rut', $rut);        
        $cantidad = $this->db->get('usuario')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "rut" =>$rut,
                "nombre" => $nombre,
                "apellido"=>$apellido,
                "pass"=> md5($clave),
                "nivel"=>$tipo,
                "estado_us" => $estado
            );
            $this->db->insert("usuario", $data);
            return 0;
        else:
            return 1;
        endif;
    }
    function grilla_u() {
        $this->db->select('*');
        return $this->db->get("usuario");
    }
    
}
?>
