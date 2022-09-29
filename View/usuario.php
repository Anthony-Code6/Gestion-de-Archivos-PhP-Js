<?php
require_once('Layout/cabeza.php');
?>

<div class="row">
    <div class="col-lg-9 col-md-11 col-sm-12">
        <form class="d-flex" id="buscador" autocomplete="off" enctype="multipart/form-data">
            <input type="text" name="buscar" id="buscar" list="informacion" placeholder="Buscar Usuario" class="form-control me-2 w-50">
            <datalist id="informacion"></datalist>
            <button type="submit" class="btn btn-primary me-2"><i class="bi bi-search"></i> Buscar</button>
            <button type="button" class="btn btn-success" id="nuevo_usuario"><i class="bi bi-person-plus-fill"></i> Nuevo Usuario</button>
        </form>
    </div>
</div>
<br>

<div class="modal fade" id="modal_usuario_nuevo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_titulo"><i class="bi bi-list"></i> Datos del Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formulario_usuario" autocomplete="off" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="txtnombre" class="form-label"><i class="bi bi-person-fill"></i> Nombre</label>
                        <input type="hidden" name="txtcodigo" id="txtcodigo">
                        <input type="text" name="txtnombre" id="txtnombre" class="form-control" placeholder="Nombre del Usuario">
                    </div>

                    <div class="mb-3">
                        <label for="txtapellido" class="form-label"><i class="bi bi-person-fill"></i> Apellido</label>
                        <input type="text" name="txtapellido" id="txtapellido" class="form-control" placeholder="Apellido del Usuarioo">
                    </div>

                    <div class="mb-3">
                        <label for="cbosexo" class="form-label"><i class="bi bi-gender-ambiguous"></i> Sexo</label>
                        <select name="cbosexo" id="cbosexo" class="form-select">
                            <option value="">-- Seleccionar Sexo --</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="txtcorreo" class="form-label"><i class="bi bi-envelope-fill"></i> Correo Electronico</label>
                        <input type="email" name="txtcorreo" id="txtcorreo" class="form-control" placeholder="Correo Electronico del Usuario">
                    </div>

                    <div class="mb-3">
                        <label for="cbotipo" class="form-label"><i class="bi bi-person-lines-fill"></i> Tipo Usuario</label>
                        <select name="cbotipo" id="cbotipo" class="form-select"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="bi bi-box-arrow-right"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_usuario_editar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_titulo"><i class="bi bi-list"></i> Datos del Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formulario_usuario_editar" autocomplete="off" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="txtnombre_editar" class="form-label"><i class="bi bi-person-fill"></i> Nombre</label>
                        <input type="hidden" name="txtcodigo_editar" id="txtcodigo_editar">
                        <input type="text" name="txtnombre_editar" id="txtnombre_editar" class="form-control" placeholder="Nombre del Usuario">
                    </div>

                    <div class="mb-3">
                        <label for="txtapellido_editar" class="form-label"><i class="bi bi-person-fill"></i> Apellido</label>
                        <input type="text" name="txtapellido_editar" id="txtapellido_editar" class="form-control" placeholder="Apellido del Usuarioo">
                    </div>

                    <div class="mb-3">
                        <label for="cbosexo_editar" class="form-label"><i class="bi bi-gender-ambiguous"></i> Sexo</label>
                        <select name="cbosexo_editar" id="cbosexo_editar" class="form-select">
                            <option value="">-- Seleccionar Sexo --</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="txtcorreo_editar" class="form-label"><i class="bi bi-envelope-fill"></i> Correo Electronico</label>
                        <input type="email" name="txtcorreo_editar" id="txtcorreo_editar" class="form-control" placeholder="Correo Electronico del Usuario">
                    </div>

                    <div class="mb-3">
                        <label for="cbotipo_editar" class="form-label"><i class="bi bi-person-lines-fill"></i> Tipo Usuario</label>
                        <select name="cbotipo_editar" id="cbotipo_editar" class="form-select"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning"><i class="bi bi-box-arrow-right"></i> Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><i class="bi bi-person-fill"></i> Nombre Completo</th>
                <th><i class="bi bi-gender-ambiguous"></i> Sexo</th>
                <th><i class="bi bi-envelope-fill"></i> Correo Electronico</th>
                <th><i class="bi bi-person-lines-fill"></i> Tipo</th>
            </tr>
        </thead>
        <tbody id="usuarios"></tbody>
    </table>
</div>

<script src="Js/js_usuario.js"></script>
<?php
require_once('Layout/pie.php');
?>