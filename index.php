<?php
require_once('Controller/ControllerUsuario.php');
require_once('Model/Usuario.php');
$usuario = new ControllerUsuario();

require_once('Controller/ControllerArchivo.php');
require_once('Model/Archivos.php');
$archivo = new ControllerArchivo();

require_once('Controller/ControllerCompartir.php');
require_once('Model/Compartir.php');
$compartir = new ControllerCompartir();

session_start();
$_SESSION['login'] = 'login';

if ($_GET == null) {
    header('location: ./?v=Sesion');
} else if (isset($_GET['v'])) {
    switch ($_GET['v']) {
        case 'Sesion':
            if ($_SESSION['login']) {
                require_once('View/login.php');
            } else {
                header('location: ./?v=Inicio');
            }
            break;
        case 'Inicio':
            require_once('View/index.php');
            break;
        case 'Usuario':
            require_once('View/usuario.php');
            break;
        case 'Archivo':
            require_once('View/archivo.php');
            break;
        case 'Perfil':
            require_once('View/perfil.php');
            break;
        case 'Salir':
            session_start();
            session_destroy();
            header('location: ./?v=Sesion');
            break;
        default:
            header('location: ./?v=Sesion');
            break;
    }
}

if (isset($_GET['a'])) {
    switch ($_GET['a']) {
        case 'Guardar':
            $archivo->GuardarArchivos(new Archivos(0, $_SESSION['usuario'][0], $_FILES['archivo']['name'], $_FILES['archivo']['type'], $_POST['comentario']), $_FILES['archivo']['tmp_name']);
            break;
        case 'Eliminar':
            $archivo->EliminarArchivo($_GET['Archivo']);
            break;
        case 'Buscar':
            $archivo->BuscarArchivo($_GET['Archivo']);
            break;
        case 'Editar':
            $archivo->ActualizarArchivo(new Archivos($_POST['txtid_editar'], null, null, null, $_POST['txtcomentario_editar']));
            break;
        case 'Buscador':
            $archivo->BuscarArchivoTiempoReal($_GET['Buscar']);
            break;
        case 'Descargar':
            $archivo->Descargar_Archico($_GET['Archivo']);
            break;
        default:
            $archivo->ListarArchivos();
            break;
    }
}

if (isset($_GET['c'])) {
    switch ($_GET['c']) {
        case 'Guardar':
            $compartir->Guardar_Archivo_Compartido(new Compartir(0,$_SESSION['usuario'][0],$_POST['txtcodigo'],$_POST['cboarchivo']));
            break;
        case 'Buscar':
            $compartir->Buscar_Archivos_Compartido_Tiempo_Real($_GET['Archivo']);
            break;
        case 'Informacion':
            $compartir->Mostrar_Informacion($_GET['Codigo']);
            break;
        case 'Validar':
            $compartir->Validar_Usuario($_GET['Codigo']);
            break;
        case 'Borrar':
            $compartir->Eliminar_Archivo_Compartido($_GET['Codigo']);
            break;
        case 'Listar':
            $compartir->Listar_Archivos();
            break;
        default:
            $compartir->Listar_Archivos_Compartido();
            break;
    }
}

if (isset($_GET['u'])) {
    switch ($_GET['u']) {
        case 'Codigo':
            $usuario->Codigo_Aleatorio();
            break;
        case 'Guardar':
            $usuario->GuardarUsuario(new Usuario($_POST['txtcodigo'], $_POST['txtnombre'], $_POST['txtapellido'], $_POST['cbosexo'], $_POST['txtcorreo'], $_POST['cbotipo']));
            break;
        case 'Actualizar':
            $usuario->ActualizarUsuario(new Usuario($_POST['txtcodigo_editar'], $_POST['txtnombre_editar'], $_POST['txtapellido_editar'], $_POST['cbosexo_editar'], $_POST['txtcorreo_editar'], $_POST['cbotipo_editar']));
            break;
        case 'TiempoReal':
            $usuario->BuscarUsuario_TiempoReal($_GET['Usuario']);
            break;
        case 'Buscar':
            $usuario->BuscarUsuario($_GET['Usuario']);
            break;
        case 'Eliminar':
            $usuario->BorrarUsuario($_GET['Usuario']);
        case 'Login':
            session_start();
            session_destroy();
            session_start();
            $usuario->Inicio_Session($_POST['correo'], $_POST['clave']);
            break;
        case 'Tipos':
            $usuario->ListarTipoUsuario();
            break;
        default:
            $usuario->ListarUsuarios();
            break;
    }
}
