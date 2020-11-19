<?php
header('Content-Type: text/html; charset=utf-8');
require_once('crud_marcas.php');
require_once('marcas.php');
$crud=new CrudMarca();
$marca= new marcas();
$listaMarcas=$crud->mostrar();

?>

<html lang="es">
<head>
    <title>Mostrar coches</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script
        src="http://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        $(document).on("click", ".delete-marca", function (e) {
            let boton = $(this);
            e.preventDefault();
            e.stopImmediatePropagation();
            $.confirm({
                title: 'Seguro?',
                buttons: {
                    confirm: function () {
                        console.log(boton);
                        window.location.href = boton.attr('href');
                    },
                    cancel: function () {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                    },
                }
            });
        });
    </script>
</head>
<body>
<table border=1>
    <tr>
        <td><a href="insertar_marcas.php">Crear Marca</a></td>
    </tr>
</table>
<table border=1>
    <tr>
        <td>Nombre</td>
        <td>Fecha Alta</td>
        <td>Fecha Modify</td>
        <td>Orden</td>
        <td>Activo</td>
        <td>Actualizar</td>
        <td>Eliminar</td>
    </tr>
    <?php foreach ($listaMarcas as $marca) {?>
        <tr>
            <td><?php echo $marca->getNombre() ?></td>
            <td><?php echo $marca->getFechaAlta() ?></td>
            <td><?php echo $marca->getFechaModify() ?></td>
            <td><?php echo $marca->getOrden() ?></td>
            <td><?php echo $marca->getActivo() ?></td>
            <td><a href="actualizar_marcas.php?id=<?php echo $marca->getId()?>">Actualizar</a> </td>
            <td><a href="administrar_marcas.php?id=<?php echo $marca->getId()?>&accion=e" class="delete-marca">Eliminar</a></td>
        </tr>
    <?php }?>
</table>
<a href="index.php?pagina=1">Volver</a>
</body>
</html>