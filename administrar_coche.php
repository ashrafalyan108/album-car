<?php
require_once('crud_coches.php');
require_once('coche.php');



$crud= new Crudcoche();
$coche= new coche();


if(isset($_POST["submit"])) {
    $nombre = $_POST["nombre"];
    $color = $_POST["color"];
    $orden = $_POST["orden"];

    $campos = array();

    $nombre_img = $_FILES['foto']['name'];
    $permitidos = array("image/jpg", "image/jpeg", "image/png","");
    $limite_kb = 100;
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

    if (stripslashes(trim($nombre == ""))) {
        array_push($campos, "El nombre no puede estar vacio");
    }
    if(!preg_match($patron_texto,$nombre)){
        array_push($campos, "El nombre solo puede contener letras");
    }
    if(strlen($nombre)>20){
        array_push($campos, "El nombre no puede contener mas de 20 caracteres");
    }
    if (stripslashes(trim($color == ""))) {
        array_push($campos, "El color no puede estar vacio");
    }
    if(!preg_match($patron_texto,$color)){
        array_push($campos, "El color solo puede contener letras");
    }
    if(strlen($color)>20){
        array_push($campos, "El color no puede contener mas de 20 caracteres");
    }
    if (stripslashes(trim($orden == ""))) {
        array_push($campos, "El orden no puede estar vacio");
    }
    if(!is_numeric($orden)){
        array_push($campos, "El orden solo puede contener numeros");
    }
    if(strlen($orden)>11){
        array_push($campos, "El orden no puede contener mas de 11 caracteres");
    }
    if(!in_array($_FILES['foto']['type'],$permitidos)){
        array_push($campos,"Extension no aceptada,solo fotos.");
    }
    if((int)$_FILES['foto']['size'] >= (int)($limite_kb*1024)){
        array_push($campos,"El tamaño del archivo es demasiado grande, maximo 100kb");
    }
    if (!empty($nombre_img)) {
        require_once 'conexion.php';

        $db = Db::conectar();
        $select = $db->query('SELECT foto FROM coches');
        foreach ($select->fetchAll() as $row_s) {
            $foto = $row_s['foto'];
            if ($nombre_img === $foto) {
                array_push($campos, "El nombre de la imagen ya existe");
            }
        }
    }
    if (count($campos) > 0) {
        for ($i = 0; $i < count($campos); $i++) {
            echo "<li>" . $campos[$i] . "</li>";
        }
    }
    elseif (isset($_POST['insertar'])){
        $ruta = "fotos/" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'],$ruta);
        $coche->setNombre($_POST['nombre']);
        $coche->setColor($_POST['color']);
        $coche->setMarca($_POST['marca']);
        $coche->setFechaAlta($_POST['fecha_alta']);
        $coche->setFechaModify($_POST['fecha_modify']);
        $coche->setOrden($_POST['orden']);
        $coche->setFoto($nombre_img);
        $coche->setActivo(isset($_POST['activo']) ? $_POST['activo'] = 1 : $_POST['activo'] = 0);
        $crud->insertar($coche);
        header('Location: index.php?pagina=1');
    } elseif (isset($_POST['actualizar'])) {
        $ruta = "fotos/" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'],$ruta);


        require_once 'conexion.php';

        $db=Db::conectar();
        $select=$db->query('SELECT * FROM coches');
        foreach ($select->fetchAll() as $row_s) {
            $old_foto=$_POST['old-foto'];
            $foto = $row_s['foto'];

            if ($foto == $old_foto) {
                unlink('fotos/'.$old_foto);
            }
        }
        $coche->setId($_POST['id']);
        $coche->setNombre($_POST['nombre']);
        $coche->setColor($_POST['color']);
        $coche->setMarca($_POST['marca']);
        $coche->setOrden($_POST['orden']);
        $coche->setFoto($nombre_img);
        $coche->setActivo(isset($_POST['activo']) ? $_POST['activo'] = 1 : $_POST['activo'] = 0);
        $crud->actualizar($coche);
        header('Location: index.php?pagina=1');
    }
} elseif (isset($_GET['accion'])) {
    if ($_GET['accion'] == 'e') {

        require_once 'conexion.php';

        $db=Db::conectar();
        $select=$db->query('SELECT * FROM coches');
        foreach ($select->fetchAll() as $row_s) {
            $foto = $row_s['foto'];
            $id = $row_s['id'];

            if ($_GET['id'] == $id ) {
                unlink('fotos/'.$foto);
            }
        }
        $crud->eliminar($_GET['id']);
        header('Location: index.php?pagina=1');
    }
}else{
    header('Location:index.php?pagina=1');
}