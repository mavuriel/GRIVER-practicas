<?php
if (isset($_GET['accion'])) {
    $nIdAlumnoAjax = $_POST['id'];

    $sAccion = $_GET['accion'];

    switch ($sAccion) {
        case 'buscar':
            require_once 'conexion.php';
            require_once 'alumnos.php';
            $oAlumno = new Alumno;
            $aDatosAlumno = $oAlumno->UnRegistro($nIdAlumnoAjax);
            echo json_encode($aDatosAlumno);
            break;

        default:
            # code...
            break;
    }

    exit;
}

require_once 'conexion.php';
require_once 'alumnos.php';
$oAlumno = new Alumno;

$aListaAlumnos = $oAlumno->TodosRegistros();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <title>Ajax Alumno</title>
</head>
<body>
<main class="container">
  <div class="row align-items-center min-vh-100">

    <div class="card mb-3">
      <h3 class="card-header text-center">Practica 5</h3>
      <div class="card-body p-2">
        <h5 class="card-title text-center ">Peticion AJAX</h5>
      </div>
      <div class="card-body">
        <div class="form-group">
          <form method="post">
            <label for="idalumno" class="form-label mt-1">Alumnos</label>
            <select class="form-select" id="idalumno" name="idalumno" >
              <?php foreach ($aListaAlumnos as $alumno): ?>
                <option value="<?php echo $alumno[0] ?>"><?php echo $alumno[1] ?></option>
                <?php endforeach;?>
              </select>
              <input class="btn btn-success mt-2 w-100" type="button" id="buscar" value="Buscar">
            </form>
          </div>

        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <td>ID</td>
                <td>NOMBRE</td>
                <td>APELLIDO</td>
              </tr>
            </thead>
            <tbody id="registros">
              </tbody>
            </table>
          </div>
        </div>
        <a class="btn btn-primary" href="alumnosvw.php">Regresar a Alumnos</a>
      </div>
      </main>
      <script src="./assets/js/jquery-3.6.0.min.js"></script>
      <script src="./assets/js/ajaxAlumno.js"></script>
    </body>
    </html>
