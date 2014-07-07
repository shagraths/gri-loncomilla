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
                                    base_url + "welcome/vendedor", {}, function(ruta) {
                                $("#contenido").html(ruta);
                            }
                            );
                        } else {//vendedor
                            $.post(
                                    base_url + "welcome/jefe_tecnico", {}, function(ruta) {
                                $("#contenido").html(ruta);
                            }
                            );
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
    $.post(
            base_url + "welcome/cerrar_sesion",
            {},
            function() {
                verificarLogin();
            }
    );
}
function conectar() {
    var login = $("#user").val();
    var password = $("#pass").val();
    if (login == '' || password == '') {
        alert("debe llenar campos!!");
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
                                base_url + "welcome/vendedor", {}, function(ruta) {
                            $("#contenido").html(ruta);
                        }
                        );
                    } else {//jefe tecnico
                        $.post(
                                base_url + "welcome/jefe_tecnico", {}, function(ruta) {
                            $("#contenido").html(ruta);
                        }
                        );
                    }
                }
            } else {
                alert("Usuario no existe en la base de datos");
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

}
function grillas_admin(){
    grilla_s();
    grilla_tec();
    grilla_u();
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
                {nombre: nombre, empresa: empresa , estado: estado},
        function(datos) {
            if (datos.valor == 1) {
                alert("error al registrar");
            } else {
                alert("datos almacinados correctamente");
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
    var nombre = $("#nombre_tec").val();
    var empresa = $("#empresa_tec").val();
    var estado = $("#estado_tec").val();
    if (nombre == '' || empresa == '' || estado == 'SELECCIONE') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/guardar_tec",
                {nombre: nombre, empresa: empresa , estado: estado},
        function(datos) {
            if (datos.valor == 1) {
                alert("error al registrar");
            } else {
                alert("datos almacinados correctamente");
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
function eliminar_tec(id) {
    $.post(
            base_url + "welcome/eliminar_tec", {id: id}
    );
    grilla_tec();
}
//todo servicio
function guardar_s() {
    var nombre = $("#nombre_s").val();
    var estado = $("#estado_s").val();
    if (nombre == '' || estado == 'SELECCIONE') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/guardar_s",
                {nombre: nombre, estado: estado},
        function(datos) {
            if (datos.valor == 1) {
                alert("error al registrar");
            } else {
                alert("datos almacinados correctamente");

                $("#nombre_s").val("");                
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
//todo usuario
function guardar_u() {
    var rut = $("#rut").val();
    var nombre = $("#nombre_u").val();
    var apellido = $("#apellido").val();
    var clave = $("#clave").val();
    var tipo = $("#tipo_u").val();
    var estado = $("#estado_u").val();
    if ( rut=='' || nombre == '' || apellido == '' || clave=='' ||  tipo == 'SELECCIONE' || estado == 'SELECCIONE') {
        alert("Faltan datos por completar");
    } else {
        $.post(
                base_url + "welcome/guardar_u",
                { rut:rut, nombre: nombre, apellido:apellido, clave:clave, tipo:tipo , estado: estado},
        function(datos) {
            if (datos.valor == 1) {
                alert("error al registrar");
            } else {
                alert("datos almacinados correctamente");
                $("#rut").val("");
                $("#nombre_u").val("");
                $("#apellido").val("");
                $("#clave").val("");
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