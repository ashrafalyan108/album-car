<?php
header('Content-Type: text/html; charset=utf-8');
require_once('crud_coches.php');
require_once('coche.php');
$crud=new Crudcoche();
$coche= new coche();
$coche = $crud->obtenercoche($_GET['id']);
?>

<html lang="es">
<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Detalles Coche</h1>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img style=" border-radius: 4px" alt src="fotos/<?php echo $coche->getFoto() ?>" />
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
                                    <a href="index.php?pagina=1">Volver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>