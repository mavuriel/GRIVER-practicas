<?php

/**
 * Esta clase manipula los datos de inscripciones
 *
 * @author Uriel Tenorio <trainee.urielat@griver.com.mx>
 * @copyright 2021 RECO By SOFTDEM. All rights reserved.
 */
class Inscripcion extends Conexion
{
  /**
   * Inserta una nueva inscripcion
   *
   * Este metodo recibe el id del alumno y clase a la cual sera
   * inscrito
   *
   * @access public
   * @param int $nIdAlumnoInsertar
   * @param int $nIdClaseInsertar
   * @return string
   */
  public function Insertar($nIdAlumnoInsertar, $nIdClaseInsertar)
  {
    $oConexion = new Conexion;
    $db = $oConexion->Conectar();
    $consulta = $db
      ->prepare("INSERT INTO inscripciones (nIdAlumno,nIdClase) VALUES (?,?)");
    $consulta->bind_param("ii", $nIdAlumnoBind, $nIdClaseBind);

    $nIdAlumnoBind = $nIdAlumnoInsertar;
    $nIdClaseBind = $nIdClaseInsertar;

    $consulta->execute();

    $consulta->close();
    $db->close();
    return 'Dato ingresado con exito';
  }

  /**
   * Elimina una inscripcion
   *
   * Este metodo elimina los datos de una inscripcion,
   * de acuerdo al id obtenido
   *
   * @access public
   * @param int $nIdSeleccionado
   * @return string
   */
  public function Eliminar($nIdSeleccionado)
  {
    $oConexion = new Conexion;
    $db = $oConexion->Conectar();
    $consulta = $db
      ->prepare("DELETE FROM inscripciones WHERE nIdInscripcion = ?");
    $consulta->bind_param("i", $nIdCondicion);
    $nIdCondicion = $nIdSeleccionado;
    $consulta->execute();

    $consulta->close();
    $db->close();

    return 'Dato borrado';
  }

  /**
   * Actualiza los datos de una inscripcion
   *
   * Este metodo obtiene los id de alumno y clase para actualizar sus datos
   * de acuerdo al id que sea seleccionado
   *
   * @access public
   * @param int $nIdNombreActualizar
   * @param int $nIdClaseActualizar
   * @param int $nIdActualizar
   * @return string
   */
  public function Actualizar($nIdNombreActualizar, $nIdClaseActualizar, $nIdActualizar)
  {
    $oConexion = new Conexion;
    $db = $oConexion->Conectar();
    $consulta = $db
      ->prepare("UPDATE inscripciones SET nIdAlumno = ?, nIdClase=? WHERE nIdInscripcion = ?");
    $consulta->bind_param("iii", $nIdNombreSet, $nIdClaseSet, $nIdCondicion);


    $nIdNombreSet = $nIdNombreActualizar;
    $nIdClaseSet = $nIdClaseActualizar;
    $nIdCondicion = trim($nIdActualizar);

    $consulta->execute();

    $consulta->close();
    $db->close();
    return 'Dato actualizado con exito';
  }

  /**
   * Obtiene los datos de un registro.
   *
   * Este metodo obtiene los datos de una inscripcion nombre de profesor, materia
   * y alumno, a partir de un id seleccionado.
   *
   * @access public
   * @param int $nIdSeleccionado
   * @return array
   */
  public function UnRegistro($nIdSeleccionado)
  {
    $oConexion = new Conexion();
    $db = $oConexion->Conectar();
    $consulta = $db
      ->prepare("SELECT
                            a.nIdInscripcion,
                            p.sNombre nombreprofesor,
                            q.sNombre nombremateria,
                            c.sNombre nombrealumno
                    FROM
                            inscripciones a
                            INNER JOIN (clases b INNER JOIN profesores p on b.nIdProfesor = p.nIdProfesor) ON a.nIdClase = b.nIdClase
                            INNER JOIN (clases z INNER JOIN materias q on z.nIdMateria = q.nIdMateria) ON a.nIdClase = z.nIdClase
                            INNER JOIN alumnos c ON a.nIdAlumno = c.nIdAlumno
                    WHERE nIdInscripcion = ?");

    $consulta->bind_param("i", $nIdCondicion);

    $nIdCondicion = $nIdSeleccionado;

    $consulta->execute();

    $consulta->bind_result($nIdResult, $sNombreProfesorResult, $sNombreMateriaResult, $sNombreAlumnoResult);

    $aDatosResult = [];
    while ($consulta->fetch() != null) {
      $aDatosResult[] = $nIdResult;
      $aDatosResult[] = $sNombreProfesorResult;
      $aDatosResult[] = $sNombreMateriaResult;
      $aDatosResult[] = $sNombreAlumnoResult;
    }

    return $aDatosResult;
  }

  /**
   * Obtiene todos los registros de las inscripciones
   *
   * Este metodo obtiene el nombre del alumno y materia de todas las
   * inscripciones registradas
   *
   * @access public
   * @return array
   */
  public function TodosRegistros()
  {
    $oConexion = new conexion;
    $sql = "SELECT
                        a.nIdInscripcion,
                        q.sNombre nombremateria,
                        c.sNombre nombrealumno
                FROM
                inscripciones a
                INNER JOIN (clases b INNER JOIN profesores p on b.nIdProfesor = p.nIdProfesor) ON a.nIdClase = b.nIdClase
                INNER JOIN (clases z INNER JOIN materias q on z.nIdMateria = q.nIdMateria) ON a.nIdClase = z.nIdClase
                INNER JOIN alumnos c ON a.nIdAlumno = c.nIdAlumno
                ORDER BY nIdInscripcion";
    $aDatosRegistros = $oConexion->ConsultaTodo($sql);
    return $aDatosRegistros;
  }
}
