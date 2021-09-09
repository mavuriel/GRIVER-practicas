<?php
require 'conexion.php';
require 'materias.php';

$oMateria = new Materia;
$sAccion = (isset($_POST['accion'])) ? $_POST['accion'] : '';
$nId = (isset($_POST['idmateria'])) ? $_POST['idmateria'] : '';
$sNombreNuevo = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$nCreditosNuevo = (isset($_POST['creditos'])) ? $_POST['creditos'] : '';
$aErrores = [];

switch ($sAccion) {
    case 'enviar':
        require_once 'validacion.php';
        $aDatosPost = $_POST;
        $aMensajesError = ValidaDatos($aDatosPost);
        foreach ($aMensajesError as $error) {
            $aErrores[] = $error;
        }
        if (empty($aErrores)) {
            $sInsertarMsg = $oMateria->Insertar($sNombreNuevo, $nCreditosNuevo);
        }
        break;

    case 'seleccionar':
        $aDatosSeleccionado = $oMateria->UnRegistro($nId);
        break;

    case 'actualizar':
        require_once 'validacion.php';
        $aDatosPost = $_POST;
        $aMensajesError = ValidaDatos($aDatosPost);
        foreach ($aMensajesError as $error) {
            $aErrores[] = $error;
        }
        if (empty($aErrores)) {
            $idn = (isset($_POST['id'])) ? $_POST['id'] : '';
            $sActualizarMsg = $oMateria
                ->Actualizar($sNombreNuevo, $nCreditosNuevo, $idn);
        }
        break;

    case 'eliminar':
        $sEliminarMsg = $oMateria->Eliminar($nId);
        break;

    default:
        # code...
        break;
}

$aListaMaterias = $oMateria->TodosRegistros();
?>

<?php include './layout/inicio.php';?>
<!-- Formulario -->
<div class="col">
    <div class="card mb-3">
        <h3 class="card-header text-center">Formulario materias</h3>
        <div class="card-body d-flex align-items-center justify-content-center pb-0">
<?php
if (count($aErrores) > 0) {
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
    echo "<p class='mb-0'><strong>$sActualizarMsg</strong></p>";
    echo '</div>';
} else if ($_POST['accion'] === "eliminar" && !empty($sEliminarMsg)) {
    echo '<div class="alert alert-dismissible alert-success d-flex justify-content-center align-items-center w-75 mb-0">';
    echo "<p class='mb-0'><strong>$sEliminarMsg</strong></p>";
    echo '</div>';
}
?>
        </div>
        <div class="card-body p-2">
            <form method="POST">
                <input type="hidden" name="id" value="<?php if (isset($aDatosSeleccionado)) {echo $aDatosSeleccionado[0];}?>">
                <div class="form-group">
                    <label class="col-form-label mt-1" for="nombreinput">
                        Nombre:
                    </label>
                    <input type="text" name="nombre" class="form-control validarnombre" placeholder="Ingresa nombre de la clase" id="nombreinput" value="<?php if (isset($aDatosSeleccionado)) {echo $aDatosSeleccionado[1];}?>" autocomplete="off">
                    <p class="errornombre mb-0 p-1 w-100">
                      <em class="cvacion w-100 p-1"></em>
                      <br>
                      <em class="cformaton w-100 p-1"></em>
                    </p>
                </div>

                <div class="form-group">
                    <label class="col-form-label mt-2" for="creditosinput">
                        Creditos:
                    </label>
                    <input type="number" name="creditos" class="form-control validarnumero" placeholder="Ingresa los creditos de la materia e. j. 4" id="creditosinput" value="<?php if (isset($aDatosSeleccionado)) {echo $aDatosSeleccionado[2];}?>" autocomplete="off">
                    <p class="errornumero mb-0 p-1 w-100">
                      <em class="cvacionum w-100 p-1"></em>
                      <br>
                      <em class="cformatonum w-100 p-1"></em>
                    </p>
                </div>
        </div>
        <div class="card-footer text-muted d-flex justify-content-center">
            <button type="submit" class="btn btn-success me-2
            <?php if (isset($aDatosSeleccionado)) {echo 'disabled';}?>" name="accion" value="enviar">Enviar</button>
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
            <td scope="col">Creditos</td>
            <td></td>
        </tr>
        <?php foreach ($aListaMaterias as $materia): ?>
            <tr class="table-light">
                <th scope="row"><?php echo $materia[0]; ?></th>
                <td><?php echo $materia[1]; ?></td>
                <td><?php echo $materia[2]; ?></td>
                <td class="d-flex justify-content-around">
                    <form method="POST">
                        <input type="hidden" name="idmateria" value="
                        <?php echo $materia[0]; ?>">
                        <input class="btn btn-danger" type="submit" name="accion" value="eliminar">
                        <input type="submit" name="accion" class="btn btn-info" value="seleccionar">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>

</div>
</main>
<script>
    $(function(){
        const vacioNombre = document.querySelector('.cvacion')
        const formatInv = document.querySelector('.cformaton')
        const btnenviar = document.querySelector('.btn-success')

        $('.errornombre').hide()
        $('.validarnombre').keyup(function(){
            $('.errornombre').show()
            let inputev = $('.validarnombre').val()
            ValidarTexto(inputev,vacioNombre,formatInv,btnenviar)
        })

        const vacioNum = document.querySelector('.cvacionum')
        const formatInvNum = document.querySelector('.cformatonum')
        $('.errornumero').hide()
        $('.validarnumero').keyup(function(){
            $('.errornumero').show()
            let inputev = $('.validarnumero').val()
            ValidarNumero(inputev,vacioNum,formatInvNum,btnenviar)
        })
    })
</script>
</body>

</html>