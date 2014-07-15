<? if ($cantidad == 0): ?>
    <label>No registra servicios!!</label>
<? else: ?>
    <table>
        <thead>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tiempo</th>
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
                    <td><?= $filas->id_s; ?></td>
                    <td><?= $filas->nombre_s; ?></td> 
                    <td><?= $filas->Tiempo; ?></td>
                    <td><?= $filas->estado_s; ?></td>
                    <td><button onclick="borrar_s(<?= $filas->id_s; ?>)"><span class="ui-icon ui-icon-trash"></span></button></td>
                    <td><button onclick="cargar_s(<?= $filas->id_s; ?>, '<?= $filas->nombre_s; ?>','<?= $filas->Tiempo; ?>', '<?= $filas->estado_s; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? else: ?>
                <tr align="center" class="alt">
                    <td><?= $filas->id_s; ?></td>
                    <td><?= $filas->nombre_s; ?></td> 
                    <td><?= $filas->Tiempo; ?></td>
                    <td><?= $filas->estado_s; ?></td>
                    <td><button onclick="borrar_s(<?= $filas->id_s; ?>)"><span class="ui-icon ui-icon-trash"></span></button></td>
                    <td><button onclick="cargar_s(<?= $filas->id_s; ?>, '<?= $filas->nombre_s; ?>','<?= $filas->Tiempo; ?>', '<?= $filas->estado_s; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? endif; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
<? endif; ?>