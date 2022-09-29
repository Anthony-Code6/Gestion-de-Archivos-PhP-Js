var url = 'http://localhost/sql_php/?u'
var formulario = document.getElementById('formulariologin')

formulario.addEventListener('submit', event => {
    event.preventDefault()
    var datos = new FormData(formulario)
    if (datos.get('correo') == '' || datos.get('clave') == '') {
        Swal.fire(
            'Error Completa el Formulario',
            '',
            'error'
        )
    } else if (datos.get('clave').length <= 9) {
        Swal.fire(
            'Error Completa el Password',
            '',
            'error'
        )
    } else {
        fetch(url + '=Login', { method: 'POST', body: datos })
            .then(resp => resp.text())
            .then((response) => {
                window.location = '?v=Inicio'
            })
            .catch(console.error)
    }
})
