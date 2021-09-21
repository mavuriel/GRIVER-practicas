/* TODO: documentar archivo JS */
const funciones = (controlador) => {

  console.log('El controlador de los select es: '+controlador)

  //Select
  const selectUno = document.querySelector('#selectuno')
  const selectDos = document.querySelector('#selectdos')
  const selectTres = document.querySelector('#selecttres')

  //Botones
  const btnenviar = document.querySelector('#enviar')
  const btnactualizar = document.querySelector('#actualizar')
  const btncancelar = document.querySelector('#cancelar')

  const todosDatos = () => {
    $.ajax({
        type: 'post',
        url: '/controllers/'+controlador+'Controller.php',
        data: {accion:'todo'}
     }).done(function(respuesta){
        let pJson = JSON.parse(respuesta)
        $('#registros').empty()
        pJson.forEach(e => {
            $('#registros').append(
                '<tr class="table-light">'+
                '<td>'+e[0]+'</td>'+
                '<td>'+e[1]+'</td>'+
                '<td>'+e[2]+'</td>'+
                '<td id="btnacciones" class="d-flex justify-content-around me-1">'+
                '<button class="eliminar btn btn-danger" type="button" value="'+ e[0] +'">Eliminar</button>'+
                '<button class="seleccionar btn btn-info" type="button" value="'+ e[0] +'">Seleccionar</button>'+
                '</td>'+
                '</tr>')
            });
    })
}
/* Mostrar datos de la tabla*/

todosDatos()

const hideP = () => {
  $('#primermsn').hide()
  $('#segundomsn').hide()
  $('#tercermsn').hide()
  $('#cuartomsn').hide()
  $('#avisoact').hide()
}
hideP()

const showP = () => {
  $('#primermsn').show()
  $('#segundomsn').show()
  $('#tercermsn').show()
  $('#cuartomsn').show()
  $('#avisoact').show()
}

const emptyMsn = () =>{
  $('#valoruno').empty()
  $('#valordos').empty()
  $('#valortres').empty()
  $('#valorcuatro').empty()
}

const peticionProfesores = () => {
  //Peticio de profesores
  $.ajax({
    type: 'post',
    url: '/controllers/profesorController.php',
    data: {accion:'todo'}
  }).done(function(respuesta){
    let pJson = JSON.parse(respuesta)
    $('#selectuno').empty()
    pJson.forEach( e => {
      $('#selectuno').append(
        '<option value="'+e[0]+'">'+e[1]+'</option>'
      )
    })
  })
}

const peticionMaterias = () => {
  //Peticion de materias
  $.ajax({
    type: 'post',
    url: '/controllers/materiaController.php',
    data: {accion:'todo'}
  }).done(function(respuesta){
    let pJson = JSON.parse(respuesta)
    $('#selectdos').empty()
    pJson.forEach( e => {
      $('#selectdos').append(
        '<option value="'+e[0]+'">'+e[1]+'</option>'
      )
    })
  })
}

const peticionAlumnos = () => {
  //Peticion de alumnos
  $.ajax({
    type: 'post',
    url: '/controllers/alumnoController.php',
    data: {accion:'todo'}
  }).done(function(respuesta){
    let pJson = JSON.parse(respuesta)
    $('#selectuno').empty()
    pJson.forEach( e => {
      $('#selectuno').append(
        '<option value="'+e[0]+'">'+e[1]+' '+ e[2] +'</option>'
      )
    })
  })
}

const peticionClase = () => {
  //Peticion de clase
  $.ajax({
    type: 'post',
    url: '/controllers/claseController.php',
    data: {accion:'todo'}
  }).done(function(respuesta){
    let pJson = JSON.parse(respuesta)
    $('#selectdos').empty()
    pJson.forEach( e => {
      $('#selectdos').append(
        '<option value="'+e[0]+'"> Profesor: '+e[1]+' Materia: '+ e[2] +'</option>'
      )
    })
  })
}

/* Datos select */

if(controlador === 'clase'){
  peticionProfesores()
  peticionMaterias()
}else{
  peticionAlumnos()
  peticionClase()
}

const insertar = () => {

  let primerdato = selectUno.value
  let segundodato = selectDos.value
  let tercerdato = controlador==='clase' ? selectTres.value : ''

  //Insertar datos
  $.ajax({
    type: 'post',
    url: '/controllers/'+ controlador +'Controller.php',
    data: {
      accion:'insertar',
      datouno:primerdato,
      datodos:segundodato,
      horario: tercerdato,
    }
  }).done(function(respuesta){
    let pJson = JSON.parse(respuesta)
    $('#msndatos').empty()
    $('#msndatos').append(
      '<div id="contenedormsn" class="alert alert-success d-flex justify-content-center align-items-center w-75 mb-0">'+
      '<p class="mb-0"> <strong>'+ pJson['mensaje'] +'</strong></p>'+
      '</div>'
      )      
  })
  todosDatos()
}

const seleccionar = (n) =>{
  let id = parseInt(n)
  $.ajax({
      type: 'post',
      url: '/controllers/'+controlador+'Controller.php',
      data:{accion:'seleccionar',id:id},
  }).done(function(respuesta){

    emptyMsn()
    showP()

      let pJson = JSON.parse(respuesta)

      btnenviar.classList.add('disabled')
      btnactualizar.classList.remove('disabled')
      btncancelar.classList.remove('disabled')
      
      if (controlador === 'clase'){
        $('#idinput').val(pJson[0])
        $('#valoruno').append(pJson[0])
        $('#valordos').append(pJson[1])
        $('#valortres').append(pJson[2])
        $('#valorcuatro').append(pJson[3])
      }else{
        $('#idinput').val(pJson[0])
        $('#valoruno').append(pJson[0])
        $('#valordos').append(pJson[3])
        $('#valortres').append(pJson[2])
        $('#valorcuatro').append(pJson[1])
      }

  })
  todosDatos()
}

const actualizar = () => {
  let id = $('#idinput').val()
  let primerDato = selectUno.value
  let segundoDato = selectDos.value
  let tercerDato = controlador==='clase' ? selectTres.value : ''

  $.ajax({
    type: 'post',
    url: '/controllers/'+controlador+'Controller.php',
    data:{
      accion:'actualizar',
      id:id,
      datouno:primerDato,
      datodos:segundoDato,
      horario:tercerDato,
    },
  }).done(function(respuesta){

    let pJson = JSON.parse(respuesta)

    
    $('#msndatos').empty()
    $('#msndatos').append(
    '<div id="contenedormsn" class="alert alert-success d-flex justify-content-center align-items-center w-75 mb-0">'+
    '<p class="mb-0"> <strong>'+ pJson['mensaje'] +'</strong></p>'+
    '</div>'
    )

    btnactualizar.classList.add('disabled')
    btncancelar.classList.add('disabled')
    btnenviar.classList.remove('disabled')
  })
  todosDatos()
  hideP()
}

const eliminar = (n) =>{
  let id = parseInt(n)
  $.ajax({
      type: 'post',
      url: '/controllers/'+controlador+'Controller.php',
      data:{accion:'eliminar',id:id},
  }).done(function(respuesta){
      let pJson = JSON.parse(respuesta)

      hideP()
      $('#msndatos').empty()
      $('#msndatos').append(
      '<div id="contenedormsn" class="alert alert-success d-flex justify-content-center align-items-center w-75 mb-0">'+
      '<p class="mb-0"> <strong>'+ pJson['mensaje'] +'</strong></p>'+
      '</div>'
      )

      btnactualizar.classList.add('disabled')
      btncancelar.classList.add('disabled')

  })
  todosDatos()
}

/* Listeners */

btnenviar.addEventListener('click', ()=>{
  insertar()
})

btnactualizar.addEventListener('click', ()=>{
  actualizar()
} )

/* Botones de accion tabla */
registros.addEventListener('click', (e) => {
  if(e.target && e.target.tagName === 'BUTTON'){
      if(e.target.classList[0]==='eliminar'){
          let id = parseInt(e.target.value)
          eliminar(id)
      }else{
          let id = parseInt(e.target.value)
          seleccionar(id)
      }
  }
  })




  
}