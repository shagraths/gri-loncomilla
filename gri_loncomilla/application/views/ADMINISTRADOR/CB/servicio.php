<option value="">SELECCIONE</option>
<?php foreach ($datos as $fila):?>
<option value="<?=$fila->id_s?>"><?=$fila->nombre_s?></option>
<?php endforeach; ?>
