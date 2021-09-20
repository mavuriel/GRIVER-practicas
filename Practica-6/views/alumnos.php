<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <title>Escuela MVC</title>
</head>

<body>
  <header>
  <nav class="d-flex justify-content-center">
      <ul class="nav nav-pills">
      <li class="nav-item">
          <a class="nav-link active" href="#">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./alumnos.php">Alumnos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./profesores.php">Profesores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Materias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Clases</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Inscripciones</a>
        </li>
      </ul>
    </nav>
  </header>
  <main class="container">
    <div class="row min-vh-100 align-content-center justify-content-center">

      <!-- Formulario -->
      <div class="col">
          <div class="card mb-3">
              <h3 class="card-header text-center">Formulario alumnos</h3>
              <!-- Alerta de errores -->
              <div id="msndatos" class="card-body d-flex align-items-center justify-content-center pb-0">

              </div>
              <!-- Cuerpo del formulario -->
              <div class="card-body p-2">
                  <form id="formulario" method="POST">
                      <input id="idinput" type="hidden" name="id" value="">
                      <div class="form-group">
                          <label class="col-form-label mt-1" for="nombreinput">
                              Nombre:
                          </label>
                          <input id="nombreinput" type="text" name="nombre" class="form-control validarnombre" placeholder="Ingresa nombre del alumno"  value="" autocomplete="off">
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
                          <input id="apellidoinput" type="text" name="apellido" class="form-control validarapellido" placeholder="Ingresa apellido del alumno"  value="" autocomplete="off">
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
                  <a id="cancelar" href="../views/alumnos.php" class="btn btn-secondary me-2 disabled">Cancelar</a>
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

    </div><!-- grid -->
  </main><!-- container -->

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/validacion.js"></script>
<script src="../assets/js/funciones.js"></script>

</body>

</html>
