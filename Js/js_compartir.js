const url = 'http://localhost/sql_php/?c'
const contenido = document.getElementById('contenido')
const buscador = document.getElementById('buscador')

var compartir = document.getElementById('compartir_archivo')
var modal_compartir = new bootstrap.Modal(document.getElementById('modal_compartir'), {
    keyboard: true
})

const formulario = document.getElementById('formulario_compartir')
const validar_informacion = document.getElementById('validar')
const compartir_archivo = document.getElementById('compartir')
const codigo = document.getElementById('txtcodigo')
const archivo=document.getElementById('cboarchivo')

formulario.addEventListener('submit', event => {
    event.preventDefault()
    const datos = new FormData()
    datos.append('txtcodigo',codigo.value);
    datos.append('cboarchivo',archivo.value);

    if (datos.get('cboarchivo') == '') {
        Swal.fire(
            'Debes Seleccionar un Archivo',
            '',
            'error'
        )
    } else {
        fetch(url + '=Guardar', { method: 'POST', body: datos })
            .then(resp => resp.text())
            .then((response) => {
                Swal.fire(
                    'Se Registro Correctamente',
                    '',
                    'success'
                )
                modal_compartir.hide()
            })
            .catch(console.error)
    }
})

compartir.addEventListener('click', function () {
    formulario.reset()
    modal_compartir.show()
    compartir_archivo.disabled = true
    codigo.disabled = false
    validar_informacion.disabled = false
})

validar_informacion.addEventListener('click', event => {
    event.preventDefault()

    if (codigo.value == '') {
        Swal.fire(
            'Debes Ingresar el Codigo del Usuario !!!',
            '',
            'error'
        )
    } else {
        fetch(url + '=Validar&&Codigo=' + codigo.value, { method: 'GET' })
            .then(resp => resp.json())
            .then((response) => {
                if (response == 'Iguales') {
                    Swal.fire(
                        'Error el Codigo debe ser Diferente a su Codigo de Usuario',
                        '',
                        'error'
                    )
                    codigo.value = ''
                } else if (response == 'Error') {
                    Swal.fire(
                        'Error el Codigo del Usuario no Existe !!!',
                        '',
                        'error'
                    )
                } else {
                    Swal.fire({
                        title: 'Deseas Compartir el Archivo a este Usuario',
                        icon: 'warning',
                        html: "<b>Usuario: " + response[0]['APELLIDO'] + ' ' + response[0]['NOMBRE'] + "</b>",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            compartir_archivo.disabled = false
                            codigo.disabled = true
                            validar_informacion.disabled = true
                        } else {
                            codigo.value = ''
                            compartir_archivo.disabled = true
                            codigo.disabled = false
                            validar_informacion.disabled = false
                        }
                    })
                }

            })
            .catch(console.error)
    }
})

buscador.addEventListener('submit', event => {
    event.preventDefault()
    var buscar = document.getElementById('buscar')
    if (buscar.value == '') {
        Listar()
    } else {
        Listar_Buscador(buscar.value)
    }
    buscar.value = ''
})

const Mostrar_Informacion = (codigo) => {
    fetch(url + '=Informacion&&Codigo=' + codigo, { method: 'GET' })
        .then(resp => resp.json())
        .then((data) => {
            Swal.fire({
                icon: 'info',
                title: 'Informacion del Archivo Compartido',
                html: '<b>Codigo:</b> ' + data[0]['CODIGO_USUARIO'] + '<br>' +
                    '<b>Usuario:</b> ' + data[0]['USUARIO'] + '<br>' +
                    '<b>Fecha:</b> ' + data[0]['FECHA']
            })
        })
        .catch(console.error)
}

const Descargar = (archivo) => {
    window.location = '?a=Descargar&&Archivo=' + archivo
}

const Listar_Archivos = () => {
    fetch(url + '=Listar', { method: 'GET' })
        .then(resp => resp.json())
        .then(data => Seleccion(data))
        .catch(console.error)
}

const Seleccion = (datos) => {
    var temple = '<option value="">-- Seleccionar Archivo --</option>'
    datos.forEach(element => {
        temple += `<option value="${element.ID}">${element.ARCHIVO}</option>`
    });
    document.getElementById('cboarchivo').innerHTML = temple
}

const Listar_Buscador = (contenido) => {
    fetch(url + '=Buscar&&Archivo=' + contenido, { method: 'GET' })
        .then(resp => resp.json())
        .then(data => Mostrar(data))
        .catch(console.error)
}

const Listar = () => {
    fetch(url, { method: 'GET' })
        .then(resp => resp.json())
        .then(data => Mostrar(data))
        .catch(console.error)
}

const Mostrar = (datos) => {
    var temple = ``
    datos.forEach(element => {
        temple += `<div class="col-sm-12 col-md-4 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div style="float:left;">`
        if (element.EXTENCION == 'application/pdf') {
            temple += `<img src="Icon/pdf.png" width="100" height="100">`
        } else if (element.EXTENCION == 'image/png' || element.EXTENCION == 'image/jpeg') {
            temple += `<img src="Icon/imagen.png" width="100" height="100">`
        } else if (element.EXTENCION == 'application/x-zip-compressed') {
            temple += `<img src="Icon/zip.png" width="100" height="100">`
        } else if (element.EXTENCION == 'text/csv' || element.EXTENCION == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            temple += `<img src="Icon/excel.png" width="100" height="100">`
        }
        temple += `             </div>
                                <div style="padding: 5px;">
                                    <p class="card-text">${element.COMENTARIO}</p>
                                </div>
                                <div class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" title="Informacion" onclick="Mostrar_Informacion('${element.ID}')"><i class="bi bi-info-circle-fill"></i></button>
                                        <button type="button" class="btn btn-danger" title="Descargar" onclick="Descargar('${element.ARCHIVO}')"><i class="bi bi-download"></i></button>
                                        <button type="button" class="btn btn-warning" title="Quitar Archivo Compartido" onclick="Borrar('${element.ID}')"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `
    });
    contenido.innerHTML = temple
}

const Borrar = (codigo) => {
    Swal.fire({
        title: 'Ya no Deseas este Archivo Compartido ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url + '=Borrar&&Codigo=' + codigo, { method: 'GET' })
                .then(resp => resp.text())
                .then((response) => {
                    Swal.fire(
                        'Se Elimino Correctamente',
                        '',
                        'success'
                    )
                    Listar_Archivos()
                    Listar()
                })
                .catch(console.error)
        }
    })
}

Listar_Archivos()
Listar()