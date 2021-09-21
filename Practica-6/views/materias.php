<?php include 'inicio.php'?>

      <!-- Formulario -->
      <div class="col">
          <div class="card mb-3">
              <h3 class="card-header text-center">Formulario materias</h3>
              <!-- Alerta -->
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
                        <label class="col-form-label mt-2" for="creditosinput">
                            Creditos:
                        </label>
                        <input id="numeroinput" type="number" name="creditos" class="form-control validarnumero" placeholder="Ingresa los creditos de la materia e. j. 4" id="creditosinput" value="" autocomplete="off">
                        <p class="errornumero mb-0 p-1 w-100">
                          <em class="cvacionum w-100 p-1"></em>
                          <br>
                          <em class="cformatonum w-100 p-1"></em>
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
<script src="../assets/js/funcionesInput.js"></script>
<script>
$(function(){
    funciones('materia')
})//document.ready
</script>
</body>

</html>
