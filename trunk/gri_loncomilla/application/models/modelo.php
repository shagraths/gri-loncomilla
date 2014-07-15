<?php

class modelo extends CI_Model {

    function conectar($login, $password) {
        $this->db->select('*');
        $this->db->where('rut', $login);
//        $this->db->where('pass', md5($password));
        return $this->db->get("usuario");
    }

    //todo reserva
    function guardar_reserva($abonado, $orden, $nombre, $direccion, $fecha, $h_inicio, $h_fin, $obs, $material, $cb_s, $cb_tec, $estado_r) {
        $this->db->select('*');
        $this->db->where('n_orden', $orden);
        $cantidad = $this->db->get('instalacion')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "n_abonado" => $abonado,
                "n_orden" => $orden,
                "nombre" => $nombre,
                "direccion" => $direccion,
                "motivo" => $cb_s,
                "fecha" => $fecha,
                "hora_inicio" => $h_inicio,
                "hora_fin" => $h_fin,
                "observacion" => $obs,
                "mat_seriado" => $material,
                "tecnico" => $cb_tec,
                "estado" => $estado_r,
                "encuesta_realizada" => "NO"
            );
            $this->db->insert("instalacion", $data);
            return 0;
        else:
            return 1;
        endif;
    }

    function grilla_reserva($fecha) {
        
        $i = "07:00:00";
        $f = "22:00:00";
        $array = array('hora_inicio >=' => $i, 'hora_inicio <=' => $f);
        $this->db->select('*');
        $this->db->where('fecha', $fecha);
        $this->db->where('estado', "ACTIVO");
        $this->db->where($array);
        $this->db->group_by("hora_inicio");
        $this->db->from('instalacion');
        $this->db->join('servicio', 'servicio.id_s=instalacion.motivo');
        $this->db->join('tecnico', 'tecnico.id_t=instalacion.tecnico');
        return $this->db->get();
    }

    function grilla_reserva_e($fecha) {
        $i = "07:00:00";
        $f = "22:00:00";
        $array = array('hora_inicio >=' => $i, 'hora_inicio <=' => $f);
        $this->db->select('*');
        $this->db->where('estado', "ACTIVO");
        $this->db->where('fecha', $fecha);
        $this->db->where('encuesta_realizada', "NO");
        $this->db->where($array);
        $this->db->group_by("hora_inicio");
        $this->db->from('instalacion');
        $this->db->join('servicio', 'servicio.id_s=instalacion.motivo');
        $this->db->join('tecnico', 'tecnico.id_t=instalacion.tecnico');
        return $this->db->get();
    }

    function actualizar_reserva($id, $abonado, $orden, $nombre, $direccion, $fecha, $h_inicio, $h_fin, $obs, $material, $cb_s, $cb_tec, $estado_r) {
        $this->db->select('*');
        $this->db->where('numero', $id);
        $cantidad = $this->db->get('instalacion')->num_rows();
        if ($cantidad == 1):
            $data = array(
                "n_abonado" => $abonado,
                "n_orden" => $orden,
                "nombre" => $nombre,
                "direccion" => $direccion,
                "motivo" => $cb_s,
                "fecha" => $fecha,
                "hora_inicio" => $h_inicio,
                "hora_fin" => $h_fin,
                "observacion" => $obs,
                "mat_seriado" => $material,
                "tecnico" => $cb_tec,
                "estado" => $estado_r
            );
            $this->db->where('numero', $id);
            $this->db->update("instalacion", $data);
            return 0;
        else:
            return 1;
        endif;
    }

    function eliminar_reserva($id) {
        $estado = 'INACTIVO';
        $this->db->select('*');
        $this->db->where('numero', $id);
        $cantidad = $this->db->get('instalacion')->num_rows();
        if ($cantidad == 1):
            $data = array(
                "estado" => $estado
            );
            $this->db->where('numero', $id);
            $this->db->update("instalacion", $data);
            return 0;
        else:
            return 1;
        endif;
    }

    //call center
    function bt_encuesta($id, $e) {
        $this->db->select('*');
        $this->db->where('numero', $id);
        $cantidad = $this->db->get('instalacion')->num_rows();
        if ($cantidad == 1):
            $data = array(
                "encuesta"=>$e,
                "encuesta_realizada" => "SI"
            );
            $this->db->where('numero', $id);
            $this->db->update("instalacion", $data);
            return 0;
        else:
            return 1;
        endif;
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

    function grilla_tec_a() {
        $this->db->select('*');
        $this->db->where('estado_t', "ACTIVO");
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
            $this->db->where('id_t', $id);
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
            return 0;
        else:
            return 1;
        endif;
    }

    //todo servicio
    function guardar_s($nombre, $tiempo ,$estado) {
        $this->db->select('*');
        $this->db->where('nombre_s', $nombre);
        $cantidad = $this->db->get('servicio')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "nombre_s" => $nombre,
                "Tiempo"=>$tiempo,
                "estado_s" => $estado
            );
            $this->db->insert("servicio", $data);
            return 0;
        else:
            return 1;
        endif;
    }

    function actualizar_s($id, $nombre,$tiempo, $estado) {
        $this->db->select('*');
        $this->db->where('id_s', $id);
        $cantidad = $this->db->get('servicio')->num_rows();
        if ($cantidad == 1):
            $data = array(
                "nombre_s" => $nombre,
                 "Tiempo"=>$tiempo,
                "estado_s" => $estado
            );
            $this->db->where('id_s', $id);
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
            return 0;
        else:
            return 1;
        endif;
    }

    function grilla_s() {
        $this->db->select('*');
        return $this->db->get("servicio");
    }

    function grilla_s_a() {
        $this->db->select('*');
        $this->db->where('estado_s', "ACTIVO");
        return $this->db->get("servicio");
    }
    function grilla_s_a_id($cb_s) {
        $this->db->select('*');
        $this->db->where('id_s', $cb_s);
        $this->db->where('estado_s', "ACTIVO");
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
