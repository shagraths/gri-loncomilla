<? if ($cantidad == 0): ?>
    <label>No registra reservas!!</label>
<? else: ?>
    <table>
        <thead>
        <th>ID</th>    
        <th>N° Abonado</th>
        <th>N° Orden</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Motivo</th>
        <th>Fecha</th>        
        <th>Hora Inicio</th>
        <th>Hora Fin</th>
        <th>Observación</th>
        <th>Material Seriado</th>
        <th>Tecnico</th>                
        <th>Hacer encuesta</th>
    </thead>
    <tbody>
        <? $i = 0; ?>
        <?php foreach ($datos as $filas): ?>
        <? $i++; ?>
            <? if ($i % 2 == 0): ?>        
                <tr align="center">
                    <td><?= $filas->numero; ?></td>
                    <td><?= $filas->n_abonado; ?></td>
                    <td><?= $filas->n_orden; ?></td>
                    <td><?= $filas->nombre; ?></td>
                    <td><?= $filas->direccion; ?></td>
                    <td><?= $filas->nombre_s; ?></td>
                    <td><?= $filas->fecha; ?></td>
                    <td><?= $filas->hora_inicio; ?></td>
                    <td><?= $filas->hora_fin; ?></td>
                    <td><?= $filas->observacion; ?></td>     
                    <td><?= $filas->mat_seriado; ?></td>
                    <td><?= $filas->nombre_t; ?></td>                                                           
                    <td><button onclick="cargar_reserva(<?= $filas->numero; ?>, <?= $filas->n_abonado; ?>, <?= $filas->n_orden; ?>,'<?= $filas->nombre; ?>', '<?= $filas->direccion; ?>', <?= $filas->motivo; ?>,'<?= $filas->fecha; ?>','<?= $filas->hora_inicio; ?>','<?= $filas->hora_fin; ?>','<?= $filas->observacion; ?>',<?= $filas->mat_seriado; ?>,<?= $filas->tecnico; ?>,'<?= $filas->estado; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? else: ?>
                <tr align="center" class="alt">
                     <td><?= $filas->numero; ?></td>
                    <td><?= $filas->n_abonado; ?></td>
                    <td><?= $filas->n_orden; ?></td>
                    <td><?= $filas->nombre; ?></td>
                    <td><?= $filas->direccion; ?></td>
                    <td><?= $filas->nombre_s; ?></td>
                    <td><?= $filas->fecha; ?></td>
                    <td><?= $filas->hora_inicio; ?></td>
                    <td><?= $filas->hora_fin; ?></td>
                    <td><?= $filas->observacion; ?></td>     
                    <td><?= $filas->mat_seriado; ?></td>
                    <td><?= $filas->nombre_t; ?></td>                                                          
                    <td><button onclick="cargar_reserva(<?= $filas->numero; ?>, <?= $filas->n_abonado; ?>, <?= $filas->n_orden; ?>,'<?= $filas->nombre; ?>', '<?= $filas->direccion; ?>', <?= $filas->motivo; ?>,'<?= $filas->fecha; ?>','<?= $filas->hora_inicio; ?>','<?= $filas->hora_fin; ?>','<?= $filas->observacion; ?>',<?= $filas->mat_seriado; ?>,<?= $filas->tecnico; ?>,'<?= $filas->estado; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? endif; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
<? endif; ?>