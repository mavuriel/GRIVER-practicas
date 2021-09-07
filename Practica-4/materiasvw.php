<?php
require('conexion.php');
require('materias.php');

$oMateria = new Materia;
$sAccion = (isset($_POST['accion'])) ? $_POST['accion'] : '';
$nId = (isset($_POST['idmateria'])) ? $_POST['idmateria'] : '';
$sNombreNuevo = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$nCreditosNuevo = (isset($_POST['creditos'])) ? $_POST['creditos'] : '';
$aErrores = [];

switch ($sAccion) {
    case 'enviar':
        require_once('validacion.php');
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
        require_once('validacion.php');
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
                            <a class="nav-link active" href="materiasvw.php">Materias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="clasesvw.php">Clases</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inscripvw.php">Inscripción</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <div class="row d-flex justify-content-center">

        </div>
        <div class="row align-items-center min-vh-100">
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
                            <input type="hidden" name="id" value="
                            <?php if (isset($aDatosSeleccionado)) {
                                echo $aDatosSeleccionado[0];
                            } ?>">
                            <div class="form-group">
                                <label class="col-form-label mt-1" for="nombreinput">
                                    Nombre:
                                </label>
                                <input type="text" name="nombre" class="form-control" placeholder="Ingresa nombre de la clase" id="nombreinput" value="<?php if (isset($aDatosSeleccionado)) {
                                                                                                                                                            echo $aDatosSeleccionado[1];
                                                                                                                                                        } ?>">
                            </div>

                            <div class="form-group">
                                <label class="col-form-label mt-2" for="creditosinput">
                                    Creditos:
                                </label>
                                <input type="text" name="creditos" class="form-control" placeholder="Ingresa los creditos de la materia e. j. 4" id="creditosinput" value="<?php if (isset($aDatosSeleccionado)) {
                                                                                                                                                                                echo $aDatosSeleccionado[2];
                                                                                                                                                                            } ?>">
                            </div>
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
            <div class="col">
                <table class="table table-hover table-light align-middle text-center">
                    <tr class="table-dark">
                        <td scope="col">ID</td>
                        <td scope="col">Nombre</td>
                        <td scope="col">Creditos</td>
                        <td></td>
                    </tr>
                    <?php foreach ($aListaMaterias as $materia) :  ?>
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
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </main>
</body>

</html>