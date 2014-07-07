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
    bloquear_id();
    grillas_admin();
</script>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Reserva</a></li>            
        <li><a href="#tabs-2">Tecnico</a></li>
        <li><a href="#tabs-3">Servicio</a></li>
        <li><a href="#tabs-4">Usuarios</a></li>
    </ul>
    <div id="tabs-1">
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
                <td>Motivo:</td>
                <td><select id="grilla_servicio">                                     
                    </select>
                </td>   
                <td>Hora Inicio:</td>
                <td><input type="text" size="16" /></td>
                <td>Hora Fin:</td>
                <td><input type="text"  size="16" /></td>
                <td>Observacion:</td>
                <td><textarea type="text" id="obs" size="16" /></textarea></td>
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
                <td><input id="clave"></td>
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
</div>

