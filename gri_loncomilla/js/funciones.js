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
                    $("#login").hide('fast');//esconder
                    if (datos.nivel == 1) {//administrador
                        $.post(
                                base_url + "welcome/tabla_reserva", {}, function(ruta) {
                            $("#contenido").html(ruta);
                        }
                        );                        
                    } else {//trabajador
                        $.post(
                                base_url + "welcome/otros", {}, function(ruta) {
                            $("#contenido").html(ruta);
                        }
                        );                        
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
                if (datos.nivel == 1) {
                    $("#login").hide('fast');
                    $.post(
                            base_url + "welcome/tabla_reserva", {}, function(ruta) {
                        $("#contenido").html(ruta);
                    }
                    );                    
                } else {
                    $("#login").hide('fast');
                    $.post(
                            base_url + "welcome/reportes", {}, function(ruta) {
                        $("#contenido").html(ruta);
                    }
                    );
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