var url = 'http://localhost/sql_php/?u'
var tabla = document.getElementById('usuarios')
var lista = document.getElementById('informacion')
var tipo = document.getElementById('cbotipo')


var formulario_buscador = document.getElementById('buscador')

var nuevo = document.getElementById('nuevo_usuario')
var modal_nuevo = new bootstrap.Modal(document.getElementById('modal_usuario_nuevo'), {
  keyboard: true
})
var modal_editar = new bootstrap.Modal(document.getElementById('modal_usuario_editar'), {
  keyboard: true
})

var formulario_nuevo = document.getElementById('formulario_usuario')
var formulario_editar = document.getElementById('formulario_usuario_editar')

var codigo_usuario = document.getElementById('txtcodigo_editar')
var nombre_usuario = document.getElementById('txtnombre_editar')
var apellido_usuario = document.getElementById('txtapellido_editar')
var sexo_usuario = document.getElementById('cbosexo_editar')
var correo_usuario = document.getElementById('txtcorreo_editar')
var tipo_editar =document.getElementById('cbotipo_editar')

//BUCAR INFORMACION
formulario_buscador.addEventListener('submit', event => {
  event.preventDefault()
  var buscar = document.getElementById('buscar')
  if (buscar.value == '') {
    Listar()
  } else {
    Listar_Tiempo_Real(buscar.value)
    buscar.value = ''
  }
})

// ABRIR MODAL
nuevo.addEventListener('click', function () {
  Codigo()
  modal_nuevo.show()
})

//FORMULARIO DE CREAR
formulario_editar.addEventListener('submit', event => {
  event.preventDefault()
  var datos = new FormData(formulario_editar)
  if (datos.get('cbosexo_editar') == '' || datos.get('txtnombre_editar') == '' || datos.get('txtapellido_editar') == '' || datos.get('txtcorreo_editar') == '' || datos.get('cbotipo') == '') {
    Swal.fire({
      icon: 'error',
      title: 'Error Completa toda el Formulario'
    })
  } else {
    fetch(url + '=Actualizar', { method: 'POST', body: datos })
      .then(resp => resp.text())
      .then((response) => {
        console.log(response)
        Tipo_Usuairo()
        Listar_Buscar()
        Listar()
        modal_editar.hide()
        Swal.fire({
          icon: 'success',
          title: 'Se Actualizo Correctamente',
          showConfirmButton: true
        })
      })
      .catch(console.error)
  }
})

//FORMULARIO DE EDITAR
formulario_nuevo.addEventListener('submit', event => {
  event.preventDefault()
  var datos = new FormData(formulario_nuevo)
  if (datos.get('txtnombre') == '' || datos.get('txtapellido') == '' || datos.get('cbosexo') == '' || datos.get('txtcorreo') == '' || datos.get('cbotipo_editar') == '') {
    Swal.fire({
      icon: 'error',
      title: 'Error Completa toda el Formulario'
    })
  } else {
    fetch(url + '=Guardar', { method: 'POST', body: datos })
      .then(resp => resp.text())
      .then((response) => {
        Tipo_Usuairo()
        Listar_Buscar()
        Listar()
        modal_nuevo.hide()
        Swal.fire({
          icon: 'success',
          title: 'Se Registro Correctamente',
          showConfirmButton: true
        })
      })
      .catch(console.error)
  }
})

// CREA CODIGO ALEATORIO
const Codigo = () => {
  fetch(url + '=Codigo', { method: 'GET' })
    .then(resp => resp.text())
    .then((response) => {
      formulario_nuevo.reset()
      document.getElementById('txtcodigo').value = response
    })
    .catch(console.error)
}

//DATALIST DE LA IMPUT DE BUSCAR
const Listar_Buscar = () => {
  fetch(url, { method: 'GET' })
    .then(resp => resp.json())
    .then(datos => Mostrar_Buscar(datos))
    .catch(console.error)
}

const Mostrar_Buscar = (datos) => {
  temple = ''
  datos.forEach(element => {
    temple += `
      <option value="${element.USER}">
        <small>${element.CORREO}</small>
      </option>
      `
  });
  lista.innerHTML = temple
}

