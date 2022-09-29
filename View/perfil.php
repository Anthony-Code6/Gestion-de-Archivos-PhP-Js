<?php
require_once('Layout/cabeza.php');
?>
<div class="row justify-content-md-center">
    <div class="col-xl-8 col-md-9 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-person-lines-fill"></i> Perfil de Usuario - <?php echo $_SESSION['usuario'][5] ?></h5>
                <div class="row g-3">
                    <div class="col-md-5 col-sm-3 text-center">
                        <label class="form-label"><i class="bi bi-code-slash"></i> Codigo de Usuario</label>
                    </div>
                    <div class="col-md-7 col-sm-9">
                        <p class="text-center"><?php echo $_SESSION['usuario'][0] ?></p>
                        <hr>
                    </div>
                    <div class="col-md-5 text-center">
                        <label class="form-label"><i class="bi bi-person-fill"></i> Nombre del Usuario</label>
                    </div>
                    <div class="col-md-7">
                        <p class="text-center"><?php echo $_SESSION['usuario'][2] . '' . $_SESSION['usuario'][1] ?></p>
                        <hr>
                    </div>
                    <div class="col-md-5 text-center">
                        <?php if ($_SESSION['usuario'][3] == 'Masculino') { ?>
                            <label class="form-label"><i class="bi bi-gender-male"></i> Sexo del Usuario</label>
                        <?php }else{?>
                            <label class="form-label"><i class="bi bi-gender-female"></i> Sexo del Usuario</label>
                        <?php } ?>

                    </div>
                    <div class="col-md-7">
                        <p class="text-center"><?php echo $_SESSION['usuario'][3] ?></p>
                        <hr>
                    </div>
                    <div class="col-md-5 text-center">
                        <label class="form-label"><i class="bi bi-envelope-fill"></i> Correo Electronico</label>
                    </div>
                    <div class="col-md-7">
                        <p class="text-center"><?php echo $_SESSION['usuario'][4] ?></p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once('Layout/pie.php');
?>