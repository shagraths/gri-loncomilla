$(document).ready(function() {
    $("#cerrar").button().click(function() {
        cerrar_sesion();
    });
    verificarLogin();

});
function verificarLogin() {
    $.post(
            base_url + "welcome/verificarLogin",
            {},
            function(datos) {
                if (datos.valor == 1) {
                    $("#cerrar_session").show();
                    $("#login").hide('fast');
                    if (datos.nivel == "ADMINISTRADOR") {//administrador
                        $.post(
                                base_url + "welcome/tabla_reserva", {}, function(ruta) {
                            $("#contenido").html(ruta);
                        }
                        );
                    } else {//call center
                        if (datos.nivel == "CALL_CENTER") {
                            $.post(
                                    base_url + "welcome/call_center", {}, function(ruta) {
                                $("#contenido").html(ruta);
                            }
                            );
                        } else {//gerente
                            if (datos.nivel == "GERENTE") {
                                $.post(
                                        base_url + "welcome/gerente", {}, function(ruta) {
                                    $("#contenido").html(ruta);
                                }
                                );
                            } else {
                                $.post(
                                        base_url + "welcome/vendedor", {}, function(ruta) {
                                    $("#contenido").html(ruta);
                                }
                                );
                            }
                        }
                    }
                } else {//sin login
                    $("#cerrar_session").hide();
                    $.post(
                            base_url + "welcome/cargar_login", {}, function(ruta) {
                        $("#contenido").html(ruta);
                        $("#login").show();
                    }
                    );
                }
            },
            'json'
            );
}
function cerrar_sesion() {
    var answer = confirm("¿Realmente quieres cerrar sesión?")
    if (answer) {
        $.post(
                base_url + "welcome/cerrar_sesion",
                {},
                function() {
                    verificarLogin();
                }
        );
    }
    else {

    }

}
function conectar() {
    var login = $("#user").val();
    var password = $("#pass").val();
    if (login == '' || password == '') {
        alert("Debe llenar todos los campos");
    } else {
        $.post(
                base_url + "welcome/conectar",
                {login: login, password: password},
        function(datos) {
            if (datos.valor == 1) {
                $("#cerrar_session").show('slow');
                if (datos.nivel == "ADMINISTRADOR") {//administrador
                    $.post(
                            base_url + "welcome/tabla_reserva", {}, function(ruta) {
                        $("#contenido").html(ruta);
                    }
                    );
                } else {//vendedor
                    if (datos.nivel == "CALL_CENTER") {
                        $.post(
                                base_url + "welcome/call_center", {}, function(ruta) {
                            $("#contenido").html(ruta);
                        }
                        );
                    } else {//gerente
                        if (datos.nivel == "GERENTE") {

                            $.post(
                                    base_url + "welcome/gerente", {}, function(ruta) {
                                $("#contenido").html(ruta);
                            }
                            );
                        } else {
                            $.post(
                                    base_url + "welcome/vendedor", {}, function(ruta) {
                                $("#contenido").html(ruta);
                            }
                            );
                        }
                    }
                }
            } else {
                alert("Usuario y clave no son validos");
                $("#cerrar_session").hide();
            }
        },
                'json'
                );
    }
}
function bloquear_id() {
    $("#id_tec").attr("readonly", true);
    $("#id_tec").css("background", "lightseagreen");
    $("#id_s").attr("readonly", true);
    $("#id_s").css("background", "lightseagreen");
}

