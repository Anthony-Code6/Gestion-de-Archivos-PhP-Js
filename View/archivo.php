<?php
require_once('Layout/cabeza.php');
?>
<div class="modal fade" id="modalnuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltitulonuevo"><i class="bi bi-list"></i> Datos del Archivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formulario_archivo" autocomplete="off" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="txtarchivo" class="form-label"><i class="bi bi-folder2-open"></i> Archivo</label>
                        <input type="file" name="txtarchivo" accept=".xlsx,.zip,.rar,.pdf,.png,.jpg,jpeg" id="txtarchivo" class="form-control" placeholder="Selecciona el Archivo">
                    </div>
                    <div class="mb-3">
                        <label for="txtcomentario" class="form-label"><i class="bi bi-list-columns-reverse"></i> Comentario</label>
                        <textarea name="txtcomentario" id="txtcomentario" cols="30" style="resize: none;" class="form-control" placeholder="Comentario del Archivo"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="bi bi-box-arrow-right"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modaleditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltitulonuevo"><i class="bi bi-list"></i> Datos del Archivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formulario_archivo_editar" autocomplete="off" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="txtcomentario_editar" class="form-label"><i class="bi bi-list-columns-reverse"></i> Comentario</label>
                        <input type="hidden" name="txtid_editar" id="txtid_editar">
                        <textarea name="txtcomentario_editar" id="txtcomentario_editar" cols="30" style="resize: none;" class="form-control" placeholder="Comentario del Archivo"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning"><i class="bi bi-box-arrow-right"></i> Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-11 col-sm-12">
        <form class="d-flex" id="buscador" autocomplete="off" enctype="multipart/form-data">
            <input type="text" name="buscar" id="buscar" list="informacion" placeholder="Buscar Usuario" class="form-control me-2 w-50">
            <datalist id="informacion"></datalist>
            <button type="submit" class="btn btn-primary me-2"><i class="bi bi-search"></i> Buscar</button>
            <button type="button" class="btn btn-success" id="nuevo_archivo"><i class="bi bi-folder-plus"></i> Nuevo Archivo</button>
        </form>
    </div>
</div>
<br>

<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th><i class="bi bi-person-fill"></i> Nombre del Usuario</th>
                <th><i class="bi bi-folder2-open"></i> Archivo</th>
                <th><i class="bi bi-list-columns-reverse"></i> Comentario</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="archivos"></tbody>
    </table>
</div>

<script src="Js/js_archivo.js"></script>
<?php
require_once('Layout/pie.php');
?>