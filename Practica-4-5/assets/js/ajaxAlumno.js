$(function(){

  $('#buscar').click(function(){

    let idAlumno = $('#idalumno').val()

    $.ajax({

      type: 'post',
      url: 'ajax_alumno.php?accion=buscar',
      data: {id: idAlumno}

    }).done(function(json){

      console.log(json)
      let pJson = JSON.parse(json)
      console.log(pJson)
      $('#registros').empty()
      $('#registros').append(
        '<tr>'+
        '<td>'+pJson[0]+'</td>'+
        '<td>'+pJson[1]+'</td>'+
        '<td>'+pJson[2]+'</td>'+
        '</tr>'
      )

    })
  })
})
/* $.each(pJson,function(llave, valor){
console.log(llave+'-'+valor)
}) */
/* 
<button id="enviar" type="button" class="btn btn-success me-2
            <?php if (isset($aDatosSeleccionado)) {echo 'disabled';} ?>" name="accion" value="enviar">Enviar</button>
            */
