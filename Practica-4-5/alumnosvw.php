<?php include './layout/inicio.php';?>
<!-- Formulario -->
<div class="col">
    <div class="card mb-3">
        <h3 class="card-header text-center">Formulario alumnos</h3>
        <!-- Alerta de errores -->
        <div id="msndatos" class="card-body d-flex align-items-center justify-content-center pb-0">

        <!-- TODO: falta incorporar las validaciones del servidor
    o con JS no permitir enviar campos vacios -->

<?php
/* if (count($aErrores) > 0) {
echo '';
echo '<div class="alert alert-dismissible alert-danger d-flex justify-content-center align-items-center w-75 mb-0">
<ul class="mb-0">';
foreach ($aErrores as $sError) {
echo "<li>
<small>$sError</small>
</li>";
}
echo '</div>';
} else if ($_POST['accion'] === "enviar" && count($aErrores) === 0) {
echo '<div class="alert alert-dismissible alert-success d-flex justify-content-center align-items-center w-75 mb-0">';
echo "<p class='mb-0'><strong>$sInsertarMsg</strong></p>";
echo '</div>';
} else if ($_POST['accion'] === "actualizar" && count($aErrores) === 0) {
echo '<div class="alert alert-dismissible alert-success d-flex justify-content-center align-items-center w-75 mb-0">';
echo "<p class='mb-0'><strong>$actualizar</strong></p>";
echo '</div>';
} else if ($_POST['accion'] === "eliminar" && !empty($eliminar)) {
echo '<div class="alert alert-dismissible alert-success d-flex justify-content-center align-items-center w-75 mb-0">';
echo "<p class='mb-0'><strong>$eliminar</strong></p>";
echo '</div>';
} */
?>
        </div>
        <!-- Cuerpo del formulario -->
        <div class="card-body p-2">
            <form method="POST">
                <input id="idinput" type="hidden" name="id" value="">
                <div class="form-group">
                    <label class="col-form-label mt-1" for="nombreinput">
                        Nombre:
                    </label>
                    <input type="text" name="nombre" class="form-control validarnombre" placeholder="Ingresa nombre del alumno" id="nombreinput" value="" autocomplete="off">
                    <p class="errornombre mb-0 p-1 w-100">
                      <em class="cvacion w-100 p-1"></em>
                      <br>
                      <em class="cformaton w-100 p-1"></em>
                    </p>
                </div>

                <div class="form-group">
                    <label class="col-form-label mt-2" for="apellidoinput">
                        Apellido:
                    </label>
                    <input type="text" name="apellido" class="form-control validarapellido" placeholder="Ingresa apellido del alumno" id="apellidoinput" value="" autocomplete="off">
                    <p class="errorapellido mb-0 p-1 w-100">
                      <em class="cvacioa w-100 p-1"></em>
                      <br>
                      <em class="cformatoa w-100 p-1"></em>
                    </p>
                </div>
        </div>
        <div class="card-footer text-muted d-flex justify-content-center">

            <input class="btn btn-success me-2" type="button" id="enviar" value="Enviar">
            <button id="actualizar" type="button" class="btn btn-warning me-2 disabled" >Actualizar</button>
        </form>
        <a id="cancelar" href="alumnosvw.php" class="btn btn-secondary me-2 disabled">Cancelar</a>
        </div>
    </div>
</div>
<!-- Tabla de registros -->
<div class="col">
    <table class="table table-hover table-light align-middle text-center">
        <tr class="table-dark">
            <td scope="col">ID</td>
            <td scope="col">Nombre</td>
            <td scope="col">Apellido</td>
            <td></td>
        </tr>
        <tbody id="registros">
        </tbody>
    </table>
</div>

<a href="ajax_alumno.php">Ir a peticion AJAX</a>
</div>
</main>

<script src="./assets/js/validacion.js"></script>
<script src="./assets/js/jquery-3.6.0.min.js"></script>

<script>

/* TODO: separarlo de este archivo */

    $(function(){

        const todosDatos = () => {
            $.ajax({
                type: 'post',
                url: 'alumnoajax.php?accion=todo',
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
                url: 'alumnoajax.php?accion=insertar',
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
                url: 'alumnoajax.php?accion=eliminar',
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
                url: 'alumnoajax.php?accion=seleccionar',
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
            url: 'alumnoajax.php?accion=actualizar',
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
</script>
</body>

</html>