<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <script type="text/javascript" src="<?= base_url() ?>../js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>../js/jquery-ui-1.10.4.js"></script>
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>../css/jquery-ui-1.10.4.css">
        <link type="text/css" rel="stylesheet"href="<?= base_url(); ?>../css/estilo.css"/>
        <script type="text/javascript" src="<?= base_url() ?>../js/funciones.js"></script>
        <script type="text/javascript">var base_url = "<?= base_url(); ?>";</script>
    <div id="logo1"></div>
    <div id="titulo"></div>
</head>

<body>
    <div id="login">
        <input class="ui-corner-all" placeholder="Usuario" size="30" id="user" maxlength="8" required/><br>
        <input class="ui-corner-all" placeholder="Contraseña" type="password" size="30" id="pass" required/><br>
        <button id="conectar">Conectar</button>
    </div>
    <div id="reservas">
        <table border="1">
            <thead>
                <tr>
                    <th>N° Abonado</th>
                    <th>N° Orden</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Motivo</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="" value="" size="10" /></td>
                    <td><input type="text" name="orden" value="" size="10" /></td>
                    <td><input type="text" name="nombre" value="" size="30" /></td>
                    <td><input type="text" name="direccion" value="" size="50" /></td>
                    <td><select name="motivo">
                            <option>Seleccione</option>
                            <option>Cable *1</option>
                            <option>Cable *2</option>
                            <option>Cable *3</option>
                            <option>Cable *4</option>
                            <option>Internet + Cable *1</option>
                            <option>Internet + Cable *2</option>
                            <option>Internet + Cable *3</option>
                            <option>Internet + Cable *4</option>
                        </select></td>
                    <td><input type="text" name="inicio" value="" size="10" /></td>
                    <td><input type="text" name="fin" value="" size="10" /></td>
                    <td><select name="estado">
                            <option>Disponible</option>
                            <option>En Espera</option>
                            <option>Reservada</option>
                        </select></td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

<footer>
    <div id="logo2"></div>
</footer>     
</html>