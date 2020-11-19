<?php
require_once('crud_marcas.php');
require_once('marcas.php');
$crud= new Crudmarca();
$marca=new marcas();
$marca=$crud->obtenerMarca($_GET['id']);
?>
<html lang="es">
<head>
    <title>Actualizar marca</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<form style="padding-left : 100px" id="register-form" action='administrar_marcas.php' method='post'>
    <div class="form">
        <h1>Actualiza los datos del marca</h1>
        <input type='hidden' name='id' value='<?php echo $marca->getId()?>'>
        <label> Nombre marca:
            <input id="nombre" type='text' name='nombre' value='<?php echo $marca->getNombre()?>' class="form-control" placeholder="Nombre marca" maxlength="20" required></label><br>
        <label> Orden:
            <input id="orden" type='number' name='orden' value='<?php echo $marca->getOrden() ?>' class="form-control" placeholder="Orden" maxlength="20" required></label><br>
        <label> Activo:
            <input type='checkbox' name='activo' value='<?php echo $marca->getActivo() ?>'<?php echo $marca->getActivo() ? ' checked' : '' ?>></label><br>
        <input type='hidden' name='actualizar' value='actualizar'>
        <input type='submit' name="submit" onclick="return validar()" value='Actualizar'>
        <a href="index.php">Volver</a>
    </div>
    <script>
        function validar() {
            let nombre, orden, expresionLet;
            nombre = document.getElementById("nombre").value;
            orden = document.getElementById("orden").value;

            expresionLet = new RegExp("^[a-zA-ZñçáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ ]*$");

            if (nombre === "" || orden==="") {
                alert("ERROR: Todos los campos son obligatorios");
                return false;
            } else if (nombre.length > 20) {
                alert("ERROR: El nombre es muy largo");
                return false;
            } else if (!expresionLet.test(nombre)) {
                alert("ERROR: El nombre solo puede contener letras");
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