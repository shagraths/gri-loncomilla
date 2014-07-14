<script>
    $(function() {
        var tabs = $("#tabs").tabs();
        tabs.find(".ui-tabs-nav").sortable({
            axis: "x",
            stop: function() {
                tabs.tabs("refresh");
            }
        });
    });
    $("#guardar_reserva").button().click(function() {
        guardar_reserva();
    });
    $("#actualizar_reserva").button().click(function() {
        actualizar_reserva();
    });
    $("#guardar_tec").button().click(function() {
        guardar_tec();
    });
    $("#actualizar_tec").button().click(function() {
        actualizar_tec();
    });
    $("#guardar_s").button().click(function() {    
        guardar_s();
    });
    $("#actualizar_s").button().click(function() {
        actualizar_s();
    });
    $("#guardar_u").button().click(function() {    
        guardar_u();
    });
    $("#actualizar_u").button().click(function() {
        actualizar_u();
    });
    $("#desbloquear").button().click(function() {
        desbloquear();
    });
    $("#reporte_general").button().click(function() {
        reporte_general();
    });    
    bloquear_id();
    grillas_admin();
    cb_reservas();
    $("#bt_filtrar").button().click(function(){
        bt_filtrar();
    });
    
    $("#h_inicio").timeEntry({show24Hours: true, showSeconds: false});
    $("#h_fin").timeEntry({show24Hours: true, showSeconds: false});
        
    $('.fecha').datepicker({renderer: $.ui.datepicker.defaultRenderer,
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S&aacute;'],
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        prevText: '&#x3c;Ant', prevStatus: '',
        prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
        nextText: 'Sig&#x3e;', nextStatus: '',
        nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
        currentText: 'Hoy', currentStatus: '',
        todayText: 'Hoy', todayStatus: '',
        clearText: '-', clearStatus: '',
        closeText: 'Cerrar', closeStatus: '',
        yearStatus: '', monthStatus: '',
        weekText: 'Sm', weekStatus: '',
        dayStatus: 'DD d MM',
        defaultStatus: '',
        isRTL: false});
</script>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1" onclick="cb_reservas();">Reserva</a></li> 
        <li><a href="#tabs-5">Reportes</a></li>
        <li><a href="#tabs-2">Tecnico</a></li>
        <li><a href="#tabs-3">Servicio</a></li>
        <li><a href="#tabs-4">Usuarios</a></li>        
    </ul>
    <div id="tabs-1">
        <input id="id_r" hidden>
        <table>
            <tr>
                <td>N° Abonado:</td>
                <td><input type="text" size="16" id="abonado"/></td>
                <td>N° Orden:</td>
                <td><input type="text" size="16" id="orden"/></td>
                <td>Nombre:</td>
                <td><input type="text" size="16" id="nombre"/></td>
                <td>Dirección:</td>
                <td><textarea type="text" size="50" id="direccion"/></textarea></td>
            </tr>
            <tr>        
                <td>Fecha</td>
                <td><input id="fecha" type="text" class="input input2 fecha" placeholder="yyyy/mm/dd" size="16" ></td>
                <td>Hora Inicio:</td>
                <td><input type="text" size="16"  id="h_inicio"/></td>
                <td>N° Material</td>
                <td><input type="text"  size="16" id="material"/></td>
                <td>Observacion:</td>
                <td><textarea type="text" id="obs" size="16" /></textarea></td>
            </tr>  
            <tr>                
                <td>Motivo:</td>
                <td><select id="cb_s">                                     
                    </select>
                </td> 
                <td>Tecnico:</td>
                <td><select id="cb_tec">                                     
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>        
                <td><button id="actualizar_reserva" disabled>actualizar</button></td>
                <td></td>
                <td><button id="guardar_reserva">Guardar</button></td>
            </tr>
        </table>
        <table>
            <tr>
                <td>Filtrar por Fecha</td>
                <td><input id="fecha_f" type="text" class="input input2 fecha" placeholder="yyyy/mm/dd" size="16" ></td>
                <td><button id="bt_filtrar">Buscar</button></td>
            </tr>
        </table>
        <div id="grilla_reserva" class="datagrid">

        </div>
    </div>
    <div id="tabs-2">
        <table>
            <tr>
                <td>ID</td>
                <td><input id="id_tec"></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input id="nombre_tec"></td>
            </tr>
            <tr>
                <td>Empresa</td>
                <td><input id="empresa_tec"></td>
            </tr>
            <tr>
                <td>Estado</td>
                <td><select id="estado_tec">
                        <option value="SELECCIONE">SELECCIONE</option>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    </select></td>
            </tr>
            <tr>
                <td></td>
                <td><button id="actualizar_tec" disabled>ACTUALIZAR</button></td>
                <td><button id="guardar_tec">GUARDAR</button></td>
            </tr>                    
        </table>
        <div id="grilla_tec" class="datagrid">

        </div>
    </div>
    <div id="tabs-3">
        <table>
            <tr>
                <td>ID</td>
                <td><input id="id_s"></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input id="nombre_s"></td>
            </tr>     
            <td>Tiempo duración:</td>
                <td><input type="text"  size="16" id="h_fin"/></td>
            <tr>
                <td>Estado</td>
                <td><select id="estado_s">
                        <option value="SELECCIONE">SELECCIONE</option>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    </select></td>
            </tr>
            <tr>
                <td></td>
                <td><button id="actualizar_s" disabled>ACTUALIZAR</button></td>
                <td><button id="guardar_s">GUARDAR</button></td>
            </tr>    
                
        </table>
        <div id="grilla_s" class="datagrid">

        </div>
    </div>
    <div id="tabs-4">
        <table>           
            <tr>
                <td>R.U.T</td>
                <td><input id="rut"></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input id="nombre_u"></td>
            </tr>
            <tr>
                <td>Apellido</td>
                <td><input id="apellido"></td>
            </tr>
            <tr>
                <td>Clave</td>
                <td><input id="clave" type="password"></td>
                <td><button id="desbloquear" disabled>Desbloquear</button></td>
            </tr>
            <tr>
                <td>Repetir Clave</td>
                <td><input id="rclave" type="password"></td>
            </tr>
            <tr>
                <td>Tipo</td>
                <td>
                    <select id="tipo_u">
                        <option value="SELECCIONE">SELECCIONE</option>
                        <option value="VENDEDOR">VENDEDOR</option>
                        <option value="CALL_CENTER">CALL CENTER</option>                        
                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Estado</td>
                <td>
                    <select id="estado_u">
                        <option value="SELECCIONE">SELECCIONE</option>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button id="actualizar_u" disabled>ACTUALIZAR</button></td>
                <td><button id="guardar_u">GUARDAR</button></td>
            </tr>
        </table>
        <div id="grilla_u" class="datagrid">

        </div>
    </div>  
    <div id="tabs-5">
        <table>
            <tr>
                <td>Tipo</td>
                <td>
                    <select id="tipo_reporte">
                        <option value="SELECCIONE">SELECCIONE</option>
                        <option value="usuario">Usuarios</option>
                        <option value="servicio">Servicio</option>
                        <option value="tecnico">Tecnico</option>
                    </select>
                </td>
                <td><button id="reporte_general">Crear</button></td>
            </tr>
        </table>
    </div>
</div>

