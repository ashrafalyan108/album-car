<?php
require_once('conexion.php');

class CrudCoche{

    public function __construct(){}

    public function insertar($coche){
        print_r($coche);
        $db=Db::conectar();
        $insert=$db->prepare('INSERT INTO coches (nombre,color,marca,fecha_alta,orden,foto,activo) values(:nombre,:color,:marca,:fecha_alta,:orden,:foto,:activo)');
        $insert->bindValue('nombre',$coche->getNombre());
        $insert->bindValue('color',$coche->getColor());
        $insert->bindValue('marca',$coche->getMarca());
        $insert->bindValue('fecha_alta','2019-06-12');
        $insert->bindValue('orden',$coche->getOrden());
        $insert->bindValue('foto',$coche->getFoto());
        $insert->bindValue('activo',$coche->getActivo());
        $insert->execute();
    }

public function mostrarLim()
{
    $db = DB::conectar();
    $result = $db->query('SELECT c.id,c.nombre,c.color,m.nombre_marca,c.fecha_alta,c.fecha_modify,c.orden,c.foto,c.activo FROM coches c join marcas m on c.marca=m.id '
    );
    $num_total_rows = $result->rowCount();
    $NUM_ITEMS_BY_PAGE = 3;
    $pages = $num_total_rows / $NUM_ITEMS_BY_PAGE;
    $pages = ceil($pages);

    return array($NUM_ITEMS_BY_PAGE,$pages);
}
    public function mostrar(){
        $db=Db::conectar();
        $listaCoches=[];
        $num_rows =$this->mostrarLim()[0];
        $start = ($_GET['pagina']-1)*$num_rows;
        $select=$db->query('SELECT c.id,c.nombre,c.color,m.nombre_marca,c.fecha_alta,c.fecha_modify,c.orden,c.foto,c.activo FROM coches c join marcas m on c.marca=m.id LIMIT '.$start.','.$num_rows);


        foreach($select->fetchAll() as $coche){
            $myCoche= new coche();
            $myCoche->setId($coche['id']);
            $myCoche->setNombre($coche['nombre']);
            $myCoche->setColor($coche['color']);
            $myCoche->setMarca($coche['nombre_marca']);
            $myCoche->setFechaAlta($coche['fecha_alta']);
            $myCoche->setFechaModify($coche['fecha_modify']);
            $myCoche->setOrden($coche['orden']);
            $myCoche->setFoto($coche['foto']);
            $myCoche->setActivo($coche['activo']);
            $listaCoches[]=$myCoche;
        }
        return $listaCoches;
    }

    public function eliminar($id){
        $db=Db::conectar();
        $eliminar=$db->prepare('DELETE FROM coches WHERE ID=:id');
        $eliminar->bindValue('id',$id);
        $eliminar->execute();
    }


    public function obtenercoche($id){
        $db=Db::conectar();
        $select=$db->prepare('SELECT * FROM coches WHERE ID=:id');
        $select->bindValue('id',$id);
        $select->execute();
        $coche=$select->fetch(PDO::FETCH_ASSOC );
        $myCoche= new coche();
        $myCoche->setId($coche['id']);
        $myCoche->setNombre($coche['nombre']);
        $myCoche->setColor($coche['color']);
        $myCoche->setMarca($coche['marca']);
        $myCoche->setFechaAlta($coche['fecha_alta']);
        $myCoche->setFechaModify($coche['fecha_modify']);
        $myCoche->setOrden($coche['orden']);
        $myCoche->setFoto($coche['foto']);
        $myCoche->setActivo($coche['activo']);
        return $myCoche;
    }

    public function actualizar($coche){
        try {
            if ($coche->getId() == null) throw new \Exception('ID no válida');

            $db = Db::conectar();
            $actualizar = $db->prepare('UPDATE coches SET nombre=:nombre, color=:color, marca=:marca, orden=:orden, foto=:foto, activo=:activo  WHERE id=:id');
            $actualizar->bindValue('id', $coche->getId());
            $actualizar->bindValue('nombre', $coche->getNombre());
            $actualizar->bindValue('color', $coche->getColor());
            $actualizar->bindValue('marca', $coche->getMarca());
            $actualizar->bindValue('orden', $coche->getOrden());
            $actualizar->bindValue('foto', $coche->getFoto());
            $actualizar->bindValue('activo', $coche->getActivo());
            $actualizar->execute();
            return true;
        } catch (\Exception $e) {
            header('Location: actualizar.php');
        }
        return false;
    }
}
