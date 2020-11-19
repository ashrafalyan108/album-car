<?php
error_reporting(E_ALL ^ E_NOTICE);
header('Content-Type: text/html; charset=utf-8');
require_once('crud_coches.php');
require_once('coche.php');

$pagina = $_GET['pagina'];
if (!$pagina) $pagina = 1;
$crud=new Crudcoche();
$coche= new coche();
$limite = $crud->mostrarLim()[1];
if ($pagina>$limite || $pagina<=0){
    header('Location:index.php?pagina=1');
}
$_GET['pagina'] = $pagina;
$listacoches=$crud->mostrar();

?>

<html lang="es">
<head>
    <title>Mostrar coches</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/album/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script
            src="http://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        $(document).on("click", "#delete-coche", function (e) {
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

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Album Coches</h1>
            <p>
                <a href="insertar.php" class="btn btn-primary my-2">Insertar</a>
                <a href="index-marcas.php" class="btn btn-secondary my-2">Ver marcas</a>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
            <?php foreach ($listacoches as $coche) {?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img style="height: 200px; border-radius: 4px" alt="No hay imagen"; src="fotos/<?php echo $coche->getFoto() ?>" />
                        <div class="card-body">
                            <p class="card-text">
                                Nombre: <?php echo $coche->getNombre() ?><br>
                                Color: <?php echo $coche->getColor() ?><br>
                                Marca: <?php echo $coche->getMarca() ?><br>
                                Fecha Alta: <?php echo $coche->getFechaAlta() ?><br>
                                Fecha Modificacion: <?php echo $coche->getFechaModify() ?><br>
                                Orden: <?php echo $coche->getOrden() ?><br>
                                Foto: <?php echo $coche->getFoto() ?><br>
                                Activo? <?php if($coche->getActivo()==1){echo "Si";}else{ echo "No";} ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="detalles.php?id=<?php echo $coche->getId()?>" class="btn btn-sm btn-outline-secondary">Detalles</a>
                                    <a href="actualizar.php?id=<?php echo $coche->getId()?>" class="btn btn-sm btn-outline-secondary">Actualizar</a>
                                    <a href="administrar_coche.php?id=<?php echo $coche->getId()?>&accion=e" id="delete-coche" class="btn btn-sm btn-outline-secondary">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
            </div>
        </div>
    </div>
</main>
<nav style="position: absolute; left: 40%;" aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled' : '' ?>">
            <a class="page-link" href='index.php?pagina=<?php echo $_GET['pagina']-1; ?>'>Previous</a>
        </li>

        <?php for ($i = 0; $i<$limite; $i++){ ?>
        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>">
            <a class="page-link" href="index.php?pagina=<?php echo $i+1 ?>">
            <?php echo $i+1 ?>
            </a>
        </li>
        <?php } ?>
        <li class="page-item <?php echo $_GET['pagina']>=$limite ? 'disabled' : '' ?> ">
            <a class="page-link" href='index.php?pagina=<?php echo $_GET['pagina']+1; ?>'>Next</a>
        </li>
    </ul>
</nav>
</body>
</html>
