<?php
require_once('crud_marcas.php');
require_once('marcas.php');

$crud= new CrudMarca();
$marca= new marcas();


//VALIDAR AQUI.
if(isset($_POST["submit"])) {
    $nombre = $_POST["nombre"];
    $orden = $_POST["orden"];

    $campos = array();

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
    if (stripslashes(trim($orden == ""))) {
        array_push($campos, "El orden no puede estar vacio");
    }
    if(!is_numeric($orden)){
        array_push($campos, "El orden solo puede contener numeros");
    }
    if(strlen($orden)>11){
        array_push($campos, "El orden no puede contener mas de 11 caracteres");
    }
    if (count($campos) > 0) {
        for ($i = 0; $i < count($campos); $i++) {
            echo "<li>" . $campos[$i] . "</li>";
        }
    } elseif (isset($_POST['insertar'])) {
        $marca->setNombre($_POST['nombre']);
        $marca->setFechaAlta($_POST['fecha_alta']);
        $marca->setFechaModify($_POST['fecha_modify']);
        $marca->setOrden($_POST['orden']);
        $marca->setActivo(isset($_POST['activo']) ? $_POST['activo'] = 1 : $_POST['activo'] = 0);
        $crud->insertar($marca);
        header('Location: index-marcas.php');
    } elseif (isset($_POST['actualizar'])) {
        $marca->setId($_POST['id']);
        $marca->setNombre($_POST['nombre']);
        $marca->setOrden($_POST['orden']);
        $marca->setActivo(isset($_POST['activo']) ? $_POST['activo'] = 1 : $_POST['activo'] = 0);
        $crud->actualizar($marca);
        header('Location: index-marcas.php');
    }
} elseif (isset($_GET['accion'])) {
    if ($_GET['accion'] == 'e') {
        $crud->eliminar($_GET['id']);
        header('Location: index-marcas.php');
    }
}