<?php
require_once('conexion.php');

class CrudMarca{
    public function __construct(){}

    public function insertar($marca){
        print_r($marca);
        $db=Db::conectar();
        $insert=$db->prepare('INSERT INTO marcas (nombre_marca,fecha_alta,orden,activo) values(:nombre_marca,:fecha_alta,:orden,:activo)');
        $insert->bindValue('nombre_marca',$marca->getNombre());
        $insert->bindValue('fecha_alta','2019-06-12');
        $insert->bindValue('orden',$marca->getOrden());
        $insert->bindValue('activo',$marca->getActivo());
        $insert->execute();
    }

    public function mostrar(){
        $db=Db::conectar();
        $listaMarcas=[];
        $select=$db->query('SELECT * FROM marcas');

        foreach($select->fetchAll() as $marca){
            $myMarca= new marcas();
            $myMarca->setId($marca['id']);
            $myMarca->setNombre($marca['nombre_marca']);
            $myMarca->setFechaAlta($marca['fecha_alta']);
            $myMarca->setFechaModify($marca['fecha_modify']);
            $myMarca->setOrden($marca['orden']);
            $myMarca->setActivo($marca['activo']);

            $listaMarcas[]=$myMarca;
        }
        return $listaMarcas;
    }

    public function eliminar($id){
        $db=Db::conectar();
        $eliminar=$db->prepare('DELETE FROM marcas WHERE id=:id');
        $eliminar->bindValue('id',$id);
        $eliminar->execute();
    }


    public function obtenerMarca($id){
        $db=Db::conectar();
        $select= $db->prepare('SELECT * FROM marcas WHERE id=:id');
        $select->bindValue('id',$id);
        $select->execute();
        $marca=$select->fetch(PDO::FETCH_ASSOC );
        $myMarca= new marcas();
        $myMarca->setId($marca['id']);
        $myMarca->setNombre($marca['nombre_marca']);
        $myMarca->setFechaAlta($marca['fecha_alta']);
        $myMarca->setFechaModify($marca['fecha_modify']);
        $myMarca->setOrden($marca['orden']);
        $myMarca->setActivo($marca['activo']);
        return $myMarca;
    }

    public function actualizar($marca){
        try {
            if ($marca->getId() == null) throw new \Exception('ID no válida');

            $db = Db::conectar();
            $actualizar = $db->prepare('UPDATE marcas SET nombre_marca=:nombre_marca, orden=:orden, activo=:activo  WHERE id=:id');
            $actualizar->bindValue('id', $marca->getId());
            $actualizar->bindValue('nombre_marca', $marca->getNombre());
            $actualizar->bindValue('orden', $marca->getOrden());
            $actualizar->bindValue('activo', $marca->getActivo());
            $actualizar->execute();
            return true;
        } catch (\Exception $e) {
            header('Location: actualizar_marcas.php');
        }
        return false;
    }
}