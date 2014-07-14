<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("modelo");
    }

    public function index() {
        $this->load->view('Por_defecto/home');
    }

    function cargar_login() {
        $this->load->view('Por_defecto/login');
    }

    function tabla_reserva() {
        $this->load->view('ADMINISTRADOR/tabla_reserva');
    }

    function vendedor() {
        $this->load->view('VENDEDOR/ver_horario');
    }

    function call_center() {
        $this->load->view('CALL_CENTER/archivos');
    }

    function verificarLogin() {
        $valor = 0;
        $nombre = '';
        $apellido = '';
        $nivel = '';
        $login = '';
        $password = '';

        if ($this->session->userdata('esta_logueado') == true) {
            $valor = 1;
            $login = $this->session->userdata('login');
            $nombre = $this->session->userdata('nombre');
            $apellido = $this->session->userdata('apellido');
            $password = $this->session->userdata('password');
            $nivel = $this->session->userdata('nivel');
        }
        echo json_encode(array('valor' => $valor,
            'login' => $login,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'password' => $password,
            'nivel' => $nivel));
    }

    function conectar() {

        $login = $this->input->post("login");
        $password = $this->input->post("password");
        $nombre = '';
        $apellido = '';
        $nivel = '';
        $estado = '';
        $valor = 0;
        $cookie = array('login' => '', 'nombre' => '', 'apellido' => '', 'password' => '', 'nivel' => '', 'esta_logueado' => false);
        if ($this->modelo->conectar($login, $password)->num_rows() == 1) {

            $data = $this->modelo->conectar($login, $password)->result();
            foreach ($data as $fila) {
                $login = $fila->rut;
                $nombre = $fila->nombre;
                $apellido = $fila->apellido;
                $password = $fila->pass;
                $nivel = $fila->nivel;
                $estado = $fila->estado_us;
            }
            if ($estado == 'ACTIVO') {
                $valor = 1;
                $cookie = array('login' => $login, 'nombre' => $nombre, 'apellido' => $apellido, 'password' => $password, 'nivel' => $nivel, 'esta_logueado' => true);
            }
        }
        $this->session->set_userdata($cookie);
        echo json_encode(array("valor" => $valor,
            "login" => $login,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "password" => $password,
            "nivel" => $nivel
        ));
    }

    function cerrar_sesion() {
        $this->session->sess_destroy();
    }

    //todo reserva
    function guardar_reserva() {
        $abonado = $this->input->post('abonado');
        $orden = $this->input->post('orden');
        $nombre = $this->input->post('nombre');
        $direccion = $this->input->post('direccion');
        $fecha = $this->input->post('fecha');
        $h_inicio = $this->input->post('h_inicio');
        $h_fin = $this->input->post('h_fin');
        $obs = $this->input->post('obs');
        $material = $this->input->post('material');
        $cb_s = $this->input->post('cb_s');
        $cb_tec = $this->input->post('cb_tec');
        $estado_r = $this->input->post('estado_r');

        $valor = 1;
        if ($this->modelo->guardar_reserva($abonado, $orden, $nombre, $direccion, $fecha, $h_inicio, $h_fin, $obs, $material, $cb_s, $cb_tec, $estado_r) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }

    function grilla_reserva() {
        date_default_timezone_set("America/Santiago");
        $fecha = date('Y-m-d');
//        echo 'año: '.$año = substr($fecha, 0, 4);
//        echo 'mes: '.$mes = substr($fecha, 5, 2);
//        echo 'dia: '.$dia = substr($fecha, 8, 2);
//        echo 'nuevo dia: '.$dia;
        $data = $this->modelo->grilla_reserva($fecha);
        $datos['cantidad'] = $data->num_rows();
        $datos['datos'] = $data->result();
        $this->load->view('ADMINISTRADOR/GRILLAS/grilla_reservas', $datos);
    }

    function bt_filtrar() {
        $fecha = $this->input->post('fecha');
        $data = $this->modelo->grilla_reserva($fecha);
        $datos['cantidad'] = $data->num_rows();
        $datos['datos'] = $data->result();
        $this->load->view('ADMINISTRADOR/GRILLAS/grilla_reservas', $datos);
    }

    function actualizar_reserva() {
        $id = $this->input->post('id');
        $abonado = $this->input->post('abonado');
        $orden = $this->input->post('orden');
        $nombre = $this->input->post('nombre');
        $direccion = $this->input->post('direccion');
        $fecha = $this->input->post('fecha');
        $h_inicio = $this->input->post('h_inicio');
        $h_fin = $this->input->post('h_fin');
        $obs = $this->input->post('obs');
        $material = $this->input->post('material');
        $cb_s = $this->input->post('cb_s');
        $cb_tec = $this->input->post('cb_tec');
        $estado_r = $this->input->post('estado_r');

        $valor = 1;
        if ($this->modelo->actualizar_reserva($id, $abonado, $orden, $nombre, $direccion, $fecha, $h_inicio, $h_fin, $obs, $material, $cb_s, $cb_tec, $estado_r) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }

    function eliminar_reserva() {
        $id = $this->input->post('id');
        $this->modelo->eliminar_reserva($id);
    }

    //CALL CENTER
    function grilla_reserva_e() {
        date_default_timezone_set("America/Santiago");
        $fecha = date('Y-m-d');
        $data = $this->modelo->grilla_reserva_e($fecha);
        $datos['cantidad'] = $data->num_rows();
        $datos['datos'] = $data->result();
        $this->load->view('CALL_CENTER/GRILLAS/grilla_reservas', $datos);
    }

    function bt_filtrar_e() {
        $fecha = $this->input->post('fecha');
        $data = $this->modelo->grilla_reserva_e($fecha);
        $datos['cantidad'] = $data->num_rows();
        $datos['datos'] = $data->result();
        $this->load->view('CALL_CENTER/GRILLAS/grilla_reservas', $datos);
    }

    function bt_encuesta() {
        $id = $this->input->post('id');
        $e = $this->input->post('e');        
        $valor = 1;
        if ($this->modelo->bt_encuesta($id, $e) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }

    //todo tecnico
    function guardar_tec() {
        $nombre = $this->input->post('nombre');
        $empresa = $this->input->post('empresa');
        $estado = $this->input->post('estado');
        $valor = 1;
        if ($this->modelo->guardar_tec($nombre, $empresa, $estado) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }

    function actualizar_tec() {
        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $empresa = $this->input->post('empresa');
        $estado = $this->input->post('estado');
        $valor = 1;
        if ($this->modelo->actualizar_tec($id, $nombre, $empresa, $estado) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }

    function borrar_tec() {
        $id = $this->input->post('id');
        $this->modelo->borrar_tec($id);
    }

    function grilla_tec() {
        $data = $this->modelo->grilla_tec();
        $datos['cantidad'] = $data->num_rows();
        $datos['datos'] = $data->result();
        $this->load->view('ADMINISTRADOR/GRILLAS/grilla_tec', $datos);
    }

    function combo_tec() {
        $datos['datos'] = $this->modelo->grilla_tec_a()->result();
        $this->load->view('ADMINISTRADOR/CB/tecnico', $datos);
    }

    //todo servicio
    function guardar_s() {
        $nombre = $this->input->post('nombre');
        $tiempo = $this->input->post('tiempo');
        $estado = $this->input->post('estado');
        $valor = 1;
        if ($this->modelo->guardar_s($nombre,$tiempo,$estado) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }

    function actualizar_s() {
        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $tiempo = $this->input->post('tiempo');
        $estado = $this->input->post('estado');
        $valor = 1;
        if ($this->modelo->actualizar_s($id, $nombre,$tiempo, $estado) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }

    function borrar_s() {
        $id = $this->input->post('id');
        $valor = 1;
        if ($this->modelo->borrar_s($id) == 0) {
            $valor = 0;
        }
//        echo json_encode(array('valor' => $valor));
    }

    function grilla_s() {
        $data = $this->modelo->grilla_s();
        $datos['cantidad'] = $data->num_rows();
        $datos['datos'] = $data->result();
        $this->load->view('ADMINISTRADOR/GRILLAS/grilla_s', $datos);
    }

    function combo_s() {
        $datos['datos'] = $this->modelo->grilla_s_a()->result();
        $this->load->view('ADMINISTRADOR/CB/servicio', $datos);
    }

    //todo usuario
    function guardar_u() {
        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $clave = $this->input->post('clave');
        $tipo = $this->input->post('tipo');
        $estado = $this->input->post('estado');
        $valor = 1;
        if ($this->modelo->guardar_u($rut, $nombre, $apellido, $clave, $tipo, $estado) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }

    function actualizar_u() {
        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $clave = $this->input->post('clave');
        $tipo = $this->input->post('tipo');
        $estado = $this->input->post('estado');
        $valor = 1;
        if ($this->modelo->actualizar_u($rut, $nombre, $apellido, $clave, $tipo, $estado) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }

    function borrar_u() {
        $rut = $this->input->post('rut');
        $valor = 1;
        if ($this->modelo->borrar_u($rut) == 0) {
            $valor = 0;
        }
//        echo json_encode(array('valor' => $valor));
    }

    function grilla_u() {
        $data = $this->modelo->grilla_u();
        $datos['cantidad'] = $data->num_rows();
        $datos['datos'] = $data->result();
        $this->load->view('ADMINISTRADOR/GRILLAS/grilla_u', $datos);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */