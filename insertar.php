<html lang="es">
    <head>
        <title> Ingresar Coche</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>

        <form style="padding-left : 100px; max-width: 50%" id="register-form" action='administrar_coche.php' method='POST' enctype="multipart/form-data">
            <div class="form">
                <h1>Ingresa los datos del Coche</h1>
                    <label>Nombre:</label>
                        <input style="max-width: 40%" id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre Coche" maxlength="20" required>
                    <label for="color">Color:</label>
                        <input style="max-width: 40%" id="color" name="color" type="text" class="form-control" placeholder="Color" maxlength="20" required>
                    <label for="marca">Marca:</label>
                        <select  style="width : 200px" class="form-control" name="marca" id="marca">
                            <option value=""> Seleccione </option>
                            <?php

                            require_once 'conexion.php';

                            $db=Db::conectar();
                            $select=$db->query('SELECT * FROM marcas');
                            foreach ($select->fetchAll() as $row_s) {
                                $id = $row_s['id'];
                                $nombre = $row_s['nombre_marca'];
                                ?>

                                <option value="<?php echo $id; ?>"> <?php echo $nombre; ?></option>

                                <?php
                            }

                            ?>
                        </select>
                    <label for="orden">Orden:</label>
                        <input style="max-width: 40%" id="orden" name="orden" type="number" class="form-control" placeholder="Orden" maxlength="20" required>
                    <label for="imagen">Imagen:</label>
                        <input style="max-width: 77%" id="foto" name="foto" type="file" class="form-control" required>
                    <label for="activo">Activo:</label>
                        <input type='checkbox' id="activo" name='activo' value="1">
                <input type='hidden' name='insertar' value='insertar'>
            </div>
            <input type="submit" id="guardar" name="submit" onclick="return validar()" value='Guardar'>
            <a href="index.php?pagina=1">Volver</a>
            <script>
                function validar() {
                    let nombre, marca, color, orden, expresionLet;
                    nombre = document.getElementById("nombre").value;
                    color = document.getElementById("color").value;
                    marca = document.getElementById("marca").value;
                    orden = document.getElementById("orden").value;

                    expresionLet = new RegExp("^[a-zA-ZñçáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ ]*$");

                    if (nombre === "" || color === "" || marca === "" || orden === "") {
                        alert("ERROR: Todos los campos son obligatorios");
                        return false;
                    } else if (nombre.length > 20) {
                        alert("ERROR: El nombre es muy largo");
                        return false;
                    } else if (!expresionLet.test(nombre)) {
                        alert("ERROR: El nombre solo puede contener letras");
                        return false;
                    } else if (color.length > 20) {
                        alert("ERROR: El color es muy largo");
                        return false;
                    } else if (!expresionLet.test(color)) {
                        alert("ERROR: El color solo puede contener letras");
                        return false;
                    } else if (orden.length > 11) {
                        alert("ERROR: El orden es muy largo");
                        return false;
                    }else if (isNaN(orden)){
                        alert("ERROR: El orden tiene que ser un numero");
                        return false;
                    }
                }
            </script>
        </form>
    </body>
</html>