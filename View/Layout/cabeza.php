<?php
if ($_SESSION['usuario']) {
} else {
    session_start();
    session_destroy();
    header('location: ?v=Sesion');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Archivos - <?php echo $_SESSION['usuario'][2] . ' ' . $_SESSION['usuario'][1] ?></title>
</head>

<body>
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="?v=Inicio" class="d-flex align-items-center text-dark text-decoration-none">
                    <span class="fs-4"><i class="bi bi-folder-fill"></i> Gestion de Archivos</span>
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <?php if ($_SESSION['usuario'][5] == 'Admin') {
                    ?>
                        <a class="me-3 py-2 text-dark text-decoration-none" href="?v=Usuario"><i class="bi bi-people-fill"></i> Usuarios</a>
                    <?php
                    } ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="?v=Archivo"><i class="bi bi-folder-fill"></i> Archivos</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="?v=Perfil"><i class="bi bi-person-lines-fill"></i> Perfil</a>
                    <a class="py-2 text-dark text-decoration-none" href="?v=Salir"><i class="bi bi-box-arrow-right"></i> Salir</a>
                </nav>
            </div>
        </header>

        <main style="padding: 5px;">