<? if ($cantidad == 0): ?>
    <label>no registra reservar!!</label>
<? else: ?>
    <table>
        <thead>
        <th>ID</th>    
        <th>N° Abonado</th>
        <th>N° Orden</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Motivo</th>
        <th>Hora Inicio</th>
        <th>Hora Fin</th>
        <th>Observación</th>
        <th>Borrar</th>
        <th>Cargar</th>
    </thead>
    <tbody>
        <? $i = 0; ?>
        <?php foreach ($reservas as $filas): ?>
        <? $i++; ?>
            <? if ($i % 2 == 0): ?>        
                <tr align="center">
                    <td><?= $filas->id_reserva; ?></td>
                    <td><?= $filas->n_abonado; ?></td>
                    <td><?= $filas->n_orden; ?></td>
                    <td><?= $filas->nombre_reserva; ?></td>
                    <td><?= $filas->direccion; ?></td>
                    <td><?= $filas->motivo; ?></td>
                    <td><?= $filas->h_inicio; ?></td>
                    <td><?= $filas->h_fin; ?></td>
                    <td><?= $filas->obs_reserva; ?></td>                    
                    <td><button onclick="eliminar_cargo(<?= $filas->ID_c; ?>)"><span class="ui-icon ui-icon-trash"></span></button></td>
                    <td><button onclick="cargar_cargo(<?= $filas->ID_c; ?>, '<?= $filas->Nombre_c; ?>', '<?= $filas->Observacion_c; ?>', '<?= $filas->Estado_c; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? else: ?>
                <tr align="center" class="alt">
                    <td><?= $filas->id_reserva; ?></td>
                    <td><?= $filas->n_abonado; ?></td>
                    <td><?= $filas->n_orden; ?></td>
                    <td><?= $filas->nombre_reserva; ?></td>
                    <td><?= $filas->direccion; ?></td>
                    <td><?= $filas->motivo; ?></td>
                    <td><?= $filas->h_inicio; ?></td>
                    <td><?= $filas->h_fin; ?></td>
                    <td><?= $filas->obs_reserva; ?></td>                    
                    <td><button onclick="eliminar_cargo(<?= $filas->ID_c; ?>)"><span class="ui-icon ui-icon-trash"></span></button></td>
                    <td><button onclick="cargar_cargo(<?= $filas->ID_c; ?>, '<?= $filas->Nombre_c; ?>', '<?= $filas->Observacion_c; ?>', '<?= $filas->Estado_c; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? endif; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
<? endif; ?>