<? if ($cantidad == 0): ?>
    <label>no registra Dias Festivos!!</label>
<? else: ?>
    <table>
        <thead>
        <th>ID</th>
        <th>Nombre</th>
        <th>Empresa</th>
        <th>Estado</th>
        <th>Borrar</th>
        <th>Cargar</th>
    </thead>
    <tbody>
        <? $i = 0; ?>
        <?php foreach ($datos as $filas): ?> 
        <? $i++; ?>
            <? if ($i % 2 == 0): ?>
                <tr align="center">
                    <td><?= $filas->id; ?></td>
                    <td><?= $filas->nombre; ?></td>
                    <td><?= $filas->empresa; ?></td>
                    <td><?= $filas->estado; ?></td>
                    <td><button onclick="eliminar_tec(<?= $filas->id; ?>)"><span class="ui-icon ui-icon-trash"></span></button></td>
                    <td><button onclick="cargar_tec(<?= $filas->id; ?>, '<?= $filas->nombre; ?>', '<?= $filas->empresa; ?>', '<?= $filas->estado; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? else: ?>
                <tr align="center" class="alt">
                    <td><?= $filas->id; ?></td>
                    <td><?= $filas->nombre; ?></td>
                    <td><?= $filas->empresa; ?></td>
                    <td><?= $filas->estado; ?></td>
                    <td><button onclick="eliminar_tec(<?= $filas->id; ?>)"><span class="ui-icon ui-icon-trash"></span></button></td>
                    <td><button onclick="cargar_tec(<?= $filas->id; ?>, '<?= $filas->nombre; ?>', '<?= $filas->empresa; ?>', '<?= $filas->estado; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? endif; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
<? endif; ?>