function guardar_reserva() {
    var abonado = $("#abonado").val();
    var orden = $("#orden").val();
    var nombre = $("#nombre").val();
    var direccion = $("#direccion").val();
    var fecha = $("#fecha").val();
    var h_inicio = $("#h_inicio").val();
    var obs = $("#obs").val();
    var material = $("#material").val();
    var cb_s = $("#cb_s").val();
    var cb_tec = $("#cb_tec").val();
    var estado_r = "ACTIVO";
    if (abonado == '' || orden == '' || nombre == '' || direccion == ''
            || fecha == '' || h_inicio == '' || cb_s == '') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/guardar_reserva",
                {abonado: abonado, orden: orden, nombre: nombre, direccion: direccion, fecha: fecha, h_inicio: h_inicio, obs: obs, material: material, cb_s: cb_s, cb_tec: cb_tec, estado_r: estado_r},
        function(datos) {
            if (datos.valor == 1) {
                alert("Numero de orden ya ingresado");
            } else {
                alert("Datos almacinados correctamente");
                $("#abonado").val("");
                $("#orden").val("");
                $("#nombre").val("");
                $("#direccion").val("");
                $("#fecha").val("");
                $("#h_inicio").val("");
                $("#h_fin").val("");
                $("#obs").val("");
                $("#material").val("");
                $("#cb_s").val("");
                $("#cb_tec").val("");
                grilla_reserva();
                $("#actualizar_reserva").button("disable");
                $("#guardar_reserva").button("enable");
            }
        }, 'json'
                );
    }
}
function grilla_reserva() {
    $.post(
            base_url + "welcome/grilla_reserva",
            {},
            function(ruta, datos) {
                $("#grilla_reserva").hide();
                $("#grilla_reserva").html(ruta, datos);
                $("#grilla_reserva").show('slow');
            }
    );
}
function cargar_reserva(numero, n_abonado, n_orden, nombre, direccion, motivo, fecha, hora_inicio, hora_fin, observacion, mat_seriado, tecnico, estado) {
    $("#id_r").val(numero);
    $("#abonado").val(n_abonado);
    $("#orden").val(n_orden);
    $("#nombre").val(nombre);
    $("#direccion").val(direccion);
    $("#cb_s").val(motivo);
    $("#fecha").val(fecha);
    $("#h_inicio").val(hora_inicio);
    $("#h_fin").val(hora_fin);
    $("#obs").val(observacion);
    $("#material").val(mat_seriado);
    $("#actualizar_reserva").button("enable");
    $("#guardar_reserva").button("disable");
    $("#id_r").attr("readonly", true);
    $("#id_r").css("background", "lightseagreen");
    $("#bt_encuesta").button("enable");
}
function cb_reservas() {
    combo_t();
    combo_s();
}
function grillas_admin() {
    grilla_s();
    grilla_tec();
    grilla_u();
    grilla_reserva();
}
function actualizar_reserva() {
    var id = $("#id_r").val();
    var abonado = $("#abonado").val();
    var orden = $("#orden").val();
    var nombre = $("#nombre").val();
    var direccion = $("#direccion").val();
    var fecha = $("#fecha").val();
    var h_inicio = $("#h_inicio").val();
    var obs = $("#obs").val();
    var material = $("#material").val();
    var cb_s = $("#cb_s").val();
    var cb_tec = $("#cb_tec").val();
    var estado_r = "ACTIVO";
    if (abonado == '' || orden == '' || nombre == '' || direccion == '' || fecha == '' || h_inicio == ''
            || cb_s == '') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/actualizar_reserva",
                {id: id, abonado: abonado, orden: orden, nombre: nombre, direccion: direccion, fecha: fecha, h_inicio: h_inicio, obs: obs, material: material, cb_s: cb_s, cb_tec: cb_tec, estado_r: estado_r},
        function(datos) {
            if (datos.valor == 1) {
                alert("Numero de orden ya registrado");
            } else {
                alert("Datos almacinados correctamente");
                $("#id_r").val("");
                $("#abonado").val("");
                $("#orden").val("");
                $("#nombre").val("");
                $("#direccion").val("");
                $("#fecha").val("");
                $("#h_inicio").val("");
                $("#h_fin").val("");
                $("#obs").val("");
                $("#material").val("");
                $("#cb_s").val("1");
                $("#cb_tec").val("1");
                $("#estado_r").val("SELECCIONE");
                grilla_reserva();
                $("#actualizar_reserva").button("disable");
                $("#guardar_reserva").button("enable");
            }
        }, 'json'
                );
    }
}
function eliminar_reserva(id) {
    var answer = confirm("¿Realmente quieres borrar la reserva N°: ?" + id);
    if (answer) {
        $.post(
                base_url + "welcome/eliminar_reserva",
                {id: id}
        );
        grilla_reserva();
    }
    else {
        alert(" No se ha hecho ningun cambio");
    }


}
function  bt_filtrar() {
    var fecha = $("#fecha_f").val();
    $.post(
            base_url + "welcome/bt_filtrar",
            {fecha: fecha},
    function(ruta, datos) {
        $("#grilla_reserva").hide();
        $("#grilla_reserva").html(ruta, datos);
        $("#grilla_reserva").show('slow');
    }
    );

}

