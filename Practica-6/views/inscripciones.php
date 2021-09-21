<?php include 'inicio.php'?>

      <!-- Formulario -->
      <div class="col">
          <div class="card mb-3">
              <h3 class="card-header text-center">Formulario inscripciones</h3>
              <!-- Alerta -->
              <div id="msndatos" class="card-body d-flex align-items-center justify-content-center pb-0">

              </div>
              <!-- Cuerpo del formulario -->
              <div class="card-body p-2">
                    <form id="formulario" method="POST">

                    <input id="idinput" type="hidden" name="idinput" value="">

                    <div class="form-group">
                    <small id="primermsn" class='text-warning'>
                      El id de la inscripcion seleccionada es: <em id="valoruno"></em><br>
                    </small>

                    <label for="selectuno" class="form-label mt-4">Alumno</label>
                    <small id="segundomsn" class='text-warning'>
                        El alumno seleccionado es: <em id="valordos"></em>
                    </small>

                    <select class="form-select" id="selectuno" name="idnombre">
                        <!-- id, nombre y apellido -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="selectdos" class="form-label mt-4">Clase</label>

                    <small id="tercermsn" class='text-warning'>
                        La clase seleccionada es: <em id="valortres"></em> --|-- Profesor:  <em id="valorcuatro"></em>
                    </small>

                    <select class="form-select" id="selectdos" name="idclase">

                    </select>
                </div>

                <small id="avisoact" class='text-danger'>
                    <br>*Al actualizar se modificara<em> el registro del id seleccionado </em>, escoja de las listas los nuevos datos.<br>
                </small>

              </div>
              <div class="card-footer text-muted d-flex justify-content-center">
                      <input id="enviar" class="btn btn-success me-2" type="button"  value="Enviar">
                      <button id="actualizar" type="button" class="btn btn-warning me-2 disabled" >Actualizar</button>
                  </form>
                  <a id="cancelar" href="../views/inscripciones.php" class="btn btn-secondary me-2 disabled">Cancelar</a>
              </div>
          </div>
      </div>
      <!-- Tabla de registros -->
      <div class="col">
          <table class="table table-hover table-light align-middle text-center">
              <tr class="table-dark">
                <td scope="col">ID Inscripción</td>
                <td scope="col">Clase</td>
                <td scope="col">Alumno</td>
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
<script src="../assets/js/funcionesSelect.js"></script>
<script>
$(function(){
    funciones('inscripcion')
})//document.ready
</script>
</body>

</html>
