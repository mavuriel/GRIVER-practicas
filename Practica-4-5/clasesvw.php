<?php
require('conexion.php');
require('clases.php');

$oClase = new Clase;
$sAccion = (isset($_POST['accion'])) ? $_POST['accion'] : '';
$nId = (isset($_POST['idclase'])) ? $_POST['idclase'] : '';
$nNombreNuevo = (isset($_POST['idnombre'])) ? $_POST['idnombre'] : '';
$nMateriaNuevo = (isset($_POST['idmateria'])) ? $_POST['idmateria'] : '';
$sHorarioNuevo = (isset($_POST['horario'])) ? $_POST['horario'] : '';
$aErrores = [];

switch ($sAccion) {
    case 'enviar':
        $sInsertar = $oClase->Insertar($nNombreNuevo, $nMateriaNuevo, $sHorarioNuevo);
        break;

    case 'seleccionar':
        $aDatosSeleccionado = $oClase->UnRegistro($nId);
        break;

    case 'actualizar':
        $sActualizar = $oClase
            ->Actualizar($nNombreNuevo, $nMateriaNuevo, $sHorarioNuevo, $nId);
        break;

    case 'eliminar':
        $sEliminar = $oClase->Eliminar($nId);
        break;

    default:
        # code...
        break;
}

require_once('profesores.php');
$oProfesor = new Profesor;
$aListaProfesores = $oProfesor->TodosRegistros();

require_once('materias.php');
$oMateria = new Materia;
$aListaMaterias = $oMateria->TodosRegistros();

$aListaClases = $oClase->TodosRegistros();

?>

<?php include('./layout/inicio.php'); ?>
<!-- Formulario -->
<div class="col">
    <div class="card mb-3">
        <h3 class="card-header text-center">Formulario clases</h3>
        <div class="card-body d-flex align-items-center justify-content-center pb-0">
            <?php
            if (count($aErrores) > 0) {
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
                echo "<p class='mb-0'><strong>$sInsertar</strong></p>";
                echo '</div>';
            } else if ($_POST['accion'] === "actualizar" && count($aErrores) === 0) {
                echo '<div class="alert alert-dismissible alert-success d-flex justify-content-center align-items-center w-75 mb-0">';
                echo "<p class='mb-0'><strong>$sActualizar</strong></p>";
                echo '</div>';
            } else if ($_POST['accion'] === "eliminar" && !empty($sEliminar)) {
                echo '<div class="alert alert-dismissible alert-success d-flex justify-content-center align-items-center w-75 mb-0">';
                echo "<p class='mb-0'><strong>$sEliminar</strong></p>";
                echo '</div>';
            }
            ?>
        </div>
        <div class="card-body p-2">
            <form method="POST">
                <input type="hidden" name="idclase" value="
                            <?php if (isset($aDatosSeleccionado)) {
                                echo $aDatosSeleccionado[0];
                            } ?>">
                <div class="form-group">
                    <?php
                    if (isset($aDatosSeleccionado)) {
                        echo "<small class='text-warning'><em>El id de la clase seleccionada es: " . $aDatosSeleccionado[0] . "</em></small><br>";
                    }
                    ?>
                    <label for="selectprofesor" class="form-label mt-4">Profesor</label>
                    <?php
                    if (isset($aDatosSeleccionado)) {
                        echo "<small class='text-warning'><em>El profesor seleccionado es: " . $aDatosSeleccionado[1] . "</em></small>";
                    }
                    ?>
                    <select class="form-select" id="selectprofesor" name="idnombre">
                        <?php foreach ($aListaProfesores as $profe) :  ?>
                            <option value="<?php echo $profe[0]; ?>"><?php echo $profe[1]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">

                    <label for="selectmaterias" class="form-label mt-4">Materias</label>
                    <?php
                    if (isset($aDatosSeleccionado)) {
                        echo "<small class='text-warning'><em>La materia seleccionada es: " . $aDatosSeleccionado[2] . "</em></small>";
                    }
                    ?>
                    <select class="form-select" id="selectmaterias" name="idmateria">
                        <?php foreach ($aListaMaterias as $materia) :  ?>
                            <option value="<?php echo $materia[0]; ?>"><?php echo $materia[1]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="selecthorario" class="form-label mt-4">Horario</label>
                    <?php
                    if (isset($aDatosSeleccionado)) {
                        echo "<small class='text-warning'><em>El horario seleccionado es: " . $aDatosSeleccionado[3] . "</em></small>";
                    }
                    ?>
                    <select class="form-select" id="selecthorario" name="horario">
                        <option value="8:00 a 9:00">8-9</option>
                        <option value="9:00 a 10:00">9-10</option>
                        <option value="10:00 a 11:00">10-11</option>
                        <option value="11:00 a 12:00">11-12</option>
                        <option value="12:00 a 13:00">12-13</option>
                        <option value="13:00 a 14:00">13-14</option>
                        <option value="14:00 a 15:00">14-15</option>
                    </select>
                </div>
                <?php
                if (isset($aDatosSeleccionado)) {
                    echo "<br><small class='text-danger'>*Al actualizar se modificara<em> el registro del id seleccionado</em>.</small><br>";
                }
                ?>

        </div>
        <div class="card-footer text-muted d-flex justify-content-center">
            <button type="submit" class="btn btn-success me-2 
                        <?php if (isset($aDatosSeleccionado)) {
                            echo 'disabled';
                        } ?>" name="accion" value="enviar">Enviar</button>
            <button type="submit" class="btn btn-warning" name="accion" value="actualizar">Actualizar</button>
            </form>
        </div>
    </div>
</div>
<!-- Tabla de registros -->
<div class="col">
    <table class="table table-hover table-light align-middle text-center">
        <tr class="table-dark">
            <td scope="col">ID Clase</td>
            <td scope="col">Profesor</td>
            <td scope="col">Materia</td>
            <td scope="col">Horario</td>
            <td></td>
        </tr>
        <?php foreach ($aListaClases as $clase) :  ?>
            <tr class="table-light">
                <th scope="row"><?php echo $clase[0]; ?></th>
                <td><?php echo $clase[1]; ?></td>
                <td><?php echo $clase[2]; ?></td>
                <td><?php echo $clase[3]; ?></td>
                <td class="d-flex justify-content-around">
                    <form method="POST">
                        <input type="hidden" name="idclase" value="
                        <?php echo $clase[0]; ?>">
                        <input class="btn btn-danger" type="submit" name="accion" value="eliminar">
                        <input type="submit" name="accion" class="btn btn-info" value="seleccionar">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php include('./layout/final.php'); ?>