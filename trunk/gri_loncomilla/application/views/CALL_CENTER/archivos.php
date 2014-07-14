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
    $("#bt_encuesta").button().click(function(){
        bt_encuesta();
    });
    grilla_reserva_e();
    $("#bt_filtrar").button().click(function(){
        bt_filtrar_e();
    });
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
        <li><a href="#tabs-1" >Encuesta</a></li> 
           
    </ul>
    <div id="tabs-1">
        <table>
            <tr>
                <td>ID</td>
                <td><input id="id_r"></td>
            </tr>                
            <tr>                
                <td>Realizar Encuesta</td>
                <td><textarea id="encuesta"></textarea></td>
                <td><button id="bt_encuesta" disabled>Listo</button></td>
            </tr>
            <tr>
                <td>Filtrar por Fecha</td>
                <td><input id="fecha_f" type="text" class="input input2 fecha" placeholder="yyyy/mm/dd" size="16" ></td>
                <td><button id="bt_filtrar">Buscar</button></td>
            </tr>
        </table>
        <div id="grilla_reserva" class="datagrid">

        </div>
    </div>
</div>
