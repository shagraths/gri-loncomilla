<? if ($cantidad == 0): ?>
    <label>No registra usuarios!!</label>
<? else: ?>
    <table>
        <thead>
        <th>RUT</th>
        <th>Nombre</th>
        <th>Apellido</th>        
        <th>Tipo</th>
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
                    <td><?= $filas->rut; ?></td>
                    <td><?= $filas->nombre; ?></td>
                    <td><?= $filas->apellido; ?></td>                    
                    <td><?= $filas->nivel; ?></td>
                    <td><?= $filas->estado_us; ?></td>
                    <td><button onclick="borrar_u(<?= $filas->rut; ?>)"><span class="ui-icon ui-icon-trash"></span></button></td>
                    <td><button onclick="cargar_u(<?= $filas->rut; ?>, '<?= $filas->nombre; ?>', '<?= $filas->apellido; ?>','<?= $filas->nivel; ?>','<?= $filas->estado_us; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? else: ?>
                <tr align="center" class="alt">
                    <td><?= $filas->rut; ?></td>
                    <td><?= $filas->nombre; ?></td>
                    <td><?= $filas->apellido; ?></td>                    
                    <td><?= $filas->nivel; ?></td>
                    <td><?= $filas->estado_us; ?></td>
                    <td><button onclick="borrar_u(<?= $filas->rut; ?>)"><span class="ui-icon ui-icon-trash"></span></button></td>
                    <td><button onclick="cargar_u(<?= $filas->rut; ?>, '<?= $filas->nombre; ?>', '<?= $filas->apellido; ?>', '<?= $filas->nivel; ?>','<?= $filas->estado_us; ?>')"><span class="ui-icon ui-icon-circle-arrow-n"></span></button></td>
                </tr>
            <? endif; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
<? endif; ?>