// LISTAR LOS TIPOS DE USUARIOS
const Tipo_Usuairo = () => {
  fetch(url + '=Tipos', { method: 'GET' })
    .then(resp => resp.json())
    .then((response) => {
      var temple = '<option value="">-- Selecciona el Tipo de Usuario --</option>'
      response.forEach(element => {
        temple += `<option value="${element.ID}">${element.TIPO}</option>`
      });
      tipo.innerHTML = temple
      tipo_editar.innerHTML=temple
    })
    .catch(console.error)
}

//LISTAR LA INFORMACION Y FUNCIONES DE BUSCAR EN TIEMPO REAL
const Listar_Tiempo_Real = (usuario) => {
  fetch(url + '=TiempoReal&&Usuario=' + usuario, { method: 'GET' })
    .then(resp => resp.json())
    .then(data => Mostrar(data))
    .catch(console.error)
}

const Listar = () => {
  fetch(url, { method: 'GET' })
    .then(resp => resp.json())
    .then(datos => Mostrar(datos))
    .catch(console.error)
}

const Mostrar = (datos) => {
  var temple = ''
  datos.forEach(element => {
    temple += `
      <tr>
        <td><i class="bi bi-person-fill"></i> ${element.USER}</td>
        <td>${element.SEXO}</td>
        <td>${element.CORREO}</td>
        <td>${element.TIPO}</td>
        <td>
          <div class="btn-group">
            <button type="button" class="btn btn-info" onclick="Informacion('${element.CODIGO}')"><i class="bi bi-info-circle-fill"></i></button>
            <button type="button" class="btn btn-warning" onclick="Buscar('${element.CODIGO}')"><i class="bi bi-pencil-square"></i></button>
            <button type="button" class="btn btn-danger" onclick="Borrar('${element.CODIGO}')"><i class="bi bi-trash-fill"></i></button>
          </div>
        </td>
      <tr>
    `
  });
  tabla.innerHTML = temple
}

const Informacion = (codigo) => {
  fetch(url + '=Buscar&&Usuario=' + codigo + '', { method: 'GET' })
    .then(resp => resp.json())
    .then((response) => {
      Swal.fire({
        icon: 'info',
        title: 'Informacion del Usuario',
        html: '<b><i class="bi bi-code-slash"></i> Codigo:</b> ' + response[0]['CODIGO'] + '<br>' +
          '<b><i class="bi bi-person-fill"></i> Usuario:</b> ' + response[0]['USER'] + '<br>' +
          '<b><i class="bi bi-gender-ambiguous"></i> Sexo:</b> ' + response[0]['SEXO'] + '<br>' +
          '<b><i class="bi bi-envelope-fill"></i> Correo Electronico:</b> ' + response[0]['CORREO'] + '<br>' +
          '<b><i class="bi bi-person-lines-fill"></i> Tipo:</b> ' + response[0]['TIPO']
      })
    })
    .catch(console.error)
}

const Buscar = (codigo) => {
  fetch(url + '=Buscar&&Usuario=' + codigo + '', { method: 'GET' })
    .then(resp => resp.json())
    .then((response) => {
      formulario_editar.reset()
      codigo_usuario.value = response[0]['CODIGO'];
      nombre_usuario.value = response[0]['NOMBRE'];
      apellido_usuario.value = response[0]['APELLIDO'];
      sexo_usuario.value = response[0]['SEXO'];
      correo_usuario.value = response[0]['CORREO'];
      tipo_editar.value=response[0]['ID']
      modal_editar.show()
    })
    .catch(console.error)
}

const Borrar = (codigo) => {
  Swal.fire({
    title: 'Deseas Eliminar al Usuario ?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Eliminar'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(url + '=Eliminar&&Usuario=' + codigo, { method: 'GET' })
        .then(resp => resp.text())
        .then((response) => {
          Tipo_Usuairo()
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

Tipo_Usuairo()
Listar_Buscar()
Listar()