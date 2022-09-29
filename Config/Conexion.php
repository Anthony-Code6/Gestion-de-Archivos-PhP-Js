<?php
class Conexion
{
    public static function getConexion()
    {
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=ARCHIVOS;port=3306', 'root', '123456789');
        } catch (Exception $ex) {
            echo 'Error en la Conexion a la Base de Datos : '. $ex->getMessage();
        }
        return $conexion;
    }
}
