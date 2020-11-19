<?php
#Arreglar actualizar para poder dejar la imagen vacia, para poder actualizar sin tener que poner la imagen.
require_once('crud_coches.php');
require_once('coche.php');
$crud= new Crudcoche();
$coche=new coche();
$coche=$crud->obtenercoche($_GET['id']);

?>
<html lang="es">
    <head>
        <title>Actualizar coche</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <form style="padding-left : 100px" id="register-form" enctype=multipart/form-data action='administrar_coche.php' method='post'>
            <div class="form">
            <h1>Actualiza los datos del Coche</h1>
                    <input type='hidden' name='id' value='<?php echo $coche->getId()?>'>
                <label> Nombre coche:
                    <input id="nombre" type='text' name='nombre' value='<?php echo $coche->getNombre()?>' class="form-control" placeholder="Nombre Coche" maxlength="20" required></label><br>
                <label> Color:
                    <input id="color" type='text' name='color' value='<?php echo $coche->getColor()?>' class="form-control" placeholder="Color" maxlength="20" required></label><br>
                <label>Marca:
                    <select style="width : 200px" class="form-control" name="marca" id="marca">
                        <option value=""> Seleccione </option>
                        <?php

                        require_once 'conexion.php';

                        $db=Db::conectar();
                        $select=$db->query('SELECT * FROM marcas');
                        foreach ($select->fetchAll() as $row_s) {
                            $id = $row_s['id'];
                            $nombre = $row_s['nombre_marca'];
                            if ($id == $coche->getMarca()){
                                ?>

                                <option selected value="<?php echo $id; ?>"> <?php echo $nombre; ?></option>

                                <?php
                            }
                            if($id != $coche->getMarca()){
                                    ?>

                                    <option value="<?php echo $id; ?>"> <?php echo $nombre; ?></option>

                                    <?php
                            }
                        }
                        ?>
                    </select></label><br>
                <label> Orden:
                    <input id="orden" type='number' name='orden' value='<?php echo $coche->getOrden() ?>' class="form-control" placeholder="Orden" maxlength="20" required></label><br>
                <label for="imagen">Imagen: La anterior imagen era <?php echo $coche->getFoto() ?>
                    <input style="max-width: 77%" id="foto" name="foto" type="file" class="form-control"></label><br>
                <input type="hidden" name="old-foto" value="<?php echo $coche->getFoto() ?>">
                <label> Activo:
                    <input type='checkbox' name='activo' value='<?php echo $coche->getActivo() ?>'<?php echo $coche->getActivo() ? ' checked' : '' ?>></label><br>
                <input type='hidden' name='actualizar' value='actualizar'>
            <input type='submit' name="submit" onclick="return validar()" value='Actualizar'>
            <a href="index.php?pagina=1">Volver</a>
            </div>
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