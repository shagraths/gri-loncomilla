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
                    <td><?= $filas->hora_inicio; ?></td>
                    <td><?= $filas->hora_fin; ?></td>
                    <td><?= $filas->observacion; ?></td>                                                                                  
                </tr>
            <? else: ?>
                <tr align="center" class="alt">
                     <td><?= $filas->numero; ?></td>
                    <td><?= $filas->n_abonado; ?></td>
                    <td><?= $filas->n_orden; ?></td>
                    <td><?= $filas->nombre; ?></td>
                    <td><?= $filas->direccion; ?></td>
                    <td><?= $filas->nombre_s; ?></td>
                    <td><?= $filas->hora_inicio; ?></td>
                    <td><?= $filas->hora_fin; ?></td>
                    <td><?= $filas->observacion; ?></td>                                                                                  
                </tr>
            <? endif; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
<? endif; ?>