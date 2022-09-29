var url = "http://localhost/sql_php/?a"
var tabla = document.getElementById('archivos')
var lista = document.getElementById('informacion')

var formulario_buscador = document.getElementById('buscador')

var boton_nuevo = document.getElementById('nuevo_archivo')

const modal_nuevo = new bootstrap.Modal(document.getElementById('modalnuevo'), {
    keyboard: true
})

const modal_editar = new bootstrap.Modal(document.getElementById('modaleditar'), {
    keyboard: true
})
var formulario_editar = document.getElementById('formulario_archivo_editar')
var comentario_editar = document.getElementById('txtcomentario_editar')
var id_editar = document.getElementById('txtid_editar')

var formulario_archivo = document.getElementById('formulario_archivo')

formulario_editar.addEventListener('submit', event => {
    event.preventDefault()
    var datos = new FormData(formulario_editar)

    if (datos.get('txtcomentario_editar') == '') {
        Swal.fire({
            icon: 'error',
            title: 'Error debes escribir el comentario del archivo !!!'
        })
    } else {

        fetch(url + '=Editar', { method: 'POST', body: datos })
            .then(resp => resp.text())
            .then((response) => {
                modal_editar.hide()
                Listar_Buscar()
                Listar()
                Swal.fire({
                    icon: 'success',
                    title: 'Se Actualizo Correctamente',
                    showConfirmButton: true
                })
            })
            .catch(console.error)
    }
})

formulario_archivo.addEventListener('submit', event => {
    event.preventDefault()
    var datos = new FormData()
    datos.append('archivo', document.querySelector('#txtarchivo').files[0]);
    datos.append('comentario', document.getElementById('txtcomentario').value);

    if (datos.get('archivo') == '') {
        Swal.fire({
            icon: 'error',
            title: 'Error debes agregar un archivo !!!'
        })
    } else if (datos.get('comentario') == '') {
        Swal.fire({
            icon: 'error',
            title: 'Error debes escribir el comentario del archivo !!!'
        })
    } else {

        fetch(url + '=Guardar', { method: 'POST', body: datos })
            .then(resp => resp.text())
            .then((response) => {
                console.log(response);
                modal_nuevo.hide()
                Listar_Buscar()
                Listar()
                Swal.fire({
                    icon: 'success',
                    title: 'Se Registro Correctamente',
                    showConfirmButton: true
                })
            })
            .catch(console.error)
    }
})

// BUSCADOR DEL USUARIO SI ERES ADMINISTRADOR DEL SISTEMA
formulario_buscador.addEventListener('submit', event => {
    event.preventDefault()
    var buscar = document.getElementById('buscar')
    if (buscar.value == '') {
        Listar_Buscar()
        Listar()
    } else {
        fetch(url + '=Buscador&&Buscar=' + buscar.value, { method: 'GET' })
            .then(resp => resp.json())
            .then(data => Mostrar(data))
            .catch(console.error)
        buscar.value = ''
    }
})


// ABRE EL MODAL DE REGISTRAR
boton_nuevo.addEventListener('click', function () {
    modal_nuevo.show()
    formulario_archivo.reset()
})

// MOSTRAR LA INFORMACION COMO PDF Y IMAGENES DENTRO DEL MODAL
const Descargar = (archivo) => {
    window.location = '?a=Descargar&&Archivo=' + archivo
}
//text/csv   application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
// LISTAR LA INFORMACION 
const Listar = () => {
    fetch(url, { method: 'GET' })
        .then(resp => resp.json())
        .then(data => Mostrar(data))
        .catch(console.error)
}

const Mostrar = (data) => {
    var temple = ''
    data.forEach(element => {
        temple += `
            <tr>
                <td><i class="bi bi-person-fill"></i> ${element.USER}</td>
                `
        if (element.EXTENCION == 'application/pdf') {
            temple += `<td><img src="Icon/pdf.png" width="50" height="50" onclick="Descargar('${element.ARCHIVO}')" title="${element.ARCHIVO}"></td>`
        } else if (element.EXTENCION == 'image/png' || element.EXTENCION == 'image/jpeg') {
            temple += `<td><img src="Icon/imagen.png" width="70" height="70" onclick="Descargar('${element.ARCHIVO}')" title="${element.ARCHIVO}"></td>`
        } else if (element.EXTENCION == 'application/x-zip-compressed') {
            temple += `<td><img src="Icon/zip.png" width="70" height="70" onclick="Descargar('${element.ARCHIVO}')" title="${element.ARCHIVO}"></td>`
        } else if (element.EXTENCION == 'text/csv' || element.EXTENCION == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            temple += `<td><img src="Icon/excel.png" width="70" height="70" onclick="Descargar('${element.ARCHIVO}')" title="${element.ARCHIVO}"></td>`
        }
        temple += `<td>${element.COMENTARIO}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" onclick="Editar('${element.ID}')" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" onclick="Borrar('${element.ID}')" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                    </div>
                </td>
            </tr>
        `
    });
    tabla.innerHTML = temple
}

//DATALIST DE LA IMPUT DE BUSCAR SOLO USO PARA LOS QUE SON ADMINISTRADORES
const Listar_Buscar = () => {
    fetch(url, { method: 'GET' })
        .then(resp => resp.json())
        .then(datos => Mostrar_Buscar(datos))
        .catch(console.error)
}

const Mostrar_Buscar = (datos) => {
    temple = ''
    datos.forEach(element => {
        temple += `<option value="${element.COMENTARIO}"></option>`
        return lista.innerHTML = temple
    });
}

// EDITAR COMENTARIO DEL ARCHIVO
const Editar = (codigo) => {
    fetch(url + '=Buscar&&Archivo=' + codigo + '', { method: 'GET' })
        .then(resp => resp.json())
        .then((response) => {
            formulario_editar.reset()
            id_editar.value = response[0]['ID']
            comentario_editar.value = response[0]['COMENTARIO']
            modal_editar.show()
        })
        .catch(console.error)
}

// BORRAR ARCHIVO SUBIDO AL SISTEMA
const Borrar = (codigo) => {
    Swal.fire({
        title: 'Deseas Eliminar el Archivo ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url + '=Eliminar&&Archivo=' + codigo, { method: 'GET' })
                .then(resp => resp.text())
                .then((response) => {
                    Listar_Buscar()
                    Listar()
                    Swal.fire(
                        'Se Elimino Correctamente',
                        '',
                        'success'
                    )
                })
                .catch(console.error)
        }
    })
}

Listar_Buscar()
Listar()