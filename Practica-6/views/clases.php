<?php include 'inicio.php'?>

      <!-- Formulario -->
      <div class="col">
          <div class="card mb-3">
              <h3 class="card-header text-center">Formulario clases</h3>
              <!-- Alerta -->
              <div id="msndatos" class="card-body d-flex align-items-center justify-content-center pb-0">

              </div>
              <!-- Cuerpo del formulario -->
              <div class="card-body p-2">
                  <form id="formulario" method="POST">

                  <input id="idinput" type="hidden" name="idinput" value="">

                <div class="form-group">

                <small id="primermsn" class='text-warning'>El id de la clase seleccionada es:<em id="valoruno"></em><br></small>

                    <label for="selectuno" class="form-label mt-4">Profesor</label>

                    <small id="segundomsn" class='text-warning'>El profesor seleccionado es:<em id="valordos"></em></small>

                    <select class="form-select" id="selectuno" name="idnombre">

                    </select>
                </div>
                <div class="form-group">

                    <label for="selectdos" class="form-label mt-4">Materias</label>

                    <small id="tercermsn" class='text-warning'>La materia seleccionada es:<em id="valortres"></em></small>

                    <select class="form-select" id="selectdos" name="idmateria">

                    </select>
                </div>
                <div class="form-group">
                    <label for="selecttres" class="form-label mt-4">Horario</label>

                    <small id="cuartomsn" class='text-warning'>El horario seleccionado es:<em id="valorcuatro"></em></small>

                    <select class="form-select" id="selecttres" name="horario">
                        <option value="8:00 a 9:00">8-9</option>
                        <option value="9:00 a 10:00">9-10</option>
                        <option value="10:00 a 11:00">10-11</option>
                        <option value="11:00 a 12:00">11-12</option>
                        <option value="12:00 a 13:00">12-13</option>
                        <option value="13:00 a 14:00">13-14</option>
                        <option value="14:00 a 15:00">14-15</option>
                    </select>
                </div>

                <small id="avisoact" class='text-danger'><br>*Al actualizar se modificara<em> el registro del id seleccionado </em>, escoja de las listas los nuevos datos.<br></small>

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
<script src="../assets/js/funcionesSelect.js"></script>
<script>
$(function(){
    funciones('clase')
})//document.ready
</script>
</body>

</html>
