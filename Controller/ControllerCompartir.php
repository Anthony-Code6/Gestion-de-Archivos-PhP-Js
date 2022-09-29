<?php
require_once('./Config/Conexion.php');
require_once('Model/Compartir.php');

class ControllerCompartir
{
    private $database;

    function __construct()
    {
        $this->database = Conexion::getConexion();
    }

    public function Eliminar_Archivo_Compartido($codigo)
    {
        try {
            $sql = "DELETE FROM COMPARTIR WHERE ID=?";
            $rs = $this->database->prepare($sql);
            $rs->execute([$codigo]);
        } catch (Exception $ex) {
            echo 'Error al Eliminar el Archivo Compartido: ' . $ex->getMessage();
        }
    }

    public function Guardar_Archivo_Compartido(Compartir $compartir){
        try{
            $sql="INSERT INTO compartir(ID_USUARIO,ID_USUARIO_COMPARTIR,ID_ARCHIVO,FECHA)VALUES(?,?,?,current_timestamp)";
            $rs=$this->database->prepare($sql);
            $rs->execute([$compartir->getId_usuario(),$compartir->getId_usuario_compartir(),$compartir->getId_archivo()]);
        }catch(Exception $ex){
            echo 'Error al Guardar los Archivo Compartido: '.$ex->getMessage();
        }
    }

    public function Listar_Archivos()
    {
        try {
            // VALIDAR EL TIPO DE INFORMACION DE VA A MOSTRAR
            $sql = "SELECT T.ID,T.TIPO 
                    FROM USUARIO AS U INNER JOIN TIPO AS T 
                    ON T.ID=U.ID_TIPO INNER JOIN ARCHIVO AS A 
                    ON A.USUARIO=U.CODIGO
                    WHERE U.CODIGO=?";

            $rs = $this->database->prepare($sql);
            $rs->execute([$_SESSION['usuario'][0]]);
            $validar = $rs->fetchAll(PDO::FETCH_ASSOC);

            // VALIDAR SI ES UNA ADMINISTRADOR O UN USUARIO
            if ($validar[0]['TIPO'] == 'Admin') {
                $sql_admin = "SELECT A.ID,CONCAT(U.APELLIDO,' ',U.NOMBRE) AS USER,A.ARCHIVO,A.EXTENCION,A.COMENTARIO 
                            FROM USUARIO AS U INNER JOIN ARCHIVO AS A
                            ON A.USUARIO=U.CODIGO
                            WHERE U.CODIGO=?";

                $rs_admin = $this->database->prepare($sql_admin);
                $rs_admin->execute([$_SESSION['usuario'][0]]);

                echo json_encode($rs_admin->fetchAll(PDO::FETCH_ASSOC));
            } else if ($validar[0]['TIPO'] == 'Usuario') {
                $sql_usuario = "SELECT A.ID,CONCAT(U.APELLIDO,' ',U.NOMBRE) AS USER,A.ARCHIVO,A.EXTENCION,A.COMENTARIO 
                            FROM USUARIO AS U INNER JOIN ARCHIVO AS A
                            ON A.USUARIO=U.CODIGO
                            WHERE U.CODIGO=?";

                $rs_usuario = $this->database->prepare($sql_usuario);
                $rs_usuario->execute([$_SESSION['usuario'][0]]);

                echo json_encode($rs_usuario->fetchAll(PDO::FETCH_ASSOC));
            }
        } catch (Exception $ex) {
            echo 'Error al Listar el Archivos : ' . $ex->getMessage();
        }
        exit;
    }

    public function Buscar_Archivos_Compartido_Tiempo_Real($archivo)
    {
        $sql = "SELECT C.ID,U.CODIGO AS CODIGO_USUARIO,CONCAT(U.APELLIDO,' ',U.NOMBRE) AS USUARIO,UC.CODIGO AS CODIGO_USUARIO_COMPARTIDO, CONCAT(UC.APELLIDO,' ',UC.NOMBRE) AS USUARIO_COMPARTIDO,A.ARCHIVO,A.EXTENCION,A.COMENTARIO,C.FECHA
                FROM COMPARTIR AS C INNER JOIN USUARIO AS U 
                ON C.ID_USUARIO=U.CODIGO INNER JOIN USUARIO AS UC
                ON C.ID_USUARIO_COMPARTIR=UC.CODIGO INNER JOIN ARCHIVO AS A
                ON C.ID_ARCHIVO=A.ID
                WHERE UC.CODIGO=? AND A.COMENTARIO LIKE CONCAT(?,'%')";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$_SESSION['usuario'][0], $archivo]);
            echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $ex) {
            echo 'Error a listar los archivos compartido: ' . $ex->getMessage();
        }
        exit;
    }

    public function Validar_Usuario($codigo)
    {
        if ($_SESSION['usuario'][0] != $codigo) {
            $sql = "SELECT * FROM USUARIO WHERE CODIGO=?";
            try {
                $rs = $this->database->prepare($sql);
                $rs->execute([$codigo]);
                $validar = $rs->fetchAll(PDO::FETCH_ASSOC);
                if ($validar) {
                    echo json_encode($validar);
                } else {
                    echo json_encode('Error');
                }
            } catch (Exception $ex) {
                echo 'Error al Validar la Informacion: ' . $ex->getMessage();
            }
        }else{
            echo json_encode('Iguales');
        }
        exit;
    }

    public function Mostrar_Informacion($codigo)
    {
        $sql = "SELECT C.ID,U.CODIGO AS CODIGO_USUARIO,CONCAT(U.APELLIDO,' ',U.NOMBRE) AS USUARIO,UC.CODIGO AS CODIGO_USUARIO_COMPARTIDO, CONCAT(UC.APELLIDO,' ',UC.NOMBRE) AS USUARIO_COMPARTIDO,A.ARCHIVO,A.EXTENCION,A.COMENTARIO,C.FECHA
                FROM COMPARTIR AS C INNER JOIN USUARIO AS U 
                ON C.ID_USUARIO=U.CODIGO INNER JOIN USUARIO AS UC
                ON C.ID_USUARIO_COMPARTIR=UC.CODIGO INNER JOIN ARCHIVO AS A
                ON C.ID_ARCHIVO=A.ID
                WHERE UC.CODIGO=? AND C.ID=?";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$_SESSION['usuario'][0], $codigo]);
            echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $ex) {
            echo 'Error a listar los archivos compartido: ' . $ex->getMessage();
        }
        exit;
    }

    public function Listar_Archivos_Compartido()
    {
        $sql = "SELECT C.ID,U.CODIGO AS CODIGO_USUARIO,CONCAT(U.APELLIDO,' ',U.NOMBRE) AS USUARIO,UC.CODIGO AS CODIGO_USUARIO_COMPARTIDO, CONCAT(UC.APELLIDO,' ',UC.NOMBRE) AS USUARIO_COMPARTIDO,A.ARCHIVO,A.EXTENCION,A.COMENTARIO,C.FECHA
                FROM COMPARTIR AS C INNER JOIN USUARIO AS U 
                ON C.ID_USUARIO=U.CODIGO INNER JOIN USUARIO AS UC
                ON C.ID_USUARIO_COMPARTIR=UC.CODIGO INNER JOIN ARCHIVO AS A
                ON C.ID_ARCHIVO=A.ID
                WHERE UC.CODIGO=?";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$_SESSION['usuario'][0]]);
            echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $ex) {
            echo 'Error a listar los archivos compartido: ' . $ex->getMessage();
        }
        exit;
    }
}
