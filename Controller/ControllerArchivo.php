<?php
require_once('./Config/Conexion.php');
require_once('Model/Archivos.php');

class ControllerArchivo
{
    private $database;

    function __construct()
    {
        $this->database = Conexion::getConexion();
    }

    public function Descargar_Archico($archivo)
    {
        try {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$archivo");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");

            readfile('./Archivos/' . $archivo);
        } catch (Exception $ex) {
            echo 'Error el archivo no se puede descargar: ' . $ex->getMessage();
        }
        exit;
    }

    public function GuardarArchivos(Archivos $archivo, $temporal)
    {
        $sql = "INSERT INTO archivo(USUARIO,ARCHIVO,EXTENCION,COMENTARIO)VALUES(?,?,?,?)";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$archivo->getcodigo_usuario(), $archivo->getArchivo(), $archivo->getExtencion(), $archivo->getComentario()]);
            move_uploaded_file($temporal, './Archivos/' . $archivo->getArchivo());
        } catch (Exception $ex) {
            echo 'Error al Registrar el archivo: ' . $ex->getMessage();
        }
        echo $archivo->getExtencion();
        exit;
    }

    public function EliminarArchivo($codigo)
    {
        try {
            // BUSCAR NOMBRE DEL ARCHIVO PARA ELIMINARLO
            $sql_archivo = "SELECT ARCHIVO FROM archivo WHERE ID=?";
            $rs_archivo = $this->database->prepare($sql_archivo);
            $rs_archivo->execute([$codigo]);
            $borrar_archivo = $rs_archivo->fetchAll(PDO::FETCH_ASSOC);

            unlink('./Archivos/' . $borrar_archivo[0]['ARCHIVO']);

            // ELIMINAR LA INFORMACION DE LA BASE DE DATOS
            $sql = "DELETE FROM archivo WHERE ID=?";
            $rs = $this->database->prepare($sql);
            $rs->execute([$codigo]);
        } catch (Exception $ex) {
            echo 'Error a borrar el archivo: ' . $ex->getMessage();
        }
        exit;
    }

    public function BuscarArchivo($codigo)
    {
        $sql = "SELECT * FROM archivo WHERE ID=?";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$codigo]);
            echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $ex) {
            echo 'Error al buscar la informacion del archico: ' . $ex->getMessage();
        }
        exit;
    }

    public function ActualizarArchivo(Archivos $archivo)
    {
        $sql = "UPDATE archivo SET COMENTARIO=? WHERE ID=?";
        try {
            $rs = $this->database->prepare($sql);
            $rs->execute([$archivo->getComentario(), $archivo->getId()]);
        } catch (Exception $ex) {
            echo 'Error al Artualircar la informacion: ' . $ex->getMessage();
        }
        exit;
    }

    public function BuscarArchivoTiempoReal($buscador)
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
                            WHERE A.COMENTARIO=?";

                $rs_admin = $this->database->prepare($sql_admin);
                $rs_admin->execute([$buscador]);
                echo json_encode($rs_admin->fetchAll(PDO::FETCH_ASSOC));
            } else if ($validar[0]['TIPO'] == 'Usuario') {
                $sql_usuario = "SELECT A.ID,CONCAT(U.APELLIDO,' ',U.NOMBRE) AS USER,A.ARCHIVO,A.EXTENCION,A.COMENTARIO 
                            FROM USUARIO AS U INNER JOIN ARCHIVO AS A
                            ON A.USUARIO=U.CODIGO
                            WHERE U.CODIGO=? AND A.COMENTARIO=?";

                $rs_usuario = $this->database->prepare($sql_usuario);
                $rs_usuario->execute([$_SESSION['usuario'][0], $buscador]);
                echo json_encode($rs_usuario->fetchAll(PDO::FETCH_ASSOC));
            }
        } catch (Exception $ex) {
            echo 'Error al Listar el Archivos : ' . $ex->getMessage();
        }
        exit;
    }

    public function ListarArchivos()
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
                            ON A.USUARIO=U.CODIGO";

                $rs_admin = $this->database->prepare($sql_admin);
                $rs_admin->execute();
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
}
