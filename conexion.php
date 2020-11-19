<?php
class  Db{
    private static $conexion=NULL;
    private function __construct (){}

    public static function conectar(){
        try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        self::$conexion= new PDO('mysql:host=localhost;dbname=coches','root','',$pdo_options);
        return self::$conexion;
    } catch (PDOException $e){
            echo "ERROR: " . $e->getMessage();
        }
    }
}
