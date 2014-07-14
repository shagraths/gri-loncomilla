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
        <th>Editar</th>
    </thead>
    <tbody>
        <? $i = 0; ?>
        <?php foreach ($datos as $filas): ?> 
        <? $i++; ?>
            <? if ($i % 2 == 0): ?>
                <tr align="center">
                    <td><?= $filas->id_t; ?></td>
                    <td><?= $filas->nombre_t; ?></td>
                    <td><?= $filas->empresa_t; ?></td>
                    <td><?= $filas->estado_t; ?></td>
                    <td><button onclick="borrar_tec(<?= $filas->id_t; ?>)"><span class="ui-icon ui-icon-trash"></span></button></td>
                    <td><button onclick="cargar_tec(<?= $filas->id_t; ?>, '<?= $filas->nombre_t; ?>', '<?= $filas->empresa_t; ?>', '<?= $filas->estado_t; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? else: ?>
                <tr align="center" class="alt">
                    <td><?= $filas->id_t; ?></td>
                    <td><?= $filas->nombre_t; ?></td>
                    <td><?= $filas->empresa_t; ?></td>
                    <td><?= $filas->estado_t; ?></td>
                    <td><button onclick="borrar_tec(<?= $filas->id_t; ?>)"><span class="ui-icon ui-icon-trash"></span></button></td>
                    <td><button onclick="cargar_tec(<?= $filas->id_t; ?>, '<?= $filas->nombre_t; ?>', '<?= $filas->empresa_t; ?>', '<?= $filas->estado_t; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? endif; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
<? endif; ?>
