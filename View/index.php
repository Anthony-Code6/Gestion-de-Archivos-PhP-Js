<?php
require_once('Layout/cabeza.php');
?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Archivos Compartidos</h5>

        <form id="buscador" autocomplete="off" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Nombre del Archivo ...">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Buscar</button>
                <button type="button" class="btn btn-success" id="compartir_archivo"><i class="bi bi-folder-plus"></i> Compartir</button>
            </div>
        </form>
        <br>
        <div class="row g-3" id="contenido"></div>
    </div>
</div>

<div class="modal fade" id="modal_compartir" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_titulo"><i class="bi bi-list"></i> Compartir Archivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formulario_compartir" autocomplete="off" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="txtcodigo" class="form-label"><i class="bi bi-postcard-fill"></i> Codigo del Usuario</label>
                        <div class="input-group">
                            <input type="text" name="txtcodigo" maxlength="10" id="txtcodigo" class="form-control" placeholder="Codigo del Usuario">
                            <button type="button" id="validar" class="btn btn-info"><i class="bi bi-check-circle-fill"></i> Validar</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cboarchivo" class="form-label"><i class="bi bi-folder-fill"></i> Archivo</label>
                        <select name="cboarchivo" id="cboarchivo" class="form-select">

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="compartir" class="btn btn-success"><i class="bi bi-box-arrow-right"></i> Compartir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="Js/js_compartir.js"></script>
<?php
require_once('Layout/pie.php');
?>