<?php
require_once('./Config/Conexion.php');
require_once('Model/Usuario.php');

class ControllerUsuario
{
    private $database;

    function __construct()
    {
        $this->database = Conexion::getConexion();
    }

    public function Inicio_Session($correo, $password)
    {
        $sql = "SELECT U.CODIGO,U.APELLIDO ,U.NOMBRE , U.SEXO,U.CORREO,T.TIPO
                FROM USUARIO AS U INNER JOIN TIPO AS T 
                ON T.ID=U.ID_TIPO
                WHERE U.CORREO=? AND U.CODIGO=?";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$correo, $password]);
            $validar = $rs->fetchAll(PDO::FETCH_ASSOC);
            if ($validar) {
                $_SESSION['usuario'] = array();
                $_SESSION['usuario'][0] = $validar[0]['CODIGO'];
                $_SESSION['usuario'][1] = $validar[0]['NOMBRE'];
                $_SESSION['usuario'][2] = $validar[0]['APELLIDO'];
                $_SESSION['usuario'][3] = $validar[0]['SEXO'];
                $_SESSION['usuario'][4] = $validar[0]['CORREO'];
                $_SESSION['usuario'][5] = $validar[0]['TIPO'];
            }
        } catch (Exception $ex) {
        }
    }

    public function Codigo_Aleatorio()
    {
        $cadena = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@$%&\?/*^!~`<>';
        echo substr(str_shuffle($cadena), 0, 10);
    }

    public function GuardarUsuario(Usuario $usuario)
    {
        $sql = "INSERT INTO USUARIO(CODIGO,NOMBRE,APELLIDO,SEXO,CORREO,ID_TIPO)VALUES(?,?,?,?,?,?)";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$usuario->getCodigo(), $usuario->getNombre(), $usuario->getApellido(), $usuario->getSexo(), $usuario->getCorreo(), $usuario->getId_tipo()]);
        } catch (Exception $ex) {
            echo 'Error en Guardar informacion del Usuarios : ' . $ex->getMessage();
        }
        exit;
    }

    public function ActualizarUsuario(Usuario $usuario)
    {
        $sql = "UPDATE USUARIO SET NOMBRE=?,APELLIDO=?,SEXO=?,CORREO=?,ID_TIPO=? WHERE CODIGO=?";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$usuario->getNombre(), $usuario->getApellido(), $usuario->getSexo(), $usuario->getCorreo(), $usuario->getId_tipo(), $usuario->getCodigo()]);
        } catch (Exception $ex) {
            echo 'Error en Guardar informacion del Usuarios : ' . $ex->getMessage();
        }
        exit;
    }

    public function BuscarUsuario($codigo)
    {
        $sql = "SELECT U.CODIGO,U.APELLIDO ,U.NOMBRE, U.SEXO,U.CORREO,T.TIPO,T.ID
                FROM USUARIO AS U INNER JOIN TIPO AS T 
                ON T.ID=U.ID_TIPO
                WHERE U.CODIGO=?";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$codigo]);
            echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $ex) {
            echo 'Error en Buscar al Usuario : ' . $ex->getMessage();
        }
    }

    public function BuscarUsuario_TiempoReal($usuario)
    {
        $sql = "SELECT U.CODIGO,CONCAT(U.APELLIDO ,' ',U.NOMBRE) AS USER , U.SEXO,U.CORREO,T.TIPO
        FROM USUARIO AS U INNER JOIN TIPO AS T 
        ON T.ID=U.ID_TIPO
        WHERE CONCAT(U.APELLIDO ,' ',U.NOMBRE) LIKE CONCAT('%' ,?,'%')";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$usuario]);
            echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $ex) {
            echo 'Error en Buscar al Usuario en Tiempo Real : ' . $ex->getMessage();
        }
        exit;
    }

    public function BorrarUsuario($usuario)
    {
        $sql = "DELETE FROM USUARIO WHERE CODIGO=?";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$usuario]);
        } catch (Exception $ex) {
            echo 'Error en Borrar al Usuario : ' . $ex->getMessage();
        }
        exit;
    }

    public function ListarUsuarios()
    {
        $sql = "SELECT U.CODIGO,CONCAT(U.APELLIDO ,' ',U.NOMBRE) AS USER , U.SEXO,U.CORREO,T.TIPO
                FROM USUARIO AS U INNER JOIN TIPO AS T 
                ON T.ID=U.ID_TIPO";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute();
            echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $ex) {
            echo 'Error en Listar los Usuarios : ' . $ex->getMessage();
        }
        exit;
    }

    public function ListarTipoUsuario()
    {
        $sql = "SELECT * FROM TIPO";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute();
            echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $ex) {
            echo 'Error en Listar los Tipos de Usuarios : ' . $ex->getMessage();
        }
        exit;
    }
}
