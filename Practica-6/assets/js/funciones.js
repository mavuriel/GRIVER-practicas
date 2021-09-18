$(function(){

  const todosDatos = () => {
      $.ajax({
          type: 'post',
          url: '/controllers/alumnoController.php?accion=todo',
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
  (todosDatos)()


  /* Errores nombre */
  const vacioNombre = document.querySelector('.cvacion')
  const formatInv = document.querySelector('.cformaton')

  /* Errores apellido */
  const vacioApellido = document.querySelector('.cvacioa')
  const formatInvA = document.querySelector('.cformatoa')

  /* Botones */
  const btnenviar = document.querySelector('#enviar')
  const btnactualizar = document.querySelector('#actualizar')
  const btncancelar = document.querySelector('#cancelar')

  /* Validaciones */
  //Nombre
  $('.errornombre').hide()
  $('.validarnombre').keyup(function(){
      $('.errornombre').show()
      let inputev = $('.validarnombre').val()
      ValidarTexto(inputev,vacioNombre,formatInv,btnenviar)
  })

  //Apellido
  $('.errorapellido').hide()
  $('.validarapellido').keyup(function(){
      $('.errorapellido').show()
      let inputev = $('.validarapellido').val()
      ValidarTexto(inputev,vacioApellido,formatInvA,btnenviar)
  })

  /* Delegacion de eventos - botones de accion */
  const registros = document.querySelector('#registros')

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

  /* Insertar datos */

  btnenviar.addEventListener('click',()=>{
      insertar()
  })

  const insertar = () => {

      let nombre = $('#nombreinput').val()
      let apellido = $('#apellidoinput').val()

      $.ajax({
          type: 'post',
          url: '/controllers/alumnoController.php?accion=insertar',
          data:{nombre:nombre,apellido:apellido},
      }).done(function(respuesta){
          let pJson = JSON.parse(respuesta)
          $('#msndatos').empty()
          $('#nombreinput').val('')
          $('#apellidoinput').val('')
          $('#msndatos').append(
          '<div id="contenedormsn" class="alert alert-success d-flex justify-content-center align-items-center w-75 mb-0">'+
          '<p class="mb-0"> <strong>'+ pJson['mensaje'] +'</strong></p>'+
          '</div>'
          )
      })
      todosDatos()
  }

  /* Funcion eliminar dato */
  const eliminar = (n) =>{
      let id = parseInt(n)
      $.ajax({
          type: 'post',
          url: '/controllers/alumnoController.php?accion=eliminar',
          data:{id:id},
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
          url: '/controllers/alumnoController.php?accion=seleccionar',
          data:{id:id},
      }).done(function(respuesta){
          let pJson = JSON.parse(respuesta)
          btnenviar.classList.add('disabled')
          $('#idinput').val(pJson[0])
          $('#nombreinput').val(pJson[1])
          $('#apellidoinput').val(pJson[2])
      })
      todosDatos()
      btnactualizar.classList.remove('disabled')
      btncancelar.classList.remove('disabled')
  }

  //Listener boton actualizar
  btnactualizar.addEventListener('click',()=>{
      actualizar()
  })

  //Funcion actualizar
  const actualizar = () => {
      let id = $('#idinput').val()
      let nombre = $('#nombreinput').val()
      let apellido = $('#apellidoinput').val()

      $.ajax({
      type: 'post',
      url: '/controllers/alumnoController.php?accion=actualizar',
      data:{id:id,nombre:nombre,apellido:apellido},
      }).done(function(respuesta){
      let pJson = JSON.parse(respuesta)
      $('#msndatos').empty()

      $('#idinput').val('')
      $('#nombreinput').val('')
      $('#apellidoinput').val('')

      $('#msndatos').append(
      '<div id="contenedormsn" class="alert alert-success d-flex justify-content-center align-items-center w-75 mb-0">'+
      '<p class="mb-0"> <strong>'+ pJson['mensaje'] +'</strong></p>'+
      '</div>'
      )
      })
      todosDatos()
  }

})//document.ready