<?php

require_once 'conexion.php';
require_once 'alumnos.php';

$oAlumno = new Alumno;

$sNombreNuevo = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$sApellidoNuevo = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
$nId = (isset($_POST['idalumno'])) ? $_POST['idalumno'] : '';
$aErrores = [];

/* switch ($sAccion) {
case 'enviar':

require_once 'validacion.php';
$aDatosPost = $_POST;
$aMensajesError = ValidaDatos($aDatosPost);
foreach ($aMensajesError as $error) {
$aErrores[] = $error;
}
if (empty($aErrores)) {
$sInsertarMsg = $oAlumno->Insertar($sNombreNuevo, $sApellidoNuevo);
}
break;

case 'seleccionar':
$aDatosSeleccionado = $oAlumno->UnRegistro($nId);
break;

case 'actualizar':
require_once 'validacion.php';
$aDatosPost = $_POST;
$aMensajesError = ValidaDatos($aDatosPost);
foreach ($aMensajesError as $error) {
$aErrores[] = $error;
}
if (empty($aErrores)) {
$nIdCondicion = (isset($_POST['id'])) ? $_POST['id'] : '';
$actualizar = $oAlumno
->Actualizar($sNombreNuevo, $sApellidoNuevo, $nIdCondicion);
}
break;

case 'eliminar':
$sEliminar = $oAlumno->Eliminar($nId);
break;

default:
# code...
break;
} */

$aListaAlumnos = $oAlumno->TodosRegistros();
?>

<?php include './layout/inicio.php';?>
<!-- Formulario -->
<div class="col">
    <div class="card mb-3">
        <h3 class="card-header text-center">Formulario alumnos</h3>
        <!-- Alerta de errores -->
        <div id="msndatos" class="card-body d-flex align-items-center justify-content-center pb-0">
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
            <button type="submit" class="btn btn-warning" name="accion" value="actualizar">Actualizar</button>
            </form>
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
<script src="./assets/js/jquery-3.6.0.min.js"></script>
<script src="./assets/js/validacion.js"></script>
<script src="./assets/js/funciones.js"></script>
<script>

  $(document).ready(function(){

        //Mostrar todos los datos de la tabla
        todosDatos()

        /* Errores nombre */
        const vacioNombre = document.querySelector('.cvacion')
        const formatInv = document.querySelector('.cformaton')

        /* Errores apellido */
        const vacioApellido = document.querySelector('.cvacioa')
        const formatInvA = document.querySelector('.cformatoa')

        /* Botones */
        const btnenviar = document.querySelector('#enviar')
        const btneliminar = document.querySelectorAll('#eliminar')

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

        /* Eventos botones CRUD*/

        //Insertar
        $('#enviar').click(function(){
          insertar()
        })
        //Eliminar
        $('#registros').on('click','#eliminar',function(){
          eliminar()
        })
        //Seleccionar

        $('#registros').on('click','#seleccionar',function(){
            let id = $('#idseleccionado').val()
            console.log(id)
        })
        //Actualizar

    })


</script>
</body>

</html>