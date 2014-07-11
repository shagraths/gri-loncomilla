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
        $this->db->where('nombre_t', $nombre);
        $this->db->where('empresa_t', $empresa);
        $cantidad = $this->db->get('tecnico')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "nombre_t" => $nombre,
                "empresa_t" => $empresa,
                "estado_t" => $estado
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

    function actualizar_tec($id, $nombre, $empresa, $estado) {
        $this->db->select('*');
        $this->db->where('id_t', $id);
        $cantidad = $this->db->get('tecnico')->num_rows();
        if ($cantidad == 1):
            $data = array(
                "nombre_t" => $nombre,
                "empresa_t" => $empresa,
                "estado_t" => $estado
            );
            $this->db->update("tecnico", $data);
            return 0;
        else:
            return 1;
        endif;
    }

    function borrar_tec($id) {
        $estado = 'INACTIVO';
        $this->db->select('*');
        $this->db->where('id_t', $id);
        $cantidad = $this->db->get('tecnico')->num_rows();
        if ($cantidad == 1):
            $data = array(
                "estado_t" => $estado
            );
            $this->db->where('id_t', $id);
            $this->db->update("tecnico", $data);
            echo 'oasdasd';
            return 0;
        else:
            return 1;
        endif;
    }

    //todo servicio
    function guardar_s($nombre, $estado) {
        $this->db->select('*');
        $this->db->where('nombre_s', $nombre);
        $cantidad = $this->db->get('servicio')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "nombre_s" => $nombre,
                "estado_s" => $estado
            );
            $this->db->insert("servicio", $data);
            return 0;
        else:
            return 1;
        endif;
    }

    function actualizar_s($id, $nombre, $estado) {
        $this->db->select('*');
        $this->db->where('id_s', $id);
        $cantidad = $this->db->get('servicio')->num_rows();
        if ($cantidad == 1):
            $data = array(
                "nombre_s" => $nombre,
                "estado_s" => $estado
            );
            $this->db->update("servicio", $data);
            return 0;
        else:
            return 1;
        endif;
    }

    function borrar_s($id) {
        
        $estado = 'INACTIVO';
        $this->db->select('*');
        $this->db->where('id_s', $id);
        $cantidad = $this->db->get('servicio')->num_rows();
        if ($cantidad == 1):
            $data = array(
                "estado_s" => $estado
            );
            $this->db->where('id_s', $id);
            $this->db->update("servicio", $data);
            echo 'oasdasd';
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
    function guardar_u($rut, $nombre, $apellido, $clave, $tipo, $estado) {
        $this->db->select('*');
        $this->db->where('rut', $rut);
        $cantidad = $this->db->get('usuario')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "rut" => $rut,
                "nombre" => $nombre,
                "apellido" => $apellido,
                "pass" => md5($clave),
                "nivel" => $tipo,
                "estado_us" => $estado
            );
            $this->db->insert("usuario", $data);
            return 0;
        else:
            return 1;
        endif;
    }

    function actualizar_u($rut, $nombre, $apellido, $clave, $tipo, $estado) {
        $this->db->select('*');
        $this->db->where('rut', $rut);
        $cantidad = $this->db->get('usuario')->num_rows();
        if ($cantidad == 1):
            if ($clave != '') {
                $data = array(
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "pass" => md5($clave),
                    "nivel" => $tipo,
                    "estado_us" => $estado
                );
            } else {
                $data = array(
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "nivel" => $tipo,
                    "estado_us" => $estado
                );
            }
            $this->db->where('rut', $rut);
            $this->db->update("usuario", $data);
            return 0;
        else:
            return 1;
        endif;
    }

    function borrar_u($rut) {
        $estado = 'INACTIVO';
        $this->db->select('*');
        $this->db->where('rut', $rut);
        $cantidad = $this->db->get('usuario')->num_rows();
        if ($cantidad == 1):
            $data = array(
                "estado_us" => $estado
            );
            $this->db->where('rut', $rut);
            $this->db->update("usuario", $data);
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
