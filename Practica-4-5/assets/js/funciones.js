
/* Insertar datos */

const insertar = () => {

  let nombre = $('#nombreinput').val()
  let apellido = $('#apellidoinput').val()

  $.ajax({
    type: 'post',
    url: 'alumnoajax.php?accion=insertar',
    data:{nombre:nombre,apellido:apellido},
  }).done(function(respuesta){
    console.log(respuesta)
    let pJson = JSON.parse(respuesta)
    console.log(pJson)
    $('#msndatos').empty()
    $('#msndatos').append(
    '<div id="contenedormsn" class="alert alert-success d-flex justify-content-center align-items-center w-75 mb-0">'+
    '<p class="mb-0"> <strong>'+ pJson['mensaje'] +'</strong></p>'+
    '</div>'
    )
    todosDatos()
  })
}

/* Eliminar dato */

/* function eliminar() {

  let id = ($('#idseleccionado').val()).trim()

  $.ajax({
    type: 'post',
    url: 'alumnoajax.php?accion=eliminar',
    data:{id:id},
  }).done(function(respuesta){
    console.log(respuesta)
    let pJson = JSON.parse(respuesta)
    console.log(pJson)
    $('#msndatos').empty()
    $('#msndatos').append(
    '<div id="contenedormsn" class="alert alert-success d-flex justify-content-center align-items-center w-75 mb-0">'+
    '<p class="mb-0"> <strong>'+ pJson['mensaje'] +'</strong></p>'+
    '</div>'
    )
  })
  todosDatos()
} */

/* Obtener un dato */
const seleccionar = () => {

  console.log(id)

  /* let id = ($('#idseleccionado').val()).trim()

  console.log(id) */
  /* $.ajax({
    type: 'post',
    url: 'alumnoajax.php?accion=seleccionar',
    data:{id:id},
  }).done(function(respuesta){
    console.log(respuesta)
    let pJson = JSON.parse(respuesta)
    console.log(pJson)
    $('#idinput').val(pJson[0])
    $('#nombreinput').val(pJson[1])
    $('#apellidoinput').val(pJson[2])
  }) */
}