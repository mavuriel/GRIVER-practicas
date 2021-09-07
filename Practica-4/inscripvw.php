<?php
require('conexion.php');
require('inscripciones.php');

$oInscripcion = new Inscripcion;
$sAccion = (isset($_POST['accion'])) ? $_POST['accion'] : '';
$nId = (isset($_POST['idinscripcion'])) ? $_POST['idinscripcion'] : '';
$nNombreNuevo = (isset($_POST['idnombre'])) ? $_POST['idnombre'] : '';
$nClaseNuevo = (isset($_POST['idclase'])) ? $_POST['idclase'] : '';
$aErrores = [];

switch ($sAccion) {
    case 'enviar':
        $sInsertar = $oInscripcion->Insertar($nNombreNuevo, $nClaseNuevo);
        break;

    case 'seleccionar':
        $aDatosSeleccionado = $oInscripcion->UnRegistro($nId);
        break;

    case 'actualizar':
        $sActualizar = $oInscripcion
            ->Actualizar($nNombreNuevo, $nClaseNuevo, $nId);
        break;

    case 'eliminar':
        $sEliminar = $oInscripcion->Eliminar($nId);
        break;

    default:
        # code...
        break;
}

$sqlClase = "SELECT
                    a.nIdClase,
                    b.sNombre nombremaestro,
                    c.sNombre nombremateria
            FROM
            clases a
            INNER JOIN profesores b ON a.nIdProfesor = b.nIdProfesor
            INNER JOIN materias c ON a.nIdMateria = c.nIdMateria
";

require_once('alumnos.php');
$oAlumno = new Alumno;
$aListaAlumnos = $oAlumno->TodosRegistros();

require_once('clases.php');
$oClase = new Clase;
$aListaClase = $oClase->TodosRegistros();

$aListaInscripciones = $oInscripcion->TodosRegistros();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <title>Escuela</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Escuela</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link " href="alumnosvw.php">Alumnos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profesoresvw.php">Profesores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="clasesvw.php">Materias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="clasesvw.php">Clases</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="inscripvw.php">Inscripción</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col">
                <div class="card mb-3">
                    <h3 class="card-header text-center">Formulario inscripciones</h3>
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
                            <input type="hidden" name="idinscripcion" value="
                            <?php if (isset($aDatosSeleccionado)) {
                                echo $aDatosSeleccionado[0];
                            } ?>">
                            <div class="form-group">
                                <?php
                                if (isset($aDatosSeleccionado)) {
                                    echo "<small class='text-warning'><em>El id de la inscripcion seleccionada es: " . $aDatosSeleccionado[0] . "</em></small><br>";
                                }
                                ?>
                                <label for="selectprofesor" class="form-label mt-4">Alumno</label>
                                <?php
                                if (isset($aDatosSeleccionado)) {
                                    echo "<small class='text-warning'><em>El alumno seleccionado es: " . $aDatosSeleccionado[3] . "</em></small>";
                                }
                                ?>
                                <select class="form-select" id="selectprofesor" name="idnombre">
                                    <?php foreach ($aListaAlumnos as $alumno) :  ?>
                                        <option value="<?php echo $alumno[0]; ?>"><?php echo $alumno[1] . " " . $alumno[2]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="selectclases" class="form-label mt-4">Clase</label>
                                <?php
                                if (isset($aDatosSeleccionado)) {
                                    echo "<small class='text-warning'><em>La clase seleccionada es: " . $aDatosSeleccionado[2] . "</em> del profesor <em>" . $aDatosSeleccionado[1] . "</em></small>";
                                }
                                ?>
                                <select class="form-select" id="selectclases" name="idclase">
                                    <?php foreach ($aListaClase as $clase) :  ?>
                                        <option value="<?php echo $clase[0]; ?>"><?php echo "Profesor: " . $clase[1] . " - Materia: " . $clase[2]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php
                            if (isset($aDatosSeleccionado)) {
                                echo "<br><small class='text-danger'>*Al actualizar se modificara<em> el registro del id seleccionado</em>.</small><br>";
                            }
                            ?>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-center
                    ">
                        <button type="submit" class="btn btn-success me-2 
                        <?php if (isset($aDatosSeleccionado)) {
                            echo 'disabled';
                        } ?>" name="accion" value="enviar">Enviar</button>
                        <button type="submit" class="btn btn-warning" name="accion" value="actualizar">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <table class="table table-hover table-light align-middle text-center">
                    <tr class="table-dark">
                        <td scope="col">ID Inscripción</td>

                        <td scope="col">Clase</td>
                        <td scope="col">Alumno</td>
                        <td></td>
                    </tr>
                    <?php foreach ($aListaInscripciones as $inscripcion) :  ?>
                        <tr class="table-light">
                            <th scope="row"><?php echo $inscripcion[0]; ?></th>
                            <td><?php echo $inscripcion[1]; ?></td>
                            <td><?php echo $inscripcion[2]; ?></td>
                            <td class="d-flex justify-content-around">
                                <form method="POST">
                                    <input type="hidden" name="idinscripcion" value="
                        <?php echo $inscripcion[0]; ?>">
                                    <input class="btn btn-danger" type="submit" name="accion" value="eliminar">
                                    <input type="submit" name="accion" class="btn btn-info" value="seleccionar">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </main>
</body>

</html>