//CALL CENTER 
function grilla_reserva_e() {
    $.post(
            base_url + "welcome/grilla_reserva_e",
            {},
            function(ruta, datos) {
                $("#grilla_reserva_e").hide();
                $("#grilla_reserva_e").html(ruta, datos);
                $("#grilla_reserva_e").show('slow');
            }
    );
}
function  bt_filtrar_e() {
    var fecha = $("#fecha_e").val();
    $.post(
            base_url + "welcome/bt_filtrar_e",
            {fecha: fecha},
    function(ruta, datos) {
        $("#grilla_reserva_e").hide();
        $("#grilla_reserva_e").html(ruta, datos);
        $("#grilla_reserva_e").show('slow');
    }
    );

}
//vista vendedor
function grilla_reserva_v() {
    $.post(
            base_url + "welcome/grilla_reserva_v",
            {},
            function(ruta, datos) {
                $("#grilla_reserva_v").hide();
                $("#grilla_reserva_v").html(ruta, datos);
                $("#grilla_reserva_v").show('slow');
            }
    );
}
function  bt_filtrar_v() {
    var fecha = $("#fecha_v").val();
    $.post(
            base_url + "welcome/bt_filtrar_v",
            {fecha: fecha},
    function(ruta, datos) {
        $("#grilla_reserva_v").hide();
        $("#grilla_reserva_v").html(ruta, datos);
        $("#grilla_reserva_v").show('slow');
    }
    );

}
function bt_encuesta() {
    var id = $("#id_r").val();
    var e = $("#encuesta").val();
    if (e == '') {
        alert("Debe completar la encuesta");
    } else {
        $.post(
                base_url + "welcome/bt_encuesta",
                {id: id, e: e},
        function(datos) {
            if (datos.valor == 1) {
                alert("Error al registrar");
            } else {
                alert("Encuesta realizada correctamente");
                $("#id_r").val("");
                $("#encuesta").val("");
                grilla_reserva_e();
                $("#bt_encuesta").button("disable");
            }
        }, 'json'
                );
    }
}
//todo tecnico
function guardar_tec() {
    var nombre = $("#nombre_tec").val();
    var empresa = $("#empresa_tec").val();
    var estado = $("#estado_tec").val();
    if (nombre == '' || empresa == '' || estado == 'SELECCIONE') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/guardar_tec",
                {nombre: nombre, empresa: empresa, estado: estado},
        function(datos) {
            if (datos.valor == 1) {
                alert("Error tecnico ya ingresado");
            } else {
                alert("Datos almacinados correctamente");
                $("#nombre_tec").val("");
                $("#empresa_tec").val("");
                $("#estado_tec").val("SELECCIONE");
                grilla_tec();
                $("#actualizar_tec").button("disable");
                $("#guardar_tec").button("enable");
            }
        }, 'json'
                );
    }
}
function grilla_tec() {
    $.post(
            base_url + "welcome/grilla_tec",
            {},
            function(ruta, datos) {
                $("#grilla_tec").hide();
                $("#grilla_tec").html(ruta, datos);
                $("#grilla_tec").show('slow');
            }
    );
}
function actualizar_tec() {
    var id = $("#id_tec").val();
    var nombre = $("#nombre_tec").val();
    var empresa = $("#empresa_tec").val();
    var estado = $("#estado_tec").val();
    if (nombre == '' || empresa == '' || estado == 'SELECCIONE') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/actualizar_tec",
                {id: id, nombre: nombre, empresa: empresa, estado: estado},
        function(datos) {
            if (datos.valor == 1) {
                alert("Error tecnico ya ingresado");
            } else {
                alert("Datos almacinados correctamente");
                $("#id_tec").val("");
                $("#nombre_tec").val("");
                $("#empresa_tec").val("");
                $("#estado_tec").val("SELECCIONE");
                grilla_tec();
                $("#actualizar_tec").button("disable");
                $("#guardar_tec").button("enable");
            }
        }, 'json'
                );
    }
}
function cargar_tec(id, nombre, empresa, estado) {
    $("#id_tec").val(id);
    $("#nombre_tec").val(nombre);
    $("#empresa_tec").val(empresa);
    $("#estado_tec").val(estado);
    $("#actualizar_tec").button("enable");
    $("#guardar_tec").button("disable");
}
function borrar_tec(id) {
    var answer = confirm("¿Realmente quieres borrar el tecnico N°: ?" + id);
    if (answer) {
        $.post(
                base_url + "welcome/borrar_tec",
                {id: id}
        );
        grilla_tec();
    }
    else {
        alert(" No se ha hecho ningun cambio");
    }

}
function combo_t() {
    //combobox
    $.post(
            base_url + "welcome/combo_tec",
            {},
            function(ruta, datos) {
                $("#cb_tec").html(ruta, datos);
            }
    );
}
//todo servicio
function guardar_s() {
    var nombre = $("#nombre_s").val();
    var tiempo = $("#h_fin").val();
    var estado = $("#estado_s").val();
    if (nombre == '' || tiempo == '' || estado == 'SELECCIONE') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/guardar_s",
                {nombre: nombre, tiempo: tiempo, estado: estado},
        function(datos) {
            if (datos.valor == 1) {
                alert("Error el servicio ya esta ingresado");
            } else {
                alert("Datos almacinados correctamente");
                $("#nombre_s").val("");
                $("#h_fin").val("");
                $("#estado_s").val("SELECCIONE");
                grilla_s();
                $("#actualizar_s").button("disable");
                $("#guardar_s").button("enable");
            }
        }, 'json'
                );
    }
}
function actualizar_s() {
    var id = $("#id_s").val();
    var nombre = $("#nombre_s").val();
    var tiempo = $("#h_fin").val();
    var estado = $("#estado_s").val();
    if (nombre == '' || tiempo == '' || estado == 'SELECCIONE') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/actualizar_s",
                {id: id, nombre: nombre, tiempo: tiempo, estado: estado},
        function(datos) {
            if (datos.valor == 1) {
                alert("Error al modificar");
            } else {
                alert("Datos almacinados correctamente");
                $("#id_s").val("");
                $("#nombre_s").val("");
                $("#h_fin").val("");
                $("#estado_s").val("SELECCIONE");
                grilla_s();
                $("#actualizar_s").button("disable");
                $("#guardar_s").button("enable");
            }
        }, 'json'
                );
    }
}
function grilla_s() {
    $.post(
            base_url + "welcome/grilla_s",
            {},
            function(ruta, datos) {
                $("#grilla_s").hide();
                $("#grilla_s").html(ruta, datos);
                $("#grilla_s").show('slow');
            }
    );
}
function cargar_s(id, nombre, tiempo, estado) {
    $("#id_s").val(id);
    $("#nombre_s").val(nombre);
    $("#h_fin").val(tiempo);
    $("#estado_s").val(estado);
    $("#actualizar_s").button("enable");
    $("#guardar_s").button("disable");
}
function borrar_s(id) {
    var answer = confirm("¿Realmente quieres borrar el servicio N°: ?" + id);
    if (answer) {
        $.post(
                base_url + "welcome/borrar_s",
                {id: id}
        );
        grilla_s();
    }
    else {
        alert(" No se ha hecho ningun cambio");
    }

}
function combo_s() {
    //combobox
    $.post(
            base_url + "welcome/combo_s",
            {},
            function(ruta, datos) {
                $("#cb_s").html(ruta, datos);
            }
    );
}
//todo usuario
function guardar_u() {
    var rut = $("#rut").val();
    var nombre = $("#nombre_u").val();
    var apellido = $("#apellido").val();
    var clave = $("#clave").val();
    var tipo = $("#tipo_u").val();
    var estado = $("#estado_u").val();
    if (rut == '' || nombre == '' || apellido == '' || clave == '' || tipo == 'SELECCIONE' || estado == 'SELECCIONE') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/guardar_u",
                {rut: rut, nombre: nombre, apellido: apellido, clave: clave, tipo: tipo, estado: estado},
        function(datos) {
            if (datos.valor == 1) {
                alert("Error usuario ya ingresado");
            } else {
                alert("Datos almacinados correctamente");
                $("#rut").val("");
                $("#nombre_u").val("");
                $("#apellido").val("");
                $("#clave").val("");
                $("#rclave").val("");
                $("#tipo_u").val("SELECCIONE");
                $("#estado_u").val("SELECCIONE");
                grilla_u();
                $("#actualizar_u").button("disable");
                $("#guardar_u").button("enable");
            }
        }, 'json'
                );

    }
}
function actualizar_u() {
    var rut = $("#rut").val();
    var nombre = $("#nombre_u").val();
    var apellido = $("#apellido").val();
    var clave = $("#clave").val();
    var rclave = $("#rclave").val();
    var tipo = $("#tipo_u").val();
    var estado = $("#estado_u").val();
    
    if (rut == '' || nombre == '' || apellido == '' || tipo == 'SELECCIONE' || estado == 'SELECCIONE') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/actualizar_u",
                {rut: rut, nombre: nombre, apellido: apellido, clave: clave, tipo: tipo, estado: estado},
        function(datos) {
            if (datos.valor == 1) {
                alert("Error al modificar usuario");
            } else {
                alert("Datos almacinados correctamente");
                $("#rut").val("");
                $("#nombre_u").val("");
                $("#apellido").val("");
                $("#clave").val("");
                $("#rclave").val("");
                $("#tipo_u").val("SELECCIONE");
                $("#estado_u").val("SELECCIONE");
                grilla_u();
                $("#actualizar_u").button("disable");
                $("#guardar_u").button("enable");
                $("#clave").attr("readonly", false);
                $("#clave").css("background", "white");
                $("#rclave").attr("readonly", false);
                $("#rclave").css("background", "white");
                $("#rut").attr("readonly", false);
                $("#rut").css("background", "white");
            }
        }, 'json'
                );

    }
}
function grilla_u() {
    $.post(
            base_url + "welcome/grilla_u",
            {},
            function(ruta, datos) {
                $("#grilla_u").hide();
                $("#grilla_u").html(ruta, datos);
                $("#grilla_u").show('slow');
            }
    );
}
function cargar_u(rut, nombre, apellido, tipo, estado) {
    $("#rut").val(rut);
    $("#nombre_u").val(nombre);
    $("#apellido").val(apellido);
    $("#tipo_u").val(tipo);
    $("#estado_u").val(estado);
    $("#actualizar_u").button("enable");
    $("#desbloquear").button("enable");
    $("#guardar_u").button("disable");
    $("#clave").attr("readonly", true);
    $("#clave").css("background", "lightseagreen");
    $("#rclave").attr("readonly", true);
    $("#rclave").css("background", "lightseagreen");
    $("#rut").attr("readonly", true);
    $("#rut").css("background", "lightseagreen");
}
function desbloquear() {
    $("#clave").attr("readonly", false);
    $("#clave").css("background", "white");
    $("#rclave").attr("readonly", false);
    $("#rclave").css("background", "white");
    $("#desbloquear").button("disable");
}
function borrar_u(rut) {
   var answer = confirm("¿Realmente quieres borrar el usuario N° R.U.T: ?" + rut);
    if (answer) {
        $.post(
            base_url + "welcome/borrar_u",
            {rut: rut}
    );
    grilla_u();
    }
    else {
        alert(" No se ha hecho ningun cambio");
    }
    
}
function reporte_general() {
    var r = $("#tipo_reporte").val();
    if (r == "SELECCIONE") {
        alerta("Elegir algun tipo de reporte");
    } else {
        if (r == "usuario") {
            window.open(base_url + "reporte/usuario");
        } else {
            if (r == "servicio") {
                window.open(base_url + "reporte/servicio");
            } else {
                window.open(base_url + "reporte/tecnico");
            }
        }
    }
}
function reporte_horario() {
    var f = $("#fecha_horario").val();
    if (f == "") {
        alerta("Colocar alguna fecha para crear planilla");
    } else {
        window.open(base_url + "reporte/horario?f=" + f);

    }
}