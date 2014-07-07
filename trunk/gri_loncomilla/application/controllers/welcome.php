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
    //todo tecnico
    function guardar_tec(){
        $nombre = $this->input->post('nombre');
        $empresa = $this->input->post('empresa');
        $estado = $this->input->post('estado');
        $valor = 1;
        if ($this->modelo->guardar_tec($nombre, $empresa, $estado) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }
    function grilla_tec() {
        $data = $this->modelo->grilla_tec();
        $datos['cantidad'] = $data->num_rows();
        $datos['datos'] = $data->result();
        $this->load->view('ADMINISTRADOR/GRILLAS/grilla_tec', $datos);
    }
    //todo servicio
    function guardar_s(){
        $nombre = $this->input->post('nombre');        
        $estado = $this->input->post('estado');
        $valor = 1;
        if ($this->modelo->guardar_s($nombre, $estado) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }
    function grilla_s() {
        $data = $this->modelo->grilla_s();
        $datos['cantidad'] = $data->num_rows();
        $datos['datos'] = $data->result();
        $this->load->view('ADMINISTRADOR/GRILLAS/grilla_s', $datos);
    }
    //todo usuario
    function guardar_u(){
        $rut = $this->input->post('rut'); 
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido'); 
        $clave = $this->input->post('clave'); 
        $tipo = $this->input->post('tipo');                  
        $estado = $this->input->post('estado');
        $valor = 1;
        if ($this->modelo->guardar_u($rut,$nombre, $apellido, $clave , $tipo, $estado) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }
    function grilla_u() {
        $data = $this->modelo->grilla_u();
        $datos['cantidad'] = $data->num_rows();
        $datos['datos'] = $data->result();
        $this->load->view('ADMINISTRADOR/GRILLAS/grilla_u', $datos);
    }

    function eliminar_escalafon() {
        $id = $this->input->post('id');
        $this->modelo->eliminar_escalafon($id);
    }

    function actualizar_escalafon() {
        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $obs = $this->input->post('obs');
        $estado = $this->input->post('estado');
        $valor = 1;
        if ($this->modelo->actualizar_escalafon($id, $nombre, $obs, $estado) == 0) {
            $valor = 0;
        }
        echo json_encode(array('valor' => $valor));
    }
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */